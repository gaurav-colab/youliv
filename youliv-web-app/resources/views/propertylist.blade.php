@extends('layouts.addpropertylist')

@section('content')
<link rel="stylesheet" href="{{ url($server_path.'app_asset/css/jquery-ui.css')}}">
<script src="{{ url($server_path.'app_asset/js/jquery-1.12.4.js')}}"></script>
<script src="{{ url($server_path.'app_asset/js/jquery-ui.js')}}"></script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<!--
<script src="{{ url($server_path.'app_asset/js/jscroll.js')}}"></script>

-->
<style>

.form-price-range-filter {
	display: flex;
	width: 100%;
	flex-direction: row;
	justify-content: center;
	margin-top: 30px;
	padding-bottom: 40px;
}
#min {
    width: 78px;
    padding: 5px 10px;
    text-align:center;
	border:none;
}
#max {
    width: 72px;
    padding: 5px 10px;
  
	border:none;
}
#slider-range {
    width: 50%;
    margin: 11px 0px 5px 0px;
}
.label_price {
	padding: 5px 11px 0px 31px;
	font-weight: bold;
}


</style>
<!--    loc-sec starts-->
<section class="location-sec wow fadeInRight" data-wow-delay="0.2s">
<form class="banner-form loc-form" method="post" action="propertylist" id="search-form">
@csrf
    <div class="container-fluid inner-container">
        
            <div class="form-group select-group">
                <select class="form-control" id="city" name="city">
                    <option value="chandigarh" @if($select_city=="chandigarh") selected=selected @endif>Chandigarh</option>
                    <option value="mohali" @if($select_city=="mohali") selected=selected @endif>Mohali</option>
					<option value="panchkula" @if($select_city=="panchkula") selected=selected @endif>Panchkula</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="autocomplete" name="autocomplete" placeholder="search location" value="{{old('autocomplete',$searchTerm ?? '')}}">
                <button type="submit" class="btn btn-search visible-xs"><img src="{{ url($server_path.'app_asset/images/search.png') }}"></button>
                <button type="submit" class="btn btn-loc visible-xs"><span><img src="{{ url($server_path.'app_asset/images/location.png') }}"></span>Near Me</button>
            </div>
            <div class="form-group hidden-xs">
                <button type="submit" class="btn btn-search " ><img src="{{ url($server_path.'app_asset/images/search.png') }}"></button>
            </div>
            <div class="form-group hidden-xs">
                <button type="submit" class="btn btn-loc near_me"><span><img src="{{ url($server_path.'app_asset/images/location.png') }}"></span>Near Me</button>
				 <input type="hidden" name="latitude" id="latitude" class="form-control" value="{{$latitude}}">
				 <input type="hidden" name="longitude" id="longitude" class="form-control" value="{{$longitude}}">
            </div>
       
		
        <div class="select-form">
			@if($select_property_type!="" || $semi_furnished!="" || $fully_furnished!="" || $unfurnished!="" || $select_owner_free!="" || $select_ac!="" || $select_food_inclusive!="" || $select_available_for!="" ) <?php $display="inline"; $display1="none";?>  @else <?php $display="none" ; $display1="inline";;?> @endif

				<div class="filter-btn-primary1" >
					<button type="button" class="show_filter" id="show_filter" name="show_filter" value="show_filter" data-toggle="modal" data-target="#apply_filter-modal" >Filters</button>
				</div>
			
		</div>		
	</div>
        
    </div>
	 </form>
</section>
<!--    loc-sec ends-->

