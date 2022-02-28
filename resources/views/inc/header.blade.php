
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
                            <select class="input-select" name="select">
                                @if(request()->select == 'По магазинам')
                                    <option value="По магазинам" name="shops">По магазинам</option>
                                    <option value="По продуктам" name="products">По продуктам</option>
                                @elseif(request()->select == 'По продуктам')
                                    <option value="По продуктам" name="products">По продуктам</option>
                                    <option value="По магазинам" name="shops">По магазинам</option>
                                @else
                                    <option value="По магазинам" name="shops">По магазинам</option>
                                    <option value="По продуктам" name="products">По продуктам</option>
                                @endif
                            </select>
                            <input class="input" name="searching" type="search" placeholder="Поиск">
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
                                <i class="fa fa-heart-o"></i>
                                    <span>Избранные</span>
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
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
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



