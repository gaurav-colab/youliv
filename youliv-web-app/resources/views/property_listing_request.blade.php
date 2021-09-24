@extends('layouts.addpropertylist')

@section('content')


<!--        get-yoliv section ends-->
	<section class="property_list_sec owner-property-sec1">
		<div class="container-fluid inner-container">
			
			<div class="row">
				<form method="post" id="ownerForm" enctype="multipart/form-data">
				@csrf
				<div class="col-lg-12 col-md-12 ">
					<div class="owner-form">
						<div class="heading_from">
						List Your Property at YouLivSpaces
						</div>
						<h2>General details(Owner)</h2>
						<div class="row">
							<div class="col-md-6">
								<div class="ower-name form-group">
									<label>Owner Name <b>*</b>
									</label>
									<input type="text" name="owner_name" id="owner_name" value="{{$owner->owner_name ?? ''}}" class="form-control" data-error="#errNm22">
									<span id="errNm22"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="ower-phone form-group">
									<label>Owner Number <b>*</b>
									</label>
									<input type="text" name="owner_number"  id="owner_number" class="form-control" value="{{$owner->owner_number ?? ''}}" data-error="#errNm23">
									<span id="errNm23"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="ower-name form-group">
									<label>Owner Alernate Number <b>*</b>
									</label>
									<input type="text" name="alernate_number"  id="alernate_number" class="form-control" data-error="#errNm24" value="{{$owner->alernate_number ?? ''}}">
									<span id="errNm24"></span>
								</div>
							</div>
						</div>
						<h2>Property Address Details</h2>
						<div class="row">
							<div class="col-md-6">
								<div class="ower-phone form-group">
									<label>House/Flat no <b>*</b>
									</label>
									<input class="form-control" type="text" name="address_house" id="address_house" placeholder="" value="" data-error="#errNm25">
									 @error('address_house')
										<div class="alert alert-danger">{{ $message }}</div>
									@enderror
									<span id="errNm25"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="ower-phone form-group">
									<label>Housing complex/Builing <b>*</b>
									</label>
									<input class="form-control" type="text" name="address_building" id="address_building" value="" data-error="#errNm26">
									@error('address_building')
										<div class="alert alert-danger">{{ $message }}</div>
									@enderror
									<span id="errNm26"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="ower-phone form-group">
									<label>Street <b>*</b>
									</label>
									<input class="form-control" name="address_street" id="address_street" value="" type="text" placeholder="" data-error="#errNm27">
									 @error('address_street')
										<div class="alert alert-danger">{{ $message }}</div>
									@enderror
									<span id="errNm27"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="ower-phone form-group">
									<label>State <b>*</b>
									</label>
									<select name="address_state" id="address_state" class="form-control" data-error="#errNm28">
										<option selected="true" disabled="disabled" value="">Please Select State</option>
										 @foreach($state as $states)
											<option value="{{$states->id}}" {{ old('address_state')== $states['id'] ? 'selected' : ''  }}>{{$states->name}}</option>
										@endforeach
									</select>
									@error('address_state')
										<div class="alert alert-danger">{{ $message }}</div>
									@enderror
									<span id="errNm28"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="ower-phone form-group">
									<label>City <b>*</b>
									</label>
									<select name="address_city" id="address_city" class="form-control" data-error="#errNm29">
										<option selected="true" disabled="disabled" value="">Please Select City</option>
										
									</select>
									  <input type="hidden" name="temp_city" id="temp_city" value="{{old('address_city')}}">

									@error('address_city')
										<div class="alert alert-danger">{{ $message }}</div>
									@enderror
									<span id="errNm29"></span>
							</div>
							</div>
							<div class="col-md-6">
								<div class="ower-phone form-group">
									<label>Sector <b>*</b>
									</label>
									<select name="address_sector" id="address_sector" class="form-control" data-error="#errNm30">
										<option selected="true" disabled="disabled" value="">Please Select Sector</option>										
									</select>
									 <input type="hidden" name="temp_sector" id="temp_sector" value="{{old('address_sector')}}">

									@error('address_sector')
										<div class="alert alert-danger">{{ $message }}</div>
									@enderror
									<span id="errNm30"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="zipCode- form-group">
									<label>ZipCode <b>*</b>
									</label>
									<input class="form-control" type="text" name="zipcode" placeholder="" value="" data-error="#errNm31"
									@error('zipcode')
										<div class="alert alert-danger">{{ $message }}</div>
									@enderror
									<span id="errNm31"></span>
								</div>
							</div>
						</div>
						<h2>General Details (Property)</h2>
						<div class="row">
							<div class="col-md-6">
								<div class="zipCode- form-group">
									<label>Property Title <b>*</b>
									</label>
									<input class="form-control" type="input" value="" name="property_title" data-error="#errNm32">
									<span id="errNm32"></span>
								</div>
							</div>
						
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="property-btn form-group">
									<label class="label">Property Type <b>*</b>
									</label>
									<div class="checkbox_pro">
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input property_type"  type="radio" value="1" name="property_type" data-error="#errNm33">
											<label class="form-check-label" for="flat">Flat</label>
										</div>
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-inpu property_type" type="radio" value="2" name="property_type" data-error="#errNm33">
											<label class="form-check-label" for="pg">PG</label>
										</div>
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input property_type"  type="radio" value="3" name="property_type" data-error="#errNm33">
											<label class="form-check-label" for="flat">Flat/ PG</label>
										</div>
										
									</div>
									<span id="errNm33"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="property-btn form-group">
									<label class="label">Available for 
									</label>
									<br>
									<div class="checkbox_pro">
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" type="checkbox" name="property_available_men">
											<label class="form-check-label" for="male">Men</label>
										</div>
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" type="checkbox" name="property_available_women" >
											<label class="form-check-label" for="female">Women</label>
										</div>
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" type="checkbox" name="property_available_unisex">
											<label class="form-check-label" for="female">Unisex</label>
										</div>
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" type="checkbox" name="property_available_family">
											<label class="form-check-label" for="family">Family</label>
										</div>
									</div>	
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="property-btn form-group">
									<label class="label">Furnishing
									</label>
									<br>
									<div class="checkbox_pro">
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" type="radio" value="1" name="furnishing">
											<label class="form-check-label" for="furnished">Unfurnished</label>
										</div>
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" type="radio" value="2" name="furnishing">
											<label class="form-check-label" for="sfurnished">Semi Furnished</label>
										</div>
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" type="radio" value="3" name="furnishing" checked="checked">
											<label class="form-check-label" for="ffurnished">Fully Furnished</label>
										</div>
									</div>	
								</div>
							</div>
							<div class="col-md-6 ">
								<div class="property-btn form-group">
									<label class="label">Owner Free 
									</label>
									<br>
									<div class="checkbox_pro">
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" type="radio" value="1" name="owner_free">
											<label class="form-check-label" for="yes">Yes</label>
										</div>
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" type="radio" value="2" name="owner_free" checked="checked">
											<label class="form-check-label" for="no">No</label>
										</div>
									</div>	
								</div>
							</div>
						</div>
						<div class="row">
						<div class="col-md-6">
								<div class="property-btn form-group">
									<label class="label">Electricity Inclusive
									</label>
									<br>
									<div class="checkbox_pro">
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" type="radio" value="1" name="electricity_inclusive" checked="checked">
											<label class="form-check-label" for="yes">Yes</label>
										</div>
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" type="radio" value="2" name="electricity_inclusive">
											<label class="form-check-label" for="no">No</label>
										</div>
									</div>	
								</div>
							</div>
						<div class="col-md-6">
							
								<div class="property-btn form-group">
									<label class="label">Food Inclusive 
									</label>
									<br>
									<div class="checkbox_pro">
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" id="hide" type="radio" value="1" name="food_inclusive" checked="checked">
											<label class="form-check-label" for="yes">Yes</label>
										</div>
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" id="show" type="radio" value="2" name="food_inclusive">
											<label class="form-check-label" for="no">No</label>
										</div>
									</div>	
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-6 ">
								<div class="property-btn form-group">
									<label class="label">Water Inclusive 
									</label>
									<br>
									<div class="checkbox_pro">
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" id="hide" type="radio" value="1" name="water_inclusive" checked="checked">
											<label class="form-check-label" for="yes">Yes</label>
										</div>
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" id="show" type="radio" value="2" name="water_inclusive">
											<label class="form-check-label" for="no">No</label>
										</div>
									</div>	
								</div>
							</div>
							
							<div class="col-md-6 ">
								<div class=" prvd-food food_exclusive">
									<label for="food_exclusive">
									<input value="1" name="room7" type="checkbox" id="food_exclusive" class="mr-1"> Do you provide food in addition?</label>
								</div>
								<div class=" form-group prvd-food yes_food_exclusiv" id="room7" value="Do thing" hidden>
								<label for="food_exclusive_price" class="label">Price per month(Food)</label>
								<input class="form-control" type="number" name="food_exclusive_price" placeholder="" min="1">
								</div>
							
							</div>
						</div>
						<div class="row">
						
						
						</div>
									
						
						<div class="row">
							
							<div class="col-md-6">
								<div class="dropdown add-list form-group">		
								<div class="flat-body-select">	
								<label for="total_room_for_rent" >Property Description</label>								
									<button class="btn btn-secondary dropdown-toggle form-control" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select Flat Type</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="width:100%">
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" data-target="nine" type="checkbox" value="one_room" name="flat_type[]" id="nine" onclick="roomTypeCheckbox(this, 'show_1_room')" />
											<label class="form-check-label" for="family">1 Room</label>
										</div>										
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" data-target="rooms2" type="checkbox" value="two_room" name="flat_type[]" id="ten" onclick="roomTypeCheckbox(this, 'show_2_room')" />
											<label class="form-check-label" for="family">2 Room</label>
										</div>										
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" type="checkbox" value="three_room" name="flat_type[]"  id="thirteen" onclick="roomTypeCheckbox(this, 'show_3_room')" />
											<label class="form-check-label" for="family">3 Room</label>
										</div>										
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" type="checkbox" value="one_rk" name="flat_type[]"  id="first" onclick="roomTypeCheckbox(this, 'show_1_rk')" />
											<label class="form-check-label" for="family">1 RK</label>
										</div>										
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" value="one_bhk" name="flat_type[]" type="checkbox" id="second" onclick="roomTypeCheckbox(this, 'show_1_bhk')" />
											<label class="form-check-label" for="family">1 BHK</label>
										</div>										
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" value="two_bhk" name="flat_type[]" type="checkbox" id="seventh" onclick="roomTypeCheckbox(this, 'show_2_bhk')" />
											<label class="form-check-label" for="family">2 BHK</label>
										</div>										
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" value="three_bhk" name="flat_type[]" type="checkbox" id="fourtine" onclick="roomTypeCheckbox(this, 'show_3_bhk')" />
											<label class="form-check-label" for="family">3 BHK</label>
										</div>
										
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" value="four_bhk" name="flat_type[]" type="checkbox" id="fifteen" onclick="roomTypeCheckbox(this, 'show_4_bhk')" />
											<label class="form-check-label" for="family">4 BHK</label>
										</div>										
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" value="flat_other" name="flat_type[]" type="checkbox" id="eight" onclick="roomTypeCheckbox(this, 'flat_other')" />
											<label class="form-check-label" for="family">OTHER</label>
										</div>
									</div>
									</div>
									<div class="pg-body-select">
									<label for="total_room_for_rent" >Property Description</label>										
									<button class="btn btn-secondary dropdown-toggle form-control" type="button" id="dropdownMenuButtonRoom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select PG Type</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButtonRoom" x-placement="bottom-start" style="width:100%">
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" value="single_sharing" name="room_type[]" type="checkbox" id="third" onclick="roomTypeCheckbox(this, 'show_ssr')" />
											<label class="form-check-label" for="third">Single Sharing Rooms</label>
										</div>
										
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input"value="twin_sharing" name="room_type[]" type="checkbox" id="fourth" onclick="roomTypeCheckbox(this, 'show_tsr')" />
											<label class="form-check-label" for="fourth">Twin Sharing Rooms</label>
										</div>										
										
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" value="triple_sharing" name="room_type[]" type="checkbox" id="fifth" onclick="roomTypeCheckbox(this, 'show_trsr')"  />
											<label class="form-check-label" for="fifth">Tripple Sharing Rooms</label>
										</div>
										<div class="form-check form-check-inline mr-1">
											<input class="form-check-input" value="others" name="room_type[]" type="checkbox" id="sixth" onclick="roomTypeCheckbox(this, 'show_other')" />
											<label class="form-check-label" for="sixth">OTHER</label>
										</div>
									</div>
									</div>
								</div>
								
							</div>
							<div class="col-md-6">
								<div class="form-group room_for_rent ">
									<label for="total_room_for_rent" >Total Number of Rooms for Rent</label>
									<input class="form-control" type="number" name="total_room_for_rent" placeholder=" " min="1">
								</div>
								<div class="form-group bed_for_rent ">
									<label for="total_bed_for_rent" >Total Number of bed for Rent</label>
									<input class="form-control" type="number" name="total_bed_for_rent" placeholder="" min="1" >
								</div>
							</div>
						</div>
						<div class="room1 hide_div show_ssr" id="actions" value="Do thing" >
							<label for="">Single Sharing Rooms</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<textarea class="form-control" name="single_sharing_description" id="single_room_description"  placeholder="Room description"></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="single_room_quantity" id="single_room_quantity" placeholder="Quantity" min="1" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="single_room_rent" id="single_room_rent" placeholder="Rent/Month" min="1" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="single_room_security" id="single_room_security" placeholder="Security Amount" min="1" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="room1 hide_div show_tsr" id="actions" value="Do thing" >
							<label for="">Twin Sharing Rooms</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<textarea class="form-control" name="twin_sharing_description" id="twin_room_description"  placeholder="Room description"></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="twin_room_quantity" id="twin_room_quantity" placeholder="Quantity" min="1" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="twin_room_rent" id="twin_room_rent" placeholder="Rent/Month" min="1" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="twin_room_security" id="twin_room_security" placeholder="Security Amount" min="1" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="room1 hide_div show_trsr" id="actions" value="Do thing" >
							<label for="">Tripple Sharing Rooms</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<textarea class="form-control" name="triple_sharing_description" id="triple_room_description"  placeholder="Room description"></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="triple_room_quantity" id="triple_room_quantity" placeholder="Quantity" min="1" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="triple_room_rent" id="triple_room_rent" placeholder="Rent/Month" min="1" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="triple_room_security" id="triple_room_security" placeholder="Security Amount" min="1" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="room1 hide_div show_other" id="actions" value="Do thing" >
							<label for="">Others</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<textarea class="form-control" name="other_room_description" id="other_room_description"  placeholder="Room description"></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="other_room_quantity" id="other_room_quantity" placeholder="Quantity" min="1" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="other_room_rent" id="other_room_rent" placeholder="Rent/Month" min="1" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="other_room_security" id="other_room_security" placeholder="Security Amount" min="1" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="room1 hide_div show_1_room" id="actions" value="Do thing" >
							<label for="">One Room 	</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<textarea class="form-control" name="one_room_description" id="one_room_description"  placeholder="Room description"></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="one_room_quantity" id="one_room_quantity"placeholder="Quantity" min="1" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="one_room_rent" id="one_room_rent" placeholder="Rent/Month" min="1" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="one_room_security" id="one_room_security" placeholder="Security Amount" min="1" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="room2 hide_div show_2_room" id="room2" value="Do thing" >
							<label for="">Two Room 
							</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<textarea class="form-control" name="two_room_description" id="two_room_description" placeholder="Room description"></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="two_room_quantity" id="two_room_quantity" placeholder="Quantity" min="1" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="two_room_rent" id="two_room_rent" placeholder="Rent/Month" min="1" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="two_room_security" id="two_room_security" placeholder="Security Amount" min="1" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="room2 hide_div show_3_room" id="room3" value="Do thing" >
							<label for="">Three Room 
							</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<textarea class="form-control" name="three_room_description" id="three_room_description" placeholder="Room description"></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="three_room_quantity" id="three_room_quantity" placeholder="Quantity" min="1" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="three_room_rent" id="three_room_rent" placeholder="Rent/Month" min="1" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="three_room_security" id="three_room_security"placeholder="Security Amount" min="1" value="">
									</div>
								</div>
							</div>
						</div>
						
						<div class="room2 hide_div show_1_rk" id="room4" value="Do thing" >
							<label for="">One RK 
							</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<textarea class="form-control" name="one_rk_description" id="one_rk_description" placeholder="Room description"></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="one_rk_quantity" id="one_rk_quantity" placeholder="Quantity" min="1" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="one_rk_rent" id="one_rk_rent" placeholder="Rent/Month" min="1" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="number" name="one_rk_security" id="one_rk_security" placeholder="Security Amount" min="1" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="room2 hide_div show_1_bhk" id="room5" value="Do thing" >
							<label for="">One BHK 
							</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<textarea class="form-control" name="one_bhk_description" id="one_bhk_description" placeholder="Room description"></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" id="one_bhk_quantity" type="number" name="one_bhk_quantity"  placeholder="Quantity" min="1" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" id="one_bhk_rent" type="number" name="one_bhk_rent" placeholder="Rent/Month" min="1" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" id="one_bhk_security" type="number" name="one_bhk_security" placeholder="Security Amount" min="1" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="room2 hide_div show_2_bhk" id="room6" value="Do thing" >
							<label for="">Two BHK 
							</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<textarea class="form-control" name="two_bhk_description" id="two_bhk_description" placeholder="Room description"></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" id="two_bhk_quantity" type="number" name="two_bhk_quantity"  placeholder="Quantity" min="1" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" id="two_bhk_rent" type="number" name="two_bhk_rent" placeholder="Rent/Month" min="1" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" id="two_bhk_security" type="number" name="two_bhk_security" placeholder="Security Amount" min="1" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="room2 hide_div show_3_bhk" id="room7" value="Do thing">
							<label for="">Three BHK 
							</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<textarea class="form-control" name="three_bhk_description" id="three_bhk_description" placeholder="Room description"></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" id="three_bhk_quantity" type="number" name="three_bhk_quantity"  placeholder="Quantity" min="1" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" id="three_bhk_rent" type="number" name="three_bhk_rent" placeholder="Rent/Month" min="1" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" id="three_bhk_security" type="number" name="three_bhk_security" placeholder="Security Amount" min="1" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="room2 hide_div show_4_bhk" id="room8" value="Do thing">
							<label for="">Four BHK 
							</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<textarea class="form-control" name="four_bhk_description" id="four_bhk_description" placeholder="Room description"></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" id="four_bhk_quantity" type="number" name="four_bhk_quantity"  placeholder="Quantity" min="1" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" id="four_bhk_rent" type="number" name="four_bhk_rent" placeholder="Rent/Month" min="1" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" id="four_bhk_security" type="number" name="four_bhk_security" placeholder="Security Amount" min="1" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="room2 hide_div flat_other" id="room9" value="Do thing">
							<label for="">Other 
							</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<textarea class="form-control" name="other_flat_rent" id="other_flat_rent" placeholder="Room description"></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" id="other_flat_rent" type="number" name="other_flat_rent"  placeholder="Quantity" min="1" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" id="other_bhk_rent" type="number" name="other_bhk_rent" placeholder="Rent/Month" min="1" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" id="other_bhk_security" type="number" name="other_bhk_security" placeholder="Security Amount" min="1" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label >About Property<b>*</b>
									</label>
									<br>
									<div class=" mr-1">
										<textarea class="form-control proprty" data-error="#errNm34" name="property_about"></textarea>
										<span id="errNm34"></span>
									</div>
								</div>
							</div>
						</div>
						<h2>Property Neighbourhood Detail</h2>
						<div class="room2">
							<label for="">Area/Distance
							</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="text" name="area1" placeholder="" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="text" name="distance1" placeholder="" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="room2 ">
							<label for="">Area/Distance
							</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="text" name="area2" placeholder="" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="text" name="distance2" placeholder="" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="room2 ">
							<label for="">Area/Distance
							</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="text" name="area3" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="text" name="distance3" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="room2 ">
							<label for="">Area/Distance
							</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="text" name="area4"  value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="text" name="distance4" value="">
									</div>
								</div>
							</div>
						</div>
						<h2>Property Owned / Property Leased</h2>
						<div class="row">
							

								<div class="col-sm-4">
									<label >Property Owned / Property Leased 
									</label>
									<br>
									<div class="checkbox_pro">
									<div class="form-check form-check-inline mr-1">
									<input class="property_owned" id="property_owned" type="radio" value="1" name="property_owned" checked="checked">
									<label for="property_owned">Yes</label>
									</div>
									<div class="form-check form-check-inline mr-1">
									<input class="property_owned" id="property_owned1" type="radio" value="2" name="property_owned">
									<label for="property_owned">No</label>
									</div>
									</div>
								</div>	
								<div class="col-sm-8">
								
									<div class="prperty-owned">
									<div class="form-group property_address_docs " >

										<label>Identity proof with same address </label>
										<br>
										<div class="checkbox_pro">
											<div class="form-check form-check-inline mr-1">
												<input class="form-check-input id_proof_address" id="hide2" type="radio" value="1" name="id_proof_address">
												<label class="form-check-label" for="id_proof_address">Yes</label>
											</div>
											<div class="form-check form-check-inline mr-1">
												<input class="form-check-input id_proof_address" id="show2" type="radio" value="2" name="id_proof_address" />
												<label class="form-check-label" for="id_proof_address">No
											</div>
										</div>	
										
									</div>

									</div>
								</div>
								</div>
								<div class="row">
								<div class="col-md-12">
									<div class="propert-lease-term">
										<h2>Property Leased Details</h2>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Duration 
													</label>
													<input class="form-control" type="number" name="lease_duration" placeholder="Ex. 2" min="0" value="">
												</div>
												<div class="form-group">
													<label>Expiry of Lease 
													</label>
													<input class="form-control" id="lease_expiry" type="date" name="lease_expiry" value="" min="2020-11-27">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Unit 
													</label>
													<select name="lease_unit" id="lease_unit" class="form-control">
														<option selected="true" disabled="disabled">Select Unit</option>
														<option value="1">Month</option>
														<option value="2">Year</option>
													</select>
												</div>
												<div class="form-group">
													<label>Upload lease deed <span class="upld"> (Taken as address proof)</span>
													</label>
													<input class="form-control" id="lease_deed" type="file" name="lease_deed" placeholder="Enter Lease Term" value="">
												</div>
											</div>
										</div>
									</div>
								</div>
								</div>								
									<div class=" property_with_diff_add ">
										<div class="row ph2">
											<div class="col-md-6">
												<div class="form-group">
													<label for="property_diff_address" >Identity proof with different address 
													</label>
													<select class="form-control" name="property_diff_address">
														<option selected="true" disabled="disabled">Select Address Proof</option>
														<option value="1">Electricity Bill (not older than last three months)</option>
														<option value="2">Registration Document</option>
														<option value="3">Water bill (Not older than last three months)</option>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="property_address_img" >Address Identity proof document 
													</label>
													<input class="form-control" type="file" name="property_address_img" placeholder="">
												</div>
											</div>
										</div>
									</div>
									<h2>Amenities </h2>
									<div class="form-group row">
										@foreach($amenity as $amenties)
                                                <div class="col-md-3">
                                                    <label for="amenities_first_{{$amenties->id}}">
                                                        <input value="{{$amenties->id}}" name="amenities[]" type="checkbox" id="amenities_first_{{$amenties->id}}" class="mr-2  amenities_pro">{{$amenties->name}}
                                                    </label>
                                                </div>
                                            @endforeach	
										
										<div class="col-md-3">
											<label for="amenities_others">
												<input value="1" name="amenities_others" type="checkbox" class="mr-2 amenties amenities_pro">Others</label>
										</div>
										<div class="col-md-12">
										<div class="text-boxright">
											<label for="amenities_others">
												<input style="display:none"  name="amenities_others_text" type="input" id="amenities_others_text" class="mr-2">
											</label>
											</div>
										</div>
									</div>
									<!--
									<h2>Upload Pictures</h2>
									<div class="row">
										<div class="col-md-6">
											<div class="upload-img">
												<button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
												<div style="display:none">
													<input id="files"  name="files" accept="image/*" class="file-upload-input" type="file" multiple/>
												</div>													
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
												<output id="result" />			
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="upload-img">												
												<button type="button" id="clear">Clear</button>	
											</div>
										</div>
									</div>-->
									<div class="row">
										<div class="col-md-6">
											<button type="submit" class="btn logform-btn"><span>Send Request</span></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
		</div>
	</section>


