@extends('auth.layouts.master')
@section('title')
@isset($photo)
 Редактировать
@else
 Добавить
@endisset
@endsection




@section('content-section')

<div class="container">
  <div class="col-md-12">
    @isset($photo)
    <h1>Редактировать фото</h1>
    @else
    <h1>Добавить фото</h1>
    @endisset
    <form method="POST" enctype="multipart/form-data"
    @isset($photo)
    action="{{ route('photos.update', $photo) }}"
    @else
    action="{{ route('photos.store') }}"
    @endisset
    >

    <div>

      @isset($photo)
      @method('PUT')
      @endisset
      @csrf

      <br>
      <div class="input-group row">
        <label for="name" class="col-sm-2 col-form-label">Название: </label>
        <div class="col-sm-6">
          @include('auth.layouts.error', ['key' => 'name'])
          <input type="text" class="form-control" name="name" id="name"
          value="@isset($photo){{$photo->name}}@endisset">
        </div>
      </div>
      <br>
      <div class="input-group row">
        <label for="category_id" class="col-sm-2 col-form-label">Продукт: </label>
        <div class="col-sm-6">
          <select name="product_id" id="product_id" class="form-control">
            @foreach($products as $product)
            <option value="{{ $product->id }}"
              @isset($photo)
              @if($photo->product_id == $product->id)
              selected
              @endif
              @endisset>
          {{ $product->name }}
            </option>
            @endforeach
          </select>
        </div>
      </div>
      <br>
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
