@extends('admin.dashboard.base')

@section('content')


<div class="container-fluid">
	<div class="fade-in">
	
	<div class="row">
		<div class="col-md-12">
	
		<div class="card">			
			<div class="card-body ad-card">
			<div class=" row">
				<div class="col-md-6">
				<h6>Property Code : {{$propertyData->property_code}}</h6>
				</div>
				<div class="col-md-6">
				<h6>Property Set As Featured:
				@if(isset($propertyData->property_details->featured ))
			@if($propertyData->property_details->featured == 1 ){{_('Yes')}}
			@else {{_('No')}}
			
			@endif
			@else {{_('No')}}
		@endif</h6>
				</div>
				<div class="col-md-6">
				<h6>Property Link  : <a href="{{url('/')}}/propertylist_detail/{{$propertyData->property_code}}" target="_blank">LINK</a></h6>
				</div>
				<div class="col-md-6">
				Property : {{$verified}}
				</div>
				<!--<div class="col-md-4">
				<h6>Alternate number:
				<strong>0000000000</strong></h6>
				</div>-->
				</div>
			</div>
			</div>
		</div>
		</div>
	<div class="row">
		<div class="col-md-12">
	
		<div class="card">
			<div class="card-header">
			<strong>Area Manager</strong>
			</div>
			<div class="card-body ad-card">
			<div class=" row">
				<div class="col-md-4">
				<h6>Name: {{$property_manager->name}}</h6>
				</div>
				<div class="col-md-4">
				<h6>Phone number:
				{{$property_manager->phone}}</h6>
				</div>
				<!--<div class="col-md-4">
				<h6>Alternate number:
				<strong>0000000000</strong></h6>
				</div>-->
				</div>
			</div>
			</div>
		</div>
		</div>

		<!-- /Start General Owner Details-->
			<div class="row">
		<div class="col-md-12">
		<div class="card">
			<div class="card-header">
			<strong>General details(Owner)</strong>
			</div>
			<div class="card-body general-card">
			<div class=" row">
				
				<div class="col-md-5">
				<h6 style="margin-bottom:12px">Name: @if(isset($property_owner->owner_name)){{ $property_owner->owner_name }}@endif</h6>
					<h6>Email Address:
				@if(isset($property_owner->owner_email)){{ $property_owner->owner_email}}@endif</h6>
				</div>
				<div class="col-md-4">
				<h6 style="margin-bottom:12px">Contact Number:
				@if(isset($property_owner->owner_number)){{ $property_owner->owner_number}}@endif</h6>
				<h6>Alternate Contact:
				@if(isset($property_owner->alernate_number)){{ $property_owner->alernate_number}}@endif</h6>
				</div>
                </div>
				<div class="row propert-lease-term">
				 <div class="col-md-12 card-header">
                          <strong>
                             Property Owned / Property Leased
                          </strong>
                    </div>

				@if(isset($propertyData->property_owners))
                @if($propertyData->property_owners->property_owned == 2 )

                    <!-------------- if Proprty leased ----------------------->
                   
                    
                        <div class="col-md-12 ">
                            <strong>Property Leased Details</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="pro-leased-det">
                                       
                                        <ficaption>
                                        <h6>Unit:
                                           
                                                @if($propertyData->property_owners->lease_unit ==1) {{_('Month')}}
                                                @elseif($propertyData->property_owners->lease_unit == 2) {{_('Year')}}
                                                @endif
                                           
                                        </h6>
                                        <h6>Duration:{{$propertyData->property_owners->lease_duration}}</h6>
                                        <h6>Expiry of Lease: {{$propertyData->property_owners->lease_expiry}}</h6>
                                        </ficaption>
										 <figure data-toggle="modal" data-target="#addres-Modal">
                                        <img src="{{ url('')}}/public/{{$propertyData->property_owners->lease_deed}}" alt="address proof">
                                        </figure>
                                        </div>
                                </div>
				
                            </div>
                        </div>
                    </div>
                
				@else
					
					@if($propertyData->property_owners->id_proof_is_same_address == 1 )
						<div class="col-md-12 ">
						Identity proof with same address : Yes
						</div>	
					@else
					<div class="col-md-12 ">
						Address Proof :
									@if($propertyData->property_owners->property_diff_address == 1 ){{_('Electricity Bill (not older than last three months')}}
                                    @elseif($propertyData->property_owners->property_diff_address == 2 ) {{_('Registration Document')}}
                                    @elseif($propertyData->property_owners->property_diff_address == 3 ) {{_('Water bill (Not older than last three months)')}}
									@endif	
									
							
					</div>	
					<div class="col-md-12 ">
							<div class="proof-front" data-toggle="modal" data-target="#diff-proof-modal">
							    <img src="{{url('')}}/public/{{ $propertyData->property_owners->property_address_img }}" alt="proof front">
							</div>
					</div>					
					@endif
				@endif
				
				@endif
				</div>	
				<!-------------- if Proprty leased ends ----------------------->

				<!-------------- If Id Proofs----------------------->
				<div class="row propert-identity-term">
					<div class="col-md-12 card-header">
					    <strong>Identity Proof</strong>
					</div>
					<div class="card-body">
						<div class="row">
						    <div class="col-md-6">
						        <h6>Owner Id Proof: 
                                    @if($property_owner_id_drop == 1 ){{_('Aadhar Card')}}
                                    @elseif($property_owner_id_drop == 2 ) {{_('Driving License')}}
                                    @elseif($property_owner_id_drop == 3 ) {{_('Passport')}}
                                    @elseif($property_owner_id_drop == 4 )  {{_('Voter Id')}}
									@else {{_('Non Verified')}}
                                    @endif
                                    
                                </h6>
							</div>
						    <div class="col-md-6">
                                <h6>GST Number: {{$property_gst}}</h6>
						    </div>
						</div>

						<div class="row">
							<div class="col-md-6">
						<div class="adhar-div">
						   @if($property_owner_id_front!="" || $property_owner_id_back!="") <h6>Identity Proof</h6>@endif
							@if($property_owner_id_front!="")
							<div class="proof-front" data-toggle="modal" data-target="#proof-front-modal">
							    <img src="{{url('')}}/public/{{ $property_owner_id_front }}" alt="proof front">
							</div>
							@endif
							@if($property_owner_id_back!="")
							<div class="proof-back" data-toggle="modal" data-target="#proof-back-modal">
							    <img src="{{url('')}}/public/{{ $property_owner_id_back }}" alt="proof back">
							</div>
							@endif
						</div>
							
				

                        @if($propertyData->id_proof_is_same_address == 2)
                            <div class="adhar-div different-proof">
                                <h6>Identity proof with different address:
                                    @if($propertyData->property_owners->property_diff_address == 1) {{_('Electricity Bill')}}
                                        @elseif($propertyData->property_owners->property_diff_address == 2) {{_('Registration Document')}}
                                        @elseif($propertyData->property_owners->property_diff_address == 3) {{_('Water bill')}}
                                        @endif
                                    
                                </h6>
                                <div class="diff-proof" data-toggle="modal" data-target="#diff-proof-modal">
                                <img src="{{ url('')}}/public/{{$propertyData->property_owners->property_address_img}}" alt="">
                                </div>
                            </div>
                        @endif
								</div>
														<div class="col-md-6">
			    <div style="margin-top:20px">
				        <h6 style="margin-bottom:10px;"><strong>Deals</strong></h6>
				   
				    <div>
                        <p>{{_('Offer:')}} <strong>{{$propertyData->deals}} {{_('%')}}</strong></p>
				    </div>
			    </div>
			</div>
							</div>

					</div>
				</div>
				<!-------------- Id Proofs ends----------------------->


			</div>
			</div>
		</div>
		</div>
		<!-- /Start General Owner Details ends-->

		<!-- /Start General Property Details-->
		<div class="row deals-row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong>General Details (Property)</strong>
                    </div>
                    <div class="card-body">
					 
                       
                        <h6>Available for:<br>
						@if(isset($propertyData->property_details))
                            @if($propertyData->property_details->property_available_men == 1 ){{_('Men')}} <br> @endif
                            @if($propertyData->property_details->property_available_women == 1 ) {{_('Women')}} <br> @endif
                            @if($propertyData->property_details->property_available_unisex == 1 ) {{_('Unisex')}}  <br>@endif
							@if($propertyData->property_details->property_available_family == 1 ) {{_('Family')}}  <br> @endif
							
						@else
							{{_('Available For All')}}
						@endif
                         
                        </h6>

                        <h6>Furnishing: 
						@if(isset($propertyData->property_details))
                            @if($propertyData->property_details->furnishing == 1 ){{_('Unfurnished')}}
                            @elseif($propertyData->property_details->furnishing == 2 ) {{_('Semi Furnished')}}
                            @elseif($propertyData->property_details->furnishing == 3 ) {{_('Fully Furnished')}}
                           @else
							{{_('Unfurnished')}}
                            @endif
						@else
							{{_('Unfurnished')}}
						@endif
                        </h6>

                        <h6>Owner Free:
						@if(isset($propertyData->property_details))
                            @if($propertyData->property_details->owner_free == 1 ){{_('Yes')}}
                            @elseif($propertyData->property_details->owner_free == 2 ) {{_('No')}}
                         @else
							{{_('Yes')}}
                            @endif
						@else
							{{_('Yes')}}
						@endif
                        </h6>
                    </div>
                </div>
			</div>
