<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckoutLoginRequest;
use Illuminate\Support\MessageBag;
use App\User;
use App\Http\Requests\CheckoutAddressRequest;
use Auth;

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
              $errors = new MessageBag();
              $errors->add('checkout_password', 'Alamat email "' . $email . '" sudah terdaftar, silahkan masukan password.');
              // redirect and change is_guest value
              return redirect('checkout/login')->withErrors($errors)
                  ->withInput(compact('email') + ['is_guest' => 0]);
            }
            // (B) Logic ketika email di DB tanpa password
            // show view to request new password
            session()->flash('email', $email);
            return view('checkout.reset-password');
        }
        // (C) Logic ketika email tidak ada di DB
        // save user data to session
        session(['checkout.email' => $email]);
        return redirect('checkout/address');
    }

    protected function authenticatedCheckout($email, $password)
    {
        return 'logic untuk authenticated checkout belum dibuat';
    }

    public function address()
    {
        return view('checkout.address');
    }

    public function postAddress(CheckoutAddressRequest $request)
    {
        if (Auth::check()) return $this->authenticatedAddress($request);
        return $this->guestAddress($request);
    }

    protected function authenticatedAddress(CheckoutAddressRequest $request)
    {
        return "Akan diisi untuk logic authenticated address";
    }

    protected function guestAddress(CheckoutAddressRequest $request)
    {
        $this->saveAddressSession($request);
        return redirect('checkout/payment');
    }

    protected function saveAddressSession(CheckoutAddressRequest $request)
    {
        session([
            'checkout.address.name' => $request->get('name'),
            'checkout.address.detail' => $request->get('detail'),
            'checkout.address.province_id' => $request->get('province_id'),
            'checkout.address.regency_id' => $request->get('regency_id'),
            'checkout.address.phone' => $request->get('phone')
        ]);
    }

    public function payment()
    {
        return view('checkout.payment');
    }

    public function postPayment(Request $request)
    {
        $this->validate($request, [
            'bank_name' => 'required|in:' . implode(',',array_keys(config('bank-accounts'))),
            'sender' => 'required'
        ]);

        session([
            'checkout.payment.bank' => $request->get('bank_name'),
            'checkout.payment.sender' => $request->get('sender')
        ]);

        if (Auth::check()) return $this->authenticatedPayment($request);
        return $this->guestPayment($request);
    }
}
