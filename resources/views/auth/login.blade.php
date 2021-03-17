<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Ashyqstore | Авторизация</title>
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
                <a href="{{route('index-html')}}" class="navbar-brand">

                    <span class="hidden-folded inline">ASHYQSTORE | Закажи где хочешь</span>
                </a>
                <!-- / brand -->
            </div>
        </div>
    </div>
    <div class="b-t">
        <div class="center-block w-xxl w-auto-xs p-y-md text-center">
            <div class="p-a-md">
                <div>
                    <span  style="font-size: 25px;">
                        Авторизация
                    </span>
                </div>
                <div class="m-y text-sm">
                    <br>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                               class="form-control  @error('email') is-invalid @enderror"
                               placeholder="Электронная почта" required autocomplete="email" autofocus>
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Пароль" required autocomplete="current-password">
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="m-b-md" style="text-align: left">
                        <label class="md-check">
                            <input class="form-check-input" type="checkbox"
                                   name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <i class="primary"></i> Запомнить меня
                        </label>
                    </div>
                    <button type="submit" class="btn black btn-block p-x-md" >Войти</button>
                </form>
                @if (Route::has('password.request'))
                <div class="m-y">
                    <a href="{{ route('password.request') }}" class="_600">Забыли пароль?</a>
                </div>
                @endif
                <div>
                    Впервые в Ashyqstore?
                    <a href="{{route('register')}}" class="text-primary _600">Зарегистрироваться</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ############ LAYOUT END-->
</div>
</body>
</html>
