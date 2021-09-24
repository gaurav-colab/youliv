@extends('layouts.addpropertylist')

@section('content')

<!--        property-detail-sec1 section starts-->
<section class="property-detail-sec1">
    <div class="container-fluid inner-container">
        <div class="row">
            <div class="col-lg-6 col-md-12 ">		
                <div class="co-liv-content pd-sec1-img wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="locpro-slid">
							<div class="owl-carousel owl-theme loc-pro-slider">
								@if(!empty(count($propertyListing->property_images)))	
										@foreach($propertyListing->property_images as $key=>$value)
										<div class="item">										
											<img src="{{ url('/') }}/{{$value->image}}" alt="">
										</div>
										@endforeach
									@else
										<div class="item">	
											<img src="{{ url($server_path.'app_asset/images/pd-sec-img1.png') }}" alt="youliv property" >
										</div>
									@endif  
                        </div>
                    </div>
                   <!-- <div class="fm-occp woman-room">
                        <h2><span class="icon-woman"></span>
								@if(isset($propertyListing->property_details->property_available))								
									@if($propertyListing->property_details->property_available==1)
										Men
									@elseif($propertyListing->property_details->property_available==2)
									Women
									@else
										Unisex
									@endif
								@else
									  No Information Available
								@endif</h2>
                    </div>-->
					 <?php 
						if(isset($fav_array) && count($fav_array)>0)
						{
							if(in_array($propertyListing->id,$fav_array ))
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
					<div class="property-like {{$class}}" id="pro_{{$propertyListing->id}}" data-value="{{$propertyListing->id}}">
                        <span class="icon-heart-1 white-heart"></span>
                        <span class="icon-heart-1"></span>
                    </div>


                </div>
            </div>
            <div class="col-lg-6 col-md-12 ">
                <div class="pd-hs-detail wow zoomIn" data-wow-delay="0.1s">
					@if(session('success'))
							<div class="alert alert-success">
								{!! session('success') !!}
							</div>
					@endif
					@if(session('warning'))
							<div class="alert alert-warning">
								{!! session('warning') !!}
							</div>
					@endif
					@if(session('error'))
							<div class="alert alert-error">
								{!! session('error') !!}
							</div>
					@endif
					
                    <h2>@if(isset($propertyListing->property_details->property_title))
						{{$propertyListing->property_details->property_title}}
						@endif
					</h2>
					
					
					 <?php						
						
						if(isset($propertyListing->property_addresses->address_city))
						{
							$city=App\City::where('id',$propertyListing->property_addresses->address_city)->first();				
							$address_city=$city->name;
						}
						if(isset($propertyListing->property_addresses->address_sector))
						{
							$address_sector=App\Sector::where('id',$propertyListing->property_addresses->address_sector)->first();
							$address_sector=$address_sector->slug;
						}						
						
						if(isset($address_city))
						{
							$address=$address_city.", ".$address_sector;
						}
						else
						{
							$address="Mohali/Chandigarh/Haryana";
						}
											
					?> 
                    <h4><span class="icon-gps"></span>{{$address}}</h4>
					
					<?php $bed="bed";?>
                    <h3 class="pd-heading">About the property</h3>
					<p class="p-code">Property Code : {{$propertyListing->property_code}}</p>	
                    <p>@if(isset($propertyListing->property_details->property_title)){{$propertyListing->property_details->property_about}}@endif</p>
						
					@if(count($propertyListing->property_descriptions)>0)

                    <div class="pd-price">
                        <h3 class="pd-heading">Pricing Details</h3>
                        <ul>
						
							@foreach($propertyListing->property_descriptions as $key=>$value)
									@if($value->room_type==1)
										<?php $img="single-bed.png"; $alt="Single Room";?>
									@elseif($value->room_type==2)
										<?php $img="2-bed.png"; $alt="Twin Sharing Room";?>
									@elseif($value->room_type==3)
										<?php $img="3bed.png"; $alt="Triple Sharing Room"; $bed="bed";?>
									@elseif($value->room_type==4)
										<?php $img="onebhk.jpg"; $alt="{$value->description}"; $bed="bed";?>
									@elseif($value->room_type==5)
										<?php $img="onebhk.jpg"; $alt="1 RK"; $bed="room";?>
									@elseif($value->room_type==6)
										<?php $img="onebhk.jpg"; $alt="1 BHK"; $bed="room";?>
									@elseif($value->room_type==7)
										<?php $img="onebhk.jpg"; $alt="2 BHK"; $bed="room";?>	
									@elseif($value->room_type==8)
										<?php $img="onebhk.jpg"; $alt="{$value->description}"; $bed="room";?>	
									@elseif($value->room_type==9)
										<?php $img="onebhk.jpg"; $alt="One Room"; $bed="room";?>	
									@elseif($value->room_type==10)
										<?php $img="onebhk.jpg"; $alt="Two Room"; $bed="room";?>
									@elseif($value->room_type==13)
										<?php $img="onebhk.jpg"; $alt="Three Room"; $bed="room";?>	
									@elseif($value->room_type==14)
										<?php $img="onebhk.jpg"; $alt="3 BHK"; $bed="room";?>	
									@elseif($value->room_type==15)
										<?php $img="onebhk.jpg"; $alt="4 BHK"; $bed="room";?>											
									@else
										<?php $img="onebhk.jpg"; $alt="Other Flat"; $bed="room";?>															
									@endif
								<li>
									<figure>
									 <img src="{{ url($server_path.'app_asset/images')}}/{{$img}}" alt="{{$alt}}">
									</figure>
									<figcaption>
									<h2>{{$alt}}</h2>								
									<p>Starting Price <span>₹{{$value->rent}} </span>
										{{$bed}} / month</p>	
									<p>@if($value->security!="") Security: ₹{{$value->security}} @endif </p>										
									
									</figcaption>
								</li>
							@endforeach    
						
												
                        </ul>
                    </div>
					@endif	
                </div>
            </div>
        </div>

    </div>
</section>
<!--        property-detail-sec1 section ends-->

<!--        property-detail-sec2 section starts-->
<section class="property-detail-sec2">
    <div class="container-fluid inner-container">
        <div class="row">
		
            <div class="col-lg-6 col-md-12 ">
			@if(count($amenities)>0)
                <div class="amen-sec wow fadeInUp" data-wow-delay="1.2s">
                    <h3 class="pd-heading">Amenities</h3>
                    <ul>
					
						@foreach($amenities as $key=>$value)
							<li>
								<figure>
									<img src="{{ url('/') }}/{{$value['image']}}">
								</figure>
								<figcaption>
									<h2>{{$value['name']}}</h2>
								</figcaption>
							</li>
						@endforeach
						
						@if(isset($propertyListing->property_details->amenities_others ) && $propertyListing->property_details->amenities_others==1)	
							<li>
								<figure>
									<img src="{{ url('/')}}/public/app_asset/images/others_am.png">
								</figure>
								<figcaption>
									<h2>{{$propertyListing->property_details->amenities_others_text}}</h2>
								</figcaption>
							</li>
						@endif
                    </ul>
                </div>
				@endif
            </div>
			
            <div class="col-lg-6 col-md-12 ">
                <div class="pd-hs-detail food-plan wow fadeInRight" data-wow-delay="1.2s">
                    <div class="co-slider-btn">
                        <a data-toggle="modal" data-target="#visit-modal" data-id="{{$propertyListing->id}}" data-url="{{$propertyListing->property_details->property_title}}" data-value="{{$address}}"class="visit-book" >Schedule a Visit</a>
                        <a href="javascript:void(0);" class="now-book" data-toggle="modal" data-target="#booknow-modal">Book Now</a>
                    </div>     
 			
                   <h3 class="pd-heading">Monthly Rental Breakup</h3>
					<p>Things which are covered in the monthly payment.</p>
                    <div class="monthly-breakup pd-price">
                        <ul>
                            <li>
                                <span class="pro_type">Food Charges:&nbsp;</span>
									@if( isset($propertyListing->property_details->food_inclusive) && $propertyListing->property_details->food_inclusive==1)									
										Included
									@elseif( isset($propertyListing->property_details->food_inclusive) && $propertyListing->property_details->food_inclusive==2)
									
										@if(isset($propertyListing->property_details->food_exclusive_rent) && $propertyListing->property_details->food_exclusive_rent!="")								 
											Provide Food in Addition. Food Charges are &nbsp;Rs {{$propertyListing->property_details->food_exclusive_rent}}
										@else
											Food is not provided.
										@endif 
									@else
										Not Included
 									@endif  
									
                            </li>
						     <li>
                                <span class="pro_type">Electricity Charges:&nbsp;</span> 
								@if(isset($propertyListing->property_details)) @if($propertyListing->property_details->electricity_inclusive ==1) Included @else On Actuals @endif  @else {{_('On Actuals')}}  @endif
                            </li>
							<li>
                               <span class="pro_type">Water Charges:&nbsp;</span>
                                @if(isset($propertyListing->property_details)) @if($propertyListing->property_details->water_inclusive ==1) Included @else On Actuals @endif @else {{_('On Actuals')}}  @endif
                            </li>
                            
                            
                        </ul>
                    </div>
					<h3 class="pd-heading">Overview</h3>
					 <div class="monthly-breakup">
						<div class="row">
							<div class="col-sm-6"><span class="pro_type">Furnishing: </span>
							@if(isset($propertyListing->property_details->furnishing))								
									@if($propertyListing->property_details->furnishing==1)
										Furnished
									@elseif($propertyListing->property_details->furnishing==2)
										 Semi Furnished									
									@else
										 Fully Furnished
									@endif
								@else
										  Fully Furnished
								@endif</div>							
							<div class="col-sm-6"><span class="pro_type">Property Type:&nbsp;</span>
							
							@if(isset($propertyListing->property_details->property_type))								
									@if($propertyListing->property_details->property_type==1)
										Flat 					
									@elseif($propertyListing->property_details->property_type==2)
										PG 
									@else
										Flat/PG
									@endif
								@else
								 Flat/PG
							@endif								
							</div>							
							<div class="col-sm-12" style="margin:10px 10px;"></div>
							<div class="col-sm-6"><span class="pro_type">Owner Free:&nbsp;</span>@if(isset($propertyListing->property_details)) @if($propertyListing->property_details->owner_free==1) Yes @else No @endif  @else {{_('No')}} @endif
</div>
							<div class="col-sm-6"><span class="pro_type">Available For:&nbsp;</span>
									@if(isset($propertyListing->property_details))	
									<?php 	
									$gender="";								
									if($propertyListing->property_details->property_available_women==1)
										{
											if($gender!="")
											{
												$gender.=", Women";
											}
											else{
												$gender.="Women";
											}
										}
										if($propertyListing->property_details->property_available_men==1)
										{
											if($gender!="")
											{
												$gender.=", Men";
											}
											else{
												$gender.="Men";
											}
										}
										if($propertyListing->property_details->property_available_unisex==1)
										{
											if($gender!="")
											{
												$gender.=", Unisex";
											}
											else{
												$gender.="Unisex";
											}
										}
										if($propertyListing->property_details->property_available_family==1)
										{					
											
											if($gender!="")
											{
												$gender.=", Family";
											}
											else{
												$gender.="Family";
											}												
										}
										echo $gender;										
									?>
									
								@else
									  Open for all
								@endif</div>
							
							
							<div class="col-sm-6">
							</div>
							<div class="col-sm-6">							
							  
							
							</div>
						</div>
						
					</div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--        property-detail-sec2 section ends-->


<!--        property-detail-sec3 section starts-->
<section class="property-detail-sec3 wow zoomIn" data-wow-delay="0.5s" style="margin-top:100px">
    <div class="container-fluid inner-container">
        <div class="row">   
			<div class="col-lg-6 col-md-12 ">
							<div class="neighbour pd-hs-detail">
							@if(isset($propertyListing->property_neighbourhood) && (count($propertyListing->property_neighbourhood) > 0 ))
								<h3 class="pd-heading">Neighbourhood</h3>
								<ul>
								
									@foreach($propertyListing->property_neighbourhood as $key=>$value)									
										<li>
											<p>{{$value->area}}</p>
											<h2>{{$value->distance}}</h2>
										</li>
									@endforeach
							
								</ul>
									@endif	
							</div>

			</div>		
            <div class="col-lg-6 col-md-6 ">
                <div class="imp-pd">
				@if(isset($propertyListing->property_additional_information) && (count($propertyListing->property_additional_information) > 0 ))
				
                    <h3 class="pd-heading">Important Information</h3>
                    <ul class="pd-hs-detail">
							
								@foreach($propertyListing->property_additional_information as $key=>$value)
									<li>
										<p>{{$value->additional_information}}</p>
									</li>
								@endforeach
						
                    </ul>
				@endif	
                </div>

            </div>
        </div>
        <div class="co-slider-btn">
            <a data-toggle="modal" data-target="#visit-modal" data-id="{{$propertyListing->id}}" data-url="{{$propertyListing->property_details->property_title}}" data-value="{{$address}}"class="visit-book" >Schedule a Visit</a>
            <a href="javascript:void(0);" class="now-book" data-toggle="modal" data-target="#booknow-modal">Book Now</a>
        </div>
    </div>
</section>
<!--        property-detail-sec3 section ends-->



@include('footer')
@endsection
