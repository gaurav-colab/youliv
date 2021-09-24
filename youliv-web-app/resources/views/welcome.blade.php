@extends('layouts.app')

@section('content')

<!--        banner section starts-->
<section class="banner">
  <div class="banner-content">
    <h1>Young Living SPACES</h1>
    <h2>An Experience for Everyone!</h2>
    <form class="banner-form main-b-form" method="post" action="propertylist" id="search-form">
	@csrf

      <div class="form-group">
        <input type="text" name="autocomplete" id="autocomplete" class="form-control hidden-md hidden-sm hidden-xs" placeholder="Find your second home near your workplace / College">
        <input type="text" class="form-control visible-md visible-sm visible-xs" placeholder="Search..">

        <div  id="lat_area">
          <input type="hidden" name="latitude" id="latitude" class="form-control">
        </div>

        <div  id="long_area">
          <input type="hidden" name="longitude" id="longitude" class="form-control">
        </div>
        <button type="submit" class="btn btn-search"><img src="{{ url($server_path.'app_asset/images/search.png') }}"></button>

        <button type="submit" class="btn btn-loc getLocation" ><span><img src="{{ url($server_path.'app_asset/images/location.png') }}"></span>Near Me</button>
      </div>
    </form>
  </div>
  <div class="form-group explore-form">
	  <a href="{{url('/')}}/propertylist" ><button type="button" class="btn btn-loc"><span></span>Explore Properties</button></a>
		
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
              <h2>Welcome to <span>YouLiv..</span></h2>
            </div>
            <p>The YouLiv Team is committed to creating experiences and turning them into a story reel. A delightful experience of finding your new home away from home online without hunting manually, an affordable experience of imaging your new home with our professional on-site clicked photographs to maintain the uttermost transparency in our offering and recommendations, and most important- an experience of professionally managed free site visits to figure out every minute details of day-to-day living to match your personal preferences.
