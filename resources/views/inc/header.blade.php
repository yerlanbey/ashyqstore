
<!-- HEADER -->
<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> +7707-971-67-91</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> razumgroup@gmail.com</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> Shymkent, Kazakhstan</a></li>
            </ul>
            <ul class="header-links pull-right">
                <li><a href="{{ route('product.categories') }}"><i class="fa fa-list-alt"></i> Категорий</a></li>
                @guest
                <li><a href="{{ route('login') }}"><i class="fa fa-user-o"></i> Вход</a></li>
                @endguest
                @auth
                    @if(Auth::user()->MainAdmin())
                        <li><a href="{{ route('user.index') }}"><i class="fa fa-user-o"></i> Панель разработчика</a></li>
                    @elseif(Auth::user()->isAdmin())
                        <li><a href="{{ route('home') }}"><i class="fa fa-user-o"></i> Панель администратора</a></li>
                    @else
                        <li><a href="{{ route('client.orders.index') }}"><i class="fa fa-user-o"></i> Личный кабинет</a></li>
                    @endif
                        <li><a href="{{ route('get-logout') }}"><i class="fa fa-sign-out"></i>Выйти</a></li>
                @endauth


            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="#" class="logo">
                            <h2 class="logo" style="margin-top: 15px;">
                                <a href="{{route('index-html')}}" style="color: white;">
                                    RAZUM GROUP
                                </a>
                            </h2>
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search" >
                        <form action="{{ route('search') }}" method="get">
                            @csrf
                            <input style="position: relative" class="input" name="searching" type="search" placeholder="Поиск">
                            <button class="search-btn" type="submit">Поиск</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Wishlist -->
                        <div>
                            @if(Auth::check())
                                <a href="{{ route('chosen', Auth::user()->id) }}">
                                    <i class="fa fa-heart-o"> </i> <span>Избранные</span>
                                </a>
                            @endif
                        </div>
                        <!-- /Wishlist -->

                        <!-- Cart -->
                                <div class="cart-btns">
                                    <a href="{{route('basket-check')}}"><i class="fa fa-shopping-cart"></i>
                                        Корзина
                                    </a>
                                </div>
                        <!-- /Cart -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle" style="position: relative; right: 16px">
                            <section class="top-nav">
                                <input id="menu-toggle" type="checkbox" />
                                <label class='menu-button-container' for="menu-toggle">
                                    <div class='menu-button'></div>
                                </label>
                                <ul class="menu">
                                    <a href="{{route('products.list')}}">Товары</a>
                                    <a href="{{ route('product.categories') }}">Категория</a>
                                </ul>
                            </section>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->
<style>
    h2 {
        vertical-align: center;
        text-align: center;
    }
    html, body {
        margin: 0;
        height: 100%;
    }
    .top-nav {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        color: #fff;
        height: 70px;
        left: 10px;
        padding: 1em;
    }
    .menu {
        display: flex;
        flex-direction: row;
        list-style-type: none;
        margin: 0;
        padding: 0;
    }
    .menu > a {
        margin: 0 1rem;
        overflow: hidden;
    }
    .menu-button-container {
        display: none;
        height: 100%;
        width: 95px;
        margin-left: 15px;
        text-align: left;
        cursor: pointer;
        flex-direction: column;
        justify-content: center;

    }
    #menu-toggle {
        display: none;
    }
    .menu-button, .menu-button::before, .menu-button::after {
        display: block;
        background-color: #fff;
        position: absolute;
        height: 4px;
        width: 25px;
        transition: transform 400ms cubic-bezier(0.23, 1, 0.32, 1);
        border-radius: 2px;
    }
    .menu-button::before {
        content: '';
        margin-top: -8px;
    }
    .menu-button::after {
        content: '';
        margin-top: 8px;
    }
    #menu-toggle:checked + .menu-button-container .menu-button::before {
        margin-top: 0px;
        transform: rotate(405deg);
    }
    #menu-toggle:checked + .menu-button-container .menu-button {
        background: rgba(255, 255, 255, 0);
    }
    #menu-toggle:checked + .menu-button-container .menu-button::after {
        margin-top: 0px;
        transform: rotate(-405deg);
    }
    @media (max-width: 700px) {
        .menu-button-container {
            display: flex;
        }
        .menu {
            position: absolute;
            top: 0;
            margin-top: 50px;
            left: 0;
            flex-direction: column;
            width: 100%;
            justify-content: center;
            align-items: center;
        }
        #menu-toggle ~ .menu a {
            height: 0;
            margin: 0;
            padding: 0;
            border: 0;
            transition: height 400ms cubic-bezier(0.23, 1, 0.32, 1);
        }
        #menu-toggle:checked ~ .menu a {
            border: 1px solid #333;
            height: 2.5em;
            padding: 0.5em;
            transition: height 400ms cubic-bezier(0.23, 1, 0.32, 1);
        }
        .menu > a {
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0.5em 0;
            width: 100%;
            color: white;
            background-color: #222;
        }
        .menu > a:not(:last-child) {
            border-bottom: 1px solid #444;
        }
    }

</style>

<script>
    function menu() {
        var x = document.getElementById("menuElements");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }
</script>
