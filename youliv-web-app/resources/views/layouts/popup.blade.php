@if(Request::path() == 'propertylist')
<form class="banner-form loc-form" method="post" action="propertylist" id="search-form1">
@csrf
<div class="modal fade" id="apply_filter-modal" role="dialog">
    <div class="modal-dialog pd-modal">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="visit-header">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h2>Filters</h2>
            </div>
            <div class="filter-body">    
				<div class="select-form">
					<div class="div_apply-filters">
					<div class="gender_price">
						<select class="Fm" id="available_for" name="available_for">
							<option selected="true" disabled="disabled">Select Gender</option>
							<option value="property_available_men" @if($select_available_for=="property_available_men") selected=selected @endif>Male</option>
							<option value="property_available_women" @if($select_available_for=="property_available_women") selected=selected @endif>Female</option>
							<option value="property_available_family" @if($select_available_for=="property_available_family") selected=selected @endif>Family</option>
							<option value="property_available_unisex" @if($select_available_for=="property_available_unisex") selected=selected @endif>Unisex</option>

						</select>
					
						<select class="price" id="order" name="order">
							<option value="ASC" @if($order=="ASC") selected=selected @endif>Price low to high </option>
							<option value="DESC" @if($order=="DESC") selected=selected @endif>Price high to low </option>
						</select>          
					 </div>
					 <div class="cstm-checkbox food-av">
					 <label class="cstm--check">Food Available
							<input value="1" id="food_inclusive" name="food_inclusive" type="checkbox" @if($select_food_inclusive==1) checked=checked @endif>
							<span class="checkmark"></span>
						</label>
						<label class="cstm--check">Owner Free
							<input type="checkbox" id="owner_free" value="1" name="owner_free" @if($select_owner_free==1) checked=checked @endif>
							<span class="checkmark"></span>
						</label>
						<label class="cstm--check">AC
							<input type="checkbox" value="1" id="AC" name="AC" @if($select_ac==1) checked=checked @endif>
							<span class="checkmark"></span>
						</label>
					</div>
					<div class="fully" >
					<div class="semi">
						<div class="cstm-checkbox new-launch">
							<label class="cstm--check" >Fully Furnished
								<input type="checkbox" class="radio_input" value="3" name="fully_furnished" id="fully_furnished" @if($fully_furnished==3) checked=checked @endif>
								<span class="checkmark"></span>
							</label>
							 <label class="cstm--check" >Semi Furnished
								<input type="checkbox" class="radio_input" value="2"  name="semi_furnished" id="semi_furnished" @if($semi_furnished==2) checked=checked @endif>
								<span class="checkmark"></span>
							</label>
							 <label class="cstm--check">Unfurnished
								<input type="checkbox" class="radio_input"  value="1"  name="unfurnished" id="unfurnished" @if($unfurnished==1) checked=checked @endif>
								<span class="checkmark"></span>
							</label>
						</div>	
					</div>
					</div>
				   <div class="fully" >
					<div class="pg">
						<div class="cstm-checkbox new-launch">
							<label class="cstm--check">PG
								<input type="radio" value="2" name="property_type" class="radio_input" @if($select_property_type==2) checked=checked @endif>
								<span class="radio"></span>
							</label>
							 <label class="cstm--check">Flat
								<input type="radio" value="1" name="property_type" class="radio_input" @if($select_property_type==1) checked=checked @endif>
								<span class="radio"></span>
							</label>
							<!--
							 <label class="cstm--check">Flat/PG
								<input type="radio" value="3"  name="property_type" class="radio_input" @if($select_property_type==3) checked=checked @endif>
								<span class="radio"></span>
							</label>      
							-->					
							
						</div>
					</div>
					
					</div>
					<?php if($select_property_type==1) {$display1="none" ;$display="inline";} else { $display="none" ;$display1="inline";} ?>
					<div class="semi div_pg " style="display:{{$display}}">
						<div class="cstm-checkbox new-launch">
							<label class="cstm--check roomset" >Single Room
								<input type="checkbox" class="radio_input" value="1" name="single_room" id="single_room" @if($single_room==1) checked=checked @endif>
								<span class="checkmark"></span>
							</label>
							 <label class="cstm--check roomset" >Twin Sharing Room
								<input type="checkbox" class="radio_input" value="2"  name="twin_single_room" id="twin_single_room" @if($twin_single_room==2) checked=checked @endif>
								<span class="checkmark"></span>
							</label>
							 <label class="cstm--check roomset">Triple Sharing Room
								<input type="checkbox" class="radio_input"  value="3"  name="triple_single_room" id="triple_single_room" @if($triple_single_room==3) checked=checked @endif>
								<span class="checkmark"></span>
							</label>
							 <label class="cstm--check roomset">Others
								<input type="checkbox" class="radio_input"  value="4"  name="others_pg" id="others_pg" @if($others_pg==4) checked=checked @endif>
								<span class="checkmark"></span>
							</label>
						</div>	
					</div>
					<div class="semi div_flat" style="display:{{$display}}>
						<div class="cstm-checkbox new-launch">
							<label class="cstm--check roomset" >1 RK
								<input type="checkbox" class="radio_input" value="5" name="one_rk" id="one_rk" @if($one_rk==5) checked=checked @endif>
								<span class="checkmark"></span>
							</label>
							 <label class="cstm--check roomset" >One Room
								<input type="checkbox" class="radio_input" value="9"  name="one_room" id="one_room" @if($one_room==9) checked=checked @endif>
								<span class="checkmark roomset"></span>
							</label>
							 <label class="cstm--check roomset">Two Room
								<input type="checkbox" class="radio_input"  value="10"  name="two_room" id="two_room" @if($two_room==10) checked=checked @endif>
								<span class="checkmark"></span>
							</label>
							 <label class="cstm--check roomset">Three Room
								<input type="checkbox" class="radio_input"  value="13"  name="three_room" id="three_room" @if($three_room==13) checked=checked @endif>
								<span class="checkmark"></span>
							</label>
							 <label class="cstm--check roomset">1 BHK
								<input type="checkbox" class="radio_input"  value="6"  name="one_bhk" id="one_bhk" @if($one_bhk==6) checked=checked @endif>
								<span class="checkmark"></span>
							</label>
							 <label class="cstm--check roomset">2 BHK
								<input type="checkbox" class="radio_input"  value="7"  name="two_bhk" id="two_bhk" @if($two_bhk==7) checked=checked @endif>
								<span class="checkmark"></span>
							</label>
							 <label class="cstm--check roomset">3 BHK
								<input type="checkbox" class="radio_input"  value="14"  name="three_bhk" id="three_bhk" @if($three_bhk==14) checked=checked @endif>
								<span class="checkmark"></span>
							</label>
							 <label class="cstm--check roomset">4 BHK
								<input type="checkbox" class="radio_input"  value="15"  name="four_bhk" id="four_bhk" @if($four_bhk==15) checked=checked @endif>
								<span class="checkmark"></span>
							</label>
							 <label class="cstm--check roomset">Others
								<input type="checkbox" class="radio_input"  value="8"  name="others_flat" id="others_flat" @if($others_flat==8) checked=checked @endif>
								<span class="checkmark"></span>
							</label>
						</div>	
					</div>
					<div class="label_price">Price Range : </div>
					<div class="form-price-range-filter">
									<input type="input" id="min" name="min_price" value="{{$select_range_start}}">
									<label class="label_price"> Min</label>
									<div id="slider-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" style="width: 50%;">
									<div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%;">
									</div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span></div>
									<label class="label_price">Max</label>
									<input type="input" id="max" name="max_price" value="{{$select_range_end}}">
					</div>
					</div>
					</div>
					 <input type="hidden" name="city_filter" id="city_filter" class="form-control" value="{{$select_city}}">
					 <input type="hidden" name="latitude" id="latitude" class="form-control" value="{{$latitude}}">
					 <input type="hidden" name="autocomplete_fill" id="autocomplete_fill" class="form-control" value="{{$latitude}}">
					<input type="hidden" name="longitude" id="longitude" class="form-control" value="{{$longitude}}">
					 @if($select_property_type!="" || $semi_furnished!="" || $fully_furnished!="" || $unfurnished!="" || $select_owner_free!="" || $select_ac!="" || $select_food_inclusive!="" || $select_available_for!="" ) <?php $display="inline"; ?>  @else <?php $display="none" ;?> @endif
						<div class="filter-btn-primary">
						<button type="submit" class="btn btn-primary apply-filter" id="apply_filter" name="apply_filter" value="apply_filter" style="display:{{$display}}">Apply Filter</button>
						<button type="submit" class="btn btn-primary apply-filter clear_filter" id="clear_filter" name="clear_filter" value="clear_filter" style="display:{{$display}}">Clear Filter</button>
						</div>
      </div>
    </div>

  </div>
