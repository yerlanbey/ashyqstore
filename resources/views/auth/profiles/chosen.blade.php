@extends('auth.layouts.master')
@section('title')
    Избранные
@endsection
@section('content-section')
    <div class="col-md-9">
        <div class="row">
    @foreach($products as $product)
                <div class="col-xs-6 col-sm-3 col-md-2 " style="height: 200px; width: 200px;">
                    <div class="box p-a-xs">
                        @if(!is_null($product->image))
                            <img src="{{Storage::url($product->image)}}" alt="" height="400" width="300" class="img-responsive">
                        @else
                            <img src="{{asset('/img/image_icon.png')}}" alt="" class="img-responsive">
                        @endif
                        <div class="p-a-sm">
                            @if(Auth::check())
                                    <a class="add-to-wishlist" href="{{ route('product-dislike', $product->id) }}">{{$product->name}} <i class="fa fa-bookmark" style="font-size: 20px"></i> <span class="tooltipp"> </span></a>
                            @endif
                        </div>
                    </div>
                </div>
    @endforeach
        </div>
    </div>
@endsection
