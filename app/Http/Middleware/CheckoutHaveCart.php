<?php

namespace App\Http\Middleware;

use Closure;
use App\Support\CartService;

class CheckoutHaveCart
{
    protected $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     
    public function handle($request, Closure $next)
    {
        if ($this->cart->isEmpty()) return redirect('cart');
        return $next($request);
    }
}
