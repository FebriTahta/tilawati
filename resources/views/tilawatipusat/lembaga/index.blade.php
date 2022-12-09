@extends('layouts.tilawatipusat_layouts.master')

@section('title')
    lembaga
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="{{ URL::asset('tilawatipusat/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
        @slot('title')
            lembaga
        @endslot
        @slot('title_li')
            Tilawati
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-xl-6">
            @component('common-tilawatipusat.dashboard-widget')
                @slot('title')
                    Total Lembaga seluruh Indonesia <br> <b id="cb"> ??? </b> lembaga <br> <small><b id="lem_aktif"></b> Aktif & <b
                            id="lem_nonaktif"></b>
                        Non Aktif</small>
                @endslot
                @slot('iconClass')
                    mdi mdi-mdi mdi-contact-mail-outline
                    tag-plus-outline
                @endslot
                @slot('price')
                @endslot
            @endcomponent
        </div>
        @if (auth()->user()->role == 'cabang')
            <div class="col-xl-6">
                @component('common-tilawatipusat.dashboard-widget')
                    @slot('title')
                        Total Lembaga Cabang Anda <br> <b id="cb2"> ??? </b> lembaga <br> <small><b id="lem_aktif2"></b>
                            Aktif & <b id="lem_nonaktif2"></b>
                            Non Aktif</small>
                    @endslot
                    @slot('iconClass')
                        mdi mdi-mdi mdi-contact-mail-outline
                        tag-plus-outline
                    @endslot
                    @slot('price')
                    @endslot
                @endcomponent
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="prov"> Cari Berdasarkan Provinsi</label>
                            <div class="row">
                                <div class="col-md-9" style="margin-bottom: 10px">
                                    <select name="prov" class="form-control" id="prov">
                                        <option value=""></option>
                                        @php
                                            $prov = App\Models\Provinsi::all();
                                        @endphp
                                        @foreach ($prov as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3" style="margin-bottom: 10px">
                                    <form action="/export-lembaga-search-provinsi" method="POST">@csrf
                                        <input type="hidden" name="prov_id" id="prov_id">
                                        <button type="submit" class="btn btn-outline-primary" style="min-width: 160px">Cetak Data</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if (auth()->user()->role == 'cabang')
                        <?php $salah1 = App\Models\Lembaga::where('cabang_id', auth()->user()->cabang->id)
                            ->where('kabupaten_id', null)
                            ->count(); ?>
                        @if ($salah1 > 0)
                            <div class="col-lg-12 alert alert-danger">
                                <p>{{ $salah1 }} Lembaga dengan kesalahan
                                    penulisan
                                    Kota / Kabupaten</p>
                            </div>
                        @endif
                    @endif
                    <h4 class="card-title">Data lembaga</h4>
                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br><code>Data Import dan Eksport Berbeda
                            Format (Berhati-hati ketika meng-importkan data baru)</code></p>
                    @if (auth()->user()->role == 'cabang')
                        <button class="btn btn-sm btn-success mb-2 mr-1" style="width:130px " data-toggle="modal"
                            data-target=".bs-example-modal-tambah-lembaga"><i class="mdi mdi-plus"></i> tambah
                            lembaga</button>
                        <button class="btn btn-sm btn-outline-success mb-2  mr-1" style="width:130px " data-toggle="modal"
                            data-target=".bs-example-modal-lembaga"><i class="mdi mdi-cloud-upload"></i> import
                            lembaga</button>

                        <a href="/export-template-lembaga" class="btn btn-sm btn-outline-primary mb-2 mr-1 text-uppercase"
                            style="font-size: 12px "><i class="mdi mdi-download"></i> Unduh Template</a>

                        <a href="/export-template-lembaga/{{ auth()->user()->cabang->id }}"
                            class="btn btn-sm btn-outline-warning mb-2 mr-1 text-uppercase" style="font-size: 12px "><i
                                class="mdi mdi-download"></i> Unduh Data Lembaga</a>

                        <a href="/hapus-lembaga/{{ auth()->user()->cabang->id }}"
                            class="btn btn-sm btn-outline-danger mb-2 mr-1 text-uppercase" style="font-size: 12px "><i
                                class="fa fa-trash"></i> Hapus Semua</a>
                    @endif

                    {{-- <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive"> --}}
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-lembaga table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size: 12px">
                            <thead class="text-bold text-primary">
                                <tr>
                                    <th>Name</th>
                                    <th>Kepala</th>
                                    <th>Telephone</th>
                                    <th>Kota / Kab</th>
                                    <th>Provinsi</th>
                                    <th>Guru</th>
                                    <th>Santri</th>
                                    <th>Alamat</th>
                                    <th>Pengelola</th>
                                    <th>Status</th>
                                    <th>OPSI</th>
                                </tr>
                            </thead>

                            <tbody style="text-transform: uppercase; font-size: 10px">
                            </tbody>

                            <tfoot class="text-primary" style="font-size: 12px">
                                <tr>
                                    <th>Name</th>
                                    <th>Kepala</th>
                                    <th>Telephone</th>
                                    <th>Kota / Kab</th>
                                    <th>Provinsi</th>
                                    <th>Guru</th>
                                    <th>Santri</th>
                                    <th>Alamat</th>
                                    <th>Pengelola</th>
                                    <th>Status</th>
                                    <th>OPSI</th>
                                </tr>
                            </tfoot>
                        </table>
                        <footer class="blockquote-footer">Updated at <cite title="Source Title">2021</cite></footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <!--modal import lembaga-->
    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade bs-example-modal-lembaga" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">IMPORT DATA LEMBAGA </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <form id="importlembaga" method="POST" enctype="multipart/form-data">@csrf
                                            <input type="hidden" id="import_tipe" value="munaqisy">
                                            <div class="form-group">
                                                <label for="">Import Data "lembaga" (hanya Excel File format .xlsx)</label>
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

    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade bs-example-modal-tambah-lembaga" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">Tambah Lembaga Baru </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <form method="POST" id="tambahlembaga">@csrf
                                        <div class="row">
                                            <?php $kab = App\Models\Kabupaten::orderBy('nama','asc')->get(); ?>
                                            <div class=" form-group col-md-4" style="margin-bottom: 10px">
                                                <label for="kabupaten_id"><small>1. KOTA / KABUPATEN</small></label>
                                                <select name="kabupaten_id" data-width="100%" id="kota"
                                                    class="form-control required" style="font-size: 12px" required>
                                                    <option value=""></option>
                                                    @foreach ($kab as $item)
                                                        <option value="{{ $item->id }}">{{ substr($item->nama,4) }} ( {{substr($item->nama,0,4)}} )</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class=" form-group col-md-4" id="block_kecamatan" style="display: none">
                                                <label for="kecamatan_id"><small>2. KECAMATAN</small></label>
                                                <select name="kecamatan_id" data-width="100%" id="kecamatan"
                                                    class="form-control required" required
                                                    style="font-size: 12px; text-transform: uppercase">
                                                    <option value=""></option>
                                                </select>

                                            </div>
                                            <div class=" form-group col-md-4" id="block_kelurahan" style="display: none">
                                                <label for="kelurahan_id"><small>3. KELURAHAN</small></label>
                                                <select name="kelurahan_id" data-width="100%" id="kelurahan"
                                                    class="form-control required" required
                                                    style="font-size: 12px; text-transform: uppercase">
                                                    <option value=""></option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                
                                                @if (auth()->user()->role == 'cabang')
                                                <input type="hidden" name="cabang_id" id="cabang_id"
                                                value="{{ auth()->user()->cabang->id }}" required>
                                                @endif
                                                
                                            </div>
                                            
                                            <hr>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger">* </i>Nama Lembaga</label>
                                                <input type="text" class="form-control" name="name" required>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger">* </i>Nama Kepala Lembaga</label>
                                                <input type="text" class="form-control" name="kepalalembaga" required>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger">* </i>Telp Lembaga</label>
                                                <input type="number" class="form-control" name="telp" required>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger"> </i>Email Lembaga</label>
                                                <input type="email" class="form-control" name="email">
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger"> </i>Website Lembaga</label>
                                                <input type="text" class="form-control" name="website">
                                            </div>
                                            <div class="form-group col-xl-12">
                                                <label for=""><i class="text-danger">* </i>Alamat Lembaga (lokasi
                                                    lembaga)</label>
                                                <textarea name="alamat" class="form-control" id="" cols="5" rows="3"
                                                    required></textarea>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <select name="jenjang_id" class="form-control" id="" required>
                                                    <option value=""><i class="text-danger">*</i> Kelembagaan
                                                    </option>
                                                    @foreach ($jenjang as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <select name="pengelola" class="form-control" id="pengelola" required>
                                                    <option value=""><i class="text-danger">*</i> Pengelolaan
                                                    </option>
                                                    <option value="Yayasan">1. Yayasan</option>
                                                    <option value="Masjid">2. Masjid</option>
                                                    <option value="Pribadi">3. Pribadi</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-xl-3">
                                                <label for=""><i class="text-danger"> </i>Kode Pos</label>
                                                <input type="number" class="form-control" name="pos" >
                                            </div>
                                            <div class="form-group col-xl-3">
                                                <label for=""><i class="text-danger"> </i>Tahun Masuk</label>
                                                <input type="date" class="form-control" name="tahunmasuk" >
                                            </div>
                                            <div class="form-group col-xl-3">
                                                <label for=""><i class="text-danger">* </i>Jumlah Guru</label>
                                                <input type="number" class="form-control" name="jml_guru" required>
                                            </div>
                                            <div class="form-group col-xl-3">
                                                <label for=""><i class="text-danger">* </i>Jumlah Santri</label>
                                                <input type="number" class="form-control" name="jml_santri" required>
                                            </div>
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
        <div class="modal fade bs-example-modal-kepala-lembaga" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0 text-uppercase">menambahkan kepala lembaga</h5>
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
                                <a id="kepala_baru" href="" class="btn btn-success text-capitalize"
                                    style="width: 100%; height: 59px;">kepala bagian baru</a>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

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

    <div class="modal fade bs-example-modal-kota" id="addkota" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="tambahkota" method="POST" enctype="multipart/form-data">@csrf
                        <input type="hidden" id="idpeserta" name="id">
                        <div class="form-group text-center col-12">
                            <p>Daftar Kota & Kabupaten</p>
                            <select name="sel_kab" id="sel_kab" style="text-transform: lowercase; max-width: auto;"
                                class="form-control select2" required>
                                <option value=""> Cari & Pilih Kab / Kota</option>
                            </select>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" id="tambah" value="Tambahkan" class="btn btn-sm btn-primary">
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade bs-example-modal-diklat-hapus" id="modal-hapus" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-xl-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <form id="hapuslembaga" method="POST" enctype="multipart/form-data">@csrf
                                        <div class="form-group text-center">
                                            <h5>Anda yakin akan menghapus Lembaga tersebut ?</h5>
                                            <input type="hidden" class="form-control text-capitalize" id="id" name="id"
                                                required>
                                        </div>
                                        <div class="row" style="text-align: center">
                                            <div class="form-group col-6 col-xl-6">
                                                <input type="submit" name="hapus" id="btnhapus" class="btn btn-danger"
                                                    value="Ya, Hapus!" />
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

    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade bs-example-modal-tambah-lembaga" tabindex="-1" id="modal-edit" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">UPDATE DATA LEMBAGA </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <form method="POST" id="tambahlembaga2">@csrf
                                        <div class="row">
                                            <input type="hidden" name="kabupaten_id" id="kab">
                                            
                                        </div>
                                        <div class="row">
                                            <input type="hidden" name="id" id="id">
                                            <hr>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger">* </i>Nama Lembaga</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger">* </i>Nama Kepala Lembaga</label>
                                                <input type="text" class="form-control" id="kepala" name="kepalalembaga" required>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger">* </i>Telp Lembaga</label>
                                                <input type="number" class="form-control" id="telp" name="telp" required>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger"> </i>Email Lembaga</label>
                                                <input type="email" class="form-control" id="email" name="email">
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label for=""><i class="text-danger"> </i>Website Lembaga</label>
                                                <input type="text" class="form-control" id="website" name="website">
                                            </div>
                                            <div class="form-group col-xl-12">
                                                <label for=""><i class="text-danger">* </i>Alamat Lembaga (lokasi
                                                    lembaga)</label>
                                                <textarea name="alamat" class="form-control" id="alamat" cols="5"
                                                    rows="3" required></textarea>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <select name="jenjang_id" class="form-control" id="jenjang_id" required>
                                                    <option value=""><i class="text-danger">*</i> Kelembagaan</option>
                                                    @foreach ($jenjang as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <select name="pengelola" class="form-control" id="pengelola" required>
                                                    <option value=""><i class="text-danger">*</i> Pengelolaan</option>
                                                    <option value="Yayasan">1. Yayasan</option>
                                                    <option value="Masjid">2. Masjid</option>
                                                    <option value="Pribadi">3. Pribadi</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-xl-3">
                                                <label for=""><i class="text-danger"> </i>Kode Pos</label>
                                                <input type="number" class="form-control" id="pos" name="pos">
                                            </div>
                                            <div class="form-group col-xl-3">
                                                <label for=""><i class="text-danger"> </i>Tahun Masuk</label>
                                                <input type="date" class="form-control" name="tahunmasuk">
                                            </div>
                                            <div class="form-group col-xl-3">
                                                <label for=""><i class="text-danger">* </i>Jumlah Guru</label>
                                                <input type="number" class="form-control" id="guru" name="jml_guru"
                                                    required>
                                            </div>
                                            <div class="form-group col-xl-3">
                                                <label for=""><i class="text-danger">* </i>Jumlah Santri</label>
                                                <input type="number" class="form-control" id="santri" name="jml_santri"
                                                    required>
                                            </div>

                                            <div class="form-group col-xl-6">
                                                <select name="status" class="form-control" required>
                                                    <option value=""><i class="text-danger">*</i> Status</option>
                                                    <option value="Aktif">1. Aktif</option>
                                                    <option value="Non Aktif">2. Non Aktif</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-xl-12 col-12">
                                                <input type="submit" id="btnsub" style="width: 100%" class="btn btn-info"
                                                    value="Submit!">
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
    {{-- <form id="ubah_status">
    <input type="hidden" data>
</form> --}}
@endsection

@section('script')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
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

    <script src="{{ URL::asset('/tilawatipusat/libs/select2/select2.min.js') }}"></script>

    <script>
        $('#modal-hapus').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            console.log(id);
            modal.find('.modal-body #id').val(id);
        })


        $('#modal-edit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var kepala = button.data('kepala')
            var telp = button.data('telp')
            var kab = button.data('kab')
            var guru = button.data('guru')
            var santri = button.data('santri')
            var alamat = button.data('alamat')
            var pengelola = button.data('pengelola')
            var status = button.data('status')
            var jenjang_id = button.data('jenjang')
            var email = button.data('email')
            var website = button.data('website')
            var pos = button.data('pos')
            console.log(pos);
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #kepala').val(kepala);
            modal.find('.modal-body #telp').val(telp);
            modal.find('.modal-body #kab').val(kab);
            modal.find('.modal-body #guru').val(guru);
            modal.find('.modal-body #santri').val(santri);
            modal.find('.modal-body #alamat').val(alamat);
            modal.find('.modal-body #pengelola').val(pengelola);
            modal.find('.modal-body #status').val(status);
            modal.find('.modal-body #jenang_id').val(jenjang_id);
            modal.find('.modal-body #email').val(email);
            modal.find('.modal-body #website').val(website);
            modal.find('.modal-body #pos').val(pos);
        })
        $('#hapuslembaga').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('lembaga.hapus') }}",
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
                        
                        $.ajax({
                            url: '{{ route('diklat.lembaga_nonaktif') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('lem_nonaktif').innerHTML = data;
                                console.log(data);
                            }
                        });

                        $.ajax({
                            url: '{{ route('diklat.lembaga_aktif') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('lem_aktif').innerHTML = data;
                                console.log(data);
                            }
                        });

                        $.ajax({
                            url: '{{ route('diklat.lembaga_nonaktif2') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('lem_nonaktif2').innerHTML = data;
                                console.log(data);
                            }
                        });

                        $.ajax({
                            url: '{{ route('diklat.lembaga_aktif2') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('lem_aktif2').innerHTML = data;
                                console.log(data);
                            }
                        });

                        $.ajax({
                            url: '{{ route('diklat.lembaga_tot') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('cb').innerHTML = data;
                                console.log(data);
                            }
                        });

                        $.ajax({
                            url: '{{ route('diklat.lembaga_tot2') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('cb2').innerHTML = data;
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

        var kode;
        $('#tambahlembaga').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('diklat.lembaga_store') }}",
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
                        window.location.reload();
                        toastr.success(data.success);
                        $("#tambahlembaga")[0].reset();
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#tambahlembaga_btn').val('Submit!');
                        $('.bs-example-modal-tambah-lembaga').modal('hide');
                        $('#tambahlembaga_btn').attr('disabled', false);
                        
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('#tambahlembaga2').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('diklat.lembaga_store2') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnsub').attr('disabled', 'disabled');
                    $('#btnsub').val('Proses Menyimpan Perubahan Data');

                },
                success: function(data) {
                    if (data.success) {
                        toastr.success(data.success);
                        window.location.reload();
                        $("#tambahlembaga2")[0].reset();
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btnsub').val('Submit!');
                        $('#modal-edit').modal('hide');
                        $('#btnsub').attr('disabled', false);
                        
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
            $('#kepala_baru').attr('href', '/diklat-kepala-bagian-lembaga-create/' + id);
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
                url: "/diklat-kepala-bagian-pilih",
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
                            text: "Kepala Lembaga Sudah Dipilih!",
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
            

            $('select[name="kabupaten_id"]').on('change', function() {
                var kabupaten_id = $(this).val();
                document.getElementById('block_kecamatan').style.display = "";
                document.getElementById('block_kelurahan').style.display = "none";
                document.getElementById('kelurahan').value = "";
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
                            // menampilkan hasil kecamatan awal		
                            // var kab = $( "#kecamatan option:selected" ).val();
                            document.getElementById('kecamatan').value = "";
                            // sini


                            
                        }
                    });
                } else {
                    $('select[name="kecamatan_id"]').empty().disabled();
                }
            })

            $('select[name="kecamatan_id"]').on('change', function() {
                var kecamatan_id = $(this).val();
                document.getElementById('block_kelurahan').style.display = "";
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
                            // menampilkan hasil kecamatan awal		
                            // var x = $( "#kelurahan_id option:selected" ).val();
                            document.getElementById('kelurahan').value = "";
                        }
                    });
                } else {
                    $('select[name="kelurahan_id"]').empty().disabled();
                }
            })

            $('select[name="kabupaten_id"]').on('change', function() {
                //mencari kota/kab dari provinsi 3 tingkat
                var kabupaten_id = $('#kab').val();
                console.log(kabupaten_id);
                if (kabupaten_id) {
                    $.ajax({
                        url: '/fetch2/' + kabupaten_id,
                        type: "GET",
                        dataType: "json",
                        success: function(dk) {
                            $('select[name="kecamatan_id2"]')
                                .empty();
                            $.each(dk, function(key,
                                value) {
                                $('select[name="kecamatan_id2"]')
                                    .append(
                                        '<option value="' +
                                        key +
                                        '">' +
                                        value +
                                        '</option>'
                                    );
                            });
                            var x = $(
                                "#kecamatan_id option:selected"
                            ).val();
                            console.log('kecamatan_id2' +
                                x);
                            $.ajax({
                                url: '/fetch3/' +
                                    x,
                                type: "GET",
                                dataType: "json",
                                success: function(
                                    city) {
                                    $('select[name="kelurahan_id2"]')
                                        .empty();
                                    $.each(city,
                                        function(
                                            key,
                                            value
                                        ) {
                                            $('select[name="kelurahan_id2"]')
                                                .append(
                                                    '<option value="' +
                                                    key +
                                                    '">' +
                                                    value +
                                                    '</option>'
                                                );
                                        }
                                    );
                                    var y =
                                        $(
                                            "#kelurahan_id2 option:selected"
                                        )
                                        .val();
                                }
                            });
                        }
                    });
                }
            });

            //kecamatan_kelurahan
            $('select[name="kecamatan_id"]').on('change', function() {
                var kecamatan_id = $('#kecamatan_id').val();
                console.log(kecamatan_id);
                if (kecamatan_id) {
                    $.ajax({
                        url: '/fetch3/' + kecamatan_id,
                        type: "GET",
                        dataType: "json",
                        success: function(city) {
                            $('select[name="kelurahan_id"]').empty();
                            $.each(city, function(key, value) {
                                $('select[name="kelurahan_id"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                            var y = $("#kelurahan_id option:selected").val();
                        }
                    });
                }
            });

            $('select[name="kecamatan_id2"]').on('change', function() {
                var kecamatan_id = $('#kecamatan_id2').val();
                console.log(kecamatan_id);
                if (kecamatan_id) {
                    $.ajax({
                        url: '/fetch3/' + kecamatan_id,
                        type: "GET",
                        dataType: "json",
                        success: function(city) {
                            $('select[name="kelurahan_id"]').empty();
                            $.each(city, function(key, value) {
                                $('select[name="kelurahan_id"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                            var y = $("#kelurahan_id option:selected").val();
                        }
                    });
                }
            });



            $.ajax({
                url: '{{ route('diklat.lembaga_nonaktif') }}',
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    document.getElementById('lem_nonaktif').innerHTML = data;
                    console.log(data);
                }
            });

            $.ajax({
                url: '{{ route('diklat.lembaga_aktif') }}',
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    document.getElementById('lem_aktif').innerHTML = data;
                    console.log(data);
                }
            });

            $.ajax({
                url: '{{ route('diklat.lembaga_nonaktif2') }}',
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    document.getElementById('lem_nonaktif2').innerHTML = data;
                    console.log(data);
                }
            });

            $.ajax({
                url: '{{ route('diklat.lembaga_aktif2') }}',
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    document.getElementById('lem_aktif2').innerHTML = data;
                    console.log(data);
                }
            });


            $.ajax({
                url: '{{ route('diklat.lembaga_tot') }}',
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    document.getElementById('cb').innerHTML = data;
                    console.log(data);
                }
            });

            $.ajax({
                url: '{{ route('diklat.lembaga_tot2') }}',
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    document.getElementById('cb2').innerHTML = data;
                    console.log(data);
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


            // var prov = $('#prov').val();
            $('#prov').on('change', function() {
                var prov_id = this.value;
                $('#prov_id').val(prov_id);
                if (prov_id !== '') {
                    $('#datatable-buttons').DataTable({
                        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                        destroy: true,
                        ordering: false,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('diklat.lembaga_data') }}',
                            data: {
                                prov_id:prov_id
                            }
                        },
                        columns: [{
                                data: 'name',
                                name: 'name'
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
                                data: 'kabupaten',
                                name: 'kabupaten.nama'
                            },
                            {
                                data: 'provinsi',
                                name: 'provinsi.nama'
                            },
                            {
                                data: 'jml_guru',
                                name: 'jml_guru'
                            },
                            {
                                data: 'jml_santri',
                                name: 'jml_santri'
                            },
                            {
                                data: 'alamat',
                                name: 'alamat'
                            },
                            {
                                data: 'pengelola',
                                name: 'pengelola'
                            },
                            {
                                data: 'statuss',
                                name: 'statuss'
                            },
                            {
                                data: 'opsi',
                                name: 'opsi'
                            },
                        ]
                    });
                }else{
                    $('#datatable-buttons').DataTable({
                        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                        destroy: true,
                        ordering: false,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('diklat.lembaga_data') }}',
                        },
                        columns: [{
                                data: 'name',
                                name: 'name'
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
                                data: 'kabupaten',
                                name: 'kabupaten.nama'
                            },
                            {
                                data: 'provinsi',
                                name: 'provinsi.nama'
                            },
                            {
                                data: 'jml_guru',
                                name: 'jml_guru'
                            },
                            {
                                data: 'jml_santri',
                                name: 'jml_santri'
                            },
                            {
                                data: 'alamat',
                                name: 'alamat'
                            },
                            {
                                data: 'pengelola',
                                name: 'pengelola'
                            },
                            {
                                data: 'statuss',
                                name: 'statuss'
                            },
                            {
                                data: 'opsi',
                                name: 'opsi'
                            },
                        ]
                    });
                }
            })

            $('#datatable-buttons').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                ordering: false,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('diklat.lembaga_data') }}',
                },
                columns: [{
                        data: 'name',
                        name: 'name'
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
                        data: 'kabupaten',
                        name: 'kabupaten.nama'
                    },
                    {
                        data: 'provinsi',
                        name: 'provinsi.nama'
                    },
                    {
                        data: 'jml_guru',
                        name: 'jml_guru'
                    },
                    {
                        data: 'jml_santri',
                        name: 'jml_santri'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'pengelola',
                        name: 'pengelola'
                    },
                    {
                        data: 'statuss',
                        name: 'statuss'
                    },
                    {
                        data: 'opsi',
                        name: 'opsi'
                    },
                ]
            });
        })

        //import lembaga
        $('#importlembaga').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('import.lembaga') }}",
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
                        $("#importlembaga")[0].reset();
                        toastr.success(data.success);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btnimport').val('Import');
                        $('#btnimport').attr('disabled', false);
                        $('.bs-example-modal-lembaga').modal('hide');
                        // swal("Done!", data.message, "success");
                        window.location.reload();
                        $.ajax({
                            url: '{{ route('diklat.lembaga_tot') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('cb').innerHTML = data;
                                console.log(data);
                            }
                        });
                        $.ajax({
                            url: '{{ route('diklat.lembaga_tot2') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('cb2').innerHTML = data;
                                console.log(data);
                            }
                        });
                        $.ajax({
                            url: '{{ route('diklat.lembaga_nonaktif') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('lem_nonaktif').innerHTML = data;
                                console.log(data);
                            }
                        });

                        $.ajax({
                            url: '{{ route('diklat.lembaga_aktif') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('lem_aktif').innerHTML = data;
                                console.log(data);
                            }
                        });

                        $.ajax({
                            url: '{{ route('diklat.lembaga_nonaktif2') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('lem_nonaktif2').innerHTML = data;
                                console.log(data);
                            }
                        });

                        $.ajax({
                            url: '{{ route('diklat.lembaga_aktif2') }}',
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('lem_aktif2').innerHTML = data;
                                console.log(data);
                            }
                        });
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
    </script>

    <script>
        $('#sel_kab').select2({
            placeholder: 'Pilih Kota / Kabupaten yang Tepat sesuai data sensus 2021',
            class: 'form-control',
            ajax: {
                url: "{{ route('kabupaten') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.id,
                                text: item.nama,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $('#addkota').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            // console.log(id);
            modal.find('.modal-body #idpeserta').val(id);
        })

        $('#tambahkota').submit(function(e) {
            var pelatihan_id = $('#pelatihan_id').val();
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('add_kota_lembaga') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#tambah').attr('disabled', 'disabled');
                    $('#tambah').val('Proses Menambahkan Kota');
                },
                success: function(data) {
                    if (data.success) {
                        window.location.reload();
                        $("#tambahkota")[0].reset();
                        toastr.success(data.success);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#tambah').val('Tambah!');
                        $('#tambah').attr('disabled', false);
                        $('#addkota').modal('hide');
                        // swal("Done!", data.message, "success");
                    } else {
                        $("#tambahkota")[0].reset();
                        swal("Error!", data.message, "error");
                        $('#tambah').val('Tambah!');
                        $('#tambah').attr('disabled', false);
                        $('#addkota').modal('hide');
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
