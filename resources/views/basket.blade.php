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
                        @foreach($order->products as $product)
                            <tr>
                                <td>
                                    <a href="{{ route('product-more',[$product->category->code, $product->code]) }}">

                                        <img height="56px" src="{{ Storage::url($product->image)}} ">
                                        {{$product->name}}
                                    </a>
                                </td>
                                <td><span class="badge">{{$product->pivot->count}}</span>
                                    <div class="btn-group ">
                                        <form action="{{ route('basket-add', $product) }}" method="POST" >
                                            <button type="submit" class="btn btn-success" href=""><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                            @csrf
                                        </form>
                                        <form action="{{ route('basket-remove', $product) }}" method="POST">
                                            <button type="submit" class="btn btn-danger" href=""><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
                                            @csrf
                                        </form>
                                    </div>
                                </td>
                                <td>{{$product->price}} ₸</td>
                                <td>{{$product->getPriceForCount()}} ₸</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">Общая стоимость:</td>
                            <td>{{$order->getFullPrice()}} ₸</td>
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
