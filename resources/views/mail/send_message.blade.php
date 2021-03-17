<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Ashyqstore | @yield('title')</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{asset('css/slick.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/slick-theme.css')}}"/>

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{asset('css/nouislider.min.css')}}"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>

<p>Уважаемый {{ $name }}</p>
<p>Ваш заказ на сумму {{$fullSum}}₸ был создан</p>
<div class="bd-example">
    <table class="table table-success table-striped">
        <thead>
        <tr>
            <th scope="col">Картинка</th>
            <th scope="col">Имя</th>
            <th scope="col">Кол-во</th>
            <th scope="col">Цена за еденицу</th>
            <th scope="col">Цена</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->products as $product)
            <tr>
                <td>
                    <img height="56px" src="{{ Storage::url($product->image)}} ">
                </td>
                <td>
                    <a href="{{ route('product-more',[$product->category->code, $product->code]) }}">
                        {{$product->name}}
                    </a>
                </td>
                <td>{{$product->pivot->count}}</td>
                <td>{{$product->price}} ₸</td>
                <td>{{$product->getPriceForCount()}} ₸</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">Общая стоимость:</td>
            <td>{{$order->getFullPrice()}} ₸</td>
        </tr>
        </tbody>

    </table>
</div>
</body>
</html>
