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
                <h1>Редактировать товар <b>{{ $product->name }}</b></h1>
            @else
                <h1>Добавить товар</h1>
            @endisset
            <form method="POST" enctype="multipart/form-data"
                  @isset($product)
                  action="{{ route('products.update', $product) }}"
                  @else
                  action="{{ route('products.store') }}"
                @endisset
            >
                <div>
                    @isset($product)
                        @method('PUT')
                    @endisset
                    @csrf
                    <br>
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Код:</label>
                        <div class="col-sm-6">
                            @include('auth.layouts.error', ['key' => 'slug'])
                            <input type="text" class="form-control rounded" name="slug" id="slug" placeholder="Код" value="{{ old('slug', isset($product) ? $product->slug : null) }}">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Название:</label>
                        <div class="col-sm-6">
                            @include('auth.layouts.error', ['key' => 'name'])
                            <input type="text" class="form-control rounded"  name="name" id="name" placeholder="Название" value="@isset($product){{$product->name}}@endisset">
                        </div>
                    </div>
                    <br>

                    <div class="col-sm-6">
                        <input type="hidden" class="form-control rounded" name="shop_id" id="shop_id" placeholder="Код" value="{{ old('shop_id', isset($product) ? $product->shop_id : null) }}">
                    </div>

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
                                        @endisset>
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
                            <textarea name="description" id="description" cols="72" rows="7">@isset($product){{$product->description}}@endisset</textarea>
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
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Цена:</label>
                        <div class="col-sm-4">
                            @include('auth.layouts.error', ['key' => 'price'])
                            <input type="text" name="price" id="price" class="form-control rounded" placeholder="price" value="@isset($product){{$product->price}}@endisset">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Количество:</label>
                        <div class="col-sm-4">
                            @include('auth.layouts.error', ['key' => 'count'])
                            <input type="text" name="count" id="count" class="form-control rounded" placeholder="price" value="@isset($product){{$product->count}}@endisset">
                        </div>
                    </div>
                    <br>
                    <!-- checkbox -->
                    @foreach (['hit' => 'Хит',
                    'new' => 'Новинка',
                    'recommend' => 'Рекомендуемые',
                    'draft' => 'Черновик'
                    ] as $field => $title)
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">{{ $title }}: </label>
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
                    <div class=" p-a text-right">
                        <button type="submit" class="btn success">Добавить товар</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
