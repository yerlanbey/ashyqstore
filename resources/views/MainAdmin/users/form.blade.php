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
               <h1>Редактировать</h1>
            @else
                <h1>Добавить</h1>
            @endisset
            @if(session()->has('success'))
                <p class="alert alert-success">{{ session()->get('success') }}</p>
            @elseif(session()->has('warning'))
                <p class="alert alert-warning">{{ session()->get('warning') }}</p>
            @endif
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
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="roles">Роль:</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all" style="border-radius: 0">Выбрать все</span>
                            <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">Убрать все</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ in_array($role->id, old('roles', [])) ? 'selected' : '' }}
                                @foreach($user->roles as $user_role)
                                    @if($user_role->id == $role->id)
                                        selected
                                    @endif
                                @endforeach
                                >{{ $role->title }} </option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                        @isset($user)
                            <label for="roles"><b>Проекты:</b></label><br>
                            @foreach ($companies as $company)
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">{{$company->name}}</label>
                                    <div class="col-sm-10">
                                        <label class="ui-switch m-t-xs m-r">
                                            <input type="checkbox" name="active[{{$company->slug}}]" id="active" value=""
                                                   @if($company->active == 1)
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
    <script src = "// code.jquery.com/jquery-1.11.2.min.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type = "text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js" type = "text / javascript"></script>
    @include('js.main')
@endsection
