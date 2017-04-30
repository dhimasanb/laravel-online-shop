<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckoutLoginRequest;
use Illuminate\Support\MessageBag;
use App\User;

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

    protected function guestCheckout($email)
    {
        // check if user exist, if so, ask login
        if ($user = User::where('email', $email)->first()) {
            if ($user->hasPassword()) {
            // (A) Logic ketika email ada di DB dengan password
            }
            // (B) Logic ketika email di DB tanpa password
        }
        // (C) Logic ketika email tidak ada di DB
    }

    protected function authenticatedCheckout($email, $password)
    {
        return 'logic untuk authenticated checkout belum dibuat';
    }
}
