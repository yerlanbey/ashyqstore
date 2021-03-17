@extends('auth.layouts.master')

@section('title')
    Пользователи
@endsection

@section('content-section')
<div class="container">
    <div class="col-md-12">
        <h1>Пользователи</h1>
        <form action="{{route('search.user')}}" method="GET" enctype="multipart/form-data">
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
                    Имя
                </th>
                <th>
                    Email
                </th>
                <th>
                    Примущество
                </th>

                <th>
                    Действия
                </th>
            </tr>
            @foreach($users as $user)
                @if($user->id != Auth::user()->id)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        @if($user->is_admin)
                            <td>Хозяин магазина</td>
                        @else
                            <td>Пользователь</td>
                        @endif
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('user.destroy', $user) }}" method="POST">
                                    <a class="btn btn-success" type="button" href="{{ route('user.show',$user->id )}}">
                                        Открыть
                                    </a>
                                    <a class="btn btn-warning" type="button" href="{{ route('user.edit', $user->id) }}">
                                        Редактировать
                                    </a>
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
        <a class="btn btn-success" type="button" href="{{ route('user.create') }}">Добавить пользователя</a>
    </div>
    {{ $users->links() }}
</div>
@endsection
