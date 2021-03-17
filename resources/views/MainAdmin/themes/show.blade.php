@extends('auth.layouts.master')

@section('title')
    Категория {{$theme->name}}
@endsection

@section('content-section')
    <div class="container">
        <div class="col-md-12">
            <h1>{{ $theme->name }}</h1>
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
                    <td>{{ $theme->id}}</td>
                </tr>
                <tr>
                    <td>Код</td>
                    <td>{{ $theme->code }}</td>
                </tr>
                <tr>
                    <td>Название</td>
                    <td>{{ $theme->name }}</td>
                </tr>
                <tr>
                    <td>Описание</td>
                    <td>{{ $theme->description }}</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
@endsection
