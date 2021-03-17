@extends('auth.layouts.master')
@isset($color)
@section('title')
    Редактировать цвет
@endsection
@else
@section('title')
    Добавить цвет
@endsection
@endisset

@section('content-section')
    <div class="container">
        @if(session()->has('success'))
            <p class="alert alert-success">{{ session()->get('success') }}</p>
        @elseif(session()->has('warning'))
            <p class="alert alert-warning">{{ session()->get('warning') }}</p>
        @endif
        <div class="col-md-12">
            @isset($color)
                <h1>Редактировать цвет <b>{{$color->name}}</b></h1>
            @else
                <h1>Добавить цвет</h1>
            @endisset
            <form method="POST" enctype="multipart/form-data"
                  @isset($color)
                  action="{{ route('color.update', $color) }}"
                  @else
                  action="{{ route('color.store') }}"
                @endisset >
                <div>
                    @isset($color)

                        @method('PUT')
                    @endisset
                    @csrf
                    <div class="input-group row">
                        <label for="code" class="col-sm-2 col-form-label">Код: </label>
                        <div class="col-sm-6">
                            @error('code')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input type="text" class="form-control" name="code" id="code"
                                   value="{{ old('code', isset($color) ? $color->code : null) }}" name="code">
                        </div>
                    </div>
                    <br>
                    <div class="input-group row">
                        <label for="name" class="col-sm-2 col-form-label">Название: </label>
                        <div class="col-sm-6">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input type="text" class="form-control" name="name" id="name" value="@isset($color){{ $color->name }}@endisset">
                        </div>
                    </div>
                    <br>

                    <button class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </div>

@endsection