</p><p>Create your college story reel, or story reel of your very first job while we design your hassle free comfort living at verified properties with various online payment options.
</p>
            <a href="{{url('about')}}"><span>Learn More About Us</span></a>
          </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
          <div data-wow-delay="0.2s" class="welcome-list wow fadeInRight">
            <ul>
              <li>
                <figure>
                  <img src="{{ url($server_path.'app_asset/images/welcome-img-1.png')}}" alt="">
                </figure>
                <figcaption>
                  <h4>Free Guided Visits</h4>
                </figcaption>
              </li>
              <li>
                <figure>
                  <img src="{{ url($server_path.'app_asset/images/welcome-img-2.png')}}" alt="">
                </figure>
                <figcaption>
                  <h4>Verified Properties </h4>
                </figcaption>
              </li>
              <li>
                <figure>
                  <img src="{{ url($server_path.'app_asset/images/welcome-img-3.png')}}">
                </figure>
                <figcaption>
                  <h4>Filtered Search</h4>
                </figcaption>
              </li>
              <li>
                <figure>
                  <img src="{{ url($server_path.'app_asset/images/welcome-img-4.png')}}" alt="">
                </figure>
                <figcaption>
                  <h4>Book Online</h4>
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
      <h2>Recommended <span>Properties</span></h2>
      <p>We use human intelligence rather than artificial intelligence along with feedback to recommend you the best new home- home away from home. YouLiv assists you find and rent verified, rooms, flats, PG, houses, apartments, and private hostels for working professionals, students in Chandigarh, Panchkula, Mohali. Book now! </p>
    </div>
  </div>
  <div class="co-slider">
    <div class="coliv-slider owl-carousel owl-theme ">
      <!--property listing-->
      @if(!empty(count($propertyListing)))
	 
      @foreach($propertyListing as $listings)
	 
      @php
      $propertyType = ($listings->property_details->property_type == 1) ? 'Flat' : ($listings->property_details->property_type == 2 ? 'PG' : 'Flat/PG');
      @endphp

      <div class="item">
			<div class="co-liv-content co-liv-content-front">
			<a href="{{url('/')}}/propertylist_detail/{{$listings->property_code}}">

          <div class="sub-colive owl-demo2 owl-carousel owl-theme">
           
			 @if(!empty(count($listings->property_images)))	
				@foreach($listings->property_images as $key=>$value)
				<div class="item">										
					<img src="{{ url('/') }}/{{$value->image}}" alt="">
				</div>
				@endforeach
			@else
				<img src="{{ url($server_path.'app_asset/images/co-slider-img3.png') }}" alt="">
			@endif  
          
          </div>
		  <div class="fm-occp men-room">
            <h2>{{ $propertyType }} </h2>
          </div>
         </a>
		 <?php 
				if(isset($fav_array) && count($fav_array)>0)
				{
					if(in_array($listings->id,$fav_array ))
					{
						$class="red-like";
					}
					else
					{
						$class="favorite";
					}
				}
				else
				{
					$class="favorite";
				}
				
			
			?>
          <div class="property-like {{$class}}" id="pro_{{$listings->id}}" data-value="{{$listings->id}}">
            <span class="icon-heart-1 white-heart"></span>
			
            <span class="icon-heart-1 "></span> 
          </div>
		  <?php
			if(isset($listings->property_addresses->address_city))		
			{
				$city=App\City::where('id',$listings->property_addresses->address_city)->first();				
				$address_city=$city->name;
			}
			if(isset($listings->property_addresses->address_sector))
			{
				$address_sector=App\Sector::where('id',$listings->property_addresses->address_sector)->first();
				$address_sector=$address_sector->name;
			}
			
			if(isset($listings->property_addresses->address_city))	
					{
						$address=$address_city.", ".$address_sector;
					}
					else
					{
						$address="No Information Available";
					}
					?>
          <figcaption>
		  @if(isset($listings->property_details))	
									<?php 	
									$gender="";								
									if($listings->property_details->property_available_women==1)
										{
											if($gender!="")
											{
												$gender.=", Women";
											}
											else{
												$gender.="Women";
											}
										}
										if($listings->property_details->property_available_men==1)
										{
											if($gender!="")
											{
												$gender.=", Men";
											}
											else{
												$gender.="Men";
											}
										}
										if($listings->property_details->property_available_unisex==1)
										{
											if($gender!="")
											{
												$gender.=", Unisex";
											}
											else{
												$gender.="Unisex";
											}
										}
										if($listings->property_details->property_available_family==1)
										{					
											
											if($gender!="")
											{
												$gender.=", Family";
											}
											else{
												$gender.="Family";
											}												
										}
																			
									?>@endif
            <p><span class="available"> <?php echo $gender;?></span>	</p>
            <h4><p>{{ $address}}</p></h4>

            <p>Starting Price <span>@if(isset($listings->property_descriptions))
									<?php $rent=array();?>
									@foreach($listings->property_descriptions as $key=>$value)
									<?php
										$rent[]=$value->rent;
									?>
									@endforeach
									<?php if(count($rent)>0) $rent =min($rent); else $rent="0"; ?>
								@endif
								₹{{$rent}} </span>@if(isset($listings->property_details->property_type))								
									@if($listings->property_details->property_type==1)
										Per					
									@else
										Room Per									
									@endif
								@else
									Flat/PG 
								@endif  month </p>
            <div class="co-slider-btn postion_silder">
              <a data-toggle="modal" data-target="#visit-modal" data-id="{{$listings->id}}" data-url="{{$listings->property_details->property_title}}" data-value="{{$address}}" class="visit-book" >Book a Visit</a>
              <a href="{{url('/contact')}}/{{$listings->property_code}}" class="now-book">Book Now</a>
            </div>
          </figcaption>
        </div>
      </div>

      @endforeach
      @endif

	

    </div>
  </div>
  <div class="form-group explore-form1 property-sec">
	  <a href="{{url('propertylist')}}"> <span></span>Explore Properties </a>
		
	  </div>
</section>
<!--        co-liv-sec ends-->

<!--latest-love-sec stats-->
<section class="latest-love-sec wow zoomIn" data-wow-delay="0.5s">
  <div class="container-fluid cstm-container">
    <div class="sec-heading">
      <h2>The Latest <span> Love... </span></h2>
    </div>
    <div class="latest-love-outer">
      <div class="owl-carousel owl-theme latest-loveslider" style="margin-top:-50px">
        <div class="item">
          <div class="love-slid-content">

            <p><i>It was a delightful experience to be able to reach the YouLiv website suggested to me by my friend. The home showed to us was like we wanted. It looked just the same as shown in the photos to us. No leakage, good hygienic conditions and much more at affordable prices. A word of thanks to YouLiv and their team for providing me with my dream house.
