<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Regency;
use Illuminate\Validation\ValidationException;

class AddressController extends Controller
{
    public function regencies(Request $request)
    {
        try {
            $this->validate(
                $request,
                [
                    'province_id' => 'required|exists:provinces,id'
                ]
            );
        } catch (ValidationException $e) {
        }

        return Regency::where('province_id', $request->get('province_id'))
            ->get();
    }
}
