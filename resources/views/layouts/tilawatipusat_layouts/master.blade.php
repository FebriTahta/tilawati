<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | tilawatipusat.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="tilawatipusat.com" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link href="{{ URL::asset('tilawatipusat/css/bootstrap-dark.min.css') }}" id="bootstrap-dark" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('tilawatipusat/css/bootstrap.min.css') }}" id="bootstrap-light" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('tilawatipusat/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('tilawatipusat/css/app-rtl.min.css') }}" id="app-rtl" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('tilawatipusat/css/app-dark.min.css') }}" id="app-dark" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('tilawatipusat/css/app.min.css') }}" id="app-light" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{ URL::asset('tilawatipusat/images/favicon.ico') }}">
    {{-- @include('layouts.tilawatipusat_layouts.head') --}}

</head>

@section('body')
@show

<body data-layout="detached" data-topbar="colored">
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div id="layout-wrapper">
            @include('layouts.tilawatipusat_layouts.topbar')
            @include('layouts.tilawatipusat_layouts.sidebar')
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    @yield('content')
                </div>
                <!-- End Page-content -->
                @include('layouts.tilawatipusat_layouts.footer')
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->
    </div>
    <!-- END container-fluid -->


    <!-- Right Sidebar -->
    @include('layouts.tilawatipusat_layouts.right-sidebar')
    <!-- /Right-bar -->

    <!-- JAVASCRIPT -->
    @include('layouts.tilawatipusat_layouts.footer-script')
</body>

</html>
