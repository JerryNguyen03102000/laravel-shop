<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use \App\Models\Cart;

class CartController extends Controller
{
    public function add_cart(Request $request)
    {
        $id_product = $request->id_product;
        $quantity = $request->quantity;
        $product = Product::where('id', $id_product)->get();
        $set_carts = Cart::where('id_product', $id_product)->get();
        $count = count($set_carts);
        if ($count > 0) {
            //    nếu sản phẩm đã tồn tại thì sẽ update số luọng
            foreach ($set_carts as $value) {
                Cart::where('id_product', $id_product)->update(['quantity' => $value->quantity + $quantity]);
            }
        } else {
            // thêm sản phẩm vào cart
            foreach ($product as $value) {
                $cart = new Cart();
                $cart->title = $value['title'];
                $cart->image = $value['image'];
                $cart->quantity = $quantity;
                $cart->price = $value['price'];
                $cart->id_product = $value['id'];
                $cart->save();

            }
        }
        return redirect()->route('show_cart');
    }
    public function show_cart(){
        $carts = Cart::all();
        $count = count($carts);
        return view('client.show_cart',compact('carts','count'));
    }
    public function delete_cart($id){
        $cart = Cart::find($id);
        $cart->delete();
        return redirect($_SERVER['HTTP_REFERER']);
    }
    public function update_qty_cart( Request $request ,$id){
        $cart = Cart::find($id);
        $cart->quantity = $request->quantity;
        $cart->save();
        return redirect()->route('show_cart');
    }
    public function deleteAllCart(){
        $deleteAll = Cart::truncate();
        return redirect()->route('show_cart');
    }
}
