@extends('property_owner.dashboard.authBase')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card-group">
        <div class="card p-4">
          <div class="card-body">
            <div class="row" style="margin-bottom:50px;text-align:center;">
              <div class="col-12">
                <img src="{{ url('/public/admin/app_asset/images/logo.png') }}" width="250px">
              </div>
            </div>
            @if ( Session::has('error') )
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route($loginRoute) }}">
              @csrf
              <div class="input-group mb-3 login-input">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <svg class="c-icon">
                      <use xlink:href="{{ url('/public/assets/icons/coreui/free-symbol-defs.svg#cui-user')}}"></use>
                    </svg>
                  </span>
                </div>
                <input class="form-control" type="text" placeholder="Mobile number" name="owner_number" value="{{ old('owner_number') }}" autofocus>
              </div>
              @error('owner_number')
              <div class="alert alert-danger login-err-msg">{{ $message }}</div>
              @enderror
              <div class="input-group mb-4 login-input">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <svg class="c-icon">
                      <use xlink:href="{{ url('public/assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked')}}"></use>
                    </svg>
                  </span>
                </div>
                <input class="form-control" type="password" placeholder="{{ __('Password') }}" name="password" value="{{ old('password') }}"><br>
              </div>
              @error('password')
              <div class="alert alert-danger login-err-msg">{{ $message }}</div>
              @enderror
              <div class="row login-input">
                <div class="col-12" style="text-align:center;">
                  <button class="btn btn-primary px-4" type="submit">{{ __('Login') }}</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('javascript')

@endsection
