<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Order_detail;
use App\Outlet;
use Illuminate\Http\Request;
use App\Exports\OrderInvoice;
use Carbon\Carbon;
use App\Customer;
use App\Product;
use App\Order;
use App\User;

use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\PDF;

class SalesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $employees = Employee::role('kasir')->orderBy('name', 'DESC')->get();
        $outlets = Outlet::orderBy('outlet','DESC')->get();
        $products = Product::orderBy('created_at', 'DESC')->with('hpp');
        $order_details = Order_detail::orderBy('created_at', 'DESC')->get();
        $orders = Order::orderBy('created_at', 'DESC')->with('order_detail');

        $testdata = Order_detail::orderBy('created_at', 'DESC')->paginate(10);

        if (!empty($request->outlet_id)) {
            $orders = $orders->where('outlet_id', $request->outlet_id);
            $order_details = $order_details->where('outlet_id','DESC', $request->outlet_id);
            $orders = Order::where('outlet_id', $request->outlet_id)->with('order_detail');
            $testdata = Order_detail::where('outlet_id', $request->outlet_id)->paginate(10);
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
            $testdata = Order_detail::where('created_at', '>=', $start_date)->where('created_at', '<', $end_date)->paginate(10);
        }

        // dd(auth()->user()->role_id == 2);

        // if(auth()->user()->role_id == 2){
        //     $outlets = Outlet::where('user_id', auth()->user()->id)->orderBy('outlet','DESC')->get();
        //     $idOutltes = [];
        //     foreach($outlets as $outlet){
        //         array_push($idOutltes,$outlet->id);
        //     }
        //     $orders = Order::whereIn('outlet_id', $idOutltes)->orderBy('created_at', 'DESC')->with('order_detail');
        //     $order_details = Order_detail::whereIn('outlet_id', $idOutltes)->orderBy('created_at', 'DESC')->get();
        //     $testdata = Order_detail::whereIn('outlet_id', $idOutltes)->orderBy('created_at', 'DESC')->paginate(10);

        //     if (!empty($request->outlet_id)) {
        //         $order_details = $order_details->where('outlet_id','DESC', $request->outlet_id);
        //         $orders = Order::where('outlet_id', $request->outlet_id)->with('order_detail');
        //         $testdata = Order_detail::where('outlet_id', $request->outlet_id)->paginate(10);
        //     }
        // }

        return view('sales.index', [
            'orders' => $orders,
            'testdata' => $testdata,
            'order_details'=>$order_details,
            'sold' => $this->countItem($order_details),
            'transaction' => $this->countTransaction($order_details),
            'total' => $this->countTotal($orders),
            'profit'=> $this->countProfit($order_details),
            'products' => $products,
            'employees' => $employees,
            'outlets' => $outlets
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



    private function countItem($order_details)
    {
        $total = 0;
        if ($order_details->count() > 0) {
            $sub_total = $order_details->pluck('qty')->all();
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

    public function invoicePdf($invoice)
    {
        $order = Order::where('invoice', $invoice)
            ->with('customer', 'order_detail', 'order_detail.product')->first();
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->loadView('orders.report.invoice', compact('order'));
        return $pdf->stream();
    }

    public function invoiceExcel($invoice)
    {
        return (new OrderInvoice($invoice))->download('invoice-' . $invoice . '.xlsx');
    }
}
