<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckoutLoginRequest;

class CheckoutController extends Controller
{
    public function login()
    {
        return view('checkout.login');
    }

    public function postLogin(CheckoutLoginRequest $request)
    {
        $email = $request->get('email');
        $password = $request->get('checkout_password');
        $is_guest = $request->get('is_guest') > 0;

        if ($is_guest) {
            return $this->guestCheckout($email);
        }

        return $this->authenticatedCheckout($email, $password);
    }

    protected function authenticatedCheckout($email, $password)
    {
        return 'logic untuk authenticated checkout belum dibuat';
    }
}
