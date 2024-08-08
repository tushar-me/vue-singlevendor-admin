<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    public function index()
    {
        $employes = Employee::all();
        return response()->json($employes);
    }
    public function store(Request $request)
    {


        $this->validate($request, [
            'name' => 'required|max:30|min:1',
            'email' => 'required|unique:employees',
            'phone' => 'required|unique:employees',
            'position' => 'required',
        ]);

//        if ($request->photo){
        if ($request->image){
            $photo = $request->image;
            $imageName = time().random_int(1,9999).'.'.$photo->getClientOriginalExtension();

//            $position = strpos($photo, ';');
//            $subString = substr($photo, 0,$position);
//            $imageExt = explode( '/',$subString )[1];
//            $imageName = time().rand(0000,9999).'.'.$imageExt;


//            this is for storage
//            $resize = Image::make($photo)->resize(200, 180)->encode('jpg');
//            Storage::put("public/employee/$imageName", $resize->__toString());
//            $uploadPath = "storage/employee/$imageName";

//            this is for local
            $photo->move('employee/', $imageName);
            $uploadPath = "employee/$imageName";

            $data = $request->all();
            Employee::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'position' => $data['position'],
                'address' => $data['address'],
                'photo' => $uploadPath,
            ]);
            return response()->json(['message' =>'Employee save with image'], 200);
        }else{
            $userImage = ['user.svg', 'default.png'];
            Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'position' => $request->position,
                'address' => $request->address,
                'photo' => 'employee/'.$userImage[array_rand($userImage, 1)],
//                'photo' => 'storage/employee/'.$userImage[array_rand($userImage, 1)],
            ]);

            return response()->json(['message' =>'Employee save without image'], 200);
        }
    }

    public function show(Employee $employee)
    {
        return response()->json($employee);
    }



    public function update(Request $request, Employee $employee)
    {


        $this->validate($request, [
            'name' => 'required|max:30|min:1',
            'email' => 'required|unique:employees,email,'.$employee->id,
            'phone' => 'required|unique:employees,phone,'.$employee->id,
            'position' => 'required',
        ]);

        if ($request->photo) {



//            @unlink($employee->photo);

            $photo = $request->photo;


            $position = strpos($photo, ';');
            $subString = substr($photo, 0,$position);
            $imageExt = explode( '/',$subString )[1];
            $imageName = time().rand(0000,9999).'.'.$imageExt;
//
////            $imageName = time().random_int(1,9999).'.'.$photo->getClientOriginalExtension();
            Image::make($request->get('image'))->save(public_path('images/').$imageName);
//            $photo->move('employee/', $imageName);
            $uploadPath = "employee/$imageName";

            $data = $request->all();
            $data['photo']  = $uploadPath;
            $employee->update($data);
            return response()->json(['message' =>'Employee update successfully done with new image'], 200);

        }else{
            $data = $request->all();
            $data['photo']  = $employee->photo;
            $employee->update($data);
            return response()->json(['message' =>'Employee update successfully done. old image'], 200);
        }

    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(['message' =>'Employee deleted successfully done.'], 200);
    }


    public function saveEmp(Request $request){

        Employee::create([
           'name'      => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'position' => $request->position,
            'address'  => $request->address,
        ]);

        return response()->json(['message' =>'Employee Added successfully done.'], 200);




    }



































}
