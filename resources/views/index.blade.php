@extends('layouts.app')

@section('title')
    Главная страница
@endsection
@section('content')
    <!-- NAVIGATION -->
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <div style="text-align: center">
                @if(session()->has('success'))
                    <p class="alert alert-success">{{ session()->get('success') }}</p>
                @elseif(session()->has('warning'))
                    <p class="alert alert-warning">{{ session()->get('warning') }}</p>
                @endif
            </div>
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                    <li @routeactive('index-html')><a href="{{route('index-html')}}">Главная страница</a></li>
                    <li @routeactive('categor*')><a href="{{route('categories')}}">Категорий</a></li>
                    <li @routeactive('basket*')><a href="{{route('basket-check')}}">Корзина</a></li>
                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>
    <!-- /NAVIGATION -->

    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Магазины</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                @foreach($themes as $theme)
                                    <li >
                                        <a href="{{ route('index.theme', $theme->code)}}">
                                            {{$theme->name}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Section -->
                <div class="section">
                    <!-- container -->
                    <div class="container">
                        <!-- row -->
                        <div class="row">

                            <!-- product -->
                            @foreach($shops as $shop)
                                @include('inc.shopcard', compact($shop))
                            @endforeach
                            <!-- /product -->
                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /container -->
                </div>
                <!-- /Section -->
            </div>
            <!-- /row -->
            {{$shops->links('pagination.index')}}
        </div>
        <!-- /container -->

    </div>
    <!-- /SECTION -->


@endsection





