@extends('auth.layouts.master')
@section('title')
    @isset($shop)
        Редактировать
    @else
        Добавить
    @endisset
@endsection




@section('content-section')

    <div class="container">
        <div class="col-md-12">
            @isset($shop)
                <h1>Редактировать <small><b>{{$shop->name}}</b></small></h1>
            @else
                <h1>Добавить организацию</h1>
            @endisset


            <form method="POST" enctype="multipart/form-data"
                  @isset($shop)
                  action="{{ route('shops.update', $shop) }}"
                  @else
                  action="{{ route('shops.store') }}"
                @endisset>

                <div>
                    @isset($shop)
                        @method('PUT')
                    @endisset
                    @csrf
                    <br>
                    <div class="input-group row">
                        <label for="name" class="col-sm-2 col-form-label">Название: </label>
                        <div class="col-sm-6">
                            @include('auth.layouts.error', ['key' => 'name'])
                            <input type="text" class="form-control" name="name" id="name"
                                   value="@isset($shop) {{$shop->name}} @endisset ">
                        </div>
                    </div>
                    <br>
                    <div class="input-group row">
                        <label for="code" class="col-sm-2 col-form-label">Код: </label>
                        <div class="col-sm-6">
                            @include('auth.layouts.error', ['key' => 'code'])
                            <input type="text" class="form-control" name="code" id="code"
                                   value="@isset($shop) {{$shop->code}} @endisset ">
                        </div>
                    </div>
                    <br>
                    <div class="input-group row">
                        <label for="user_id" class="col-sm-2 col-form-label">Владелец: </label>
                        <div class="col-sm-6">
                            <select name="user_id" id="user_id" class="form-control">
                                @foreach($owners as $owner)
                                    <option value="{{ $owner->id }}" @isset($shop)@if($shop->user_id == $owner->id) selected @endif @endisset>
                                        {{ $owner->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                        <br>
                    <div class="input-group row">
                        <label for="theme_code" class="col-sm-2 col-form-label">Вид : </label>
                        <div class="col-sm-6">
                            <select name="theme_code" id="theme_code" class="form-control">
                                @foreach($themes as $theme)
                                    <option value="{{ $theme->code }}"
                                            @isset($shop)
                                            @if($theme->code == $shop->theme_code)
                                            selected
                                        @endif
                                        @endisset>
                                        {{ $theme->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                <br>
                        @isset($shop)
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">{{$shop->name}}</label>
                                    <div class="col-sm-10">
                                        <label class="ui-switch m-t-xs m-r">
                                            <input type="checkbox" name="action" id="action"
                                                   @if($shop->action == 1)
                                                   checked="checked"
                                                @endif
                                            >
                                            <i></i>
                                        </label>
                                    </div>
                                </div>
                        @endisset
                    <br>
                    <div class="input-group row">
                        <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                        <div class="col-sm-10">
                            <label class="btn btn-default btn-file">
                                Загрузить <input type="file" style="display: none;" name="image" id="image">
                            </label>
                        </div>
                    </div>
                    <br>
                    <!-- endcheckbox -->
                    <button class="btn btn-success" style="padding:15;">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
