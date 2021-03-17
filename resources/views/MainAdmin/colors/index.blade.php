@extends('auth.layouts.master')

@section('title')
    Цветы одежды
@endsection

@section('content-section')
    <div class="container">
        @if(session()->has('success'))
            <p class="alert alert-success">{{ session()->get('success') }}</p>
        @elseif(session()->has('warning'))
            <p class="alert alert-warning">{{ session()->get('warning') }}</p>
        @endif
        <div class="col-md-12">
            <h1>Цветы одежды</h1>
            <form action="{{route('search.color')}}" method="GET" enctype="multipart/form-data">
                @csrf
                <div class="row p-a">
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="searching" placeholder="Поиск" style="width: 200px;">
                            <span class="input-group-btn">
                                <button class="btn white" type="submit" style="float: left">Искать</button>
                                <a class="btn btn-warning" href="{{route('color.index')}}">Сбросить поиск</a>
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
                        Цвет
                    </th>
                    <th>
                        Действия
                    </th>
                </tr>
                @foreach($colors as $color)
                    <tr>
                        <td>{{ $color->id }}</td>
                        <td>{{ $color->code }}</td>
                        <td>{{ $color->name }}</td>
                        <td><div class="color" style="width: 25px; height: 15px; background-color: {{ $color->code }}"></div></td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('color.delete', $color) }}" method="POST">
{{--                                    <a class="btn btn-warning" type="button" href="">Редактировать</a>--}}
                                    @csrf
                                    <input class="btn btn-danger" type="submit" value="Удалить">
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>


            <a class="btn btn-success" type="button"
               href="{{route('color.create')}}">Добавить цвет</a>
        </div>
    </div>

@endsection
