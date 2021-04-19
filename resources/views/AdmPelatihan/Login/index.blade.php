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
                                    <img class="" style="width: 250px" src="{{ asset('assets/images/nf_logo.png') }}">
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