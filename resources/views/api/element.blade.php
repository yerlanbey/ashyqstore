@extends('layouts.app')
@section('title')
    {{$element['name']}}
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
{{--                        <li><a href="#">{{ Breadcrumbs::render('product-more', $category, $product) }}</a></li>--}}
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
                            <img src="{{$element['images'][0]}}" alt="">
                        </div>
                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product thumb imgs -->
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        <div class="product-preview">
                            <img src="{{$element['images'][0]}}" alt="" >
                        </div>
                    </div>
                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">{{$element['name']}}</h2>
                        <div>
                            <h3 class="product-price">{{$element['price2']}} ₸<del class="product-old-price"></del>
                                <br>
                            </h3>
                            @if ($element['quantity'] > 0)
                                <span class="product-available">В наличий есть</span>
                            @else
                                <span class="product-available">Нет в наличий</span>

                            @endif
                        </div>
                        <p>
                            @php
                               echo $element['description'];
                            @endphp
                        </p>
                        <div class="add-to-cart">

                            <form action="{{ route('element.basket.add', $element['article']) }}" method="POST">
                                @csrf
                                <div class="add-to-cart">
                                    <button type="submit" class="add-to-cart-btn" @if ($element['quantity'] == 0) disabled @endif ><i class="fa fa-shopping-cart"></i>В корзину</button>
                                </div>
                            </form>

                            <form action="{{ route('element.basket.drop', $element['article']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="add-to-cart">
                                    <button type="submit" class="add-to-cart-btn" @if ($element['quantity'] == 0) disabled @endif ><i class="fa fa-shopping-cart"></i>Убрать с корзины</button>
                                </div>
                            </form>
                        </div>
                        <ul class="product-links">
                            <li>Категория:</li>
                            <li><a href="#">{{$category['name']}}</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /Product details -->

                <!-- Product tab -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Описание</a></li>
                            <li><a data-toggle="tab" href="#tab2">Оставить заявку</a></li>
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
                                            @php
                                                echo $element['detailtext'];
                                            @endphp
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <!-- tab3  -->
                            <div id="tab3" class="tab-pane fade in">
                                <div class="row">

{{--                                    <!-- Reviews -->--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div id="reviews">--}}
{{--                                            <ul class="reviews">--}}
{{--                                                <div class="panel-body comment-container" >--}}
{{--                                                    @foreach($comments as $comment)--}}
{{--                                                        <li>--}}
{{--                                                            <div class="review-heading">--}}
{{--                                                                <h5 class="name">{{$comment->name}}</h5>--}}
{{--                                                                <p class="date">{{$comment->created_at}}</p>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="review-body">--}}
{{--                                                                <p>--}}
{{--                                                                    {{$comment->comment}}--}}
{{--                                                                </p>--}}
{{--                                                            </div>--}}
{{--                                                            <div>--}}
{{--                                                                @if(Auth::check())--}}
{{--                                                                    <a style="cursor: pointer;" id="hide" owner = "{{ $comment->name }}" cid="{{ $comment->id }}" name_a="{{ Auth::user()->name }}" token="{{ csrf_token() }}" class="reply">--}}
{{--                                                                        Ответить--}}
{{--                                                                    </a>&nbsp;--}}
{{--                                                                    @if(Auth::user()->id == $comment->user_id)--}}
{{--                                                                        <a style="cursor: pointer;"  href="{{ route('delete.comment', $comment)}}">Удалить</a>--}}
{{--                                                                    @else--}}
{{--                                                                        <p></p>--}}
{{--                                                                    @endif--}}
{{--                                                                @else--}}
{{--                                                                    <p></p>--}}
{{--                                                                @endif--}}
{{--                                                            </div>--}}
{{--                                                            <div class="reply-form">--}}
{{--                                                                <!-- Dynamic Reply form -->--}}
{{--                                                            </div>--}}
{{--                                                            <div style="margin: 5px 10px;">--}}
{{--                                                                @foreach($comment->replies as $rep)--}}
{{--                                                                    @if($comment->id === $rep->comment_id)--}}
{{--                                                                        <div>--}}
{{--                                                                            <i><b> {{ $rep->name }} </b></i>&nbsp;&nbsp;--}}
{{--                                                                            <span> {{ $rep->reply }} </span>--}}
{{--                                                                            <div>--}}
{{--                                                                                @if(Auth::check())--}}
{{--                                                                                    <a rname="{{ Auth::user()->name }}" rid="{{ $comment->id }}" style="cursor: pointer;" class="reply-to-reply" token="{{ csrf_token() }}">--}}
{{--                                                                                        Ответить--}}
{{--                                                                                    </a>--}}
{{--                                                                                    @if(Auth::user()->id == $comment->user_id)--}}
{{--                                                                                        <a did="{{ $rep->id }}" class="delete-reply" token="{{ csrf_token() }}" >--}}
{{--                                                                                            Удалить--}}
{{--                                                                                        </a>--}}
{{--                                                                                    @else--}}
{{--                                                                                        <p></p>--}}
{{--                                                                                    @endif--}}
{{--                                                                                @else--}}
{{--                                                                                    <p></p>--}}
{{--                                                                                @endif--}}
{{--                                                                            </div>--}}

{{--                                                                            <div class="reply-to-reply-form">--}}

{{--                                                                                <!-- Dynamic Reply form -->--}}

{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                    @endif--}}
{{--                                                                @endforeach--}}
{{--                                                            </div>--}}
{{--                                                        </li>--}}
{{--                                                    @endforeach--}}
{{--                                                </div>--}}

{{--                                            </ul>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <!-- /Reviews -->

                                    <!-- Review Form -->
                                    <div class="col-md-3">
                                        <div id="review-form">
                                            <form action="{{ route('post.comment', $element['article'])}}" method="POST" class="review-form">
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
{{--                                    @foreach($products as $product)--}}
{{--                                        @if($category->id == $product->category_id)--}}
{{--                                            @include('inc.card',compact('product'))--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
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

