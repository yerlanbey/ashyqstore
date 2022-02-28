@extends('layouts.app')

@section('title')
    Товары
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
                        <b>Товары по категорий:</b> {{ $category['name'] }}
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
                @forelse($elements as $element)
                <!-- product -->
                    <div class="col-md-4 col-xs-6" height="300" width="400">
                        <div class="product">
                            <div class="product-img">
                                @forelse($images as $article => $image)
                                    @if ($article == $element['article'])
                                        <img src="{{ $image[0] ?? null }}" alt="" height="300" width="400">
                                    @endif
                                @empty
                                    <img src="{{asset('/img/shop_icon.png')}}" alt="" height="300" width="400">
                                @endforelse
                                <div class="product-label">
                                    @isset($element['isnew'])
                                        @if($element['isnew'] == 1)
                                            <span class="new">NEW</span>
                                            <br>
                                        @endif
                                    @endisset
                                    @isset($element['ispromo'])
                                        @if($element['ispromo'] == 1)
                                            <span class="new">Промо</span><br>
                                        @endif
                                    @endisset
                                    @isset($element['ishit'])
                                        @if($element['ishit'] == 1)
                                            <span class="new">Хит продаж</span><br>
                                        @endif
                                    @endisset
                                </div>
                            </div>
                            <div class="product-body" style="height: 200px;">
                                <p class="product-category">{{ $category['name'] }}</p>
                                <h3 class="product-name" style="font-size: 15px;">{{ $element['name'] }}</h3>
                                <h4 class="product-price">{{ $element['price2'] }} ₸<del class="product-old-price"></del></h4>
                                <a class="tooltipp" href="{{ route('element.detail', $element['article']) }}">
                                    Посмотреть  <i class="fa fa-arrow-circle-right"></i>
                                </a>
                                <p></p>
                            </div>
                            <form action="" method="POST">
                                @csrf
                                <div class="add-to-cart">
                                    <button type="submit" class="add-to-cart-btn" disabled><i class="fa fa-shopping-cart"></i>В корзину</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <!-- /product -->
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
