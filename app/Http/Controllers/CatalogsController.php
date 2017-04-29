<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CatalogsController extends Controller
{
    public function index()
    {
        $products = Product::paginate(4);
        return view('catalogs.index', compact('products'));
    }
}
