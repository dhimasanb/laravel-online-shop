<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Session;
use App\Support\CartService;
use Flash;
use Auth;
use App\Cart;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function addProduct(Request $request)
     {
         $this->validate($request, [
             'product_id' => 'required|exists:products,id',
             'quantity' => 'required|integer|min:1'
         ]);

         $product = Product::find($request->get('product_id'));
         $quantity = $request->get('quantity');
         Session::flash('flash_product_name', $product->name);

         if (Auth::check()) {
            $cart = Cart::firstOrCreate([
                'product_id' => $product->id,
                'user_id' => $request->user()->id
            ]);
            $cart->quantity += $quantity;
            $cart->save();
            return redirect('catalogs');
        } else {
            $cart = $request->cookie('cart', []);
            if (array_key_exists($product->id, $cart)) {
                $quantity += $cart[$product->id];
            }
            $cart[$product->id] = $quantity;
            return redirect('catalogs')
                ->withCookie(cookie()->forever('cart', $cart));
        }
     }

    public function show()
    {
        return view('carts.index');
    }

    public function removeProduct(Request $request, $product_id)
    {
        $cart = $this->cart->find($product_id);
        if (!$cart) return redirect('cart');

        Flash::success($cart['detail']['name'] . ' berhasil dihapus dari cart.');

        if (Auth::check()) {
            $cart = Cart::firstOrCreate([
                'product_id' => $product_id,
                'user_id' => $request->user()->id
            ]);
            $cart->delete();
            return redirect('cart');
        } else {
            $cart = $request->cookie('cart', []);
            unset($cart[$product_id]);
            return redirect('cart')
                ->withCookie(cookie()->forever('cart', $cart));
        }
    }

    public function changeQuantity(Request $request, $product_id)
    {
        $this->validate($request, ['quantity' => 'required|integer|min:1']);
        $quantity = $request->get('quantity');
        $cart = $this->cart->find($product_id);
        if (!$cart) return redirect('cart');

        \Flash::success('Jumlah order untuk ' . $cart['detail']['name'] . ' berhasil dirubah.');

        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id'=>$request->user()->id, 'product_id'=>$product_id]);
            $cart->quantity = $quantity;
            $cart->save();
            return redirect('cart');
        } else {
            $cart = $request->cookie('cart', []);
            $cart[$product_id] = $quantity;
            return redirect('cart')
                ->withCookie(cookie()->forever('cart', $cart));
        }
    }
}
