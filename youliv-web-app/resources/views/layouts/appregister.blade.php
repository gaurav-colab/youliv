<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<link rel="icon" href="{{ url ('app_asset/images/youliv_favicon2.png') }}" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{$site_title}}</title>
	<meta name='description' content='{{$meta_description}}'>

    <!-- Scripts -->
    <script src="{{ asset($server_path.'app_asset/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- Styles -->
    <link href="{{ asset($server_path.'app_asset/css/app.css') }}" rel="stylesheet">
    <meta charset="utf-8">
	<link rel="icon" href="#" type="image/x-icon">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="jQuery Responsive Carousel - Owl Carusel">
	<link href="{{ url($server_path.'app_asset/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ url($server_path.'app_asset/css/owl.carousel.min.css') }}" rel="stylesheet">
	 <link href="{{ url($server_path.'app_asset/css/owl.carousel.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{ url($server_path.'app_asset/css/style.css') }}">
	<link rel="stylesheet" href="{{ url($server_path.'app_asset/css/responsive.css') }}">
   <link rel="stylesheet" href="{{ url($server_path.'app_asset/css/animate.css') }}">
   <script src="{{ url($server_path.'app_asset/js/jquery.min.js') }}"></script>
   <script src="{{ asset($server_path.'js/jquery.validate.min.js')}}"></script>

</head>
<body>
@include('layouts.popup')

    <div id="app">
    <header>
        <div class="head">

        </div>
    </header>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
