<?php
namespace App\Classes;
use App\Order;
use App\Product;

use App\Mail\SendEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class Basket{

    public $order;

    /**
     *Basket constructor
     */
    public function __construct($orderIsCreate = false)
    {
        $orderId = session('orderId');

        if (is_null($orderId) && $orderIsCreate){
            $user = [];
            if(Auth::check())
            {
                $user['user_id'] = Auth::id();
            }
            $this->order = Order::create($user);
            session(['orderId'=>$this->order->id]);
        } else {
            $this->order = Order::findOrFail($orderId);
        }
    }

    /**
     * @return mixed
     */


    public function getOrder()
    {
        return $this->order;
    }

    public function countAvailable($updateCount=false)
    {
        foreach($this->order->products as $orderWithProduct) {
            if($orderWithProduct->count < $this->getPivot($orderWithProduct)->count){
                return false;
            }
            if($updateCount) {
// Минусуем из общего числа продукта
                $orderWithProduct->count -= $this->getPivot($orderWithProduct)->count;
            }
        }
        if($updateCount){
            $this->order->products->map->save();
        }
        return true;
    }

    public function saveOrder($name, $phone, $address,
                              $comment, $apartment, $floor,
                              $date, $time, $payment_spot, $payment_transfer, $email)
    {
        if(!$this->countAvailable(true)){
            return false;
        }
//        Mail::to($email)->send(new SendEmail($name,$this->getOrder()));

        return $this->order->saveOrder($name, $phone, $address,
            $comment, $apartment, $floor,
            $date, $time, $payment_spot, $payment_transfer);
    }
//
    protected function getPivot($product)
    {
        return $this->order->foods()->where('food_id', $product->id)->first()->pivot;
    }

//Для удаление товара
    public function removeProduct($product)
    {
        if ($this->order->foods->contains($product->id)) {
            $pivotRow = $this->getPivot($product);
            if ($pivotRow->count < 2){
                $this->order->foods()->detach($product->id);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
    }


//Для добавление товара в корзину
    public function addProduct($product)
    {
        if ($this->order->foods->contains($product->id)) {

            $pivotRow = $this->getPivot($product);
            $pivotRow->count++;

            if($pivotRow->count > $product->count ){
                return false;
            }
            $pivotRow->update();
        } else {
            if($product->count == 0){
                return false;
            }

            $this->order->foods()->attach($product->id, ['admin_id'=>$product->user_id]);
        }
        return true;
    }
}
