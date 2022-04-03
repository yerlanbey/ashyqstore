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
                    <span class="hidden-folded inline">RAZUMGROUP</span>
                </a>
                <!-- / brand -->
            </div>
        </div>
    </div>
    <div class="b-t">
        <div class="center-block w-xxl w-auto-xs p-y-md text-center">
            <div class="p-a-md">
                <div>
                    <h4>Сброс пароля</h4>
                    <p class="text-muted m-y">
                        <br>
                    </p>
                </div>
                <form  method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ $email ?? old('email') }}"
                               required autocomplete="email" autofocus placeholder="Электронная почта">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="new-password" placeholder="Пароль">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="password-confirm" type="password"
                               class="form-control" name="password_confirmation"
                               required autocomplete="new-password" placeholder="Подвердите пароль">
                    </div>
                    <button type="submit" class="btn black btn-block p-x-md" >Сбросить</button>
                </form>
            </div>
        </div>
    </div>

    <!-- ############ LAYOUT END-->
</div>
</body>
</html>
