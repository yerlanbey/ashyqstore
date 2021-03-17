@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <div id="store" class="col-md-9">
                <!-- store products -->
                <div class="row">
                @isset($products)
                    @foreach($products as $product)
                        <!-- product -->
                        @include('inc.card', compact('product'))
                    @endforeach
                @endisset
                @isset($shops)
                    <!-- Products tab & slick -->
                        <!-- Section -->
                        <div class="section">
                            <!-- container -->
                            <div class="container">
                                <!-- row -->
                                <div class="row">
                                    @foreach($shops as $shop)

                                        @include('inc.shopcard',compact('shop'))

                                    @endforeach
                                </div>
                                <!-- /row -->
                            </div>
                            <!-- /container -->
                        </div>
                        <!-- /Section -->
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection
