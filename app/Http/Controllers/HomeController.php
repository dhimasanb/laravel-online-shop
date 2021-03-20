<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only'=>['index', 'viewOrders']]);
        $this->middleware('role:customer', ['only' => 'viewOrders']);
    }

    /**
     * Show the application dashboard.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        return view('home');
    }

    public function viewOrders(Request $request)
    {
        $q = $request->get('q');
        $status = $request->get('status');
        $orders = auth()->user()->orders()
            ->where('id', 'LIKE', '%'. $q . '%')
            ->where('status', 'LIKE', '%' . $status . '%')
            ->orderBy('updated_at')
            ->paginate(5);
        return view('customer.view-orders')->with(compact('orders', 'q', 'status'));
    }
}
