<?php

namespace App\Http\Middleware;

use Closure;

class CheckoutAddressStepDone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
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
