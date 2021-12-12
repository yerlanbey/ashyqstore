@extends('auth.layouts.master')



@section('title')
    Добавить блюдо
@endsection



@section('content-section')
    <div class="container">

        <div class="col-md-12">

            <h1>Добавить блюдо в меню</h1>

            <form method="POST" enctype="multipart/form-data" action="{{route('dish.store')}}">
                <div>
                    @csrf
                    <br>
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Название:</label>
                        <div class="col-sm-6">
                            @include('auth.layouts.error', ['key' => 'name'])
                            <input type="text" class="form-control rounded"  name="name" id="name" placeholder="Название" value="">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Код:</label>
                        <div class="col-sm-6">
                            @include('auth.layouts.error', ['key' => 'slug'])
                            <input type="text" class="form-control rounded" name="slug" id="slug" placeholder="Код" value="">
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-6">
                        <input type="hidden" class="form-control rounded" name="restaurant_id" id="restaurant_id" value="{{$restaurant->id}}">
                    </div>
                    <div class="input-group row">
                        <label for="category_id" class="col-sm-2 col-form-label">Категория: </label>
                        <div class="col-sm-6">
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
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
                            <textarea name="description" id="description" cols="72" rows="7"></textarea>
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
                            <input type="text" name="price" id="price" class="form-control rounded" placeholder="Цена" value="">
                        </div>
                    </div>
                    <br>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Количество:</label>
                        <div class="col-sm-4">
                            @include('auth.layouts.error', ['key' => 'count'])
                            <input type="text" name="count" id="count" class="form-control rounded" placeholder="Количество" value="">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Черновик: </label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="draft" id="draft">
                        </div>
                    </div>
                    <br>
                    <div class=" p-a text-right">
                        <button type="submit" class="btn success">Добавить товар</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src = "// code.jquery.com/jquery-1.11.2.min.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type = "text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js" type = "text / javascript"></script>


    <script>
        $(document).ready(function () {
            $('.select-all').click(function () {
                let $select2 = $(this).parent().siblings('.select2')
                $select2.find('option').prop('selected', 'selected')
                $select2.trigger('change')
            })
            $('.deselect-all').click(function () {
                let $select2 = $(this).parent().siblings('.select2')
                $select2.find('option').prop('selected', '')
                $select2.trigger('change')
            })

            $('.select2').select2()
        });


        $('#name').change(function(e) {
            $.get('{{ route('restaurant.checkSlug') }}',
                { 'name': $(this).val() },
                function( data ) {
                    $('#slug').val(data.slug);
                }
            );
        });
    </script>
@endsection

