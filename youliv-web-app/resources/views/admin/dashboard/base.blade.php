<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v3.0.0-alpha.1
* @link https://coreui.io
* Copyright (c) 2019 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>Youliv</title>
    <link rel="apple-touch-icon" sizes="57x57" href="{{ url ('public/app_asset/images/youliv_favicon2.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ url ('public/app_asset/images/youliv_favicon2.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href=".{{ url ('public/app_asset/images/youliv_favicon2.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url ('public/app_asset/images/youliv_favicon2.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ url ('public/app_asset/images/youliv_favicon2.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url ('public/app_asset/images/youliv_favicon2.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ url ('public/app_asset/images/youliv_favicon2.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url ('public/app_asset/images/youliv_favicon2.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url ('public/app_asset/images/youliv_favicon2.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ url ('public/app_asset/images/youliv_favicon2.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url ('public/app_asset/images/youliv_favicon2.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ url ('public/app_asset/images/youliv_favicon2.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url ('public/app_asset/images/youliv_favicon2.png') }}">
    <link rel="manifest" href="public/admin/assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">

    <meta name="theme-color" content="#ffffff">
    <!-- Icons-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"> 
    <link href="{{ asset('public/admin/css/free.min.css') }}" rel="stylesheet"> <!-- icons -->
    <link href="{{ asset('public/admin/css/flag-icon.min.css') }}" rel="stylesheet"> <!-- icons -->
    <!-- Main styles for this application-->
    <link href="{{ asset('public/admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/css/pace.min.css') }}" rel="stylesheet">
	<script src="{{ asset('public/admin/assets/js/jquery.min.js')}}"></script>
	<script src="{{ asset('public/js/jquery.validate.min.js')}}"></script>
	<link href="{{ asset('public/admin/css/admin.css') }}" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<script src="{{ asset('public/app_asset/js/bootstrap-datepicker.js')}}"></script>
	<link href="{{ asset('public/app_asset/css/bootstrap-datepicker.css') }}" rel="stylesheet">
    @yield('css')

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

    <link href="{{ asset('public/css/coreui-chartjs.css') }}" rel="stylesheet">
  </head>



  <body class="c-app">
   <div class="wrapper">
        <!-- Sidebar  -->
        
      @include('admin.include.nav-builder')


  <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
					
                    
				<button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#navbarSupportedContent" data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon" style="padding:17px;"></span>
				</button>
				<div>
                     <?php
							use App\MenuBuilder\FreelyPositionedMenus;
							if(isset($appMenus['top menu'])){
								FreelyPositionedMenus::render( $appMenus['top menu'] , 'c-header-', 'd-md-down-none');
							}
						?>
						
						<div class="c-subheader px-3">
						  <ol class="breadcrumb border-0 m-0">
							<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
							<?php $segments = ''; ?>
							@for($i = 1; $i <= count(Request::segments()); $i++)
								<?php $segments .= '/'. Request::segment($i); ?>

								@if($i < count(Request::segments()))
									<li class="breadcrumb-item">{{ Request::segment($i) }}</li>
								@else
									<li class="breadcrumb-item active">{{ Request::segment($i) }}</li>
								@endif
							@endfor
						  </ol>
						</div>
                </div>
				 </div>
            </nav>


          @yield('content')

        </div>
    </div>



	  
      @include('admin.include.footer')
    </div>

    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('public/admin/js/pace.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/coreui.bundle.min.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('public/admin/assets/css/bootstrap.min.css') }}" />
    <link href="{{ asset('public/admin/assets/css/jquery.dataTables.min.css') }}" rel="stylesheet">
  
    <script src="{{ asset('public/admin/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/dataTables.bootstrap4.min.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('public/admin/assets/css/sweetalert2.min.css') }}">
	<script src="{{ asset('public/admin/assets/js/sweetalert2.min.js') }}"></script>
	<script src="{{ asset('public/admin/assets/js/sweetalert.min.js') }}"></script>
    @yield('javascript')
  </body>
</html>
