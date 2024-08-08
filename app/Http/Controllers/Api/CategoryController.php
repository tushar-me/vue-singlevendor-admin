<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function index()
    {
        $resCats = [];
        if(request()->has('recursive')){
            $resCats = Category::query()
                ->with(['childrenRecursive'])
                ->whereNull('parent_id')
                ->select('id', 'name');
            $resCats = $this->makeRecursive($resCats->get());
        }elseif(\request()->input('onlyData') == 'true'){
            $resCats = Category::query()
                ->select(['id', 'name'])
                ->get();
        }
        else{
            $resCats = Category::query()
                ->with(['parent'])
                ->latest()
                ->paginate(10)
                ->withQueryString();
        }

        return response()->json($resCats);
    }


    protected function makeRecursive($categories, $label = 0): array
    {
        $result = [];
        foreach ($categories as $category) {
            $name = str_repeat('-', $label) .''. $category['name'];
            $result[] = ['id' => $category['id'], 'name' => $name];
            if (!empty($category->childrenRecursive)) {
                $result = array_merge($result, $this->makeRecursive($category->childrenRecursive, $label + 1));
            }
        }
        return $result;

    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:30|min:1|unique:categories',
            'photo' => 'required',
        ]);


        if (\Illuminate\Support\Facades\Request::hasFile('image')){
            $file =  \Illuminate\Support\Facades\Request::file('image');
            $icon = $file->store('/uploads');
        }

        $parentId = $request->input('parent') != 'null' ? $request->input('parent') : NULL;

        $data = $request->all();
        $data['parent_id'] =  $parentId;
        $data['slug'] = Str::slug($request->name);
        $data['photo'] = $icon ??  NULL;
        $data['details'] = $request->details ??  NULL;
        $data['icon'] = $request->input('icon');
        Category::create($data);
        return response()->json(['message' => 'Category save successfully done.'], 200);
    }

    public function show(Category $category)
    {
        return response()->json($category);
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Category save successfully done.'], 200);
    }


    public function updateCategory(Request $request, $id){

        $this->validate($request, [
            'name' => 'required|max:30|min:1|unique:categories,name,' .$request->id,
            'photo' => 'nullable'
        ]);


        $category = Category::findOrFail($id);
        $data = $request->all();

        if (\Illuminate\Support\Facades\Request::hasFile('image')){
            $file =  \Illuminate\Support\Facades\Request::file('image');
            $icon = $file->store('/uploads');
            $data['photo'] = $icon;
        }

        $data['parent_id'] = $request->input('parent') != 'undefined' ? $request->input('parent') : NULL;
        $data['slug'] = Str::slug($request->name);
        $data['details'] = $request->details != null ? $request->details :  NULL;
        $category->update($data);
        return response()->json(['message' => 'Category update successfully done.'], 200);

    }



    public function navCategories(){

        $ids = collect(json_decode(get_setting('navCats')));

        $categories = Category::query()->with(['childrenRecursive'])->whereIn('id', $ids)->get();


        return response()->json($categories);
    }




    public function homeCategories()
    {
        $categories = collect(json_decode(get_setting('homeCats')));
        $products = Category::query()->with(['products', 'childrenRecursive', 'products.images', 'products.stocks'])->whereIn('id', $categories)->get();

        $products->each(function ($product){
            $product->products->each(function($product) {
                $product->images->map(function($image) {
                    $image->url = Storage::url("uploads/$image->image");
                    return $image;
                });
            });
        });

        return response()->json($products);
    }



}

