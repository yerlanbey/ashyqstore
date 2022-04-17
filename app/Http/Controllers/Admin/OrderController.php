<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AdminHome()
    {
      $orders = Order::where('status',1)->paginate(20);

      return view('auth.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        dd(ca);
      $products = $order->foods()->get();

      return view('auth.orders.show',compact('order','products'));
    }
}
