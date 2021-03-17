{{--company card--}}
<div class="col-md-3 col-xs-6" >
    <div class="product" >
        <div class="product-img" >
            @if(!is_null($shop->image))
                <img src="{{Storage::url($shop->image)}}" alt="" height="300" width="400">
            @else
                <img src="{{asset('img/shop_icon.png')}}" alt="" height="300" width="400">
            @endif
        </div>
        <div class="product-body">
            <p class="product-category">{{ $shop->themes->name }}</p>
            <h3 class="product-name"><a href="{{ route('shop.index', $shop->slug) }}">{{ $shop->name }}</a></h3>
            <div class="product-rating">
            </div>

        </div>
        <div class="add-to-cart">
            <a style="font-size: 18px; padding: 5px; margin: 15px;" href="{{route('shop.index', $shop->slug)}}" class="add-to-cart-btn">Подробнее</a>

        </div>
    </div>
</div>


