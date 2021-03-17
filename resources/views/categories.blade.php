@extends('layouts.app')

@section('title')
Категорий
@endsection

@section('content')

    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="#">{{ Breadcrumbs::render('categories') }}</a></li>

                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
        @foreach($categories as $category)
            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        @if(!is_null($category->image))
                            <img src="{{ Storage::url($category->image) }}" alt="" height="300px">
                        @else
                            <img src="{{asset('/img/category_icon.png')}}" alt="" height="300px">
                        @endif
                    </div>
                    <div class="shop-body">
                        <h3>{{ $category->name }}</h3>
                        <a href="{{ $category->code }}" class="cta-btn">Посмотреть <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->
            @endforeach
        </div>
        <!-- /row -->

    </div>
    <!-- /container -->

</div>
<!-- /SECTION -->


@endsection
