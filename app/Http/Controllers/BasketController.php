<?php

namespace App\Http\Controllers;
use App\Classes\Basket;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
class BasketController extends Controller

{
   public function BasketChecking(){
     $order = (new Basket())->getOrder();
     return view('basket',compact('order'));
   }
   public function OrderConfirm(OrderRequest $request){
       foreach (['payment_spot','payment_transfer'] as $fieldQuery){
           if (isset($request[$fieldQuery])){
               $request[$fieldQuery] = 1;
           }else{
               $request[$fieldQuery] = 0;
           }
       }
     $email = Auth::check() ? Auth::user()->email : $request->email;
     //проверяем зареганный ли пользователь или нет если зареган получаем его
       // имэйл если нет то те данные который передал пользователь
     $success = (new Basket())->
     saveOrder($request->name, $request->phone, $request->address, $request->comment,
         $request->apartment,$request->floor,
         $request->date,$request->time,$request->payment_spot, $request->payment_transfer, $email);

     if ($success) {
        session()->flash('success','Ваш заказ принят в обработку');
     } else {
       session()->flash('warning','Ошибка проверьте ваш заказ');
     }
     return redirect()->route('index-html');
   }

   public function OrderArrange(){
     $basket = new Basket();
     $order = $basket->getOrder();
     if (!$basket->countAvailable()){
       session()->flash('warning','Товар не доступен в полном обьеме!');
       return redirect()->route('basket-check');
     }
     return view('order',compact('order'));
   }


   public function basketAdd(Product $product){
    $success =  (new Basket(true))->addProduct($product);
    if ($success){
      session()->flash('success','Добавлен товар ' . $product->name);
    } else {
      session()->flash('warning','Товар ' . $product->name . ' в большем количестве не доступен!');
    }

     return redirect()->route('basket-check');
   }

   public function basketRemove(Product $product){
     $order = (new Basket())->getOrder();
     (new Basket())->removeProduct($product);
     session()->flash('warning','Удален товар ' . $product->name);
     return redirect()->route('basket-check');
   }

   public function OrderDelete($order_id){
     $order = Order::findOrFail($order_id);
     $success = $order->delete();
     if($success){
         return redirect()->route('home')->with('success', 'Вы удалили заказ '.$order->name);
     }else{
         return redirect()->route('home')->with('warning', 'Упс, что-то пошло не так повторите попытку!');
     }
     return redirect()->route('home');
   }


 }
