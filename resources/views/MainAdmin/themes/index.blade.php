@extends('auth.layouts.master')

@section('title')
    Категория магазинов
@endsection

@section('content-section'))
<div class="container">
    <div class="col-md-12">
        <h1>Категория магазинов</h1>
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
                    Действия
                </th>
            </tr>
            @foreach($themes as $theme)
                <tr>
                    <td>{{$theme->id}}</td>
                    <td>{{$theme->code}}</td>
                    <td>{{$theme->name}}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('themes.destroy', $theme) }}" method="POST">
                                <a class="btn btn-success" type="button" href="{{ route('themes.show', $theme )}}">
                                    Открыть
                                </a>
                                <a class="btn btn-warning" type="button" href="{{ route('themes.edit', $theme) }}">
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
        <a class="btn btn-success" type="button" href="{{route('themes.create')}}">Добавить категорий магазинов</a>

    </div>
</div>
@endsection
