Уважаемый клиент, продукт {{ $product->name }} появился в наличий


<a href="{{ route('product-more', [$product->category->code, $product->slug]) }}"> Подробнее </a>
