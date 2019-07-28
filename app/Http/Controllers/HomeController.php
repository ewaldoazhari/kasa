<?php
namespace App\Http\Controllers;

use App\Outlet;
use ConsoleTVs\Charts\Classes\Highcharts\Chart;
use Illuminate\Http\Request;
use App\Product;
use App\Customer;
use App\Order;
use App\Order_detail;
use App\Employee;
use Carbon\Carbon;
// use Cookie;
use DB;
use App\Charts\OrderChart;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
//        $product = Product::count();
//        $order_detail = Order_detail::paginate(1);
//        $outlet = Outlet::count();
        // $customer = Customer::count();
        // $employee = Employee::count();
        // return view('home', compact('product', 'order', 'customer', 'employee','outlet'));

//        $employees = Employee::role('kasir')->orderBy('name', 'DESC')->get();
        $outlets = Outlet::orderBy('outlet','DESC')->get();
        $orders = Order::orderBy('created_at', 'DESC')->with('order_detail');
        $products = Product::orderBy('created_at', 'DESC')->with('hpp');
        $order_details = Order_detail::orderBy('qty', 'DESC')->get();


        if (!empty($request->outlet_id)) {
            $orders = $orders->where('outlet_id', $request->outlet_id);
            $order_details = $order_details->where('outlet_id', $request->outlet_id);
        }

        if (!empty($request->start_date) && !empty($request->end_date)) {
            $this->validate($request, [
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date'
            ]);
            $start_date = Carbon::parse($request->start_date)->format('Y-m-d') . ' 00:00:01';
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d') . ' 23:59:59';

            $orders = $orders->where('created_at', '>=', $start_date)->where('created_at', '<', $end_date);
            $order_details = $order_details->where('created_at', '>=', $start_date)->where('created_at', '<', $end_date);
        }
//////chart
        $orders = \App\Order::all();
        $profits = [];
        $total = [];
        foreach ($orders as $order)
        {
            $profits[] = $order->created_at;
            $total[] = $orders->pluck('total')->all();


        }




        return view('home', [
            'orders' => $orders,
            'order_details'=>$order_details,
            'sold' => $this->countItem($orders),
            'hpp' => $this->countHpp($order_details),
            'transaction' => $this->countTransaction($order_details),
            'total' => $this->countTotal($orders),
            'profit'=> $this->countProfit($order_details),
//            'total_customer' => $this->countCustomer($orders),
//            'customers' => $customers,
            'products' => $products,

            'outlets' => $outlets,
            'profits' => $profits


        ]);

    }



    private function countTotal($orders)
    {
        $total = 0;
        if ($orders->count() > 0) {
            $sub_total = $orders->pluck('total')->all();
            $total = array_sum($sub_total);
        }
        return $total;
    }

    private function countItem($order)
    {
        $data = 0;
        if ($order->count() > 0) {
            foreach ($order as $row) {
                $qty = $row->order_detail->pluck('qty')->all();
                $val = array_sum($qty);
                $data += $val;
            }
        }
        return $data;
    }

    private function countHpp($order_details)
    {
        $total = 0;
        if ($order_details->count() > 0) {
            $sub_total = $order_details->pluck('hpp')->all();
            $total = array_sum($sub_total);
        }
        return $total;
    }

    private function countProfit($order_details)
    {
        $total = 0;
        if ($order_details->count() > 0) {
            $sub_total = $order_details->pluck('profit')->all();
            $total = array_sum($sub_total);
        }
        return $total;
    }


    private function countTransaction($order_details)
    {
        $id = [];
               if ($order_details->count() > 0) {
                   foreach ($order_details as $row) {
                       $id[] = $row->id;
                   }
               }
               return count(array_unique($id));
    }

    public function getChart()
    {
        $start = Carbon::now()->subWeek()->addDay()->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::now()->format('Y-m-d') . ' 23:59:00';

        $order_detail = Order_detail::select(DB::raw('date(created_at) as order_detail_date'), DB::raw('count(*) as profit_order_detail'))
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('created_at')
            ->get()->pluck('profit_order_detail', 'order_detail_date')->all();

        for ($i = Carbon::now()->subWeek()->addDay(); $i <= Carbon::now(); $i->addDay()) {
            if (array_key_exists($i->format('Y-m-d'), $order_detail)) {
                $data[$i->format('Y-m-d')] = $order_detail[$i->format('Y-m-d')];
            } else {
                $data[$i->format('Y-m-d')] = 0;
            }
        }
        return response()->json($data);
    }


}
