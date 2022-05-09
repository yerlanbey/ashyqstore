<!-- categories -->
<div class="col-md-4 col-xs-6">
    <div class="shop">
        <div class="shop-img">
            @if(!is_null($childCategory->image))
                <img src="{{ Storage::url($childCategory->image) }}" alt="" height="300px">
            @else
                <img src="{{asset('/img/category_icon.png')}}" alt="" height="300px">
            @endif
        </div>
        <div class="shop-body">
            <h3>{{ $childCategory->name }}</h3>
            <a href="{{ route('product.categories', [$childCategory->code ?? null, ]) }}" class="cta-btn">Посмотреть <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<!-- /categories -->
