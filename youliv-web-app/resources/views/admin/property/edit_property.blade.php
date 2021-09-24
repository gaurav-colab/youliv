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
												<option value="{{$value['id']}}" @if(isset($propertyData->property_owners->owner_id)) @if($value['id']==$propertyData->property_owners->owner_id) selected=selected @endif @endif >{{$value['name']}}</option>
											@endforeach	
											</select>
                                            @error('owner_number')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
											
                                      </div>
									   <div class="col-md-12 mt-3">
											<button id="submit-all" class="btn btn-primary-custom" type="submit">Submit</button>
											<button  type="button"  id="headingTwoclick" class="btn btn-primary-custom" data-toggle="collapse" data-target="#collapseTwo">Next</button>
										</div>
									
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    
                    <!-- /End General Owner Details-->
					
                    <!-- /Start Area Manger Details-->
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button  type="button" style="float:left" id="headingTwoclick1" class="btn btn-link text-left" data-toggle="collapse" data-target="#collapseTwo"><i class="fa fa-angle-right"></i>Area Manager</button>
                                    <div class="text-right" id="areaManagerFormMsg" style="display:none;"> <img src="https://www.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png" width="20px"></div>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <form class="form-horizontal" id="areaManagerForm" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <input type="hidden" name="propertyId" id="propertyId" value="@if(isset($propertyData)) {{$propertyData->id}} @endif">
                                        <div class="form-group row">

                                            <div class="col-md-4">
                                                <label for="area_manager_id" class="label">Name</label>
                                                <span class="required">*</span><span class="col-md-4" id="required_area_manager"></span>
                                                <select class="form-control" id="area_manager_id" name="area_manager_id" disabled>
                                                    <option selected="true" disabled="disabled">Select area manager</option>
                                                    @foreach ($area_managers as $manager)
                                                        <option value="{{$manager['id']}}" @if(isset($propertyData->area_manager_id)) @if($manager['id']==$propertyData->area_manager_id) selected=selected @endif @endif>{{$manager['name']}}</option>
                                                    @endforeach
                                                </select>

                                                @error('area_manager_id')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <label for="area_manager_phone" class="label">Phone number</label>
                                                <span class="required">*</span>
                                                <input class="form-control" readonly id="area_manager_phone" type="text" name="area_manager_phone" placeholder="Enter Phone Number" @if(old('area_manager_phone') || isset($property_manager->phone)) value="{{old('area_manager_phone',$property_manager->phone ?? '')}}" @endif>

                                                @error('area_manager_phone')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <label for="area_manager_name" class="label">Deals</label>
                                                <span class="required">*</span>
                                                <input class="form-control" id="deals" readonly type="text" name="deals" placeholder="Enter deal" @if(old('deals') || isset($propertyData->deals)) value="{{old('deals',$propertyData->deals ?? '')}}" @endif>
                                                @error('deals')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-12 mt-3">												
                                                <button id="submit-all" class="btn btn-primary-custom" type="submit">Submit</button>
												<button  type="button"  id="headingFiveclick" class="btn btn-primary-custom" data-toggle="collapse" data-target="#collapseFive">Next</button>

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
                                    <button type="button"  id="headingFiveclick1" style="float:left;" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive"><i class="fa fa-angle-right"></i>Property Address Details</button>
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
                                                <input class="form-control" id="address_house" type="text" name="address_house" placeholder="House/Flat no"  @if(old('address_house') || isset($propertyData->property_addresses->address_house)) value="{{old('address_house',$propertyData->property_addresses->address_house ?? '')}}" @endif>

                                                @error('address_house')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                            </div>

                                            <div class="col-md-4">
                                                <label for="address_building" class="label">Housing complex/Builing</label>
                                                <span class="required">*</span>
                                                <input class="form-control" id="address_building" type="text" name="address_building" placeholder="Building" @if(old('address_building') || isset($propertyData->property_addresses->address_building)) value="{{old('address_building',$propertyData->property_addresses->address_building ?? '')}}" @endif>

                                                @error('address_building')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                            </div>

                                            <div class="col-md-4">
                                                <label for="address_street" class="label">Street</label>
                                                <span class="required">*</span>
                                                <input class="form-control" @if(old('address_street') || isset($propertyData->property_addresses->address_street)) value="{{old('address_street',$propertyData->property_addresses->address_street ?? '')}}" @endif id="address_street" type="text" name="address_street" placeholder="Street no" >

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
                                                        <option value="{{$states->id}}" @if(isset($propertyData->property_addresses->address_state)) @if($states['id']==$propertyData->property_addresses->address_state) selected=selected @endif @endif>{{$states->name}}</option>
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
													@if(count($city)>0)
														@foreach($city as $key=>$value)
													    <option value="{{$value->id}}" @if(isset($propertyData->property_addresses)) @if($value->id==$propertyData->property_addresses->address_city) selected=selected @endif @endif>{{$value->name}}</option>

														@endforeach
													@endif
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
														@if(count($sector)>0)
															@foreach($sector as $key=>$value){{$value}}
															<option value="{{$value->id}}" @if(isset($propertyData->property_addresses)) @if($value->id==$propertyData->property_addresses->address_sector) selected=selected @endif @endif>{{$value->name}}</option>

															@endforeach
														@endif
                                                </select>
                                                <input type="hidden" name="temp_sector" id="temp_sector" value="{{old('address_sector')}}">

                                                @error('address_sector')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <label for="zipcode" class="label">ZipCode</label>
                                                <span class="required">*</span>
                                                <input class="form-control" id="zipcode" type="text" name="zipcode" placeholder="Pincode" @if(old('zipcode') || isset($propertyData->property_addresses->zipcode)) value="{{old('zipcode',$propertyData->property_addresses->zipcode ?? '')}}" @endif>

                                                @error('zipcode')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                            </div>
                                            <input type="hidden" name="property_lat" id="lat" @if(old('lat') || isset($propertyData->property_addresses->lat)) value="{{old('lat',$propertyData->property_addresses->lat ?? '')}}" @endif>
                                            <input type="hidden" name="property_lng" id="lng" @if(old('lng') || isset($propertyData->property_addresses->lng)) value="{{old('lng',$propertyData->property_addresses->lng ?? '')}}" @endif>

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

                                                    <input type="radio"  name="hidden" id="changetype-establishment">
                                                    <label for="changetype-establishment">Establishments</label>

                                                    <input type="radio" name="hidden" id="changetype-address">
                                                    <label for="changetype-address">Addresses</label>

                                                    <input type="radio" name="hidden" id="changetype-geocode">
                                                    <label for="changetype-geocode">Geocodes</label>
                                                </div>
                                                <div id="strict-bounds-selector" class="pac-controls">
                                                    <input type="hidden" id="use-strict-bounds" value="">
                                                    <label for="use-strict-bounds">Strict Bounds</label>
                                                </div>
                                            </div>
                                            <div id="pac-container">
                                                <input id="pac-input" type="text" name="geo_location"
                                                    placeholder="Enter a location" @if(old('geo_location') || isset($propertyData->property_addresses->geo_location)) value="{{old('geo_location',$propertyData->property_addresses->geo_location ?? '')}}" @endif>
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
											<button type="button"  id="headingFourclick" class="btn btn-primary-custom" data-toggle="collapse" data-target="#collapseFour">Next</button>

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
                                    <button type="button" id="headingFourclick1" style="float:left;" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour"><i class="fa fa-angle-right"></i>General Details (Property)</button>
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
                                                    <input class="form-control" style="width:400px;margin-bottom:11px;" id="property_title" type="input" value="{{old('property_title',$propertyData->property_details->property_title ?? '')}}" name="property_title">                                                   
                                                </div>
                                                @error('property_title')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
											<div class="col-sm-6">
                                                <label class="label">Featured Property</label>
                                              
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="featured" type="checkbox" @if( (old('featured')== 1) || (isset($propertyData->property_details->featured) && ($propertyData->property_details->featured==1))) checked=checked @endif value="1" name="featured">                                                   
                                                </div>
                                                @error('featured')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label class="label">Property Type</label>
                                                <span class="required">*</span><br>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="property_type" type="radio" value="1" name="property_type"  @if( (old('property_type')== 1) || (isset($propertyData->property_details->property_type )) && ($propertyData->property_details->property_type==1)) checked=checked @endif >
                                                    <label class="form-check-label" for="flat">Flat</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="property_type" type="radio" value="2" name="property_type" @if(  (old('property_type')== 2) || (isset($propertyData->property_details->property_type) ) && ($propertyData->property_details->property_type==2)) checked=checked @endif>
                                                    <label class="form-check-label" for="pg">PG</label>
                                                </div>
												<div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="property_type" type="radio" value="3" name="property_type" @if(  (old('property_type')== 3) || (isset($propertyData->property_details->property_type )) && ($propertyData->property_details->property_type==3)) checked=checked @endif
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
                                                    <input class="form-check-input" id="property_available_men" type="checkbox" name="property_available_men" @if( (old('property_available_men')== 1) || (isset($propertyData->property_details->property_available_men )) && ($propertyData->property_details->property_available_men==1)) checked=checked @endif>
                                                    <label class="form-check-label" for="male">Men</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="property_available_women" type="checkbox" name="property_available_women" @if( (old('property_available_women')== 1) || (isset($propertyData->property_details->property_available_women )) && ($propertyData->property_details->property_available_women==1)) checked=checked @endif>
                                                    <label class="form-check-label" for="female">Women</label>
                                                </div>

                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="property_available_unisex" type="checkbox" name="property_available_unisex" @if( (old('property_available_unisex')== 1) || (isset($propertyData->property_details->property_available_unisex )) && ($propertyData->property_details->property_available_unisex==1)) checked=checked @endif>
                                                    <label class="form-check-label" for="female">Unisex</label>
                                                </div>
												<div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="property_available_family" type="checkbox" name="property_available_family" @if( (old('property_available_family')== 1) || (isset($propertyData->property_details->property_available_family )) && ($propertyData->property_details->property_available_family==1)) checked=checked @endif>
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
                                                    <input class="form-check-input" id="furnishing" type="radio" value="1" name="furnishing" @if( (old('furnishing')== 1) || (isset($propertyData->property_details->furnishing )) && ($propertyData->property_details->furnishing==1)) checked=checked @endif>
                                                    <label class="form-check-label" for="furnished">Unfurnished</label>
                                                </div>

                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="furnishing" type="radio" value="2" name="furnishing" @if( (old('furnishing')== 2) || (isset($propertyData->property_details->furnishing )) && ($propertyData->property_details->furnishing==2)) checked=checked @endif>
                                                    <label class="form-check-label" for="sfurnished">Semi Furnished</label>
                                                </div>

                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="furnishing" type="radio" value="3" name="furnishing" @if( (old('furnishing')== 3) || (isset($propertyData->property_details->furnishing )) && ($propertyData->property_details->furnishing==3)) checked=checked @endif>
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
                                                    <input class="form-check-input" id="owner_free" type="radio" value="1" name="owner_free" @if( (old('owner_free')== 1) || (isset($propertyData->property_details->owner_free )) && ($propertyData->property_details->owner_free==1)) checked=checked @endif>
                                                    <label class="form-check-label" for="yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="owner_free" type="radio" value="2" name="owner_free" @if( (old('owner_free')== 2) || (isset($propertyData->property_details->owner_free )) && ($propertyData->property_details->owner_free==2)) checked=checked @endif>
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
                                                    <input class="form-check-input" id="food_inclusive" type="radio" value="1" name="food_inclusive" @if( (old('food_inclusive')== 1) || (isset($propertyData->property_details->food_inclusive )) && ($propertyData->property_details->food_inclusive==1)) checked=checked @endif>
                                                    <label class="form-check-label" for="yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="food_inclusive" type="radio" value="2" name="food_inclusive" @if( (old('food_inclusive')== 2) || (isset($propertyData->property_details->food_inclusive )) && ($propertyData->property_details->food_inclusive==2)) checked=checked @endif>
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
                                                    <input class="form-check-input" id="electricity_inclusive" type="radio" value="1" name="electricity_inclusive" @if( (old('electricity_inclusive')== 1) || (isset($propertyData->property_details->electricity_inclusive )) && ($propertyData->property_details->electricity_inclusive==1)) checked=checked @endif>
                                                    <label class="form-check-label" for="yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="electricity_inclusive" type="radio" value="2" name="electricity_inclusive" @if( (old('electricity_inclusive')== 2) || (isset($propertyData->property_details->electricity_inclusive )) && ($propertyData->property_details->electricity_inclusive==2)) checked=checked @endif>
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
                                                    <input class="form-check-input" id="water_inclusive" type="radio" value="1" name="water_inclusive" @if( (old('water_inclusive')== 1) || (isset($propertyData->property_details->water_inclusive )) && ($propertyData->property_details->water_inclusive==1)) checked=checked @endif>
                                                    <label class="form-check-label" for="yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="water_inclusive" type="radio" value="2" name="water_inclusive" @if( (old('water_inclusive')== 2) || (isset($propertyData->property_details->water_inclusive )) && ($propertyData->property_details->water_inclusive==2)) checked=checked @endif>
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
                                                <input class="form-control" id="total_room_for_rent" type="number" name="total_room_for_rent" placeholder="Please Enter  Number " min=1 @if(old('total_room_for_rent') || isset($propertyData->property_details->total_room_for_rent)) value="{{old('area_manager_phone',$propertyData->property_details->total_room_for_rent ?? '')}}" @endif>
                                                @error('total_room_for_rent')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 bed_for_rent">
                                                <label for="total_bed_for_rent" class="label">Total Number of Beds for Rent</label>
                                                <span class="required">*</span>
                                                <input class="form-control" id="total_bed_for_rent" type="number" name="total_bed_for_rent" placeholder="Please Enter Number" min=1 @if(old('total_bed_for_rent') || isset($propertyData->property_details->total_bed_for_rent)) value="{{old('total_bed_for_rent',$propertyData->property_details->total_bed_for_rent ?? '')}}" @endif>
                                                @error('total_bed_for_rent')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-4 mt-3 food_exclusive">
                                                <label for="food_exclusive">
                                                <input value="1" name="food_addition" type="checkbox" id="food_exclusive" @if( (old('food_exclusive')) || (isset($propertyData->property_details->food_exclusive )) && ($propertyData->property_details->food_exclusive==1)) checked=checked @endif/>
                                                Do you provide food in addition?
                                                </label>
                                            </div>

                                            <div class="col-md-4 yes_food_exclusive">
                                                <label for="food_exclusive_price" class="label">Price per month(Food)</label>

                                                <input class="form-control" id="food_exclusive_price" type="number" name="food_exclusive_price" placeholder="Price without Food" min="1" @if(old('food_exclusive_price') || isset($propertyData->property_details->food_exclusive_price)) value="{{old('food_exclusive_price',$propertyData->property_details->food_exclusive_price ?? '')}}" @endif>
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
											<textarea class="form-check-input" cols="10" rows="5" style="width:600px;margin-bottom:10px;" id="property_about" value="" name="property_about">@if(old('property_about') || isset($propertyData->property_details->property_about)) {{old('property_about',$propertyData->property_details->property_about ?? '')}} @endif</textarea>											
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

                                                <div class="card-body @if(isset($propertyData->property_details->property_type) && $propertyData->property_details->property_type==2) style="display:inline" @endif pg-body-select">
                                                    <div class="multipleSelection">
                                                        <div class="selectBox" onclick="showCheckboxes()">

                                                            <select id="room_type" name="select_room_type" class="form-control">
                                                                <option selected="true" disabled="disabled">Select Room Type</option>
                                                            </select>
                                                            <div class="overSelect"></div>
                                                        </div>

                                                        <div id="checkBoxes" @if(isset($propertyData->property_details->property_type) && ($propertyData->property_details->property_type==2)) style="display:inline" @endif>
													
														
                                                            <label for="third">
                                                                <input value="single_sharing" name="room_type[]" type="checkbox" id="third" onclick="roomTypeCheckbox(this, 'show_ssr')" @if( (old('third')== 1) || ((in_array(1,$property_descript_list)) )) checked=checked @endif />
                                                                Single Sharing Rooms
                                                            </label>
                                                            <label for="fourth">
                                                                <input value="twin_sharing" name="room_type[]" type="checkbox" id="fourth" onclick="roomTypeCheckbox(this, 'show_tsr')" @if( (old('fourth')== 1) || ((in_array(2,$property_descript_list)) )) checked=checked @endif  />
                                                                Twin Sharing Rooms
                                                            </label>
                                                            <label for="fifth">
                                                                <input value="triple_sharing" name="room_type[]" type="checkbox" id="fifth" onclick="roomTypeCheckbox(this, 'show_trsr')" @if( (old('fifth')== 1) || ((in_array(3,$property_descript_list)) )) checked=checked @endif  />
                                                                Triple Sharing Rooms
                                                            </label>
                                                            <label for="sixth">
                                                                <input value="others" name="room_type[]" type="checkbox" id="sixth" onclick="roomTypeCheckbox(this, 'show_other')" @if( (old('sixth')== 1) || ((in_array(4,$property_descript_list)) )) checked=checked @endif  />
                                                                Others
                                                            </label>
														
													
                                                        </div>
                                                    </div>


												
													
                                                    <div class="show_ssr @if(in_array(1,$property_descript_list)) @else hide_div @endif mt-5">
                                                        <label>Single Sharing Room</label>
														<?php $description=$quantity=$rent=$security="";?>
														 @if(in_array(1,$property_descript_list))
															<?php
																	$data=App\PropertyDescription::where([['room_type',1],['property_id',$propertyData->id]])->first();				
																	$description=$data->description;
																	$quantity=$data->quantity;
																	$rent=$data->rent;
																	$security=$data->security;
															?>

														@endif
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="single_sharing_description"  name="single_sharing_description" placeholder="Single Sharing Room description">{{old('single_sharing_quantity',$description ?? '' )}}</textarea>
                                                                @error('single_sharing_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="single_sharing_quantity" type="number" name="single_sharing_quantity" placeholder="Quantity" value="{{old('single_sharing_quantity', $quantity ?? '' )}}" min=1>
                                                                @error('single_sharing_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row ">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="single_sharing_rent" type="number" name="single_sharing_rent" placeholder="Rent/Month" min=1  value="{{old('single_sharing_rent',$rent ?? '')}}" >
                                                                @error('single_sharing_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="single_sharing_security" type="number" name="single_sharing_security" placeholder="Security Amount"  value="{{old('single_sharing_security',$security ?? '')}}" min=1>
                                                                @error('single_sharing_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
													
													
                                                    <div class="show_tsr @if(in_array(2,$property_descript_list)) @else hide_div @endif mt-5">
                                                        <label>Twin Sharing Rooms</label>
														<?php $description=$quantity=$rent=$security="";?>
														 @if(in_array(2,$property_descript_list))
															<?php
																	
																	$data=App\PropertyDescription::where([['room_type',2],['property_id',$propertyData->id]])->first();				
																	$description=$data->description;
																	$quantity=$data->quantity;
																	$rent=$data->rent;
																	$security=$data->security;
															?>

														@endif
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="twin_sharing_description" name="twin_sharing_description" placeholder="Double Sharing Room description">{{old('twin_sharing_description',$description ?? '')}}</textarea>
                                                                @error('twin_sharing_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="twin_sharing_quantity" type="number" name="twin_sharing_quantity" min=1 placeholder="Quantity" value="{{old('twin_sharing_quantity',$quantity ?? '')}}" >
                                                                @error('twin_sharing_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="twin_sharing_rent" type="number" name="twin_sharing_rent" placeholder="Rent/Month" min=1  value="{{old('twin_sharing_rent',$rent ?? '')}}" >
                                                                @error('twin_sharing_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="twin_sharing_security" type="number" name="twin_sharing_security" min=1 placeholder="Security Amount"  value="{{old('twin_sharing_security',$security ?? '')}}" >
                                                                @error('twin_sharing_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="show_trsr @if(in_array(3,$property_descript_list)) @else hide_div @endif mt-5">
                                                        <label>Tripple Sharing Rooms</label>
														<?php $description=$quantity=$rent=$security="";?>
														 @if(in_array(3,$property_descript_list))
															<?php
																	
																	$data=App\PropertyDescription::where([['room_type',3],['property_id',$propertyData->id]])->first();				
																	$description=$data->description;
																	$quantity=$data->quantity;
																	$rent=$data->rent;
																	$security=$data->security;
															?>

														@endif
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="triple_sharing_description" name="triple_sharing_description" placeholder="Tripple Sharing Room description">{{old('triple_sharing_description',$description ?? '')}}</textarea>
                                                                @error('triple_sharing_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="triple_sharing_quantity" type="number" name="triple_sharing_quantity" min=1 placeholder="Quantity"  value="{{old('triple_sharing_quantity',$quantity ?? '')}}" >
                                                                @error('triple_sharing_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
														
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="triple_sharing_rent" type="number" name="triple_sharing_rent" min=1 placeholder="Rent/Month"  value="{{old('triple_sharing_rent',$rent ?? '')}}" >
                                                                @error('triple_sharing_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="triple_sharing_security" type="number" name="triple_sharing_security" min=1 placeholder="Security Amount"  value="{{old('triple_sharing_security',$security ?? '')}}">
                                                                @error('triple_sharing_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                    </div>

                                                    <div class="show_other @if(in_array(4,$property_descript_list)) @else hide_div @endif mt-5">
                                                        <label>Others</label>
														<?php $description=$quantity=$rent=$security="";?>
														 @if(in_array(4,$property_descript_list))
															<?php
																	
																	$data=App\PropertyDescription::where([['room_type',4],['property_id',$propertyData->id]])->first();				
																	$description=$data->description;
																	$quantity=$data->quantity;
																	$rent=$data->rent;
																	$security=$data->security;
															?>

														@endif
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="other_room_description"  name="other_room_description" placeholder="Room description">{{old('other_room_description',$description ?? '')}}</textarea>
                                                                @error('other_room_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="other_room_quantity" type="number" name="other_room_quantity" min=1 placeholder="Quantity"  value="{{old('other_room_quantity',$quantity ?? '')}}" >
                                                                @error('other_room_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="other_room_rent" type="number" name="other_room_rent" placeholder="Rent/Month" min=1 value="{{old('other_room_quantity',$rent ?? '')}}" >
                                                                @error('other_room_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="other_room_security" type="number" name="other_room_security" min=1 placeholder="Security Amount" value="{{old('other_room_security',$security ?? '')}}" >
                                                                @error('other_room_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <!--------------flats------------->

                                                <div class="card-body  @if(isset($propertyData->property_details->property_type) && ($propertyData->property_details->property_type==1 || $propertyData->property_details->property_type==3)) style="display:inline" @endif flat-body-select">
                                                    <div class="multipleSelection">
                                                        <div class="selectBox" onclick="showFlatCheckboxes()">

                                                            <select id="flat_type" name="select_flat_type" class="form-control">
                                                                <option selected="true" disabled="disabled">Select Flat Type</option>
                                                            </select>
                                                            <div class="overSelect"></div>
                                                        </div>

                                                        <div id="flatCheckBoxes" @if(isset($propertyData->property_details->property_type) && ($propertyData->property_details->property_type==2 || $propertyData->property_details->property_type==3)) style="display:inline" @endif> 
													
														
														<label for="nine">
															<input value="one_room" name="flat_type[]" type="checkbox" id="nine" onclick="roomTypeCheckbox(this, 'show_1_room')"  @if( (old('nine')== 1) || ((in_array(9,$property_descript_list)) )) checked=checked @endif />
															1 Room
														</label>
														
															<label for="ten">
                                                                <input value="two_room" name="flat_type[]" type="checkbox" id="ten" onclick="roomTypeCheckbox(this, 'show_2_room')"  @if( (old('ten')== 1) || ((in_array(10,$property_descript_list)) )) checked=checked @endif />
                                                                2 Room
                                                            </label>														
															<label for="13">
                                                                <input value="three_room" name="flat_type[]" type="checkbox" id="thirteen" onclick="roomTypeCheckbox(this, 'show_3_room')" @if( (old('thirteen')== 1) || ((in_array(13,$property_descript_list)) )) checked=checked @endif/>
                                                                3 Room
                                                            </label>
                                                            <label for="first">
                                                                <input value="one_rk" name="flat_type[]" type="checkbox" id="first" onclick="roomTypeCheckbox(this, 'show_1_rk')"  @if( (old('first')== 1) || ((in_array(5,$property_descript_list)) )) checked=checked @endif />
                                                                1RK
                                                            </label>															
                                                            <label for="second">
                                                                <input value="one_bhk" name="flat_type[]" type="checkbox" id="second" onclick="roomTypeCheckbox(this, 'show_1_bhk')"  @if( (old('second')== 1) || ((in_array(6,$property_descript_list)) )) checked=checked @endif>
                                                                1BHK
                                                            </label>	
                                                            <label for="seventh">
                                                                <input value="two_bhk" name="flat_type[]" type="checkbox" id="seventh" onclick="roomTypeCheckbox(this, 'show_2_bhk')"  @if( (old('seventh')== 1) || ((in_array(7,$property_descript_list)) )) checked=checked @endif/>
                                                                2 BHK
                                                            </label>	
															<label for="fourtine">
                                                                <input value="three_bhk" name="flat_type[]" type="checkbox" id="fourtine" onclick="roomTypeCheckbox(this, 'show_3_bhk')" @if( (old('fourtine')== 1) || ((in_array(14,$property_descript_list)) )) checked=checked @endif/>
                                                                3 BHK
                                                            </label>
															 <label for="fifteen">
                                                                <input value="four_bhk" name="flat_type[]" type="checkbox" id="fifteen" onclick="roomTypeCheckbox(this, 'show_4_bhk')" @if( (old('fifteen')== 1) || ((in_array(15,$property_descript_list)) )) checked=checked @endif/>
                                                                4 BHK
                                                            </label>															
                                                            <label for="eight">
                                                                <input value="flat_other" name="flat_type[]" type="checkbox" id="eight" onclick="roomTypeCheckbox(this, 'flat_other')" @if( (old('eight')== 1) || ((in_array(8,$property_descript_list)) )) checked=checked @endif />
                                                                Other
                                                            </label>	
															
                                                        </div>
                                                    </div>
													
													 <div class="show_1_room @if(in_array(9,$property_descript_list)) @else hide_div @endif mt-5">
                                                        <label>One Room</label>
														<?php $description=$quantity=$rent=$security="";?>
														 @if(in_array(9,$property_descript_list))
															<?php
																	$data=App\PropertyDescription::where([['room_type',9],['property_id',$propertyData->id]])->first();				
																	$description=$data->description;
																	$quantity=$data->quantity;
																	$rent=$data->rent;
																	$security=$data->security;
															?>

														@endif
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="one_room_description" name="one_room_description" placeholder="Room description">{{old('one_room_description',$description ?? '')}}</textarea>
                                                                @error('one_room_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="one_room_quantity" type="number" name="one_room_quantity" placeholder="Quantity" min=1 value="{{old('one_room_quantity',$quantity ?? '')}}">
                                                                @error('one_room_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
														
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="one_room_rent" type="number" name="one_room_rent" placeholder="Rent/Month" min=1  value="{{old('one_room_rent',$rent ?? '')}}" >
                                                                @error('one_room_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="one_room_security" type="number" name="one_room_security" placeholder="Security Amount" min=1 value="{{old('one_room_security',$security ?? '')}}" >
                                                                @error('one_room_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
													
													<div class="show_2_room @if(in_array(10,$property_descript_list)) @else hide_div @endif mt-5">
                                                        <label>Two Room</label>
														<?php $description=$quantity=$rent=$security="";?>
														 @if(in_array(10,$property_descript_list))
															<?php
																	
																	$data=App\PropertyDescription::where([['room_type',10],['property_id',$propertyData->id]])->first();				
																	$description=$data->description;
																	$quantity=$data->quantity;
																	$rent=$data->rent;
																	$security=$data->security;
															?>

														@endif
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="two_room_description" name="two_room_description" placeholder="Room description">{{old('two_room_description',$description ?? '')}}</textarea>
                                                                @error('two_room_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="two_room_quantity" type="number" name="two_room_quantity" placeholder="Quantity" min=1 value="{{old('two_room_quantity',$quantity ?? '')}}" >
                                                                @error('two_room_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
														
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="two_room_rent" type="number" name="two_room_rent" placeholder="Rent/Month" min=1  value="{{old('two_room_rent',$rent ?? '')}}">
                                                                @error('two_room_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="two_room_security" type="number" name="two_room_security" placeholder="Security Amount" min=1  value="{{old('two_room_security',$security ?? '')}}" >
                                                                @error('two_room_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
													<div class="show_3_room @if(in_array(13,$property_descript_list)) @else hide_div @endif mt-5">
                                                        <label>Three Room</label>
														<?php $description=$quantity=$rent=$security="";?>
														 @if(in_array(13,$property_descript_list))
															<?php
																	
																	$data=App\PropertyDescription::where([['room_type',13],['property_id',$propertyData->id]])->first();				
																	$description=$data->description;
																	$quantity=$data->quantity;
																	$rent=$data->rent;
																	$security=$data->security;
															?>

														@endif
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="three_room_description" name="three_room_description" placeholder="Room description">{{old('three_room_description',$description ?? '')}}</textarea>
                                                                @error('three_room_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="three_room_quantity" type="number" name="three_room_quantity" placeholder="Quantity" min=1 value="{{old('three_room_quantity',$quantity ?? '')}}" >
                                                                @error('three_room_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
														
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="three_room_rent" type="number" name="three_room_rent" placeholder="Rent/Month" min=1  value="{{old('three_room_rent',$rent ?? '')}}">
                                                                @error('three_room_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="three_room_security" type="number" name="three_room_security" placeholder="Security Amount" min=1  value="{{old('three_room_security',$security ?? '')}}" >
                                                                @error('three_room_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="show_1_rk @if(in_array(5,$property_descript_list)) @else hide_div @endif mt-5">
                                                        <label>One RK</label>
														<?php $description=$quantity=$rent=$security="";?>
														 @if(in_array(5,$property_descript_list))
															<?php
																	$data=App\PropertyDescription::where([['room_type',5],['property_id',$propertyData->id]])->first();				
																	$description=$data->description;
																	$quantity=$data->quantity;
																	$rent=$data->rent;
																	$security=$data->security;
															?>

														@endif
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="one_rk_description" name="one_rk_description" placeholder="Room description">{{old('one_rk_description',$description ?? '')}}</textarea>
                                                                @error('one_rk_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="one_rk_quantity" type="number" name="one_rk_quantity" placeholder="Quantity" min=1  value="{{old('one_rk_quantity',$quantity ?? '')}}" >
                                                                @error('one_rk_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="one_rk_rent" type="number" name="one_rk_rent" placeholder="Rent/Month" min=1 value="{{old('one_rk_rent',$rent ?? '')}}" >
                                                                @error('one_rk_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="one_rk_security" type="number" name="one_rk_security" placeholder="Security Amount" min=1 value="{{old('one_rk_security',$security ?? '')}}" >
                                                                @error('one_rk_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="show_1_bhk @if(in_array(6,$property_descript_list)) @else hide_div @endif mt-5">
                                                        <label>One BHK</label>
														<?php $description=$quantity=$rent=$security="";?>
														 @if(in_array(6,$property_descript_list))
															<?php
																	
																	$data=App\PropertyDescription::where([['room_type',6],['property_id',$propertyData->id]])->first();				
																	$description=$data->description;
																	$quantity=$data->quantity;
																	$rent=$data->rent;
																	$security=$data->security;
															?>

														@endif
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="one_bhk_description" name="one_bhk_description" placeholder="One BHK Description">{{old('one_bhk_description',$description ?? '')}}</textarea>
                                                                @error('one_bhk_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="one_bhk_quantity" type="number" name="one_bhk_quantity" placeholder="Quantity" min=1 value="{{old('one_bhk_quantity',$quantity ?? '')}}" >
                                                                @error('one_bhk_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="one_bhk_rent" type="number" name="one_bhk_rent" placeholder="Rent/Month" min=1 value="{{old('one_bhk_rent',$rent ?? '')}}">
                                                                @error('one_bhk_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="one_bhk_security" type="number" name="one_bhk_security" placeholder="Security Amount" min=1  value="{{old('one_bhk_security',$security ?? '')}}" >
                                                                @error('one_bhk_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="show_2_bhk @if(in_array(7,$property_descript_list)) @else hide_div @endif mt-5">
                                                        <label>Two BHK</label>
														<?php $description=$quantity=$rent=$security="";?>
														 @if(in_array(7,$property_descript_list))
															<?php
																	
																	$data=App\PropertyDescription::where([['room_type',7],['property_id',$propertyData->id]])->first();				
																	$description=$data->description;
																	$quantity=$data->quantity;
																	$rent=$data->rent;
																	$security=$data->security;
															?>

														@endif
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="two_bhk_description" name="two_bhk_description" placeholder="2 BHK Description">{{old('two_bhk_description',$description ?? '')}}</textarea>

                                                                @error('two_bhk_description')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="two_bhk_quantity" type="number" name="two_bhk_quantity" placeholder="Quantity" min=1  value="{{old('two_bhk_quantity',$quantity ?? '')}}" >
                                                                @error('two_bhk_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="two_bhk_rent" type="number" name="two_bhk_rent" placeholder="Rent/Month" min=1 value="{{old('two_bhk_rent',$rent ?? '')}}" >
                                                                @error('two_bhk_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="two_bhk_security" type="number" name="two_bhk_security" placeholder="Security Amount" min=1 value="{{old('two_bhk_security',$security ?? '')}}" >
                                                                @error('two_bhk_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
													<div class="show_3_bhk @if(in_array(7,$property_descript_list)) @else hide_div @endif mt-5">
                                                        <label>Three BHK</label>
														<?php $description=$quantity=$rent=$security="";?>
														 @if(in_array(14,$property_descript_list))
															<?php
																	
																	$data=App\PropertyDescription::where([['room_type',14],['property_id',$propertyData->id]])->first();				
																	$description=$data->description;
																	$quantity=$data->quantity;
																	$rent=$data->rent;
																	$security=$data->security;
															?>

														@endif
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="three_bhk_description" name="three_bhk_description" placeholder="2 BHK Description">{{old('three_bhk_description',$description ?? '')}}</textarea>

                                                                @error('three_bhk_description')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="three_bhk_quantity" type="number" name="three_bhk_quantity" placeholder="Quantity" min=1  value="{{old('three_bhk_quantity',$quantity ?? '')}}" >
                                                                @error('three_bhk_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="three_bhk_rent" type="number" name="three_bhk_rent" placeholder="Rent/Month" min=1 value="{{old('three_bhk_rent',$rent ?? '')}}" >
                                                                @error('three_bhk_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="three_bhk_security" type="number" name="three_bhk_security" placeholder="Security Amount" min=1 value="{{old('three_bhk_security',$security ?? '')}}" >
                                                                @error('three_bhk_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
													<div class="show_4_bhk @if(in_array(15,$property_descript_list)) @else hide_div @endif mt-5">
                                                        <label>Four BHK</label>
														<?php $description=$quantity=$rent=$security="";?>
														 @if(in_array(15,$property_descript_list))
															<?php
																	
																	$data=App\PropertyDescription::where([['room_type',15],['property_id',$propertyData->id]])->first();				
																	$description=$data->description;
																	$quantity=$data->quantity;
																	$rent=$data->rent;
																	$security=$data->security;
															?>

														@endif
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="four_bhk_description" name="four_bhk_description" placeholder="2 BHK Description">{{old('four_bhk_description',$description ?? '')}}</textarea>

                                                                @error('four_bhk_description')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="four_bhk_quantity" type="number" name="four_bhk_quantity" placeholder="Quantity" min=1  value="{{old('four_bhk_quantity',$quantity ?? '')}}" >
                                                                @error('four_bhk_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="three_bhk_rent" type="number" name="four_bhk_rent" placeholder="Rent/Month" min=1 value="{{old('four_bhk_rent',$rent ?? '')}}" >
                                                                @error('four_bhk_rent')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="four_bhk_security" type="number" name="four_bhk_security" placeholder="Security Amount" min=1 value="{{old('four_bhk_security',$security ?? '')}}" >
                                                                @error('four_bhk_security')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flat_other @if(in_array(8,$property_descript_list)) @else hide_div @endif mt-5">
                                                        <label>Other</label>
														<?php $description=$quantity=$rent=$security="";?>
														 @if(in_array(8,$property_descript_list))
															<?php
																	
																	$data=App\PropertyDescription::where([['room_type',8],['property_id',$propertyData->id]])->first();				
																	$description=$data->description;
																	$quantity=$data->quantity;
																	$rent=$data->rent;
																	$security=$data->security;
															?>

														@endif
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" id="other_flat_description" name="other_flat_description" placeholder="Other Flat Description">{{old('other_room_description',$description ?? '')}}</textarea>
                                                                @error('other_room_description')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="other_flat_quantity" type="number" name="other_flat_quantity" min=1 placeholder="Quantity" value="{{old('other_flat_quantity',$quantity ?? '')}}" >
                                                                @error('other_room_quantity')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="other_flat_rent" type="number" name="other_flat_rent" placeholder="Rent/Month" min=1 value="{{old('other_flat_rent',$rent ?? '')}}" >
                                                                @error('other_room_rent')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="other_flat_security" type="number" name="other_flat_security" min=1 placeholder="Security Amount" value="{{old('other_flat_security',$security ?? '')}}" >
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
										<button type="button"  id="headingTenclick" class="btn btn-primary-custom" data-toggle="collapse" data-target="#collapseTen">Next</button>

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
                                    <button type="button" style="float:left" id="headingTenclick1" class="btn btn-link text-left" data-toggle="collapse" data-target="#collapseTen"><i class="fa fa-angle-right"></i>Property Neighbourhood Detail</button>
                                    <div class="text-right" id="neighbourFormMsg" style="display:none;"> <img src="https://www.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png" width="20px"></div>
                                </h2>
                            </div>
                            <div id="collapseTen" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <form class="form-horizontal" id="neighbourForm"  method="POST">
                                        @csrf
                                      
                                        <div class="form-group row">
										<?php $i=1; ?>
										@if(isset($propertyData->property_neighbourhood))
											@foreach($propertyData->property_neighbourhood as $key=>$value)
											
											<div class="col-md-12 mt-3">Area/Distance<?php echo $i ?></div>
											<div class="col-md-3 mt-3">
												 <div class="form-check form-check-inline mr-1">
													 <input class="form-control" id="area<?php echo $i ?>" type="text" name="area<?php echo $i ?>" placeholder=""  value="{{$value->area}}">

												</div>
											</div>
											<div class="col-md-9 mt-3">
											  <div class="form-check form-check-inline mr-1">
                                                 <input class="form-control" id="distance<?php echo $i ?>" type="text" name="distance<?php echo $i ?>" placeholder=""  value="{{$value->distance}}">

												</div>
											</div>
											<?php $i++; ?>
											@endforeach	
										@endif	
										
										<?php for($i;$i<5;$i++) { ?>
											
											<div class="col-md-12 mt-3">Area/Distance<?php echo $i ?></div>
											<div class="col-md-3 mt-3">
												 <div class="form-check form-check-inline mr-1">
													 <input class="form-control" id="area1" type="text" name="area<?php echo $i ?>" placeholder=""  value="">

												</div>
											</div>
											<div class="col-md-9 mt-3">
											  <div class="form-check form-check-inline mr-1">
                                                 <input class="form-control" id="distance<?php echo $i ?>" type="text" name="distance<?php echo $i ?>" placeholder=""  value="">

												</div>
											</div>
										<?php  }?>
											
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
                                    <button  type="button" style="float:left" id="headingZeroclick1" class="btn btn-link text-left" data-toggle="collapse" data-target="#collapseZero"><i class="fa fa-angle-right"></i>Property Owner Acknowledgement</button>
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
                                                    <input class="form-check-input" id="property_owned" type="radio" value="1" name="property_owned" @if(old('property_owned')== 1 || (isset($propertyData->property_owners->property_owned) && $propertyData->property_owners->property_owned==1 )) ? checked=checked : ''  @endif >
                                                    <label class="form-check-label" for="property_owned">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input" id="property_owned" type="radio" value="2" name="property_owned" @if(old('property_owned')== 1 || (isset($propertyData->property_owners->property_owned) &&  $propertyData->property_owners->property_owned==2 )) ? checked=checked : ''  @endif >
                                                    <label class="form-check-label" for="property_owned">No</label>
                                                </div>
                                                @error('property_owned')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="form-group col-md-6 property_address_docs">

                                                    <label class="label">Identity proof with same address</label>
                                                    
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="id_proof_address" type="radio" value="1" name="id_proof_address" @if(old('id_proof_address')== 1 || (isset($propertyData->property_owners->id_proof_is_same_address ) && $propertyData->property_owners->id_proof_is_same_address==1 )) ? checked=checked : ''  @endif >
                                                        <label class="form-check-label" for="id_proof_address">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="id_proof_address" type="radio" value="2" name="id_proof_address" @if(old('id_proof_address')== 1 || (isset($propertyData->property_owners->id_proof_is_same_address ) && $propertyData->property_owners->id_proof_is_same_address==2 )) ? checked=checked : ''  @endif
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
                                                
                                                <select name="property_diff_address" id="property_diff_address" class="form-control">
                                                    <option selected="true" disabled="disabled">Select Address Proof</option>
                                                    <option value="1" @if(old('property_diff_address')== 1 || (isset($propertyData->property_owners->property_diff_address ) && $propertyData->property_owners->property_diff_address==1 )) selected=selected @endif>Electricity Bill (not older than last three months)</option>
                                                    <option value="2" @if(old('property_diff_address')== 2 || (isset($propertyData->property_owners->property_diff_address ) && $propertyData->property_owners->property_diff_address==2 )) selected=selected @endif>Registration Document</option>
                                                    <option value="3" @if(old('property_diff_address')== 3 || (isset($propertyData->property_owners->property_diff_address ) && $propertyData->property_owners->property_diff_address==3 )) selected=selected @endif>Water bill (Not older than last three months)</option>
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
                                                    
                                                        <input class="form-control" id="lease_duration" type="number" name="lease_duration" placeholder="Ex. 2" min=0   value="{{old('lease_duration',$propertyData->property_owners->lease_duration ?? '')}}" >
                                                        @error('lease_duration')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4">

                                                        <label for="lease_unit" class="label">Unit</label>
                                                        

                                                        <select name="lease_unit" id="lease_unit" class="form-control">
                                                            <option selected="true" disabled="disabled">Select Unit</option>
                                                            <option value="1" @if(old('lease_unit')== 1 || (isset($propertyData->property_owners->lease_unit ) && $propertyData->property_owners->lease_unit==1 )) selected=selected @endif>Month</option>
                                                            <option value="2" @if(old('lease_unit')== 2 || (isset($propertyData->property_owners->lease_unit ) && $propertyData->property_owners->lease_unit==2 )) selected=selected @endif>Year</option>
                                                        </select>

                                                        @error('lease_unit')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror

                                                    </div>

                                                    <div class="col-md-4 ">

                                                        <label for="lease_expiry" class="label">Expiry of Lease</label>
                                                       
                                                        <input class="form-control" id="lease_expiry" type="date" name="lease_expiry" placeholder="Please Expiry Year" value="{{old('lease_expiry',$propertyData->property_owners->lease_expiry ?? '')}}">

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
                                            <button id="property_owned_button"  class="btn btn-primary-custom" type="submit">Submit</button>
											<button ype="button"  id="headingFourclick" class="btn btn-primary-custom" data-toggle="collapse" data-target="#collapseFour">Next</button>
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
                                                        <input value="{{$amenties->id}}" @if(in_array($amenties->id,$amenities_list)) checked=checked @endif name="amenities[]" type="checkbox" id="amenities_first_{{$amenties->id}}" class="mr-2">{{$amenties->name}}
													
                                                    </label>
                                                </div>
                                            @endforeach
											<div class="col-md-3">
                                                    <label for="amenities_others">
                                                        <input value="1" name="amenities_others" @if(isset($propertyData->property_details) && $propertyData->property_details->amenities_others==1  ) checked=checked @endif type="checkbox" id="amenities_others" class="mr-2 amenties">Others
                                                    </label>
                                             </div>
											 <div class="col-md-3">
                                                    <label for="amenities_others">
                                                        <input placeholder="type here" @if(isset($propertyData->property_details) && $propertyData->property_details->amenities_others==1  ) style="display:inline" value="{{$propertyData->property_details->amenities_others_text}}" @else style="display:none"   @endif max="200" name="amenities_others_text" type="input" id="amenities_others_text" class="mr-2">
                                                    </label>
                                             </div>
                                        </div>

                                        {{--End Amenities--}}

                                        {{--Additional Informtion--}}
                                        <div class="form-group row">
										<div class="input_fields_wrap">
											
											
											@if(isset($propertyData->property_additional_information))
											<?php $i=0;$count=count($propertyData->property_additional_information ); ?>
											<input type="hidden" id="count_add"  name="count_add"  value="{{$count}}"/>
											@foreach($propertyData->property_additional_information as $key=>$value)
											@if($i==0)
											<div ><input class="form-control" style="margin-bottom:10px;margin-top:10px;width:600px" id="add_field" type="text" name="additional_information[]" placeholder="Enter additional Information" value="{{old('additional_information',$value->additional_information)}}"><a href="javascript:void(this);" class="btn btn-primary-custom empty_button">Remove</a>&nbsp;&nbsp;&nbsp;<button class="add_field_button btn btn-primary-custom" >Add More Fields</button></div>
											<?php $i=1; ?>
												@else
													<div><input class="form-control" style="margin-bottom:10px;margin-top:10px;width:600px" id="additional_information" type="text" name="additional_information[]" placeholder="Enter additional Information" value="{{old('additional_information',$value->additional_information)}}"><a href="#" class="remove_field btn btn-primary-custom remove_button">Remove</a></div>

											   @endif
											@endforeach
											@else
												
												<div><input class="form-control" style="margin-bottom:10px;margin-top:10px;width:600px" id="additional_information" type="text" name="additional_information[]" placeholder="Enter additional Information" value="{{old('additional_information')}}"><button class="add_field_button btn btn-primary-custom" >Add More Fields</button></div>

											@endif
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
									<div class="images_edit">
										 <ul id="image_delete_list">
											@if(isset($propertyData->property_images))
												@foreach($propertyData->property_images as $propertyImg)
													<li id="item_{{ $propertyImg->id }}"><img src="{{url('')}}/{{ $propertyImg->image }}" alt="" width="200px" height="150px"><br><a href="javascript:void(this);" data-value="{{$propertyImg->id }}" class="image_delete"> Delete</a></li>
												@endforeach
											@else							
											
											@endif
											</ul>
									</div>
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

<script src="{{ asset('public/admin/assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('public/admin/assets/js/add_property.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>

<script type="text/javascript">

			$("#area_manager_id").prop("disabled",false);
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
		var lat=$("#lat").val();var lng=$("#lat").val();
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: lat, lng: lng},
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
			if("show_2_room"==show_div_class)
			{
				$('#two_room_description').val('');		
				$('#two_room_quantity').val('');	
				$('#two_room_rent').val('');	
				$('#two_room_security').val('');	
			}	
			if("show_3_room"==show_div_class)
			{
				$('#three_room_description').val('');		
				$('#three_room_quantity').val('');	
				$('#three_room_rent').val('');	
				$('#three_room_security').val('');	
			}	
			if("show_1_room"==show_div_class)
			{
				$('#one_room_description').val('');		
				$('#one_room_quantity').val('');	
				$('#one_room_rent').val('');	
				$('#one_room_security').val('');	
			}	
			
			if("show_1_rk"==show_div_class)
			{
				$('#one_rk_description').val('');		
				$('#one_rk_quantity').val('');	
				$('#one_rk_rent').val('');	
				$('#one_rk_security').val('');	
			}	
			
			if("show_1_bhk"==show_div_class)
			{
				$('#one_bhk_description').val('');		
				$('#one_bhk_quantity').val('');	
				$('#one_bhk_rent').val('');	
				$('#one_bhk_security').val('');	
			}

			if("show_2_bhk"==show_div_class)
			{
				$('#two_bhk_description').val('');		
				$('#two_bhk_quantity').val('');	
				$('#two_bhk_rent').val('');	
				$('#two_bhk_security').val('');	
			}	
			if("show_3_bhk"==show_div_class)
			{
				$('#three_bhk_description').val('');		
				$('#three_bhk_quantity').val('');	
				$('#three_bhk_rent').val('');	
				$('#three_bhk_security').val('');	
			}	

			if("show_4_bhk"==show_div_class)
			{
				$('#four_bhk_description').val('');		
				$('#four_bhk_quantity').val('');	
				$('#four_bhk_rent').val('');	
				$('#four_bhk_security').val('');	
			}	

			if("flat_other"==show_div_class)
			{
				$('#other_flat_description').val('');		
				$('#other_flat_quantity').val('');	
				$('#other_flat_rent').val('');	
				$('#other_flat_security').val('');	
			}	

			if("show_ssr"==show_div_class)
			{
				$('#single_sharing_description').val('');		
				$('#single_sharing_quantity').val('');	
				$('#single_sharing_rent').val('');	
				$('#single_sharing_security').val('');	
			}	

			if("show_tsr"==show_div_class)
			{
				$('#twin_sharing_description').val('');		
				$('#twin_sharing_quantity').val('');	
				$('#twin_sharing_rent').val('');	
				$('#twin_sharing_security').val('');	
			}

			if("show_trsr"==show_div_class)
			{
				$('#triple_sharing_description').val('');		
				$('#triple_sharing_quantity').val('');	
				$('#triple_sharing_rent').val('');	
				$('#triple_sharing_security').val('');	
			}	

			if("show_other"==show_div_class)
			{
				$('#other_room_description').val('');		
				$('#other_room_quantity').val('');	
				$('#other_room_rent').val('');	
				$('#other_room_security').val('');	
			}
			
            $('.' + show_div_class).addClass('hide_div');
        }
    }


    Dropzone.autoDiscover = false;

    jQuery(document).ready(function() {


        var imagesArray = [];

        $("div#my-awesome-dropzone").dropzone({

            paramName: 'file',
            url: '/admin/dropzone/upload',
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
			$('.property_with_diff_add ').hide();
			


        }else if($('input[name=property_owned]:checked').val() == 1){
			
            $('.propert-lease-term').hide();
            $('.property_address_docs').show();
			$('.property_with_diff_add ').show();
        }else{
            $('.propert-lease-term').hide();
            $('.property_address_docs').hide();
            $('.property_with_diff_add').hide();
        }

        //Property Type check on load

            if($('input[name=property_type]:checked').val() == 2){
                $('.room_for_rent').hide();
                $('.flat-body-select').hide();
                $('.bed_for_rent').show();
                $('.pg-body-select').show();


            }else if($('input[name=property_type]:checked').val() == 1 || $('input[name=property_type]:checked').val() == 3 ){
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

			if($('input[name=food_inclusive]:checked').val() == 2){
                $('.food_exclusive').show();
            }else{
                $('.food_exclusive').hide();
            }


			if($('input[name=food_exclusive]:checked').val() == 1){
                $('.yes_food_exclusive').show();
            }else{
				
                $('.yes_food_exclusive').hide();
            }
        // $('.propert-lease-term').hide();
        // $('.property_address_docs').hide();
        //$('.property_with_diff_add').hide();
		
		
        //$('.room_for_rent').hide();
        //$('.bed_for_rent').hide();
       // $('.pg-body-select').hide();
       // $('.flat-body-select').hide();
       //$('.yes_food_exclusive').hide();


        $('input#property_owned').on('change', function() {
            if($('input[name=property_owned]:checked').val() == 2){
                $('.propert-lease-term').show(500);
                $('.property_address_docs').hide(500);
                $('.property_with_diff_add').hide();

            }else{
                $('.propert-lease-term').hide(500);
				$('.property_address_docs').show(500);
				if($('input[name=id_proof_address]:checked').val() == 2){
					$('.property_with_diff_add').show(500);
				}
				else
				{
					$('.property_with_diff_add').hide(500);
				}
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

       // $('.food_exclusive').hide();

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
                url: "/admin/getCity/" + stateId,
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
                url: "/admin/getSector/" + cityId,
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

   // getCity(stateId,city);
    //getSector(city,sector);


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
		var flag= false;
		var ownerId     =   $('#owner_Id').val();
		var propertyId  =   $('#propertyId').val();
		
		if($('#ownerId').val()=="")
		{
			$('#required_owner_contact').html('Please select Owner Detail');
			$('#required_owner_contact').addClass('error');			
			flag= false;
		}
		else
		{			
			$("#area_manager_id").prop("disabled",false);
			$('#required_owner_contact').html('');
			flag= true;
		}
		if(flag)
		{
			var formData = new FormData(this);
			formData.append('propertyId', propertyId);
			formData.append('ownerId', ownerId);
			
			$.ajax({
				url:"{{route('admin.property.owner_details')}}",
				method:"POST",
				data:formData,
				dataType:'JSON',
				contentType: false,
				cache: false,
				processData: false,
				success:function(data){
					$('#ownerId').val(ownerId);
					$('#ownerFormMsg').show();
				},
			});
		}
    });
$('#digitalsignatureForm').on('submit',function(event){

        event.preventDefault();
		flag=false;
		var propertyId  =   $('#propertyId').val();
		var ownerId     =   $('#owner_Id').val();
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
		var ownerId     =   $('#owner_Id').val();
	
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
			
			var ownerId     =   $('#owner_Id').val();
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
			var ownerId     =   $('#owner_Id').val();
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

    $('#propertyAddressForm').on('submit',function(event){
        event.preventDefault();
		flag=false;
		//  || $('#pac-input').val()==""
		if($('#address_house').val()=="" || $('#address_building').val()=="" || $('#address_street').val()=="" || $('#address_state').val()=="" || $('#address_city').val()==""  || $('#address_sector').val()==""  || $('#zipcode').val()=="" ){
			
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
			var ownerId     =   $('#owner_Id').val();
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
        var ownerId     =   $('#owner_Id').val();
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
			var ownerId     =   $('#owner_Id').val();
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
					$('#propertyImageFormMsg').show();
					$('#imagesArray').val('');
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
	
	$(document).on('click', '.image_delete', function() {
		var id=$(this).data("value");
		
		event.preventDefault();		
		
		  $.ajax({
			 type: "POST",
			 data: {"_token": $('meta[name="csrf-token"]').attr('content'),"id": id},
			 url: "{{route('admin.property.image_delete_property')}}",
			 success: function(msg){
			  
			   if(msg.status == "success"){					 
					var list = document.getElementById("image_delete_list");
					
				var item= document.getElementById('item_'+id);
				list.removeChild(item);
				 }
			   else {
				
			   }
			 }
		  });
		
	});
	$(document).on('click', '.empty_button', function() {
		
		$("#add_field").val("");		
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


