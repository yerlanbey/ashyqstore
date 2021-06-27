@extends('auth.layouts.master')

@section('title')
    Подробнее комментарий
@endsection

@section('content-section')
    <div class="container">
        <div class="col-md-12">
            <h1>Комментарий <b>{{ $comment->IsUser->name }}</b></h1>
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
                    <td>{{ $comment->id }}</td>
                </tr>
                <tr>
                    <td>Написал</td>
                    <td>{{$comment->IsUser->name }}</td>
                </tr>
                <tr>
                    <td>Название</td>
                    <td>{{ $comment->product->name }}</td>
                </tr>
                <tr>
                    <td>Текст</td>
                    <td>{{ $comment->comment }}</td>
                </tr>

                @foreach($comment->replies as $reply)
                <tr>

                    <td style="float: left">Привязонные комментарий</td>
                        <td>{{ $reply->reply }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
