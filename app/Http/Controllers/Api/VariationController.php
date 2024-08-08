<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributs = Variation::query()->with('variationOptions')->orderBy('id', 'asc')->get();
        return response()->json($attributs);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        try {
            Variation::create([
                'name' => $request->input('name'),
                'code' => Str::slug($request->input('name')),
                'frontend_type' => 'checkbox'
            ]);

            return response()->json(['message' =>'Variation save successfully done.'], 200);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 200);
        }
    }

    /**
     * Display the specified resource.
     * @param Variation $attribute
     */
    public function show(Variation $attribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Variation $attribute
     */
    public function update(Request $request, Variation $attribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param Variation $attribute
     */
    public function destroy(Variation $attribute)
    {
        //
    }
}
