@extends('admin.dashboard.base')

@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container-fluid">
    <div class="fade-in">
        <div class="bs-example">
            <div class="accordion" id="accordionExample">
            <!-- /Start General Owner Details-->
                <div class="card">
                    <div class="card-header" id="headingOne">                        
                           <i class="fa fa-plus"></i> Edit Property Schedule
                    </div>
                   
                        <div class="card-body">
						
                            <form class="form-horizontal" id="ownerForm" enctype="multipart/form-data" method="POST">
                                @csrf
								<div class="form-group row">
								<div class="col-md-12">
								@if (session('success'))
										  <div class="alert alert-success">
											{{ session('success') }}
										  </div>
										@endif
										@if (session('error'))
										  <div class="alert alert-warning">
											{{ session('error') }}
										  </div>
										@endif
								</div>
                                

                                   
								<div class="col-sm-12 visit-body">
									
										<div class="col-sm-6">
											Property Code:  {{$schedule->property->property_code}}</br>	
											Property Title:  {{$schedule->property_details->property_title}}</br>	
											<?php
											$address="";
												if(isset($schedule->property_address->address_city))		
												{
													$city=App\City::where('id',$schedule->property_address->address_city)->first();				
													$address_city=$city->name;
												}
												if(isset($schedule->property_address->address_sector))
												{
													$address_sector=App\Sector::where('id',$schedule->property_address->address_sector)->first();
													$address_sector=$address_sector->slug;
												}
												
												if(isset($schedule->property_address->address_city))	
												{
													$address=$address_city.", ".$address_sector;
												}
												?>
											Property Address: {{$address}}  </br>	
										</div>	
										<div class="col-sm-6">
											User Name: {{$schedule->user->name}}</br>											
											Contact Number: {{$schedule->user->mobilenumber}} 
										</div>	
											 <div class="col-md-12">
											 <label for="owner_name" class="label">Area Manger</label>
													<span class="required">*</span>
											  <select class="form-control" id="area_manager_id" name="area_manager_id" >
                                                    <option selected="true" disabled="disabled">Select area manager</option>
                                                    @foreach ($area_managers as $manager)
                                                        <option value="{{$manager['id']}}" @if(isset($schedule->area_manager_id)) @if($manager['id']==$schedule->area_manager_id) selected=selected @endif @endif>{{$manager['name']}}{{($manager['phone'])}}</option>
                                                    @endforeach
                                                </select>
													  @error('owner_name')
													<div class="error">{{ $message }}</div>
												@enderror

												</div>
											<div class="col-md-12">
											<div class="visit-property-date">
													<label for="sh_date" class="label">When do you want to visit the property?</label>
													 <input id="sh_date" name="sh_date" type="text" class="form-control date-property-type" value="{{old('sh_date',date('d-m-Y',strtotime($schedule->date)) ?? '')}}" />
													
														  <label  for="sh_date"><i class="fa fa-calendar-check-o sh_date" aria-hidden="true"></i></label>
															  @error('sh_date')
													<div class="error">{{ $message }}</div>
														@enderror
														
														</div>
												</div>
												
												  
										<div class="col-md-12">		
											
										 <input id="sh_time" name="sh_time" type="hidden" class="form-control"  value="{{old('sh_time',$schedule->time ?? '')}}"/>
											 <input id="property_id" name="property_id" type="hidden" class="form-control"  />
																

										<label for="owner_name" class="label">Select the timeslot which suits the best for you.</label>
										<ul>
											<li><a href="javascript:void(0);" class="sh_time @if(isset($schedule->time)) @if('9-10'==$schedule->time) {{"time_selected"}} @endif @endif" data-value="9-10"  >9am-10am</a></li>
											<li><a href="javascript:void(0);" class="sh_time @if(isset($schedule->time)) @if('10-11'==$schedule->time) {{"time_selected"}} @endif @endif" data-value="10-11">10am-11am</a></li>
											<li><a href="javascript:void(0);" class="sh_time @if(isset($schedule->time)) @if('1-00'==$schedule->time) {{"time_selected"}} @endif @endif" data-value="11-00">11am-12pm</a></li>
											<li><a href="javascript:void(0);" class="sh_time @if(isset($schedule->time)) @if('00-13'==$schedule->time) {{"time_selected"}} @endif @endif" data-value="00-13">12pm-1pm</a></li>
											<li><a href="javascript:void(0);" class="sh_time @if(isset($schedule->time)) @if('13-14'==$schedule->time) {{"time_selected"}} @endif @endif" data-value="13-14">1pm-2pm</a></li>
											<li><a href="javascript:void(0);" class="sh_time @if(isset($schedule->time)) @if('14-15'==$schedule->time) {{"time_selected"}} @endif @endif" data-value="14-15">2pm-3pm</a></li>
											<li><a href="javascript:void(0);" class="sh_time @if(isset($schedule->time)) @if('15-16'==$schedule->time) {{"time_selected"}} @endif @endif" data-value="15-16">3pm-4pm</a></li>
											<li><a href="javascript:void(0);" class="sh_time @if(isset($schedule->time)) @if('16-17'==$schedule->time) {{"time_selected"}} @endif @endif" data-value="16-17">4pm-5pm</a></li>
											<li><a href="javascript:void(0);" class="sh_time @if(isset($schedule->time)) @if('17-18'==$schedule->time) {{"time_selected"}} @endif @endif" data-value="17-18" >5pm-6pm</a></li>
											<li><a href="javascript:void(0);" class="sh_time @if(isset($schedule->time)) @if('18-19'==$schedule->time) {{"time_selected"}} @endif @endif" data-value="18-19">6pm-7pm</a></li>
											<li><a href="javascript:void(0);" class="sh_time @if(isset($schedule->time)) @if('19-20'==$schedule->time) {{"time_selected"}} @endif @endif " data-value="19-20">7pm-8pm</a></li>
										</ul>
											@error('sh_time')
										<div class="error">{{ $message }}</div>
											@enderror
										</div>
										 <div class="col-sm-6 ">
											 <label for="status" class="label">Cancel Visit</label>
											<input id="status" type="checkbox" 	name="status" @if('1'==$schedule->status) checked=checked @endif >	
										 @error('status')
										<div class="error">{{ $message }}</div>
											@enderror
										</div>
										 <div class="col-sm-6">
											<label for="approved" class="label">Visit Approved</label>
											<input id="approved" type="checkbox" 	name="approved" @if('1'==$schedule->approved) checked=checked @endif >	
										 @error('approved')
										<div class="error">{{ $message }}</div>
											@enderror
										</div>
										<div class="col-sm-6"><label ></label>	<button type="submit" class="btn btn-primary-custom"><span>Submit</span></button></div>
									
                                  </div>
                                </div>
                            </form>
                     
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
@section('javascript')

<script>
$(document).ready(function(){
	$('#ownerForm').validate({
	  errorElement: 'label',

	  errorPlacement: function(error,elem){
		var errorElemId=$(error).attr('id');
		if($("[id='"+errorElemId+"']").length){
		  $("[id='"+errorElemId+"']").replaceWith(error);
		}else{
			error.insertAfter(elem);
		}
	  },

	  rules: {
		'owner_name':{
		  required : true,
		},
		'owner_number':{
		  required : true,
		}
	  }
	});
	 $(function () {
            $('#sh_date').datepicker({
                format: "dd-mm-yyyy"
            });
        });
});

$(document).on('click', '.sh_time', function() {		
	
	var time_sh=$(this).data('value');
	$('#sh_time').val(time_sh);
	$(".sh_time").not($(this)).removeClass('time_selected');
		$(this).addClass('time_selected');
	});
</script>


@endsection


