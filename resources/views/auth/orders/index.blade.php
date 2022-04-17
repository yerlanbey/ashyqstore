@extends('auth.layouts.master')

@section('title')
    Заказы
@endsection

@section('content-section')
    <div class="py-4">
        <div class="container">
            <div style="text-align: center">
                @if(session()->has('success'))
                    <p class="alert alert-success">{{ session()->get('success') }}</p>
                @elseif(session()->has('warning'))
                    <p class="alert alert-warning">{{ session()->get('warning') }}</p>
                @endif
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1>Заказы</h1>
                    <form action="{{route('order.search')}}" method="GET" enctype="multipart/form-data">
                        <div class="row p-a">
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="searching" placeholder="Поиск">
                                    <span class="input-group-btn">
                            <button class="btn white" type="submit">Искать</button>
                            </span>
                                </div>
                            </div>
                        </div>
                    </form>
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Имя
                            </th>
                            <th>
                                Телефон
                            </th>
                            <th>
                                Дата отправки
                            </th>
                            <th>
                                Сумма
                            </th>
                            <th>
                                Действия
                            </th>
                        </tr>

                        @foreach($orders as $order)

                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->phone}}</td>
                                <td>{{$order->created_at->format(' d/m/Y')}}</td>
                                <td>{{$order->getFullPrice() }} ₸</td>
                                <td>
                                    <div class="btn-group" role="group">

                                        <a class="btn btn-success" type="button"
                                           href="{{ route('orders.show', $order) }}">
                                            Открыть
                                        </a>
                                        <a class="btn btn-danger ml-2" type="button"
                                           href="{{ route('order-delete', $order) }}">
                                            Удалить
                                        </a>

                                    </div>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
            {{$orders->links()}}
        </div>
    </div>
@endsection
