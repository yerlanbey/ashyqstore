@extends('auth.layouts.master')

@section('title')
    Продукты
@endsection

@section('content-section')
<div class="container">
    <div class="col-md-12">
        <h1>Все товары</h1>
        <form action="{{route('product.search')}}" method="GET" enctype="multipart/form-data">
            <div class="row p-a">
                <div class="col-sm-3">
                    <div class="input-group">
                        @include('auth.layouts.error', ['key' => 'searching'])
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
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->code}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->category->name}}</td>
                    <td style="text-align:center">{{$product->count}}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('products.destroy', $product) }}" method="POST">
                                <a class="btn btn-success" type="button" href="{{ route('products.show',$product->id )}}">
                                    Открыть
                                </a>
                                <a class="btn btn-warning" type="button" href="{{ route('products.edit', $product->id) }}">
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
