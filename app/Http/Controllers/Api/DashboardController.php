<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
class DashboardController extends Controller
{
    public function index(){
        $orderData = Order::selectRaw('MONTHNAME(created_at) as month, SUM(grand_total) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderByRaw("FIELD(month, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December') ASC")
            ->get();



        // Transform the query results into a format that can be used by VueApexCharts
        $data = [];
        foreach ($orderData as $order) {
            $data[] = [
                'x' => $order->month,
                'y' => $order->total,
            ];
        }


        $userCounts = DB::table('users')
            ->select(DB::raw("DATE_FORMAT(created_at, '%M') as month"), DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderByRaw("FIELD(month, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December') ASC")
            ->get();



        $userData = [];
        foreach ($userCounts as $user) {
            $userData[] = [
                'x' => $user->month,
                'y' => $user->count,
            ];
        }


        $dashboardData = [
            'totalSeals' => Order::where('order_status', 'delivered')->sum('grand_total'),
            'totalOrder' => Order::where('order_status', 'delivered')->count(),
            'thisMonthOrder' => Order::whereMonth('created_at', Carbon::now()->month)->where('order_status', 'delivered')->count(),
            'thisMonthSeals' => Order::whereMonth('created_at', Carbon::now()->month)->where('order_status', 'delivered')->sum('grand_total'),


            'totalCustomer' => User::where('role', 'customer')->count(),
            'thisMonthCustomer' => User::whereMonth('created_at', Carbon::now()->month)->where('role', 'customer')->count(),


            'totalProducts' => ProductStock::count(),
            'stokeProducts' => ProductStock::where('qty', '>', 5)->count(),
            'orderChart' => $data
        ];

        return response()->json($dashboardData);
    }
}
