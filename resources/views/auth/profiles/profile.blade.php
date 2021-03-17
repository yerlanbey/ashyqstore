@extends('auth.layouts.master')

@section('title')
    {{$user->name}}
@endsection

@section('content-section')
<!-- ############ PAGE START-->

<div class="item">
    <div class="item-bg">
        @if(Auth::user()->image != "" )
            <img src="{{Storage::url(Auth::user()->image)}}" class="blur opacity-3">
        @else
            <img src="{{asset('/img/default_image.jpg')}}"  class="blur opacity-3">
        @endif

    </div>
    <div class="p-a-md">
        <div class="row m-t">
            <div class="col-sm-7">
                <a href="#" class="pull-left m-r-md">
            <span class="avatar w-96">
                @if(Auth::user()->image != "" )
                    <img src="{{Storage::url(Auth::user()->image)}}">
                @else
                    <img src="../img/default_image.jpg" >
                @endif
              <i class="on b-white"></i>
            </span>
                </a>
                <div class="clear m-b">
                    <h4 class="m-a-0 m-b-sm">{{$user->name}}</h4>
                    <p class="text-muted"><span class="m-r">@if($user->isAdmin()) Хозяин магазина @else Пользователь @endif</span></p>

                </div>
            </div>

        </div>
    </div>
</div>
<div class="white bg b-b p-x">
    <div class="row">
        <div class="col-sm-6 push-sm-6">
            @if(Auth::user()->isAdmin())
            <div class="p-y text-center text-sm-right">

                <a href="{{ route('products.index') }}" class="inline p-x text-center">
                    <span class="h4 block m-a-0">{{$user->products->count()}}</span>
                    <small class="text-xs text-muted">Кол-во товара</small>
                </a>
                <a href="{{ route('comments.index') }}" class="inline p-x b-l b-r text-center">
                    <span class="h4 block m-a-0">{{$user->comments->count()}}</span>
                    <small class="text-xs text-muted">Кол-во комментарий</small>
                </a>
                <a href="{{ route('home') }}" class="inline p-x text-center">
                    <span class="h4 block m-a-0">{{$user->orders->where('status',1)->count()}}</span>
                    <small class="text-xs text-muted">Кол-во заказов</small>
                </a>
            </div>
                @endif
        </div>
        <div class="col-sm-6 pull-sm-6">
            <div class="p-y-md clearfix nav-active-info">
                <ul class="nav nav-pills nav-sm">


                </ul>
            </div>
        </div>
    </div>
</div>
<div class="padding">
    <div class="row">
        <div class="col-sm-8 col-lg-9">
            <div class="tab-pane p-v-sm" id="tab_4">
                <div class="row m-b">
                    <div class="col-xs-6">
                        <small class="text-muted">Ваш ID</small>
                        <div class="_500">{{$user->id}}</div>
                    </div>
                    <div class="col-xs-6">
                        <small class="text-muted">Ваша почта</small>
                        <div class="_500">{{$user->email}}</div>
                    </div>
                </div>
                <div class="row m-b">
                    <div class="col-xs-6">
                        <small class="text-muted">Время создание</small>
                        <div class="_500">{{$user->created_at}}</div>
                    </div>
                    @if(Auth::user()->isAdmin())
                    <div class="col-xs-6">
                        @isset($user->shops[0])
                        <small class="text-muted">Имя магазина</small>
                        <div class="_500">{{ $user->shops[0]->name }}</div>
                        @endisset
                    </div>
                    @endif
                </div>
                <a class="btn btn-success" type="button" href="{{route('profile.edit', Auth::user()->id)}}">Изменить</a>
            </div>
        </div>
    </div>
</div>

<!-- ############ PAGE END-->
@endsection
