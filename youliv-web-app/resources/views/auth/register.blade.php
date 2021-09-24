@extends('layouts.appregister')


@section('content')
<section class="login-sec register-outer">
        <div class="container-fluid">
       <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 register-form">
           <div class="content-outer">
            <figure>
              <a href="{{url('/')}}">
                  <img src="{{ url($server_path.'app_asset/images/logo.png') }}" alt="youLive">

                </a>
              </figure>
              <form method="POST" action="{{ route('register') }}" id="register_form">
                  @csrf
              <p class="enter-cell">Please enter your <span>detail</span> to continue.</p>
              <div class="form-group ftype" >
                    <div class="input-group" {{ $errors->has('mobilenumber') ? 'has-error' : '' }}  >
                    <div class="input-group-addon first-type">{{ __('+91') }}</div>
                    <input type="integer" id="mobilenumber"  class="form-control"   name="mobilenumber" value="{{ old('mobilenumber') }}" autocomplete="mobilenumber"  placeholder="{{ __('Mobile Number') }}" maxlength="10" data-error="#errNm1">

                    <div class="input-group-addon"><span class="icon-phone"></span></div>
                    </div>
                    <span class="text-danger">{{ $errors->first('mobilenumber') }}</span>
					 <span id="errNm1"></span>
                  </div>
                    <div class="form-group">
                    <div class="input-group" {{ $errors->has('name') ? 'has-error' : '' }} >
                    <input type="text" id="name" class="form-control"  placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}"  data-error="#errNm2">
                    <div class="input-group-addon"><span class="icon-user"></span></div>

                    </div>
                    <span class="text-danger">{{ $errors->first('name') }}</span>
					 <span id="errNm2"></span>
                  </div>
                   <div class="form-group">
                    <div class="input-group"{{ $errors->has('email') ? 'has-error' : '' }}>
                    <input type="text" id="email" class="form-control"  placeholder="{{ __('Email ID') }}"  name="email" value="{{ old('email') }}" data-error="#errNm3">
                    <div class="input-group-addon"><span class="icon-mail"></span></div>
                    </div>
                    <span class="text-danger">{{ $errors->first('email') }}</span>
					 <span id="errNm3"></span>
                  </div>

                   <div class="form-group">
                    <div class="input-group"{{ $errors->has('password') ? 'has-error' : '' }}>
                  <input type="password" id="password" class="form-control"  placeholder="{{ __('Password') }}"  name="password"  autocomplete="new-password" data-error="#errNm4">
                    <div class="input-group-addon"><span class="icon-password"></span></div>
                    </div>
                    <span class="text-danger">{{ $errors->first('password') }}</span>
					 <span id="errNm4"></span>
                  </div>
                  <div class="form-group">
                    <div class="input-group"{{ $errors->has('confirm_password') ? 'has-error' : '' }}>
                  <input type="password" id="password-confirm"  class="form-control" placeholder="{{ __('Confirm Password') }}"  name="confirm_password"  autocomplete="new-password" data-error="#errNm5">
                    <div class="input-group-addon"><span class="icon-password"></span></div>
                    </div>
                    <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
					 <span id="errNm5"></span>
                  </div>
                  <div class="log-cstm-radio">
                        <h4>Gender</h4>
								<p>
									<input type="radio" id="Cars" name="gender" {{ old('gender')== 1 ? 'checked' : ''  }} value="1"checked>
									<label for="Cars">Male</label>
								</p>
								<p>
									<input type="radio" id="Number Plates" name="gender"{{ old('gender')== 2 ? 'checked' : ''  }} value="2">
                  <label for="Number Plates">Female</label>
                  @error('property_type')
                                        <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

							</div>
							 <div class="form-group or_facebook">
							 <span>OR</span>
							  </div>
					  <div class="form-group">		
						<div class="social-link-form">
									<div class="fb-btn"><a class="btn btn-lg btn-social btn-facebook" href="{{url('login/facebook/redirect')}}"><i class="fa fa-facebook-f"></i> Continue With Facebook
									</a></div>
									<div class="gmail-btn"><a class="btn btn-lg btn-social btn-gmail" href="{{url('login/google/redirect')}}"><i class="fa fa-google"></i> Continue With Gmail
								</a></div>
								</div>
						</div>
                  <div class="form-group check-forget">
                      <div class="cstm-checkbox" >
                          <label class="cstm--check">I accept the <a href="{{url('terms-conditions')}}">Terms & Conditions</a> and <a href="{{url('privacy-policy')}}">Privacy Policy</a>
							<input type="checkbox" id="checkbox" name="check" checked  onclick="myFunction()" >
  							<span class="checkmark"></span>
                        </label>

                      </div>

                  </div>
                      <button type="submit" class="btn logform-btn" href="{{url('mobile_otp_verify')}}" id="next" enabled ><span>Next</span></button>
              </form>
              <div class="creat-acc">
              <a href="{{route('login')}}">Login <span class="icon-arrow"></span></a>
              </div>
            </div>
           </div>
           <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 login-bg-img">
           <figure>
               <img src="{{ url($server_path.'app_asset/images/login-bg.png') }}" alt="login-bg">
               </figure>
           </div>
            </div>
        </div>
        </section>
      
 <script>
   function myFunction() {
    if (document.getElementById('checkbox').checked == true) {
        document.getElementById("next").disabled = false;
    } else {
        document.getElementById("next").disabled = true;
    }
}
 $(document).ready(function(){
 



	$('#register_form').validate({
	  errorElement: 'div',
		messages: {
		mobilenumber: { required: "Mobile number is Required" ,number: "Please enter digits only.", minlength: "Please enter at least 10 characters.",maxlength: "Please enter  no more than 12 characters."},

		name: { required: "Name is Required" },
		email: { required: "Email is Required" },
        password: { required: "Password is Required" , minlength: "Please enter at least 8 characters.",maxlength: "Please enter no more than 50 characters."},
		confirm_password: { required: "Password is Required" , minlength: "Please enter at least 8 characters.",maxlength: "Please enter no more than 50 characters.",equalTo: "Confirm password is not same as Password."},			
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
		 'mobilenumber':{
		  required : true,
		  number:true,
		  minlength:10,
		  maxlength:12
		},
		'name':{
		  required : true,
		},
		'email':{
		  required : true,
		  email:true
		},
		'password':{
		  required : true,
		  minlength:8,
		  maxlength:50
		},
		'confirm_password':{
		  required : true,
		  minlength:8,
		  maxlength:50,
		  equalTo : '[name="password"]'
		}
	  },
	});
	
});
</script>

  @endsection


