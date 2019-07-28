<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Order_detail;
use App\Product;
use App\Charts\OrderChart;
use App\Charts\ProductChart;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->with('order_detail');
        $products = Product::orderBy('created_at', 'DESC')->with('hpp');
        $order_details = Order_detail::orderBy('qty', 'DESC')->get();

        $today_orders = Order::whereDate('created_at', today())->count();
        $yesterday_orders = Order::whereDate('created_at', today()->subDays(1))->count();
        $orders_2_days_ago = Order::whereDate('created_at', today()->subDays(2))->count();

        $chart = new OrderChart;
        $chart->labels(['2 days ago', 'Yesterday', 'Today']);
        $chart->dataset('My dataset', 'doughnut', [$orders_2_days_ago, $yesterday_orders, $today_orders]);






        return view('dashboards.index',[
            'chart' => $chart,
            'order' => $orders,
            'product' => $products,
            'order_detail' => $order_details
        ]);
    }

}
