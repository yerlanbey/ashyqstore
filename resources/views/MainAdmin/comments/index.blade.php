@extends('auth.layouts.master')

@section('title')
    Главная страница
@endsection

@section('content-section')
    <div class="container">
        <div class="col-md-12">
            <h1>Комментарий</h1>
            <form action="{{route('search.comments')}}" method="GET" enctype="multipart/form-data">
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
                        Код товара
                    </th>
                    <th>
                        Имя пользователя
                    </th>
                    <th>
                        Действия
                    </th>
                </tr>
                @foreach($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->product->name }}</td>
                        <td>{{ $comment->IsUser->name }}</td>

                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{route('devcomments.destroy', $comment->id)}}" method="POST">
                                    <a class="btn btn-success" type="button" href="{{ route('devcomments.show', $comment) }}">Открыть</a>
                                    <a class="btn btn-warning" type="button" href="{{ route('devcomments.edit', $comment) }}">Редактировать</a>

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
                    {{ $comments->links() }}
        </div>
    </div>

@endsection
