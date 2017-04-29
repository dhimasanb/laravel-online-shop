<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class CatalogsController extends Controller
{
    public function index(Request $request)
    {
      $q = $request->get('q');
      if ($request->has('cat')) {
        $cat = $request->get('cat');
        $category = Category::findOrFail($cat);
        // we use this to get product from current category and its child
        $products = Product::whereIn('id', $category->related_products_id)
        ->where('name', 'LIKE', '%'.$q.'%');
      } else {
        $products = Product::where('name', 'LIKE', '%'.$q.'%');
      }
      return view('catalogs.index', compact('products', 'cat', 'category', 'q'));
    }
}
