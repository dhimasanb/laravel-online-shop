<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckoutPaymentStepDone
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
         if (!session()->has('order')) {
            return redirect('checkout/payment');
         }
         
         return $next($request);
     }
}
