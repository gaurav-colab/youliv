@extends('admin.dashboard.authBase')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <div class="row" style="margin-bottom:50px;text-align:center;">
                            <div class="col-12">
                                <img src="{{ url('public/app_asset/images/logo.png') }}" width="250px">
                            </div>
                        </div>
                        @error('msg')
                        <h4 class="alert alert-danger login-err-msg">{{ $message }}</h4>
                        @enderror
                        <form method="POST" action="{{ route($loginRoute) }}">
                            @csrf
                            <div class="input-group mb-3 login-input">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg class="c-icon">
                                            <use xlink:href="{{ url('public/assets/icons/coreui/free-symbol-defs.svg#cui-user')}}"></use>
                                        </svg>
                                    </span>
                                </div>

                                <input class="form-control" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" autofocus>
                            </div>
                            @error('email')
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

                                <input class="form-control" type="password" placeholder="{{ __('Password') }}" id="password" name="password" value="{{ old('password') }}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="togglePassword">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                            <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                        </svg>
                                    </span>
                                </div><br>
                            </div>
                            @error('password')
                            <div class="alert alert-danger login-err-msg">{{ $message }}</div>
                            @enderror
                            <div class="row login-input">
                                <div class="col-12" style="text-align:center;">
                                    <button class="btn btn-primary px-4" type="submit">{{ __('Login') }}</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
</script>


@endsection

@section('javascript')

@endsection