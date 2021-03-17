@extends('auth.layouts.master')

@section('title')
Заказ {{$order->id}}
@endsection

@section('content-section')
<div class="py-4">
  <div class="container">
    <div class="justify-content-center">
      <div class="panel">
          <h1>Заказ №{{ $order->id }}</h1>
          <p>Заказчик: <b>{{ $order->name }}</b></p>
          <p>Номер телефона: <b>{{ $order->phone }}</b></p>
          <p>Адрес: <b>{{ $order->address }}</b></p>
          <p>Квартира / офис: <b>{{ $order->apartment }}</b></p>
          <p>Этаж: <b>{{ $order->floor }}</b></p>
          <p>Желаемое дата/время получение заказа: <b>{{ $order->date }} {{$order->time}}(GMT+6)</b></p>
          @if($order->payment_spot == 1)
              <p>Вид оплаты: <b>Наличная оплата</b></p>
          @elseif($order->payment_transfer == 1)
              <p>Вид оплаты: <b>Банковский перевод(Kaspi Gold)</b></p>
            @endif
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
            @admin
            @foreach($products as $product)
            @if(Auth::user()->id == $product->user_id)
            <tr>
              <td>
                <a href="{{route('product-more',[$product->category->code,$product->code])}}">
                  <img height="56px"
                  src="{{ Storage::url($product->image) }}">
                  {{ $product->name }}
                </a>
              </td>
              <td><span class="badge">{{$product->pivot->count}}</span></td>
              <td>{{ $product->price }} ₸</td>
              <td>{{ $product->getPriceForCount() }} ₸</td>
            </tr>
            @endif
            @endforeach
            @else
            @foreach($products as $product)

            <tr>
              <td>
                <a href="{{route('product-more',[$product->category->code,$product->code])}}">
                  <img height="56px"
                  src="{{ Storage::url($product->image) }}">
                  {{ $product->name }}
                </a>
              </td>
              <td><span class="badge">{{$product->pivot->count}} ₸</span></td>
              <td>{{ $product->price }}</td>
              <td>{{ $product->getPriceForCount() }} ₸</td>
            </tr>

            @endforeach
            @endadmin

            <tr>
              <td colspan="3">Общая стоимость:</td>
              <td>{{ $order->getFullPrice()}} ₸</td>
            </tr>
          </tbody>
        </table>
          <p>Комментарйи к заказу: <b>{{ $order->comment }}</b></p>
        <br>
      </div>
    </div>
  </div>
</div>
@endsection
