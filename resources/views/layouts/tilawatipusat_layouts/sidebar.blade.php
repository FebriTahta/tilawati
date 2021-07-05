<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="{{ asset('assets/images/tilawati.png') }}" alt="" class="avatar-md rounded-circle">
            </div>

            <div class="mt-3">

                <a href="#" class="text-dark font-weight-medium font-size-16"> 
                    @if (auth()->user()->username == 'pusat')
                        Tilawati Pusat (Nurul Falah)
                    @else
                        {{ auth()->user()->username }}
                    @endif</a>
                <p class="text-body mt-1 mb-0 font-size-13">{{ auth()->user()->role }}</p>

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('diklat.dashboard') }}" class="waves-effect">
                        <i class="mdi mdi-airplay"></i><span class="badge badge-pill badge-info float-right"></span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-title">Data Entri</li>
                <li>
                    <a href="{{ route('diklat.diklat') }}" class="waves-effect">
                        <i class="mdi mdi-pencil"></i>
                        <span class="badge badge-pill badge-danger float-right"></span>
                        <span>Data Diklat</span>
                    </a>
                </li>

                <li class="menu-title">Menu</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-checkbox-multiple-blank-outline"></i>
                        <span>Data Master</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('diklat.cabang') }}">Cabang</a></li>
                        <li><a href="{{ route('diklat.lembaga') }}">Lembaga</a></li>
                        <li><a href="#">Teritorial</a></li>
                        <li><a href="{{ route('diklat.kepala') }}">Kepala Bagian</a></li>
                        <li><a href="{{ route('diklat.jenjang') }}">Kelembagaan</a></li>
                        <li><a href="{{ route('diklat.program') }}">Program</a></li>
                        <li><a href="{{ route('diklat.kriteria') }}">Kriteria Syahadah</a></li>
                    </ul>
                </li>

                <li class="menu-title">Cetak</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-clipboard-list-outline"></i>
                        <span>Depan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('diklat.depan_guru') }}">CETAK IJAZAH</a></li>
                        {{-- <li><a href="{{ route('diklat.depan_santri') }}">Santri</a></li> --}}
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-clipboard-list-outline"></i>
                        <span>Belakang</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('diklat.belakang') }}">CETAK IJAZAH</a></li>
                        {{-- <li><a href="ui-buttons">Santri</a></li>
                        <li><a href="ui-buttons">Instruktur</a></li>
                        <li><a href="ui-buttons">Tahfidz</a></li>
                        <li><a href="ui-buttons">Munaqys</a></li> --}}
                    </ul>
                </li>

                <li class="menu-title">Hak Akses</li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="mdi mdi-emoticon-happy-outline"></i>
                        <span>User</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->