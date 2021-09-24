@extends('layouts.appcommon')
@section('content')

<div class="content clearfix">
    <!--		destop account manu-bar-->
	
    <aside>
        <div id="box" class="sticky-pp">
            <div class="profile-sidebar">
                <div class="sidesticky">
                    <div class="profile-photo">
                        <figure>
                            @if($user->image=="")
						<img src="public/app_asset/images/no_image.png" img alt="Profile Pic" >
					@else
						<img src="{{url('/')}}/public/profileimage/{{$user->image}}" img alt="Profile Pic">
					@endif
                        </figure>
                        <figcaption>
                            <h1>{{$user->name}}</h1>
                        </figcaption>
                    </div>
                    <ul>
                       
                        <li class="profile-active"><a href="{{url('/')}}/my_account"><span class="icon-account1"></span>My Profile</a></li>
                        <li><a href="javascript:void(0);"><span class="icon-request"></span>My Bookings</a></li>
                        <li><a href="javascript:void(0);"><span class="icon-password"></span>Change Password</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <!--			destop account manu-bar ends-->
    <main>
        <!--		  mobile display account-menubar-->
        <div class="profile-sidebar visible-xs">
            <div class="sidesticky profile-mob-display ">
                <div class="profile-photo">
                    <figure>
                        @if($user->image=="")
						<img src="{{url('/')}}/public/app_asset/images/no_image.png" img alt="Profile Pic"  >
					@else
						<img src="{{url('/')}}/public/profileimage/{{$user->image}}" img alt="Profile Pic" >
					@endif
                    </figure>
                    <figcaption>
                        <h1>{{$user->name}}</h1>
                    </figcaption>
                </div>
                <ul>
                    
                    <li class="profile-active"><a href="javascript:void(0);"><span class="icon-account1"></span>My Profile</a></li>
					<li><a href="javascript:void(0);"><span class="icon-request"></span>My Bookings</a></li>                    
                    <li><a href="javascript:void(0);"><span class="icon-logout"></span>Logout</a></li>
                </ul>
            </div>
        </div>
        <!--		  mobile display account-menubar ends-->



        <section class="subscription-plan profile-block-sec">
	
            <div >
               
                    <form method="post" enctype="multipart/form-data">
					@csrf
                        <div class="profile">
                            <div class="profile-heading">
                                <h2>Profile <span class="edit_profile">Edit</span></h2>
                                <h3>Update your Account Information</h3>
                            </div>
							
                            <div class="myprofile-side">
								<div class="row">
									@if(session('error'))
									<div class="alert alert-error">
										{!! session('error') !!}
									</div>
									@endif
									@if(session('success'))
									<div class="alert alert-success">
										{!! session('success') !!}
									</div>
									@endif
								</div>
                                <div class="row">
                                    <div class="col-md-2">
									@if($user->image=="")
                                        <img src="{{url('/')}}/public/app_asset/images/no_image.png" id="logo-preview" style="width:155px;height:155px;">
									@else
										<img src="{{url('/')}}/public/profileimage/{{$user->image}}" id="logo-preview" style="width:155px;height:155px;">
									@endif
								
									<div class="image-upload" @if ($errors->any()) @else {{'style=display:none'}}  @endif >
									  <label for="image">
										<img src="https://icon-library.net/images/upload-photo-icon/upload-photo-icon-21.jpg" width="30px" height="30px"/>
									  </label>

									  <input id="image" name="image"  style="display:none"  type="file" />
									    @error('image')
												  <span class="error" role="alert">
													  <span>{{ $message }}</span>
												  </span>
											  @enderror
									</div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="name-type">
                                            <label>Full Name</label>
                                            <input type="text" name="name"  @if ($errors->any()) @else {{'readonly'}}  @endif id="name" class="form-control" placeholder="Your Name" value="{{old('name',$user->name)}}">
											  @error('name')
												  <span class="error" role="alert">
													  <span>{{ $message }}</span>
												  </span>
											  @enderror
                                        </div>
                                    </div>
                                </div>
                              <div class="contact-heading">
                                    <h2>Your Contact Information</h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile Number</label>
                                            <input type="text" name="mobilenumber"  @if ($errors->any()) @else {{'readonly'}}  @endif id="mobilenumber" placeholder="Your Mobile" class="form-control"  value="{{old('mobilenumber',$user->mobilenumber)}}">
											<a href="javascript:void(0);"  data-toggle="modal" data-target="#change_phone">Edit</a>
											@error('mobilenumber')
												  <span class="error" role="alert">
													  <span>{{ $message }}</span>
												  </span>
											  @enderror
									  </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" name="email" @if ($errors->any()) @else {{'readonly'}}  @endif id="email" placeholder="Your Email" class="form-control" value="{{old('email',$user->email)}}">
											  @error('email')
												  <span class="error" role="alert">
													  <span>{{ $message }}</span>
												  </span>
											  @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="dropbtn-form">
                                            <div class="form-group">
                                                <label>Occupantion</label>
                                                <div >
                                                   
													<select id="occupantion" name="occupantion" class="form-control" @if ($errors->any()) @else {{'disabled=true'}}  @endif >
													<option value="1" @if($user->occupantion==1 || old('occupantion')==1) selected=selected @endif >Student</option>
													<option value="2" @if($user->occupantion==2 || old('occupantion')==2) selected=selected @endif >Govt Employee</option>
													<option value="3" @if($user->occupantion==3 || old('occupantion')==3) selected=selected @endif >Private Job</option>
													<option value="4" @if($user->occupantion==4 || old('occupantion')==4) selected=selected @endif >Traveller</option>
													</select>
													 @error('occupantion')
													<span class="error" role="alert">
													  <span>{{ $message }}</span>
												  </span>
											  @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender</label>
											
											<div class="gender" >
                                            <input type="radio" name="gender"   @if ($errors->any()) @else {{'disabled=true'}}  @endif @if($user->gender || old('gender')==1) checked=checked @endif class="radio_gender" value="1">
											Male
											<input type="radio" name="gender" @if ($errors->any()) @else {{'disabled=true'}}  @endif   @if($user->gender==2 || old('gender')) checked=checked @endif class="radio_gender" value="2">
											Female
											</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   
                                    <div class="col-md-12">
                                        <div class="form-btn">
                                            <button class="btn-info" type="submit" @if ($errors->any()) @else {{'style=display:none'}} @endif >Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      
                    </form>
                </div>
            </div>
      <div class="my-account-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" @if(Request::path()=="my_account"){{"class=active"}} @endif ><a href="#Coming-Visits" aria-controls="Edit-Profile" role="tab" data-toggle="tab">Coming Visits</a></li>
                    <li role="presentation"><a href="#Food-preference" aria-controls="Food-preference" role="tab" data-toggle="tab">Past Visits</a></li>
                    <li role="presentation" @if(Request::path()=="my_account/favourite_properties"){{"class=active"}} @endif ><a href="#Favourite-Properties" aria-controls="Favourite-Properties" role="tab" data-toggle="tab"  >My Favourites</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane @if(Request::path()=="my_account"){{"active"}} @endif" id="Coming-Visits">
                        <div class="acc-booking-div">
                            <div class="alert-success success">
			
							</div>
							<div class="alert-error error">
								
							</div>
						   @if(count($coming_schedule)>0)
							   
							    <button class="prevBtn"><i class="fa fa-arrow-left" aria-hidden="true" title="Previous"></i></button>
								<button class="nextBtn"><i class="fa fa-arrow-right" aria-hidden="true" title="Next"></i></button>	
								<div class="form" >
									@foreach($coming_schedule->chunk(2) as $chunk)
										<div class="step" >
											@foreach($chunk as $key=>$value)
							   
							   
												<div class="booking-house svisit-outer pd-hs-detail">
													<figure>
														@if(isset($value->property_images))
														<img src="{{ url('/') }}/{{$value->property_images->image}}" alt="house for booking" class="img_sch">
														
														@else
															
														<img src="{{ url('public/app_asset/images/booking-house-1.png') }}" alt="house for booking" class="img_sch">
														@endif
													</figure>
													<figcaption>
														<h2>@if(isset($value->property_details)){{$value->property_details->property_title}}@endif</h2>
														@if($value->status==0)
															<span class="book-cancle-btn req-cancle">Visit Cancelled</span>
														@else
															<span class="book-cancle-btn visit_{{$value->id}}">Visit Scheduled</span>
														@endif
														<h4><span class="icon-gps"></span>
														<?php $address_city=$address_sector="";
														if(isset($value->property_address->address_city))		
															{
																$city=App\City::where('id',$value->property_address->address_city)->first();				
																$address_city=$city->name;
															}
															if(isset($value->property_address->address_sector))
															{
																$address_sector=App\Sector::where('id',$value->property_address->address_sector)->first();
																$address_sector=$address_sector->slug;
															}						
															
															$address=$address_city.", ".$address_sector;
															echo $address;
															?>
														</h4>
														<ul>
															<li>
																<h2>Date of your Visit<span>{{date('F d, Y' , strtotime($value->date))}}</span></h2>
																<h2>Time slot Scheduled<span>{{date('H:00 a', strtotime($value->visit_time))}}-{{date('H:00 a' ,strtotime($value->visit_time) + 60*60)}}</span></h2>
															</li>
															<li>
															@if($value->approved==1)
																<?php 
																$usr=App\AreaManager::where('id',$value->property->area_manager_id)->first();				
																
																?>
																<h2>Contact Person<span>{{$usr->name}}</span></h2>
																<h2>Contact Number<span>{{$usr->phone}}</span></h2>
																@else
																	<h2>Pending for Approval</span></h2>
															@endif	
															</li>
														</ul>

														<div class="co-slider-btn">
															<a href="javascript:void(0);" class="now-book cancel_visit cancel_visit_{{$value->id}}" data-value="{{$value->id}}" @if($value->status==0) disabled=disabled @endif>Cancel Visit</a>
															<a href="javascript:void(0);" class="visit-book rsvisit" data-toggle="modal" data-target="#visit-modal" data-id="{{$value['id']}}" data-url="@if(isset($value->property_details)){{$value->property_details->property_title}}@endif"data-value="{{ $address}}" >Re-Schedule visit</a>						
														</div>
													</figcaption>
												</div>	
											@endforeach
							
										</div>
									@endforeach	
									
								</div>		

							@endif
					</div>
				</div>



                <div role="tabpanel" class="tab-pane" id="Food-preference">
                        <div class="acc-booking-div">
                            <div class="alert-success success">
			
						</div>
						<div class="alert-error error">
							
						</div>
					   @if(count($past_schedule)>0)
						    <button class="prevBtn"><i class="fa fa-arrow-left" aria-hidden="true" title="Previous"></i></button>
								<button class="nextBtn"><i class="fa fa-arrow-right" aria-hidden="true" title="Next"></i></button>	
						   <div class="form">
						   @foreach($past_schedule->chunk(2) as $chunk)
						   <div class="step">
						   @foreach($chunk as $key=>$value)
						   
						   
							<div class="booking-house svisit-outer pd-hs-detail">
							
								<figure>
									@if(isset($value->property_images))
									<img src="{{ url('/') }}/{{$value->property_images->image}}" alt="house for booking" class="img_sch">
									
									@else
										
									<img src="{{ url('public/app_asset/images/booking-house-1.png') }}" alt="house for booking" class="img_sch">
									@endif
								</figure>
								<figcaption>
									<h2>@if(isset($value->property_details)){{$value->property_details->property_title}}@endif</h2>
									@if($value->status==0)
										<span class="book-cancle-btn req-cancle">Visit Cancelled</span>
									@else
										<span class="book-cancle-btn visit_{{$value->id}}">Visit Scheduled</span>
									@endif
									<h4><span class="icon-gps"></span>
									<?php $address_city=$address_sector="";
									if(isset($value->property_address->address_city))		
										{
											$city=App\City::where('id',$value->property_address->address_city)->first();				
											$address_city=$city->name;
										}
										if(isset($value->property_address->address_sector))
										{
											$address_sector=App\Sector::where('id',$value->property_address->address_sector)->first();
											$address_sector=$address_sector->slug;
										}						
										
										$address=$address_city.", ".$address_sector;
										echo $address;
										?>
									</h4>
									<ul>
										<li>
											<h2>Date of your Visit<span>{{date('F d, Y' , strtotime($value->date))}}</span></h2>
											<h2>Time slot Scheduled<span>{{date('H:00 a', strtotime($value->visit_time))}}-{{date('H:00 a' ,strtotime($value->visit_time) + 60*60)}}</span></h2>
										</li>
										<li>
										@if($value->approved==1)
											<?php 
											$usr=App\AreaManager::where('id',$value->property->area_manager_id)->first();				
											
											?>
											<h2>Contact Person<span>{{$usr->name}}</span></h2>
											<h2>Contact Number<span>{{$usr->phone}}</span></h2>
											@else
												<h2>Pending for Approval</span></h2>
										@endif	
										</li>
									</ul>

									<div class="co-slider-btn">
										<a href="javascript:void(0);" disabled=disabled class="now-book cancel_visit cancel_visit_{{$value->id}}" data-value="{{$value->id}}" @if($value->status==0) disabled=disabled @endif>Cancel Visit</a>
										<a href="javascript:void(0);" disabled=disabled class="visit-book rsvisit" data-toggle="modal" data-target="#visit-modal" data-id="{{$value['id']}}" data-url="@if(isset($value->property_details)){{$value->property_details->property_title}}@endif"data-value="{{ $address}}" >Re-Schedule visit</a>						
									</div>
								</figcaption>
							</div>
							
						
						
						@endforeach
						
						</div>
						@endforeach	
							
					</div>		

						@endif
                        </div>
                    </div>

                    <!- Favourite-Properties->
					 <div role="tabpanel" class="tab-pane @if(Request::path()=="my_account/favourite_properties"){{"active"}} @endif" id="Favourite-Properties">
                        <div class="acc-booking-div">
                            <div class="alert-success success">
			
						</div>
						<div class="alert-error error">
							
						</div>
					   @if(count($fav_list)>0)
						    
						   <div class="form">
						   @foreach($fav_list as $key=>$value)
						   
						  
						   
						   							<a href="{{url('/propertylist_detail')}}/{{$value->property->property_code}}">

							<div class="booking-house svisit-outer pd-hs-detail fav_{{$value->id}}" >
							
								<figure>
									@if(isset($value->property_images))
									<img src="{{ url('/') }}/{{$value->property_images->image}}" alt="house for booking" class="img_sch">
									
									@else
										
									<img src="{{ url('public/app_asset/images/booking-house-1.png') }}" alt="house for booking" class="img_sch">
									@endif
									
								</figure>
								<figcaption>
									
									<h2>@if(isset($value->property_details)){{$value->property_details->property_title}}@endif</h2>
									
									<h4><span class="icon-gps"></span>
									<?php $address_city=$address_sector="";
									if(isset($value->property_address->address_city))		
										{
											$city=App\City::where('id',$value->property_address->address_city)->first();				
											$address_city=$city->name;
										}
										if(isset($value->property_address->address_sector))
										{
											$address_sector=App\Sector::where('id',$value->property_address->address_sector)->first();
											$address_sector=$address_sector->slug;
										}						
										
										$address=$address_city.", ".$address_sector;
										echo $address;
										?>
									</h4>									

									
								</figcaption>
								<span  class="flat-del" id="pro_{{$value->id}}" data-value="{{$value->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i>
									</span>
							</div>
							</a>
						
						
						
						@endforeach	
							
					</div>		

						@endif
                        </div>
                    </div>
                </div>
            </div>       


        
		
        </section>

    </main>
	
