{{--@extends('layouts.app')--}}
{{--@section('title')--}}
{{--    {{ $category->name }}--}}
{{--@endsection--}}

{{--@section('content')--}}
{{--    <!-- BREADCRUMB -->--}}
{{--    <div id="breadcrumb" class="section">--}}
{{--        <!-- container -->--}}
{{--        <div class="container">--}}
{{--            <!-- row -->--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <ul class="breadcrumb-tree">--}}
{{--                        <li><a href="#">{{ Breadcrumbs::render('category',$category) }}</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- /row -->--}}
{{--        </div>--}}
{{--        <!-- /container -->--}}
{{--    </div>--}}
{{--    <!-- /BREADCRUMB -->--}}
{{--    <div class="container" style="margin-top: 50px;">--}}
{{--        <div class="starter-template">--}}
{{--            <div class="row  ">--}}
{{--                <!-- 1 -->--}}
{{--                @foreach($category->products()->with('category')->get() as $product)--}}
{{--                    @include('inc.card')--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <ul>--}}
{{--        <li>--}}
{{--            @foreach($category->childCategories as $cat)--}}
{{--                {{$cat['name']}}--}}
{{--            @endforeach--}}

{{--        </li>--}}
{{--    </ul>--}}
{{--@endsection--}}


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
                @isset($category->childCategories)
            @foreach($category->childCategories as $cat)
                <!-- shop -->
                    <div class="col-md-4 col-xs-6">
                        <div class="shop">
                            <div class="shop-img">
                                @if(!is_null($cat->image))
                                    <img src="{{ Storage::url($cat->image) }}" alt="" height="300px">
                                @else
                                    <img src="{{asset('/img/category_icon.png')}}" alt="" height="300px">
                                @endif
                            </div>
                            <div class="shop-body">
                                <h3>{{ $cat->name }}</h3>
{{--                                <p>{{$cat->parentCategory->code}}</p>--}}
                                <a href="{{ route('childCategory1', [$cat->parentCategory->code,$cat->code, $cat->childCategories[0]->code]) }}" class="cta-btn">Посмотреть <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /shop -->
                @endforeach
                    @endisset
            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /SECTION -->


@endsection
