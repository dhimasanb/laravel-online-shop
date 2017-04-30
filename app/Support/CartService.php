<?php

namespace App\Support;

use App\Product;
use Illuminate\Http\Request;

class CartService {

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function lists()
    {
        return $this->request->cookie('cart');
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

}
