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
                           <i class="fa fa-plus"></i> Edit User
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
                                        <label for="name" class="label">Name</label>
                                        <span class="required">*</span>
                                        <input class="form-control" id="name" type="text" name="name" placeholder="Enter user name" value="{{old('name',$user->name ?? '')}}">

                                        @error('name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror

                                    </div>

                                        <div class="col-md-4">
                                            <label for="mobilenumber" class="label">Contact Number</label>
                                            <span class="required">*</span>
                                            <input class="form-control" id="mobilenumber" type="number" name="mobilenumber" minlength = "10" placeholder="Enter Contact Number" value="{{old('mobilenumber',$user->mobilenumber ?? '')}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10">

                                            @error('mobilenumber')
                                                <div class="error">{{ $message }}</div>
                                            @enderror

                                        </div>

                                        <div class="col-md-4">
                                            <label for="email" class="label">Email</label>
											 <span class="required">*</span>
                                            <input class="form-control" id="email" type="email" name="email" placeholder="Enter email" value="{{old('email',$user->email ?? '')}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "200">

                                            @error('email')
                                                <div class="error">{{ $message }}</div>
                                            @enderror

                                        </div>
										</div>
										<div class="form-group row">
										 <div class="col-md-4">
                                            <label for="occupantion" class="label">Occupantion </label>
                                            <span class="required">*</span>
                                            <select id="occupantion" name="occupantion" class="form-control" >
													<option value="1" @if($user->occupantion==1 || old('occupantion')==1) selected=selected @endif >Student</option>
													<option value="2" @if($user->occupantion==2 || old('occupantion')==2) selected=selected @endif >Govt Employee</option>
													<option value="3" @if($user->occupantion==3 || old('occupantion')==3) selected=selected @endif >Private Job</option>
													<option value="4" @if($user->occupantion==4 || old('occupantion')==4) selected=selected @endif >Traveller</option>
											</select>

                                            @error('occupantion')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        

                                        <div class="col-md-4">
                                            <label for="image" class="label">Image</label>
                                             <span class="required">*</span>
                                            <input class="form-control" id="image" type="file" name="image" placeholder="" accept="image/jpeg,image/jpg,image/png" value="{{old('image')}}" >

                                            @error('image')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
										</div>
										<div class="form-group row">
										
										
										<div class="col-md-4">
										 <label for="gender">Gender</label>		
										<span class="required">*</span>										 
											<div class="gender" >
												<input type="radio" name="gender"     @if($user->gender || old('gender')==1) checked=checked @endif class="radio_gender" value="1">
												Male
												<input type="radio" name="gender"      @if($user->gender==2 || old('gender')) checked=checked @endif class="radio_gender" value="2">
												Female
											</div>
										</div>
										<div class="col-md-4">
                                            <label for="is_mobile_verified" >Is Mobile Verified</label>
											<div class="gender" >
												
												<input  id="is_mobile_verified 	" type="checkbox" name="is_mobile_verified" placeholder="Enter Email Address" @if(old('is_mobile_verified') || $user->is_mobile_verified ==1) checked @endif>
											</div>
                                            @error('is_mobile_verified')
                                            <div class="error">{{ $message }}</div>
                                            @enderror

                                        </div>
										<div class="col-md-4">
                                            <label for="is_active" class="label">Active</label>
											<div class="gender" >
												<input  id="is_active" type="checkbox" name="is_active" placeholder="Enter Email Address" @if(old('is_active') || $user->is_active ==1) checked @endif>
											</div>
                                            @error('is_active')
                                            <div class="error">{{ $message }}</div>
                                            @enderror

                                        </div>
										</div>
										<div class="form-group row">
										<div class="col-md-4">
										@if($user->image=="")
                                        <img src="{{url('/')}}/public/app_asset/images/no_image.png" id="logo-preview" style="width:155px;height:155px;">
											@else
												<img src="{{url('/')}}/public/profileimage/{{$user->image}}" id="logo-preview" style="width:155px;height:155px;">
											@endif
										</div>
										</div>

                                       <div class="form-group row">
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



@endsection
@section('javascript')

<script>
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
$("#image").change(function () {
    filePreview(this);
});

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
		  email: true,
		},
		'mobilenumber':{
		  required : true,
		  
		}
	  }
	});

</script>


@endsection


