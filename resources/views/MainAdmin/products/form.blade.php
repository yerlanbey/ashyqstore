@extends('auth.layouts.master')


@isset($product)
@section('title')
Редактировать продукт
@endsection
@else
@section('title')
Добавить продукт
@endsection
@endisset


@section('content-section')

<div class="container">
  <div class="col-md-12">
    @isset($product)
    <h1>Редактировать товар<b>{{ $product->name }}</b></h1>
    @else
    <h1>Добавить товар</h1>
    @endisset
    <form method="POST" enctype="multipart/form-data"
    @isset($product)
    action="{{ route('mainproducts.update', $product) }}"
    @endisset
    >
    <div>
      @isset($product)
      @method('PUT')
      @endisset
      @csrf
      <br>
      <div class="input-group row">
        <label for="code" class="col-sm-2 col-form-label">Код: </label>
        <div class="col-sm-6">
          @include('auth.layouts.error', ['key' => 'code'])
          <input type="text" class="form-control" name="code" id="code"
          value="{{ old('code', isset($product) ? $product->code : null) }}">
        </div>
      </div>
      <br>
      <div class="input-group row">
        <label for="name" class="col-sm-2 col-form-label">Название: </label>
        <div class="col-sm-6">
          @include('auth.layouts.error', ['key' => 'name'])
          <input type="text" class="form-control" name="name" id="name"
          value="@isset($product){{$product->name}}@endisset">
        </div>
      </div>
      <br>
      <div class="input-group row">
        <label for="category_id" class="col-sm-2 col-form-label">Категория: </label>
        <div class="col-sm-6">
          <select name="category_id" id="category_id" class="form-control">
            @foreach($categories as $category)
            <option value="{{ $category->id }}"
              @isset($product)
              @if($product->category_id == $category->id)
              selected
              @endif
              @endisset
              >
              {{$category->name}}
            </option>

            @endforeach
          </select>
        </div>
      </div>
      <br>
      <div class="input-group row">
        <label for="description" class="col-sm-2 col-form-label">Описание: </label>
        <div class="col-sm-6">
          @include('auth.layouts.error', ['key' => 'description'])
          <textarea name="description" id="description" cols="72" rows="7">@isset($product){{$product->description}}@endisset
          </textarea>
        </div>
      </div>
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
      <div class="input-group row">
        <label for="price" class="col-sm-2 col-form-label">Цена: </label>
        <div class="col-sm-6">
          @include('auth.layouts.error', ['key' => 'price'])
          <input type="text"  name="price" id="price" value="@isset($product){{$product->price}}@endisset" width="10">
        </div>
      </div>
      <br>
      <div class="input-group row">
        <label for="count" class="col-sm-2 col-form-label">Количество: </label>
        <div class="col-sm-6">
          @include('auth.layouts.error', ['key' => 'count'])
          <input type="text"  name="count" id="count" value="@isset($product){{$product->count}}@endisset" width="10">
        </div>
      </div>
      <br>
      <!-- checkbox -->
      @foreach (['hit' => 'Хит',
      'new' => 'Новинка',
      'recommend' => 'Рекомендуемые'
      ] as $field => $title)
      <div class="form-group row">
        <label for="code" class="col-sm-2 col-form-label">{{ $title }}: </label>
        <div class="col-sm-10">
          <input type="checkbox" name="{{$field}}" id="{{$field}}"
          @if(isset($product) && $product->$field === 1)
          checked="checked"
          @endif
          >
        </div>
      </div>
      <br>
      @endforeach
      <!-- endcheckbox -->
      <button class="btn btn-success" style="padding:15;">Сохранить</button>
    </div>
  </form>
</div>
</div>
@endsection
