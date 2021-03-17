<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Ashyqstore | Сброс пароля</title>
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
    <link rel="stylesheet" href="{{asset('css/font-awesome/css/font-awesome.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/ionicons/css/ionicons.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css" />
    <!-- build:css css/styles/app.min.css -->
    <link rel="stylesheet" href="{{asset('css/styles/app.css')}}" type="text/css" />
    <!-- endbuild -->

</head>
<body>

<div class="app" id="app">

    <!-- ############ LAYOUT START-->

    <div class="padding">
        <div class="navbar">
            <div class="pull-center">
                <!-- brand -->
                <a href="index.html" class="navbar-brand">
                    <div data-ui-include="'images/logo.svg'"></div>
                    <img src="images/logo.png" alt="." class="hide">
                    <span class="hidden-folded inline">ASHYQSTORE | Заказывай где хочешь</span>
                </a>
                <!-- / brand -->
            </div>
        </div>
    </div>
    <div class="b-t">
        <div class="center-block w-xxl w-auto-xs p-y-md text-center">
            <div class="p-a-md">
                <div>
                    <h4>Забыли пароль?</h4>
                    <p class="text-muted m-y">
                        Введите свой адрес электронной почты ниже, и мы отправим вам инструкции по изменению пароля.
                    </p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            На ваш электронный адрес было отправлено сообщение
                        </div>
                    @endif
                </div>
                <form  method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" placeholder="Электронная почта" required autocomplete="email" autofocus>
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn black btn-block p-x-md" >Отправить</button>
                </form>
                <div class="p-y-lg">
                    Вернуться к
                    <a href="{{route('login')}}" class="text-primary _600">Войти</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ############ LAYOUT END-->
</div>
</body>
</html>
