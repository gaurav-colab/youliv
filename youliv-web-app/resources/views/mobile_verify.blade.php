@extends('layouts.appregister')

@section('content')


<section class="login-sec mobil-verified">
    <div class="container-fluid">
       <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 register-form">
                <div class="content-outer loginpage">
                    <figure>
                        <a href="{{url('/')}}"> <img src="{{ url('public/app_asset/images/logo.png') }}" alt="youLive">

                        </a>
                    </figure>
					@if ($message = Session::get('success'))

			<div class="alert alert-success alert-block">

				<button type="button" class="close" data-dismiss="alert">×</button>	

					<strong>{{ $message }}</strong>

			</div>

			@endif

					@if(session('info'))
							<div class="alert alert-success">
								{!! session('info') !!}
							</div>
					@endif

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					 @if ($messages!="")
                        <div class="alert alert-success" role="alert">
                            {{ $messages }}
                        </div>
                     @endif
					  @if ($warning!="")
                        <div class="alert alert-warning" role="alert">
                            {{ $warning }}
                        </div>
                     @endif
                    <form method="POST" >
                        @csrf

                        <p class="enter-cell">Please enter your details to continue <span> Mobile OTP Verification</span></p>

                        <div class="form-group">
                                <div class="input-group"{{ $errors->has('otp') ? 'has-error' : '' }}>
                                    <input id="otp" name="otp"  type="password" placeholder="OTP" class="form-control @error('otp') is-invalid @enderror" name="otp">

                                        <div class="input-group-addon"><span class="icon-password"></span></div>
                                </div>
                            <span class="text-danger">{{ $errors->first('otp') }}</span>

                        </div>
                        <div class="form-group">
                        <input type="text" id="mobilenumber"  class="form-control"   name="mobilenumber" value="{{ $mobilenumber }} " readonly  >

                        </div>


                        <button type="submit" class="btn logform-btn"><span>{{ __('Submit') }}</span></button>

                    </form>

                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 login-bg-img">
                <figure>
                    <img src="{{ url('app_asset/images/login-bg.png') }}">
                </figure>
            </div>
        </div>
    </div>
</section>


      	<!--        script-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="app_asset/js/owl.carousel.js"></script>
@endsection
