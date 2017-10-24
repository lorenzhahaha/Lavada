<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('lavada-icon.png') }}" type="image/x-icon">
    <title>Lavada</title>

    <!-- CSS Links -->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/css/freelancer.min.css') }}">
</head>
<body id="page-top" class="index">
    <div id="app">
        <!-- Navigation -->
        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="#page-top"> Lavada </a>
                </div>

                @if (Auth::user())
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                        <li class="collapse page-scroll">
                            <a href="#portfolio"><i class="fa fa-shopping-bag"></i>&nbsp;Products</a>
                        </li>
                        <li class="collapse page-scroll">
                            <a href="#about"><i class="fa fa-info-circle"></i>&nbsp;About</a>
                        </li>
                        <li class="collapse page-scroll">
                            <a href="#contact"><i class="fa fa-phone"></i>&nbsp;Contact</a>
                        </li>
                        @endif

                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            
                        @else
                            <li class="collapse page-scroll sign-in">
                                <a href="#" onclick="event.preventDefault();
                                document.getElementById('cart-form').submit();">
                                    <span class="badge"> {{ $count_cart }} </span> &nbsp; My Cart
                                </a>
                            </li>
                            <form id="cart-form" action="/show-cart" method="get" style="display: none;">
                                {{ csrf_field() }}
                                <input type="hidden" name="customer_id" value="{{ Auth::user()->id }}">
                            </form>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <font style="color: #18BC9C; font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;">
                                                <i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;
                                                Logout
                                            </font>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('template/vendor/jquery/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('template/vendor/js/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('template/vendor/js/contact_me.js') }}"></script>
    <script src="{{ asset('template/vendor/js/freelancer.min.js') }}"></script>
</body>
</html>
