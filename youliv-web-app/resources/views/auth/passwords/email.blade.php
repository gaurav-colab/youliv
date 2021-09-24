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
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <p class="enter-cell">Please enter your <span>Email ID</span> to continue.</p>
                        <div class="form-group ftype">
                            <div class="input-group" {{ $errors->has('email') ? 'has-error' : '' }}>

                                <input type="text" id="email" class="form-control" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}">
                                <div class="input-group-addon"><span class="icon-mail"></span></div>
                            </div>
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>


                        <button type="submit" class="btn logform-btn"><span>{{ __('Next') }}</span></button>

                    </form>
                    <div class="creat-acc">
                        <a href="{{route('register')}}">Create your Account <span class="icon-arrow"></span></a>
                    </div>
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