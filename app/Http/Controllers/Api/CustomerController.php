<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ForgatePasswordMail;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $request->only(['onlyData']);

        $query = User::query()->with(['addresses', 'addresses.orderArea'])
            ->where('role', 'customer');


        if($request->has('onlyData')){
            $customers = $query->get();
        }else{
            $customers = $query->paginate(20);
        }
        return response()->json($customers);
    }

    public function store(Request $request)
    {


        $this->validate($request, [
            'name' => 'required|max:30|min:1',
            'email' => 'required|unique:users',
//            'phone' => 'required|unique:employees',
        ]);

        if(!$request->has('fromAdmin')){
            $request->validate([
                'password' => 'required|min:6'
            ]);
        }

        if ($request->photo){
            $photo = $request->photo;
            $photo = $request->photo;
            $position = strpos($photo, ';');
            $subString = substr($photo, 0,$position);
            $imageExt = explode( '/',$subString )[1];
            $imageName = time().rand(0000,9999).'.'.$imageExt;
            $resize = Image::make($photo)->resize(200, 180)->encode('jpg');
            Storage::put("public/customers/$imageName", $resize->__toString());


            $uploadPath = "storage/customers/$imageName";

            User::create([
                'full_name' => $request->name,
                'username' => $request->name,
                'email' => $request->email,
                'phone' => "+8801".$request->phone,
                'photo' => $uploadPath,
                'password' => Hash::make($request->input('password'))
            ]);


            return response()->json(['message' =>'Customer save with image'], 200);
        }else{

            User::create([
                'full_name' => $request->name,
                'username' => Str::slug($request->name, '_'),
                'email' => $request->email,
                'phone' => $request->phone,
                'position' => $request->position,
                $userImage = ['user.svg', 'default.png'],
                'address' => $request->address,
                'password' => Hash::make($request->input('password')),
                'photo' => 'storage/customers/'.$userImage[array_rand($userImage, 1)],
            ]);
            return response()->json(['message' =>'Customer save without image'], 200);
        }
    }
    public function show($id)
    {
        $customer = User::findOrFail($id);
        return response()->json($customer);
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $customer = User::findOrFail($id);
        $data['phone'] = "+8801".$request->phone;
        $customer->update($data);
        return response()->json(['message' =>'Customer update...'], 200);
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' =>'Customer delete without image'], 200);
    }

    public function loginCustomer(Request $request)
    {
        $request->validate([
           'email' => 'required|email',
           'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            if(Auth::user()->role != "customer"){
                Auth::logout();

                throw ValidationException::withMessages([
                    'email' => 'These credentials do not match our records.',
                ]);
            }

            $user = Auth::user();
            $user->token =  $user->createToken('MyApp')->plainTextToken;

            return response()->json([
               "message" => "User Registration Successfully Done...",
               "data" =>$user
            ]);
        }
        else{
            throw ValidationException::withMessages([
                'email' => 'These credentials do not match our records.',
            ]);

//            return response()->json([
//                "status" => false,
//                "message" => "Email Or Password Not Valid..."
//            ]);
        }
    }



    public function logoutCustomer(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->noContent();
    }


    public function updateProfile(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->full_name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->save();

        return response()->json('Profile Updated...');
    }


    public function updatePassword(Request $request)
    {
        $user = User::query()->findOrFail($request->id);
        $hashedPassword = $user->password;

        $request->validate([
            'current_pass' => 'required',
            'new_pass'=> 'required|min:6',
            'confirm_pass' => 'required|min:6|same:new_pass',
        ]);

        if (Hash::check($request->input('current_pass'), $hashedPassword)) {
            if (!Hash::check($request->input("new_pass"), $hashedPassword)) {
                $user->update([
                    'password' => Hash::make($request->input("new_pass"))
                ]);
                Auth::logout();

                return response()->json("New Password Updated..");

            } else {
                return response()->json([
                    'errors' => 'Current Password Not Match',
                    'error' => 'New Password Can Not Be Same As Same Password'
                ]);
            }
        } else {
            if ($user->password == null){
                $user->password = Hash::make(Request::input('password'));
                $user->save();
                return back();
            }

            return response()->json([
                'errors' => 'Current Password Not Match',
                'error' => 'New Password Can Not Be Same As Same Password'
            ]);
        }
        return response()->json("New Password Updated..");
    }

    public function sendForgotPasswordReqs(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email', Rule::exists('users', 'email')]
        ]);


        $user = User::query()->where('email', \Illuminate\Support\Facades\Request::input('email'))->first();

        if($user != null){
            if ($user && $user != null){
                Mail::to($user)->send(new ForgatePasswordMail($user));
                return \response()->json('Resend Password Mail Send Successfully Done !', 200);
            }else{
                return \response()->json('Your Email Address Not Valid...!', 404);
            }
        }else{
            return \response()->json('Your Email Address Not Valid...!', 404);
        }

    }

    public function checkForgotPassword(){
        $email = base64_decode(\request()->input("_token"));

        $user = User::where('email', $email)->first();

        if ($user && $user != null){
            return redirect(env('FRONTEND_URL')."/new-given-password?email=$email");
        }else{
            return \response()->json(['message' => 'Email Address is not valid...'], 404);
        }
    }

    public function saveNewChangedPassword(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
        ]);
        $user = User::where('email', $request->input('email'))->first();
        $user->password = Hash::make($request->input('password'));
        $user->update();

        return response()->json('Password Change Successfully Done...', 200);
    }



}
