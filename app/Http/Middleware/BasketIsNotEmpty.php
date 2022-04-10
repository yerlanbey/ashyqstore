<?php

namespace App\Http\Middleware;
use App\Order;
use Closure;
use Illuminate\Support\Facades\DB;

class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $orderId= session('orderId');
      if (!is_null($orderId)){
        $order = Order::findOrFail($orderId);
        $element = DB::table('api_element_order')->where('order_id', $orderId)->value('count');

        if($order->foods->count() > 0 || $element > 0){
          return $next($request);

        }
      }
      session()->flash('warning','Ваша корзина пуста!');
      return redirect()->route('index-html');
    }
}