@include('footer')
<script type="text/javascript">

        $('.room_for_rent').hide();
        $('.bed_for_rent').hide();
        $('.pg-body-select').hide();
        $('.flat-body-select').hide();
        $('.yes_food_exclusive').hide();
		$('.food_exclusive').hide();
		$('.propert-lease-term').hide();
       
        $('.property_with_diff_add').hide();
		
		  $('.property_type').on('change', function() {

            if($('input[name=property_type]:checked').val() == 2){
                $('.room_for_rent').hide();
                $('.flat-body-select').hide();
                $('.bed_for_rent').show(500);
                $('.pg-body-select').show(500);


            }else{
                $('.room_for_rent').show(500);
                $('.flat-body-select').show(500);
                $('.bed_for_rent').hide();
                $('.pg-body-select').hide();

            }
        });
		
	$("[name='payment']").on("change", function() {
		      var selector = $(this).data("target");
		      $(".payment-type").slideUp();
		      $(selector).slideDown();
		    });

	function roomTypeCheckbox(cbox, show_div_class) {
        if (cbox.checked) {
            $('.' + show_div_class).removeClass('hide_div');
        } else {
            $('.' + show_div_class).addClass('hide_div');
        }
    }

	$('.property_owned').on('change', function() {
            if($('input[name=property_owned]:checked').val() == 2){
				
                $('.propert-lease-term').show(500);
                $('.property_address_docs').hide(500);
                $('.property_with_diff_add').hide(500);
				$('.id_proof_address').at
				$('.id_proof_address').prop('checked', false);

            }else{
				
                $('.propert-lease-term').hide(500);
                $('.property_address_docs').show(500);
            }
			
			$('#property_owned_button').show();

        });

    $(function() {

     

        //Property Type check on load

      

        $('.id_proof_address').on('change', function() {
            if($('input[name=id_proof_address]:checked').val() == 2){
                $('.property_with_diff_add').show(500);
            }else{
                $('.property_with_diff_add').hide(500);
            }
        });

      

        $('.food_exclusive').hide();

        $('input#food_inclusive').on('change', function() {

          if($('input[name=food_inclusive]:checked').val() == 2){
              $('.food_exclusive').show(500);
            }else{
                $('.food_exclusive').hide(500);
                $('.yes_food_exclusive').hide(500);
                $("#food_exclusive").prop("checked", false);

            }
        });

        $("#owner_name").keyup(function(e) {

            var regex = /^[a-zA-Z\s@]+$/;
            if (regex.test(this.value) !== true)
                this.value = this.value.replace(/[^a-zA-Z\s@]+/, '');
        });

    });





    $(document).on('click', '.remove_image', function() {
        var name = $(this).attr('id');
        $.ajax({
            url: "{{ route('admin.property.delete') }}",
            data: {
                name: name
            },
            success: function(data) {
                load_images();
            }
        })
    });

    $(function(){
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;

        $('#lease_expiry').attr('min', maxDate);
    });

		
	</script>
	<script>
		function readURL(input) {
		  if (input.files && input.files[0]) {
		
		    var reader = new FileReader();
		
		    reader.onload = function(e) {
		      $('.image-upload-wrap').hide();
		
		      $('.file-upload-image').attr('src', e.target.result);
		      $('.file-upload-content').show();
		
		      $('.image-title').html(input.files[0].name);
		    };
		
		    reader.readAsDataURL(input.files[0]);
		
		  } else {
		    removeUpload();
		  }
		}
		
		function removeUpload() {
		  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
		  $('.file-upload-content').hide();
		  $('.image-upload-wrap').show();
		}
		$('.image-upload-wrap').bind('dragover', function () {
				$('.image-upload-wrap').addClass('image-dropping');
			});
			$('.image-upload-wrap').bind('dragleave', function () {
				$('.image-upload-wrap').removeClass('image-dropping');
		});
	</script>
	
	<script>
		function show1(){
	document.getElementById('div1').style.display ='none';
	}
	function show2(){
	document.getElementById('div1').style.display = 'block';
	}
	</script>
	<script>
		$(document).ready(function(){
	  $("#hide").click(function(){
	    $(".prvd-food").hide();
	  });
	  $("#show").click(function(){
	    $(".prvd-food").show();
	  });
	});
	</script>