</form>
@endif
<!--        visit-modal ends-->
<!-- Modal -->
<div class="modal fade" id="req-call-modal" role="dialog">
  <div class="modal-dialog pd-modal">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="visit-header">
        <button type="button" class="close" data-dismiss="modal">X</button>
        <h2>Request for a call</h2>
      </div>
      <div class="visit-body">
        <h3>Our promise We will get back to you within 24-48 hrs. Don't worry we will never spam you</h3>
       
 <div class="show_msg_request"></div>
	 <form id="request_a_call_form" method="post">
		<div class="form-group">
		<input type="text" placeholder="Name" class="form-control" id="request_name" name="request_name" required>
		</div>
		<div class="form-group">
		<input type="number" placeholder="Phone Number" class="form-control" id="request_phone" name="request_phone" required>
		</div>
		<button type="submit" class="btn logform-btn request_for_call"><span>submit</span></button>


	</form>
      </div>
    </div>

  </div>
</div>
<!--        visit-modal ends-->

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="visit-modal" role="dialog">
    <div class="modal-dialog pd-modal">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="visit-header">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h2>Schedule a Visit</h2>
            </div>
            <div class="visit-body">
                <h2><span class="property_title"> </span></h2>
                <p><span class="icon-gps"></span><span class="property_address"> </span> </p>
                <h3>When do you want to visit the property?</h3>
                <form method="post" action="{{url('request_for_schedule')}}" id="schedule_form">
				@csrf
                    <div class="form-group cal">
					 <div class="input-group">
					 <input id="sh_date" name="sh_date" type="text" class="form-control" readonly="readonly" data-error="#errNm1"/>
					
						  <label class="input-group-addon"  for="sh_date"><span class="icon-calendar"></span></label>
						</div>
                        
                          	<span id="errNm1"></span>
                        
                    </div>
               
					 <input id="property_id" name="property_id" type="hidden" class="form-control"  />
					<input id="sh_id" name="sh_id" type="hidden" class="form-control" />
                <h3>Select the timeslot which suits the best for you.</h3>
                <ul>
                    <li><a href="javascript:void(0);" class="sh_time" data-value="9-10">9am-10am</a></li>
                    <li><a href="javascript:void(0);" class="sh_time" data-value="10-11">10am-11am</a></li>
                    <li><a href="javascript:void(0);" class="sh_time" data-value="11-00">11am-12pm</a></li>
                    <li><a href="javascript:void(0);" class="sh_time" data-value="00-13">12pm-1pm</a></li>
                    <li><a href="javascript:void(0);" class="sh_time" data-value="13-14">1pm-2pm</a></li>
                    <li><a href="javascript:void(0);" class="sh_time" data-value="14-15">2pm-3pm</a></li>
                    <li><a href="javascript:void(0);" class="sh_time" data-value="15-16">3pm-4pm</a></li>
                    <li><a href="javascript:void(0);" class="sh_time" data-value="16-17">4pm-5pm</a></li>
                    <li><a href="javascript:void(0);" class="sh_time" data-value="17-18">5pm-6pm</a></li>
                    <li><a href="javascript:void(0);" class="sh_time" data-value="18-19">6pm-7pm</a></li>
                    <li><a href="javascript:void(0);" class="sh_time" data-value="19-20" >7pm-8pm</a></li>
                </ul>
				
				<input id="sh_time" name="sh_time" type="hidden" class="form-control"  data-error="#errNm2" />
				<span id="errNm2"></span>
                <button type="submit" class="btn logform-btn"><span>Schedule</span></button>
				</form>
            </div>
        </div>

    </div>
