@extends('auth.layouts.master')
@isset($category)
@section('title')
    Редактировать категорию
@endsection
@else
@section('title')
    Добавить категорию
@endsection
@endisset

@section('content-section')
    <div class="container">
        <div class="col-md-12">
            @isset($category)
            <h1>Редактировать Категорию <b>{{$category->name}}</b></h1>

            @else
                <h1>Добавить Категорий</h1>
            @endisset
            <form method="POST" enctype="multipart/form-data"
                  @isset($category)
                  action="{{ route('maincategory.update', $category) }}"
                  @else
                  action="{{ route('maincategory.store') }}"
                @endisset >
                <div>
                    @isset($category)
                        @method('PUT')
                    @endisset
                    @csrf
                    <br>
                        <div class="input-group row">
                            <label for="name" class="col-sm-2 col-form-label">Название: </label>
                            <div class="col-sm-6">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" name="name" id="name" value="@isset($category){{ $category->name }}@endisset">
                            </div>
                        </div>
                    <br>
                        <div class="input-group row">
                            <label for="code" class="col-sm-2 col-form-label">Код: </label>
                            <div class="col-sm-6">
                                @error('code')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" name="code" id="code"
                                       value="{{ old('code', isset($category) ? $category->code : null) }}" name="code">
                            </div>
                        </div>
                    <br>
                        <div class="form-group">
                            <label for="category_id">Категория</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">Выбрать все</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">Убрать все</span>
                            </div>
                            <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" value="" name="category_id" id="category_id">
                                <option value="">Выберите категорию</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @foreach($category->childCategories as $childCategory)
                                        <option value="{{ $childCategory->id }}" {{ old('category_id') == $childCategory->id ? 'selected' : '' }}>-- {{ $childCategory->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('category') }}
                                </div>
                            @endif
                        </div>
                    <br>
                        <div class="input-group row">
                            <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                            <div class="col-sm-6">
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <textarea name="description" id="description" cols="72"  rows="5">@isset($category){{ $category->description }}@endisset
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
                    <button class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </div>


    <script src = "// code.jquery.com/jquery-1.11.2.min.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type = "text/javascript"></script>
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
            $.get('{{ route('category.checkSlug') }}',
                { 'name': $(this).val() },
                function( data ) {
                    $('#code').val(data.slug);
                }
            );
        });
    </script>
@endsection
