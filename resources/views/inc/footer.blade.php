<!-- NEWSLETTER -->
<div id="newsletter" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="newsletter">
                    <p>Мы открыты для <strong>Сотрудничества</strong></p>
                    <small>Оставьте свои данные и мы свяжемся свами</small>
                    <form  action="{{route('store.cooperation')}}" method="POST" class="review-form">
                        @csrf
                        <input class="input" style="border-radius: 20px" id="first_name" name="first_name" type="text" placeholder="Имя">
                        <input class="input" style="border-radius: 20px" id="phone_number" name="phone_number" type="text" placeholder="Номер телефона">
                        <div class="input-rating"></div>
                        <button type="submit" class="primary-btn">Отправить</button>
                    </form>
                    <ul class="newsletter-follow">
                        <li>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-vk"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /NEWSLETTER -->

<!-- FOOTER -->
<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-map-marker"></i>Shymkent, Kazakhstan</a></li>
                            <li><a href="#"><i class="fa fa-phone"></i>+7707-971-67-91</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i>razumgroup@gmail.com</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Категорий</h3>
                        <ul class="footer-links">
                            @foreach(DB::table('themes')->get() as $category)
                            <li><a href="{{route('index.theme', $category->code)}}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="clearfix visible-xs"></div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Информация</h3>
                        <ul class="footer-links">
                            <li><a href="">О нас</a></li>
                            <li><a href="#">Связаться с нами</a></li>
                            <li><a href="#">Правила</a></li>

                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Сервисы</h3>
                        <ul class="footer-links">
                            <li><a href="#">Личный кабинет</a></li>
                            <li><a href="#">Корзина</a></li>
                            <li><a href="#">Избранные</a></li>
                            <li><a href="#">Заказы</a></li>
                            <li><a href="#">Помощь</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->

    <!-- bottom footer -->
    <div id="bottom-footer" class="section">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul class="footer-payments">
                        <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>

                        <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>

                    </ul>
                    <span class="copyright">
                        &copy;2021 Все права защищены
                    </span>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bottom footer -->
</footer>
<!-- /FOOTER -->

<!-- jQuery Plugins -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/slick.min.js')}}"></script>
<script src="{{asset('js/nouislider.min.js')}}"></script>
<script src="{{asset('js/jquery.zoom.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('/js/comment.js') }}"></script>

</body>
</html>


