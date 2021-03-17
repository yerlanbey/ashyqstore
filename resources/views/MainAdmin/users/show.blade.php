@extends('auth.layouts.master')

@section('title')
     {{$user->name}}
@endsection

@section('content-section')
    <div class="container">
        <div class="col-md-12">
            <h1>{{ $user->name }}</h1>
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
                    <td>{{ $user->id}}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>Название</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Когда создан</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
                <tr>
                    <td>Картинка</td>
                    <td><img src="{{ Storage::url($user->image) }}" height="240px"></td>
                </tr>
                <tr>
                    <td>Примущество</td>
                    @if($user->is_admin)
                        <td>Хозяин магазина</td>
                    @else
                        <td>Пользователь</td>
                        @endif
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