<script>
	$(document).ready(function(){
	  $("#hide2").click(function(){
		$(".ph2").hide();
	  });
	  $("#show2").click(function(){
		$(".ph2").show();
	  });
	
	  $("#rb-phone").click(function(){
		$(".property_address_docs ").hide();
	  });
	  $("#rb-email").click(function(){
		$(".property_address_docs ").show();
	  });
	  
	  function getCity(stateId, city){
        if(stateId == ''){
            //$('#address_state').val();
        }else{
            $.ajax({
                type: "get",
                url: "getCity/" + stateId,
                success: function(res) {
                    $("#address_city").empty();
                    $("#address_sector").empty();
                    $("#address_city").append('<option selected="true" value="" disabled="disabled">Please Select City</option>');
                    $("#address_sector").append('<option selected="true" value="" disabled="disabled">Please Select Sector</option>');
                    $.each(res, function(key, value) {

                        $("#address_city").append('<option value="' + value.id + '">' + value.name + '</option>');

                    });

                    $("#address_city").val(city);
                }
            })
        }
    }

    function getSector(cityId,sector){

        if(cityId != ''){
            $.ajax({
                type: "get",
                url: "getSector/" + cityId,
                success: function(res) {
                    $("#address_sector").empty();
                    $("#address_sector").append('<option selected="true"  value="" disabled="disabled">Please Select Sector</option>');

                    $.each(res, function(key, value) {

                        $("#address_sector").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });

                   $("#address_sector").val(sector);
                }
            })
        }
    }
	
	$(document).on('click', '.amenties', function() {
		
		if($('.amenties').is(':checked'))
		{
			$('#amenities_others_text').show();
		}
		else
		{
			$('#amenities_others_text').hide();
			$('#amenities_others_text').val('');
		}
	});


    $("#address_state").change(function() {
        stateId = $('#address_state option:selected').val();
        getCity(stateId,'');

    });
    stateId = $('#address_state option:selected').val();
    city    = $('#temp_city').val();
    sector  = $('#temp_sector').val();

    getCity(stateId,city);
    getSector(city,sector);


    $("#address_city").change(function() {
        cityId = $('#address_city option:selected').val();
        getSector(cityId,'');
    });
	  
	  $('input[name="food_addition"]').click(function(){
        if($(this).prop("checked") == true){

            $('.yes_food_exclusive').show(500);
        }else{

            $('.yes_food_exclusive').hide(500);
        }
    });
	window.onload = function(){
	//Check File API support
	if(window.File && window.FileList && window.FileReader)
	{
		$('#files').on("change", function(event) {
		var files = event.target.files; //FileList object
		var output = document.getElementById("result");
		for(var i = 0; i< files.length; i++)
		{
		var file = files[i];
		//Only pics
		// if(!file.type.match('image'))
		if(file.type.match('image.*')){
		if(this.files[0].size < 2097152){
		// continue;
		var picReader = new FileReader();
		picReader.addEventListener("load",function(event){
		var picFile = event.target;
		var div = document.createElement("div");
		div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
		"title='preview image'/>";
		output.insertBefore(div,null);
		});
		//Read the image
		$('#clear, #result').show();
		picReader.readAsDataURL(file);
		}else{
		alert("Image Size is too big. Minimum size is 2MB.");
		$(this).val("");
		}
		}else{
		alert("You can only upload image file.");
		$(this).val("");
		}
		}

		});
		}
		else
		{
		console.log("Your browser does not support File API");
		}
	}

		$('#files').on('click', function() {
		$('.thumbnail').parent().remove();
		$('#result').hide();
		$(this).val("");
		});

		$('#clear').on("click", function() {
		$('.thumbnail').parent().remove();
		$('#result').hide();
		$('#files').val("");
		$(this).hide();
		});
	if($("#owner_name").val()!="")
	{
		$("#owner_name").prop("readonly",true);
		$("#owner_number").prop("readonly",true);
		$("#alernate_number").prop("readonly",true);
	}
    $("#pac-input").keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
	  
	});
	
	$('#ownerForm').validate({
	  errorElement: 'div',
		
	 errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    },

	  rules: {
		'owner_name':{
		  required : true,		  
		},
		'owner_number':{
		  required : true,	
		  number:true,
		  minlength:10,
		  maxlength:12		  
		},
		'alernate_number':{
		  required : true,	
		  number:true,
		  minlength:10,
		  maxlength:12		  
		},
		'address_house':{
		  required : true,		  
		},
		'address_building':{
		  required : true,		  
		},
		'address_street':{
		  required : true,		  
		},
		'address_state':{
		  required : true,		  
		},
		'address_city':{
		  required : true,		  
		},
		'address_sector':{
		  required : true,		  
		},
		'zipcode':{
		  required : true,		  
		},
		'property_title':{
		  required : true,		  
		},
		'property_type':{
		  required : true,		  
		},
		'property_about':{
		  required : true,		  
		}
		
	  },
	});  

	</script> 
@endsection
