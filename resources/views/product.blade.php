@extends('layouts.app')
@section('title')
    {{$product->name}}
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
                        <li><a href="#">{{ Breadcrumbs::render('product-more', $category, $product) }}</a></li>
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
            @if(session()->has('success'))
                <p class="alert alert-success">{{ session()->get('success') }}</p>
            @elseif(session()->has('warning'))
                <p class="alert alert-warning">{{ session()->get('warning') }}</p>
            @endif
            <!-- row -->
            <div class="row">
                <!-- Product main img -->
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        <div class="product-preview">
                            @if(!is_null($product->image))
                                <img src="{{Storage::url($product->image)}}" alt="">
                            @else
                                <img src="{{asset('/img/image_icon.png')}}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product thumb imgs -->
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        @foreach($product->photos as $photo)
                            <div class="product-preview">
                                <img src="{{ Storage::url($photo->image)}}" alt="" >
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">{{$product->name}}</h2>
                        <div>
                            <h3 class="product-price">{{$product->price}} ₸<del class="product-old-price"></del></h3>
                            @if($product->isAvailable())
                                <span class="product-available">В наличий</span>
                            @else
                                <span class="product-available">Нет в наличий</span>
                            @endif
                        </div>
                        <p>
                            {{$product->description}}
                        </p>
                        <div class="add-to-cart">

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

                        <ul class="product-btns">
                            @if(Auth::check())
                                @if(( $product->likes->where('user_id',Auth::user()->id)
                                        ->where('likeable_id', $product->id)
                                        ->where('likeable_type', get_class($product))->first()) == null)

                                    <a class="add-to-wishlist" href="{{ route('product-like', $product->id) }}"><i class="fa fa-bookmark-o" style="font-size: 20px"></i> В избранные<span class="tooltipp"></span></a>
                                @else
                                    <a class="add-to-wishlist" href="{{ route('product-dislike', $product->id) }}"><i class="fa fa-bookmark" style="font-size: 20px"></i> Удалить из избранного<span class="tooltipp"> </span></a>
                                @endif
                            @endif
                        </ul>

                        <ul class="product-links">
                            <li>Категория:</li>
                            <li><a href="#">{{$product->category->name}}</a></li>
                        </ul>
                        @isset($product->size)
                            <ul class="product-links">
                                <label for="size">Размеры:</label><br>
                                <select name="size" id="size" class="form-control">
                                    <option disabled="disabled" selected="selected" value>Выберите размер</option>

                                    @foreach($product->size as $size)
                                        <option>{{$size}}</option>
                                    @endforeach
                                </select>
                            </ul>
                        @endisset
                        @isset($product->color)
                            <ul class="product-links">
                                <label for="size">Цвета:</label><br>
                                    @foreach($product->color as $color)
                                        <div class="color" style="width: 50px; height: 50px; background-color: {{$color}}; float: left; margin: auto">
                                        </div>
                                    @endforeach
                            </ul>
                        @endisset
                    </div>
                </div>
                <!-- /Product details -->

                <!-- Product tab -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Описание</a></li>
                            @if(!$product->isAvailable())
                                <li><a data-toggle="tab" href="#tab2">Оставить заявку</a></li>
                            @endif
                            <li><a data-toggle="tab" href="#tab3">Комментарий</a></li>
                        </ul>
                        <!-- /product tab nav -->

                        <!-- product tab content -->
                        <div class="tab-content">
                            <!-- tab1  -->
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            {{$product->description}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab1  -->
                        @if(!$product->isAvailable())
                            <!-- tab2  -->
                                <div id="tab2" class="tab-pane fade in">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="newsletter">
                                                <small>Данное время этот товар в наличий нету</small>
                                                <br>
                                                <p style="font-size: 15px;">Вы можете оставить свои данные чтоб мы могли с вами связаться когда товар появится в <strong>наличий</strong></p>

                                                <form action="{{ route('subscribe', $product)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input class="input" type="text" placeholder="Email" name="email">
                                                    <button type="submit" class="newsletter-btn"><i class="fa fa-envelope"></i> Отправить</button>
                                                </form>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- /tab2  -->
                        @endif
                        <!-- tab3  -->
                            <div id="tab3" class="tab-pane fade in">
                                <div class="row">

                                    <!-- Reviews -->
                                    <div class="col-md-6">
                                        <div id="reviews">
                                            <ul class="reviews">
                                                <div class="panel-body comment-container" >
                                                    @foreach($comments as $comment)
                                                        <li>
                                                            <div class="review-heading">
                                                                <h5 class="name">{{$comment->name}}</h5>
                                                                <p class="date">{{$comment->created_at}}</p>
                                                            </div>
                                                            <div class="review-body">
                                                                <p>
                                                                    {{$comment->comment}}
                                                                </p>
                                                            </div>
                                                            <div>
                                                                @if(Auth::check())
                                                                    <a style="cursor: pointer;" id="hide" owner = "{{ $comment->name }}" cid="{{ $comment->id }}" name_a="{{ Auth::user()->name }}" token="{{ csrf_token() }}" class="reply">
                                                                        Ответить
                                                                    </a>&nbsp;
                                                                    @if(Auth::user()->id == $comment->user_id)
                                                                        <a style="cursor: pointer;"  href="{{ route('delete.comment', $comment)}}">Удалить</a>
                                                                    @else
                                                                        <p></p>
                                                                    @endif
                                                                @else
                                                                    <p></p>
                                                                @endif
                                                            </div>
                                                            <div class="reply-form">
                                                                <!-- Dynamic Reply form -->
                                                            </div>
                                                            <div style="margin: 5px 10px;">
                                                                @foreach($comment->replies as $rep)
                                                                    @if($comment->id === $rep->comment_id)
                                                                        <div>
                                                                            <i><b> {{ $rep->name }} </b></i>&nbsp;&nbsp;
                                                                            <span> {{ $rep->reply }} </span>
                                                                            <div>
                                                                                @if(Auth::check())
                                                                                    <a rname="{{ Auth::user()->name }}" rid="{{ $comment->id }}" style="cursor: pointer;" class="reply-to-reply" token="{{ csrf_token() }}">
                                                                                        Ответить
                                                                                    </a>
                                                                                    @if(Auth::user()->id == $comment->user_id)
                                                                                        <a did="{{ $rep->id }}" class="delete-reply" token="{{ csrf_token() }}" >
                                                                                            Удалить
                                                                                        </a>
                                                                                    @else
                                                                                        <p></p>
                                                                                    @endif
                                                                                @else
                                                                                    <p></p>
                                                                                @endif
                                                                            </div>

                                                                            <div class="reply-to-reply-form">

                                                                                <!-- Dynamic Reply form -->

                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </div>

                                            </ul>

                                        </div>
                                    </div>
                                    <!-- /Reviews -->

                                    <!-- Review Form -->
                                    <div class="col-md-3">
                                        <div id="review-form">
                                            <form action="{{ route('post.comment', $product->slug)}}" method="POST" class="review-form">
                                                @csrf
                                                <textarea name="comment" id="comment" class="input"
                                                          @if(Auth::check())
                                                          placeholder="Сообщение"
                                                          @else
                                                          placeholder="Чтобы оставить комментарий зарегистрируйтесь на нашем сайте"
                                                          @endif
                                                          style="width: 500px;height: 150px;"></textarea>

                                                @if(Auth::check())
                                                    <button type="submit" class="primary-btn">Отправить</button>
                                                @else
                                                    <button type="submit" class="primary-btn" disabled >Отправить</button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /Review Form -->
                                </div>
                            </div>
                            <!-- /tab3  -->
                        </div>
                        <!-- /product tab content  -->
                    </div>
                </div>
                <!-- /product tab -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- Section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="title">СОПУТСТВУЮЩИЕ ТОВАРЫ</h3>
                    </div>
                </div>

                <!-- product -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @foreach($products as $product)
                                        @if($category->id == $product->category_id)
                                            @include('inc.card',compact('product'))
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /product -->
                <div class="clearfix visible-sm visible-xs"></div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>





@endsection
<script>
    $(document).ready(function(){
        $("#hide").click(function(){
            $("p").hide();
        });
        $("#show").click(function(){
            $("p").show();
        });
    });
</script>

