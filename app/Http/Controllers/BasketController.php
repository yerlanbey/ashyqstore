<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;

class BasketController extends Controller {

    /**
     * @var $host
     */
    public $host;

    /**
     * @var $token
     */
    public $token;

    public function __construct()
    {
        $this->host = config('product-list-api')['host'];
        $this->token = config('product-list-api')['access-token'];
    }

    /**
     * @var $order
     */
    private $order;

    public function BasketChecking()
    {
        $order = (new Basket())->getOrder();
        $products = $order->products()->get()->toArray();
        $elements = DB::table('api_element_order')->where('order_id', $order->id)->pluck('element_id')->toArray();
        $elementsId = implode(',', $elements);
        $endpoint = Http::get("$this->host/element-info?$this->token&article=$elementsId&additional_fields=images")->json();
        $orders = array_merge($products, $endpoint);
        return view('basket',compact('orders'));
    }
    public function OrderConfirm(Request $request)
    {
        foreach (['payment_spot','payment_transfer'] as $fieldQuery){
            if (isset($request[$fieldQuery])){
                $request[$fieldQuery] = 1;
            }else{
                $request[$fieldQuery] = 0;
            }
        }
        $email = Auth::check() ? Auth::user()->email : $request->email;
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

    /**
     * @param $elementId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addElementToBasket($elementId)
    {
        $this->checkOrder();
        $orderId = session('orderId');
        $table = DB::table('api_element_order');
        if ($table->where('element_id', $elementId)->exists() && !is_null($orderId)) {
            $count = $table->where('element_id', $elementId)->value('count');
            $table->update(['count' => $count+=1]);
        } else {
            $table->insert([
                'order_id'   => $this->order->id,
                'element_id' => $elementId,
                'count'      => 1
            ]);
        }

        return redirect()->back()->with('success', 'Вы добавили в корзину товар');
    }

    /**
     * @param $elementId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function dropElementFromBasket($elementId)
    {
        $table = DB::table('api_element_order');

        if ($table->where('element_id', $elementId)->value('count') > 1) {
            $count = $table->where('element_id', $elementId)->value('count');
            $table->update(['count' => $count-=1]);
        } else {
            $table->where('element_id', $elementId)->delete();
        }

        return redirect()->back()->with('warning', 'Вы удалили товар с корзины');
    }

    private function checkOrder()
    {
        $orderId = session('orderId');

        if (is_null($orderId)){
            $user = [];
            if(Auth::check())
            {
                $user['user_id'] = Auth::id();
            }
            $this->order = Order::create($user);
            session(['orderId'=>$this->order->id]);
        } else {
            $this->order = Order::findOrFail($orderId) ?? session('orderId')->flush();

        }
    }
}
