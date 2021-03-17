@extends('layouts.app')
@section('title')
    {{ $category->name }}
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
                        <li><a href="#">{{ Breadcrumbs::render('category',$category) }}</a></li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <div class="container" style="margin-top: 50px;">
        <div class="starter-template">
            <div class="row  ">
                <!-- 1 -->
                @foreach($category->products()->with('category')->get() as $product)
                    @include('inc.card')
                @endforeach
            </div>
        </div>
    </div>
@endsection
