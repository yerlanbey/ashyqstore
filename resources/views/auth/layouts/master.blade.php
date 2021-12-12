<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Админ |@yield('title')</title>
    <meta name="description" content="Responsive, Bootstrap, BS4" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- for ios 7 style, multi-resolution icon of 152x152 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <link rel="apple-touch-icon" href="images/logo.png">
    <meta name="apple-mobile-web-app-title" content="Flatkit">
    <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" sizes="196x196" href="images/logo.png">

    <!-- style -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css"  rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/font-awesome/css/font-awesome.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/ionicons/css/ionicons.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css" />
    <!-- build:css css/styles/app.min.css -->
    <link rel="stylesheet" href="{{asset('css/styles/app.css')}}" type="text/css" />
    <!-- endbuild -->

</head>
<body>

<div class="app" id="app">
    <div id="aside" class="app-aside fade nav-dropdown black">

        <div class="navside dk" data-layout="column">
            <div class="navbar no-radius">
                <a href="{{ route('index-html') }}" class="navbar-brand">
                    <div data-ui-include="'images/logo.svg'"></div>
                    <img src="images/logo.png" alt="." class="hide">
                    <span class="hidden-folded inline">ASHYQSTORE</span>
                </a>
            </div>
            <div data-flex class="hide-scroll">
                <nav class="scroll nav-stacked nav-stacked-rounded nav-color">
                    <ul class="nav" data-ui-nav>
                        @if(app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('shop_create') || app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('market_create') || app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('restaurant_create'))
                            <li class="nav-header hidden-folded">
                                <span class="text-xs">Создать </span>
                            </li>
                        @endif
                        @can('shop_create')
                            <a href="{{route('shop.create', Auth::user())}}" class="b-danger"  style="text-align: center">
                                <span class="nav-text">Магазин одежды</span>
                            </a>
                        @endcan
                        @can('market_create')
                            <a href="{{ route('market.create', Auth::user()) }}" class="b-danger"  style="text-align: center">
                                <span class="nav-text">Продуктовый магазин</span>
                            </a>
                        @endcan
                        @can('restaurant_create')
                            <a href="{{ route('restaurant.create', Auth::user()) }}" class="b-danger"  style="text-align: center">
                                <span class="nav-text">Заведение</span>
                            </a>
                        @endcan
                        <li class="nav-header hidden-folded m-t">
                            <span class="text-xs">Панель управления</span>
                        </li>
                        @if(app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('shop_create') || app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('market_create') || app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('restaurant_create'))
                            <li>
                            <a>
                            <span class="nav-caret">
                            <i class="fa fa-caret-down"></i>
                            </span>
                                <span class="nav-icon">
                                <i class="ion-ios-photos"></i>
                                </span>
                                <span class="nav-text">Мои проекты</span>
                            </a>
                            <ul class="nav-sub nav-mega">
                                @if(app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product_access') && app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('shop_access'))
                                    @foreach(Auth::user()->shops as $shop)
                                        <li>
                                            <a href="{{ route('product.index', $shop->slug) }}" >
                                                <span class="nav-text">{{$shop->name}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                                @if(app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('food_access') && app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('market_access'))
                                        @foreach(Auth::user()->markets as $market)
                                        <li>
                                            <a href="{{ route('food.index', $market->slug) }}"  >
                                                <span class="nav-text">{{$market->name}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                                @if(app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dish_access') && app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('restaurant_access'))
                                    @foreach(Auth::user()->restaurants as $restaurant)
                                        <li>
                                            <a href="{{ route('dish.index', $restaurant->slug) }}"  >
                                                <span class="nav-text">{{$restaurant->name}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                        @endif
                        <li>
                            <a>
                            <span class="nav-caret">
                            <i class="fa fa-caret-down"></i>
                            </span>
                                <span class="nav-icon">
                                <i class="ion-plus-circled"></i>
                                </span>
                                <span class="nav-text">Управление</span>
                            </a>
                            @auth
                                <ul class="nav-sub">
                                    @can('category_access')
                                        <li>
                                            <a href="{{ route('categories.index') }}" >
                                                <span class="nav-text">Категории</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('product_access')
                                        <li>
                                            <a href="{{ route('products.index') }}" >
                                                <span class="nav-text">Товары</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('photo_access')
                                        <li>
                                            <a href="{{ route('photos.index') }}" >
                                                <span class="nav-text">Фото товаров</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('comment_access')
                                        <li>
                                            <a href="{{ route('comments.index') }}" >
                                                <span class="nav-text">Комментарий</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('order_access')
                                        <li>
                                            <a href="{{ route('home') }}" >
                                                <span class="nav-text">Заказы</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                                <ul class="nav-sub">
                                    @can('cooperation_show')
                                        <li>
                                            <a href="{{route('index.cooperation')}}" >
                                                <span class="nav-text">Сотрудничество</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('user_access')
                                        <li>
                                            <a href="{{ route('user.index') }}" >
                                                <span class="nav-text">Пользователи</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('shop_access')
                                        <li>
                                            <a href="{{ route('shops.index') }}" >
                                                <span class="nav-text">Заведений</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('product_access')
                                        <li>
                                            <a href="{{ route('mainproducts.index') }}" >
                                                <span class="nav-text">Товары</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('category_access')
                                        <li>
                                            <a href="{{ route('maincategory.index') }}" >
                                                <span class="nav-text">Категории</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('comment_access')
                                        <li>
                                            <a href="{{ route('devcomments.index') }}" >
                                                <span class="nav-text">Комментарий</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('color_access')
                                        <li>
                                            <a href="{{ route('color.index') }}" >
                                                <span class="nav-text">Цветы</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @if(\Illuminate\Support\Facades\Auth::user()->mainAdmin())
                                        <li>
                                            <a href="{{ route('reset') }}" >
                                                <span class="nav-text">Сбросить</span>
                                            </a>
                                        </li>
                                    @endif
                                    @can('theme_access')
                                        <li>
                                            <a href="{{ route('themes.index') }}" >
                                                <span class="nav-text">Категорий заведений</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>

                                <ul class="nav-sub">
                                    <li>
                                        <a href="{{ route('chosen', Auth::user()->id) }}" >
                                            <span class="nav-text">Избранные</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('client.orders.index')}}">
                                            <span class="nav-text">Ваши заказы</span>
                                        </a>
                                    </li>
                                </ul>
                        @endauth
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div id="content" class="app-content box-shadow-z2 bg pjax-container" role="main">
        <div class="app-header white bg b-b">
            <div class="navbar" data-pjax>
                <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up p-r m-a-0">
                    <i class="ion-navicon"></i>
                </a>
                <ul class="nav navbar-nav pull-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link clear" data-toggle="dropdown">
                            <span class="avatar w-32">
                                @if(!is_null(Auth::user()->image) )
                                        <img src="{{Storage::url(Auth::user()->image)}}" class="w-full rounded" alt="...">
                                    @else
                                        <img src="{{asset('img/default_image.jpg')}}"  class="w-full rounded" alt="...">
                                @endif
                            </span>
                        </a>
                        <div class="dropdown-menu w dropdown-menu-scale pull-right">
                            <a class="dropdown-item" href="{{ route('profile.show', Auth::user()->id) }}">
                                <span>Профиль</span>
                            </a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}">Выйти</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="app-footer white bg p-a b-t">
            <div class="pull-right text-sm text-muted">Версия 0.1</div>
            <span class="text-sm text-muted">&copy; Все права защищены</span>
        </div>
        <div class="app-body">
        @yield('content-section')
            <a class="md-btn md-fab m-b-sm white" href="{{route('index-html') }}"><i class="fa fa-home"></i></a>
        </div>
    </div>
    <div id="switcher">
        <div class="switcher dark-white" id="sw-theme">
            <a href="#" data-ui-toggle-class="active" data-ui-target="#sw-theme" class="dark-white sw-btn">
                <i class="fa fa-gear text-muted"></i>
            </a>
            <div class="box-header">
                <strong>Настройки темы</strong>
            </div>
            <div class="box-divider"></div>
            <div class="box-body">
                <p id="settingLayout" class="hidden-md-down">
                    <label class="md-check m-y-xs" data-target="folded">
                        <input type="checkbox">
                        <i></i>
                        <span>Скрыть бар</span>
                    </label>
                </p>
                <p>Темы:</p>
                <div data-target="bg" class="clearfix">
                    <label class="radio radio-inline m-a-0 ui-check ui-check-lg">
                        <input type="radio" name="theme" value="">
                        <i class="light"></i>
                    </label>
                    <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-lg">
                        <input type="radio" name="theme" value="grey">
                        <i class="grey"></i>
                    </label>
                    <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-lg">
                        <input type="radio" name="theme" value="dark">
                        <i class="dark"></i>
                    </label>
                    <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-lg">
                        <input type="radio" name="theme" value="black">
                        <i class="black"></i>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="{{asset('libs/jquery/dist/jquery.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('libs/bootstrap/dist/js/bootstrap.js')}}"></script>
<!-- JS -->
<script src="{{asset('libs/jQuery-Storage-API/jquery.storageapi.min.js')}}"></script>
<script src="{{asset('scripts/ui-load.js')}}"></script>
<script src="{{asset('scripts/ui-nav.js')}}"></script>
<script src="{{asset('scripts/ui-toggle-class.js')}}"></script>
<script src="{{asset('scripts/app.js')}}"></script>


{{--select2 plugin--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>

<!-- endbuild -->
</body>
</html>
