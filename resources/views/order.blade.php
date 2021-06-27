
@extends('layouts.app')
@section('title')
    Оформление Заказа
@endsection

@section('content')
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <div style="text-align: center">
                @if(session()->has('success'))
                    <p class="alert alert-success">{{ session()->get('success') }}</p>
                @elseif(session()->has('warning'))
                    <p class="alert alert-warning">{{ session()->get('warning') }}</p>
                @endif
            </div>
            <!-- row -->
            <div class="row">

                <div class="col-md-7">
                    <form action="{{ route('order-confirm') }}" method="POST" enctype="multipart/form-data">
                        <!-- Подтвердите заказ -->
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Подтвердите заказ:</h3>
                            </div>
                            <p>Укажите свое имя и номер телефона, чтобы менеджеры могли с вами связаться:</p>
                            <p style="font-size: 30px;"><b>Ваши данные </p>
                            @if(Auth::check())
                            <div class="form-group">
                                @include('auth.layouts.error', ['key' => 'name'])
                                <input class="hidden" type="text" name="name" id="name" value="{{Auth::user()->name}}">
                            </div>
                            @else
                                <div class="form-group">
                                    @include('auth.layouts.error', ['key' => 'name'])
                                    <input class="input" type="text" name="name" id="name" placeholder="Ф.И.О">
                                </div>
                            @endif

                            <div class="form-group">
                                @include('auth.layouts.error', ['key' => 'phone'])
                                <label for="">Контактный номер</label>
                                <input class="input" type="text"  name="phone" id="phone" placeholder="+7(XXX) XXX XX XX">
                            </div>
                            @guest
                                <div class="form-group">
                                    @include('auth.layouts.error', ['key' => 'email'])
                                    <input class="input" type="text" name="email" id="email" placeholder="Электронная почта">
                                </div>
                            @endguest
                            <p><b>Адрес</b></p>
                            <div class="form-group">
                                @include('auth.layouts.error', ['key' => 'address'])
                                <input class="input" type="text"  name="address" id="address" value="город Шымкент, ">
                            </div>
                            <p><b>Квартира / офис</b></p>
                            <div class="form-group">
                                @include('auth.layouts.error', ['key' => 'apartment'])
                                <input class="input" type="text"  name="apartment" id="apartment" >
                            </div>
                            <p><b>Этаж</b></p>
                            <div class="form-group">
                                <input class="input" type="text"  name="floor" id="floor" >
                            </div>
                            <p><b>Желаемое время доставки</b></p>
                            <div class="form-group">
                                <label for="date">День</label><br>
                                <input type="date" id="date" name="date">
                            </div>
                            <div class="form-group">
                                <label for="time">Время</label><br>
                                <select name="time" id="time" class="form-control">
                                    <option disabled="disabled" selected="selected" value>Выберите время</option>
                                    <option> 10:00 - 12:00</option>
                                    <option> 11:00 - 13:00</option>
                                    <option> 12:00 - 14:00</option>
                                    <option> 13:00 - 15:00</option>
                                    <option> 14:00 - 16:00</option>
                                    <option> 15:00 - 17:00</option>
                                    <option> 16:00 - 18:00</option>
                                </select>
                            </div>
                            <p><b>Комментарий к заказу</b></p>
                            <div class="form-group">
                                <textarea class="input" name="comment" id="comment" cols="72" rows="7"></textarea>
                            </div>
                            <p><b>Варианты оплаты:</b></p>
                            @foreach ([
                                'payment_spot' => 'Наличная оплата',
                                'payment_transfer' => 'Банковский перевод(Kaspi Gold)',
                                ] as $field => $title)
                                <input type="checkbox" id="{{$field}}" name="{{$field}}">
                                <label for="{{$field}}">{{$title}}</label><br>
                            @endforeach
                        </div>
                        <input type="submit" class="primary-btn order-submit" value="Подтвердите заказ">
                        <!-- /Подтвердите заказ -->
                        @csrf
                    </form>
                </div>

                <!-- заказ -->

                    <div class="col-md-5 order-details">
                        <div class="section-title text-center">
                            <h3 class="title">Ваш заказ</h3>
                        </div>
                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>Товары</strong></div>
                                <div><strong>Итог</strong></div>
                            </div>
                            <div class="order-products">
                                @foreach($order->products as $product)
                                    <div class="order-col">
                                        <div>{{$product->pivot->count}}x {{$product->name}}</div>
                                        <div>{{$product->price}} ₸</div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="order-col">
                                <div><strong>Итого</strong></div>
                                <div><strong class="order-total">{{ $order->getFullPrice()}} ₸</strong></div>
                            </div>
                        </div>

                    </div>

                <!-- /заказ -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
