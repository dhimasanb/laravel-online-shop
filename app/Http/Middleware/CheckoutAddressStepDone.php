<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckoutAddressStepDone
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
         if (!session()->has('checkout.address')) {
            return redirect('checkout/address');
         }

         return $next($request);
     }
}
