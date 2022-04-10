@extends('layouts.app')
@section('title')
    Корзина
@endsection

@section('content')
    <section class="cart_area">
        <div class="container">
            <div class="starter-template">
                <div style="text-align: center">
                    @if(session()->has('success'))
                        <p class="alert alert-success">{{ session()->get('success') }}</p>
                    @elseif(session()->has('warning'))
                        <p class="alert alert-warning">{{ session()->get('warning') }}</p>
                    @endif
                </div>

                <h1>Корзина</h1>

                <p>Оформление заказа</p>

                <div class="panel">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Кол-во</th>
                            <th>Цена</th>
                            <th>Стоимость</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    @isset($product['id'])
                                        <a href="{{ route('product-more',[\Illuminate\Support\Facades\DB::table('categories')->find($product['category_id'])->code, $product['slug']]) }}">

                                            <img height="56px" src="{{ Storage::url($product['image'])}} ">
                                            {{$product['name']}}
                                        </a>
                                    @else
                                        <a href="">
                                            <img height="56px" src="{{ $product['images'][0] ?? null }} ">
                                            {{$product['name']}}
                                        </a>
                                    @endisset
                                </td>
                                <td><span class="badge">
                                        @isset($product['id'])
                                            {{\Illuminate\Support\Facades\DB::table('food_order')->where(['food_id' => $product['id'], 'order_id' => session('orderId')])->value('count')}}
                                        @else
                                            {{\Illuminate\Support\Facades\DB::table('api_element_order')->where(['element_id' => $product['article'], 'order_id' => session('orderId')])->value('count')}}
                                        @endisset</span>

                                    <div class="btn-group ">
                                        <form action="@isset($product['id']) {{ route('basket-add', $product['id']) }} @else @endisset" method="POST" >
                                            <button type="submit" class="btn btn-success" href=""><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                            @csrf
                                        </form>
                                        <form action="@isset($product['id']) {{ route('basket-remove', $product['id']) }} @else @endisset" method="POST">
                                            <button type="submit" class="btn btn-danger" href=""><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
                                            @csrf
                                        </form>
                                    </div>
                                </td>
                                <td>@isset($product['id']) {{$product['price']}} @else {{$product['price2']}} @endisset ₸</td>
{{--                                <td>{{$product->getPriceForCount()}} ₸</td>--}}
                                <td>
                                    @isset($product['id'])
                                        {{\Illuminate\Support\Facades\DB::table('food_order')->where(['food_id' => $product['id'], 'order_id' => session('orderId')])->value('count') * $product['price']}} ₸
                                    @else
                                        {{\Illuminate\Support\Facades\DB::table('api_element_order')->where(['element_id' => $product['article'], 'order_id' => session('orderId')])->value('count') * $product['price2']}} ₸
                                    @endisset
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">Общая стоимость:</td>
                            <td>
                            @php
                                $totalPrice = 0;
                            @endphp
                            @foreach($products as $product)
                                @php
                                    if (isset($product['id'])) {
                                        $totalPrice += (int) \Illuminate\Support\Facades\DB::table('food_order')->where(['order_id' => $product['id'], 'order_id' => session('orderId')])->value('count') * $product['price'];
                                    } else {
                                        $totalPrice += (int) \Illuminate\Support\Facades\DB::table('api_element_order')->where(['element_id' => $product['article'], 'order_id' => session('orderId')])->value('count') * $product['price2'];
                                    }
                                @endphp
                            @endforeach
                                {{$totalPrice}} ₸
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="btn-group pull-right" role="group">
                        <a type="button" class="primary-btn" href="{{route('order-arrange')}}">Оформить заказ</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
