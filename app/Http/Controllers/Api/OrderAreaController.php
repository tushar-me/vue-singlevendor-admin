<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\OrderArea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class OrderAreaController extends Controller
{

    public function index()
    {
        $arias = OrderArea::query()
            ->when(Request::input('search'), function ($query, $search) {
                $query->where('area_name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(Request::input('perPage') ?? 10)
            ->withQueryString()
            ->through(fn($area) => [
                'id' => $area->id,
                'area_name' => $area->area_name,
                'area_code' => $area->area_code,
                'delivery_charge' => $area->delivery_charge,
                'charge_condition' => $area->charge_condition,
                'charge_condition_price' => $area->charge_condition_price,
                'created_at' => $area->created_at,
            ]);
        return response()->json($arias, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {

        $data = Request::validate([
            'id' => 'nullable',
            'area_name' => 'required',
            'area_code' => 'required',
            'delivery_charge' => 'required',
            'charge_condition' => 'nullable',
            'charge_condition_price' =>  'nullable'
        ]);

        OrderArea::query()->updateOrCreate(['id' => Request::input('id')], $data);

        return response()->json(['message' => 'New Area Adde...']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderArea  $orderArea
     * @return \Illuminate\Http\Response
     */
    public function show(OrderArea $orderArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderArea  $orderArea
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderArea $orderArea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderArea  $orderArea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderArea $orderArea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderArea  $orderArea
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $orderArea = OrderArea::query()->findOrFail($id);
        $orderArea->delete();
        return response()->json(['message' => 'Area Deleted...']);
    }


    public function getAreas(){
        $areas = OrderArea::all(['id', 'area_name']);
        return response()->json($areas);
    }

    public function saveAddress(){

        $data = Request::validate([
            'title' => 'required',
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'area' => 'required',
            'address' => ['required']
        ]);

        $data['order_area_id'] = Request::input('area'); //.",".Request::input('state')
        $data['user_id'] = Request::input('user_id');
        $data['set_default'] = filled(Request::input('isPrimary'));

        Address::create($data);
        return response()->json(['message' => 'Area Deleted...']);
    }




}
