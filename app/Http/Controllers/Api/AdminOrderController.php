<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(){
        $orders = Order::query()
            ->with(['orderdetails', 'orderdetails.product','orderdetails.stoke', 'customer', 'address.orderArea'])
            ->latest()
            ->paginate(20);
        return response()->json([
            'orders' => $orders
        ]);
    }
}
