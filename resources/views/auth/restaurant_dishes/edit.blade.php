@extends('auth.layouts.master')

@section('title')
    Продукт {{$dish->name}}
@endsection

@section('content-section')
    <div class="container">
        <div class="col-md-12">
            <h1>{{ $dish->name }}</h1>
            <div style="text-align: center">
                @if(session()->has('success'))
                    <p class="alert alert-success">{{ session()->get('success') }}</p>
                @elseif(session()->has('warning'))
                    <p class="alert alert-warning">{{ session()->get('warning') }}</p>
                @endif
            </div>
            <form action="{{route('dish.update', $dish)}}" method="post" enctype="multipart/form-data">
                @csrf
                <table class="table">
                    <tbody>
                    <tr>
                        <th>
                            Поле
                        </th>
                        <th>
                            Значение
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="col-sm-6">
                                @include('auth.layouts.error', ['key' => 'slug'])
                                <input type="hidden" class="form-control rounded" name="slug" id="slug" placeholder="Код" value="{{ old('slug', isset($dish) ? $dish->slug : null) }}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Название</td>
                        <td>
                            <div class="col-sm-6">
                                @include('auth.layouts.error', ['key' => 'slug'])
                                <input type="text" class="form-control rounded" name="name" id="name"  value="{{ old('name', isset($dish) ? $dish->name : null) }}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Описание</td>
                        <td>
                            <div class="col-sm-6">
                                @include('auth.layouts.error', ['key' => 'description'])
                                <textarea name="description" class="form-control " id="description" cols="72" rows="7">@isset($dish){{$dish->description}}@endisset</textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Количество</td>
                        <td>
                            <div class="col-sm-4">
                                @include('auth.layouts.error', ['key' => 'count'])
                                <input type="text" name="count" id="count" class="form-control rounded"  value="@isset($dish){{$dish->count}}@endisset">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Картинка</td>
                        <td>
                            <img src="{{Storage::url($dish->image)}}" height="240px">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <label class="btn btn-default btn-file">
                                <input type="file" style="display: inline-block" name="image" id="image">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>Цена</td>
                        <td>
                            <div class="col-sm-4">
                                @include('auth.layouts.error', ['key' => 'price'])
                                <input type="text" name="price" id="price" class="form-control rounded"  value="@isset($dish){{$dish->price}}@endisset">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Название магазина</td>
                        <td>
                            <div class="col-sm-6">
                                <select name="market_id" id="market_id" class="form-control rounded">
                                    @foreach($restaurants as $restaurant)
                                        <option value="{{ $restaurant->id }}"
                                                @isset($restaurant)
                                                @if($dish->restaurant_id == $restaurant->id)
                                                selected
                                            @endif
                                            @endisset>
                                            {{$restaurant->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Категория</td>
                        <td>
                            <div class="col-sm-6">
                                <select name="category_id" id="category_id" class="form-control rounded">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                @isset($restaurant)
                                                @if($restaurant->category_id == $category->id)
                                                selected
                                            @endif
                                            @endisset>
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Черновик</td>
                        <td>
                            <div class="col-sm-10">
                                <input type="checkbox" name="draft" id="draft"
                                       @if(isset($dish) && $dish->draft === 1)
                                       checked="checked"
                                    @endif
                                >
                            </div>
                        </td>
                    </tr>
                    </tbody>

                </table>
                <button type="submit" class="btn success">Сохранить изменение</button>
            </form>
        </div>
    </div>
@endsection