<?php  $address_sector='';$address_city='';$address_state=""; ?>
			<div class="col-md-6">
			    <div class="card">
			        <div class="card-header pro-add">
				        <strong>Property Address Details</strong>
				    </div>
				    <div class="card-body">
                        @if(!empty($propertyData->property_addresses))
							<?php 
							if(isset($propertyData->property_addresses->address_city))
							{
								$city=App\City::where('id',$propertyData->property_addresses->address_city)->first();				
								$address_city=$city->name;
							}
							if(isset($propertyData->property_addresses->address_sector))
							{
								$address_sector=App\Sector::where('id',$propertyData->property_addresses->address_sector)->first();
								$address_sector=$address_sector->slug;
							}						
							if(isset($propertyData->property_addresses->address_state))
							{
								$address_state=App\State::where('id',$propertyData->property_addresses->address_state)->first();
								$address_state=$address_state->name;
							}	
							?>
                        <p style="font-weight:500">{{$propertyData->property_addresses->address_house}} 
                        {{$propertyData->property_addresses->address_building}} {{$propertyData->property_addresses->address_street}} {{$address_sector}} {{$address_city}} {{$address_state}} {{$propertyData->property_addresses->zipcode}}</p>
					   
					<br>GEO Location : {{$propertyData->property_addresses->geo_location}} 		<br>			   <div class="add-map">

                        

                        <iframe src="https://maps.google.com/maps?q={{$propertyData->property_addresses->lat}},{{$propertyData->property_addresses->lng}}&z=8&output=embed&amp;key=AIzaSyB-A2cTCjqfq0h-GkAEQT4hCbvB2W7xRC8" width="300" height="150" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>    
                            @endif
						</div>
				    </div>
			    </div>
            </div>

		
		</div>
		<!-- /Start General Property Details end-->

		<!-- Start Property Description details -->
		<div class="row">
		    <div class="col-md-12">
			    <div class="card">
			        <div class="card-header">
                        <strong>Property Description</strong>
                    </div>
				    <div class="card-body">
				        <div class="flat-type">
							<h6>
                             Property Title:  @if(isset($propertyData->property_details->property_title))
							 {{$propertyData->property_details->property_title}}
								@endif
                            </h6>
							<h6>
                             About Property:  @if(isset($propertyData->property_details->property_about))
							 {{$propertyData->property_details->property_about}}
								@endif
                            </h6>
							<h6>
							@if(isset($propertyData->property_details->property_type) && $propertyData->property_details->property_type == 1 )
								Total Number of Beds :  @if(isset($propertyData->property_details->total_room_for_rent ))
								{{$propertyData->property_details->total_room_for_rent }}	@endif
							@else
							Total Number of Rooms :  @if(isset($propertyData->property_details->total_bed_for_rent  ))
								{{$propertyData->property_details->total_bed_for_rent  }}	@endif
								@endif
                            </h6>
					        <h6>
                             Property Type:  @if(isset($propertyData->property_details))
                            @if($propertyData->property_details->property_type == 1 ){{_('Flat')}}
                            @elseif($propertyData->property_details->property_type == 2 ) {{_('PG')}}
							@elseif($propertyData->property_details->property_type == 3) {{_('Flat/PG')}}
							@else
							{{_('Flat/PG')}}
									@endif
								@else
									{{_('Flat/PG')}}
								@endif
                            </h6>

							
                            @foreach($propertyData->property_descriptions as $propertyDesc)
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6 style="margin:20px 0 10px">
                                           
                                                @if($propertyDesc->room_type == 1 ){{_('Single Room')}}
                                                @elseif($propertyDesc->room_type == 2 ) {{_('Double Room')}}
                                                @elseif($propertyDesc->room_type == 3 ) {{_('Triple Room')}}
                                                @elseif($propertyDesc->room_type == 4 ) {{_('Other Room')}}
                                                @elseif($propertyDesc->room_type == 5 ) {{_('1 RK')}}
                                                @elseif($propertyDesc->room_type == 6 ) {{_('1 BHK')}}
                                                @elseif($propertyDesc->room_type == 7 ) {{_('2 BHK')}}
												@elseif($propertyDesc->room_type == 14 ) {{_('3 BHK')}}
												@elseif($propertyDesc->room_type == 15 ) {{_('4 BHK')}}
                                                @elseif($propertyDesc->room_type == 8 ) {{_('Other Flat')}}
												@elseif($propertyDesc->room_type == 9 ) {{_('One Room')}}
												@elseif($propertyDesc->room_type == 10) {{_('Two Room')}}
												@elseif($propertyDesc->room_type == 13) {{_('Three Room')}}
                                                @endif
                                           
                                        </h6>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Room description: {{$propertyDesc->description}}</h6>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Quantity: {{$propertyDesc->quantity}}</h6>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Rent/Month: {{$propertyDesc->rent}}</h6>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Security Amount: {{$propertyDesc->security}}</h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>
				    </div>
			    </div>
			</div>
		</div>
		<!-- Start Property Description details ends -->

		<!-------  ****** Rent Inclusions ******** ----------------------->
		<div class="row">
		    <div class="col-md-6">
			    <div class="card block-two">
			        <div class="card-header">
				        <strong>Rent Inclusions</strong>
				    </div>
				    <div class="card-body">
                        <h6>Food Inclusive:
						@if(isset($propertyData->property_details))
                            @if($propertyData->property_details->food_inclusive == 1 ){{_('Yes')}}
                            @elseif($propertyData->property_details->food_inclusive == 2 ) {{_('No')}}
                            @endif
                        @else							
						{{_('No')}}
						@endif						
                        </h6>
						@if(isset($propertyData->property_details))
						@if($propertyData->property_details->food_inclusive == 1 )
						@elseif($propertyData->property_details->food_inclusive == 2 )
							<h6>Price per month: 
								{{$propertyData->property_details->food_exclusive_rent}}
						   
							</h6>
						@endif
						@else							
						{{_('No')}}
						@endif
                        <h6>Electricity Inclusive: 
						@if(isset($propertyData->property_details))
                                @if($propertyData->property_details->electricity_inclusive == 1 ){{_('Yes')}}
                                @elseif($propertyData->property_details->electricity_inclusive == 2 ) {{_('No')}}
                                @endif
						@else							
						{{_('No')}}
						@endif		
                        </h6>
						<h6>Water Inclusive: 
						@if(isset($propertyData->property_details))
                                @if($propertyData->property_details->water_inclusive == 1 ){{_('Yes')}}
                                @elseif($propertyData->property_details->water_inclusive == 2 ) {{_('No')}}
                                @endif
						@else							
						{{_('No')}}
						@endif
                        </h6>
						
				    </div>
			    </div>
			</div>

            <!--****** Rent Inclusions ends *******-->
            <!-- /Start Additional Information -->

            <div class="col-md-6">
                <div class="card block-two">
                    <div class="card-header">
                        <strong>Additional Information</strong>
                    </div>
                    <div class="card-body">
					@if(isset($propertyData->property_additional_information))
                        @foreach($propertyData->property_additional_information as $additionalInfo)
                        <ul>
                            <li>{{$additionalInfo->additional_information}}</li>

                        </ul>
                        @endforeach
					@else							
					
					@endif
                    </div>
                </div>
            </div>
	    </div>
		<!-- /Start Additional Information ends-->

        <!-- /Start Upload Pics -->
        <div class="row">
            <div class="col-md-12">
                <div class="card update-img-block">
                    <div class="card-header">
                        <strong>Property Images</strong>
                    </div>
                    <div class="card-body">
                        <ul>
						@if(isset($propertyData->property_images))
                            @foreach($propertyData->property_images as $propertyImg)
                                <li> <img src="{{url('')}}/{{ $propertyImg->image }}" alt=""></li>
                            @endforeach
						@else							
						
						@endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Start Upload Pics END -->
