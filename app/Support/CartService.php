<?php

namespace App\Support;

use App\Product;
use Illuminate\Http\Request;
use Auth;
use App\Cart;
use Cookie;

class CartService {

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function lists()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::user()->id)
                ->pluck('quantity', 'product_id');
        } else {
            return $this->request->cookie('cart');
        }
    }

    public function totalProduct()
    {
        return count($this->lists());
    }

    public function isEmpty()
    {
        return $this->totalProduct() < 1;
    }

    public function totalQuantity()
    {
        $total = 0;
        if ($this->totalProduct() > 0) {
            foreach ($this->lists() as $id => $quantity) {
                $product = Product::find($id);
                $total += $quantity;
            }
        }
        return $total;
    }

    public function details()
    {
        $result = [];
        if ($this->totalProduct() > 0) {
            foreach ($this->lists() as $id => $quantity) {
                $product = Product::find($id);
                array_push($result, [
                    'id' => $id,
                    'detail' => $product->toArray(),
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity
                ]);
            }
        }

        return $result;
    }

    public function totalPrice()
    {
        $result = 0;
        foreach ($this->details() as $order) {
            $result += $order['subtotal'];
        }
        return $result;
    }

    public function find($product_id)
    {
        foreach ($this->details() as $order) {
            if ($order['id'] == $product_id) return $order;
        }
        return null;
    }

    public function merge()
    {
        $cart_cookie = $this->request->cookie('cart', []);
        foreach ($cart_cookie as $product_id => $quantity) {
            $cart = Cart::firstOrCreate([
                'user_id' => $this->request->user()->id,
                'product_id' => $product_id]);
            $cart->quantity = $cart->quantity > 0 ? $cart->quantity : $quantity;
            $cart->save();
        }

        return Cookie::forget('cart');
    }

}
