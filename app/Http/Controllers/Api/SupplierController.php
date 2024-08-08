<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SupplierController extends Controller
{
    public function index()
    {
        return response()->json(Supplier::all());
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:30|min:1',
            'email' => 'required|unique:employees',
            'phone' => 'required|unique:employees',
        ]);

        if ($request->photo) {


            $photo = $request->photo;
            $position = strpos($photo, ';');
            $subString = substr($photo, 0,$position);
            $imageExt = explode( '/',$subString )[1];
            $imageName = time().rand(0000,9999).'.'.$imageExt;

//            return $imageName;

            $resize = Image::make($photo)->resize(200, 180)->encode('jpg');
            Storage::put("public/suppliers/$imageName", $resize->__toString());


            $uploadPath = "storage/suppliers/$imageName";


            $data = $request->all();
            $data['photo'] = $uploadPath;
            Supplier::create($data);
            return response()->json(['message' => 'Supplier save successfully done.'], 200);
        }else{
            $data = $request->all();
            $data['photo'] = 'default.png';
            Supplier::create($data);
            return response()->json(['message' => 'Supplier save successfully done.'], 200);
        }
    }
    public function show(Supplier $supplier)
    {
        return response()->json($supplier);
    }
    public function update(Request $request, Supplier $supplier)
    {
        $this->validate($request, [
            'name' => 'required|max:30|min:1',
            'email' => 'required|unique:suppliers',
            'phone' => 'required|unique:suppliers',
        ]);
        $data = $request->all();
        $supplier->update($data);
        return response()->json(['message' => 'Supplier update successfully done.'], 200);

    }
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return response()->json(['message' => 'Supplier delete successfully done.'], 200);
    }
}