<!-------Amenities---------------->
		<div class="row">
			<div class="col-md-12">
		        <div class="card">
			        <div class="card-header">
				        <strong>Neighbourhood</strong>
                    </div>

				    <div class="card-body amen-sec">
				        <div class="row neighbour1" >
						@if(isset($propertyData->property_neighbourhood))
							@if(count($propertyData->property_neighbourhood)>0)
                            @foreach($propertyData->property_neighbourhood as $key=>$value)
                                <ul>
									<li>Area : {{$value['area']}} <br>Distance :{{$value['distance']}}</li>

								</ul>								
                            @endforeach
						@endif	
						@endif
                        </div>
				    </div>
			    </div>
			</div>
		</div>
<!------Amenities ends--------------->
<!-------Amenities---------------->
		<div class="row">
			<div class="col-md-12">
		        <div class="card">
			        <div class="card-header">
				        <strong>Amenities</strong>
                    </div>

				    <div class="card-body amen-sec">
				        <div class="row">
						@if(isset($amenities) && count($amenities)>0)
                            @foreach($amenities as $key=>$value)
                                <div class="colpropertyData-md-2 col-sm-2 ">
                                    <figure>
                                        <img src="{{url('')}}/{{ $value['image'] }}" alt="">
                                    </figure>
                                    <figcaption>
                                        <h6>{{$value['name']}}</h6>
                                    </figcaption>
                                </div>
                            @endforeach
							
							@if(isset($propertyData->property_details->amenities_others ) && $propertyData->property_details->amenities_others==1)
							<div class="colpropertyData-md-2 col-sm-2">
								<figure>
									<img src="{{url('')}}/public/app_asset/images/others.png" alt="">
								</figure>
								<figcaption>
									<h6> {{$propertyData->property_details->amenities_others_text}}</h6>
								</figcaption>
							</div>
							@endif
						@else							
						
						@endif
                        </div>
				    </div>
			    </div>
			</div>
		</div>
