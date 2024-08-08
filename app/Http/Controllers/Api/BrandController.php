<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        return response()->json(Brand::all());
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:30|min:1|unique:brands',
            'photo' => 'required',
        ]);

        $data = $request->all();
        if (\Illuminate\Support\Facades\Request::hasFile('image')){
            $file =  \Illuminate\Support\Facades\Request::file('image');
            $icon = $file->store('/uploads');
            $data['photo'] = $icon;
        }

        $data['slug'] = Str::slug($request->title);
        Brand::create($data);
        return response()->json(['message' => 'Brand save successfully done.'], 200);
    }
    public function show(Brand $brand)
    {
        return response()->json($brand);
    }
    public function update(Request $request, Brand $brand)
    {
        //
    }
    public function updateBrand(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:30|min:1|unique:brands,title,' .$request->id,
        ]);

        $data = Brand::findOrFail($request->input('id'));

        if (\Illuminate\Support\Facades\Request::hasFile('image')){
            $file =  \Illuminate\Support\Facades\Request::file('image');
            $icon = $file->store('/uploads');
            $data->photo = $icon;
        }

        $data->title = $request->input('title');
        $data->slug = Str::slug($request->title);
        $data->update();
        return response()->json(['message' => 'Brand save successfully done.'], 200);
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json(['message' => 'Brand Delete done.'], 200);
    }
}
