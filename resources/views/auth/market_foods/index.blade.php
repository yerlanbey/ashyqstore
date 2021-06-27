@extends('auth.layouts.master')

@section('title')
    {{$market->name}}
@endsection

@section('content-section')
    <div class="container">
        <div class="col-md-12">
            <h1>Все товары <b>{{$market->name}}</b></h1>
            <form action="{{route('product.search')}}" method="GET" enctype="multipart/form-data">
                @include('auth.layouts.error', ['key' => 'searching'])
                <div class="row p-a">
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="searching" placeholder="Имя продукта">
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
                        Код
                    </th>
                    <th>
                        Название
                    </th>
                    <th>
                        Категория
                    </th>
                    <th>
                        Кол-во товарных предложений
                    </th>
                    <th>
                        Действия
                    </th>
                </tr>
                @foreach($foods as $food)
                    <tr>
                        <td>{{$food->id}}</td>
                        <td>{{$food->code}}</td>
                        <td>{{$food->name}}</td>
                        <td>{{$food->category->name}}</td>
                        <td style="text-align:center">{{$food->count}}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('food.destroy', $food) }}" method="POST">
                                    <a class="btn btn-warning" type="button" href="{{route('food.edit', $food)}}">
                                        О товаре
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-danger" type="submit" value="Удалить">
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @isset($market)
                <a class="btn btn-success" type="button"
                   href="{{ route('food.create', $market) }}">
                    Добавить товар
                </a>
            @endisset
        </div>
    </div>
@endsection
