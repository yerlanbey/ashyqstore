

<!-- product -->
<div class="col-md-4 col-xs-6" height="300" width="400">
    <div class="product">
        <div class="product-img">
            @if(!is_null($product->image))
                <img src="{{Storage::url($product->image)}}" alt="" height="300" width="400">
            @else
                <img src="{{asset('/img/image_icon.png')}}" alt="" height="300" width="400">
            @endif
            <div class="product-label">
                @if($product->isNew())
                    <span class="new">NEW</span>
                    <br>
                @endif
                @if($product->isRecommend())
                    <span class="recommend">Рекомендуем</span><br>
                @endif
                @if($product->isHit())
                    <span class="hit">Хит продаж</span><br>

                @endif
            </div>
        </div>
        <div class="product-body" style="height: 200px;">
            <p class="product-category">{{$product->category->name}}</p>
            <h3 class="product-name" style="font-size: 15px;">{{$product->name}}</h3>
            <h4 class="product-price">{{$product->price}} ₸<del class="product-old-price"></del></h4>
            <a class="tooltipp" href="{{route('product-more', [isset($category) ? $category->code : $product->category->code, $product->slug])}}">
                Посмотреть  <i class="fa fa-arrow-circle-right"></i>
            </a>
            <p></p>
            <div class="product-btns">
                @if(Auth::check())
                    @if(( $product->likes->where('user_id',Auth::user()->id)
                            ->where('likeable_id', $product->id)
                            ->where('likeable_type', get_class($product))->first()) == null)

                        <a class="add-to-wishlist" href="{{ route('product-like', $product->id) }}"><i class="fa fa-bookmark-o" style="font-size: 20px"></i> <span class="tooltipp"></span></a>
                    @else
                        <a class="add-to-wishlist" href="{{ route('product-dislike', $product->id) }}"><i class="fa fa-bookmark" style="font-size: 20px"></i> <span class="tooltipp"> </span></a>
                    @endif
                @endif
            </div>
        </div>
        <form action="{{ route('basket-add', $product) }}" method="POST">
            @csrf
            <div class="add-to-cart">
                @if($product->isAvailable())
                    <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>В корзину</button>
                @else
                    <button type="submit" class="add-to-cart-btn" disabled><i class="fa fa-shopping-cart"></i>В корзину</button>
                @endif
            </div>
        </form>
    </div>
</div>
<!-- /product -->