<!------Amenities ends--------------->

<!--*****************digital-sign*****************-->
		<div class="row">
			<div class="col-md-12">
			    <div class="card">
			        <div class="card-header">
				        <strong>Digital Signature</strong>
				    </div>
				    <div class="card-body digital-signatur ">
					@if(isset($propertyData->property_digital_signature))
                        <figure data-toggle="modal" data-target="#digil-sign-Modal">
                            <img id="digital-sign" src="{{url('')}}/public/{{ $propertyData->property_digital_signature->digital_signature }}" alt="digital Signature" width=300>
                        </figure>
					@else							
						
					@endif
				    </div>
			    </div>
			</div>
		</div>
<!--*****************digital-sign ends*****************-->

	</div>


<!--address modal-->
<div class="modal fade" id="addres-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
	  @if(isset($propertyData->property_owners))
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       	<img src="{{ url('') }}/public/{{$propertyData->property_owners->lease_deed}}" alt="address proof" style="width:450px;height:auto">
		@else							
						
		@endif
      </div>
    </div>
  </div>
</div>

<!--proof-front-modal-->
<div class="modal fade" id="proof-front-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
	    @if($property_owner_id_front!="")
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <img src="{{ url('')}}/public/{{ $property_owner_id_front }}" alt="proof front" style="width:450px;height:auto">
      </div>
	  @else							
						
		@endif
    </div>
  </div>
</div>


<!--proof-back-modal-->
<div class="modal fade" id="proof-back-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
	  @if($property_owner_id_back!="")
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="{{ url('')}}/public/{{ $property_owner_id_back }}" alt="proof back" style="width:450px;height:auto">
		@else							
						
		@endif
      </div>
    </div>
  </div>
</div>

<!--diff-proof-modal-->
<div class="modal fade" id="diff-proof-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
	  @if(isset($propertyData->property_owners))
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="{{ url('')}}/public/{{ $propertyData->property_owners->property_address_img }}" alt="proof" style="width:450px;height:auto">
		@else							
						
		@endif
      </div>
    </div>
  </div>
</div>

<!--diff-proof-modal-->
<div class="modal fade" id="digil-sign-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
	  @if(isset($propertyData->property_digital_signature))
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <img id="digital-sign" src="{{url('')}}/public/{{ $propertyData->property_digital_signature->digital_signature }}" alt="digital Signature" style="width:450px;height:auto">
		  @else							
						
		@endif
      </div>
    </div>
  </div>
</div>


@endsection
