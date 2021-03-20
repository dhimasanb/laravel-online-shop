<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckoutLoginStepDone
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next)
     {
         if (auth()->guest() && !session()->has('checkout.email')) {
            return redirect('checkout/login');
         }
         
         return $next($request);
     }
}
