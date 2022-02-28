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
{{--                        <li><a href="#">{{ Breadcrumbs::render('cat') }}</a></li>--}}

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

                @forelse($subCategories as $subcategory)
                    <!-- shop -->
                        <div class="col-md-4 col-xs-6">
                            <div class="shop">
                                <div class="shop-img">
                                    <img src="{{asset('/img/category_icon.png')}}" alt="" height="300px">
                                </div>
                                <div class="shop-body">
                                    <h3>{{ $subcategory['name'] }}</h3>
    {{--                                <p>{{$cat->parentCategory->code}}</p>--}}
{{--                                    <a href="{{ route('childCategory1', [$cat->parentCategory->code,$cat->code, $cat->childCategories[0]->code]) }}" class="cta-btn">Посмотреть <i class="fa fa-arrow-circle-right"></i></a>--}}
                                    <a href="{{ route('elements', [$id, $subcategory['id']]) }}" class="cta-btn">Посмотреть <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- /shop -->
                @empty
                        <p> Пусто </p>
                @endforelse
            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /SECTION -->


@endsection