</div>
<!--        visit-modal ends-->
	<!-- Modal -->
<div class="modal fade" id="change_phone" role="dialog">
    <div class="modal-dialog pd-modal">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="visit-header">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h2>Change Mobile Number</h2>
            </div>
            <div class="visit-body">                
                
				
                    <div class="form-group cal">
					 <input id="mobilenumber" name="mobilenumber" required type="text" class="form-control"  placeholder="Enter new mobile number" />
					</div>
					<button type="submit" class="btn btn-info submit_change_mobile"><span>Change</span></button>
					<div class="show_msg "></div>
				
            </div>
        </div>

    </div>
</div>
<!--        visit-modal ends-->
<!--        book-modal starts-->
<div class="modal fade" id="booknow-modal" role="dialog">
    <div class="modal-dialog pd-modal">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="visit-header booknow-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h2>Book your YouLiv</h2>
            </div>
            <div class="visit-body booknow-body">
                <h2>YOULIV Tokyo House</h2>
                <p><span class="icon-gps"></span> Plot No. 89, 2nd Floor, JLPL Industrial Area, Sector 82, Mohali, Punjab 140306 </p>
                <h3>When do you want to Join?</h3>
                <form>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" placeholder="Moving Date" class="form-control">
                            <span class="input-group-addon"><span class="icon-calendar"></span></span>
                        </div>
                    </div>
                </form>
                <h3>Select the timeslot.</h3>
                <ul class="time-sl">
                    <li><a href="javascript:void(0);">9am-10am</a></li>
                    <li><a href="javascript:void(0);">10am-11am</a></li>
                    <li><a href="javascript:void(0);">11am-12pm</a></li>
                    <li><a href="javascript:void(0);">12pm-1pm</a></li>
                </ul>
                <h3>Select the Room type which suits the best for you.</h3>
                <div class="pd-price">
                    <ul>
                        <li>
                            <figure>
                                <img src="{{ url('public/app_asset/images/single-bed.png') }}" alt="single">
                            </figure>
                            <figcaption>
                                <div class="book-content">
                                    <h2>Single Occupancy</h2>
                                    <p><span>?14,000</span> bed / month</p>
                                </div>
                                <a href="javascript:void(0);" class="select-room selected">Selected</a>
                            </figcaption>
                        </li>
                        <li>
                            <figure>
                                <img src="{{ url('public/app_asset/images/2-bed.png') }}" alt="double bed">
                            </figure>
                            <figcaption>
                                <div class="book-content">
                                    <h2>Double Occupancy</h2>
                                    <p> <span>?8,000</span> bed / month</p>
                                </div>
                                <a href="javascript:void(0);" class="select-room">Select</a>
                            </figcaption>
                        </li>
                        <li>
                            <figure>
                                <img src="{{ url('public/app_asset/images/3bed.png') }}" alt="3 beds">
                            </figure>
                            <figcaption>
                                <div class="book-content">
                                    <h2>Triple Occupancy</h2>
                                    <p><span>?4,000</span> bed / month</p>
                                </div>
                                <a href="javascript:void(0);" class="select-room">Select</a>
                            </figcaption>
                        </li>
                    </ul>
                </div>
                <button type="submit" class="btn logform-btn" data-toggle="modal" data-target="#subscription-modal"><span>Next</span></button>
            </div>
        </div>

    </div>