</i></p>
            <div class="lat-lov-fig">
              <figure>
                <img src="{{ url($server_path.'app_asset/images/review1.jpg') }}">
              </figure>
              <figcaption>
                <h2>Rajesh Gupta</h2>
              
              </figcaption>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="love-slid-content">

            <p><i>Having grown up in a small town, I had always wished to have a beautiful, colossal home of my own and the dream was supported by YouLiv and their team. The house at first sight looked exquisite! I have been living here for 2 weeks now and so far my experience has been a 10/10. Definitely would recommend this site for a hassle free and pocket friendly experience.</i></p>
            <div class="lat-lov-fig">
              <figure>
                <img src="{{ url($server_path.'app_asset/images/review3.jpg') }}">
              </figure>
              <figcaption>
                <h2>Meena Kumari</h2>
               
              </figcaption>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="love-slid-content">

            <p><i> I travelled to my hometown after 3 years of living abroad and my goal was to live in a separate house from my family so I don't lose my habit of working myself. I looked up to some websites and came across YouLiv. The homes looked very appealing and everything was very pocket friendly. The houses were even more attractive when looked at by sight. I lived there for about a month and I really appreciate YouLiv's service for providing me with such a great experience.</i></p>
            <div class="lat-lov-fig">
              <figure>
                <img src="{{ url($server_path.'app_asset/images/review4.jpg') }}">
              </figure>
              <figcaption>
                <h2>Monika Sharma</h2>
                
              </figcaption>
            </div>
          </div>
        </div>
		  <div class="item">
          <div class="love-slid-content">

            <p><i>A word of thanks to YouLiv and their team for providing me with the golden opportunity of giving me such blissful memories with my family. After the birth of my daughter, me and my wife started looking for a home that was not only affordable but had a prime location as well. YouLiv helped us in finding our dream house and it was an experience worth remembering. The houses are very well maintained and updated beautifully.</i></p>
            <div class="lat-lov-fig">
              <figure>
                <img src="{{ url($server_path.'app_asset/images/review2.jpg') }}">
              </figure>
              <figcaption>
                <h2>Aayush</h2>
               
              </figcaption>
            </div>
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
      <p>We make promises to keep! Our promises are our startup mission and pledge. Our promises are the base of our vision, vision to automate the home hunting process, neutralise the brokerage system, virtual property tours with 'shot at location' snaps, and 100% transparency in the renting process of rooms, flats, PG, houses, apartments, and private hostels. </p>
    </div>
    <div class="promise-content wow fadeInRight" data-wow-delay="0.2s">
      <ul>
        <li>
          <figure>
		   <img src="{{ url($server_path.'app_asset/images/promise-img4.png')}}" alt="">
           
          </figure>
          <figcaption>
            <h2>Automated Professional Engagement</h2>
            <p>Ready leaving properties, before you step in</p>
          </figcaption>
        </li>
        <li>
          <figure>
		  <img src="{{ url($server_path.'app_asset/images/promise-img3.png')}}" alt="">
         
          <figcaption>
            <h2>Physically Verified Properties</h2>
            <p>Manually verified properties by our professionals</p>
          </figcaption>
        </li>
        <li>
          <figure>
               <img src="{{ url($server_path.'app_asset/images/promise-img2.png')}}" alt="">
          </figure>
          </figure>
          <figcaption>
            <h2>Virtual Tour- Get What You See</h2>
            <p> We capture snaps from all possible angles</p>
          </figcaption>
        </li>
        <li>
          <figure>
            <img src="{{ url($server_path.'app_asset/images/promise-img1.png')}}" alt="">
          </figure>
          <figcaption>
            <h2>Dedicated Area Manager</h2>
            <p>Assistance for the property and more…</p>
          </figcaption>
        </li>
      </ul>
    </div>
  </div>
</section>
<!--        promise-sec ends-->

<!--city-slider-outer section starts-->
<div class="city-slider-outer">
  <div class="container-fluid cstm-container">
    <ul>
      <li>
        <div class=" yellow-num">         
          <div class="happy-customer-num">
            <h2>250+</h2>
            <p>Living Spaces</p>
          </div>
        </div>
      </li>
      <li>
        <div class="ciity-blocks">
          <a href="{{url('/propertylist')}}/chandigarh">
            <figure>
              <img src="{{ url($server_path.'app_asset/images/city1.png')}}">
            </figure>
            <figcaption>
              <h2>Chandigarh</h2>
            </figcaption>
          </a>
        </div>
      </li>
      <li>
        <div class="ciity-blocks">
          <a href="{{url('/propertylist')}}/panchkula">
            <figure>
              <img src="{{ url($server_path.'app_asset/images/city2.png')}}">
            </figure>
            <figcaption>
              <h2>Panchkula</h2>
            </figcaption>
          </a>
        </div>
      </li>
      <li>
        <div class="ciity-blocks">
          <a href="{{url('/propertylist')}}/mohali">
            <figure>
              <img src="{{ url($server_path.'app_asset/images/city3.png')}}">
            </figure>
            <h2>Mohali</h2>
            </figcaption>
          </a>
        </div>
      </li>
    </ul>
  </div>
</div>
<!--city-slider-outer section ends-->

