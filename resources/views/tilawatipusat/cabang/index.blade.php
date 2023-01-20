@extends('layouts.tilawatipusat_layouts.master')

@section('title')
    Cabang
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('common-tilawatipusat.breadcrumb')
        @slot('title')
            Cabang
        @endslot
        @slot('title_li')
            Tilawati
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if (auth()->user()->role == 'cabang')
                        <h4 class="card-title text-uppercase">Struktur Tata Kelola Tilawati
                            {{ auth()->user()->cabang->status }}</h4>
                        <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                            {{-- <form action="/post-pengurus-cabang" method="POST"> @csrf  --}}
                            <form id="addpenguruscabang" method="POST"> @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6" style="margin-bottom: 20px">
                                            <label>Kepala Cabang </label>
                                            <div class="row">
                                                @if ($pengurus_kepala !== null)
                                                    <div class="col-md-6">
                                                        <input type="hidden" name="id[]" id="idkepalacabang" value="{{$pengurus_kepala->id}}">
                                                        <input type="text" class="form-control" name="namapengurus[]"
                                                            placeholder="Nama lengkap..."
                                                            value="{{$pengurus_kepala->nama_pengurus}}">
                                                        <input type="hidden" name="bagian[]" value="Kepala Cabang"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="telppengurus[]"
                                                            placeholder="Nomor Telepon..."
                                                            value="{{$pengurus_kepala->telp_pengurus}}">
                                                    </div>
                                                @else
                                                    <div class="col-md-6">
                                                        <input type="hidden" name="id[]" id="idkepalacabang" >
                                                        <input type="text" class="form-control" name="namapengurus[]"
                                                            placeholder="Nama lengkap..."
                                                            value="{{ auth()->user()->cabang->kepalacabang }}">
                                                        <input type="hidden" name="bagian[]" value="Kepala Cabang"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="telppengurus[]"
                                                            placeholder="Nomor Telepon..."
                                                            value="{{ auth()->user()->cabang->telp }}">
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="col-md-6" style="margin-bottom: 20px">
                                            <label>Kabid Administrasi, Keuangan & Disardik</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    
                                                    <input type="hidden" name="id[]" id="idkabidadmin" @if ($kabid_admin !== null)  value="{{$kabid_admin->id}}" @endif>
                                                    <input type="text" class="form-control" name="namapengurus[]"
                                                        placeholder="Nama lengkap..." @if ($kabid_admin !== null)  value="{{$kabid_admin->nama_pengurus}}" @endif>
                                                    <input type="hidden" name="bagian[]"
                                                        value="Kabid Administrasi, Keuangan & Disardik"
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="telppengurus[]"
                                                        placeholder="Nomor Telepon..." @if ($kabid_admin !== null)  value="{{$kabid_admin->telp_pengurus}}" @endif>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="margin-bottom: 20px">
                                            <label>Kabid Diklat & Munaqosyah</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="hidden" name="id[]" id="idkabiddiklat"@if ($kabid_diklat !== null)  value="{{$kabid_diklat->id}}" @endif>
                                                    <input type="text" class="form-control" name="namapengurus[]"
                                                        placeholder="Nama lengkap..." @if ($kabid_diklat !== null)  value="{{$kabid_diklat->nama_pengurus}}" @endif>
                                                    <input type="hidden" name="bagian[]" value="Kabid Diklat & Munaqosyah"
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="telppengurus[]"
                                                        placeholder="Nomor Telepon..." @if ($kabid_diklat !== null)  value="{{$kabid_diklat->telp_pengurus}}" @endif>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="margin-bottom: 20px">
                                            <label>Kabid Pengembangan Kelembagaan</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="hidden" name="id[]" id="idkabidpengembangan" @if ($kabid_lembaga !== null)  value="{{$kabid_lembaga->id}}" @endif>
                                                    <input type="text" class="form-control" name="namapengurus[]"
                                                        placeholder="Nama lengkap..."  @if ($kabid_lembaga !== null)  value="{{$kabid_lembaga->nama_pengurus}}" @endif>
                                                    <input type="hidden" name="bagian[]"
                                                        value="Kabid Pengembangan Kelembagaan" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="telppengurus[]"
                                                        placeholder="Nomor Telepon..."  @if ($kabid_lembaga !== null)  value="{{$kabid_lembaga->telp_pengurus}}" @endif>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="margin-bottom: 20px">
                                            <label>Kabid Supervisor</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="hidden" name="id[]" id="idkabidsupervisor" @if ($kabid_super !== null)  value="{{$kabid_super->id}}" @endif>
                                                    <input type="text" class="form-control" name="namapengurus[]"
                                                        placeholder="Nama lengkap..." @if ($kabid_super !== null)  value="{{$kabid_super->nama_pengurus}}" @endif>
                                                    <input type="hidden" name="bagian[]" value="Kabid Supervisor"
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="telppengurus[]"
                                                        placeholder="Nomor Telepon..." @if ($kabid_super !== null)  value="{{$kabid_super->telp_pengurus}}" @endif>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" class="btn btn-primary" id="btnpengurus"
                                                type="button" value="Update">
                                            {{-- <button class="btn btn-primary" type="button">UPDATE</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </blockquote>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4">
            @component('common-tilawatipusat.dashboard-widget')
                @slot('title')
                    <b id="cb"> 2,456 </b> Cabang
                @endslot
                @slot('iconClass')
                    mdi mdi-bank-outline
                @endslot
                @slot('price')
                @endslot
            @endcomponent
        </div>
        <div class="col-xl-4">
            @component('common-tilawatipusat.dashboard-widget')
                @slot('title')
                    <b id="kb"> 2,456 </b> Kabupaten
                @endslot
                @slot('iconClass')
                    mdi mdi-city
                @endslot
                @slot('price')
                @endslot
            @endcomponent
        </div>
        <div class="col-xl-4">
            @component('common-tilawatipusat.dashboard-widget')
                @slot('title')
                    <b id="pv"> 2,456 </b> Provinsi
                @endslot
                @slot('iconClass')
                    mdi mdi-city-variant-outline
                @endslot
                @slot('price')
                @endslot
            @endcomponent
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Data Cabang</h4>
                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br>
                        @if (auth()->user()->role == 'pusat')
                            <code>Data Import dan Eksport Berbeda Format (Berhati-hati ketika meng-importkan data
                                baru)</code>
                    </p>
                    {{-- <button class="btn btn-sm btn-success mb-2 mr-1" style="width:130px ; margin-bottom: 5px"
                        data-toggle="modal" data-target=".bs-example-modal-cabang"><i class="mdi mdi-cloud-upload"></i>
                        import cabang</button>
                    <button class="btn btn-sm btn-success mb-2 mr-1" style="width:130px ; margin-bottom: 5px"
                        data-toggle="modal" data-target=".bs-example-modal-rpq"><i class="mdi mdi-cloud-upload"></i> import
                        rpq</button> --}}
                    <button class="btn btn-sm btn-success mb-2 mr-1" style="width:130px " data-toggle="modal"
                        data-target=".bs-example-modal-tambah-cabang"><i class="mdi mdi-plus"></i> tambah cabang</button>
                    <a href="/export-download-data-cabang" class="btn btn-sm btn-outline-primary mb-2 mr-1 text-uppercase"
                        style="font-size: 12px "><i class="mdi mdi-download"></i> Unduh Data Cabang</a>
                    <br>
                    @endif
                    {{-- <a href="/export-data-cabang" target="_blank" class="btn btn-sm btn-outline-primary mb-2 mr-1"
                        style="width: 130px"><i class="fa fa-download">
                            Trainer Cabang</i></a>
                    <a href="/export-kpa-cabang" target="_blank" class="btn btn-sm btn-outline-primary mb-2 mr-1"
                        style="width: 130px"><i class="fa fa-download">
                            KPA Cabang</i></a> --}}
                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                        <table id="datatable-buttons" class="table table-cabang table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead class="text-bold text-primary" style="text-transform: uppercase; font-size: 10px">
                                <tr>
                                    {{-- <th>Kode</th> --}}
                                    <th>Nama</th>
                                    <th>KEPALA</th>
                                    <th>PROVINSI</th>
                                    <th>KABUPATEN</th>
                                    <th>TELP</th>
                                    <th>ALAMAT</th>
                                    <th>STATUS</th>
                                    <th>KADIVRE</th>
                                    <th>WILAYAH</th>
                                    <th>KPA</th>
                                    <th>TRAINER</th>
                                    <th>LEMBAGA VERSI LAMA</th>
                                    <th>LOCATION</th>
                                    <th>OPSI</th>
                                </tr>
                            </thead>

                            <tbody style="font-size: 10px">
                            </tbody>

                            <tfoot class="text-bold text-primary" style="text-transform: uppercase; font-size: 10px">
                                <tr>
                                    {{-- <th>Kode</th> --}}
                                    <th>Nama</th>
                                    <th>KEPALA</th>
                                    <th>PROVINSI</th>
                                    <th>KABUPATEN</th>
                                    <th>TELP</th>
                                    <th>ALAMAT</th>
                                    <th>STATUS</th>
                                    <th>KADIVRE</th>
                                    <th>WILAYAH</th>
                                    <th>KPA</th>
                                    <th>TRAINER</th>
                                    <th>LEMBAGA VERSI LAMA</th>
                                    <th>LOCATION</th>
                                    <th>OPSI</th>
                                </tr>
                            </tfoot>
                        </table>
                        <footer class="blockquote-footer">Updated at <cite title="Source Title">2021</cite></footer>
                    </blockquote>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <!--modal import cabang-->
    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade bs-example-modal-cabang" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">IMPORT DATA CABANG </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <form id="importcabang" method="POST" enctype="multipart/form-data">@csrf
                                            <input type="hidden" id="import_tipe" value="munaqisy">
                                            <div class="form-group">
                                                <label for="">Import Data "Cabang" (hanya Excel File format
                                                    .xlsx)</label>
                                                <input type="file" class="form-control" name="file"
                                                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" name="import" id="btnimport" class="btn btn-info"
                                                    value="Import" />
                                            </div>
                                        </form>
                                    </div><!-- container fluid -->
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <!--modal import rpq-->
    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade bs-example-modal-rpq" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">IMPORT DATA RPQ </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <form id="importrpq" method="POST" enctype="multipart/form-data">@csrf
                                            <input type="hidden" id="import_tipe" value="munaqisy">
                                            <div class="form-group">
                                                <label for="">Import Data "RPQ" (hanya Excel File format
                                                    .xlsx)</label>
                                                <input type="file" class="form-control" name="file"
                                                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" name="import" id="btnimportrpq"
                                                    class="btn btn-info" value="Import" />
                                            </div>
                                        </form>
                                    </div><!-- container fluid -->
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

    <div class="modal fade bs-example-modal-diklat-hapus" id="modal-hapus" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-xl-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <form id="hapuscabang" method="POST" enctype="multipart/form-data">@csrf
                                        <div class="form-group text-center">
                                            <h5>"User Akses Cabang Tersebut" juga akan terhapus apabila menghapus Cabang
                                            </h5>
                                            <p class="text-danger">YAKIN INGIN MENGHAPUS CABANG TERSEBUT ?</p>
                                            <input type="hidden" class="form-control text-capitalize" id="id"
                                                name="id" required>
                                        </div>
                                        <div class="row" style="text-align: center">
                                            <div class="form-group col-6 col-xl-6">
                                                <input type="submit" name="hapus" id="btnhapus"
                                                    class="btn btn-danger" value="Ya, Hapus!" />
                                            </div>
                                            <div class="form-group col-6 col-xl-6">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    No, Cancel!
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div><!-- container fluid -->
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade bs-example-modal-diklat-hapus" id="modaltrainer" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#" id="download-trainer" type="button" class="btn btn-sm btn-info text-uppercase"><i
                            class="fa fa-download"></i> Download Data Trainer</a>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12" style="margin-bottom:30px">
                        <h5>TRAINER <br> <span class="text-uppercase" id="cabang_name"></span></h5>
                    </div>
                    <div class="col-xl-12">
                        <table id="datatable-buttons-trainer"
                            class="table table-cabang table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead class="text-bold text-primary" style="text-transform: uppercase; font-size: 10px">
                                <tr>

                                    <th>Nama</th>
                                    <th>Trainer</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>

                            <tbody style="font-size: 10px">
                            </tbody>

                            <tfoot class="text-bold text-primary" style="text-transform: uppercase; font-size: 10px">
                                <tr>

                                    <th>Nama</th>
                                    <th>Trainer</th>
                                    <th>Phone</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div> <!-- end col -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade bs-example-modal-diklat-hapus" id="modalkpa" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#" id="download-kpa" type="button" class="btn btn-sm btn-info text-uppercase"><i
                            class="fa fa-download"></i> Download Data KPA</a>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12" style="margin-bottom:30px">
                        <h5>KPA <br> <span class="text-uppercase" id="cabang_name"></span></h5>
                    </div>
                    <div class="col-xl-12">
                        <table id="datatable-buttons-kpa" class="table table-cabang table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead class="text-bold text-primary" style="text-transform: uppercase; font-size: 10px">
                                <tr>

                                    <th>KPA</th>
                                    <th>KETUA</th>
                                    <th>WILAYAH</th>
                                    <th>TELP</th>
                                </tr>
                            </thead>

                            <tbody style="font-size: 10px">
                            </tbody>

                            <tfoot class="text-bold text-primary" style="text-transform: uppercase; font-size: 10px">
                                <tr>

                                    <th>KPA</th>
                                    <th>KETUA</th>
                                    <th>WILAYAH</th>
                                    <th>TELP</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div> <!-- end col -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade bs-example-modal-diklat-hapus" id="modallembaga" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#" id="download-lembaga" type="button" class="btn btn-sm btn-info text-uppercase"><i
                            class="fa fa-download"></i> Download Data Lembaga</a>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12" style="margin-bottom:30px">
                        <h5>LEMBAGA <br> <span class="text-uppercase" id="cabang_name"></span></h5>
                    </div>
                    <div class="col-xl-12">
                        <table id="datatable-buttons-lembaga"
                            class="table table-cabang table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead class="text-bold text-primary" style="text-transform: uppercase; font-size: 10px">
                                <tr>
                                    <th>LEMBAGA</th>
                                    <th>STATUS</th>
                                    <th>KEPALA</th>
                                    <th>TELP</th>
                                    <th>GURU</th>
                                    <th>SANTRI</th>
                                </tr>
                            </thead>

                            <tbody style="font-size: 10px">
                            </tbody>

                            <tfoot class="text-bold text-primary" style="text-transform: uppercase; font-size: 10px">
                                <tr>
                                    <th>LEMBAGA</th>
                                    <th>STATUS</th>
                                    <th>KEPALA</th>
                                    <th>TELP</th>
                                    <th>GURU</th>
                                    <th>SANTRI</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div> <!-- end col -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade bs-example-modal-kepala-bagian-lama" id="mod_cabang2" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">DAFTAR KEPALA BAGIAN</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="tutup_pilih_kepala()"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive"> --}}
                    <form id="pilih_kepala_bagian_form" method="post" enctype="multipart/form-data">@csrf
                        <input type="hidden" id="lembaga_kode" name="kode">
                        <input type="submit" style="margin-bottom: 20px" id="pilih_kepala_bagian_btn"
                            class="btn btn-sm btn-info" value="Konfirmasi">
                        <table id="datatable-buttons2" class="table prov table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead class="text-bold text-primary">
                                <tr>
                                    <th>Nama</th>
                                    <th>Kepala Bagian</th>
                                    <th>pilih</th>
                                </tr>
                            </thead>
                            <tbody style="text-transform: uppercase; font-size: 12px">
                            </tbody>
                            <tfoot class="text-bold text-primary">
                                <tr>
                                    <th>Nama</th>
                                    <th>Kepala Bagian</th>
                                    <th>pilih</th>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                    <footer class="blockquote-footer">Updated at <cite title="Source Title">2021</cite></footer>
                    {{-- </blockquote> --}}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade bs-example-modal-kepala-lembaga" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0 text-capitalize">Menambahkan Kepala Cabang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kepalas">
                        <input type="hidden" id="id" class="memilih_lembaga" name="lembaga_id">
                        <div class="row">
                            <div class="form-group col-xl-6">
                                <button class="btn btn-info text-capitalize" style="width: 100%; height: 59px;"
                                    onclick="kepala_bagian()">kepala bagian yang sudah ada</button>
                            </div>
                            <div class="form-group col-xl-6">
                                <a href="" id="kepala_baru" class="btn btn-success text-capitalize"
                                    style="width: 100%; height: 59px;">kepala bagian baru</a>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

    {{-- tambah cabang baru --}}
    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade bs-example-modal-tambah-cabang" id="modal-cabang" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">DATA CABANG </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <form method="POST" id="form_tambah_cabang">@csrf
                                        <div class="row">

                                            <div class="form-group col-xl-6">
                                                <select name="provinsi_id" id="mySelect" class="form-control" required>
                                                    <option value="">1* Provinsi</option>
                                                    @foreach ($dt_props2 as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <select id="kabupaten_id" name="kabupaten_id" class="form-control"
                                                    required>
                                                    <option value="">2* Kabupaten / Kota</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger">* </i>Nama Cabang</label>
                                                <input type="text" class="form-control text-capitalize" id="name"
                                                    name="name" 
                                                    @if (auth()->user()->role == 'cabang')
                                                        readonly
                                                    @endif
                                                    required>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger">* </i>Kepala Cabang</label>
                                                <input type="text" class="form-control text-capitalize"
                                                    name="kepalacabang" id="kepalacabang" required>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger">* </i>Kadivre</label>
                                                <input type="text" class="form-control" name="kadivre" id="kadivre"
                                                    required>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger ">* </i>Wilayah</label>
                                                <textarea name="teritorial" id="teritorial" class="text-capitalize form-control" id="" cols="5"
                                                    rows="3" required></textarea>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger">* </i>Status</label>
                                                <select name="status" id="x"
                                                    class="form-control text-capitalize">
                                                    <option value="CABANG">CABANG</option>
                                                    <option value="RPQ">RPQ</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger">* </i>Telp Cabang</label>
                                                <input type="text" class="form-control" id="telp" name="telp"
                                                    required>
                                            </div>
                                            {{-- <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger"> </i>Email Cabang</label>
                                                <input type="email" class="form-control" id="email" name="email">
                                            </div> --}}
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger ">* </i>Alamat Cabang</label>
                                                <textarea name="alamat" class="text-capitalize form-control" id="alamat" cols="5" rows="3"
                                                    required></textarea>
                                            </div>
                                            {{-- <div class="form-group col-xl-3">
                                                <label for=""><i class="text-danger">* </i>Kode Pos</label>
                                                <input type="number" class="form-control" name="pos" required>
                                            </div>
                                            <div class="form-group col-xl-12">
                                                <label for=""><i class="text-danger">* </i>Alamat Ekspedisi (untuk
                                                    pengiriman)</label>
                                                <textarea name="ekspedisi" class="form-control text-capitalize" id=""
                                                    cols="5" rows="3" required></textarea>
                                            </div> --}}
                                            <div class="form-group col-xl-12 col-12">
                                                <input type="submit" id="tambahlembaga_btn" style="width: 100%"
                                                    class="btn btn-info" value="Submit!">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade bs-example-modal-tambah-cabang" id="modal-cabang2" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">DATA CABANG </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <form method="POST" id="form_tambah_cabang2">@csrf
                                        <div class="row">
                                            <input type="hidden" id="id" name="id">
                                            <div class="form-group col-xl-6">
                                                @if (auth()->user()->role == 'cabang')
                                                    <label for=""><i class="text-danger">* </i>Nama Cabang <small class="text-danger">(akses pusat)</small></label>
                                                    <input type="text" class="form-control text-capitalize" id="name"
                                                    name="name" readonly required>  
                                                @else
                                                <label for=""><i class="text-danger">* </i>Nama Cabang</label>
                                                    <input type="text" class="form-control text-capitalize" id="name"
                                                    name="name" required>  
                                                @endif
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger">* </i>Kepala Cabang</label>
                                                <input type="text" class="form-control text-capitalize"
                                                    name="kepalacabang" id="kepalacabang" required>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger">* </i>Kadivre</label>
                                                <input type="text" class="form-control" name="kadivre" id="kadivre"
                                                    required>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger ">* </i>Wilayah</label>
                                                <textarea name="teritorial" id="teritorial" class="text-capitalize form-control" id="" cols="5"
                                                    rows="3" required></textarea>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger">* </i>Status</label>
                                                <select name="status" id="x"
                                                    class="form-control text-capitalize">
                                                    <option value="CABANG">CABANG</option>
                                                    <option value="RPQ">RPQ</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger">* </i>Telp Cabang</label>
                                                <input type="text" class="form-control" id="telp" name="telp"
                                                    required>
                                            </div>

                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger ">* </i>Alamat Cabang</label>
                                                <textarea name="alamat" class="text-capitalize form-control" id="alamat" cols="5" rows="3"
                                                    required></textarea>
                                            </div>

                                            <div class="form-group col-xl-12 col-12">
                                                <input type="submit" id="tambahlembaga_btn2" style="width: 100%"
                                                    class="btn btn-info" value="Submit!">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade bs-example-modal-tambah-cabang" id="modallocation" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">LOKASI CABANG <span id="cabangname_modallocation"
                                class="text-primary" style="text-transform: uppercase"></span> (LONGITUDE & LATITUDE)
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <form method="POST" id="form_add_map">@csrf
                                        <div class="row">
                                            <div class="form-group col-xl-12">
                                                <label for=""><i class="text-danger">* </i>ID Cabang</label>
                                                <input type="text" id="id" class="form-control" name="id"
                                                    readonly required>
                                            </div>

                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger">* </i>Longitude</label>
                                                <input type="text" class="form-control text-capitalize" id="lng"
                                                    name="lng" required>
                                            </div>

                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger">* </i>Latitude</label>
                                                <input type="text" class="form-control text-capitalize" id="lat"
                                                    name="lat" required>
                                            </div>

                                            <div class="form-group col-xl-12 col-12">
                                                <input type="submit" id="btnaddmap" style="width: 100%"
                                                    class="btn btn-info" value="Submit!">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
@endsection

@section('script')
    <!-- Toast -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Required datatable js -->
    <script src="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/pdfmake/pdfmake.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ URL::asset('tilawatipusat/js/pages/datatables.init.js') }}"></script>

    <script>
        var kode;

        $('#modal-hapus').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            console.log(id);
            modal.find('.modal-body #id').val(id);
        })

        $('#modallocation').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var cabang_name = button.data('cabang_name')
            var lng = button.data('lng')
            var lat = button.data('lat')
            var modal = $(this)
            console.log(id);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-header #cabangname_modallocation').html(cabang_name);
            modal.find('.modal-body #lng').val(lng);
            modal.find('.modal-body #lat').val(lat);
            console.log(cabang_name);
        })

        $('#modaltrainer').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var cabang_id = button.data('cabang_id')
            var cabang_name = button.data('cabang_name')
            var download = button.data('download')
            var modal = $(this)
            console.log(cabang_id);
            modal.find('.modal-body #cabang_name').html(cabang_name);
            document.getElementById("download-trainer").href = download;
            $('#datatable-buttons-trainer').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/show-list-data-trainer/' + cabang_id,
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'trains',
                        name: 'trains'
                    },
                    {
                        data: 'telp',
                        name: 'telp'
                    },
                ]
            });
        })

        $('#modalkpa').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var cabang_id = button.data('cabang_id')
            var cabang_name = button.data('cabang_name')
            var download = button.data('download')
            var modal = $(this)
            console.log(cabang_id);
            modal.find('.modal-body #cabang_name').html(cabang_name);
            document.getElementById("download-kpa").href = download;
            $('#datatable-buttons-kpa').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/show-data-kpa/' + cabang_id,
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'ketua',
                        name: 'ketua'
                    },
                    {
                        data: 'wilayah',
                        name: 'wilayah'
                    },
                    {
                        data: 'telp',
                        name: 'telp'
                    },

                ]
            });
        })

        $('#modallembaga').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var cabang_id = button.data('cabang_id')
            var cabang_name = button.data('cabang_name')
            var download = button.data('download')
            var modal = $(this)
            console.log(cabang_id);
            modal.find('.modal-body #cabang_name').html(cabang_name);
            console.log(download);
            document.getElementById("download-lembaga").href = download;
            $('#datatable-buttons-lembaga').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/diklat-lembaga-data-cabang/' + cabang_id,
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'statuss',
                        name: 'status'
                    },
                    {
                        data: 'kepalalembaga',
                        name: 'kepalalembaga'
                    },
                    {
                        data: 'telp',
                        name: 'telp'
                    },
                    {
                        data: 'jml_guru',
                        name: 'jml_guru'
                    },
                    {
                        data: 'jml_santri',
                        name: 'jml_santri'
                    },

                ]
            });
        })

        $('#hapuscabang').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('cabang.hapus') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnhapus').attr('disabled', 'disabled');
                    $('#btnhapus').val('Proses Hapus Data');
                },
                success: function(data) {
                    if (data.success) {
                        //sweetalert and redirect
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btnhapus').val('Ya, Hapus!');
                        $('.bs-example-modal-diklat-hapus').modal('hide');
                        $('#btnhapus').attr('disabled', false);

                        // UPDATE JUMLAH DATA
                        $.ajax({
                            url: '{{ route('diklat.cabang_kab') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('kb').innerHTML = data;
                                console.log(data);
                            }
                        });

                        $.ajax({
                            url: '{{ route('diklat.cabang_pro') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('pv').innerHTML = data;
                                console.log(data);
                            }
                        });

                        $.ajax({
                            url: '{{ route('diklat.cabang_tot') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('cb').innerHTML = data;
                                console.log(data);
                            }
                        });
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('#form_tambah_cabang').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('diklat.cabang_store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#tambahlembaga_btn').attr('disabled', 'disabled');
                    $('#tambahlembaga_btn').val('Proses Menyimpan Data');

                },
                success: function(data) {
                    if (data.success) {
                        $("#form_tambah_cabang")[0].reset();
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#tambahlembaga_btn').val('Submit!');
                        $('.bs-example-modal-tambah-cabang').modal('hide');
                        $('#tambahlembaga_btn').attr('disabled', false);
                        swal({
                            title: "Success!",
                            text: "Cabang Baru Berhasil Di Tabahkan!",
                            type: "success"
                        })

                        $.ajax({
                            url: '{{ route('diklat.cabang_kab') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('kb').innerHTML = data;
                                console.log(data);
                            }
                        });

                        $.ajax({
                            url: '{{ route('diklat.cabang_pro') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('pv').innerHTML = data;
                                console.log(data);
                            }
                        });

                        $.ajax({
                            url: '{{ route('diklat.cabang_tot') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('cb').innerHTML = data;
                                console.log(data);
                            }
                        });
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('#form_add_map').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('maps.cabang.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnaddmap').attr('disabled', 'disabled');
                    $('#btnaddmap').val('Proses Menyimpan Data');

                },
                success: function(data) {
                    if (data.success) {
                        $("#form_add_map")[0].reset();
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btnaddmap').val('Submit!');
                        $('#modallocation').modal('hide');
                        $('#btnaddmap').attr('disabled', false);
                        swal({
                            title: "Success!",
                            text: "Lokasi Berhasil Diperbarui",
                            type: "success"
                        })
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('#addpenguruscabang').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/post-pengurus-cabang",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnpengurus').attr('disabled', 'disabled');
                    $('#btnpengurus').val('Proses Mengupdate Data');

                },
                success: function(data) {
                    if (data.status == 200) {
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btnpengurus').val('Update');
                        $('#btnpengurus').attr('disabled', false);
                        swal({
                            title: "Success!",
                            text: data.message,
                            type: "success"
                        }).then(function() {
                            window.location = "/diklat-cabang";
                        });
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('#form_tambah_cabang2').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('update.cabang') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#tambahlembaga_btn2').attr('disabled', 'disabled');
                    $('#tambahlembaga_btn2').val('Proses Menyimpan Data');

                },
                success: function(data) {
                    if (data.success) {
                        $("#form_tambah_cabang2")[0].reset();
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#tambahlembaga_btn2').val('Submit!');
                        $('#modal-cabang2').modal('hide');
                        $('#tambahlembaga_btn2').attr('disabled', false);
                        toastr.success(data.success);
                        // swal({
                        //     title: "Success!",
                        //     text: "Cabang Baru Berhasil Di Tabahkan!",
                        //     type: "success"
                        // })

                        $.ajax({
                            url: '{{ route('diklat.cabang_kab') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('kb').innerHTML = data;
                                console.log(data);
                            }
                        });

                        $.ajax({
                            url: '{{ route('diklat.cabang_pro') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('pv').innerHTML = data;
                                console.log(data);
                            }
                        });

                        $.ajax({
                            url: '{{ route('diklat.cabang_tot') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('cb').innerHTML = data;
                                console.log(data);
                            }
                        });
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        function tutup_pilih_kepala() {
            $("#pilih_kepala_bagian_form")[0].reset();
        }
        $('.bs-example-modal-kepala-lembaga').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            id = button.data('kode')
            var modal = $(this)
            $('#kepala_baru').attr('href', '/diklat-kepala-bagian-cabang-create/' + id);
            kode = modal.find('.modal-body #id').val(id);
        })

        function kepala_bagian() {
            $('.bs-example-modal-kepala-lembaga').modal('hide');
            $('.bs-example-modal-kepala-bagian-lama').modal('show');
            var ya = $('.memilih_lembaga').val();
            document.getElementById('lembaga_kode').value = ya;
            console.log(ya);
        }

        $('#pilih_kepala_bagian_form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/diklat-kepala-bagian-pilih-cabang",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#pilih_kepala_bagian_btn').attr('disabled', 'disabled');
                    $('#pilih_kepala_bagian_btn').val('Proses Update Data');
                },
                success: function(data) {
                    if (data.success) {
                        //sweetalert and redirect
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $("#pilih_kepala_bagian_form")[0].reset();
                        $('#pilih_kepala_bagian_btn').val('Konfirmasi!');
                        $('.bs-example-modal-kepala-bagian-lama').modal('hide');
                        $('#pilih_kepala_bagian_btn').attr('disabled', false);
                        swal({
                            title: "Success!",
                            text: "Kepala Cabang Sudah Dipilih!",
                            type: "success"
                        })
                    } else {
                        $('#pilih_kepala_bagian_btn').val('Konfirmasi!');
                        $('#pilih_kepala_bagian_btn').attr('disabled', false);
                        swal({
                            title: "Error!",
                            text: "Pilih Kepala Lembaga / Cabang Terlebih Dahulu!",
                            type: "error"
                        })
                    }
                }
            });
        });

        $(document).ready(function() {
            $('select[name="provinsi_id"]').on('change', function() {
                //mencari kota/kab dari provinsi 3 tingkat
                var provinsi_id = $(this).val();
                console.log(provinsi_id);
                if (provinsi_id) {

                    $.ajax({
                        url: '/fetch/' + provinsi_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="kabupaten_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="kabupaten_id"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                            console.log(data);
                            var a = $("#kabupaten_id option:selected").val();
                            console.log("kabupaten" + a);
                            if (a) {
                                $.ajax({
                                    url: '/fetch2/' + a,
                                    type: "GET",
                                    dataType: "json",
                                    success: function(data) {
                                        $('select[name="kecamatan_id"]').empty();
                                        $.each(data, function(key, value) {
                                            $('select[name="kecamatan_id"]')
                                                .append('<option value="' +
                                                    key + '">' + value +
                                                    '</option>');
                                        });
                                        console.log(data);
                                        var x = $("#kecamatan_id option:selected")
                                            .val();
                                        console.log("kecamatan" + x);
                                        if (x) {
                                            $.ajax({
                                                url: '/fetch3/' + x,
                                                type: "GET",
                                                dataType: "json",
                                                success: function(data) {
                                                    $('select[name="kelurahan_id"]')
                                                        .empty();
                                                    $.each(data,
                                                        function(
                                                            key,
                                                            value) {
                                                            $('select[name="kelurahan_id"]')
                                                                .append(
                                                                    '<option value="' +
                                                                    key +
                                                                    '">' +
                                                                    value +
                                                                    '</option>'
                                                                );
                                                        });
                                                    console.log(data);
                                                    var x = $(
                                                        "#kelurahan_id option:selected"
                                                    ).val();
                                                    console.log(
                                                        "kelurahan" +
                                                        x);
                                                }
                                            });
                                        } else {
                                            $('select[name="kelurahan_id"]').empty()
                                                .disabled();
                                        }
                                    }
                                });
                            } else {
                                $('select[name="kecamatan_id"]').empty().disabled();
                            }
                        }
                    });
                } else {
                    $('select[name="kabupaten_id"]').empty().disabled();
                }
            });

            $('select[name="kabupaten_id"]').on('change', function() {
                //mencari kecamatan dari kota/kab 2 tingkat
                var kabupaten_id = $(this).val();
                console.log(kabupaten_id);
                if (kabupaten_id) {

                    $.ajax({
                        url: '/fetch2/' + kabupaten_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="kecamatan_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="kecamatan_id"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                            console.log(data);
                            var x = $("#kecamatan_id option:selected").val();
                            console.log("kecamatan" + x);
                            if (x) {
                                $.ajax({
                                    url: '/fetch3/' + x,
                                    type: "GET",
                                    dataType: "json",
                                    success: function(data) {
                                        $('select[name="kelurahan_id"]').empty();
                                        $.each(data, function(key, value) {
                                            $('select[name="kelurahan_id"]')
                                                .append('<option value="' +
                                                    key + '">' + value +
                                                    '</option>');
                                        });
                                        console.log(data);
                                        var x = $("#kelurahan_id option:selected")
                                            .val();
                                        console.log("kelurahan" + x);
                                    }
                                });
                            } else {
                                $('select[name="kelurahan_id"]').empty().disabled();
                            }
                        }
                    });
                } else {
                    $('select[name="kecamatan_id"]').empty().disabled();
                }
            });

            $('select[name="kecamatan_id"]').on('change', function() {
                //mencari kelurahan dari kecamatan
                var kecamatan_id = $(this).val();
                console.log(kecamatan_id);
                if (kecamatan_id) {

                    $.ajax({
                        url: '/fetch3/' + kecamatan_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="kelurahan_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="kelurahan_id"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                            console.log(data);
                        }
                    });
                } else {
                    $('select[name="kelurahan_id"]').empty().disabled();
                }
            });
            $('#datatable-buttons2').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('diklat.kepala_pilih') }}',
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'bagian',
                        name: 'cabang.name',
                        name: 'lembaga.name',
                    },
                    {
                        data: 'pilih',
                        name: 'pilih'
                    }
                ]
            });

            $.ajax({
                url: '{{ route('diklat.cabang_kab') }}',
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    document.getElementById('kb').innerHTML = data;
                    console.log(data);
                }
            });

            $.ajax({
                url: '{{ route('diklat.cabang_pro') }}',
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    document.getElementById('pv').innerHTML = data;
                    console.log(data);
                }
            });

            $.ajax({
                url: '{{ route('diklat.cabang_tot') }}',
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    document.getElementById('cb').innerHTML = data;
                    console.log(data);
                }
            });

            $('#datatable-buttons').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('diklat.cabang_data') }}',
                },
                columns: [
                    // {
                    //     data: 'kode',
                    //     name: 'kode'
                    // },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    // {
                    //     data: 'kepala',
                    //     name: 'kepala.name',
                    //     orderable: false,
                    // },
                    {
                        data: 'kepalacabang',
                        name: 'kepalacabang',
                    },
                    {
                        data: 'provinsi',
                        name: 'provinsi.nama'
                    },
                    {
                        data: 'kabupaten',
                        name: 'kabupaten.nama'
                    },
                    {
                        data: 'telp',
                        name: 'telp'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'kadivre',
                        name: 'kadivre'
                    },
                    {
                        data: 'teritorial',
                        name: 'teritorial'
                    },
                    {
                        data: 'total_kpa',
                        name: 'total_kpa'
                    },
                    {
                        searchable: false,
                        orderable: false,
                        data: 'trainers',
                        name: 'trainers'
                    },
                    {
                        data: 'tot_lembaga',
                        name: 'tot_lembaga'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: 'opsi',
                        name: 'opsi'
                    }
                ]
            });
        })

        //import rpq
        $('#importrpq').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('import.rpq') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnimportrpq').attr('disabled', 'disabled');
                    $('#btnimportrpq').val('Importing Process');
                },
                success: function(data) {
                    if (data.success) {
                        //get total data cabang
                        $.ajax({
                            url: '{{ route('dashboard.cabang') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('cb').innerHTML = data;
                                console.log(data);
                            }
                        });
                        //sweetalert and refresh datatable
                        $("#importrpq")[0].reset();
                        toastr.success(data.success);
                        var oTable = $('#datatable_cabang').dataTable();
                        oTable.fnDraw(false);
                        $('#btnimport').val('Import');
                        $('#btnimport').attr('disabled', false);
                        $('.bs-example-modal-rpq').modal('hide');
                        swal("Done!", data.message, "success");
                    }
                    if (data.error) {
                        $('#message').html('<div class="alert alert-danger">' + data.error + '</div>');
                        $('#btnimport').attr('disabled', false);
                        $('#btnimport').val('Import');
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
        //import cabang
        $('#importcabang').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('import.cabang') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnimport').attr('disabled', 'disabled');
                    $('#btnimport').val('Importing Process');
                },
                success: function(data) {
                    if (data.success) {
                        //sweetalert and refresh datatable
                        $("#importcabang")[0].reset();
                        toastr.success(data.success);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btnimport').val('Import');
                        $('#btnimport').attr('disabled', false);
                        $('.bs-example-modal-cabang').modal('hide');
                        swal("Done!", data.message, "success");
                    }
                    if (data.error) {
                        $('#message').html('<div class="alert alert-danger">' + data.error + '</div>');
                        $('#btnimport').attr('disabled', false);
                        $('#btnimport').val('Import');
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        // cabang
        $('#modal-cabang2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var kepalacabang = button.data('kepalacabang')
            var status = button.data('status')
            var kadivre = button.data('kadivre')
            var teritorial = button.data('teritorial')
            var alamat = button.data('alamat')
            var telp = button.data('telp')
            var email = button.data('email')
            var kabupaten = button.data('kabupaten_id')
            var provinsi = button.data('provinsi_id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #kepalacabang').val(kepalacabang);
            modal.find('.modal-body #x').val(status);
            modal.find('.modal-body #alamat').val(alamat);
            modal.find('.modal-body #telp').val(telp);
            modal.find('.modal-body #kadivre').val(kadivre);
            modal.find('.modal-body #kabupaten_id').val(kabupaten);
            modal.find('.modal-body .provinsi_id').val(provinsi);
            modal.find('.modal-body #teritorial').val(teritorial);
            // modal.find('.modal-body #email').val(email);
        })
    </script>
@endsection
