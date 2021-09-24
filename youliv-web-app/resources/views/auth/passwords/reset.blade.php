@extends('layouts.appregister')

@section('content')
<section class="login-sec mobil-verified">
    <div class="container-fluid">
       <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 register-form">
                <div class="content-outer loginpage">
                    <figure>
                        <a href="{{url('/')}}">
                        <img src="{{ url('public/app_asset/images/logo.png') }}" alt="youLive">

                        </a>
                    </figure>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.update') }}" >
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <p class="enter-cell">Please enter your details to continue <span>Reset Password</span></p>
                        <div class="form-group ftype">
                            <div class="input-group"{{ $errors->has('email') ? 'has-error' : '' }}>

                            <input id="email" type="email" placeholder="Email ID" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}"  autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                                <div class="input-group-addon"><span class="icon-mail"></span></div>
                            </div>
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>
                        <div class="form-group">
                    <div class="input-group"{{ $errors->has('password') ? 'has-error' : '' }}>
                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                    <div class="input-group-addon"><span class="icon-password"></span></div>
                    </div>
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                  </div>
                  <div class="form-group">
                    <div class="input-group"{{ $errors->has('confirm_password') ? 'has-error' : '' }}>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmation Password"  autocomplete="new-password">
                    <div class="input-group-addon"><span class="icon-password"></span></div>
                    </div>
                    <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                  </div>

                        <button type="submit" class="btn logform-btn"><span>{{ __('Next') }}</span></button>

                    </form>

                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 login-bg-img">
                <figure>
                    <img src="{{ url('public/app_asset/images/login-bg.png') }}">
                </figure>
            </div>
        </div>
    </div>
</section>


      	<!--        script-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="public/app_asset/js/owl.carousel.js"></script>
@endsection