</div>

@include('footer')



<!--        script-->

<script src="{{ url('app_asset/js/script.js') }}"></script>

<script src="{{ url('app_asset/js/jquery.floatit.js') }}"></script>
<script src="{{ url('app_asset/js/script.js') }}"></script>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
	$(document).on('click', '.edit_profile', function() {
		 $("#name").attr("readonly", false); 
		 $("#email").attr("readonly", false); 
		// $("#mobilenumber").attr("readonly", false); 
		  $(".radio_gender").attr("disabled", false); 
		
		 $(".image-upload").show();
		
		  $(".btn-info").show();
		  $('#occupantion').attr("disabled", false);
	});
	
	$("#image").change(function () {
    filePreview(this);
});


$('.submit_change_mobile').click(function() {
  $(".show_msg").hide(); 
 
  if($("#mobilenumber").val()){
   
    $.ajax({
       type: "POST",
       data:{"_token": "{{ csrf_token() }}","mobilenumber":$("#mobilenumber").val()},
       url: $(location).attr('origin') + '/change_mobile_otp_verify',

       success: function(msg){
        
         if(msg.code == 200){         
			$(".show_msg").hide(); 
			window.location.replace($(location).attr('origin') + '/change_mb_otp_verify/'+$("#mobilenumber").val());
  		   }
         else { 
           $(".show_msg").addClass("alert");    
		   $(".show_msg").addClass("error");		   
           $(".show_msg").show();
           $(".show_msg").html(msg.error);
         }
       }
    });
  }else { 
	$(".show_msg").addClass("error");
	$(".show_msg").removeClass("success");
    $('.show_msg').show();
	$(".show_msg").html("Please Enter mobile number" );
  }
});
$(".success").hide();$(".error").hide();

