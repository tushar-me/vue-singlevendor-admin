<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\Pos;
use App\Models\Product;
use App\Models\ProductStock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        return response()->json(Pos::all());
    }
    public function store(Request $request)
    {

//        if need customer address with delivery charge.
//        $address = Address::with('orderArea')->findOrFail($request->addressId);
//        $grandTotal = $address->orderArea->delivery_charge + $request->orderTotal;

        $request->validate([
            'customer' => 'required|integer',
            'payby' => 'required'
        ]);


        $order = Order::create([
            'user_id' => $request->input('customer'),
            'payment_method' => $request->input('payby'),
            'sub_total' => $request->input('subTotal'),
            'grand_total' => $request->input('subTotal'),
            'order_date' => Carbon::now(),
            'order_type' => 'pos'
        ]);

        $orderDetails = [];
        foreach ($request->input('products') as $key => $item){
            $orderDetails[] =[
                'order_id' => $order->id,
                'product_id' => $item['product']['id'],
                'product_stock_id' => $item["id"],
                'quantity' => $item["buyQty"]
            ];

            $stock = ProductStock::where('id', $item["id"])->first();
            $stock->qty = $stock->qty - $item["buyQty"];
            $stock->save();
        }
        $order->orderdetails()->createMany($orderDetails);

        return response()->json(['message' =>'Order Pleased...'], 200);

    }
    public function incrementProductQty($id){

        $cartInfo = Pos::findOrFail($id);
        $proId =  $cartInfo->product_id;
        $product = Product::findOrFail($proId);

        if ($product->stock != 0){
            if ($product->stock <= $cartInfo->quantity){
                return response()->json(['message' =>'Minimum qty is lesthen or equal '.$product->stock], 500);
            }else{
                $cartInfo->increment('quantity');
                $subTotal = $cartInfo->quantity * $cartInfo->price;
                $cartInfo->update([
                    'sub_total' => $subTotal
                ]);
                return response()->json(['message' =>'Update To Cart'], 200);
            }
        }else{
            return response()->json(['message' =>'Product Minimum quantity is not available'], 500);
        }


    }
    public function decrementProductQty($id){
        $cartProduct = Pos::findOrFail($id);
        if ($cartProduct->quantity <= 1){
            return response()->json(['message' =>'Minimum Qty is 1'], 500);
        }else{
            $cartProduct->decrement('quantity');
            $subTotal = $cartProduct->quantity * $cartProduct->price;
            $cartProduct->update([
                'sub_total' => $subTotal
            ]);
            return response()->json(['message' =>'Update To Cart'], 200);
        }
    }
    public function show(Pos $pos)
    {
        //
    }
    public function update(Request $request, Pos $pos)
    {
        //
    }
    public function destroy(Pos $pos)
    {
        return $pos;
//        $pos->delete();
//        return response()->json(['message' =>'Product Delete Form Cart'], 200);
    }

    public function deleteItem($id){
        $posItem = Pos::findOrFail($id);
        $posItem->delete();
        return response()->json(['message' =>'Product Delete Form Cart'], 200);
    }
}
