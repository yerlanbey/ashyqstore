<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Product;
use App\Order_Product;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Collection;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

    }

    public function AdminHome()
    {
      $orders = Order::where('status',1)->paginate(20);

      return view('auth.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
      $products = $order->products()->get();
      return view('auth.orders.show',compact('order','products'));
    }
}
