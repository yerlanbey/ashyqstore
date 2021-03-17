@extends('auth.layouts.master')


@section('title')
    Редактировать Админ
@endsection


@section('content-section')
    <div class="container">
        <div class="col-md-12">
                <h1>Редактировать Админ</h1>
            <form method="POST" enctype="multipart/form-data"
                  action="{{ route('profile.update', $user) }}">
                <div>
                    @csrf
                @method('PATCH')
                    <div class="input-group row">
                        <label for="name" class="col-sm-2 col-form-label">Полное имя: </label>
                        <div class="col-sm-6">
                            @error('name')
                            <div class="alert alert-danger"></div>
                            @enderror
                            <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                        </div>
                    </div>
                    <br>
                    <div class="input-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email: </label>
                        <div class="col-sm-6">
                            @error('email')
                            <div class="alert alert-danger"></div>
                            @enderror
                            <input type="text" class="form-control" name="email" id="email" value="{{$user->email}}">
                        </div>
                    </div>
                    <br>
                    <div class="input-group row">
                        <label for="password" class="col-sm-2 col-form-label">Пароль: </label>
                        <div class="col-sm-6">
                            @error('password')
                            <div class="alert alert-danger"></div>
                            @enderror
                            <input type="password" class="form-control" name="password" id="password" value="">
                        </div>
                    </div>
                    <br>
                    <!-- checkbox -->

                <!-- endcheckbox -->
                    <br>

                    <div class="input-group row">
                        <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                        <div class="col-sm-10">
                            <label class="btn btn-default btn-file">
                                Загрузить <input type="file" style="display: none;" name="image" id="image" value="{{$user->image}}">
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
