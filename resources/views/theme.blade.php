@extends('layouts.app')

@section('title')
    {{$themes->name}}
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
                        <li><a href="#">{{ Breadcrumbs::render('shops', $themes) }}</a></li>

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
                @foreach($themes->shops as $shop)
                    @if($shop->action == 1)
                        @include('inc.shopcard', compact($shop))
                    @endif
                @endforeach

            </div>

        </div>

    </div>

@endsection
