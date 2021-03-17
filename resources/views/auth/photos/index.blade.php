@extends('auth.layouts.master')

@section('title')
    Фото товаров
@endsection

@section('content-section'))
<div class="container">
    <div class="col-md-12">
        <h1>Картинки</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Название
                </th>
                <th>
                    Код продукта
                </th>
                <th>
                    Картинка
                </th>
                <th>
                    Операций
                </th>
            </tr>
            @foreach($photos as $photo)
                <tr>
                    <td>{{$photo->id}}</td>
                    <td>{{$photo->name}}</td>
                    <td>{{$photo->products->name}}</td>
                    <td><img src="{{Storage::url($photo->image)}}" height="60px"></td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('photos.destroy', $photo) }}" method="POST">
                                <a class="btn btn-warning" type="button" href="{{ route('photos.edit', $photo) }}">
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
        <a class="btn btn-success" type="button" href="{{ route('photos.create') }}">Добавить картинку</a>
    </div>
    {{$photos->links()}}
</div>
@endsection
