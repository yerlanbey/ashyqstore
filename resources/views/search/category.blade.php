@extends('auth.layouts.master')

@section('title')
    Главная страница
@endsection

@section('content-section')
    <div class="container">
        <div class="col-md-12">
            <h1>Категории</h1>
            <form action="{{route('category.search')}}" method="GET" enctype="multipart/form-data">
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
                        Действия
                    </th>
                </tr>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->code }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{route('categories.destroy', $category->id)}}" method="POST">
                                    <a class="btn btn-success" type="button" href="{{ route('categories.show', $category) }}">Открыть</a>
                                    <a class="btn btn-warning" type="button" href="{{ route('categories.edit', $category) }}">Редактировать</a>
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

            {{--        {{ $categories->links() }}--}}
            <a class="btn btn-success" type="button"
               href="{{ route('categories.create') }}">Добавить категорию</a>
        </div>
{{--        {{$categories->links()}}--}}
    </div>

@endsection
