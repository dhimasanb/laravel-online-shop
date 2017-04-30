<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     public function rules()
     {
         return [
             'email'             => 'required|email',
             'is_guest'          => 'required|in:0,1',
             'checkout_password' => 'required_if:is_guest,0',
         ];
     }

     public function messages()
     {
         return [
             'email.required'                => 'Email harus diisi',
             'checkout_password.required_if' => 'Password harus diisi jika Anda adalah pelanggan tetap',
         ];
     }
}
