<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Pelatihan Tilawati Nurul Falah</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('lgnfrm/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lgnfrm/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lgnfrm/css/iofrm-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lgnfrm/css/iofrm-theme8.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
    <div class="form-body">
        <div class="website-logo">
            <a href="index.html">
                <div class="logo">
                    <img class="logo-size" src="{{ asset('lgnfrm/images/logo-light.svg') }}" alt="">
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <h3>SELAMAT DATANG DI APLIKASI MANAJEMEN PROGRAM PELATIHAN TILAWATI.</h3>
                    <p>Silahkan login berdasarkan akun cabang tilawati anda</p>
                    <img src="{{ asset('lgnfrm/images/graphic4.svg') }}" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <div class="website-logo-inside">
                            <a href="/">
                                <div class="">
                                    {{-- <img class="logo-size" src="{{ asset('lgnfrm/images/logo-light.svg') }}" alt=""> --}}
                                    <img class="" style="width: 330px" src="{{ asset('assets/images/tilawati-white.png') }}">
                                </div>
                            </a>
                        </div>
                        <div class="page-links">
                            <a href="/" class="active">Login</a>
                            {{-- <a href="register8.html">Register</a> --}}
                        </div>
                        <form method="POST" action="{{ route('login') }}">@csrf
                            <input class="form-control" type="text" name="username" placeholder="Username / E-mail Address" required>
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">Login</button> <a href="#">Forget password?</a>
                            </div>
                        </form>
                        <div class="other-links">
                            {{-- <span>Or login with</span><a href="#">Facebook</a><a href="#">Google</a><a href="#">Linkedin</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('lgnfrm/js/jquery.min.js') }}"></script>
<script src="{{ asset('lgnfrm/js/popper.min.js') }}"></script>
<script src="{{ asset('lgnfrm/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('lgnfrm/js/main.js') }}"></script>
</body>
</html>

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Username or Email') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required  autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
