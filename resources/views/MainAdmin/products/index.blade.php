@extends('auth.layouts.master')

@section('title')
    Продукты
@endsection

@section('content-section')
<div class="container">
    <div class="col-md-12">
        <h1>Товары</h1>
        <form action="{{route('search.products')}}" method="GET" enctype="multipart/form-data">
            @csrf
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
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->code}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->category->name}}</td>
                    <td style="text-align:center">{{$product->count}}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('mainproducts.destroy', $product) }}" method="POST">
                                <a class="btn btn-success" type="button" href="{{ route('mainproducts.show', $product )}}">
                                    Открыть
                                </a>
                                <a class="btn btn-warning" type="button" href="{{ route('mainproducts.edit', $product) }}">
                                    Редактировать
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
    {{$products->links()}}
    </div>
</div>
@endsection
