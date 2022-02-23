@extends('layouts.tilawatipusat_layouts.master')

@section('title')
    Peserta Diklat
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
            peserta {{ $diklat->program->name }}
        @endslot
        @slot('title_li')
        @endslot
    @endcomponent
    <input type="hidden" id="pelatihan_id2" value="{{ $diklat->id }}">
    <div class="row">
        <div class="col-xl-12">
            @component('common-tilawatipusat.dashboard-widget')
                @slot('title')
                    <b id="" class="text-capitalize"> {{ $diklat->cabang->name }} -
                        {{ strtolower($diklat->cabang->kabupaten->nama) }} - <span
                            class="text-info">{{ Carbon\Carbon::parse($diklat->tanggal)->isoFormat('D MMMM Y') }}</span></b>
                @endslot
                @slot('iconClass')
                    mdi mdi-account-group
                @endslot
                @slot('price')
                @endslot
            @endcomponent
        </div>

        @if ($kab_kosong != 0)
            <div class="col-xl-12" style="display: none">
                @component('common-tilawatipusat.dashboard-widget')
                    @slot('title')
                        <b id="kabkos"> ??? </b> <b class="text-danger"> Peserta dengan Kab - Kota Kosong / Salah
                            Penulisan </b>
                    @endslot
                    @slot('iconClass')
                        mdi mdi-city-variant-outline
                    @endslot
                    @slot('price')
                    @endslot
                @endcomponent
            </div>
        @endif

        <div class="col-xl-4">
            @component('common-tilawatipusat.dashboard-widget')
                @slot('title')
                    <b id="cb" class="text-success"> ??? </b> <br> <span>Peserta</span>
                @endslot
                @slot('iconClass')
                    mdi mdi-account-group
                @endslot
                @slot('price')
                @endslot
            @endcomponent
        </div>

        <div class="col-xl-4">
            @component('common-tilawatipusat.dashboard-widget')
                @slot('title')
                    <b id="lulus" class="text-info"> {{ $lulus }} </b> <br> Bersyahadah
                @endslot
                @slot('iconClass')
                    mdi mdi-mdi mdi-contact-mail-outline
                @endslot
                @slot('price')
                @endslot
            @endcomponent
        </div>

        <div class="col-xl-4">
            @component('common-tilawatipusat.dashboard-widget')
                @slot('title')
                    <b id="belum" class="text-danger"> {{ $belum_lulus }} </b> <br> Belum Bersyahadah
                @endslot
                @slot('iconClass')
                    mdi mdi-smart-card-outline
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
                    <?php $peserta_salah = App\Models\Peserta::where('pelatihan_id', $diklat->id)->get();
                    $salah1 = 0;
                    $salah2 = 0;
                    $salah3 = 0; ?>
                    @if ($peserta_salah->where('tmptlahir', null)->count() > 0)
                        <div class="col-lg-12 alert alert-danger">
                            <p>{{ $salah1 = $peserta_salah->where('tmptlahir', null)->count() }} Peserta dengan kesalahan
                                penulisan
                                tempat lahir</p>
                        </div>
                    @endif
                    @if ($peserta_salah->where('tgllahir', '-')->count() > 0 || $peserta_salah->where('tgllahir', null)->count() > 0)
                        <div class="col-lg-12 alert alert-danger">
                            <p>{{ $salah2 = $peserta_salah->where('tgllahir', null)->count() + $peserta_salah->where('tgllahir', '-')->count() }}
                                Peserta dengan kesalahan penulisan tanggal lahir</p>
                        </div>
                    @endif
                    @if ($peserta_salah->where('kabupaten_id', null)->count() > 0)
                        <div class="col-lg-12 alert alert-danger">
                            <p>{{ $salah3 = $peserta_salah->where('kabupaten_id', null)->count() }} Peserta dengan
                                kesalahan
                                penulisan asal kabupaten / kota</p>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <input type="hidden" id="jenis_program" value="{{ $diklat->program->name }}">
                    <h4 class="card-title text-capitalize">Data Peserta Pelatihan </h4>
                    @if ($diklat->program->penilaian->count() == 0)
                        <code>Tambahkan kategori penilaian pada program diklat terlebih dahulu pada menu program</code>
                    @endif
                    @if ($salah1 + $salah2 + $salah3 > 0)
                        <code>Data anda mengalami beberapa kesalahan format penulisan. Silahkan klik pada data yang salah
                            dan ganti dengan data yang benar</code><br>
                        <code>Beberapa fitur akan dimatikan seperti tidak dapat dicetak / diterbitkan syahadah apabila data
                            anda tidak dibenarkan terlebih dahulu.</code>
                    @endif
                    <br><br>
                    @if (count($errors) > 0)
                        <div class="row">
                            <div class="col-md-8 col-md-offset-1">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                    @foreach ($errors->all() as $error)
                                        {{ $error }} <br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    {{-- <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br></p> --}}
                    <form method="POST" class="mb-1 mr-1" action="{{ route('download.template') }}"
                        class="sign-in-form">
                        @csrf
                        <input type="hidden" name="jenis" value="{{ $diklat->program->name }}">

                        <button type="submit" class="btn btn-sm btn-outline-primary" style="width: 200px"
                            class="btn" value="Download Template"> <i class="fas fa-download"></i> Unduh
                            Template</button>
                    </form>
                    {{-- <a href="/export-template-diklat/{{$diklat->program->name}}" class="btn btn-sm btn-outline-primary" style="width: 200px" class="btn" value="Download Template" > <i class="fas fa-download"></i> Unduh Template</a> --}}
                    <a class="btn btn-sm btn-outline-success  mb-1 mr-1" style="width:130px"
                        @if ($diklat->program->penilaian->count() == 0) disabled @else href="{{ route('diklat.peserta_create', $pelatihan_id) }}" @endif><i
                            class="mdi mdi-plus"></i> tambah peserta</a>
                    <button class="btn btn-sm btn-outline-success  mb-1 mr-1" style="width:130px " data-toggle="modal"
                        @if ($diklat->program->penilaian->count() == 0) disabled @else data-target=".bs-example-modal-peserta" @endif><i
                            class="mdi mdi-cloud-upload"></i> import peserta</button>
                    @if (auth()->user()->role == 'pusat' || auth()->user()->username == 'tilawati cahaya amanah')
                        @if ($salah1 + $salah2 + $salah3 > 0)
                            {{-- <button type="button" class=" btn btn-sm mr-1 mb-1 btn-outline-primary" disabled><i
                                    class="fa fa-download" disabled></i> pengiriman modul!</button>
                            <button type="button" class=" btn btn-sm mr-1 mb-1 btn-outline-info" disabled><i
                                    class="fa fa-print" disabled></i> depan!</button>
                            <button type="button" class=" btn btn-sm mr-1 mb-1 btn-outline-info" disabled><i
                                    class="fa fa-print" disabled></i> belakang!</button>
                            <button type="button" class=" btn btn-sm mr-1 mb-1 btn-outline-secondary" disabled><i
                                    class="fa fa-print" disabled></i> depan versi lama!</button>
                            <button type="button" class=" btn btn-sm mr-1 mb-1 btn-outline-warning" disabled><i
                                    class="fa fa-download" disabled></i> download data peserta!</button> --}}



                        @else
                            <button class="text-right btn btn-sm mr-1 mb-1 btn-outline-primary" id="cetak_all"><i
                                    class="fa fa-download"></i> pengiriman modul</button>
                            <button class="text-right btn btn-sm mr-1 mb-1 btn-outline-info" id="depan_all"><i
                                    class="fa fa-print"></i> depan</button>
                            <button class="text-right btn btn-sm mr-1 mb-1 btn-outline-info" id="belakang_all"><i
                                    class="fa fa-print"></i> belakang</button>

                            <button class="text-right btn btn-sm mr-1 mb-1 btn-outline-secondary" id="depan_lama_all"><i
                                    class="fa fa-print"></i> depan versi lama</button>
                            <a href="/export-peserta-diklat/{{ $diklat->id }}"
                                class="text-right btn btn-sm mr-1 mb-1 btn-outline-warning"><i class="fa fa-download"></i>
                                download data peserta</a>
                        @endif
                    @endif

                    <button class="text-right btn btn-sm mr-1 mb-1 btn-outline-danger" id="hapus_all"><i
                            class="fa fa-trash"></i> hapus data</button>
                    {{-- <form action="/error-penilaian-kategori" method="POST">@csrf
                                        <button type="submit" class="text-right btn btn-sm mr-1 btn-outline-info" id="belakang_all"><i class="fa fa-print"></i> belakang</button>
                                    </form> --}}
                    <input type="hidden" id="pelatihan_id" value="{{ $pelatihan_id }}">
                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                        <div id="message"></div>
                        <table id="datatable-buttons" class="table table-peserta table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead class="text-bold text-primary text-uppercase" style="font-size: 11px;">
                                <tr>
                                    <th>id</th>
                                    <th style="5%"><input type="checkbox" id="master"></th>
                                    <th>Peserta</th>
                                    <th>Kab / Kota</th>
                                    {{-- <th>kec</th>
                                                    <th>kel</th> --}}
                                    <th>TTL</th>
                                    <th>Phone</th>
                                    <th>Alamat</th>
                                    <th>Alamat "M"</th>
                                    @if ($diklat->program->name == "standarisasi guru al qur'an level 1")
                                        <th>Jilid</th>
                                    @endif
                                    <th>Nilai</th>
                                    <th>Kriteria</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 10px">
                            </tbody>
                            <tfoot class="text-primary" style="text-transform: uppercase;font-size: 11px">
                                <tr>
                                    <th>id</th>
                                    <th style="5%">Pilih</th>
                                    <th>Peserta</th>
                                    <th>Kab / Kota</th>
                                    {{-- <th>kec</th>
                                                    <th>kel</th> --}}
                                    <th>TTL</th>
                                    <th>Phone</th>
                                    <th>Alamat</th>
                                    <th>Alamat "M"</th>
                                    @if ($diklat->program->name == "standarisasi guru al qur'an level 1")
                                        <th>Jilid</th>
                                    @endif
                                    <th>Nilai</th>
                                    <th>Kriteria</th>
                                    <th>Option</th>
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

    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade bs-example-modal-lembaga" id="nilaiPeserta" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">Penilaian Peserta </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="menilai" method="POST" enctype="multipart/form-data">@csrf
                            <div class="form-group">
                                <input type="hidden" id="id" name="peserta_id">
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <code>Pastikan kategori penilaian pada tiap program sudah fix sebelum anda melakukan
                                        penilaian</code>
                                    <hr>
                                </div>
                                @if ($diklat->program->penilaian->count() == 0)
                                    <div class="form-group col-12 text-center">
                                        <p class="text-danger text-uppercase">Belum ada kategori penilaian pada program <a
                                                href="/diklat-program">{{ $diklat->program->name }}</a></p>
                                    </div>
                                @else
                                    @foreach ($diklat->program->penilaian as $item)
                                        @if ($item->kategori !== 'skill')
                                            <div class="form-group col-xl-6 col-12">
                                                <label for="" class="text-capitalize">{{ $item->name }}
                                                    @if ($item->max !== null || $item->min !== null)
                                                        <br><i class="text-danger">Min:{{ $item->min }}</i> & <i
                                                            class="text-danger">Max:{{ $item->max }}</i>
                                                    @endif
                                                </label>
                                                <input type="hidden" name="kategori[]" value="{{ $item->kategori }}">
                                                <input type="hidden" name="penilaian_id[]" value="{{ $item->id }}">
                                                <input type="number" id="nominal[]" name="nominal[]"
                                                    max="{{ $item->max }}" class="form-control">
                                            </div>
                                        @else
                                            <div class="form-group col-xl-6 col-12">
                                                <label for="" class="text-capitalize">{{ $item->name }}
                                                    @if ($item->max !== null || $item->min !== null)
                                                        <br><i class="text-danger">Min:{{ $item->min }}</i> & <i
                                                            class="text-danger">Max:{{ $item->max }}</i>
                                                    @else
                                                        <br><br>
                                                    @endif
                                                </label>
                                                <input type="hidden" name="kategori[]" value="{{ $item->kategori }}">
                                                <input type="hidden" name="penilaian_id[]" value="{{ $item->id }}">
                                                <input type="number" id="nominal[]" name="nominal[]"
                                                    max="{{ $item->max }}" class="form-control">
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group">
                                {{-- <label for="">Sebagai</label>
                                                <select name="kriteria_id" onchange="pilihKriteria()" id="kriteria_id" class="form-control">
                                                    @foreach ($diklat->program->kriteria as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select> --}}

                                {{-- <input type="text" class="form-control" id="kriterias" name="kriteria"> --}}
                                <?php $keiteria = App\Models\Kriteria::where('program_id', $diklat->program->id)->get(); ?>
                                <label for="program">KRITERIA</label>
                                <input list="listkriteria" name="mykriteria" class="form-control">
                                <datalist id="listkriteria">
                                    @foreach ($kriteria as $krit)
                                        <option value="{{ $krit->name }}">
                                    @endforeach
                                </datalist>
                            </div>
                            @if ($diklat->program->penilaian->count() !== 0)
                                <div class="form-group text-right">
                                    <input type="submit" class="btn btn-sm btn-info" value="Submit Nilai" id="btnsubmit">
                                </div>
                            @endif
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade bs-example-modal-kriteria-hapus" id="hapusData" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <form id="hapusPeserta" method="POST" enctype="multipart/form-data">@csrf
                                            <div class="form-group text-center">
                                                <h5>Anda yakin akan menghapus Kriteria tersebut ?</h5>
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
    </div>

    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade" id="modal_cetak_surat" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <form id="formcetaksurat"
                                            action="{{ route('diklat.cetak_surat_pengiriman_satu') }}" method="POST"
                                            enctype="multipart/form-data">@csrf
                                            <div class="form-group text-center">
                                                <h5>CETAK SURAT PENGIRIMAN MODUL ?</h5>
                                                <input type="hidden" class="form-control text-capitalize" id="id" name="id"
                                                    required>
                                            </div>
                                            <div class="row" style="text-align: center">
                                                <div class="form-group col-6 col-xl-6">
                                                    <input type="submit" name="cetaksurat" id="btncetaksurat"
                                                        class="btn btn-outline-primary" value="Ya, Cetak!" />
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
    </div>

    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade" id="modal_cetak_surat2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <form id="formcetaksurat"
                                            action="{{ route('diklat.cetak_surat_pengiriman_beberapa') }}" method="POST"
                                            enctype="multipart/form-data">@csrf
                                            <div class="form-group text-center">
                                                <h5>CETAK SURAT PENGIRIMAN MODUL ?</h5>
                                                <input type="hidden" class="form-control text-capitalize" id="idcetaksurat"
                                                    name="idcetaksurats" required>
                                            </div>
                                            <div class="row" style="text-align: center">
                                                <div class="form-group col-6 col-xl-6">
                                                    <input type="submit" name="cetaksurat" id="btncetaksurat"
                                                        class="btn btn-outline-primary" value="Ya, Cetak!" />
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
    </div>

    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade" id="modal-download-depan" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <form id="" action="/pelatihan-cetak-depan-print-beberapa" method="POST"
                                            enctype="multipart/form-data">@csrf
                                            <div class="form-group text-center">
                                                <h5>CETAK SYAHADAH DEPAN ?</h5>
                                                <input type="text" class="form-control text-capitalize" id="idcetakdepan"
                                                    name="id" required>
                                            </div>
                                            <div class="row" style="text-align: center">
                                                <div class="form-group col-6 col-xl-6">
                                                    <input type="submit" id="btndownload" class="btn btn-primary"
                                                        value="Ya, Cetak!" />
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
    </div>

    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade" id="modal-download-depan-lama" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <form target="_blank" id=""
                                            action="/pelatihan-cetak-peserta-depan-versi-lama-beberapa" method="POST"
                                            enctype="multipart/form-data">@csrf
                                            <div class="form-group text-center">
                                                <h5>CETAK SYAHADAH DEPAN VERSI LAMA ?</h5>
                                                <input type="text" class="form-control text-capitalize"
                                                    id="idcetakdepanlama" name="id" required>
                                            </div>
                                            <div class="row" style="text-align: center">
                                                <div class="form-group col-6 col-xl-6">
                                                    <input type="submit" id="btndownload" class="btn btn-primary"
                                                        value="Ya, Cetak!" />
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
    </div>

    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade" id="modal-hapus-data" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <form id="" action="/peserta-hapus-beberapa" method="POST"
                                            enctype="multipart/form-data">@csrf
                                            <div class="form-group text-center">
                                                <h5>HAPUS DATA ?</h5>
                                                <input type="text" class="form-control text-capitalize" id="idhapusdata"
                                                    name="id" required>
                                            </div>
                                            <div class="row" style="text-align: center">
                                                <div class="form-group col-6 col-xl-6">
                                                    <input type="submit" id="btnhapusdata" class="btn btn-danger"
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
    </div>

    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade" id="modal-download-belakang" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <form id="" action="/pelatihan-cetak-belakang-print-beberapa" method="POST"
                                            enctype="multipart/form-data">@csrf
                                            <div class="form-group text-center">
                                                <h5>CETAK SYAHADAH BELAKANG ?</h5>
                                                <input type="text" class="form-control text-capitalize"
                                                    id="idcetakbelakang" name="id" required>
                                            </div>
                                            <div class="row" style="text-align: center">
                                                <div class="form-group col-6 col-xl-6">
                                                    <input type="submit" id="btndownload" class="btn btn-primary"
                                                        value="Ya, Unduh!" />
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
    </div>

    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade" id="modal-modul" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <form id="ubahalamatmodul" method="POST" enctype="multipart/form-data">@csrf
                                            <div class="form-group text-center">
                                                <h5>Ubah Alamat Pengiriman Modul</h5>
                                                <input type="hidden" class="form-control text-capitalize" id="id" name="id"
                                                    required>
                                                <textarea name="alamatx" class="form-control" id="alamatx" cols="30"
                                                    rows="3"></textarea>
                                            </div>
                                            <div class="row" style="text-align: center">
                                                <div class="form-group col-6 col-xl-6">
                                                    <input type="submit" name="ubah" id="btnubah" class="btn btn-danger"
                                                        value="Ya, Ubah!" />
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
    </div>

    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade bs-example-modal-kota" id="addkota" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <form id="tambahkota" method="POST" enctype="multipart/form-data">@csrf
                            <input type="hidden" id="idpeserta" name="peserta_id">
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
    </div>

    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade bs-example-modal-tmptlahir" id="addkota2" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <form id="tambahkota2" method="POST" enctype="multipart/form-data">@csrf
                            <input type="hidden" id="idpeserta" name="peserta_id">
                            <div class="form-group text-center col-12">
                                <p>Daftar Kota & Kabupaten</p>
                                <select name="sel_kab" id="sel_kab2" style="text-transform: lowercase; max-width: auto;"
                                    class="form-control select2" required>
                                    <option value=""> Cari & Pilih Kab / Kota</option>
                                </select>
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" id="tambah2" value="Tambahkan" class="btn btn-sm btn-primary">
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade bs-example-modal-tmptlahir" id="addkota3" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <form id="tambahkota3" method="POST" enctype="multipart/form-data">@csrf
                            <input type="hidden" id="idpeserta" name="peserta_id">
                            <div class="form-group text-center col-12">
                                <p>Daftar Kota & Kabupaten</p>
                                <select name="sel_kab" id="sel_kab3" style="text-transform: lowercase; max-width: auto;"
                                    class="form-control select2" required>
                                    <option value=""> Cari & Pilih Kab / Kota</option>
                                </select>
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" id="tambah3" value="Tambahkan" class="btn btn-sm btn-primary">
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade bs-example-modal-tgllahir" id="addtgl" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <form id="tambahtgl" method="POST" enctype="multipart/form-data">@csrf
                            <input type="hidden" id="idpeserta" name="peserta_id">
                            <div class="form-group text-center col-12">
                                <p>Tanggal Lahir Peserta</p>
                                <input type="date" class="form-control" name="tgllahir">
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" id="tambah4" value="Tambahkan" class="btn btn-sm btn-primary">
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

    <div class="col-sm-6 col-md-3 m-t-30">
        <div class="modal fade bs-example-modal-peserta" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">IMPORT DATA PESERTA </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        {{-- <form id="importpeserta" method="POST" enctype="multipart/form-data">@csrf --}}
                                        <form action="{{ route('import-peserta-diklat2') }}" method="POST"
                                            enctype="multipart/form-data">@csrf
                                            <div class="form-group">
                                                <label for="" class="text-capitalize">Import Data "peserta diklat
                                                    {{ $diklat->program->name }}" (hanya Excel File format .xlsx)</label>
                                                <input type="file" class="form-control" name="file"
                                                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                                    required>
                                            </div>
                                            <input type="hidden" name="tanggal" value="{{ $diklat->tanggal }}">
                                            <input type="hidden" name="id" value="{{ $diklat->id }}">
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
        <div class="modal fade modal-scan" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">SCAN QR CODE PESERTA </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="container-fluid text-center">
                                        <img src="" alt="qr-code" id="qr-code" width="150px" height="150px">
                                        <div class="text-center text-uppercase" style="margin-top: 10px">
                                            <p class="text-info" id="nama_peserta"></p>
                                        </div>
                                    </div><!-- container fluid -->
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
    <!-- Script Select2-->
    <script src="{{ URL::asset('/tilawatipusat/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/tilawatipusat/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/tilawatipusat/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ URL::asset('/tilawatipusat/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ URL::asset('/tilawatipusat/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    <!-- form advanced init -->
    <script src="{{ URL::asset('/tilawatipusat/js/pages/form-advanced.init.js') }}"></script>

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
        $('#sel_kab2').select2({
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
        $('#sel_kab3').select2({
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
        $('.modal-scan').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            id = button.data('id')
            nama_peserta = button.data('nama_peserta')
            var modal = $(this)
            $('#nama_peserta').html(nama_peserta);
            document.getElementById("qr-code").src = id;
        })

        $('#importpeserta').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('import-peserta-diklat2') }}",
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
                        $("#importpeserta")[0].reset();
                        toastr.success(data.success);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btnimport').val('Import');
                        $('#btnimport').attr('disabled', false);
                        $('.bs-example-modal-peserta').modal('hide');
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

        $('#ubahalamatmodul').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('diklat.peserta_alamatx') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnubah').attr('disabled', 'disabled');
                    $('#btnubah').val('Alamat Diubah');
                },
                success: function(data) {
                    if (data.success) {
                        //sweetalert and refresh datatable
                        $("#ubahalamatmodul")[0].reset();
                        toastr.success(data.success);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btnubah').val('Import');
                        $('#btnubah').attr('disabled', false);
                        $('#modal-modul').modal('hide');
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

        //tambah tanggal
        $('#tambahtgl').submit(function(e) {
            var pelatihan_id = $('#pelatihan_id').val();
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('add_tgl') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#tambah4').attr('disabled', 'disabled');
                    $('#tambah4').val('Proses Menambahkan Tanggal Lahir');
                },
                success: function(data) {
                    if (data.success) {
                        window.location.reload();
                        $("#tambahtgl")[0].reset();
                        toastr.success(data.success);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#tambah4').val('Tambah!');
                        $('#tambah4').attr('disabled', false);
                        $('#addtgl').modal('hide');
                        // swal("Done!", data.message, "success");
                    } else {
                        $("#tambahtgl")[0].reset();
                        swal("Error!", data.message, "error");
                        $('#tambah4').val('Tambah!');
                        $('#tambah4').attr('disabled', false);
                        $('#addtgl').modal('hide');
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
        //tambahkota
        $('#tambahkota').submit(function(e) {
            var pelatihan_id = $('#pelatihan_id').val();
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('add_kota') }}",
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
                        $.ajax({
                            url: '/peserta_yang_kabupatennya_kosong/' + pelatihan_id,
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('kabkos').innerHTML = data;
                                console.log(data);
                            }
                        });
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

        $('#tambahkota2').submit(function(e) {
            var pelatihan_id = $('#pelatihan_id').val();
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('add_kota2') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#tambah2').attr('disabled', 'disabled');
                    $('#tambah2').val('Proses Menambahkan Kota');
                },
                success: function(data) {
                    if (data.success) {
                        window.location.reload();
                        $.ajax({
                            url: '/peserta_yang_kabupatennya_kosong/' + pelatihan_id,
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('kabkos').innerHTML = data;
                                console.log(data);
                            }
                        });
                        $("#tambahkota2")[0].reset();
                        toastr.success(data.success);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#tambah2').val('Tambah!');
                        $('#tambah2').attr('disabled', false);
                        $('#addkota2').modal('hide');
                        // swal("Done!", data.message, "success");
                    } else {
                        $("#tambahkota2")[0].reset();
                        swal("Error!", data.message, "error");
                        $('#tambah2').val('Tambah!');
                        $('#tambah2').attr('disabled', false);
                        $('#addkota2').modal('hide');
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('#tambahkota3').submit(function(e) {
            var pelatihan_id = $('#pelatihan_id').val();
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('add_kota3') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#tambah3').attr('disabled', 'disabled');
                    $('#tambah3').val('Proses Menambahkan Kota');
                },
                success: function(data) {
                    if (data.success) {
                        window.location.reload();
                        $.ajax({
                            url: '/peserta_yang_kabupatennya_kosong/' + pelatihan_id,
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('kabkos').innerHTML = data;
                                console.log(data);
                            }
                        });
                        $("#tambahkota3")[0].reset();
                        toastr.success(data.success);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#tambah3').val('Tambah!');
                        $('#tambah3').attr('disabled', false);
                        $('#addkota3').modal('hide');
                        // swal("Done!", data.message, "success");
                    } else {
                        $("#tambahkota3")[0].reset();
                        swal("Error!", data.message, "error");
                        $('#tambah3').val('Tambah!');
                        $('#tambah3').attr('disabled', false);
                        $('#addkota3').modal('hide');
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('#addtgl').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            // console.log(id);
            modal.find('.modal-body #idpeserta').val(id);
        })
        $('#addkota').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            // console.log(id);
            modal.find('.modal-body #idpeserta').val(id);
        })
        $('#addkota2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            // console.log(id);
            modal.find('.modal-body #idpeserta').val(id);
        })
        $('#addkota3').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            // console.log(id);
            modal.find('.modal-body #idpeserta').val(id);
        })

        $('#hapusData').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        })

        $('#modal_cetak_surat').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        })

        $('#hapusPeserta').submit(function(e) {
            var pelatihan_id = $('#pelatihan_id').val();
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('diklat.peserta_delete') }}",
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
                        toastr.info(data.success);
                        //mendapatkan total peserta baru
                        $.ajax({
                            url: '/diklat-total-peserta-pelatihan/' + pelatihan_id,
                            type: 'get',
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById('cb').innerHTML = data;
                                // console.log(data);
                            }
                        });
                        //sweetalert and redirect
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btnhapus').val('Ya, Hapus!');
                        $('#hapusData').modal('hide');
                        $('#btnhapus').attr('disabled', false);
                        // swal({ title: "Success!",
                        //     text: "Kriteria Tersebut Berhasil Di Dihapus!",
                        //     type: "success"})
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('#menilai').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('diklat.nilai_store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnsubmit').attr('disabled', 'disabled');
                    $('#btnsubmit').val('Proses Submit Data');
                },
                success: function(data) {
                    if (data.success) {
                        //sweetalert and redirect
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $("#menilai")[0].reset();
                        toastr.success(data.success);
                        $('#btnsubmit').val('Submit Nilai');
                        $('#nilaiPeserta').modal('hide');
                        $('#btnsubmit').attr('disabled', false);
                        swal({
                            title: "Success!",
                            text: "Peserta Telah Dinilai!",
                            type: "success"
                        })
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('#nilaiPeserta').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            id = button.data('id')
            nominal = button.data('nominal')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #nominal').val(nominal);
            // console.log(nominal);
        })

        $('#modal-modul').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var alamatx = button.data('alamatx')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #alamatx').val(alamatx);
            // console.log(nominal);
        })

        $(document).ready(function() {
            //select
            $('#master').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });

            var jenis_program = $('#jenis_program').val();
            // console.log(jenis_program);
            // var k = $('#kriteria_id').text();
            var pel_id = $('#pelatihan_id').val();
            // document.getElementById('kriterias').value=k;
            var pelatihan_id = $('#pelatihan_id').val();
            // console.log(pel_id);

            $.ajax({
                url: '/diklat-total-peserta-pelatihan/' + pelatihan_id,
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    document.getElementById('cb').innerHTML = data;
                    // console.log(data);
                }
            });

            // $.ajax({
            //     url:'/peserta_yang_kabupatennya_kosong/'+pelatihan_id,
            //     type: 'get',
            //     dataType: 'json',
            //     success:function(data) {
            //         document.getElementById('kabkos').innerHTML = data;
            //         // console.log(data);
            //     }
            // });

            if (jenis_program == "standarisasi guru al qur'an level 1") {
                $('#datatable-buttons').DataTable({
                    //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/diklat-peserta-data' + '/' + pel_id,
                    },
                    columns: [{
                            data: 'idpeserta',
                            name: 'id'
                        },
                        {
                            data: 'check',
                            name: 'check',
                            orderable: false,
                        },
                        {
                            data: 'namapeserta',
                            name: 'name'
                        },

                        {
                            data: 'kabupaten',
                            name: 'kabupaten.nama',
                            orderable: false,
                        },
                        // {
                        // data:'kecamatan',
                        // name:'kecamatan.nama',
                        // orderable:false,
                        // },
                        // {
                        // data:'kelurahan',
                        // name:'kelurahan.nama',
                        // orderable:false,
                        // },
                        {
                            data: 'ttl',
                            name: 'ttl'
                        },
                        {
                            data: 'phone',
                            name: 'telp'
                        },
                        {
                            data: 'alamat',
                            name: 'alamat'
                        },
                        {
                            data: 'alamatmodul',
                            name: 'alamatx'
                        },
                        {
                            data: 'jilid',
                            name: 'jilid'
                        },
                        {
                            data: 'nilai',
                            name: 'nilai'
                        },
                        {
                            data: 'krits',
                            name: 'kriteria',
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },

                    ]
                });
            } else {
                $('#datatable-buttons').DataTable({
                    //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/diklat-peserta-data/' + pel_id,
                    },
                    columns: [{
                            data: 'idpeserta',
                            name: 'id'
                        },
                        {
                            data: 'check',
                            name: 'check',
                            orderable: false,
                        },
                        {
                            data: 'namapeserta',
                            name: 'name'
                        },

                        {
                            data: 'kabupaten',
                            name: 'kabupaten.nama',
                            orderable: false,
                        },
                        // {
                        // data:'kecamatan',
                        // name:'kecamatan.nama',
                        // orderable:false,
                        // },
                        // {
                        // data:'kelurahan',
                        // name:'kelurahan.nama',
                        // orderable:false,
                        // },
                        {
                            data: 'ttl',
                            name: 'ttl'
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
                            data: 'alamatmodul',
                            name: 'alamatx'
                        },
                        {
                            data: 'nilai',
                            name: 'nilai'
                        },
                        {
                            data: 'krits',
                            name: 'kriteria',
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },

                    ]
                });
            }
        })

        // cetak surat jalan
        $('#cetak_all').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });

            if (allVals.length <= 0) {
                alert("PILIH PESERTA YANG AKAN DICETAK SURAT JALAN");
            } else {
                var join_selected_values = allVals.join(",");
                $('#modal_cetak_surat2').modal('show');
                $('#idcetaksurat').val(join_selected_values);
            }
        });

        // cetak syahadah depan
        $('#depan_all').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });

            if (allVals.length <= 0) {
                alert("PILIH PESERTA YANG AKAN DI CETAK SYAHADAH DEPAN");
            } else {
                var join_selected_values = allVals.join(",");
                $('#modal-download-depan').modal('show');
                $('#idcetakdepan').val(join_selected_values);
            }
        });

        $('#depan_lama_all').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });

            if (allVals.length <= 0) {
                alert("PILIH PESERTA YANG AKAN DI CETAK SYAHADAH DEPAN VERSI LAMA");
            } else {
                var join_selected_values = allVals.join(",");
                $('#modal-download-depan-lama').modal('show');
                $('#idcetakdepanlama').val(join_selected_values);
            }
        });

        $('#belakang_all').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });

            if (allVals.length <= 0) {
                alert("PILIH PESERTA YANG AKAN DI CETAK SYAHADAH BELAKANG");
            } else {
                var join_selected_values = allVals.join(",");
                $('#modal-download-belakang').modal('show');
                $('#idcetakbelakang').val(join_selected_values);
            }
        });

        // hapus beberapa peserta
        $('#hapus_all').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });

            if (allVals.length <= 0) {
                alert("PILIH PESERTA YANG AKAN DIHAPUS");
            } else {
                var join_selected_values = allVals.join(",");
                $('#modal-hapus-data').modal('show');
                $('#idhapusdata').val(join_selected_values);
            }
        });
    </script>
@endsection
