<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\orderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Session;

class OrderController extends Controller
{
    public function Order()
    {
        $orders1 = Order::all();
        return view('admin.order.viewOrder', [
            'orders' => $orders1,
        ]);
    }

    public function orderDetails($order_code)
    {
        $orderDetails = DB::table('order_details')
            ->join('product', 'order_details.id_product', '=', 'product.id')
            ->select('*')
            ->where('order_code', $order_code)
            ->get();
        return view('admin.order.orderDetails', compact('orderDetails'));
    }

    public function orderDelete($id)
    {
        $order = Order::find($id);
        $order->delete();
        if ($order) {
            $order_code = $order->order_code;
            $orderdetails = orderDetails::where('order_code', $order_code)->get();
            foreach ($orderdetails as $id_orderdetails) {
                orderDetails::where('id', $id_orderdetails['id'])->delete();
            }
        }
        $orders = Order::all();
        session()->flash('success2', 'Delete order success');
        return view('admin.order.viewOrder', compact('orders'));
    }
}
