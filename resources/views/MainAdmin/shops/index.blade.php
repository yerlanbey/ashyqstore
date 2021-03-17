@extends('auth.layouts.master')

@section('title')
    Оргнизаций
@endsection

@section('content-section'))
<div class="container">
    <div class="col-md-12">
        <h1>Организаций</h1>
        <form action="{{route('search.company')}}" method="GET" enctype="multipart/form-data">
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
                    Хозяин
                </th>

                <th>
                    Действия
                </th>
            </tr>
            @foreach($shops as $shop)
                <tr>
                    <td>{{$shop->id}}</td>
                    <td>{{$shop->code}}</td>
                    <td>{{$shop->name}}</td>
                    <td>{{$shop->user->name}}</td>

                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('shops.destroy', $shop) }}" method="POST">
                                <a class="btn btn-success" type="button" href="{{route('shops.show', $shop)}}">
                                    Открыть
                                </a>
                                <a class="btn btn-warning" type="button" href="{{route('shops.edit', $shop)}}">
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
        <a class="btn btn-success" type="button" href="{{route('shops.create')}}">Добавить организацию</a>
    </div>
    {{$shops->links()}}
</div>
@endsection
