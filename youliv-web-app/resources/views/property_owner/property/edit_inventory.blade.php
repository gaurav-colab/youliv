@extends('property_owner.dashboard.base')

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
                              
                                    <div class="row">									
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <strong>Property Description</strong>
                                                </div>
												@if(Session::has('message'))
													<p class="alert alert-success alert_owner">{{ Session::get('message') }}</p>
											    @endif
												
												<form method="post" >
												@csrf
												<input type="hidden" id="property_id" name="property_id" value="{{$propertyData->id}}">
                                                <div class="card-body pg-body-select" style="display:@if(isset($propertyData->property_details->property_type) && $propertyData->property_details->property_type==2) block @else none @endif " >
                                                    <input type="hidden" value="single_sharing" name="room_type[]" >
													<input type="hidden" value="twin_sharing" name="room_type[]" >
													<input type="hidden" value="triple_sharing" name="room_type[]" >
													<input type="hidden" value="others" name="room_type[]" >													
                                                    <div class="show_ssr @if(in_array(1,$property_descript_list)) @else show_div @endif">
                                                        
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
														<div class="form-group row ">

                                                            <div class="col-md-6">
                                                               <label>Single Sharing Room</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                               <a href="javascript:void(0);" onclick="roomTypeCheckbox(this, 'show_ssr')" class="@if(in_array(1,$property_descript_list)) @else hide_div @endif">Remove</a>
                                                            </div>
                                                        </div>
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
													
													
                                                    <div class="show_tsr @if(in_array(2,$property_descript_list)) @else show_div @endif" >
                                                        
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
														<div class="form-group row ">

                                                            <div class="col-md-6">
                                                              <label>Twin Sharing Rooms</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                               <a href="javascript:void(0);" onclick="roomTypeCheckbox(this, 'show_tsr')" class="@if(in_array(2,$property_descript_list)) @else hide_div @endif">Remove</a>
                                                            </div>
                                                        </div>
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


                                                    <div class="show_trsr @if(in_array(3,$property_descript_list)) @else show_div @endif mt-5" >
                                                      
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
														<div class="form-group row ">

                                                            <div class="col-md-6">
                                                              <label>Tripple Sharing Rooms</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                               <a href="javascript:void(0);" onclick="roomTypeCheckbox(this, 'show_trsr')" class="@if(in_array(3,$property_descript_list)) @else hide_div @endif">Remove</a>
                                                            </div>
                                                        </div>
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

                                                    <div class="show_other @if(in_array(4,$property_descript_list)) @else show_div @endif mt-5">
                                                       
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
														<div class="form-group row ">

                                                            <div class="col-md-6">
                                                              <label>Others</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                               <a href="javascript:void(0);" onclick="roomTypeCheckbox(this, 'show_other')">Remove</a>
                                                            </div>
                                                        </div>
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

                                                <div class="card-body flat-body-select"  style="display:@if(isset($propertyData->property_details->property_type) && ($propertyData->property_details->property_type==1 || $propertyData->property_details->property_type==3)) block @else none @endif " >
                                                    	
													<input type="hidden" value="one_room" name="room_type[]" >
													<input type="hidden" value="two_room" name="room_type[]" >
													<input type="hidden" value="three_room" name="room_type[]" >
													<input type="hidden" value="one_rk" name="room_type[]" >	
													<input type="hidden" value="one_bhk" name="room_type[]" >	
													<input type="hidden" value="two_bhk" name="room_type[]" >	
													<input type="hidden" value="three_bhk" name="room_type[]" >	
													<input type="hidden" value="four_bhk" name="room_type[]" >	
													<input type="hidden" value="flat_other" name="room_type[]" >	
														
														<div class="show_1_room @if(in_array(9,$property_descript_list)) @else show_div @endif mt-5">
                                                    
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
														<div class="form-group row ">

                                                            <div class="col-md-6">
                                                              <label>One Room</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                               <a href="javascript:void(0);" onclick="roomTypeCheckbox(this, 'show_1_room')" class="@if(in_array(9,$property_descript_list)) @else hide_div @endif">Remove</a>
                                                            </div>
                                                        </div>
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
													
													<div class="show_2_room @if(in_array(10,$property_descript_list)) @else show_div @endif mt-5">
                                                      
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
														<div class="form-group row ">

                                                            <div class="col-md-6">
                                                              <label>Two Room</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                               <a href="javascript:void(0);" onclick="roomTypeCheckbox(this, 'show_2_room')" class="@if(in_array(10,$property_descript_list)) @else hide_div @endif">Remove</a>
                                                            </div>
                                                        </div>
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
													<div class="show_3_room @if(in_array(13,$property_descript_list)) @else show_div @endif mt-5">                                                      
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
														<div class="form-group row ">

                                                            <div class="col-md-6">
                                                              <label>Three Room</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                               <a href="javascript:void(0);" onclick="roomTypeCheckbox(this, 'show_3_room')" class="@if(in_array(13,$property_descript_list)) @else hide_div @endif">Remove</a>
                                                            </div>
                                                        </div>
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
                                                    <div class="show_1_rk @if(in_array(5,$property_descript_list)) @else show_div @endif mt-5">
                                                       
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
														<div class="form-group row ">
                                                            <div class="col-md-6">
                                                              <label>One RK</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                               <a href="javascript:void(0);" onclick="roomTypeCheckbox(this, 'show_1_rk')" class="@if(in_array(5,$property_descript_list)) @else hide_div @endif">Remove</a>
                                                            </div>
                                                        </div>
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

                                                    <div class="show_1_bhk @if(in_array(6,$property_descript_list)) @else show_div @endif mt-5">                                                        
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
														<div class="form-group row ">
                                                            <div class="col-md-6">
                                                              <label>One BHK</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                               <a href="javascript:void(0);" onclick="roomTypeCheckbox(this, 'show_1_bhk')" class="@if(in_array(6,$property_descript_list)) @else hide_div @endif">Remove</a>
                                                            </div>
                                                        </div>
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

                                                    <div class="show_2_bhk @if(in_array(7,$property_descript_list)) @else show_div @endif mt-5">
                                                       
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
														<div class="form-group row ">
                                                            <div class="col-md-6">
                                                              <label>Two BHK</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                               <a href="javascript:void(0);" onclick="roomTypeCheckbox(this, 'show_2_bhk')" class="@if(in_array(7,$property_descript_list)) @else hide_div @endif">Remove</a>
                                                            </div>
                                                        </div>
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
													<div class="show_3_bhk @if(in_array(7,$property_descript_list)) @else show_div @endif mt-5" >                                                      
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
														<div class="form-group row ">
                                                            <div class="col-md-6">
                                                              <label>Three BHK</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                               <a href="javascript:void(0);" onclick="roomTypeCheckbox(this, 'show_3_bhk')" class="@if(in_array(14,$property_descript_list)) @else hide_div @endif">Remove</a>
                                                            </div>
                                                        </div>
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
													<div class="show_4_bhk @if(in_array(15,$property_descript_list)) @else show_div @endif mt-5" >                                                       
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
														<div class="form-group row ">
                                                            <div class="col-md-6">
                                                              <label>Four BHK</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                               <a href="javascript:void(0);" onclick="roomTypeCheckbox(this, 'show_4_bhk')" class="@if(in_array(15,$property_descript_list)) @else hide_div @endif">Remove</a>
                                                            </div>
                                                        </div>
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
                                                    <div class="flat_other @if(in_array(8,$property_descript_list)) @else show_div @endif mt-5" >                                                      
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
														<div class="form-group row ">
                                                            <div class="col-md-6">
                                                              <label>Other</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                               <a href="javascript:void(0);" onclick="roomTypeCheckbox(this, 'flat_other')" class="@if(in_array(8,$property_descript_list)) @else hide_div @endif">Remove</a>
                                                            </div>
                                                        </div>
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
                                        <button id="submit-all" class="btn btn-primary-custom" type="submit">Submit Request</button>
										
                                    </div>
                                    <!-- End Property Description details -->
                                </form>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>


@endsection
@section('javascript')

<script src="{{ asset($server_path.'admin/assets/js/jquery.min.js')}}"></script>
<script src="{{ asset($server_path.'admin/assets/js/add_property.js') }}"></script>

<script type="text/javascript">
/*
$(".desc_div").click(function() {
	var id=$(this).data('value');
	event.preventDefault();
	$( "#div_"+id).remove();	
});*/
 function roomTypeCheckbox(cbox, show_div_class) {
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
			
           // $('.' + show_div_class).addClass('show_div');
       }
</script>

{{-- <script type="text/javascript">
    var alerted = localStorage.getItem('alerted') || '';
    if (alerted != 'yes') {
     alert("You are using Internet Explorer to view this webpage.  Your experience may be subpar while using Internet Explorer; we recommend using an alternative internet browser, such as Chrome or Firefox, to view our website.");
     localStorage.setItem('alerted','yes');
    }
</script> --}}
@endsection


