@extends('layouts.appregister')

@section('content')
<section class="login-sec">
        <div class="container-fluid">
       <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 register-form">
           <div class="content-outer loginpage">
            <figure>
              <a href="{{url('/')}}"><img src="{{ url($server_path.'app_asset/images/logo.png') }}" alt="youLive"></a>
              </figure>

              <form method="POST" action="{{ route('login') }}" id="login_form">
                  @csrf
              <div class="form-group">
					@if(session('success'))
							<div class="alert alert-success">
								{!! session('success') !!}
							</div>
					@endif
					@if(session('warning'))
							<div class="alert alert-warning">
								{!! session('warning') !!}
							</div>
					@endif
					@if(session('error'))
							<div class="alert alert-error">
								{!! session('error') !!}
							</div>
					@endif
					  <div class="errorTxt"></div>
                    <div class="input-group"{{ $errors->has('email') ? 'has-error' : '' }}>
                    <input type="text"  id="email" name ="email" data-error="#errNm1"  class="form-control" value="{{ old('email') }}" autocomplete="email" placeholder="{{ __('Email / Mobile Number') }}">
                    <div class="input-group-addon"><span class="icon-phone"></span></div>
                    </div>
                    <span class="text-danger">{{ $errors->first('email') }}</span>
					  <span id="errNm1"></span>
                  </div>
                   <div class="form-group">
                    <div class="input-group">
                  <input type="password" name="password" data-error="#errNm2"  id="password" class="form-control" value="{{ old('password') }}"autocomplete="email" placeholder="{{ __('Password') }}">
                    <div class="input-group-addon"><span class="icon-password"></span></div>
                    </div>
                    <span class="text-danger">{{ $errors->first('password') }}</span>
					<span id="errNm2"></span>
                  </div>
				   <div class="errorTxt">
				  
					
				   </div>
                  @if (Route::has('password.request'))
                                    <a class="btn btn-link forgot-password-link"   href="{{ route('password.request') }}">

                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                      <button type="submit" class="btn logform-btn"><span>Login</span></button>
					  
					  
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
              </form>


              <div class="creat-acc">
              <!-- javascript:void(0); -->
              <a href="{{route('register')}}">Create your Account <span class="icon-arrow"></span></a>
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
$(document).ready(function(){
	$('#login_form').validate({
	  errorElement: 'div',
messages: {
			email: { required: "Email is Required" },
            password: { required: "Password is Required" , minlength: "Please enter at least 8 characters.",maxlength: "Please enter no more than 50 characters."},
			
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
		'email':{
		  required : true,
		  email:true
		},
		'password':{
		  required : true,
		  minlength:8,
		  maxlength:50
		}
	  },
	});
	
});
</script>

@endsection
