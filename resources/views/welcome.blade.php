<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('lavada-icon.png')}}" type="image/x-icon">
        <title>Welcome to Lavada - Your nonstop shopping outlet.</title>

        <!-- CSS Links -->
        <link rel="stylesheet" type="text/css" href="{{ asset('template/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/css/freelancer.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('template/font-awesome/css/font-awesome.min.css') }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>
                </div>
            @if (Route::has('login'))
                <div class="navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                         <li class="collapse page-scroll">
                            <a href="{{ url('/home') }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i>&nbsp;Home</a>
                        </li>
                    @else
                        <li class="collapse page-scroll">
                            <a href="{{ url('/login') }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i>&nbsp;Login</a>
                        </li>  
                        <li class="collapse page-scroll">
                            <a href="{{ url('/register') }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i>&nbsp;Register</a>
                        </li>
                    @endif
                    </ul>
                </div>
            @endif
            </div>
        </nav>

        <div class="flex-center position-ref full-height">
            <div class="content">
                <img src="{{ asset('lavada-icon.png') }}" width="15%" height="auto">
                <div class="title m-b-md">
                    Lavada
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
