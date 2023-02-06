<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\orderDetails;
use App\Models\Shipping;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;

class CheckoutController extends Controller
{
    public function checkout()
    {

        $carts = Cart::all();
        $count = count($carts);
        if (!(session()->has('LoggedUser') && $count > 0)) {
            return redirect()->route('view-user-login');
        }
        return view('client.checkout', compact('carts', 'count'));
    }

    public function shipping(Request $request)
    {
        $request->validate([
                'name' => 'required',
                'phone' => 'required|numeric',
                'address' => 'required',
                'email' => 'required|email',
            ]
        );
        $carts = Cart::all();
        $shipping = new Shipping();
        $shipping->name = $request->name;
        $shipping->phone = $request->phone;
        $shipping->address = $request->address;
        $shipping->email = $request->email;
        $shipping->method = $request->payments;
        $shipping->save();
        if ($shipping) {
            $order_code = rand(0, 9999);
            $order = new Order();
            $order->order_code = $order_code;
            $order->status = 1;
            $order->ship_id = $shipping->id;
            $order->save();
            foreach ($carts as $cart) {
                $order_details = new orderDetails();
                $order_details->order_code = $order_code;
                $order_details->id_product = $cart->id_product;
                $order_details->quantity = $cart->quantity;
                $order_details->save();
            }
            Cart::truncate();
        }
        return redirect()->route('thank');
    }

    public function thank()
    {
        return view('client.thank');
    }
}
