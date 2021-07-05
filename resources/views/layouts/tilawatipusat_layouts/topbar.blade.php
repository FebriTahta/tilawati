<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-right">
                <div class="dropdown d-none d-lg-inline-block ml-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block">
                    
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/logo-nf.png') }}" alt="Header Avatar">
                        @auth
                        <span class="d-none d-xl-inline-block ml-1">{{ auth()->user()->role }}</span>
                        @else
                        <span class="d-none d-xl-inline-block ml-1">Peserta Diklat</span>
                        @endauth
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    @auth
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <div class="dropdown-divider"></div>
                        
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"> {{ __('Logout') }}</i>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        
                    </div>
                    @endauth
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                        <i class="mdi mdi-settings-outline"></i>
                    </button>
                </div>

            </div>
            <div>
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="{{ route('diklat.dashboard') }}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/tilawati-white.png') }}" alt="" width="100px">
                        </span>
                        <span class="logo-lg">
                            <img src="{{  asset('assets/images/tilawati-white.png')  }}" alt="" width="70px">
                        </span>
                    </a>

                    <a href="{{ route('diklat.dashboard') }}" class="logo logo-light text-white">
                        <p class="logo-sm">
                            <img src="{{ asset('assets/images/tilawati-white.png') }}" alt="" width="100px">
                        </p>
                        <p class="logo-lg">
                            <img src="{{  asset('assets/images/nf_logo_white.png')  }}" alt="" width="130px">
                        </p>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <!-- App Search-->
            </div>

        </div>
    </div>
</header>