<!--        get-yoliv section starts-->
<section class="get-youliv">
  <div class="container-fluid cstm-container">
    <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="get-live-img wow fadeInLeft" data-wow-delay="0.3s">
          <fiigure>
            <img src="{{ url($server_path.'app_asset/images/get-liv-img1.png')}}" alt="">
          </fiigure>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="get-liv-content wow fadeInRight" data-wow-delay="0.3s">
          <div class="sec-heading">
            <h2>Youliv App<span> Coming Soon...</span></h2>
            <p>Stepping forward, we are launching our mobile application soon to offer you the best deals possible in your preferred location, and creating a youth centric community to explore, communicate and share the best in town engagement in the hyperlocal environment.</p>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
<!--        get-yoliv section ends-->


<!-- city tab starts -->
<!-- 
<section class="city-name">
  <div class="tab-head">
    <button class="tablink" onclick="openPage('Panchkula', this,)" id="defaultOpen">Panchkula</button>
    <button class="tablink" onclick="openPage('Chandigarh', this,)">Chandigarh</button>
    <button class="tablink" onclick="openPage('Mohali', this,)">Mohali</button>
  </div>
  <div id="Panchkula" class="tabcontent">
    <div class="row">
      <div class="col-md-3">
        <p>Flats for Women in Panchkula</p>
        <ul>
          <li>Flats for rent in Sector 4</li>
          <li>Flats for rent in Sector 5</li>
          <li>Flats for rent in Sector 6</li>
		  <li>Flats for rent in Sector 7</li>
          <li>Flats for rent in Sector 8</li>
          <li>Flats for rent in Sector 9</li>
        </ul>
      </div>
      <div class="col-md-3">
        <p>Flats for Men in Panchkula</p>
        <ul>
          <li>Flats for rent in Sector 7</li>
          <li>Flats for rent in Sector 8</li>
          <li>Flats for rent in Sector 9</li>
        </ul>
      </div>
      <div class="col-md-3">
        <p>PG for Women in Panchkula</p>
        <ul>
          <li>PG in Sector 10</li>
          <li>PG in Sector 11</li>
          <li>PG in Sector 12</li>
        </ul>
      </div>
      <div class="col-md-3">
        <p>PG for Men in Panchkula</p>
        <ul>
          <li>PG in Sector 15</li>
          <li>PG in Sector 17</li>
          <li>PG in Sector 21</li>
        </ul>
      </div>
    </div>
  </div>

  <div id="Chandigarh" class="tabcontent">
    <div class="row">
      <div class="col-md-3">
        <p>Flats for Women in Chandigarh</p>
        <ul>
          <li>Flats for rent in Sector 5</li>
          <li>Flats for rent in Sector 8</li>
          <li>Flats for rent in Sector 12</li>
        </ul>
      </div>
      <div class="col-md-3">
        <p>Flats for Men in Chandigarh</p>
        <ul>
          <li>Flats for rent in Sector 4</li>
          <li>Flats for rent in Sector 7</li>
          <li>Flats for rent in Sector 6</li>
        </ul>
      </div>
      <div class="col-md-3">
        <p>PG for Women in Chandigarh</p>
        <ul>
          <li>PG in Sector 11</li>
          <li>PG in Sector 9</li>
          <li>PG in Sector 10</li>
        </ul>
      </div>
      <div class="col-md-3">
        <p>PG for Men in Chandigarh</p>
        <ul>
          <li>PG in Sector 15</li>
          <li>PG in Sector 17</li>
          <li>PG in Sector 21</li>
        </ul>
      </div>
    </div>

  </div>

  <div id="Mohali" class="tabcontent">
    <div class="row">
      <div class="col-md-3">
        <p>Flats for Women in Mohali</p>
        <ul>
          <li>Flats for rent in Sector 62</li>
          <li>Flats for rent in Sector 70</li>
          <li>Flats for rent in Sector 71</li>
        </ul>
      </div>
      <div class="col-md-3">
        <p>Flats for Men in Mohali</p>
        <ul>
          <li>Flats for rent in Sector 61</li>
          <li>Flats for rent in Sector 60</li>
          <li>Flats for rent in Sector 64</li>
        </ul>
      </div>
      <div class="col-md-3">
        <p>PG for Women in Mohali</p>
        <ul>
          <li>PG in Sector 70</li>
          <li>PG in Sector 77</li>
          <li>PG in Sector 80</li>
        </ul>
      </div>
      <div class="col-md-3">
        <p>PG for Men in Mohali</p>
        <ul>
          <li>PG in Sector 70</li>
          <li>PG in Sector 67</li>
          <li>PG in Sector 69</li>
        </ul>
      </div>
    </div>

  </div>



</section>-->
<!-- city tab end -->


@include('footer')


<script>
 $(document).on('click', '.getLocation', function() {
$.getJSON('https://geoip-db.com/json/geoip.php?jsonp=?')  
.done (function(location)
{
$('#latitude').val(location.latitude);
$('#longitude').val(location.longitude);
});
});
</script>




@endsection
