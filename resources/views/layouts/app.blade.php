<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('assets/css/libs.css') }}">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                      @if(Auth::check())
                        <li><a href="{{ url('/home') }}">Home</a></li>
                        @can('admin-access')
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Manage <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('categories.index') }}"><i class="fa fa-btn fa-tags"></i>Categories</a></li>
                            <li><a href="{{ route('products.index') }}"><i class="fa fa-btn fa-gift"></i>Products</a></li>
                            <li><a href="{{ route('orders.index') }}"><i class="fa fa-btn fa-shopping-cart"></i>Orders</a></li>
                            </ul>
                          </li>
                        @endcan
                      @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">

                      @include('layouts._customer-feature', ['partial_view'=>'layouts._check-order-menu-bar', 'data'=>[]])

                      @include('layouts._customer-feature', ['partial_view'=>'layouts._cart-menu-bar'])

                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
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

          <div class="container">
            @include('flash::message')
          </div>

        @yield('content')

    </div>

    <!-- Scripts -->
    <script src="{{ mix('assets/js/app.js') }}"></script>
    <script src="{{ mix('assets/js/all.js') }}"></script>
    <script src="{{ mix('assets/js/libs.js') }}"></script>
    <script src="{{ mix('assets/js/custom.js') }}"></script>

    @if (Session::has('flash_product_name'))
      @include('catalogs._product-added', ['product_name' => Session::get('flash_product_name')])
    @endif
</body>
</html>
