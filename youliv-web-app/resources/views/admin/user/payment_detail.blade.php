@extends('admin.dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="fade-in">
        <form class="form-horizontal" id="payment_methods" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Mode Of Payment</strong>
                        </div>
						<div>
						@if(Session::has('message'))
						<p class="alert_owner alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
						@endif
					</div>
                        <div class="card-body ad-card">
                            <div class=" row">
                                <div class="col-md-6">
                                    <select class="form-control" id="select_payment" name="select_payment">
                                        <option selected="true" disabled="disabled" value="">Mode Of Payment</option>
                                        <option value="1" {{ (old('select_payment')== 1) || ($owner_pay->payment_type==1) ? 'selected' : ''  }}>Bank Transfer</option>
                                        <option value="2" {{ (old('select_payment')== 2 )|| ($owner_pay->payment_type==2) ? 'selected' : ''  }}>UPI</option>

                                    </select>
                                    @error('area_manager_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- /Start General Owner Details-->
        <div class="row" id='bank_div'>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong><span class="payment_type">@if($owner_pay->payment_type==1) Bank @else  UPI @endif </span> details(Owner) - {{$owner_pay->owner->owner_name}}({{$owner_pay->owner->owner_number}})</strong>
                    </div>
					
                    <div class="card-body general-card">
                        <div class=" row">
                            <div class="col-md-6">
                                <label for="account_holder_name" class="label">Account Holder Name</label>
                                <span class="required">*</span>
                                <input class="form-control" id="account_holder_name" type="text" name="account_holder_name" placeholder="Enter Account Holder Name" value="{{old('account_holder_name',$owner_pay->name ?? '')}}">
                                @error('account_holder_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <p class="alert alert-danger" style="display:none" id ="name_match"  value="nomatch">It seems account holder name dosen't match with property owner name.Please attach authority letter.</p>
								<p class="alert alert-danger" style="display:none" id ="name_match_same_old"  value="nomatch">It seems account holder name dosen't match with saved account holder name.Please attach authority letter.</p>
                                <input type="hidden" id="name_mat" name = "name_match" value="">
								 <input type="hidden" id="account_holder_name_old" name = "account_holder_name_old" value="{{$owner_pay->name ?? ''}}">
                                <input type="hidden" id="property_ownerName" value="{{$owner_pay->owner->owner_name}}">
                            </div>

                            <div class="col-md-6">
                                <label for="mobile_number" class="label">Mobile Number</label>
                                <span class="required">*</span>
                                <input class="form-control" id="mobile_number" type="number" name="mobile_number" placeholder="Enter Mobile Number" value="{{old('mobile_number',$owner_pay->mobile_number ?? '')}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10">
                                @error('mobile_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mt-3 account_number">
                                <label for="account_number" class="label">Account Number</label>
                                <span class="required">*</span>
                                <input class="form-control" id="account_number" type="number" name="account_number" placeholder="Enter Account Number" value="{{old('account_number',$owner_pay->account_number ?? '')}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "16">
                                @error('account_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mt-3 c_account_number">
                                <label for="c_account_number" class="label">Confirm Account Number</label>
                                <span class="required">*</span>
                                <input class="form-control" id="c_account_number" type="number" name="c_account_number" placeholder="Confirm account Number" value="{{old('c_account_number',$owner_pay->account_number ?? '')}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "16">
                                @error('c_account_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mt-3 ifsc">
                                <label for="ifsc" class="label">IFSC Code</label>
                                <span class="required">*</span>
                                <input class="form-control" id="ifsc" type="text" name="ifsc" placeholder="Enter IFSC Number" value="{{old('ifsc',$owner_pay->ifsc ?? '')}}">
                                @error('ifsc')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-3 bank_name">
                                <label for="bank_name" class="label">Bank Name</label>
                                <span class="required">*</span>
                                <input class="form-control" id="bank_name" type="text" name="bank_name" placeholder="Enter Bank Name" value="{{old('bank_name',$owner_pay->bank_name ?? '')}}">
                                @error('bank_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
							<div class="col-md-6 mt-3 upi_id_owner">
                                <label for="upi_id_owner" class="label">UPI ID</label>
                                <span class="required">*</span>
                                <input class="form-control" id="upi_id_owner" type="text" name="upi_id_owner" placeholder="Enter UPI ID" value="{{old('upi_id_owner',$owner_pay->upi_id ?? '')}}">
                                @error('upi_id_owner')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mt-3" id="authority_file">

                                <label for="authority_file">Attach Authority letter</label>
                                <input type="file" name="authority_file" id="authority_files" class="authority_file" value="{{old('authority_file')}}">
								<input type="hidden" name="authority_file_data" id="authority_file_data" value="{{old('authority_file',$owner_pay->authority_file ?? '')}}">
                                @error('authority_file')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="row">
						    <div class="col-md-12 mt-3"><input value="" name="approved" @if($owner_pay->approved==1) checked @endif type="checkbox"  id="approved" /> Approved </div>
								<div class="col-md-12 mt-3"><input value="" name="bank_term_condition" checked type="checkbox" value="{{old('bank_term_condition')}}" id="bank_term_condition" /> I accept the Terms & Conditions </div>
                            <div class="col-md-6 mt-3">
                                <button id="submit-all" class="btn btn-primary-custom" type="submit">Submit</button>
                            </div>
                        </div>
						@if($owner_pay->authority_file!="")
						<div class="row">
							<div class="col-md-12 mt-3">
							 <figure data-toggle="modal">
								<a href="{{ url('') }}/{{$owner_pay->authority_file}}" target="_blank" ><img src="{{ url('')}}/{{$owner_pay->authority_file}}" alt="address proof"></a>
							</figure>
							</div>
						</div>
						@endif
						
                    </div>
                </div>
            </div>
        </div>
        <!-- /End General Owner Details ends-->

</form>

    </div>
</div>
<script>
 
$(document).ready(function(){
		$('#payment_methods').validate({
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
			'account_holder_name':{
			  required : true,
			  authority_letter : true,
			},
			'mobile_number':{
			  required : true,
			  number:true,
			  minlength:10,
			  maxlength:12
			  
			},
			'account_number':{
			  required : true,
			},
			'c_account_number':{
			  required : true,
			  equalTo : '[name="account_number"]'
			},
			'bank_name':{
			  required : true,
			},
			'ifsc':{
			  required : true,
			},
			'upi_id_owner':{
			  required : true,
			}
			,
			'name_match':{
			  authority : true,
			}
		  }
		});
		jQuery.validator.addMethod("authority", function(value, element){
			if ($('#name_mat').val()==0) {
				
				return false;  // FAIL validation when REGEX matches
			} else {
				return true;   // PASS validation otherwise
			};
		}, "Please Attach Authority letter"); 
		
		jQuery.validator.addMethod("authority_letter", function(value, element){
			if ($('#account_holder_name').val()!=$('#property_ownerName').val()) {
				
				if($('#authority_file_data').val()=="")
				{
					$('#authority_file').show(500);
					$('#name_mat').val(0);
					$('#name_match').show(500);
					$('#name_match_same_old').hide(500);
					return false; 
				}
				else if($('#account_holder_name_old').val()!=$('#account_holder_name').val() && $('#account_holder_name_old').val()!="")
				{
					if($('#property_ownerName').val()==$('#account_holder_name').val())
					{
						return true; 
					}
					else
					{
						if($('#authority_files').val()!="")
						{
							return true; 
						}else{
						$('#authority_file').show(500);
						$('#name_match_same_old').show(500);
						$('#name_match').hide(500);
						return false; 
						}
					}
				}
				else
				{
					$('#authority_file').hide(500);
					$('#name_mat').val(1);
					$('#name_match').hide(500);
					$('#name_match_same_old').hide(500);
					return true; 
				}
				 // FAIL validation when REGEX matches
			} else {
				return true;   // PASS validation otherwise
			};
		}, ""); 
	  $('#authority_file').on('change', function() {
		  $('#authority_file_data').val('yes');
	  });
		 $('#bank_term_condition').on('click', function() {
			  if ($(this).is(':checked')) {
            
			$('#submit-all').removeAttr('disabled');
        } else {
            $('#submit-all').attr('disabled', 'disabled');
        }
		 });
		$('#approved').on('click', function() {
			  if ($(this).is(':checked')) {
            
			$('#approved').val(1);
        } else {
            $('#approved').val(0);
        }
		 });
        $('#select_payment').on('change', function() {
		$("#bank_div").show();
        if ( this.value == '1')
        {            
         
			$('.upi_id_owner').hide();	
            $('.account_holder_name').show();            
            $('.account_number').show();
            $('.c_account_number').show();
            $('.ifsc').show();
            $('.bank_name').show(); 
			$(".payment_type").html('Bank');
        }
        else
        {       
			$('.upi_id_owner').show();	
            $('.account_holder_name').hide();            
            $('.account_number').hide();
            $('.c_account_number').hide();
            $('.ifsc').hide();
            $('.bank_name').hide(); 
			$(".payment_type").html('UIP');
        }
        })
    });

    $(function() {

        if($('#select_payment').val() == 1){
           $('.upi_id_owner').hide();	
            $('.account_holder_name').show();            
            $('.account_number').show();
            $('.c_account_number').show();
            $('.ifsc').show();
            $('.bank_name').show(); 
			$(".payment_type").html('Bank');

        }else if($('#select_payment').val() == 2){
           $('.upi_id_owner').show();	
            $('.account_holder_name').hide();            
            $('.account_number').hide();
            $('.c_account_number').hide();
            $('.ifsc').hide();
            $('.bank_name').hide(); 
			$(".payment_type").html('UIP');
        }else{
            $("#upi_div").hide();
            $("#bank_div").hide();
			//$(".payment_type").html('UIP');
        }


        $('#upi_match').hide();
        $('#name_match').hide();
        $('#authority_file').hide();
        $('#upi_authority_file').hide();
        $('#upi_authority_file').val(null);

        
        //match value on focusout
		/*
        $('#account_holder_name').focusout(function(){
            accountHolderName  = $(this).val();
            propertyOwnerName  = $('#property_ownerName').val();
            if(accountHolderName == propertyOwnerName){
                $('#name_match').hide(500);
                $('.authority_file').val(null);
                $('#authority_file').hide(500);
                $('#name_mat').val('1');
            }else{
               $('#name_match').show(500);
               $('#authority_file').show(500);
               $('#name_mat').val('0');
            }

        });*/


    });


</script>
<style>
.error{
	color:red;
}
</style>
@endsection