</div>
<!--        book-modal ends-->

<!--        subscription-modal starts-->

<div class="modal fade" id="subscription-modal" role="dialog">
    <div class="modal-dialog pd-modal">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="visit-header booknow-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h2>Book your YouLiv</h2>
            </div>
            <div class="visit-body subscription-sec">
                <div class="sec-heading">
                    <h2><span>YouLiv..</span> Subscription </h2>
                </div>
                <div class="choose-occupy">
                    <h1>Choose the right plan for <span>Single Occupancy</span> bed</h1>
                    <ul>
                        <li>
                            <div class="monthly-pay-price">
                                <h2>Monthly</h2>
                                <div class="monthly-main">
                                    <h1>?14,000</h1>
                                    <p>/ bed</p>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do magna aliqua.</p>
                                <div class="co-slider-btn">
                                    <a href="javascript:void(0);" class="now-book">Get Started</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="monthly-pay-price">
                                <h2>6 Month</h2>
                                <div class="monthly-main">
                                    <h1>?84,000</h1>
                                    <p>/ bed</p>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do magna aliqua.</p>
                                <div class="co-slider-btn">
                                    <a href="javascript:void(0);" class="now-book">Get Started</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="monthly-pay-price month-popular-price">
                                <h2>6 Month</h2>
                                <div class="monthly-main">
                                    <h1>?84,000</h1>
                                    <p>/ bed</p>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do magna aliqua.</p>
                                <div class="co-slider-btn">
                                    <a href="javascript:void(0);" class="now-book">Book Now</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>


                <button type="submit" class="btn logform-btn"><span>Book Now</span></button>
            </div>
        </div>

    </div>
