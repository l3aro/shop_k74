<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;

class CartController extends Controller
{
    public function index() {
        $carts = Cart::getContent();
        return view('client.cart', compact('carts'));
    }

    public function checkout() {
        return 'Thanh toán';
    }

    public function complete() {
        return 'Thành công';
    }

    public function add(Request $request)
    {
        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => [
                'size' => $request->size,
                'color' => $request->color
            ]
        ]);

        return back();
    }

    public function update(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            // key contains product_id to update
            // value contains quantity to update
            Cart::update($key, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $value
                ),
            ));
        }

        $carts = Cart::getContent();
        return view('client.table_cart', compact('carts'))->render();
    }

    public function remove(Request $request)
    {
        Cart::remove($request->id);

        $carts = Cart::getContent();
        return view('client.table_cart', compact('carts'))->render();
    }
}
