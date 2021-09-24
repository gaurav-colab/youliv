@extends('layouts.appregister')


@section('content')
<section class="login-sec register-outer">
        <div class="container-fluid">
       <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 register-form">
           <div class="content-outer">
            <figure>
              <a href="{{url('/')}}">
                  <img src="{{ url('public/app_asset/images/logo.png') }}" alt="youLive">

                </a>
              </figure>
              <form method="POST" action="{{ route('register') }}" >
                  @csrf
              <p class="enter-cell">Please enter your <span>detail</span> to continue.</p>
              <div class="form-group ftype" >
                    <div class="input-group" {{ $errors->has('mobilenumber') ? 'has-error' : '' }}  >
                    <div class="input-group-addon first-type">{{ __('+91') }}</div>
                    <input type="integer" id="mobilenumber"  class="form-control"   name="mobilenumber" value="{{ old('mobilenumber') }}" autocomplete="mobilenumber"  placeholder="{{ __('Mobile Number') }}" maxlength="10">

                    <div class="input-group-addon"><span class="icon-phone"></span></div>
                    </div>
                    <span class="text-danger">{{ $errors->first('mobilenumber') }}</span>
                  </div>
                    <div class="form-group">
                    <div class="input-group" {{ $errors->has('name') ? 'has-error' : '' }} >
                    <input type="text" id="name" class="form-control"  placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}"  >
                    <div class="input-group-addon"><span class="icon-user"></span></div>

                    </div>
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                  </div>
                   <div class="form-group">
                    <div class="input-group"{{ $errors->has('email') ? 'has-error' : '' }}>
                    <input type="text" id="email" class="form-control"  placeholder="{{ __('Email ID') }}"  name="email" value="{{ old('email') }}" >
                    <div class="input-group-addon"><span class="icon-mail"></span></div>
                    </div>
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                  </div>

                   <div class="form-group">
                    <div class="input-group"{{ $errors->has('password') ? 'has-error' : '' }}>
                  <input type="password" id="password" class="form-control"  placeholder="{{ __('Password') }}"  name="password"  autocomplete="new-password">
                    <div class="input-group-addon"><span class="icon-password"></span></div>
                    </div>
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                  </div>
                  <div class="form-group">
                    <div class="input-group"{{ $errors->has('confirm_password') ? 'has-error' : '' }}>
                  <input type="password" id="password-confirm"  class="form-control" placeholder="{{ __('Confirm Password') }}"  name="confirm_password"  autocomplete="new-password">
                    <div class="input-group-addon"><span class="icon-password"></span></div>
                    </div>
                    <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
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
                  <div class="form-group check-forget">
                      <div class="cstm-checkbox" >
                          <label class="cstm--check">I accept the <a href="{{url('terms_conditions')}}">Terms & Conditions</a> and <a href="{{url('privacy_policy')}}">Privacy Policy</a>
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
               <img src="{{ url('public/app_asset/images/login-bg.png') }}" alt="login-bg">
               </figure>
           </div>
            </div>
        </div>
        </section>
        @endsection
 <script>
   function myFunction() {
    if (document.getElementById('checkbox').checked == true) {
        document.getElementById("next").disabled = false;
    } else {
        document.getElementById("next").disabled = true;
    }
}


</script>