</div>

<script>
  $(document).ready(function(){
	  
	  $('#schedule_form').validate({
	  errorElement: 'div',
	  ignore: [],
		messages: {
			sh_date: { required: "Please select date" },
            sh_time: { required: "Please select time"},
			
		},
	 errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    },

	  rules: {
		'sh_date':{
		  required : true,		 
		},
		'sh_time':{
		  required : true,		
		}
	  },
	});
	  
	  
	  
	  
 $("#request_a_call_form").submit(function(e) {    e.preventDefault(); }).validate({
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
             request_phone: {
                 required: true,
                 minlength: 10,
				 number: true,
				 maxlength: 10
             },
             request_name: {
                 required: true,
                 maxlength: 50
             }
         },
         submitHandler: function (form) {
/*
		  $(".show_msg_request").hide(); 
		  flag=false;
		  
		   if($("#request_phone").val()=="" || $("#request_name").val()=="")
		   {
			   $(".show_msg_request").addClass("alert");    
				$(".show_msg_request").addClass("error");
				$(".show_msg_request").show();	
				$(".show_msg_request").html('Please fill your Phone number and Name for request');
			   flag=false;
		   }
		   else
		   {
			   $(".show_msg_request").hide();	
			   flag=true;
		   }
   
	   if(flag)
	   {*/
		$.ajax({
		   type: "POST",
		   data:{"_token": "{{ csrf_token() }}","request_phone":$("#request_phone").val(),"request_name":$("#request_name").val()},
		   url: $(location).attr('origin') + '/request_for_call',

		   success: function(msg){
			$(".show_msg_request").show();	
			
			 if(msg.code == 200){         
					$(".show_msg_request").addClass("alert");    
					$(".show_msg_request").addClass("success");	
					$(".show_msg_request").removeClass("error");
					 $(".show_msg_request").html(msg.success);
			   }
			 else { 
					$(".show_msg_request").addClass("alert");    
					$(".show_msg_request").addClass("error");
					$(".show_msg_request").removeClass("success");	
					$(".show_msg_request").html(msg.error);				
					
			 }
			 
		  } 
		});return false;
	  /* }*/
		 }
});
});
 $(document).on('click', '.red-like', function() {
        var value = $(this).data('value');
		var id =  "pro_"+value;
		alert(id);
		$.ajax({
       type: "POST",
       data:{"_token": "{{ csrf_token() }}","id":value},
       url: $(location).attr('origin') + '/delete_favorite',

       success: function(msg){
        $(".show_msg_request").show();	
		
         if(msg.code == 200){   
      
				$('#'+id).addClass("favorite");
				$('#'+id).removeClass("red-like");	
  		   }

       }
    });
  });
 $(document).on('click', '.favorite', function() {
       var value = $(this).data('value');
		var id =  "pro_"+value;
		
		$.ajax({
       type: "POST",
       data:{"_token": "{{ csrf_token() }}","id":value},
       url: $(location).attr('origin') + '/add_favorite',

       success: function(msg){
        $(".show_msg_request").show();	
		
         if(msg.code == 200){         
				window.location.href = $(location).attr('origin') + '/login';
  		   }

         else { 
			$('#'+id).addClass("red-like");
			$('#'+id).removeClass("favorite");	
				//window.location.href = $(location).attr('origin') + '/propertylist_detail/'+msg.id;			
				
         }
       }
    });
  });
 $(document).on('click', '.sh_time', function() {		
	
	var time_sh=$(this).data('value');
	$('#sh_time').val(time_sh);
	$(".sh_time").not($(this)).removeClass('time_selected');
		$(this).addClass('time_selected');
	});
	
	 $(document).on('click', '.visit-book', function() {			
			var property_id=$(this).data('id');
			var property_title=$(this).data('url');
			var property_address=$(this).data('value');
			$('.property_title').html(property_title);
			$('.property_address').html(property_address);
			$('#property_id').val(property_id);
			
		});
</script>