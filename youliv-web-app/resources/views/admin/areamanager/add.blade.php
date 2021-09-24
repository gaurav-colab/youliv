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
                       
                          <i class="fa fa-plus"></i> Add Area Manager Detail
                     						
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

                                    <div class="col-md-6">
                                        <label for="name" class="label">Name</label>
                                        <span class="required">*</span>
                                        <input class="form-control" id="name" type="text" name="name" placeholder="Enter name" value="{{old('name')}}">

                                        @error('name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror

                                    </div>

                                        <div class="col-md-6">
                                            <label for="phone" class="label">Contact Number</label>
                                            <span class="required">*</span>
                                            <input class="form-control" id="phone" type="number" name="phone" minlength = "10" placeholder="Enter Contact Number" value="{{old('phone')}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10">

                                            @error('phone')
                                                <div class="error">{{ $message }}</div>
                                            @enderror

                                        </div>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<label for="email" class="label">Email Address (username)</label>
									<span class="required">*</span>
									<input class="form-control" id="email" type="email" name="email" placeholder="Enter Email Address" value="{{old('email')}}">

									@error('email')
									<div class="error">{{ $message }}</div>
									@enderror

								</div>
								 <div class="col-md-6">
									<label for="password" class="label">Password</label>
									<span class="required">*</span>
									<input class="form-control" id="password" type="password" name="password" placeholder="Enter Password" value="">

									@error('password')
									<div class="error">{{ $message }}</div>
									@enderror

								</div>
								
                            </div>
							<div class="form-group row">
								<div class="col-md-6">
									<label for="emp_code" class="label">Employee Code</label>
									<span class="required">*</span>
									<input class="form-control" id="emp_code" type="text" name="emp_code" placeholder="Enter Employee Code" value="{{old('email')}}">

									@error('emp_code')
									<div class="error">{{ $message }}</div>
									@enderror

								</div>
								 <div class="col-md-6">
									<label for="doj" class="label">Date Of Joining</label>
									<span class="required">*</span>
									<input class="form-control" id="doj" type="date" name="doj" placeholder="Enter Date Of Joining" value="{{old('doj')}}">

									@error('doj')
									<div class="error">{{ $message }}</div>
									@enderror

								</div>								
                            </div>
							<div class="form-group row">
								<div class="col-md-6">
									<label for="p_address" class="label">Permanent Address</label>
									<span class="required">*</span>
									<textarea class="form-control" id="p_address"  name="p_address" placeholder="Enter Permanent Address" value="">{{old('p_address')}}</textarea>

									@error('p_address')
									<div class="error">{{ $message }}</div>
									@enderror

								</div>
								 <div class="col-md-6">
									<label for="c_address" class="label">Current Address</label>
									<span class="required">*</span>
									<textarea class="form-control" id="c_address"  name="c_address" placeholder="Enter Current Address">{{old('c_address')}}</textarea>

									@error('c_address')
									<div class="error">{{ $message }}</div>
									@enderror

								</div>								
                            </div>
							 <div class="form-group row">

                                    <div class="col-md-12">
                                         <label for="property_owner_id_drop" class="label">Upload Pan Card</label>
                                           
                                    </div>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<label for="pan_front" class="label">IdentityProof - FrontSide</label>

									<input class="form-control" id="pan_front" type="file" name="pan_front" placeholder="" accept="image/jpeg,image/jpg,image/png" value="{{old('property_owner_id_front')}}" >

									@error('pan_front')
									<div class="error">{{ $message }}</div>
									@enderror
									<span class="error pan_front" ></span>
								</div>
								<div class="col-md-6">
									<label for="pan_back" class="label">IdentityProof - ReverseSide</label>

									<input class="form-control" id="pan_back" type="file" name="pan_back" placeholder="" accept="image/jpeg,image/jpg,image/png" value="{{old('property_owner_id_back')}}" >

									@error('pan_back')
									<div class="error">{{ $message }}</div>
									@enderror
									<span class="error pan_back" ></span>
								</div>
							</div> <div class="form-group row">

                                    <div class="col-md-12">
                                         <label for="property_owner_id_drop" class="label">Upload Adhar Card</label>
                                           
                                    </div>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<label for="adhar_front" class="label">Adhar Card - FrontSide</label>

									<input class="form-control" id="adhar_front" type="file" name="adhar_front" placeholder="" accept="image/jpeg,image/jpg,image/png" value="{{old('property_owner_id_front')}}" >

									@error('adhar_front')
									<div class="error">{{ $message }}</div>
									@enderror
									<span class="error adhar_front" ></span>
								</div>
								<div class="col-md-6">
									<label for="adhar_back" class="label">Adhar Card - ReverseSide</label>

									<input class="form-control" id="adhar_back" type="file" name="adhar_back" placeholder="" accept="image/jpeg,image/jpg,image/png" value="{{old('property_owner_id_back')}}" >

									@error('adhar_back')
									<div class="error">{{ $message }}</div>
									@enderror
									<span class="error adhar_back" ></span>
								</div>
							</div>
							<div class="col-md-3 mt-3">
									<button id="submit-owner-all" class="btn btn-primary-custom">Submit</button>
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
		'name':{
		  required : true,
		},
		'email':{
		  required : true,
		},
		'phone':{
		  required : true,
		  
		},
		'password':{
		  required : true,
		  
		},
		'emp_code':{
		  required : true,
		  
		},
		'doj':{
		  required : true,
		  
		},
		'pan_back':{
		  required : true,
		  
		},
		'pan_front':{
		  required : true,
		  
		},
		'adhar_back':{
		  required : true,		  
		},
		'adhar_front':{
		  required : true,		  
		}
	  }
	});
});
</script>


@endsection


