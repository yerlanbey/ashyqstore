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
            @foreach($products as $product)
                @include('inc.card')
            @endforeach
            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /SECTION -->

    {{$products->links()}}
@endsection
