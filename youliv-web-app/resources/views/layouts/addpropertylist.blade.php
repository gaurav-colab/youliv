<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{ url ($server_path.'app_asset/images/youliv_favicon2.png') }}" type="image/x-icon">
    <title>{{$site_title}}</title>
	<meta name='description' content='{{$meta_description}}'>
    <meta name="viewport" content="width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link href="{{ url($server_path.'app_asset/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url($server_path.'app_asset/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url($server_path.'app_asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ url($server_path.'app_asset/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ url($server_path.'app_asset/css/animate.css') }}">
	
	<script src="{{ url($server_path.'app_asset/js/jquery.min.js') }}"></script>
	<script src="{{ url($server_path.'app_asset/js/bootstrap.min.js') }}"></script>
   <script src="{{ asset($server_path.'js/jquery.validate.min.js')}}"></script>
    <!-- Bootstrap -->
    <!-- Bootstrap DatePicker -->
    <link rel="stylesheet" href="{{ url($server_path.'app_asset/css/bootstrap-datepicker.css') }}" type="text/css" />
    <script src="{{ url($server_path.'app_asset/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
	
@include('layouts.popup')
</head>

<body>
    <!--        header starts-->
	
    <header class="login-header outer-header">
        <div class="head">
            <div class="container-fluid cstm-container">
                <div class="logo-div">
                <a href="{{url('/')}}"><img src="{{ url($server_path.'app_asset/images/logo.png') }}" alt="youlive"></a>
                </div>
                <ul class="nav navbar-nav sign-btn si-sticky">
                    <li class="search-form-list">
                        <div class="search-form">
                            <form class="banner-form main-b-form">
                                <div class="form-group">
                                    <input type="text" class="form-control hidden-md hidden-sm hidden-xs" placeholder="Find your second home near your workplace / College">
                                    <input type="text" class="form-control visible-md visible-sm visible-xs" id="autocomplete" name="autocomplete" placeholder="Search..">
                                    <button type="submit" class="btn btn-search"><img src="{{ url($server_path.'app_asset/images/search.png') }}"></button>
                                    <a href="{{url('propertylist')}}"> <button type="button" class="btn btn-loc near_me" ><span><img src="{{ url($server_path.'app_asset/images/location.png') }}"></span>Near Me</button></a>
									<input type="hidden" name="latitude" id="latitude" class="form-control" value="">
									<input type="hidden" name="longitude" id="longitude" class="form-control" value="">
							  </div>
                            </form>
                        </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav sign-btn">
				<li class="filter-icon-mobile">
				<a href="javascript:void(0);" id="show_filter" name="show_filter" value="show_filter" data-toggle="modal" data-target="#apply_filter-modal">
				<i class="fa fa-filter filter-icon" aria-hidden="true"></i></a></li>
                    <li class="dropdown no-notification">
                        <a href="#" class="dropdown-toggle noti-bell" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="icon-notification"></span></a>
                        <ul class="dropdown-menu">
                            <h2>Your Notifications</h2>
                            <li>
                                <div class="noti-text unread-text">
                                    <a href="javascript:void(0);">
                                        <h2>Payment Cycle<span><i>29 Feb 2020</i></span></h2>
                                        <p>Your Next Month Payment Deo Amount...</p>
                                    </a>
                                </div>
                            </li>

                            <li>
                                <div class="noti-text unread-text">
                                    <a href="javascript:void(0);">
                                        <h2>Payment Cycle<span><i>29 Feb 2020</i></span></h2>
                                        <p>Your Next Month Payment Deo Amount...</p>
                                    </a>
                                </div>
                            </li>

                            <li>
                                <div class="noti-text">
                                    <a href="javascript:void(0);">
                                        <h2>Payment Cycle<span><i>29 Feb 2020</i></span></h2>
                                        <p>Your Next Month Payment Deo Amount...</p>
                                    </a>
                                </div>
                            </li>

                            <h2>See all Notification</h2>
                        </ul>
                    </li>

                    <li class="p-kist-btn"><a href="{{url('contact')}}" class="partner-btn">List your Property</a></li>


                    @if((!isset(Auth::user()->id)) && (!isset(Auth::guard('property_owner')->user()->id)))

                    @if (Route::has('login'))

                    <li class="sign-logg">
                        <a href="{{ route('login') }}" class="log-sign">Sign Up / Login</a>
                    </li>
                    @endif
                    @else
                    <li class="sign-logg">
                        <a class="dropdown-item log-sign" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>

                    @endguest

                    <li class="side-curtain"><span style="font-size:30px;cursor:pointer" onclick="openNav()"><img src="{{ url($server_path.'app_asset/images/bars.png')}}" alt=""><img src="{{ url($server_path.'app_asset/images/bars-white.png')}}" class="whit-bar"> </span></li>

                    <div id="myNav" class="overlay">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <div class="overlay-content">
                            <div class="explor-housee">
                                <ul>
                                    <li><a href="{{ url('propertylist') }}">Explore YouLiv<span class="icon-gps"></span></a></li>
                                </ul>
                            </div>
                            <div class="explor-housee">
                                <ul>
                                     @if((!isset(Auth::user()->id)) && (!isset(Auth::guard('property_owner')->user()->id)))
                                    @if (Route::has('register'))
                                    <li><a href="{{ route('property_owner.login') }}">Login as owner</a></li>
                                    <li><a href="{{ route('register') }}">Login / Sign Up</a></li>
                                    @endif
                                    @else
										<li><a href="{{ url('my_account') }}">My Account</a></li>
										<li><a href="{{ url('my_account') }}/favourite_properties">My Favourites</a></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </li>
                                    @endguest
                                    <li><a href="{{url('propertylist')}}">List your property</a></li>
                                  
                                </ul>
                            </div>
                            <div class="explor-housee">
                                <ul>
                                    <li><a href="{{url('about')}}">About Us</a></li>             <!-- {{url('about')}} -->
                                    <li><a href="{{url('contact')}}">Contact Us</a></li>             <!-- {{url('contact')}} -->
                                    <li><a href="{{url('about')}}">FAQ</a></li>
                                </ul>
                            </div>


                            <div class="explor-housee">
                                <ul>
                                    <li><a href="{{url('privacy-policy')}}">Privacy Policy</a></li>
                                    <li><a href="{{url('terms-conditions')}}">Terms & Conditions</a></li>                                   

                                </ul>
                            </div>
                            <div class="explor-icos">
                                <ul>
                                    <li><a href="https://m.facebook.com/youlivspaces/" target="_blank" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="https://instagram.com/youlivspaces" target="_blank" class="linkdin"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    <li><a href="https://www.linkedin.com/company/youliv" target="_blank" class="insta"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </ul>
                <!--			mobile-search-bar-->
                <ul class="nav navbar-nav sign-btn sign-btn-mobile">
                    <li class="search-form-list">
                        <div class="search-form">
                            <form class="banner-form main-b-form">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Search..">
                                    <button type="submit" class="btn btn-search"><img src="{{ url($server_path.'app_asset/images/search.png')}}"></button>
                                    <button type="submit" class="btn btn-loc"><span><img src="{{ url($server_path.'app_asset/images/location.png')}}"></span>Near Me</button>
                                </div>
                            </form>
                        </div>
                    </li>
                </ul>
                <!--mobile-search-bar ends-->
                <div class="req-btn">
                    <a href="javascript:void(0);" class="req-quote" data-toggle="modal" data-target="#req-call-modal">Request for Call</a>
                </div>
            </div>
        </div>




    </header>
    <!--        modal ends-->

    <main class="py-4">
        @yield('content')
    </main>



    <!--        script-->

    

    <script src="{{ url($server_path.'app_asset/js/owl.carousel.js') }}"></script>
    <script src="{{ url($server_path.'app_asset/js/wow.min.js') }}"></script>

    <script>
        new WOW().init();
    </script>

    <script>
        $(document).mouseup(function(e) {
            if ($(e.target).closest("#myNav").length === 0) {
                document.getElementById("myNav").style.width = "0%";
            }
        });

        function openNav() {
            document.getElementById("myNav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("myNav").style.width = "0%";
        }
    </script>


    <script>
        $('.loc-pro-slider').owlCarousel({
            loop: true,
            center: false,
            autoplay: false,
            margin: 0,
            nav: false,
            dots: true,
            dotsData: false,

            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1920: {
                    items: 1
                }
            }
        });
    </script>
    <script>
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            //console.log(scroll);
            if (scroll >= 300) {
                //console.log('a');
                $(".head").addClass("change");
            } else {
                //console.log('a');
                $(".head").removeClass("change");
            }
        });
		
		
		 $(function () {
            $('#sh_date').datepicker({
                format: "dd-mm-yyyy"
            });
        });
		
		
		
    </script>


</body>

</html>
