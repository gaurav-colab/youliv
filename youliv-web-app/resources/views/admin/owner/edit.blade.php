@extends('admin.dashboard.base')

@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">
    <div class="fade-in">
        <div class="bs-example">
            <div class="accordion" id="accordionExample">
            <!-- /Start General Owner Details-->
                <div class="card">
                    <div class="card-header" id="headingOne">                        
                           <i class="fa fa-plus"></i> Edit General details(Owner)
                    </div>
                    <div id="collapseOne" >
                        <div class="card-body">
                            <form class="form-horizontal" id="ownerForm" enctype="multipart/form-data" method="POST">
                                @csrf
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
                                <div class="form-group row">

                                    <div class="col-md-4">
                                        <label for="owner_name" class="label">Owner name</label>
                                        <span class="required">*</span>
                                        <input class="form-control" id="owner_name" type="text" name="owner_name" placeholder="Enter owner name" value="{{old('owner_name',$owner_detail->owner_name ?? '')}}">

                                        @error('owner_name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror

                                    </div>

                                        <div class="col-md-4">
                                            <label for="owner_number" class="label">Owner Contact Number</label>
                                            <span class="required">*</span>
                                            <input class="form-control" id="owner_number" type="number" name="owner_number" minlength = "10" placeholder="Enter Contact Number" value="{{old('owner_number',$owner_detail->owner_number ?? '')}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10">

                                            @error('owner_number')
                                                <div class="error">{{ $message }}</div>
                                            @enderror

                                        </div>

                                        <div class="col-md-4">
                                            <label for="alernate_number" class="label">Alternate Contact Number(Optional)</label>
                                            <input class="form-control" id="alernate_number" type="number" name="alernate_number" placeholder="Enter Contact Number" value="{{old('alernate_number',$owner_detail->alernate_number ?? '')}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10">

                                            @error('alernate_number')
                                                <div class="error">{{ $message }}</div>
                                            @enderror

                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <label for="owner_email" class="label">Owner Email Address (Optional)</label>
                                            <input class="form-control" id="owner_email" type="email" name="owner_email" placeholder="Enter Email Address" value="{{old('owner_email',$owner_detail->owner_email ?? '')}}">

                                            @error('owner_email')
                                            <div class="error">{{ $message }}</div>
                                            @enderror

                                        </div>

                                        

                                        <div class="col-md-4 mt-3">
                                            <label for="property_owner_id_drop" class="label">Owner Id Proof</label>
                                           
                                            <select name="property_owner_id_drop" id="property_owner_id_drop" class="form-control">
                                                <option selected="true" disabled="disabled">Select Id Proof</option>
                                                <option value="1" @if($owner_detail->property_owner_id_drop==1) selected=selected @endif>Aadhar Card</option>
                                                <option value="2" @if($owner_detail->property_owner_id_drop==2) selected=selected @endif>Driving License</option>
                                                <option value="3" @if($owner_detail->property_owner_id_drop==3) selected=selected @endif>Passport</option>
                                                <option value="4" @if($owner_detail->property_owner_id_drop==4) selected=selected @endif>Voter Id</option>
                                            </select>

                                            @error('property_owner_id_drop')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <label for="property_owner_id_front" class="label">IdentityProof - FrontSide</label>
                                            
                                            <input class="form-control" id="property_owner_id_front" type="file" name="property_owner_id_front" placeholder="" accept="image/jpeg,image/jpg,image/png" value="{{old('property_owner_id_front')}}" >

                                            @error('property_owner_id_front')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <label for="property_owner_id_back" class="label">IdentityProof - ReverseSide</label>
                                            
                                            <input class="form-control" id="property_owner_id_back" type="file" name="property_owner_id_back" placeholder="" accept="image/jpeg,image/jpg,image/png" value="{{old('property_owner_id_back')}}" >

                                            @error('property_owner_id_back')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <label class="label">GST Number (optional)</label>
                                            <input class="form-control" id="property_gst" type="text" name="property_gst" value="{{old('property_gst',$owner_detail->property_gst ?? '')}}">

                                            @error('property_gst')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>


                                       
                                        <div class="col-md-12 mt-12"><br>
                                            <button id="submit-owner-all" class="btn btn-primary-custom">Submit</button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <input type="hidden" name="ownerId" id="ownerId" value="">                  
                    </div>
                </div>
            </div>
        </div>





<!--address modal-->
<div class="modal fade" id="addres-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       	<img src="{{ url('') }}/{{$owner_detail->lease_deed}}" alt="address proof" width="70%">
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
      <img src="{{ url('')}}/{{ $owner_detail->property_owner_id_front }}" alt="proof front" width="70%">
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
        <img src="{{ url('')}}/{{ $owner_detail->property_owner_id_back }}" alt="proof back" width="70%">
      </div>
    </div>
  </div
</div>



<!--diff-proof-modal-->
<div class="modal fade" id="digil-sign-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <img id="digital-sign" src="{{url('')}}/{{ $owner_detail->digital_signature }}" alt="digital Signature" width=300>
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
});
</script>


@endsection


