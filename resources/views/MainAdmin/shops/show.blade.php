@extends('auth.layouts.master')

@section('title')
    Продукт {{$shop->name}}
@endsection

@section('content-section')
    <div class="container">
        <div class="col-md-12">
            <h1>{{ $shop->name }}</h1>
            <table class="table">
                <tbody>
                <tr>
                    <th>
                        Поле
                    </th>
                    <th>
                        Значение
                    </th>
                </tr>
                <tr>
                    <td>ID</td>
                    <td>{{ $shop->id}}</td>
                </tr>
                <tr>
                    <td>Код</td>
                    <td>{{ $shop->code }}</td>
                </tr>
                <tr>
                    <td>Название</td>
                    <td>{{ $shop->name }}</td>
                </tr>

                <tr>
                    <td>Картинка</td>
                    <td><img src="{{Storage::url($shop->image)}}" height="240px"></td>
                </tr>
                <tr>
                    <td>Хозяин</td>
                    <td>{{ $shop->user->name }}</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
@endsection
