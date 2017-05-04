<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CheckoutAddressRequest extends FormRequest
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
        $new_address_rules = [
            'name' => 'required',
            'detail' => 'required',
            'province_id' => 'required|exists:provinces,id',
            'regency_id' => 'required|exists:regencies,id',
            'phone' => 'required|digits_between:9,15'
        ];

        if (Auth::check()) {
          $address_limit = implode(',', Auth::user()->addresses->pluck('id')->all()) . ',new-address';
          $rules = ['address_id' => 'required|in:' . $address_limit];
          if ($this->get('address_id') == 'new-address') {
            return $rules += $new_address_rules;
        }
            return $rules;
        }

        return $new_address_rules;
    }
}
