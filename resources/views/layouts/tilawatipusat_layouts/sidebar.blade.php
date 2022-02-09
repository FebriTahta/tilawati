<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="">
                <img src="{{ asset('assets/images/tilawati.png') }}" alt=""
                    class="avatar-lg mx-auto img-thumbnail rounded-circle">
                <div class="online-circle"></div>
            </div>

            <div class="mt-3">

                <a href="#" class="text-dark font-weight-medium font-size-16">
                    @if (auth()->user()->username == 'admin')
                        Tilawati Pusat (Nurul Falah)
                    @else
                        {{ ucwords(substr(auth()->user()->cabang->kabupaten->nama),5) }}
                    @endif
                </a>
                <p class="text-body mt-1 mb-0 font-size-13">{{ ucwords(auth()->user()->role) }}</p>

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('diklat.dashboard') }}" class="waves-effect">
                        <i class="mdi mdi-airplay"></i><span class="badge badge-pill badge-info float-right"></span>
                        <span style="font-size: 12px">Dashboard</span>
                    </a>
                </li>

                <li class="menu-title">Input Data Diklat</li>
                <li style="display: none">
                    <a href="{{ route('acara') }}" class="waves-effect">
                        <i class="mdi mdi-city-variant-outline"></i>
                        <span class="badge badge-pill badge-danger float-right"></span>
                        <span style="font-size: 12px">Acara</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('diklat.diklat') }}" class="waves-effect">
                        <i class="mdi mdi-pencil-box-multiple-outline"></i>
                        <span class="badge badge-pill badge-danger float-right"></span>
                        <span style="font-size: 12px">Data Diklat</span>
                    </a>
                </li>
                @if (auth()->user()->role == 'pusat')
                    <li>
                        <a href="{{ route('diklat.webinar') }}" class="waves-effect">
                            <i class="mdi mdi-city-variant-outline"></i>
                            <span class="badge badge-pill badge-danger float-right"></span>
                            <span style="font-size: 12px">Data Webinar</span>
                        </a>
                    </li>
                @endif
                {{-- <li>
                    <a href="{{ route('diklat.seluruh_peserta') }}" class="waves-effect">
                        <i class="fa fa-book"></i>
                        <span class="badge badge-pill badge-danger float-right"></span>
                        <span>Seluruh Peserta Diklat</span>
                    </a>
                </li> --}}

                <li class="menu-title">Menu</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-checkbox-multiple-blank-outline"></i>
                        <span style="font-size: 12px">Data Master</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a style="font-size: 12px" href="{{ route('diklat.lembaga') }}">Lembaga</a></li>
                        <li><a style="font-size: 12px" href="{{ route('diklat.cabang') }}">Cabang</a></li>
                        @if (auth()->user()->role == 'pusat')
                            <li><a style="font-size: 12px" href="{{ route('diklat.kepala') }}">Kepala Bagian</a></li>
                            <li><a style="font-size: 12px" href="{{ route('diklat.jenjang') }}">Kelembagaan</a></li>
                            <li><a style="font-size: 12px" href="{{ route('diklat.program') }}">Program</a></li>
                            <li><a style="font-size: 12px" href="{{ route('diklat.kriteria') }}">Kriteria
                                    Syahadah</a></li>
                            <li><a style="font-size: 12px" href="/daftar-pengguna">Daftar User</a></li>
                        @else
                            <li><a style="font-size: 12px" href="{{ route('data.trainer.cabang') }}">Data Trainer</a>
                            </li>
                        @endif
                    </ul>
                </li>
                @if (auth()->user()->role == 'pusat')
                    {{-- <li class="menu-title">Pusat Data Administrasi & Daerah</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-checkbox-multiple-blank-outline"></i>
                        <span style="font-size: 12px">Dinas Administrasi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li style="display: none"><a href="{{route('negara')}}">Kode Negara</a></li>
                        <li><a href="{{route('phone')}}" style="font-size: 12px">Kode Telephone</a></li>
                        <li><a href="/kode-kabupaten" style="font-size: 12px">Kota - Kabupaten</a></li>
                    </ul>
                </li> --}}

                    <li class="menu-title">Cetak</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-clipboard-list-outline"></i>
                            <span style="font-size: 12px">Depan</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a style="font-size: 12px" href="{{ route('diklat.depan_guru') }}">CETAK IJAZAH</a>
                            </li>
                            {{-- <li><a href="{{ route('diklat.depan_santri') }}">Santri</a></li> --}}
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-clipboard-list-outline"></i>
                            <span style="font-size: 12px">Belakang</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a style="font-size: 12px" href="{{ route('diklat.belakang') }}">CETAK IJAZAH</a>
                            </li>
                        </ul>
                    </li>

                    {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-clipboard-list-outline"></i>
                        <span style="font-size: 12px">Laporan Peserta</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a style="font-size: 12px" href="{{ route('diklat.seluruh_peserta') }}">Cetak Laporan Peserta</a></li>
                    </ul>
                </li> --}}

                    <li style="display: none">
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-clipboard-list-outline"></i>
                            <span style="font-size: 12px">Detail</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a style="font-size: 12px" href="{{ route('diklat.detail_peserta') }}">CETAK DETAIL
                                    PESERTA</a></li>
                        </ul>
                    </li>
                    <div>
                        <li style="font-size: 12px" class="menu-title">Syarat Pendaftaran Online</li>

                        <li>
                            <a href="{{ route('diklat.syarat.registrasi') }}" class="waves-effect">
                                <i class="mdi mdi-clipboard-list-outline"></i>
                                <span style="font-size: 12px">Registrasi</span>
                            </a>
                        </li>

                        <li style="display: none">
                            <a href="{{ route('daftar_diklat_konfirmasi') }}" class="waves-effect">
                                <i class="mdi mdi-clipboard-list-outline"></i>
                                <span style="font-size: 12px">Konfirmasi</span>
                            </a>
                        </li>
                        <li class="menu-title">Data Sertifikat Peserta</li>
                        <li>
                            <a href="{{ route('sertifikat') }}" class="waves-effect">
                                <i class="mdi mdi-smart-card-outline"></i>
                                <span class="badge badge-pill badge-danger float-right"></span>
                                <span style="font-size: 12px">E-Sertifikat</span>
                            </a>
                        </li>

                        <li class="menu-title">LAPORAN DATA KERJA</li>
                        <li>
                            <a href="{{ route('diklat.seluruh_peserta') }}" class="waves-effect">
                                <i class="mdi mdi-smart-card-outline"></i>
                                <span class="badge badge-pill badge-danger float-right"></span>
                                <span style="font-size: 12px">Laporan</span>
                            </a>
                        </li>
                    </div>

                @else
                    <li class="menu-title text-danger">- BATAS AKSES -</li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
