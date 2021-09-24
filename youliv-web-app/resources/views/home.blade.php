@extends('layouts.app')


@section('content')
<!--        banner section starts-->
<section class="banner">
           <div class="banner-content">
            <h1>Young Living Spaces</h1>
            <h2>Coming Soon!</h2>
              <form class="banner-form">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Find your Co-living Spaces near your workplace / College">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-search"><img src="{{ url('public/app_asset/images/search.png') }}"></button>
                  &nbsp;&nbsp; <div class="form-group">
                  <button type="submit" class="btn btn-loc"><span><img src="{{ url('public/app_asset/images/location.png') }}"></span>Near Me</button>
                </div>
              </div>

              </form>
    </div>
</section>
<!--        banner section ends-->


<!--        welcome-sec starts-->
<section class="welcome-sec">
 <div class="container-fluid cstm-container">
    <div class="welcome-sec-outer">
     <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
         <div data-wow-delay="0.2s" class="wel-content wow fadeInLeft">
            <div class="sec-heading">
             <h2>Welcome to <span>YouLiv...</span></h2>
             </div>
             <p>Youliv Spaces is an initiative for the youth, aiming to simplify the process of finding accommodation and assisting youth in finding their perfect home away from home. We seek to deliver affordable, accessible, and youth-centric accommodation through a friendly and convenient platform. Youliv goes beyond simply helping you discover property and is a community of students and young working professionals that have got your back with whatever it is that you need!</p>
             <a href="javascript:void(0);"><span>Learn More About Us</span></a>
            </div>
         </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
         <div data-wow-delay="0.2s" class="welcome-list wow fadeInRight">
            <ul>
             <li>
                <figure>
                 <img src="{{ url('public/app_asset/images/welcome-img-1.png') }}" alt="">
                 </figure>
                 <figcaption>
                 <h4>Food Plan</h4>
                 </figcaption>
                </li>
                 <li>
                <figure>
                 <img src="{{ url('public/app_asset/images/welcome-img-2.png') }}" alt="">
                 </figure>
                 <figcaption>
                 <h4>Monthly Rental Plan </h4>
                 </figcaption>
                </li>
                 <li>
                <figure>
                 <img src="{{ url('public/app_asset/images/welcome-img-3.png') }}">
                 </figure>
                 <figcaption>
                 <h4>Occupancy</h4>
                 </figcaption>
                </li>
                 <li>
                <figure>
                 <img src="public/app_asset/images/welcome-img-4.png" alt="">
                 </figure>
                 <figcaption>
                 <h4>Safety and Security</h4>
                 </figcaption>
                </li>
             </ul>
            </div>
         </div>
        </div>
     </div>
    </div>
</section>
<!--        welcome-sec ends-->

