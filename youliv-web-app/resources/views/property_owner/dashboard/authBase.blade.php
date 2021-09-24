<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v3.0.0-alpha.1
* @link https://coreui.io
* Copyright (c) 2019 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)asdsa
-->

<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Youliv">
    <meta name="author" content="Youliv">
    <meta name="keyword" content="Youliv">
    <title>Youliv</title>
    <link rel="apple-touch-icon" sizes="57x57" href="{{ url ($server_path.'app_asset/images/youliv_favicon2.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ url ($server_path.'app_asset/images/youliv_favicon2.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href=".{{ url ($server_path.'app_asset/images/youliv_favicon2.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url ($server_path.'app_asset/images/youliv_favicon2.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ url ($server_path.'app_asset/images/youliv_favicon2.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url ($server_path.'app_asset/images/youliv_favicon2.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ url ($server_path.'app_asset/images/youliv_favicon2.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url ($server_path.'app_asset/images/youliv_favicon2.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url ($server_path.'app_asset/images/youliv_favicon2.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ url ($server_path.'app_asset/images/youliv_favicon2.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url ($server_path.'app_asset/images/youliv_favicon2.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ url ($server_path.'app_asset/images/youliv_favicon2.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url ($server_path.'app_asset/images/youliv_favicon2.png') }}">
    <link rel="manifest" href="../admin/assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ url ($server_path.'app_asset/images/youliv_favicon2.png') }}">
    <meta name="theme-color" content="#ffffff">
    <!-- Icons-->
    <link href="{{ asset($server_path.'admin/css/free.min.css') }}" rel="stylesheet"> <!-- icons -->
    <link href="{{ asset($server_path.'admin/css/flag-icon.min.css') }}" rel="stylesheet"> <!-- icons -->
    <!-- Main styles for this application-->
    <link href="{{ asset($server_path.'admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset($server_path.'admin/css/pace.min.css') }}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script>

    <link href="{{ asset($server_path.'admin/css/coreui-chartjs.css') }}" rel="stylesheet">

  </head>
  <body class="c-app flex-row align-items-center">

    @yield('content')

    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset($server_path.'admin/js/pace.min.js') }}"></script>
    <script src="{{ asset($server_path.'admin/js/coreui.bundle.min.js') }}"></script>

    @yield('javascript')

  </body>
</html>
