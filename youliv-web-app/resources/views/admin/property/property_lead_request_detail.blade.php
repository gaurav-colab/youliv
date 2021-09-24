@extends('admin.dashboard.base')

@section('content')


<div class="container-fluid">
	<div class="fade-in">		

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
					<h6 style="margin-bottom:12px">Name: @if(isset($propertyData->owner_name)){{ $propertyData->owner_name }}@endif</h6>					
				</div>
				<div class="col-md-4">
				<h6 style="margin-bottom:12px">Contact Number:
					@if(isset($property_owner->owner_number)){{ $propertyData->owner_number}}@endif</h6>
					<h6>Alternate Contact:
					@if(isset($propertyData->alernate_number)){{ $propertyData->alernate_number}}@endif</h6>
				</div>
                </div>
				<div class="row propert-lease-term">
				 <div class="col-md-12 card-header">
                          <strong>
                             Property Owned / Property Leased
                          </strong>
                    </div>

				
                @if($propertyData->property_owned == 2 )

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
                                           
                                                @if($propertyData->lease_unit ==1) {{_('Month')}}
                                                @elseif($propertyData->lease_unit == 2) {{_('Year')}}
                                                @endif
                                           
                                        </h6>
                                        <h6>Duration:{{$propertyData->lease_duration}}</h6>
                                        <h6>Expiry of Lease: {{$propertyData->lease_expiry}}</h6>
                                        </ficaption>
										 <figure >
                                       <a href="{{ url('')}}/public/{{$propertyData->lease_deed}}" > <img src="{{ url('')}}/public/{{$propertyData->lease_deed}}" alt="address proof"></a>
                                        </figure>
                                        </div>
                                </div>
				
                            </div>
                        </div>
                    </div>
                
				@else
					
					@if($propertyData->id_proof_is_same_address == 1 )
						<div class="col-md-12 ">
						Identity proof with same address : Yes
						</div>	
					@else
					<div class="col-md-12 ">
					@if($propertyData->property_diff_address!="")
						Address Proof :
									@if($propertyData->property_diff_address == 1 ){{_('Electricity Bill (not older than last three months')}}
                                    @elseif($propertyData->property_diff_address == 2 ) {{_('Registration Document')}}
                                    @elseif($propertyData->property_diff_address == 3 ) {{_('Water bill (Not older than last three months)')}}
									@endif	
									
					@endif			
					</div>	
					<div class="col-md-12 ">
							<div class="proof-front">
							@if($propertyData->property_address_img!="")
							    <a href="{{ url('')}}/public/{{$propertyData->property_address_img}}" ><img src="{{url('')}}/public/{{ $propertyData->property_address_img }}" alt="proof front"></a>
							@endif
							</div>
					</div>					
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
											@if($propertyData->id_proof_is_same_address == 2)
												<div class="adhar-div different-proof">
													<h6>Identity proof with different address:
														@if($propertyData->property_diff_address == 1) {{_('Electricity Bill')}}
															@elseif($propertyData->property_diff_address == 2) {{_('Registration Document')}}
															@elseif($propertyData->property_diff_address == 3) {{_('Water bill')}}
															@endif
														
													</h6>
													<div class="diff-proof" >
													<a href="{{ url('')}}/public/{{$propertyData->property_address_img}}" ><img src="{{ url('')}}/public/{{$propertyData->property_address_img}}" alt=""></a>
													</div>
												</div>
											@endif
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
						@if(isset($propertyData))
                            @if($propertyData->property_available_men == 1 ){{_('Men')}} <br> @endif
                            @if($propertyData->property_available_women == 1 ) {{_('Women')}} <br> @endif
                            @if($propertyData->property_available_unisex == 1 ) {{_('Unisex')}}  <br>@endif
							@if($propertyData->property_available_family == 1 ) {{_('Family')}}  <br> @endif
							
						@else
							{{_('Available For All')}}
						@endif
                         
                        </h6>

                        <h6>Furnishing: 
						@if(isset($propertyData))
                            @if($propertyData->furnishing == 1 ){{_('Unfurnished')}}
                            @elseif($propertyData->furnishing == 2 ) {{_('Semi Furnished')}}
                            @elseif($propertyData->furnishing == 3 ) {{_('Fully Furnished')}}
                           @else
							{{_('Unfurnished')}}
                            @endif
						@else
							{{_('Unfurnished')}}
						@endif
                        </h6>

                        <h6>Owner Free:
						@if(isset($propertyData))
                            @if($propertyData->owner_free == 1 ){{_('Yes')}}
                            @elseif($propertyData->owner_free == 2 ) {{_('No')}}
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
							if(isset($propertyData->address_city))
							{
								$city=App\City::where('id',$propertyData->address_city)->first();				
								$address_city=$city->name;
							}
							if(isset($propertyData->address_sector))
							{
								$address_sector=App\Sector::where('id',$propertyData->address_sector)->first();
								$address_sector=$address_sector->slug;
							}						
							if(isset($propertyData->address_state))
							{
								$address_state=App\State::where('id',$propertyData->address_state)->first();
								$address_state=$address_state->name;
							}	
							?>
							<p style="font-weight:500">{{$propertyData->address_house}} 
							{{$propertyData->address_building}} {{$propertyData->address_street}} {{$address_sector}} {{$address_city}} {{$address_state}} {{$propertyData->zipcode}}</p>
					   
					   

                        

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
                             Property Title:  @if(isset($propertyData->property_title))
							 {{$propertyData->property_title}}
								@endif
                            </h6>
							<h6>
                             About Property:  @if(isset($propertyData->property_about))
							 {{$propertyData->property_about}}
								@endif
                            </h6>
							<h6>
							@if(isset($propertyData->property_type) && $propertyData->property_type == 1 )
								Total Number of Beds :  @if(isset($propertyData->total_room_for_rent ))
								{{$propertyData->total_room_for_rent }}	@endif
							@else
							Total Number of Rooms :  @if(isset($propertyData->total_bed_for_rent  ))
								{{$propertyData->total_bed_for_rent  }}	@endif
								@endif
                            </h6>
					        <h6>
                             Property Type:  @if(isset($propertyData))
                            @if($propertyData->property_type == 1 ){{_('Flat')}}
                            @elseif($propertyData->property_type == 2 ) {{_('PG')}}
							@elseif($propertyData->property_type == 3) {{_('Flat/PG')}}
							@else
							{{_('Flat/PG')}}
									@endif
								@else
									{{_('Flat/PG')}}
								@endif
                            </h6>

							
                            @foreach($propertyData->property_request_descriptions as $propertyDesc)
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
						@if(isset($propertyData))
                            @if($propertyData->food_inclusive == 1 ){{_('Yes')}}
                            @elseif($propertyData->food_inclusive == 2 ) {{_('No')}}
                            @endif
                        @else							
						{{_('No')}}
						@endif						
                        </h6>
						@if(isset($propertyData))
						@if($propertyData->food_inclusive == 1 )
						@elseif($propertyData->food_inclusive == 2 )
							<h6>Price per month: 
								{{$propertyData->food_exclusive_rent}}
						   
							</h6>
						@endif
						@else							
						{{_('No')}}
						@endif
                        <h6>Electricity Inclusive: 
						@if(isset($propertyData))
                                @if($propertyData->electricity_inclusive == 1 ){{_('Yes')}}
                                @elseif($propertyData->electricity_inclusive == 2 ) {{_('No')}}
                                @endif
						@else							
						{{_('No')}}
						@endif		
                        </h6>
						<h6>Water Inclusive: 
						@if(isset($propertyData))
                                @if($propertyData->water_inclusive == 1 ){{_('Yes')}}
                                @elseif($propertyData->water_inclusive == 2 ) {{_('No')}}
                                @endif
						@else							
						{{_('No')}}
						@endif
                        </h6>
						
				    </div>
			    </div>
			</div>

	    </div>
		<!-- /Start Additional Information ends-->


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
							
							@if(isset($propertyData->amenities_others ) && $propertyData->amenities_others==1)
							<div class="colpropertyData-md-2 col-sm-2">
								<figure>
									<img src="{{url('')}}/public/app_asset/images/others.png" alt="">
								</figure>
								<figcaption>
									<h6> {{$propertyData->amenities_others_text}}</h6>
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


	</div>
</div>

@endsection
