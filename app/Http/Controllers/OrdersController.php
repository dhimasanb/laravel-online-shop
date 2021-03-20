<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Http\Response;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return Application|Factory|View|Response
     */
     public function index(Request $request)
     {
        $status = $request->get('status');
        $orders = Order::where('status', 'LIKE', '%'.$status.'%');
        if ($request->has('q')) {
            $q = $request->get('q');
            $orders = $orders->where(function($query) use ($q) {
                $query->where('id', $q)
                    ->orWhereHas('user', function($user) use ($q) {
                        $user->where('name', 'LIKE', '%'.$q.'%');
                    });
            });
        }
        // dd($orders->toSql());

        $orders = $orders->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders', 'status', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View|Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return view('orders.edit')->with(compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
