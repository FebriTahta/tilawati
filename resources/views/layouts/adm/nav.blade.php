<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Program Diklat PonPes Nurul Falah</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link rel="shortcut icon" href="{{asset('assets/images/nf.png')}}">

        <!--Morris Chart CSS -->
        {{-- <link rel="stylesheet" href="{{asset('adm/plugins/morris/morris.css')}}"> --}}

        <link href="{{asset('adm/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('adm/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('adm/css/style.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('adm/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{asset('adm/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        @yield('head')
        <link href="{{ asset('adm/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <style>
            a.disabled {
            pointer-events: none;
            cursor: default;
            }
        </style>
    </head>


    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                    <i class="ion-close"></i>
                </button>

                <div class="left-side-logo d-block d-lg-none">
                    <div class="text-center border-bottom">

                        <a href="index.html" class="logo"><img src="{{asset('assets/images/nf_logo.png')}}" height="50" alt="logo"></a>
                    </div>
                </div>

                <div class="sidebar-inner slimscrollleft">
                    <div id="sidebar-menu">
                        <ul>
                            <li class="menu-title text-uppercase">DASHBOARD</li>
                            <li>
                                <a href="{{ route('dashboard') }}" class="waves-effect">
                                    <i class="dripicons-meter"></i>
                                    <span> Dashboard {{ auth()->user()->role }} <span class="badge badge-success badge-pill float-right"></span></span>
                                </a>
                            </li>
                            <li class="menu-title">MENU</li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-document"></i><span> Master </span> <span class="badge badge-danger badge-pill float-right"></span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                @auth
                                <ul class="list-unstyled">
                                    <li><a href="{{route('cabang.index')}}">Cabang</a></li>
                                    <li><a href="{{route('teritorial.index')}}" @if (auth()->user()->role=='pusat') @else class="text-danger disabled" @endif>Teritorial</a></li>
                                    <li><a href="{{route('jenis.index')}}" @if (auth()->user()->role=='pusat') @else class="text-danger disabled" @endif>Kelembagaan</a></li>
                                    <li><a href="{{route('lembaga.index')}}">Lembaga</a></li>
                                    <li><a href="{{ route('kriteria.index') }}" @if (auth()->user()->role=='pusat') @else class="text-danger disabled" @endif>Kriteria Syahadah</a></li>
                                </ul>
                                @endauth
                            </li>
                            
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-book-multiple"></i><span> Program </span> <span class="badge badge-danger badge-pill float-right"></span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('program.index') }}" @if (auth()->user()->role=='pusat') @else class="text-danger disabled" @endif>Jenis Program</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-location"></i><span> Daftar Kepala </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="#" @if (auth()->user()->role=='pusat') @else class="text-danger disabled" @endif>Kepala Cabang</a></li>
                                    <li><a href="#" @if (auth()->user()->role=='pusat') @else class="text-danger disabled" @endif>Kepala Lembaga</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-copy"></i><span> Cetak </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('pelatihan.c_depan') }}" @if (auth()->user()->role=='pusat') @else class="text-danger disabled" @endif>Ijazah Depan Guru</a></li>
                                    <li><a href="{{ route('pelatihan.c_depan_s') }}" @if (auth()->user()->role=='pusat') @else class="text-danger disabled" @endif>Ijazah Depan Santri</a></li>
                                    <li><a href="{{ route('pelatihan.c_belakang') }}" @if (auth()->user()->role=='pusat') @else class="text-danger disabled" @endif>Cetak Ijazah Belakang Santri</a></li>
                                    <li><a href="{{ route('pelatihan.c_belakang_g') }}" @if (auth()->user()->role=='pusat') @else class="text-danger disabled" @endif>Cetak Ijazah Belakang Guru</a></li>
                                    <li><a href="{{ route('pelatihan.c_belakang_tot') }}" @if (auth()->user()->role=='pusat') @else class="text-danger disabled" @endif>Cetak Ijazah TOT Instruktur</a></li>
                                    <li><a href="{{ route('pelatihan.c_belakang_tahfidz') }}" @if (auth()->user()->role=='pusat') @else class="text-danger disabled" @endif>Cetak Ijazah Tahfidz</a></li>
                                    <li><a href="{{ route('pelatihan.c_belakang_munaqys') }}" @if (auth()->user()->role=='pusat') @else class="text-danger disabled" @endif>Cetak Ijazah Munaqys</a></li>
                                </ul>
                            </li>
                            <li class="menu-title">DIKLAT</li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-pencil-alt"></i><span> Data Entri </span> <span class="badge badge-danger badge-pill float-right"></span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{route('pelatihan.index')}}">Pelatihan</a></li>
                                </ul>
                            </li>
                            <li class="menu-title">USER AKSES</li>
                            <li class="">
                                <a @if (auth()->user()->role=='pusat') href="{{ route('user.index') }}" @else class="text-danger disabled" @endif><i class="fa fa-user"></i> USER</a>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <div class="topbar">

                        <div class="topbar-left	d-none d-lg-block">
                            <div class="text-center">

                                <a href="index.html" class="logo"><img src="{{asset('assets/images/nf_logo.png')}}" height="50" alt="logo"></a>
                            </div>
                        </div>

                        <nav class="navbar-custom">

                            <ul class="list-inline float-right mb-0">

                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                       aria-haspopup="false" aria-expanded="false">
                                        <img src="{{ asset('assets/images/nf.png') }}" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();"><i class="mdi mdi-logout m-r-5 text-muted"></i>
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>

                            </ul>

                            <ul class="list-inline menu-left mb-0">
                                <li class="list-inline-item">
                                    <button type="button" class="button-menu-mobile open-left waves-effect">
                                        <i class="ion-navicon"></i>
                                    </button>
                                </li>
                            </ul>

                            <div class="clearfix"></div>

                        </nav>

                    </div>
                    <!-- Top Bar End -->
