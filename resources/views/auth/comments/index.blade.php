@extends('auth.layouts.master')

@section('title')
    Комментарий
@endsection

@section('content-section')
    <div class="container">
        <div class="col-md-12">
            <h1>Комментарий</h1>
            <form action="{{route('comment.search')}}" method="GET" enctype="multipart/form-data">
                @include('auth.layouts.error', ['key' => 'searching'])
                <div class="row p-a">
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="searching" placeholder="Имя пользователя">
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

                    @if($comment->product->user_id == Auth::user()->id)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->product->name }}</td>
                            <td>{{ $comment->IsUser->name }}</td>

                            <td>
                                <div class="btn-group" role="group">
                                    <form action="{{route('comments.destroy', $comment->id)}}" method="POST">
                                        <a class="btn btn-success" type="button" href="{{ route('comments.show', $comment) }}">Открыть</a>
                                        @csrf
                                        @method('DELETE')
                                        <input class="btn btn-danger" type="submit" value="Удалить">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>

            </table>
                    {{ $comments->links() }}
        </div>
    </div>

@endsection