<!--        co-liv-sec starts-->
<section class="co-liv-sec">
    <div class="container">
     <div class="sec-heading">
             <h2>Popular <span>Properties...</span></h2>
         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing  aliqua. </p>
             </div>
         </div>
        <div class="co-slider">
        <div class="coliv-slider owl-carousel owl-theme ">
            <div class="item">
			<div class="co-liv-content">
            <div class="sub-colive owl-demo2 owl-carousel owl-theme">
                <div class="item"> <img src="public/app_asset/images/co-slider-img1.png"></div>
                <div class="item"> <img src="public/app_asset/images/co-slider-img2.png"></div>
                <div class="item"> <img src="public/app_asset/images/co-slider-img3.png"></div>
            </div>
                  <div class="fm-occp men-room">
                  <h2><span class="icon-male"></span>Men</h2>
                  </div>
                  <div class="property-like">
                    <span class="icon-heart-1 white-heart"></span>
                    <span class="icon-heart-1"></span>
                    </div>
                  <figcaption>
                  <h2>Tokyo House</h2>
                    <h4>Sector 15, Chandigarh</h4>
                      <p>Starting Price <span>₹8,000 </span>bed / month</p>
                      <div class="co-slider-btn">
                      <a href="javascript:void(0);" class="visit-book">Book a Visit</a>
                      <a href="javascript:void(0);" class="now-book">Book Now</a>
                      </div>
                  </figcaption>
                </div>
        </div>
            <div class="item">
              <div class="co-liv-content red-like">
				  <div class="sub-colive owl-demo2 owl-carousel owl-theme">
					  <div class="item"> <img src="public/app_asset/images/co-slider-img2.png"></div>
					  <div class="item"> <img src="public/app_asset/images/co-slider-img3.png"></div>
				  </div>
                   <div class="fm-occp woman-room">
                  <h2><span class="icon-woman"></span>Women</h2>
                  </div>
                   <div class="property-like red-like">
                    <span class="icon-heart-1 white-heart"></span>
                    <span class="icon-heart-1"></span>
                    </div>
                  <figcaption>
                  <h2>Tokyo House</h2>
                    <h4>Sector 15, Chandigarh</h4>
                      <p>Starting Price <span>₹8,000 </span>bed / month</p>
                      <div class="co-slider-btn">
                      <a href="javascript:void(0);" class="visit-book">Book a Visit</a>
                      <a href="javascript:void(0);" class="now-book">Book Now</a>
                      </div>
                  </figcaption>
                </div>
            </div>
            <div class="item">
              <div class="co-liv-content">
				  <div class="sub-colive owl-demo2 owl-carousel owl-theme">
					  <div class="item"> <img src="public/app_asset/images/co-slider-img3.png"></div>
					  <div class="item"> <img src="public/app_asset/images/co-slider-img2.png"></div>
				  </div>

                   <div class="fm-occp woman-room">
                  <h2><span class="icon-woman"></span>Women</h2>
                  </div>
                    <div class="property-like">
                    <span class="icon-heart-1 white-heart"></span>
                    <span class="icon-heart-1"></span>
                    </div>
                  <figcaption>
                  <h2>Tokyo House</h2>
                    <h4>Sector 15, Chandigarh</h4>
                      <p>Starting Price <span>₹8,000 </span>bed / month</p>
                      <div class="co-slider-btn">
                      <a href="javascript:void(0);" class="visit-book">Book a Visit</a>
                      <a href="javascript:void(0);" class="now-book">Book Now</a>
                      </div>
                  </figcaption>
                </div>
            </div>
            <div class="item">
              <div class="co-liv-content">
				    <div class="sub-colive owl-demo2 owl-carousel owl-theme">
					  <div class="item"> <img src="public/app_asset/images/co-slider-img4.png"></div>
					  <div class="item"> <img src="public/app_asset/images/co-slider-img1.png"></div>
				  </div>
                  <div class="fm-occp men-room">
                  <h2><span class="icon-male"></span>Men</h2>
                  </div>
                    <div class="property-like">
                    <span class="icon-heart-1 white-heart"></span>
                    <span class="icon-heart-1"></span>
                    </div>
                  <figcaption>
                  <h2>Tokyo House</h2>
                    <h4>Sector 15, Chandigarh</h4>
                      <p>Starting Price <span>₹8,000 </span>bed / month</p>
                      <div class="co-slider-btn">
                      <a href="javascript:void(0);" class="visit-book">Book a Visit</a>
                      <a href="javascript:void(0);" class="now-book">Book Now</a>
                      </div>
                  </figcaption>
                </div>
            </div>
            <div class="item">
              <div class="co-liv-content red-like">
				      <div class="sub-colive owl-demo2 owl-carousel owl-theme">
					  <div class="item"> <img src="public/app_asset/images/co-slider-img3.png"></div>
					  <div class="item"> <img src="public/app_asset/images/co-slider-img1.png"></div>
				  </div>
                   <div class="fm-occp woman-room">
                  <h2><span class="icon-woman"></span>Women</h2>
                  </div>
                    <div class="property-like red-like">
                    <span class="icon-heart-1 white-heart"></span>
                    <span class="icon-heart-1"></span>
                    </div>
                  <figcaption>
                  <h2>Tokyo House</h2>
                    <h4>Sector 15, Chandigarh</h4>
                      <p>Starting Price <span>₹8,000 </span>bed / month</p>
                      <div class="co-slider-btn">
                      <a href="javascript:void(0);" class="visit-book">Book a Visit</a>
                      <a href="javascript:void(0);" class="now-book">Book Now</a>
                      </div>
                  </figcaption>
                </div>
            </div>
             <div class="item">
              <div class="co-liv-content">
				      <div class="sub-colive owl-demo2 owl-carousel owl-theme">
					  <div class="item"> <img src="public/app_asset/images/co-slider-img4.png"></div>
					  <div class="item"> <img src="public/app_asset/images/co-slider-img1.png"></div>
				  </div>
                  <div class="fm-occp men-room">
                  <h2><span class="icon-male"></span>Men</h2>
                  </div>
                    <div class="property-like">
                    <span class="icon-heart-1 white-heart"></span>
                    <span class="icon-heart-1"></span>
                    </div>
                  <figcaption>
                  <h2>Tokyo House</h2>
                    <h4>Sector 15, Chandigarh</h4>
                      <p>Starting Price <span>₹8,000 </span>bed / month</p>
                      <div class="co-slider-btn">
                      <a href="javascript:void(0);" class="visit-book">Book a Visit</a>
                      <a href="javascript:void(0);" class="now-book">Book Now</a>
                      </div>
                  </figcaption>
                </div>
            </div>
             <div class="item">
              <div class="co-liv-content">
				      <div class="sub-colive owl-demo2 owl-carousel owl-theme">
					  <div class="item"> <img src="public/app_asset/images/co-slider-img2.png"></div>
					  <div class="item"> <img src="public/app_asset/images/co-slider-img3.png"></div>
				  </div>
                   <div class="fm-occp woman-room">
                  <h2><span class="icon-woman"></span>Women</h2>
                  </div>
                    <div class="property-like red-like">
                    <span class="icon-heart-1 white-heart"></span>
                    <span class="icon-heart-1"></span>
                    </div>
                  <figcaption>
                  <h2>Tokyo House</h2>
                    <h4>Sector 15, Chandigarh</h4>
                      <p>Starting Price <span>₹8,000 </span>bed / month</p>
                      <div class="co-slider-btn">
                      <a href="javascript:void(0);" class="visit-book">Book a Visit</a>
                      <a href="javascript:void(0);" class="now-book">Book Now</a>
                      </div>
                  </figcaption>
                </div>
            </div>

				</div>
        </div>

