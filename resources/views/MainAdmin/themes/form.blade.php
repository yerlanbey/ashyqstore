@extends('auth.layouts.master')


@isset($themes)
@section('title')
    Редактировать виды магазинов
@endsection
@else
@section('title')
    Добавить виды магазинов
@endsection
@endisset


@section('content-section')

    <div class="container">
        <div class="col-md-12">
            @isset($theme)
                <h1>Редактировать вид магазина <b>{{ $theme->name }}</b></h1>
            @else
                <h1>Добавить вид магазина</h1>
            @endisset
            <form method="POST" enctype="multipart/form-data"
                  @isset($theme)
                  action="{{ route('themes.update', $theme) }}"
                  @else
                  action="{{ route('themes.store') }}"
                @endisset
            >
                <div>
                    @isset($theme)
                        @method('PUT')
                    @endisset
                    @csrf
                    <br>
                    <div class="input-group row">
                        <label for="code" class="col-sm-2 col-form-label">Код: </label>
                        <div class="col-sm-6">
                            @include('auth.layouts.error', ['key' => 'code'])
                            <input type="text" class="form-control" name="code" id="code"
                                   value="{{ old('code', isset($theme) ? $theme->code : null) }}">
                        </div>
                    </div>
                    <br>
                    <div class="input-group row">
                        <label for="name" class="col-sm-2 col-form-label">Название: </label>
                        <div class="col-sm-6">
                            @include('auth.layouts.error', ['key' => 'name'])
                            <input type="text" class="form-control" name="name" id="name"
                                   value="@isset($theme){{$theme->name}}@endisset">
                        </div>
                    </div>

                    <br>
                    <div class="input-group row">
                        <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                        <div class="col-sm-6">
                            @include('auth.layouts.error', ['key' => 'description'])
                            <textarea name="description" id="description" cols="72" rows="7">@isset($theme){{$theme->description}}@endisset
</textarea>
                        </div>
                    </div>
                    <br>


                    <button class="btn btn-success" style="padding:15;">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
