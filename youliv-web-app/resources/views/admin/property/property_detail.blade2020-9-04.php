@extends('admin.dashboard.base')

@section('content')


<div class="container-fluid">
	<div class="fade-in">
	<div class="row">
		<div class="col-md-12">
		<div class="card">
			<div class="card-header">
			<strong>Area Manager</strong>
			</div>
			<div class="card-body ad-card">
			<div class=" row">
				<div class="col-md-4">
				<h6>Name: <strong>{{$propertyData[0]->managerName}}</strong></h6>
				</div>
				<div class="col-md-4">
				<h6>Phone number:
				<strong>{{$propertyData[0]->phone}}</strong></h6>
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
				<div class="col-md-2">
				<div class="owner-proof" style="text-align:center">
					<figure>
						  <img src="{{url('')}}/{{ $propertyData[0]->property_owner_image }}" alt="owner profile">
						  </figure>
					</div>
				</div>
				<div class="col-md-3">
				<h6>Name: <strong>{{ $propertyData[0]->owner_name }}</strong></h6>
				</div>
				<div class="col-md-3">
				<h6>Contact Number:
				<strong>{{ $propertyData[0]->owner_number}}</strong></h6>
				</div>
				<div class="col-md-3">
				<h6>Email Address:
				<strong>{{ $propertyData[0]->owner_email}}</strong></h6>
				</div>
                </div>



                @if($propertyData[0]->property_owned == 2)

                    <!-------------- if Proprty leased ----------------------->
                    <div class="row">
                        <div class="col-md-12">
                            <h3> Property Owned / Property Leased</h3>
                        </div>
                    </div>
                    <div class="row propert-lease-term">
                        <div class="col-md-12 card-header">
                            <strong>Property Leased Details</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pro-leased-det">
                                        <figure data-toggle="modal" data-target="#addres-Modal">
                                        <img src="{{ url('')}}/{{$propertyData[0]->lease_deed}}" alt="address proof">
                                        </figure>
                                        <ficaption>
                                        <h6>Unit:
                                            <strong>
                                                @if($propertyData[0]->lease_unit ==1) {{_('Month')}}
                                                @elseif($propertyData[0]->lease_unit == 2) {{_('Year')}}
                                                @endif
                                            </strong>
                                        </h6>
                                        <h6>Duration: <strong>{{$propertyData[0]->lease_duration}}</strong></h6>
                                        <h6>Expiry of Lease: <strong>{{$propertyData[0]->lease_expiry}}</strong></h6>
                                        </ficaption>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

				<!-------------- if Proprty leased ends ----------------------->

				<!-------------- If Id Proofs----------------------->
				<div class="row propert-identity-term">
					<div class="col-md-12 card-header">
					    <strong>Identity Proof</strong>
					</div>
					<div class="card-body">
						<div class="row">
						    <div class="col-md-6">
						        <h6>Owner Id Proof: <strong>
                                    @if($propertyData[0]->property_owner_id_drop == 1 ){{_('Aadhar Card')}}
                                    @elseif($propertyData[0]->property_owner_id_drop == 2 ) {{_('Driving License')}}
                                    @elseif($propertyData[0]->property_owner_id_drop == 3 ) {{_('Passport')}}
                                    @elseif($propertyData[0]->property_owner_id_drop == 4 )  {{_('Voter Id')}}
                                    @endif
                                    </strong>
                                </h6>
							</div>
						    <div class="col-md-6">
                                <h6>GST Number: <strong>{{$propertyData[0]->property_gst}}</strong></h6>
						    </div>
						</div>


						<div class="adhar-div">
						    <h6><strong>Identity Proof</strong></h6>
							<div class="proof-front" data-toggle="modal" data-target="#proof-front-modal">
							    <img src="{{url('')}}/{{ $propertyData[0]->property_owner_id_front }}" alt="proof front">
							</div>
							<div class="proof-back" data-toggle="modal" data-target="#proof-back-modal">
							    <img src="{{url('')}}/{{ $propertyData[0]->property_owner_id_back }}" alt="proof back">
							</div>
						</div>

                        @if($propertyData[0]->id_proof_is_same_address == 2)
                            <div class="adhar-div different-proof">
                                <h6>Identity proof with different address:
                                    <strong>@if($propertyData[0]->property_diff_address == 1) {{_('Electricity Bill')}}
                                        @elseif($propertyData[0]->property_diff_address == 2) {{_('Registration Document')}}
                                        @elseif($propertyData[0]->property_diff_address == 3) {{_('Water bill')}}
                                        @endif
                                    </strong>
                                </h6>
                                <div class="diff-proof" data-toggle="modal" data-target="#diff-proof-modal">
                                <img src="{{ url('')}}/{{$propertyData[0]->property_address_img}}" alt="">
                                </div>
                            </div>
                        @endif

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
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <strong>General Details (Property)</strong>
                    </div>
                    <div class="card-body">
                        <h6>Property Type: <strong>
                            @if($propertyData[0]->property_type == 1 ){{_('Flat')}}
                            @elseif($propertyData[0]->property_type == 2 ) {{_('PG')}}
                            @endif
                            </strong>
                        </h6>
                        <h6>Available for: <strong>
                            @if($propertyData[0]->property_available == 1 ){{_('Men')}}
                            @elseif($propertyData[0]->property_available == 2 ) {{_('Women')}}
                            @elseif($propertyData[0]->property_available == 3 ) {{_('Unisex')}}
                            @endif</strong>
                        </h6>

                        <h6>Furnishing: <strong>
                            @if($propertyData[0]->furnishing == 1 ){{_('Unfurnished')}}
                            @elseif($propertyData[0]->furnishing == 2 ) {{_('Semi Furnished')}}
                            @elseif($propertyData[0]->furnishing == 3 ) {{_('Fully Furnished')}}
                            @endif</strong>
                        </h6>

                        <h6>Owner Free: <strong>
                            @if($propertyData[0]->owner_free == 1 ){{_('Yes')}}
                            @elseif($propertyData[0]->owner_free == 2 ) {{_('No')}}
                            @endif</strong>
                        </h6>
                    </div>
                </div>
			</div>

			<div class="col-md-4">
			    <div class="card">
			        <div class="card-header pro-add">
				        <strong>Property Address Details</strong>
				    </div>
				    <div class="card-body">
					    <p style="font-weight:500">{{$propertyData[0]->address_house}} {{$propertyData[0]->address_building}} {{$propertyData[0]->address_street}} {{$propertyData[0]->sectorName}} {{$propertyData[0]->cityName}} {{$propertyData[0]->statesName}} {{$propertyData[0]->zipcode}}</p>
					    <div class="add-map">

					        <iframe src="https://maps.google.com/maps?q={{$propertyData[0]->lat}},{{$propertyData[0]->lng}}&z=8&output=embed&amp;key=AIzaSyB-A2cTCjqfq0h-GkAEQT4hCbvB2W7xRC8" width="300" height="150" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
						</div>
				    </div>
			    </div>
            </div>

			<div class="col-md-4">
			    <div class="card">
			        <div class="card-header">
				        <strong>Deals</strong>
				    </div>
				    <div class="card-body">
                        <p><strong>{{_('Offer:')}} {{$propertyData[0]->deals}} {{_('%')}}</strong></p>
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
					        <h6><strong>
                                @if($propertyData[0]->property_type == 1 ){{_('Flat Details')}}
                                @elseif($propertyData[0]->property_type == 2 ) {{_('PG Details')}}
                                @endif</strong>
                            </h6>


                            @foreach($propertyData->propertyDescription as $propertyDesc)
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6 style="margin:20px 0 10px">
                                            <strong>
                                                @if($propertyDesc->room_type == 1 ){{_('Single Room')}}
                                                @elseif($propertyDesc->room_type == 2 ) {{_('Double Room')}}
                                                @elseif($propertyDesc->room_type == 3 ) {{_('Triple Room')}}
                                                @elseif($propertyDesc->room_type == 4 ) {{_('Other Room')}}
                                                @elseif($propertyDesc->room_type == 5 ) {{_('1 RK')}}
                                                @elseif($propertyDesc->room_type == 6 ) {{_('1 BHK')}}
                                                @elseif($propertyDesc->room_type == 7 ) {{_('2 BHK')}}
                                                @elseif($propertyDesc->room_type == 8 ) {{_('Other Flat')}}
                                                @endif
                                            </strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Room description: <strong>{{$propertyDesc->description}}</strong></h6>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Quantity: <strong>{{$propertyDesc->quantity}}</strong></h6>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Rent/Month: <strong>{{$propertyDesc->rent}}</strong></h6>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Security Amount: <strong>{{$propertyDesc->security}}</strong></h6>
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
                        <h6>Food Inclusive: <strong>
                            @if($propertyData[0]->food_inclusive == 1 ){{_('Yes')}}
                            @elseif($propertyData[0]->food_inclusive == 2 ) {{_('No')}}
                            @endif
                            </strong>
                        </h6>

                        <h6>Electricity Inclusive: <strong>
                                @if($propertyData[0]->electricity_inclusive == 1 ){{_('Yes')}}
                                @elseif($propertyData[0]->electricity_inclusive == 2 ) {{_('No')}}
                                @endif</strong>
                        </h6>
                        @if($propertyData[0]->food_inclusive == 1 )
                        @elseif($propertyData[0]->food_inclusive == 2 )
                            <h6>Price per month: <strong>
                                {{$propertyData[0]->food_exclusive_rent}}
                            </strong>
                            </h6>
                        @endif

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
                        <h6><strong>Important Information</strong></h6>
                        @foreach($propertyData->additional as $additionalInfo)
                        <ul>
                            <li>{{$additionalInfo->additional_information}}</li>

                        </ul>
                        @endforeach
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
                            @foreach($propertyData->propertyImage as $propertyImg)
                                <li> <img src="{{url('')}}/{{ $propertyImg->image }}" alt=""></li>
                            @endforeach
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
				        <strong>Amenities</strong>
                    </div>

				    <div class="card-body amen-sec">
				        <div class="row">
                            @foreach($propertyData->amenities as $amenities)
                                <div class="col-md-2 col-sm-6 col-xs-12">
                                    <figure>
                                        <img src="{{url('')}}/{{ $amenities->image }}" alt="">
                                    </figure>
                                    <figcaption>
                                        <h6>{{$amenities->name}}</h6>
                                    </figcaption>
                                </div>
                            @endforeach

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
                        <figure data-toggle="modal" data-target="#digital-signatur-modal">
                            <img src="{{url('')}}/{{ $propertyData[0]->digital_signature }}" alt="digital Signature" width=300>
                        </figure>

				    </div>
			    </div>
			</div>
		</div>
<!--*****************digital-sign ends*****************-->

	</div>
</div>

<!--address modal-->
<div class="modal fade" id="addres-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       	<img src="{{ url('') }}/{{$propertyData[0]->lease_deed}}" alt="address proof">
      </div>
    </div>
  </div>
</div>

<!--proof-front-modal-->
<div class="modal fade" id="proof-front-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <img src="{{ url('')}}/{{ $propertyData[0]->property_owner_id_front }}" alt="proof front">
      </div>
    </div>
  </div>
</div>


<!--proof-back-modal-->
<div class="modal fade" id="proof-back-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="{{ url('')}}/{{ $propertyData[0]->property_owner_id_back }}" alt="proof back">
      </div>
    </div>
  </div>
</div>

<!--diff-proof-modal-->
<div class="modal fade" id="diff-proof-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="{{ url('')}}/{{ $propertyData[0]->property_address_img }}" alt="proof">
      </div>
    </div>
  </div>
</div>

<!--digital-signatur-modal-->
<div class="modal fade" id="digital-signatur-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <img src="{{url('')}}/{{ $propertyData[0]->digital_signature }}" alt="digital Signature" width=450>
      </div>
    </div>
  </div>
</div>


@endsection