</section>
<!--        co-liv-sec ends-->

<!--latest-love-sec stats-->
<section class="latest-love-sec wow zoomIn" data-wow-delay="0.5s">
   <div class="container-fluid cstm-container">
      <div class="sec-heading">
             <h2>The Latest  <span> Love... </span></h2>
             </div>
       <div class="latest-love-outer">
       <div class="owl-carousel owl-theme latest-loveslider">
					<div class="item">
					<div class="love-slid-content">

                            <p><i>“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. sed do eiusmod tempor incididunt ut labore et dolore”</i></p>
                        <figure>
                        <img src="public/app_asset/images/love-img-1.png" alt="love-img">
                        </figure>
                        <figcaption>
                        <h2>John Deo</h2>
                        </figcaption>
						</div>
					</div>
					<div class="item">
					<div class="love-slid-content">

                            <p><i>“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. sed do eiusmod tempor incididunt ut labore et dolore”</i></p>
                        <figure>
                        <img src="public/app_asset/images/love-img-1.png" alt="love-img">
                        </figure>
                        <figcaption>
                        <h2>John Deo</h2>
                        </figcaption>
						</div>
					</div>



				</div>
       </div>
    </div>
</section>
<!--latest-love-sec ends-->

<!--        promise-sec starts-->
<section class="promise-sec">
  <div class="container-fluid cstm-container">
      <div class="sec-heading wow fadeInDown" data-wow-delay="0.3s">
             <h2>TheYouLiv <span>Promise!</span></h2>
         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
             </div>
      <div class="promise-content wow fadeInRight" data-wow-delay="0.2s">
      <ul>
          <li>
          <figure>
              <img src="public/app_asset/images/promise-img1.png" alt="">
              </figure>
              <figcaption>
              <h2>Hassle-free Stay</h2>
              <p>Lorem ipsum dolor sit amet consectetur adipiscing.</p>
              </figcaption>
          </li>
           <li>
          <figure>
              <img src="public/app_asset/images/promise-img2.png" alt="">
              </figure>
              <figcaption>
              <h2>Housekeeping</h2>
              <p>Lorem ipsum dolor sit amet consectetur adipiscing.</p>
              </figcaption>
          </li>
           <li>
          <figure>
              <img src="public/app_asset/images/promise-img3.png" alt="">
              </figure>
              <figcaption>
              <h2>Caring Staff</h2>
              <p>Lorem ipsum dolor sit amet consectetur adipiscing.</p>
              </figcaption>
          </li>
           <li>
          <figure>
              <img src="public/app_asset/images/promise-img4.png" alt="">
              </figure>
              <figcaption>
              <h2>Free Maintenance</h2>
              <p>Lorem ipsum dolor sit amet consectetur adipiscing.</p>
              </figcaption>
          </li>
           <li>
          <figure>
              <img src="public/app_asset/images/promise-img5.png" alt="">
              </figure>
              <figcaption>
              <h2>Yummy Food</h2>
              <p>Lorem ipsum dolor sit amet consectetur adipiscing.</p>
              </figcaption>
          </li>
           <li>
          <figure>
              <img src="public/app_asset/images/promise-img6.png" alt="">
              </figure>
              <figcaption>
              <h2>Fully Furnished</h2>
              <p>Lorem ipsum dolor sit amet consectetur adipiscing.</p>
              </figcaption>
          </li>
          </ul>
      </div>
    </div>
