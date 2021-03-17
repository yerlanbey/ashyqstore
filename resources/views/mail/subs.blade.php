Уважаемый клиент, продукт {{ $product->name }} появился в наличий


<a href="{{ route('product-more', [$product->category->code, $product->code]) }}"> Подробнее </a>
