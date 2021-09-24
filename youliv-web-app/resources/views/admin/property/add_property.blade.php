@extends('admin.dashboard.base')

@section('content')
<style>
.btn-link.disabled, .btn-link:disabled{color: #0075dd!important;}
.btn.disabled, .btn:disabled {
    opacity: 1!important;
}
</style>

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">
    <div class="fade-in">
        <div class="bs-example">
            <div class="accordion" id="accordionExample">
            <!-- /Start General Owner Details-->
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button type="button"  id="owner_div" style="float:left;" class="btn btn-link collapsed text-left" data-toggle="collapse" data-target="#collapseOne"><i class="fa fa-angle-right"></i>General details(Owner)<span class="col-md-4" id="required_owner_contact"></span></button>
                            <div class="text-right" id="ownerFormMsg" style="display:none;"> <img src="https://www.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png" width="20px"></div>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <form class="form-horizontal" id="ownerForm" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group row">
									<div class="col-md-4">
                                            <label for="owner_number" class="label">Owner Contact Number</label>
                                            <span class="required">*</span>
                                            <select id="owner_Id" name="owner_Id" class="form-control">
											<option selected="true" disabled="disabled">Select owner</option>
											@foreach ($owners_list as $key=>$value)
												<option value="{{$value['id']}}">{{$value['name']}}</option>
											@endforeach	
											</select>
                                            @error('owner_number')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
											
                                      </div>
									   <div class="col-md-12 mt-3">
											<button id="submit-all" class="btn btn-primary-custom" type="submit">Submit</button>
											<button disabled type="button"  id="headingTwoclick" class="btn btn-primary-custom" data-toggle="collapse" data-target="#collapseTwo">Next</button>
										</div>
									
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <input type="hidden" name="ownerId" id="ownerId" value="">
                    <!-- /End General Owner Details-->
					
                    <!-- /Start Area Manger Details-->
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button disabled="disabled" type="button" style="float:left" id="headingTwoclick1" class="btn btn-link text-left" data-toggle="collapse" data-target="#collapseTwo"><i class="fa fa-angle-right"></i>Area Manager</button>
                                    <div class="text-right" id="areaManagerFormMsg" style="display:none;"> <img src="https://www.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png" width="20px"></div>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <form class="form-horizontal" id="areaManagerForm" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <input type="hidden" name="propertyId" id="propertyId" value="">
                                        <div class="form-group row">

                                            <div class="col-md-4">
                                                <label for="area_manager_id" class="label">Name</label>
                                                <span class="required">*</span><span class="col-md-4" id="required_area_manager"></span>
                                                <select class="form-control" id="area_manager_id" name="area_manager_id" disabled>
                                                    <option selected="true" disabled="disabled">Select area manager</option>
                                                    @foreach ($area_managers as $manager)
                                                        <option value="{{$manager['id']}}" {{ old('area_manager_id')== $manager['id'] ? 'selected' : ''  }}>{{$manager['name']}}</option>
                                                    @endforeach
                                                </select>

                                                @error('area_manager_id')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <label for="area_manager_phone" class="label">Phone number</label>
                                                <span class="required">*</span>
                                                <input class="form-control" readonly id="area_manager_phone" type="text" name="area_manager_phone" placeholder="Enter Phone Number" value="{{old('area_manager_phone')}}">

                                                @error('area_manager_phone')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <label for="area_manager_name" class="label">Deals</label>
                                                <span class="required">*</span>
                                                <input class="form-control" id="deals" readonly type="text" name="deals" placeholder="Enter deal" value="25">
                                                @error('deals')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-12 mt-3">												
                                                <button id="submit-all" class="btn btn-primary-custom" type="submit">Submit</button>
												<button disabled type="button"  id="headingFiveclick" class="btn btn-primary-custom" data-toggle="collapse" data-target="#collapseFive">Next</button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <!-- /End Area Manger Details-->
					<!-------Property Address-------->
                        <div class="card">
                            <div class="card-header" id="headingFive">
                                <h2 class="mb-0">
                                    <button type="button" disabled id="headingFiveclick1" style="float:left;" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive"><i class="fa fa-angle-right"></i>Property Address Details</button>
                                    <div class="text-right" id="propertyAddressFormMsg" style="display:none;"> <img src="https://www.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png" width="20px"></div>
                                </h2>
                            </div>
                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                <div class="card-body">
                                    <form class="form-horizontal" id="propertyAddressForm" enctype="multipart/form-data" method="POST">
                                        @csrf

                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="address_house" class="label">House/Flat no</label>
                                                <span class="required">*</span>
                                                <input class="form-control" id="address_house" type="text" name="address_house" placeholder="House/Flat no" value="{{old('address_house')}}">

                                                @error('address_house')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                            </div>

                                            <div class="col-md-4">
                                                <label for="address_building" class="label">Housing complex/Builing</label>
                                                <span class="required">*</span>
                                                <input class="form-control" id="address_building" type="text" name="address_building" placeholder="Building" value="{{old('address_building')}}">

                                                @error('address_building')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                            </div>

                                            <div class="col-md-4">
                                                <label for="address_street" class="label">Street</label>
                                                <span class="required">*</span>
                                                <input class="form-control" id="address_street" type="text" name="address_street" placeholder="Street no" value="{{old('address_street')}}">

                                                @error('address_street')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                            </div>


                                            <div class="col-md-4 mt-3">
                                                <label for="address_state" class="label">State</label>
                                                <span class="required">*</span>
                                                <select name="address_state" id="address_state" class="form-control">
                                                    <option selected="true" disabled="disabled" value="">Please Select State</option>
                                                    @foreach($state as $states)
                                                        <option value="{{$states->id}}" {{ old('address_state')== $states['id'] ? 'selected' : ''  }}>{{$states->name}}</option>
                                                    @endforeach

                                                </select>

                                                @error('address_state')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <label for="address_city" class="label">City</label>
                                                <span class="required">*</span>
                                                <select name="address_city" id="address_city" class="form-control">
                                                    <option selected="true" disabled="disabled" value="">Please Select City</option>
                                                </select>

                                                <input type="hidden" name="temp_city" id="temp_city" value="{{old('address_city')}}">

                                                @error('address_city')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <label for="address_sector" class="label">Sector</label>
                                                <span class="required">*</span>
                                                <select name="address_sector" id="address_sector" class="form-control">
                                                    <option selected="true" disabled="disabled"  value="">Please Select Sector</option>

                                                </select>
                                                <input type="hidden" name="temp_sector" id="temp_sector" value="{{old('address_sector')}}">

                                                @error('address_sector')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <label for="zipcode" class="label">ZipCode</label>
                                                <span class="required">*</span>
                                                <input class="form-control" id="zipcode" type="text" name="zipcode" placeholder="Pincode" value="{{old('zipcode')}}">

                                                @error('zipcode')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                            </div>
                                            <input type="hidden" name="property_lat" id="lat" value="">
                                            <input type="hidden" name="property_lng" id="lng" value="">

                                        </div>
                                        <!-------Property Address Map-------->
                                        <div class="pac-card" id="pac-card">
                                            <div>
                                                <div id="title">
                                                    Search address
                                                </div>
                                                <div id="type-selector" class="pac-controls">
                                                    <input type="radio" name="type" id="changetype-all" checked="checked">
                                                    <label for="changetype-all">All</label>

                                                    <input type="radio" name="type" id="changetype-establishment">
                                                    <label for="changetype-establishment">Establishments</label>

                                                    <input type="radio" name="type" id="changetype-address">
                                                    <label for="changetype-address">Addresses</label>

                                                    <input type="radio" name="type" id="changetype-geocode">
                                                    <label for="changetype-geocode">Geocodes</label>
                                                </div>
                                                <div id="strict-bounds-selector" class="pac-controls">
                                                    <input type="checkbox" id="use-strict-bounds" value="">
                                                    <label for="use-strict-bounds">Strict Bounds</label>
                                                </div>
                                            </div>
                                            <div id="pac-container">
                                                <input id="pac-input" type="text" name="geo_location"
                                                    placeholder="Enter a location">
                                            </div>
                                            @error('property_lat')
                                                <div class="alert alert-danger">{{ _('The address field in map is required') }}</div>
                                            @enderror
                                        </div>
                                        <div id="map"></div>
                                        <div id="infowindow-content">
                                            <img src="" width="16" height="16" id="place-icon">
                                            <span id="place-name"  class="title"></span><br>
                                            <span id="place-address"></span>
                                        </div>

                                        <!-------End Property Address Map-------->
                                        <div class="col-md-12 mt-3">
											<span id="required_propertyAddressForm"></span><br>
                                            <button id="submit-all" class="btn btn-primary-custom" type="submit">Submit</button>
											<button disabled  type="button"  id="headingFourclick" class="btn btn-primary-custom" data-toggle="collapse" data-target="#collapseFour">Next</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-------End Property Address-------->
					 <!-------General Details (Property)-------->

                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h2 class="mb-0">
                                    <button  disabled type="button" id="headingFourclick1" style="float:left;" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour"><i class="fa fa-angle-right"></i>General Details (Property)</button>
                                    <div class="text-right" id="propertyFormMsg" style="display:none;"> <img src="https://www.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png" width="20px"></div>
                                </h2>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                <div class="card-body">
                                    <form class="form-horizontal" id="propertyForm" enctype="multipart/form-data" method="POST">
                                        @csrf

                                        <!-------General (Property) Details Type -------->
                                        <div class="form-group row">
											<div class="col-sm6">
                                                <label class="label">Property Title</label>
                                                <span class="required">*</span><br>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-control" style="width:400px;margin-bottom:11px;" id="property_title" type="input" value="" name="property_title">                                                   
                                                </div>
                                                @error('property_title')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
											<div class="col-sm-6">
                                                <label class="label">Featured Property</label>
                                              
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="featured" type="checkbox" value="1" name="featured">                                                   
                                                </div>
                                                @error('featured')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label class="label">Property Type</label>
                                                <span class="required">*</span><br>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="property_type" type="radio" value="1" name="property_type" {{ old('property_type')== 1 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="flat">Flat</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="property_type" type="radio" value="2" name="property_type" {{ old('property_type')== 2 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="pg">PG</label>
                                                </div>
												<div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="property_type" type="radio" value="3" name="property_type" {{ old('property_type')== 3 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="flat">Flat/ PG</label>
                                                </div>
                                                @error('property_type')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <label class="label">Available for</label>
                                                <span class="required">*</span><br>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="property_available_men" type="checkbox" name="property_available_men" {{ old('property_available')== 1 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="male">Men</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="property_available_women" type="checkbox" name="property_available_women" {{ old('property_available')== 1 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="female">Women</label>
                                                </div>

                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="property_available_unisex" type="checkbox" name="property_available_unisex" {{ old('property_available')== 1 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="female">Unisex</label>
                                                </div>
												<div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="property_available_family" type="checkbox" name="property_available_family" {{ old('property_available')== 1 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="family">Family</label>
                                                </div>
                                                @error('property_available')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="col-md-5">
                                                <label class="label">Furnishing</label>
                                                <span class="required">*</span><br>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="furnishing" type="radio" value="1" name="furnishing" {{ old('furnishing')== 1 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="furnished">Unfurnished</label>
                                                </div>

                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="furnishing" type="radio" value="2" name="furnishing" {{ old('furnishing')== 2 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="sfurnished">Semi Furnished</label>
                                                </div>

                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="furnishing" type="radio" value="3" name="furnishing" {{ old('furnishing')== 3 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="ffurnished">Fully Furnished</label>
                                                </div>

                                                @error('furnishing')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="col-md-3 mt-3">
                                                <label class="label">Owner Free</label>
                                                <span class="required">*</span><br>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="owner_free" type="radio" value="1" name="owner_free" {{ old('owner_free')== 1 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="owner_free" type="radio" value="2" name="owner_free" {{ old('owner_free')== 2 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="no">No</label>
                                                </div>
                                                @error('owner_free')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <label class="label">Food Inclusive</label>
                                                <span class="required">*</span><br>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="food_inclusive" type="radio" value="1" name="food_inclusive" {{ old('food_inclusive')== 1 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="food_inclusive" type="radio" value="2" name="food_inclusive" {{ old('food_inclusive')== 2 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="no">No</label>
                                                </div>
                                                @error('food_inclusive')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="col-md-4 mt-3">
                                                <label class="label">Electricity Inclusive</label>
                                                <span class="required">*</span><br>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="electricity_inclusive" type="radio" value="1" name="electricity_inclusive" {{ old('electricity_inclusive')== 1 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="electricity_inclusive" type="radio" value="2" name="electricity_inclusive" {{ old('electricity_inclusive')== 2 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="no">No</label>
                                                </div>
                                                @error('electricity_inclusive')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
											<div class="col-md-4 mt-3">
                                                <label class="label">Water Inclusive</label>
                                                <span class="required">*</span><br>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="water_inclusive" type="radio" value="1" name="water_inclusive" {{ old('water_inclusive')== 1 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="water_inclusive" type="radio" value="2" name="water_inclusive" {{ old('water_inclusive')== 2 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="no">No</label>
                                                </div>
                                                @error('water_inclusive')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-------End General (Property) Details Type -------->

                                        <!-------Total Number of Rooms & Flats for Rent -------->
                                        <div class="form-group row">
                                            <div class="col-md-4  room_for_rent">
                                                <label for="total_room_for_rent" class="label">Total Number of Rooms for Rent</label>
                                                <span class="required">*</span>
                                                <input class="form-control" id="total_room_for_rent" type="number" name="total_room_for_rent" placeholder="Please Enter  Number " min=1 value="{{old('total_room_for_rent')}}">
                                                @error('total_room_for_rent')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 bed_for_rent">
                                                <label for="total_bed_for_rent" class="label">Total Number of Beds for Rent</label>
                                                <span class="required">*</span>
                                                <input class="form-control" id="total_bed_for_rent" type="number" name="total_bed_for_rent" placeholder="Please Enter Number" min=1 value="{{old('total_bed_for_rent')}}">
                                                @error('total_bed_for_rent')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-4 mt-3 food_exclusive">
                                                <label for="food_exclusive">
                                                <input value="1" name="food_addition" type="checkbox" id="food_exclusive" />
                                                Do you provide food in addition?
                                                </label>
                                            </div>

                                            <div class="col-md-4 yes_food_exclusive">
                                                <label for="food_exclusive_price" class="label">Price per month(Food)</label>

                                                <input class="form-control" id="food_exclusive_price" type="number" name="food_exclusive_price" placeholder="Price without Food" min="1" value="{{old('food_exclusive_price')}}">
                                                @error('food_exclusive_price')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                        <!-------End Total Number of Rooms & Flats for Rent -------->

                                    <!-- Start Property Description details -->
									 <div class="row">
									<div class="col-md-12 mt-3">
										<label class="label">About Property </label>
										<span class="required">*</span><br>
										<div class="form-check form-check-inline mr-1">
											<textarea class="form-check-input" cols="10" rows="5" style="width:600px;margin-bottom:10px;" id="property_about" value="" name="property_about"></textarea>											
										</div>
										@error('property_type')
										<div class="alert alert-danger">{{ $message }}</div>
										@enderror
                                      </div>
									  </div>
                                    <div class="row">
									
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <strong>Property Description</strong>
                                                </div>

                                                <div class="card-body pg-body-select">
                                                    <div class="multipleSelection">
                                                        <div class="selectBox" onclick="showCheckboxes()">

                                                            <select id="room_type" name="select_room_type" class="form-control">
                                                                <option selected="true" disabled="disabled">Select Room Type</option>
                                                            </select>
                                                            <div class="overSelect"></div>
                                                        </div>

                                                        <div id="checkBoxes">

                                                            <label for="third">
                                                                <input value="single_sharing" name="room_type[]" type="checkbox" id="third" onclick="roomTypeCheckbox(this, 'show_ssr')" />
                                                                Single Sharing Rooms
                                                            </label>
                                                            <label for="fourth">
                                                                <input value="twin_sharing" name="room_type[]" type="checkbox" id="fourth" onclick="roomTypeCheckbox(this, 'show_tsr')" />
                                                                Twin Sharing Rooms
                                                            </label>
                                                            <label for="fifth">
                                                                <input value="triple_sharing" name="room_type[]" type="checkbox" id="fifth" onclick="roomTypeCheckbox(this, 'show_trsr')" />
                                                                Triple Sharing Rooms
                                                            </label>
                                                            <label for="sixth">
                                                                <input value="others" name="room_type[]" type="checkbox" id="sixth" onclick="roomTypeCheckbox(this, 'show_other')" />
                                                                Others
                                                            </label>

                                                        </div>
                                                    </div>



                                                    <div class="show_ssr hide_div mt-5">
                                                        <label>Single Sharing Room</label>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="single_sharing_description"  name="single_sharing_description" placeholder="Single Sharing Room description">{{old('single_sharing_description')}}</textarea>
                                                                @error('single_sharing_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="single_sharing_quantity" type="number" name="single_sharing_quantity" placeholder="Quantity" value="{{old('single_sharing_quantity')}}" min=1>
                                                                @error('single_sharing_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row ">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="single_sharing_rent" type="number" name="single_sharing_rent" placeholder="Rent/Month" min=1 value="{{old('single_sharing_rent')}}">
                                                                @error('single_sharing_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="single_sharing_security" type="number" name="single_sharing_security" placeholder="Security Amount" value="{{old('single_sharing_security')}}" min=1>
                                                                @error('single_sharing_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="show_tsr hide_div mt-5">
                                                        <label>Twin Sharing Rooms</label>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="twin_sharing_description" name="twin_sharing_description" placeholder="Double Sharing Room description">{{old('twin_sharing_description')}}</textarea>
                                                                @error('twin_sharing_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="twin_sharing_quantity" type="number" name="twin_sharing_quantity" min=1 placeholder="Quantity" value="{{old('twin_sharing_quantity')}}">
                                                                @error('twin_sharing_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="twin_sharing_rent" type="number" name="twin_sharing_rent" placeholder="Rent/Month" min=1 value="{{old('twin_sharing_rent')}}">
                                                                @error('twin_sharing_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="twin_sharing_security" type="number" name="twin_sharing_security" min=1 placeholder="Security Amount" value="{{old('twin_sharing_security')}}">
                                                                @error('twin_sharing_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="show_trsr hide_div mt-5">
                                                        <label>Tripple Sharing Rooms</label>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="triple_sharing_description" name="triple_sharing_description" placeholder="Tripple Sharing Room description">{{old('triple_sharing_description')}}</textarea>
                                                                @error('triple_sharing_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="triple_sharing_quantity" type="number" name="triple_sharing_quantity" min=1 placeholder="Quantity" value="{{old('triple_sharing_quantity')}}">
                                                                @error('triple_sharing_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
														
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="triple_sharing_rent" type="number" name="triple_sharing_rent" min=1 placeholder="Rent/Month" value="{{old('triple_sharing_rent')}}">
                                                                @error('triple_sharing_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="triple_sharing_security" type="number" name="triple_sharing_security" min=1 placeholder="Security Amount" value="{{old('triple_sharing_security')}}">
                                                                @error('triple_sharing_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                    </div>

                                                    <div class="show_other hide_div mt-5">
                                                        <label>Others</label>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="other_room_description"  name="other_room_description" placeholder="Room description">{{old('other_room_description')}}</textarea>
                                                                @error('other_room_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="other_room_quantity" type="number" name="other_room_quantity" min=1 placeholder="Quantity" value="{{old('other_room_quantity')}}">
                                                                @error('other_room_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="other_room_rent" type="number" name="other_room_rent" placeholder="Rent/Month" min=1 value="{{old('other_room_rent')}}">
                                                                @error('other_room_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="other_room_security" type="number" name="other_room_security" min=1 placeholder="Security Amount" value="{{old('other_room_security')}}">
                                                                @error('other_room_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <!--------------flats------------->

                                                <div class="card-body  flat-body-select">
                                                    <div class="multipleSelection">
                                                        <div class="selectBox" onclick="showFlatCheckboxes()">

                                                            <select id="flat_type" name="select_flat_type" class="form-control">
                                                                <option selected="true" disabled="disabled">Select Flat Type</option>
                                                            </select>
                                                            <div class="overSelect"></div>
                                                        </div>

                                                        <div id="flatCheckBoxes">
															<label for="nine">
                                                                <input value="one_room" name="flat_type[]" type="checkbox" id="nine" onclick="roomTypeCheckbox(this, 'show_1_room')" />
                                                                1 Room
                                                            </label>
															<label for="ten">
                                                                <input value="two_room" name="flat_type[]" type="checkbox" id="ten" onclick="roomTypeCheckbox(this, 'show_2_room')" />
                                                                2 Room
                                                            </label>
															<label for="13">
                                                                <input value="three_room" name="flat_type[]" type="checkbox" id="thirteen" onclick="roomTypeCheckbox(this, 'show_3_room')" />
                                                                3 Room
                                                            </label>
                                                            <label for="first">
                                                                <input value="one_rk" name="flat_type[]" type="checkbox" id="first" onclick="roomTypeCheckbox(this, 'show_1_rk')" />
                                                                1RK
                                                            </label>

                                                            <label for="second">
                                                                <input value="one_bhk" name="flat_type[]" type="checkbox" id="second" onclick="roomTypeCheckbox(this, 'show_1_bhk')" />
                                                                1BHK
                                                            </label>
                                                            <label for="seventh">
                                                                <input value="two_bhk" name="flat_type[]" type="checkbox" id="seventh" onclick="roomTypeCheckbox(this, 'show_2_bhk')" />
                                                                2 BHK
                                                            </label>
															  <label for="fourtine">
                                                                <input value="three_bhk" name="flat_type[]" type="checkbox" id="fourtine" onclick="roomTypeCheckbox(this, 'show_3_bhk')" />
                                                                3 BHK
                                                            </label>
															 <label for="fifteen">
                                                                <input value="four_bhk" name="flat_type[]" type="checkbox" id="fifteen" onclick="roomTypeCheckbox(this, 'show_4_bhk')" />
                                                                4 BHK
                                                            </label>
                                                            <label for="eight">
                                                                <input value="flat_other" name="flat_type[]" type="checkbox" id="eight" onclick="roomTypeCheckbox(this, 'flat_other')" />
                                                                Other
                                                            </label>


                                                        </div>
                                                    </div>
													 <div class="show_1_room hide_div mt-5">
                                                        <label>One Room</label>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="one_room_description" name="one_room_description" placeholder="Room description">{{old('one_room_description')}}</textarea>
                                                                @error('one_room_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="one_room_quantity" type="number" name="one_room_quantity" placeholder="Quantity" min=1 value="{{old('one_room_quantity')}}">
                                                                @error('one_room_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
														
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="one_room_rent" type="number" name="one_room_rent" placeholder="Rent/Month" min=1 value="{{old('one_room_rent')}}">
                                                                @error('one_room_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="one_room_security" type="number" name="one_room_security" placeholder="Security Amount" min=1 value="{{old('one_room_security')}}">
                                                                @error('one_room_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
													<div class="show_2_room hide_div mt-5">
                                                        <label>Two Room</label>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="two_room_description" name="two_room_description" placeholder="Room description">{{old('two_room_description')}}</textarea>
                                                                @error('two_room_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="two_room_quantity" type="number" name="two_room_quantity" placeholder="Quantity" min=1 value="{{old('tow_room_quantity')}}">
                                                                @error('two_room_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
														
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="two_room_rent" type="number" name="two_room_rent" placeholder="Rent/Month" min=1 value="{{old('two_room_rent')}}">
                                                                @error('two_room_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="two_room_security" type="number" name="two_room_security" placeholder="Security Amount" min=1 value="{{old('two_room_security')}}">
                                                                @error('two_room_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
														<div class="show_3_room hide_div mt-5">
                                                        <label>Three Room</label>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="three_room_description" name="three_room_description" placeholder="Room description">{{old('three_room_description')}}</textarea>
                                                                @error('three_room_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="three_room_quantity" type="number" name="three_room_quantity" placeholder="Quantity" min=1 value="{{old('three_room_quantity')}}">
                                                                @error('three_room_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
														
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="three_room_rent" type="number" name="three_room_rent" placeholder="Rent/Month" min=1 value="{{old('three_room_rent')}}">
                                                                @error('three_room_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="three_room_security" type="number" name="three_room_security" placeholder="Security Amount" min=1 value="{{old('three_room_security')}}">
                                                                @error('three_room_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="show_1_rk hide_div mt-5">
                                                        <label>One RK</label>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="one_rk_description" name="one_rk_description" placeholder="Room description">{{old('one_rk_description')}}</textarea>
                                                                @error('one_rk_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="one_rk_quantity" type="number" name="one_rk_quantity" placeholder="Quantity" min=1 value="{{old('one_rk_quantity')}}">
                                                                @error('one_rk_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="one_rk_rent" type="number" name="one_rk_rent" placeholder="Rent/Month" min=1 value="{{old('one_rk_rent')}}">
                                                                @error('one_rk_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="one_rk_security" type="number" name="one_rk_security" placeholder="Security Amount" min=1 value="{{old('one_rk_security')}}">
                                                                @error('one_rk_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="show_1_bhk hide_div mt-5">
                                                        <label>One BHK</label>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="one_bhk_description" name="one_bhk_description" placeholder="One BHK Description">{{old('one_bhk_description')}}</textarea>
                                                                @error('one_bhk_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="one_bhk_quantity" type="number" name="one_bhk_quantity" placeholder="Quantity" min=1 value="{{old('one_bhk_quantity')}}">
                                                                @error('one_bhk_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="one_bhk_rent" type="number" name="one_bhk_rent" placeholder="Rent/Month" min=1 value="{{old('one_bhk_rent')}}">
                                                                @error('one_bhk_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="one_bhk_security" type="number" name="one_bhk_security" placeholder="Security Amount" min=1 value="{{old('one_bhk_security')}}">
                                                                @error('one_bhk_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="show_2_bhk hide_div mt-5">
                                                        <label>Two BHK</label>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="two_bhk_description" name="two_bhk_description" placeholder="2 BHK Description">{{old('two_bhk_description')}}</textarea>

                                                                @error('two_bhk_description')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="two_bhk_quantity" type="number" name="two_bhk_quantity" placeholder="Quantity" min=1 value="{{old('two_bhk_quantity')}}">
                                                                @error('two_bhk_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="two_bhk_rent" type="number" name="two_bhk_rent" placeholder="Rent/Month" min=1 value="{{old('two_bhk_rent')}}">
                                                                @error('two_bhk_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="two_bhk_security" type="number" name="two_bhk_security" placeholder="Security Amount" min=1 value="{{old('two_bhk_security')}}">
                                                                @error('two_bhk_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

														<div class="show_3_bhk hide_div mt-5">
                                                        <label>Three BHK</label>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="three_bhk_description" name="three_bhk_description" placeholder="3 BHK Description">{{old('three_bhk_description')}}</textarea>

                                                                @error('three_bhk_description')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="three_bhk_quantity" type="number" name="three_bhk_quantity" placeholder="Quantity" min=1 value="{{old('three_bhk_quantity')}}">
                                                                @error('three_bhk_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="three_bhk_rent" type="number" name="three_bhk_rent" placeholder="Rent/Month" min=1 value="{{old('three_bhk_rent')}}">
                                                                @error('three_bhk_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="three_bhk_security" type="number" name="three_bhk_security" placeholder="Security Amount" min=1 value="{{old('three_bhk_security')}}">
                                                                @error('three_bhk_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
													
														<div class="show_4_bhk hide_div mt-5">
                                                        <label>Four BHK</label>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="four_bhk_description" name="four_bhk_description" placeholder="4 BHK Description">{{old('four_bhk_description')}}</textarea>

                                                                @error('four_bhk_description')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="four_bhk_quantity" type="number" name="four_bhk_quantity" placeholder="Quantity" min=1 value="{{old('four_bhk_quantity')}}">
                                                                @error('four_bhk_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="four_bhk_rent" type="number" name="four_bhk_rent" placeholder="Rent/Month" min=1 value="{{old('four_bhk_rent')}}">
                                                                @error('four_bhk_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="four_bhk_security" type="number" name="four_bhk_security" placeholder="Security Amount" min=1 value="{{old('four_bhk_security')}}">
                                                                @error('four_bhk_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flat_other hide_div mt-5">
                                                        <label>Other</label>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="other_flat_description" name="other_flat_description" placeholder="Other Flat Description">{{old('other_room_description')}}</textarea>
                                                                @error('other_room_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="other_flat_quantity" type="number" name="other_flat_quantity" min=1 placeholder="Quantity" value="{{old('other_room_quantity')}}">
                                                                @error('other_room_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="other_flat_rent" type="number" name="other_flat_rent" placeholder="Rent/Month" min=1 value="{{old('other_room_rent')}}">
                                                                @error('other_room_rent')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="other_flat_security" type="number" name="other_flat_security" min=1 placeholder="Security Amount" value="{{old('other_flat_security')}}">
                                                                @error('other_flat_security')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!--------------End flats------------->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
										<span id="required_propertyForm"></span><br>
                                        <button id="submit-all" class="btn btn-primary-custom" type="submit">Submit</button>
										<button disabled  type="button"  id="headingTenclick" class="btn btn-primary-custom" data-toggle="collapse" data-target="#collapseTen">Next</button>

                                    </div>
                                    <!-- End Property Description details -->
                                </form>
                                </div>
                            </div>
                        </div>

                        <!-------End General Details (Property)-------->
						<!-- /Property Neighbourhood-->
                        <div class="card">
                            <div class="card-header" id="headingTen">
                                <h2 class="mb-0">
                                    <button disabled="disabled" type="button" style="float:left" id="headingTenclick1" class="btn btn-link text-left" data-toggle="collapse" data-target="#collapseTen"><i class="fa fa-angle-right"></i>Property Neighbourhood Detail</button>
                                    <div class="text-right" id="neighbourFormMsg" style="display:none;"> <img src="https://www.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png" width="20px"></div>
                                </h2>
                            </div>
                            <div id="collapseTen" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <form class="form-horizontal" id="neighbourForm"  method="POST">
                                        @csrf
                                      
                                        <div class="form-group row">
											<div class="col-md-12 mt-3">Area/Distance1</div>
											<div class="col-md-3 mt-3">
												 <div class="form-check form-check-inline mr-1">
													 <input class="form-control" id="area1" type="text" name="area1" placeholder=""  value="{{old('area1')}}">

												</div>
											</div>
											<div class="col-md-9 mt-3">
											  <div class="form-check form-check-inline mr-1">
                                                 <input class="form-control" id="distance1" type="text" name="distance1" placeholder=""  value="{{old('distance1')}}">

												</div>
											</div>
												<div class="col-md-12 mt-3">Area/Distance2</div>
											<div class="col-md-3 mt-3">
												 <div class="form-check form-check-inline mr-1">
													 <input class="form-control" id="area2" type="text" name="area2" placeholder=""  value="{{old('area2')}}">

												</div>
											</div>
										
											<div class="col-md-9 mt-3">
											  <div class="form-check form-check-inline mr-1">
                                                 <input class="form-control" id="distance2" type="text" name="distance2" placeholder=""  value="{{old('distance2')}}">

												</div>
											</div>
											<div class="col-md-12 mt-3">Area/Distance3</div>
											<div class="col-md-3 mt-3">
												 <div class="form-check form-check-inline mr-1">
													 <input class="form-control" id="area3" type="text" name="area3" placeholder=""  value="{{old('area3')}}">

												</div>
											</div>
											
											<div class="col-md-9 mt-3">
											  <div class="form-check form-check-inline mr-1">
                                                 <input class="form-control" id="distance3" type="text" name="distance3" placeholder=""  value="{{old('distance3')}}">

												</div>
											</div>
											<div class="col-md-12 mt-3">Area/Distance4</div>
											<div class="col-md-3 mt-3">
												 <div class="form-check form-check-inline mr-1">
													 <input class="form-control" id="area4" type="text" name="area4" placeholder=""  value="{{old('area4')}}">

												</div>
											</div>
											
											<div class="col-md-9 mt-3">
											  <div class="form-check form-check-inline mr-1">
                                                 <input class="form-control" id="distance4" type="text" name="distance4" placeholder=""  value="{{old('distance4')}}">

												</div>
											</div>
                                            <div class="col-md-12 mt-3">
											<span class="error required_neighbour" ></span><br>
											
                                                <button id="submit-all" class="btn btn-primary-custom" type="submit">Submit</button>
												<button type="button"  id="headingthreeclick" class="btn btn-primary-custom" data-toggle="collapse" data-target="#collapseZero">Next</button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <!-- /End Property Neighbourhood Details-->
<!-- /Property Acknowledgement-->
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button disabled="disabled" type="button" style="float:left" id="headingZeroclick1" class="btn btn-link text-left" data-toggle="collapse" data-target="#collapseZero"><i class="fa fa-angle-right"></i>Property Owner Acknowledgement</button>
                                    <div class="text-right" id="digitalsigFormMsg" style="display:none;"> <img src="https://www.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png" width="20px"></div>
                                </h2>
                            </div>
                            <div id="collapseZero" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <form class="form-horizontal" id="digitalsignatureForm" enctype="multipart/form-data" method="POST">
                                        @csrf
                                      
                                        <div class="form-group row">

                                             <div class="form-check form-check-inline mr-1">
                                                 <input class="form-control" id="digital_signature" type="file" name="digital_signature" placeholder="" accept="application/pdf,image/jpeg,image/jpg,image/png" value="{{old('digital_signature')}}">

											</div>
											@error('digital_signature')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror

                                            <div class="col-md-12 mt-3">
											<span class="error required_signature" ></span>
											
                                                <button id="submit-all" class="btn btn-primary-custom" type="submit">Submit</button>
												<button type="button"  id="headingthreeclick" class="btn btn-primary-custom" data-toggle="collapse" data-target="#collapseThree">Next</button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <!-- /End Property Acknowledgement Details-->

                        <!-------Property Owned / Property Leased-------->

                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button  type="button" id="headingthreeclick1" style="float:left;" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"><i class="fa fa-angle-right"></i>Property Owned / Property Leased</button>
                                    <div class="text-right" id="propertyOwnerFormMsg" style="display:none;"> <img src="https://www.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png" width="20px"></div>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    <form class="form-horizontal" id="propertyOwnerForm" enctype="multipart/form-data" method="POST">
                                        @csrf
										<input type="hidden" name="property_owners_id" id="property_owners_id" value="">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label class="label">Property Owned / Property Leased</label>
                                               <br>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="property_owned" type="radio" value="1" name="property_owned" {{ old('property_owned')== 1 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="property_owned">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="property_owned" type="radio" value="2" name="property_owned" {{ old('property_owned')== 2 ? 'checked' : ''  }}>
                                                    <label class="form-check-label" for="property_owned">No</label>
                                                </div>
                                                @error('property_owned')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="form-group col-md-6 property_address_docs">

                                                    <label class="label">Identity proof with same address</label>
                                                    
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="id_proof_address" type="radio" value="1" name="id_proof_address" {{ old('id_proof_address')== 1 ? 'checked' : ''  }}>
                                                        <label class="form-check-label" for="id_proof_address">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="id_proof_address" type="radio" value="2" name="id_proof_address" {{ old('id_proof_address')== 2 ? 'checked' : ''  }}>
                                                        <label class="form-check-label" for="id_proof_address">No</label>
                                                    </div>
                                                    @error('id_proof_address')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror

                                            </div>


                                        </div>

                                        <!------------------------Identity proof with same address ----------------------->

                                        <div class="property_with_diff_add row">
                                            <div class="col-md-6">
                                                <label for="property_diff_address" class="label">Identity proof with different address</label>
                                                <span class="required">*</span>
                                                <select name="property_diff_address" id="property_diff_address" class="form-control">
                                                    <option selected="true" disabled="disabled">Select Address Proof</option>
                                                    <option value="1">Electricity Bill (not older than last three months)</option>
                                                    <option value="2">Registration Document</option>
                                                    <option value="3">Water bill (Not older than last three months)</option>
                                                </select>

                                                @error('property_diff_address')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="property_address_img" class="label">Address Identity proof document</label> <span class="required">*</span>

                                                <input class="form-control" id="property_address_img" type="file" name="property_address_img" placeholder="" accept="application/pdf,image/jpeg,image/jpg,image/png" value="{{old('property_address_img')}}">


                                                @error('property_address_img')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-------------- End Identity proof with same address ----------------------->

                                        <!-------------- if Proprty leased ----------------------->
                                        <div class="row propert-lease-term">
                                            <div class="col-md-12 card-header">
                                                <strong>Property Leased Details</strong>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group row">

                                                    <div class="col-md-4">
                                                        <label for="lease_duration" class="label">Duration</label>
                                                        
                                                        <input class="form-control" id="lease_duration" type="number" name="lease_duration" placeholder="Ex. 2" min=0 value="{{old('lease_duration')}}">
                                                        @error('lease_duration')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4">

                                                        <label for="lease_unit" class="label">Unit</label>
                                                        

                                                        <select name="lease_unit" id="lease_unit" class="form-control">
                                                            <option selected="true" disabled="disabled">Select Unit</option>
                                                            <option value="1">Month</option>
                                                            <option value="2">Year</option>
                                                        </select>

                                                        @error('lease_unit')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror

                                                    </div>

                                                    <div class="col-md-4 ">

                                                        <label for="lease_expiry" class="label">Expiry of Lease</label>
                                                       
                                                        <input class="form-control" id="lease_expiry" type="date" name="lease_expiry" placeholder="Please Expiry Year" value="{{old('lease_expiry')}}">

                                                        @error('lease_expiry')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror

                                                    </div>


                                                    <div class="col-md-4 mt-3">

                                                        <label for="lease_deed" class="label">Upload lease deed <span style="font-size: 10px;">(Taken as address proof)</span></label>
                                                       
                                                        <input class="form-control" id="lease_deed" type="file" name="lease_deed" placeholder="Enter Lease Term" accept="application/pdf,image/jpeg,image/jpg,image/png" value="{{old('lease_deed')}}">


                                                        @error('lease_deed')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-------------- End Proprty leased ----------------------->

                                        <div class="col-md-12 mt-3">
											<span id="required_property_owned"></span><br>
                                            <button id="property_owned_button" style="display:none" class="btn btn-primary-custom" type="submit">Submit</button>
											<button disabled  style="display:none" type="button"  id="headingFourclick" class="btn btn-primary-custom" data-toggle="collapse" data-target="#collapseFour">Next</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-------End Property Owned / Property Leased-------->

                       
                        

                        <div class="card">
                            <div class="card-header" id="headingSix">
                                <h2 class="mb-0">
                                    <button type="button"  id="headingSixclick1" style="float:left;" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix"><i class="fa fa-angle-right"></i>Amenities / Additional Information</button>
                                    <div class="text-right" id="propertyAmenitiesFormMsg" style="display:none;"> <img src="https://www.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png" width="20px"></div>
                                </h2>
                            </div>
                            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                                <div class="card-body" id="card_additional">
                                    <form class="form-horizontal" id="propertyAmenitiesForm" enctype="multipart/form-data" method="POST">
                                        @csrf

                                        {{--Amenities--}}

                                        <div class="form-group row">
                                            @foreach($amenity as $amenties)
                                                <div class="col-md-3">
                                                    <label for="amenities_first_{{$amenties->id}}">
                                                        <input value="{{$amenties->id}}" name="amenities[]" type="checkbox" id="amenities_first_{{$amenties->id}}" class="mr-2">{{$amenties->name}}
                                                    </label>
                                                </div>
                                            @endforeach
											<div class="col-md-3">
                                                    <label for="amenities_others">
                                                        <input value="1" name="amenities_others" type="checkbox" id="amenities_others" class="mr-2 amenties">Others
                                                    </label>
                                             </div>
											 <div class="col-md-3">
                                                    <label for="amenities_others">
                                                        <input value="" placeholder="type here" style="display:none" max="200" name="amenities_others_text" type="input" id="amenities_others_text" class="mr-2">
                                                    </label>
                                             </div>
                                        </div>

                                        {{--End Amenities--}}

                                        {{--Additional Informtion--}}
                                        <div class="form-group row">
                                            <div class="input_fields_wrap">
											<input type="hidden" id="count_add"  name="count_add"  value="1"/>
												<div><input class="form-control" style="margin-bottom:10px;margin-top:10px;width:600px"  type="text" name="additional_information[]" placeholder="Enter additional Information" value="{{old('additional_information')}}"><button class="add_field_button btn btn-primary-custom" >Add More Fields</button></div>

                                            </div>
                                        </div>
                                        {{--End Additional Information--}}
                                        <div class="col-md-12 mt-3">
                                            <button id="submit-all" class="btn btn-primary-custom" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingSeven">
                                <h2 class="mb-0">
                                    <button type="button" style="float:left;" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven"><i class="fa fa-angle-right"></i>Upload Pictures</button>
                                    <div class="text-right" id="propertyImageFormMsg" style="display:none;"> <img src="https://www.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png" width="20px"></div>
                                </h2>
                            </div>
							
                            <form class="form-horizontal" id="propertyImageForm" enctype="multipart/form-data" method="POST">
                                @csrf

                                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <input type="hidden" id="imagesArray" name="imagesArray" value=""/>
                                        <div class="container" >
                                            <div class='content'>
                                                <div class="dropzone-previews dropzone" id="my-awesome-dropzone"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3">
									<span id="required_propertyImageForm"></span>
                                        <button id="submit-all" class="btn btn-primary-custom" type="submit">Submit</button>
                                    </div>

                                    <div class="col-md-3 mt-3">
                                    <a href="{{url('')}}/admin/property_list"><button id="submit-all" class="btn btn-primary-custom" type="button">View Property List</button></a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />

@endsection
@section('javascript')

<script src="{{ asset($server_path.'admin/assets/js/jquery.min.js')}}"></script>
<script src="{{ asset($server_path.'admin/assets/js/add_property.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>

<script type="text/javascript">


    var placeSearch, autocomplete;

    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };


    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }



    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 30.72160083654737, lng: 76.73057975754385},
          zoom: 13
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.bindTo('bounds', map);

        // Set the data fields to return when the user selects a place.
        autocomplete.setFields(
            ['address_components', 'geometry', 'icon', 'name']);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          draggable: true,
          anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {

            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }


         infowindow.setContent(address);
          var lat = place.geometry.location.lat();
          var lng = place.geometry.location.lng();
          document.getElementById("lat").value = lat;
          document.getElementById("lng").value = lng;
          infowindow.open(map, marker);
        });

        google.maps.event.addListener(marker, 'dragend', function (event) {
            //infowindow.close();
            var marker_lat = marker.getPosition().lat();
            var marker_lng = marker.getPosition().lng();
            var geocoder = new google.maps.Geocoder;

            var latlng = {lat: parseFloat(marker_lat), lng: parseFloat(marker_lng)};
            geocoder.geocode({'location': latlng}, function(results, status) {
                if (status === 'OK') {

                if (results[0]) {
                    address = [
                        (results[0].address_components[0] && results[0].address_components[0].short_name || ''),
                        (results[0].address_components[1] && results[0].address_components[1].short_name || ''),
                        (results[0].address_components[2] && results[0].address_components[2].short_name || ''),
                      ].join(' ');

                      infowindow.setContent(address);
                      infowindow.open(map, marker);
                      document.getElementById("lat").value = marker_lat;
                      document.getElementById("lng").value = marker_lng;
                      document.getElementById("pac-input").value = address;
                } else {
                    window.alert('No results found');
                }
                } else {
                window.alert('Geocoder failed due to: ' + status);
                }
            });

        });

        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
              console.log('Checkbox clicked! New state=' + this.checked);
              autocomplete.setOptions({strictBounds: this.checked});
            });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-A2cTCjqfq0h-GkAEQT4hCbvB2W7xRC8&libraries=places&callback=initMap" async defer></script>



<script type="text/javascript">
    function roomTypeCheckbox(cbox, show_div_class) {
        if (cbox.checked) {
            $('.' + show_div_class).removeClass('hide_div');
        } else {
            $('.' + show_div_class).addClass('hide_div');
        }
    }


    Dropzone.autoDiscover = false;

    jQuery(document).ready(function() {


        var imagesArray = [];

        $("div#my-awesome-dropzone").dropzone({

            paramName: 'file',
            url: 'dropzone/upload',
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
            addRemoveLinks: true,
			parallelUploads:10,
            headers: {
                'x-csrf-token': document.querySelectorAll('meta[name=csrf-token]')[0].getAttributeNode('content').value,
            },
            autoProcessQueue: true,
            uploadMultiple: true,
            init: function() {
                var myDropzone = this;

                this.on("sendingmultiple", function() {

                });
                this.on("successmultiple", function(files, response) {
                    console.log(response.success);
                    //imagesArray.push(response.success);
                    // console.log(imagesArray);
                    // jQuery('#imagesArray').val(JSON.stringify(imagesArray));
                    jQuery('#imagesArray').val(response.success);

                });
                this.on("errormultiple", function(files, response) {

                });
            }


        });



    });


    $(function() {

        //Property owner Check
        if($('input[name=property_owned]:checked').val() == 2){
            $('.propert-lease-term').show();
            $('.property_address_docs').hide();


        }else if($('input[name=property_owned]:checked').val() == 1){
            $('.propert-lease-term').hide();
            $('.property_address_docs').show();
        }else{
            $('.propert-lease-term').hide();
            $('.property_address_docs').hide();
            //$('.property_with_diff_add').hide();
        }

        //Property Type check on load

            if($('input[name=property_type]:checked').val() == 2){
                $('.room_for_rent').hide();
                $('.flat-body-select').hide();
                $('.bed_for_rent').show();
                $('.pg-body-select').show();


            }else if($('input[name=property_type]:checked').val() == 1){
                $('.room_for_rent').show();
                $('.flat-body-select').show();
                $('.bed_for_rent').hide();
                $('.pg-body-select').hide();

            }

            if($('input[name=id_proof_address]:checked').val() == 2){
                $('.property_with_diff_add').show();
            }else{
                $('.property_with_diff_add').hide();
            }



        // $('.propert-lease-term').hide();
        // $('.property_address_docs').hide();
        //$('.property_with_diff_add').hide();
        $('.room_for_rent').hide();
        $('.bed_for_rent').hide();
        $('.pg-body-select').hide();
        $('.flat-body-select').hide();
        $('.yes_food_exclusive').hide();


        $('input#property_owned').on('change', function() {
            if($('input[name=property_owned]:checked').val() == 2){
                $('.propert-lease-term').show(500);
                $('.property_address_docs').hide(500);
                $('.property_with_diff_add').hide();

            }else{
                $('.propert-lease-term').hide(500);
                $('.property_address_docs').show(500);
            }
				$('#headingFourclick').show();
			$('#property_owned_button').show();

        });

        $('input#id_proof_address').on('change', function() {
            if($('input[name=id_proof_address]:checked').val() == 2){
                $('.property_with_diff_add').show(500);
            }else{
                $('.property_with_diff_add').hide(500);
            }
        });

        $('input#property_type').on('change', function() {

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


    $("#pac-input").keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    $('#ownerForm').on('submit',function(event){

        event.preventDefault();
		if($('#ownerId').val()=="")
		{
			$('#required_owner_contact').html('Please select Owner Detail');
			$('#required_owner_contact').addClass('error');			
			$("#area_manager_id").prop("disabled",true);
		}
		else
		{
			$('#ownerFormMsg').show();
			$("#headingTwoclick").prop("disabled",false);
			$("#headingTwoclick1").prop("disabled",false);
			$("#area_manager_id").prop("disabled",false);
			$('#required_owner_contact').html('');
		}
       /* $.ajax({
            url:"{{route('admin.property.owner_details')}}",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                $('#ownerId').val(data.owner_id);
                $('#ownerFormMsg').show();
            },
        });*/
    });
$('#digitalsignatureForm').on('submit',function(event){

        event.preventDefault();
		flag=false;
		var propertyId  =   $('#propertyId').val();
		
		if( $('#digital_signature')[0].files.length === 0)
		{
			$('.required_signature').html('Please select file');
			$('.required_signature').addClass('error');			
			flag=false;
		}
		else
		{			
			$("#headingthreeclick").prop("disabled",false);
			$("#headingthreeclick1").prop("disabled",false);
			$('.required_signature').html('');
			flag=true;
		}
		if(flag)
		{
			var formData = new FormData(this);
			formData.append('propertyId', propertyId);
			
		   $.ajax({
				url:"{{route('admin.property.property_digital_signature')}}",
				method:"POST",
				data:formData,
				dataType:'JSON',
				contentType: false,
				cache: false,
				processData: false,
				success:function(data){               
					$('#digitalsigFormMsg').show();
				},
			});
		}
    });
    $('#areaManagerForm').on('submit',function(event){
        event.preventDefault();
		flag=false;
        var propertyId  =   $('#propertyId').val();
		var ownerId     =   $('#ownerId').val();
	
		if($('#area_manager_id').val()=="" || $('#area_manager_id').val()==null)
		{
			$('#required_area_manager').html('Please select area manager');
			$('#required_area_manager').addClass('error');
			flag=false;			
		}
		else{
			$('#required_area_manager').html('');
			
			$("#headingFiveclick").prop("disabled",false);
			$("#headingFiveclick1").prop("disabled",false);				
			flag=true;
		}
		if(flag)
		{
			var formData = new FormData(this);
			formData.append('propertyId', propertyId);
			formData.append('ownerId', ownerId);
			$.ajax({
				url:"{{route('admin.property.property_manager_details')}}",
				method:"POST",
				data:formData,
				dataType:'JSON',
				contentType: false,
				cache: false,
				processData: false,
				success:function(data){
					$('#propertyId').val(data.propertyId);
					$('#areaManagerFormMsg').show();
				},
			});
		}
    });
	$('#neighbourForm').on('submit',function(event){
        event.preventDefault();
		flag=false;
        var propertyId  =   $('#propertyId').val();
		
		if(($('#area1').val()=="" || $('#distance1').val()=="") &&  ($('#area2').val()=="" || $('#distance2').val()=="" ) && ($('#area3').val()=="" || $('#distance3').val()=="") && ($('#area4').val()=="" || $('#distance4').val()==""))
		{alert("sdfds1");
			$('.required_neighbour').html('Please add atleast one area and distance ');
			$('.required_neighbour').addClass('error');
			flag=false;			
		}
		else{
			$('.required_neighbour').html('');
			$("#headingZeroclick").prop("disabled",false);
			$("#headingZeroclick1").prop("disabled",false);							
			flag=true;
		}
		if(flag)
		{
			var formData = new FormData(this);
			formData.append('propertyId', propertyId);

			$.ajax({
				url:"{{route('admin.property.property_neighbour_details')}}",
				method:"POST",
				data:formData,
				dataType:'JSON',
				contentType: false,
				cache: false,
				processData: false,
				success:function(data){
					//$('#propertyId').val(data.propertyId);
					$('#neighbourFormMsg').show();
				},
			});
		}
    });
    $('#propertyOwnerForm').on('submit',function(event){
        event.preventDefault();
		flag=false;
		/*if($('input[name=property_owned]:checked').val() == 1){
				
			if($('input[name=id_proof_address]:checked').val() == 1  ){	
				flag=true;
				$('#required_property_owned').html('');				
			}
			else if ($('input[name=id_proof_address]:checked').val() == 2)
			{
				
				if($('#property_diff_address').val()=="" || $('#property_address_img')[0].files.length === 0)
				{
					$('#required_property_owned').html('Please select/enter required fields');
					$('#required_property_owned').addClass('error');
					flag=false;			
				}
				else{
					flag=true;
					$('#required_property_owned').html('');	
				}
			}
			else{
				$('#required_property_owned').html('Please select/enter required fields');
				$('#required_property_owned').addClass('error');
				flag=false;	
			}
		}
		else
		{
			if($('#lease_duration').val()=="" || $('#lease_unit').val()=="" || $('#lease_expiry').val()==""  || $('#lease_deed')[0].files.length === 0)
				{
					$('#required_property_owned').html('Please select/enter required fields');
					$('#required_property_owned').addClass('error');
					flag=false;			
				}
				else{
					flag=true;
					$('#required_property_owned').html('');	
				}
		}		
		if(flag)
		{*/
			
			var ownerId     =   $('#ownerId').val();
			var propertyId  =   $('#propertyId').val();
			var formData = new FormData(this);
				formData.append('ownerId', ownerId);
				formData.append('propertyId', propertyId);
			$.ajax({
				url:"{{route('admin.property.property_owner_details')}}",
				method:"POST",
				//data:new FormData(this),
				data:formData,
				dataType:'JSON',
				contentType: false,
				cache: false,
				processData: false,
				success:function(data){
					$("#headingFourclick").prop("disabled",false);
					$("#headingFourclick1").prop("disabled",false);	
					$('#propertyOwnerFormMsg').show();
					$('#property_owners_id').val(ownerId);
				},
			});
		/*}*/    });

    $('#propertyForm').on('submit',function(event){
        event.preventDefault();
		flag=false;		
		
		if($('#property_title').val()=="" || $('#property_about').val()=="" || ($('input[name=property_type]:checked').val() !=1 && $('input[name=property_type]:checked').val() !=2 && $('input[name=property_type]:checked').val() !=3) || ($('input[name=furnishing]:checked').val() !=1 && $('input[name=furnishing]:checked').val() !=2 && $('input[name=furnishing]:checked').val() !=3 ) || ($('input[name=owner_free]:checked').val() !=1 && $('input[name=owner_free]:checked').val() !=2 ) || ($('input[name=electricity_inclusive]:checked').val() !=1 && $('input[name=electricity_inclusive]:checked').val() !=2 )  || ($('input[name=water_inclusive]:checked').val() !=1 && $('input[name=water_inclusive]:checked').val() !=2 ) || ($('input[name=food_inclusive]:checked').val() !=1 && $('input[name=food_inclusive]:checked').val() !=2 )){
			
			$('#required_propertyForm').html('Please select/enter required fields');
			$('#required_propertyForm').addClass('error');
			flag=false;
		}
		else
		{			
			if(!$('#property_available_men').is(':checked') && !$('#property_available_women').is(':checked') && !$('#property_available_unisex').is(':checked') && !$('#property_available_family').is(':checked'))
			{
				$('#required_propertyForm').html('Please select/enter required fields');
				$('#required_propertyForm').addClass('error');
				flag=false;
			}
			else{
				if($('input[name=property_type]:checked').val() == 1 || $('input[name=property_type]:checked').val() == 3)
				{
					if($('#total_room_for_rent').val()=="")
					{
						$('#required_propertyForm').html('Please enter number of rooms');
						$('#required_propertyForm').addClass('error');
						flag=false;
					}
					else
					{					
						$('#required_propertyForm').html('');
						flag=true;
					}
				}
				else 
				{
					if($('#total_bed_for_rent').val()=="")
					{
						$('#required_propertyForm').html('Please enter number of beds');
						$('#required_propertyForm').addClass('error');
						flag=false;
					}
					else
					{
						
						$('#required_propertyForm').html('');
						flag=true;
					}
				}
			}
		}
		if(flag)
		{
			var ownerId     =   $('#ownerId').val();
			var propertyId  =   $('#propertyId').val();
			var formData = new FormData(this);
				formData.append('ownerId', ownerId);
				formData.append('propertyId', propertyId);

			$.ajax({
				url:"{{route('admin.property.property_general_details')}}",
				method:"POST",
				data:formData,
				dataType:'JSON',
				contentType: false,
				cache: false,
				processData: false,
				success:function(data){
					$('#propertyFormMsg').show();
					$("#headingTenclick").prop("disabled",false);
					$("#headingTenclick1").prop("disabled",false);
					$("#headingFiveclick").prop("disabled",false);
					$("#headingFiveclick1").prop("disabled",false);
				},
			});
		}
    });
//   || $('#pac-input').val()==""
    $('#propertyAddressForm').on('submit',function(event){
        event.preventDefault();
		flag=false;
		if($('#address_house').val()=="" || $('#address_building').val()=="" || $('#address_street').val()=="" || $('#address_state').val()=="" || $('#address_city').val()==""  || $('#address_sector').val()==""  || $('#zipcode').val()==""){
			
			$('#required_propertyAddressForm').html('Please select/enter required fields');
			$('#required_propertyAddressForm').addClass('error');
			flag=false;
		}
		else
		{
			$('#required_propertyAddressForm').html('');
			flag=true;
		}
		if(flag)
		{
			var ownerId     =   $('#ownerId').val();
			var propertyId  =   $('#propertyId').val();
			var formData = new FormData(this);
				formData.append('ownerId', ownerId);
				formData.append('propertyId', propertyId);

			$.ajax({
				url:"{{route('admin.property.property_address_details')}}",
				method:"POST",
				data:formData,
				dataType:'JSON',
				contentType: false,
				cache: false,
				processData: false,
				success:function(data){
					$('#propertyAddressFormMsg').show();
					$("#headingFourclick").prop("disabled",false);
					$("#headingFourclick1").prop("disabled",false);	
					$("#headingZeroclick").prop("disabled",false);
					$("#headingZeroclick1").prop("disabled",false);
					$("#headingthreeclick1").prop("disabled",false);
					$("#headingthreeclick").prop("disabled",false);
					$("#headingSixclick1").prop("disabled",false);
					$("#headingSixclick").prop("disabled",false);
				},
			});
		}
    });

    $('#propertyAmenitiesForm').on('submit',function(event){
        event.preventDefault();
        var ownerId     =   $('#ownerId').val();
        var propertyId  =   $('#propertyId').val();
        var formData = new FormData(this);
	        formData.append('ownerId', ownerId);
	        formData.append('propertyId', propertyId);

        $.ajax({
            url:"{{route('admin.property.property_additional_details')}}",
            method:"POST",
            data:formData,
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                $('#propertyAmenitiesFormMsg').show();
            },
        });
    });

    $('#propertyImageForm').on('submit',function(event){
        event.preventDefault();
		
		flag=false;		
		if($('#imagesArray').val()=="")
		{
			$('#required_propertyImageForm').html('Please select image or wait image uploading is in progress');
			$('#required_propertyImageForm').addClass('error');
			flag=false;			
		}
		else{
			flag=true;
			$('#required_propertyImageForm').html('');	
		}
		if(flag)
		{
			var ownerId     =   $('#ownerId').val();
			var propertyId  =   $('#propertyId').val();
			var formData = new FormData(this);
				formData.append('ownerId', ownerId);
				formData.append('propertyId', propertyId);

			$.ajax({
				url:"{{route('admin.property.property_image')}}",
				method:"POST",
				data:formData,
				dataType:'JSON',
				contentType: false,
				cache: false,
				processData: false,
				success:function(data){
					$('#imagesArray').val('');
					$('#propertyImageFormMsg').show();
				},
			});
		}
    });
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
</script>

{{-- <script type="text/javascript">
    var alerted = localStorage.getItem('alerted') || '';
    if (alerted != 'yes') {
     alert("You are using Internet Explorer to view this webpage.  Your experience may be subpar while using Internet Explorer; we recommend using an alternative internet browser, such as Chrome or Firefox, to view our website.");
     localStorage.setItem('alerted','yes');
    }
</script> --}}
@endsection