function filePreview(input) {
  if (input.files && input.files[0]) {
    var file = input.files[0];
    var fileType = file["type"];
    var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
    if ($.inArray(fileType, validImageTypes) < 0) {
      $(input).val('');
      $('#logo-preview').attr("src", $('.logo_custom:first').attr('src'));
      swal("Wrong Format", "", "error");
    }
    else {
      var reader = new FileReader();
      reader.onload = function (e) {
        if($('#logo-preview').length){
          $('#logo-preview').attr("src", e.target.result);
        }
        else {
          $('#broker_logo').after('<img class="navbar-brand choose-browser" id="logo-preview" src="'+e.target.result+'">');
        }
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
}


$(".nextBtn").click(function() {
  var nextDiv = $(this).parent().find(".step:visible").next(".step");
  if (nextDiv.length == 0) { // wrap around to beginning
    nextDiv = $(this).parent().find(".step:first");
  }
  $(this).parent().find(".step").hide();
  nextDiv.show();
});

$(".prevBtn").click(function() {
  var prevDiv = $(this).parent().find(".step:visible").prev(".step");
  if (prevDiv.length == 0) { // wrap around to end
    prevDiv = $(this).parent().find(".step:last");
  }
  $(this).parent().find(".step").hide();
  prevDiv.show();
});

$(".delete").click(function() {
	var id=$(this).data('value');
	event.preventDefault();
	$.get("{{url('delete_fav/')}}/"+id, function(data, status){
	$(".success").hide();$(".error").hide();
	  if(data.code=="200")
		{
			$(".success").show();	
			$( ".fav_"+id).remove();			
			$( ".fav_"+id).remove();			
			$(".success").html(data.success);			;
			$(".success").addClass('alert');
			
		}
		else
		{
			$('.cancel_visit_'+id).attr("disabled", false);
			$(".error").show();			
			$(".error").addClass('alert');
			$(".error").html(data.error);
		}
	   });
});
 $(document).on('click', '.rsvisit', function() {
			
			var id=$(this).data('id');
			var property_title=$(this).data('url');
			var property_address=$(this).data('value');
			$('.property_title').html(property_title);
			$('.property_address').html(property_address);
			$('#sh_id').val(id);
			
		});
$(".cancel_visit").click(function() {
	var id=$(this).data('value');
	event.preventDefault();
	$.get("{{url('cancel_visit/')}}/"+id, function(data, status){
	$(".success").hide();$(".error").hide();
	  if(data.code=="200")
		{
			$(".success").show();
			$('.cancel_visit_'+id).attr("disabled", true);
			$(".success").html(data.success);
			$(".visit_"+id).html('Visit Cancelled');
			$(".visit_"+id).addClass('req-cancle');
			$(".success").addClass('alert');
			$(".error").addClass('alert');
		}
		else
		{
			$('.cancel_visit_'+id).attr("disabled", false);
			$(".error").show();
			$(".error").html(data.error);
		}
	   });
});
</script>
<!--        script End -->
@endsection
