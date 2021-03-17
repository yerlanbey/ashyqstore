@extends('auth.layouts.master')

@isset($user)
@section('title')
    Редактировать Админ
@endsection
@else
@section('title')
    Добавить Админ
@endsection
@endisset


@section('title')
    Добавить Админ
@endsection


@section('content-section')
    <div class="container">
        <div class="col-md-12">

            @isset($user)

               <h1>Редактировать Админ</h1>

            @else

                <h1>Добавить Админ</h1>

            @endisset

            <form method="POST" enctype="multipart/form-data"
                  @isset($user)
                  action="{{ route('user.update', $user) }}"
                  @else
                  action="{{ route('user.store') }}"
                @endisset>
                <div>
                    @isset($user)
                        @method('PUT')
                    @endisset
                    @csrf
                    <div class="input-group row">
                        <label for="name" class="col-sm-2 col-form-label">Полное имя: </label>
                        <div class="col-sm-6">
                            @error('name')
                            <div class="alert alert-danger"></div>
                            @enderror
                            <input type="text" class="form-control" name="name" id="name" value="@isset($user){{$user->name}}@endisset">
                        </div>
                    </div>
                    <br>
                    <div class="input-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email: </label>
                        <div class="col-sm-6">
                            @error('email')
                            <div class="alert alert-danger"></div>
                            @enderror
                            <input type="text" class="form-control" name="email" id="email" value="@isset($user){{$user->email}}@endisset">
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
                                @foreach (['is_admin' => 'Администратор',
                                ] as $field => $title)
                                    <div class="form-group row">
                                        <label for="code" class="col-sm-2 col-form-label">{{ $title }}: </label>
                                        <div class="col-sm-10">
                                            <input type="checkbox" name="{{$field}}" id="{{$field}}"
                                                   @if(isset($user) && $user->$field === 1)
                                                        checked="checked"
                                                   @endif
                                            >
                                        </div>
                                    </div>
                                    <br>
                                @endforeach
                        <!-- endcheckbox -->
                    <br>
                        @isset($user)
                            @foreach ($companies as $company)
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">{{$company->name}}</label>
                                    <div class="col-sm-10">
                                        <label class="ui-switch m-t-xs m-r">
                                            <input type="checkbox" name="action[{{$company->id}}]" id="action"
                                                   @if($company->action == 1)
                                                        checked="checked"
                                                   @endif
                                            >
                                            <i></i>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                    <div class="input-group row">
                        <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                        <div class="col-sm-10">
                            <label class="btn btn-default btn-file">
                                Загрузить <input type="file" style="display: none;" name="image" id="image">
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
