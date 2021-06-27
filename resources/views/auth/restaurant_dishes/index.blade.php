@extends('auth.layouts.master')

@section('title')
    {{$restaurant->name}}
@endsection

@section('content-section')
    <div class="container">
        <div class="col-md-12">
            <h1>Все товары <b>{{$restaurant->name}}</b></h1>
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
                @foreach($dishes as $dish)
                    <tr>
                        <td>{{$dish->id}}</td>
                        <td>{{$dish->slug}}</td>
                        <td>{{$dish->name}}</td>
                        <td>{{$dish->category->name}}</td>
                        <td style="text-align:center">{{$dish->count}}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('dish.destroy', $dish) }}" method="post">
                                    <a class="btn btn-warning" type="button" href="{{route('dish.edit', $dish)}}">
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
            @isset($restaurant)
                <a class="btn btn-success" type="button"
                   href="{{ route('dish.create', $restaurant) }}">
                    Добавить блюдо
                </a>
            @endisset
        </div>
    </div>
@endsection