<!--loc-pro-sec section starts-->
<section class="loc-pro-sec wow fadeInUp" data-wow-delay="0.3s">
    <div class="container-fluid inner-container">
        <h1 class=" wow fadeInRight" data-wow-delay="0.2s">Showing  @if(!empty(count($propertyListing))) {{$propertyListing->total()}} @else 0 @endif properties near you</h1>
        <div class="loc-pro-outer">
               <!-- Check property list-->
            <?php if(!empty(count($propertyListing)))
			{
			$images_list=$list=array();
			$rent="0";$address="";
			foreach($propertyListing as $listings)
			{
				$images_list=array();
				$rent=0;
				$furnished=$property_type=$property_title="";
				if(isset($listings->property_descriptions))
				{
									 $rent=array();
									foreach($listings->property_descriptions as $key=>$value)
									{
									
										$rent[]=$value->rent;
									
									}
									 if(count($rent)>0) $rent =min($rent); else $rent="0"; 
				
				}



				if(!empty(count($listings->property_images)))
					{					
						foreach($listings->property_images as $key=>$value)
						{																				
							$images_list[]=array("image"=>$value->image);
						}
										
					}       				
					
					
					
					
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
			if(isset($listings->property_details->property_title)) {$property_title=$listings->property_details->property_title ;} else {$property_title="Flat/PG is available"; }
			
			
			if(isset($listings->property_details->furnishing))								
			{
				if($listings->property_details->furnishing==3)
				{
					$furnished="Fully Furnished";
				}
				elseif($listings->property_details->furnishing==2)
				{
					 $furnished="Semi Furnished";
				}					 
				else
				{
					 $furnished="Unfurnished";
				}
			}
			else
			{
				 $furnished="Fully Furnished";
			}
			if(isset($listings->property_details->property_type))
			{				
				if($listings->property_details->property_type==1)
				{
					$property_type="";
				}					
				else
				{
					$property_type="Room";
				}					
				
			}
			else
			{
				$property_type="Flat/PG";
			}
			
			$list[]=array('property_code'=>$listings->property_code,'rent'=>$rent,'property_id'=>$listings->id,'images_list'=>$images_list,'address'=>$address,'property_title'=>$property_title,"furnished"=>$furnished,"property_type"=>$property_type);
			
			}
			//dd($list);
			$price= array_column($list,'rent');
			if($order=="DESC" )
			{
				array_multisort($price, SORT_DESC, $list);
			}
			else
			{
				array_multisort($price, SORT_ASC, $list);
			}
				
			?>
                @foreach($list as $listings)
                    
					<div class="infinite-scroll">
                    <div class="loc-colivv">
                        <div class="co-liv-content">
                            <div class="locpro-slid">
								<a href="{{url('/')}}/propertylist_detail/{{$listings['property_code']}}">
                                <div class="owl-carousel owl-theme loc-pro-slider">
								
									@if(isset($listings['images_list']))
									 @if(count($listings['images_list']) >0)
										@foreach($listings['images_list'] as $key=>$value)
										<div class="item">										
											<img src="{{ url('/') }}/{{$value['image']}}" alt="">
										</div>
										@endforeach
									@else
										<img src="{{ url($server_path.'app_asset/images/property-slider1.png') }}" alt="">
									@endif  
									@else
										<img src="{{ url($server_path.'app_asset/images/property-slider1.png') }}" alt="">
									@endif								
                                </div>
								</a>
                            </div>
							 <?php 
									if(isset($fav_array) && count($fav_array)>0)
									{
										if(in_array($listings['property_id'],$fav_array ))
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
                            <div class="property-like {{$class}}" id="pro_{{$listings['property_id']}}" data-value="{{$listings['property_id']}}">
                                <span class="icon-heart-1 white-heart"></span>
                                <span class="icon-heart-1"></span>
                            </div>
                            <figcaption>
							<a href="{{url('/')}}/propertylist_detail/{{$listings['property_code']}}">
                                <h2>
								{{$listings['property_title']}}
								
								</h2>   								
								<h4><span class="icon-gps"></span>{{$listings['address']}}</h4>
                                <p>Rent Starts at <span class="rs-span">{{$listings['rent']}} </span>
								per month</p>
								<p>Furnishing :	{{$listings['furnished']}}</p>
								</a>
                                <div class="co-slider-btn">
                                    
                                     <a href="javascript:void(0);" class="visit-book"  data-toggle="modal" data-target="#visit-modal" data-id="{{$listings['property_id']}}" data-url="{{$listings['property_title']}}" data-value="{{$listings['address']}}" >Schedule a Visit</a>
                                    <a href="javascript:void(0);" class="now-book">Book Now</a>
                                </div>
                            </figcaption>
							
                        </div>
                    </div>
					 
				
				@endforeach
				<div class="property_pages">
				{{ $propertyListing->appends(request()->except(['_token']))->links() }}
				</div>
				</div>
				<?php
			}
				?>


        </div>
		<!--
        <div class="property-loader">
            <figure>
                <img src="app_asset/images/property-loader.png" alt="">
            </figure>
            <figcaption>
                <p>Loading...</p>
            </figcaption>
        </div>-->
    </div>
</section>
<!--loc-pro-sec section ends-->
 <script src="https://maps.google.com/maps/api/js?key=AIzaSyB-A2cTCjqfq0h-GkAEQT4hCbvB2W7xRC8&libraries=places&callback=initAutocomplete" type="text/javascript"></script>
 <script type="text/javascript">
  /*  $('ul.pagination').hide();
    $(function() {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: '  <div class="property-loader"><figure><img src="public/app_asset/images/property-loader.png" alt=""></figure><figcaption><p>Loading...</p> </figcaption></div>',
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });*/
</script>
	
<script>
            $(document).ready(function() {
                $("#lat_areafirst").addClass("d-none");
                $("#long_areafirst").addClass("d-none");
            });
        </script>

        <script>
            google.maps.event.addDomListener(window, 'load', initialize);

            function initialize() {
                var input = document.getElementById('autocompletefirst');
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.addListener('place_changed', function() {
                    var place = autocomplete.getPlace();
                    $('#latitudefirst').val(place.geometry['location'].lat());
                    $('#longitudefirst').val(place.geometry['location'].lng());

                    // --------- show lat and long ---------------
                    $("#lat_areafirst").removeClass("d-none");
                    $("#long_areafirst").removeClass("d-none");
                });
            }
        </script>

        <script>
            $(document).ready(function() {
                $("#lat_area").addClass("d-none");
                $("#long_area").addClass("d-none");
            });
        </script>

        <script>
            google.maps.event.addDomListener(window, 'load', initialize);

            function initialize() {
                var input = document.getElementById('autocomplete');
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.addListener('place_changed', function() {
                    var place = autocomplete.getPlace();
                    $('#latitude').val(place.geometry['location'].lat());
                    $('#longitude').val(place.geometry['location'].lng());

                    // --------- show lat and long ---------------
                    $("#lat_area").removeClass("d-none");
                    $("#long_area").removeClass("d-none");
                });
            }
        </script>
		<script>
		
		
		 $(document).on('click', '.near_me', function() {
			$.getJSON('https://geoip-db.com/json/geoip.php?jsonp=?')  
			.done (function(location)
			{
			$('#latitude').val(location.latitude);
			$('#longitude').val(location.longitude);
			});
			
		});
		
		$('#available_for').on('change', function() {
            if($('#available_for').val() != ""){
                $('.apply-filter').show();
            }else{
                $('.apply-filter').hide();
            }
        });
		
		$('#order').on('change', function() {
            if($('#order').val() != ""){
                $('.apply-filter').show();
            }else{
                $('.apply-filter').hide();
            }
        });
		
		$('#food_inclusive').on('change', function() {
            if($('#food_inclusive').val() != ""){
                $('.apply-filter').show();
            }else{
                $('.apply-filter').hide();
            }
        });
		
		$('#owner_free').on('change', function() {
            if($('#owner_free').val() != ""){
                $('.apply-filter').show();
            }else{
                $('.apply-filter').hide();
            }
        });
		
		$('#AC').on('change', function() {
            if($('#AC').val() != ""){
                $('.apply-filter').show();
            }else{
                $('.apply-filter').hide();
            }
        });
		
		$('#fully_furnished').on('change', function() {
            if($('#fully_furnished').val() != ""){
                $('.apply-filter').show();
            }else{
                $('.apply-filter').hide();
            }
        });
		
		$('#semi_furnished').on('change', function() {
            if($('#semi_furnished').val() != ""){
                $('.apply-filter').show();
            }else{
                $('.apply-filter').hide();
            }
        });
		
		$('#unfurnished').on('change', function() {
            if($('#unfurnished').val() != ""){
                $('.apply-filter').show();
            }else{
                $('.apply-filter').hide();
            }
        });
		
		$('input[name=property_type]').on('change', function() {
            if($('input[name=property_type]:checked').val() == 2 || $('input[name=property_type]:checked').val() == 1 ){
                $('.apply-filter').show();
            }else{
                $('.apply-filter').hide();
            }
        });
		$('#city').on('change', function() {
        // this.form.submit();
		 $('#autocomplete_fill').val($('#autocomplete').val());
		 $('#city_filter').val($('#city').val());
		 document.forms["search-form1"].submit();
        });
		
		 $(document).on('click', '.show_filter', function() {	
          
               
            
        });
		 $('input[name=property_type]').on('change', function() {
          
           if($('input[name=property_type]:checked').val() == 2){
                $('.div_pg').show();
				$('.div_flat').hide();
            }else{
                $('.div_pg').hide();
				$('.div_flat').show();
            }
            
        });
		
		</script>
		<script type="text/javascript">
  var min_value=$("#min").val(); var max_value=$("#max").val();
 
  $(function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 100000,
      values: [ min_value, max_value ],
      slide: function( event, ui ) {
        $( "#amount" ).html( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		$( "#min" ).val(ui.values[ 0 ]);
		$( "#max" ).val(ui.values[ 1 ]);
		$('.apply-filter').show();
      }
      });
    $( "#amount" ).html( "$" + $( "#slider-range" ).slider( "values", 0 ) +
     " - $" + $( "#slider-range" ).slider( "values", 1 ) );
  });
  </script>

@include('footer')
@endsection
