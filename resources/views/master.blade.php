<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <title>@section('title') Demo - Easy for pay @show</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
      

      <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:100,300,400' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Anton' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="{{ asset('css/custom-jquery.sidr.dark.css') }}">
      <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
      <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
      <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">
      <link rel="stylesheet" href="{{ asset('css/jquery.selectBoxIt.css') }}">
      <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
      <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
      <link rel="stylesheet" href="{{ asset('css/Font-Awesome/css/font-awesome.css') }}">
      <link rel="stylesheet" href="{{ asset('css/build.css') }}">
      <link rel="stylesheet" href="{{ asset('css/creamos.css') }}">

      @yield('styles')

  </head>

  <body>

    <div class="blur-bk">
        <nav class="container navbar navbar-default" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-collapse">
                    <span class="sr-only">Barra de productos</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            @include('shopping_cart')

            <h1 class="logo hidden-xs"><a href="{{ url('/') }}"><img src="{{ asset('img/logo-corral.png') }}" alt="Logo ElCorral - La receta original"/></a></h1>
            <!-- /container-fluid -->
        </nav>

        @include('_left_menu')

        @yield('content')

    </div><!-- /blur-bk -->
    
    <script src="{{ asset('js/vendor/jquery-1.10.1.min.js') }}"></script>
    
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/vendor/scrollReveal.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sidr.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.improved.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery.selectBoxIt.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery.fitvids.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery.elevatezoom.js') }}"></script>
    <script src="{{ asset('js/viewportchecker.js') }}"></script> 

    <script src="{{ asset('js/main.js') }}"></script>

    @yield('scripts_shopping_cart')
    @yield('scripts')

  </body>
</html>

