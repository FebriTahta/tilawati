@extends('layouts.tilawatipusat_layouts.master')

@section('title') Peserta Diklat @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="{{URL::asset('tilawatipusat/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />


@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title')peserta {{ $diklat->program->name }}   @endslot
         @slot('title_li')   @endslot
    @endcomponent
    <input type="hidden" id="pelatihan_id2" value="{{ $diklat->id }}">
                    <div class="row">
                        <div class="col-xl-12">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="" class="text-capitalize"> {{ $diklat->cabang->name }} - {{ strtolower($diklat->cabang->kabupaten->nama) }} - <span class="text-info">{{ Carbon\Carbon::parse($diklat->tanggal)->isoFormat('D MMMM Y') }}</span></b>  @endslot
                                @slot('iconClass')mdi mdi-account-group  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>

                        @if ($kab_kosong != 0)
                        <div class="col-xl-12">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="kabkos"> ??? </b> <b class="text-danger"> Peserta dengan Kab - Kota Kosong / Salah Penulisan </b> @endslot
                                @slot('iconClass')mdi mdi-city-variant-outline  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                        @endif

                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="cb" class="text-success"> ??? </b> <span>Peserta</span>  @endslot
                                @slot('iconClass')mdi mdi-account-group  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>

                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="lulus" class="text-info"> {{$lulus}} </b> Bersyahadah  @endslot
                                @slot('iconClass')mdi mdi-mdi mdi-contact-mail-outline  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>

                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="belum" class="text-danger"> {{$belum_lulus}} </b> Belum Bersyahadah  @endslot
                                @slot('iconClass')mdi mdi-smart-card-outline  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12" >
                            <div class="card">
                                <div class="card-body" >
                                    <input type="hidden" id="jenis_program" value="{{ $diklat->program->name }}">
                                    <h4 class="card-title text-capitalize">Data Peserta Pelatihan </h4>
                                    @if ($diklat->program->penilaian->count() == 0)
                                        <code>Tambahkan kategori penilaian pada program diklat terlebih dahulu pada menu program</code>
                                    @endif
                                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br></p>
                                    <a class="btn btn-sm btn-success  mr-1 text-white" style="width:130px" @if($diklat->program->penilaian->count() == 0) disabled @else href="{{ route('diklat.peserta_create', $pelatihan_id) }}" @endif><i class="mdi mdi-plus"></i> tambah peserta</a>
                                    <button class="btn btn-sm btn-success  mr-1" style="width:130px " data-toggle="modal" @if($diklat->program->penilaian->count() == 0) disabled @else data-target=".bs-example-modal-peserta" @endif><i class="mdi mdi-cloud-upload"></i> import peserta</button>
                                    <button class="text-right float-right p-3 mr-1 btn btn-sm btn-outline-primary" id="cetak_all"><i class="fa fa-download"></i> cetak pengiriman modul</button>

                                    <input type="hidden" id="pelatihan_id" value="{{ $pelatihan_id }}">
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <div id="message"></div>
                                        <table id="datatable-buttons" class="table table-peserta table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary" style="text-transform: capitalize">
                                                <tr>
                                                    <th>peserta</th>
                                                    <th style="5%"><input type="checkbox" id="master"></th>
                                                    <th>asal</th>
                                                    <th>TTL</th>
                                                    <th>phone</th>
                                                    <th>alamat</th>
                                                    <th>alamat "M"</th>
                                                    @if ($diklat->program->name == "standarisasi guru al qur'an level 1")
                                                        <th>jilid</th>
                                                    @endif
                                                    <th>nilai</th>
                                                    <th>Kriteria</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>
                                            <tfoot class="text-primary" style="text-transform: capitalize">
                                                <tr>
                                                    <th>peserta</th>
                                                    <th style="5%">pilih</th>
                                                    <th>asal</th>
                                                    <th>TTL</th>
                                                    <th>phone</th>
                                                    <th>alamat</th>
                                                    <th>alamat "M"</th>
                                                    @if ($diklat->program->name == "standarisasi guru al qur'an level 1")
                                                        <th>jilid</th>
                                                    @endif
                                                    <th>nilai</th>
                                                    <th>Kriteria</th>
                                                    <th>Option</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <footer class="blockquote-footer">Updated at  <cite title="Source Title">2021</cite></footer>
                                    </blockquote>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade bs-example-modal-lembaga" id="nilaiPeserta" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0">Penilaian Peserta </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="menilai"  method="POST" enctype="multipart/form-data">@csrf
                                            <div class="form-group">
                                                <input type="hidden" id="id" name="peserta_id">
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <code>Pastikan kategori penilaian pada tiap program sudah fix sebelum anda melakukan penilaian</code>
                                                    <hr>
                                                </div>
                                                @if ($diklat->program->penilaian->count() == 0)
                                                <div class="form-group col-12 text-center">
                                                    <p class="text-danger text-uppercase">Belum ada kategori penilaian pada program <a href="/diklat-program">{{ $diklat->program->name }}</a></p>
                                                </div>
                                                @else
                                                    @foreach ($diklat->program->penilaian as $item)
                                                        @if ($item->kategori !== 'skill')
                                                            <div class="form-group col-xl-6 col-12">
                                                                <label for="" class="text-capitalize">{{ $item->name }}
                                                                    @if ($item->max !== null || $item->min !== null)
                                                                        <br><i class="text-danger">Min:{{ $item->min }}</i> & <i class="text-danger">Max:{{ $item->max }}</i>
                                                                    @endif
                                                                </label>
                                                                <input type="hidden" name="kategori[]" value="{{ $item->kategori }}">
                                                                <input type="hidden" name="penilaian_id[]" value="{{ $item->id }}">
                                                                <input type="number" id="nominal[]" name="nominal[]" max="{{ $item->max }}" class="form-control">
                                                            </div>
                                                        @else
                                                            <div class="form-group col-xl-6 col-12">
                                                                <label for="" class="text-capitalize">{{ $item->name }}
                                                                    @if ($item->max !== null || $item->min !== null)
                                                                        <br><i class="text-danger">Min:{{ $item->min }}</i> & <i class="text-danger">Max:{{ $item->max }}</i>
                                                                    @else
                                                                    <br><br>
                                                                    @endif
                                                                </label>
                                                                <input type="hidden" name="kategori[]" value="{{ $item->kategori }}">
                                                                <input type="hidden" name="penilaian_id[]" value="{{ $item->id }}">
                                                                <input type="number" id="nominal[]" name="nominal[]" max="{{ $item->max }}" class="form-control">
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="">Sebagai</label>
                                                <select name="kriteria_id" onchange="pilihKriteria()" id="kriteria_id" class="form-control">
                                                    @foreach ($diklat->program->kriteria as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" class="form-control" id="kriterias" name="kriteria">
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
                        <div class="modal fade bs-example-modal-kriteria-hapus" id="hapusData" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="hapusPeserta"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group text-center">
                                                                <h5>Anda yakin akan menghapus Kriteria tersebut ?</h5>
                                                                <input type="hidden" class="form-control text-capitalize" id="id" name="id" required>
                                                            </div>
                                                            <div class="row" style="text-align: center">
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <input type="submit" name="hapus" id="btnhapus" class="btn btn-danger" value="Ya, Hapus!" />
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
                        <div class="modal fade" id="modal_cetak_surat" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="formcetaksurat" action="{{route('diklat.cetak_surat_pengiriman_satu')}}"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group text-center">
                                                                <h5>CETAK SURAT PENGIRIMAN MODUL ?</h5>
                                                                <input type="hidden" class="form-control text-capitalize" id="id" name="id" required>
                                                            </div>
                                                            <div class="row" style="text-align: center">
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <input type="submit" name="cetaksurat" id="btncetaksurat" class="btn btn-outline-primary" value="Ya, Cetak!" />
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
                        <div class="modal fade" id="modal_cetak_surat2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="formcetaksurat" action="{{route('diklat.cetak_surat_pengiriman_beberapa')}}"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group text-center">
                                                                <h5>CETAK SURAT PENGIRIMAN MODUL ?</h5>
                                                                <input type="hidden" class="form-control text-capitalize" id="idcetaksurat" name="idcetaksurats" required>
                                                            </div>
                                                            <div class="row" style="text-align: center">
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <input type="submit" name="cetaksurat" id="btncetaksurat" class="btn btn-outline-primary" value="Ya, Cetak!" />
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
                        <div class="modal fade" id="modal-modul" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="ubahalamatmodul"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group text-center">
                                                                <h5>Ubah Alamat Pengiriman Modul</h5>
                                                                <input type="hidden" class="form-control text-capitalize" id="id" name="id" required>
                                                                <textarea name="alamatx" class="form-control" id="alamatx" cols="30" rows="3"></textarea>
                                                            </div>
                                                            <div class="row" style="text-align: center">
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <input type="submit" name="ubah" id="btnubah" class="btn btn-danger" value="Ya, Ubah!" />
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
                        <div class="modal fade bs-example-modal-kota" id="addkota" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form id="tambahkota" method="POST" enctype="multipart/form-data">@csrf
                                            <input type="hidden" id="idpeserta" name="peserta_id">
                                            <div class="form-group text-center col-12">
                                                <p>Daftar Kota & Kabupaten</p>
                                                <select name="sel_kab" id="sel_kab" style="text-transform: lowercase; max-width: auto;" class="form-control select2" required>
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
                        <div class="modal fade bs-example-modal-peserta" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                                                        <form id="importpeserta"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group">
                                                                <label for="" class="text-capitalize">Import Data "peserta diklat {{ $diklat->program->name }}" (hanya Excel File format .xlsx)</label>
                                                                <input type="file" class="form-control" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                                                            </div>
                                                            <input type="hidden" name="tanggal" value="{{ $diklat->tanggal }}">
                                                            <input type="hidden" name="id" value="{{ $diklat->id }}">
                                                            <div class="form-group">
                                                                <input type="submit" name="import" id="btnimport" class="btn btn-info" value="Import" />
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
                        <div class="modal fade modal-scan" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
        <script src="{{URL::asset('/tilawatipusat/libs/select2/select2.min.js')}}"></script>
        <script src="{{URL::asset('/tilawatipusat/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{URL::asset('/tilawatipusat/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
        <script src="{{URL::asset('/tilawatipusat/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
        <script src="{{URL::asset('/tilawatipusat/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

        <!-- form advanced init -->
        <script src="{{URL::asset('/tilawatipusat/js/pages/form-advanced.init.js')}}"></script>

        <!-- Toast -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        
        <!-- Required datatable js -->
        <script src="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.js')}}"></script>
        <script src="{{ URL::asset('tilawatipusat/libs/jszip/jszip.min.js')}}"></script>
        <script src="{{ URL::asset('tilawatipusat/libs/pdfmake/pdfmake.min.js')}}"></script>

        <!-- Datatable init js -->
        <script src="{{ URL::asset('tilawatipusat/js/pages/datatables.init.js')}}"></script>

        <script>
            $('#sel_kab').select2({
                placeholder: 'Pilih Kota / Kabupaten yang Tepat sesuai data sensus 2021',
                class: 'form-control',
                ajax: {
                    url: "{{route('kabupaten')}}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
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
                type:'POST',
                url: "{{ route('diklat.import_peserta')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnimport').attr('disabled','disabled');
                    $('#btnimport').val('Importing Process');
                },
                success: function(data){
                    if(data.success)
                    {
                        //sweetalert and refresh datatable
                        $("#importpeserta")[0].reset();
                        toastr.success(data.success);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btnimport').val('Import');
                        $('#btnimport').attr('disabled',false);
                        $('.bs-example-modal-peserta').modal('hide');
                        swal("Done!", data.message, "success");
                    }
                    if(data.error)
                    {
                        $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
                        $('#btnimport').attr('disabled',false);
                        $('#btnimport').val('Import');
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

            $('#ubahalamatmodul').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.peserta_alamatx')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnubah').attr('disabled','disabled');
                    $('#btnubah').val('Alamat Diubah');
                },
                success: function(data){
                    if(data.success)
                    {
                        //sweetalert and refresh datatable
                        $("#ubahalamatmodul")[0].reset();
                        toastr.success(data.success);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btnubah').val('Import');
                        $('#btnubah').attr('disabled',false);
                        $('#modal-modul').modal('hide');
                    }
                    if(data.error)
                    {
                        $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
                        $('#btnimport').attr('disabled',false);
                        $('#btnimport').val('Import');
                    }
                },
                error: function(data)
                {
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
                type:'POST',
                url: "{{ route('add_kota')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#tambah').attr('disabled','disabled');
                    $('#tambah').val('Proses Menambahkan Kota');
                },
                success: function(data){
                    if(data.success) 
                    {
                        // $('#sel_kab').select2({
                        //     placeholder: 'Pilih Kota / Kabupaten yang Tepat sesuai data sensus 2021',
                        //     class: 'form-control',
                        //     ajax: {
                        //         url: "{{route('kabupaten')}}",
                        //         dataType: 'json',
                        //         delay: 250,
                        //         processResults: function (data) {
                        //         return {
                        //             results:  $.map(data, function (item) {
                        //                 return {
                        //                     text: item.id,
                        //                     text: item.nama,
                        //                     id: item.id
                        //                 }
                        //             })
                        //         };
                        //         },
                        //         cache: true
                        //     }
                        // });
                        $.ajax({
                            url:'/peserta_yang_kabupatennya_kosong/'+pelatihan_id,
                            type: 'get',
                            dataType: 'json',
                            success:function(data) {
                                document.getElementById('kabkos').innerHTML = data;
                                console.log(data);
                            }
                        });
                        $("#tambahkota")[0].reset();
                        toastr.success(data.success);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#tambah').val('Tambah!');
                        $('#tambah').attr('disabled',false);
                        $('#addkota').modal('hide');
                        // swal("Done!", data.message, "success");
                    }else{
                        $("#tambahkota")[0].reset();
                        swal("Error!", data.message, "error");
                        $('#tambah').val('Tambah!');
                        $('#tambah').attr('disabled',false);
                        $('#addkota').modal('hide');
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

            $('#addkota').on('show.bs.modal', function(event) {
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
                type:'POST',
                url: "{{ route('diklat.peserta_delete')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnhapus').attr('disabled','disabled');
                    $('#btnhapus').val('Proses Hapus Data');
                },
                success: function(data){
                    if(data.success)
                    {
                        toastr.info(data.success);
                        //mendapatkan total peserta baru
                        $.ajax({
                            url:'/diklat-total-peserta-pelatihan/'+pelatihan_id,
                            type: 'get',
                            dataType: 'json',
                            success:function(data) {
                                document.getElementById('cb').innerHTML = data;
                                // console.log(data);
                            }
                        });
                        //sweetalert and redirect
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btnhapus').val('Ya, Hapus!');
                        $('#hapusData').modal('hide');
                        $('#btnhapus').attr('disabled',false);
                        // swal({ title: "Success!",
                        //     text: "Kriteria Tersebut Berhasil Di Dihapus!",
                        //     type: "success"})
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

            $('#menilai').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.nilai_store')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnsubmit').attr('disabled','disabled');
                    $('#btnsubmit').val('Proses Submit Data');
                },
                success: function(data){
                    if(data.success)
                    {
                        //sweetalert and redirect
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $("#menilai")[0].reset();
                        toastr.success(data.success);
                        $('#btnsubmit').val('Submit Nilai');
                        $('#nilaiPeserta').modal('hide');
                        $('#btnsubmit').attr('disabled',false);
                        swal({ title: "Success!",
                            text: "Peserta Telah Dinilai!",
                            type: "success"})
                    }
                },
                error: function(data)
                {
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

            $(document).ready(function(){
                //select
                $('#master').on('click', function(e) {
                if($(this).is(':checked',true))  
                {
                    $(".sub_chk").prop('checked', true);  
                } else {  
                    $(".sub_chk").prop('checked',false);  
                }  
                });

                var jenis_program = $('#jenis_program').val();
                // console.log(jenis_program);
                var k = $('#kriteria_id').text();
                var pel_id = $('#pelatihan_id').val();
                document.getElementById('kriterias').value=k;
                var pelatihan_id = $('#pelatihan_id').val();
                // console.log(pel_id);

                $.ajax({
                    url:'/diklat-total-peserta-pelatihan/'+pelatihan_id,
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
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
                        url:'/diklat-peserta-data'+ '/'+pel_id,
                    },
                    columns: [
                        {
                        data:'name',
                        name:'name'
                        },
                        {
                        data:'check',
                        name:'check',
                        orderable:false,
                        },
                        {
                        data:'kabupaten',
                        name:'kabupaten.nama',
                        orderable:false,
                        },
                        {
                        data:'ttl',
                        name:'ttl'
                        },
                        {
                        data:'telp',
                        name:'telp'
                        },
                        {
                        data:'alamat',
                        name:'alamat'
                        },
                        {
                        data:'alamatmodul',
                        name:'alamatx'
                        },
                        {
                        data:'jilid',
                        name:'jilid'
                        },
                        {
                        data:'nilai',
                        name:'nilai'
                        },
                        {
                        data:'krits',
                        name:'kriteria',
                        },
                        {
                        data:'action',
                        name:'action'
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
                        url:'/diklat-peserta-data/'+pel_id,
                    },
                    columns: [
                        {
                        data:'name',
                        name:'name'
                        },
                        {
                        data:'check',
                        name:'check',
                        orderable:false,
                        },
                        {
                        data:'kabupaten',
                        name:'kabupaten.nama',
                        orderable:false,
                        },
                        {
                        data:'ttl',
                        name:'ttl'
                        },
                        {
                        data:'telp',
                        name:'telp'
                        },
                        {
                        data:'alamat',
                        name:'alamat'
                        },
                        {
                        data:'alamatmodul',
                        name:'alamatx'
                        },
                        {
                        data:'nilai',
                        name:'nilai'
                        },
                        {
                        data:'krits',
                        name:'kriteria',
                        },
                        {
                        data:'action',
                        name:'action'
                        },
                        
                    ]
                    });
                }
            })

            $('#cetak_all').on('click', function(e) {
            //get id data beberapa
            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });

            if(allVals.length <=0)  
            {  
                alert("Pilih Peserta Yang Akan di Cetak Surat Jalan");  
            }else {  
                // var check = confirm("Are you sure you want to delete this row?");  
                // if(check == true){  
                    
                // }
                var join_selected_values = allVals.join(",");
                    $('#modal_cetak_surat2').modal('show');
                    $('#idcetaksurat').val(join_selected_values);
                // $.ajax({
                //     url:"{{route('diklat.cetak_surat_pengiriman_beberapa')}}",
                //     method:"get",
                //     data:{allVals:allVals},
                //     success:function(data)
                //     {
                //         alert(data);

                //     }
                // });
            }  
            });
            
        </script>
@endsection