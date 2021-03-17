@extends('auth.layouts.master')
@isset($comment)
@section('title')
    Редактировать комментарий
@endsection
@endisset

@section('content-section')
    <div class="container">
        <div class="col-md-12">
            @isset($comment)
                <h1>Комментарий  <b>{{$comment->IsUser->name}}</b></h1>

            @endisset
            <form method="POST" enctype="multipart/form-data"
                  @isset($comment)
                  action="{{ route('devcomments.update', $comment) }}"
                @endisset >
                <div>
                    @isset($comment)
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
                                <p>{{$comment->product->name}}</p>
                            </div>
                        </div>
                    <br>
                    <div class="input-group row">
                        <label for="comment" class="col-sm-2 col-form-label">Сообщение: </label>
                        <div class="col-sm-6">
                            @error('comment')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <textarea name="comment" id="comment" cols="72"  rows="5">@isset($comment){{ $comment->comment }}@endisset
                            </textarea>
                        </div>
                    </div>
                    <br>

                    <button class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
