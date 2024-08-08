<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::query()->with('product');

        if (\request()->has('onlyData')){
            return response()->json($reviews->get(), 200);
        }else{
            $reviews = $reviews->paginate(10)->withQueryString();
            return response()->json($reviews, 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required',
            'email' => 'required|email',
            'name' => 'required|max:32',
            'rating' => 'required',
            'review' => 'required',
            'title' => 'required'
        ]);

        $review = Review::create($data);


        return response()->json(['review' => $review], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($productId)
    {
        $totalRating  = Review::query()->where('product_id', $productId)->sum('rating');
        $reviews = Review::query()->where('product_id', $productId)->get();



        return response()->json([
            'reviews' => $reviews,
            'totalRating' => $totalRating,
            'average' => $totalRating / $reviews->count(),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return response('Review Delete Successfully Done...');
    }
}
