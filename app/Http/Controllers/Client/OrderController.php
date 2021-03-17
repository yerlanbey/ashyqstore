<?php

namespace App\Http\Controllers\Client;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
class OrderController extends Controller
{
  public function AdminHome(){
    $orders = Auth::user()->orders()->where('status',1)->paginate(20);
    return view('auth.orders.index',compact('orders'));
  }

  public function show(Order $order){
    $products = $order->products()->get();
    return view('auth.orders.show',compact('order','products'));
  }
}
