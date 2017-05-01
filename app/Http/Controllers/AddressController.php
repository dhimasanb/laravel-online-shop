<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Regency;

class AddressController extends Controller
{
    public function regencies(Request $request)
    {
        $this->validate($request, [
            'province_id' => 'required|exists:provinces,id'
        ]);

        return Regency::where('province_id', $request->get('province_id'))
            ->get();
    }
}
