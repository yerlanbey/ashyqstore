@extends('layouts.app')
@section('title')
    {{$shop->name}}
@endsection


@section('content')

    {{--    After few time needed--}}
    {{--            @if(session()->has('success'))--}}
    {{--                <p class="alert alert-success">{{ session()->get('success') }}</p>--}}

    {{--            @elseif(session()->has('warning'))--}}

    {{--                <p class="alert alert-warning">{{ session()->get('warning') }}</p>--}}
    {{--            @endif--}}
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="#">{{ Breadcrumbs::render('owner', $shop) }}</a></li>
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
            <div class="section-title text-center">
                <h3 class="title">{{$shop->name}}</h3>
            </div>
            <div class="section-title text-left" >
                <p><b>Адрес:</b> {{$shop->address}}</p>
                <small><b>Контактные данные:</b> {{$shop->phone}}</small>
            </div>
            <!-- row -->
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                @include('inc.sub-header', compact('shop'))
                <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Хит продаж</h3>
                        <?php $count = 0; ?>
                        @foreach($products->shuffle() as $product)
                            @if($product->hit == 1)
                                <?php $count++; ?>
                                @if($count <= 3)
                                    <div class="product-widget">
                                        <div class="product-img">
                                            @if(!is_null($product->image))
                                                <img src="{{Storage::url($product->image)}}" alt=""  >
                                            @else
                                                <img src="{{asset('/img/image_icon.png')}}" alt="">
                                            @endif
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{$product->category->name}}</p>
                                            <h3 class="product-name"><a href="{{route('product-more', [isset($category) ? $category->code : $product->category->slug, $product->slug])}}">{{$product->name}}</a></h3>
                                            <h4 class="product-price">{{$product->price}}</h4>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <!-- /aside Widget -->
                </div>
                <!-- /ASIDE -->

                <!-- STORE -->

                <div id="store" class="col-md-9">
                    <!-- store products -->
                    <div class="row">
                        <!-- product -->
                    @foreach($products as $product)
                        @include('inc.card',compact('product'))
                    @endforeach
                    <!-- /product -->
                        <div class="clearfix visible-sm visible-xs"></div>
                    </div>
                    <!-- /store products -->

                    {{ $products->links('pagination.index') }}
                </div>
                <!-- /STORE -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