</section>
<!--        promise-sec ends-->

<!--        get-yoliv section starts-->
<section class="get-youliv">
<div class="container-fluid cstm-container">
    <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="get-live-img wow fadeInLeft" data-wow-delay="0.3s">
        <fiigure>
            <img src="public/app_asset/images/get-liv-img1.png" alt="">
            </fiigure>
        </div>
        </div>
         <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="get-liv-content wow fadeInRight" data-wow-delay="0.3s">
             <div class="sec-heading">
             <h2>Get The <span>YouLiv...</span></h2>
         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  </p>
             </div>
            <div class="empty"></div>
            <div class="play-btn">
            <a href="javascript:void(0);" class="app-store"><img src="public/app_asset/images/app-store.png"></a>
            <a href="javascript:void(0);" class="play-store"><img src="public/app_asset/images/google-play.png"></a>
            </div>
             </div>
        </div>
    </div>
    </div>
</section>
<!--        get-yoliv section ends-->

<!--        footer starts-->
@include('footer')
<!--        footer ends-->

  <!-- Modal -->
  <div class="modal fade" id="req-call-modal" role="dialog">
    <div class="modal-dialog pd-modal">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="visit-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
          <h2>Request for a call</h2>
        </div>
        <div class="visit-body">
        <h3>Our promise We will get back to you within 24-48 hrs. Don't worry we will never spam you</h3>
            <form>
            <div class="form-group">
                <input type="text" placeholder="Name" class="form-control">
              </div>
                 <div class="form-group">
                <input type="text" placeholder="Phone Number" class="form-control">
              </div>
            </form>
            <button type="submit" class="btn logform-btn"><span>submit</span></button>
        </div>
      </div>

    </div>
  </div>
<!--        visit-modal ends-->


      	<!--        script-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		 <script src="public/app_asset/js/jquery-1.9.1.min.js"></script>
    <script src="public/app_asset/js/owl.carousel.js"></script>
	<script src="public/app_asset/js/owl.carousel.js"></script>
        <script src="public/app_asset/js/wow.min.js"></script>
      <script>
      new WOW().init();
      </script>
        	<script>
		$('.latest-loveslider').owlCarousel({
			loop: true,
			autoplay:false,
			margin: 10,
			nav: false,
			dotsData:false,
			center:false,

			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 1
				},
				1000: {
					items: 1
				}
			}
		});
	</script>
<script>


    $(document).ready(function() {

     $(".coliv-slider").owlCarousel({
         autoPlay:true,
		 loop:true,//Set AutoPlay to 3 seconds
         itemsDesktop : [1199,3],
         itemsDesktopSmall : [979,3],
		 responsive: {
				0: {
					items: 1
				},
				600: {
					items: 3
				},
				1000: {
					items: 5
				}
			}
     });

     $(".owl-demo2").owlCarousel({
         autoPlay: false, //Set AutoPlay to 3 seconds
         items : 1,
         itemsDesktop : [1199,3],
         itemsDesktopSmall : [979,3]
     });

   });


</script>
        <script>

$(window).scroll(function() {
    var scroll = $(window).scrollTop();
     //console.log(scroll);
    if (scroll >= 80) {
        //console.log('a');
        $(".head").addClass("change");
    } else {
        //console.log('a');
        $(".head").removeClass("change");
    }
});

        </script>

