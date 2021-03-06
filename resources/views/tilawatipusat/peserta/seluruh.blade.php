@extends('layouts.tilawatipusat_layouts.master')

@section('title') Peserta @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="{{URL::asset('tilawatipusat/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('tilawatipusat/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('tilawatipusat/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('tilawatipusat/libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />


@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') Peeserta   @endslot
         @slot('title_li') DIKLAT   @endslot
    @endcomponent
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            {{-- tes --}}
                            {{--  --}}
                            <div class="card">
                                @if(Session::has('fail'))
                                    <div class="col-lg-12 alert alert-danger">
                                    {{Session::get('fail')}}
                                    </div>
                                @endif
                                <div class="row p-3">
                                    <div class="col-6 col-xl-4 form-group">
                                        <label>Dari :</label>
                                        <input type="date" onchange="myfunction()" name="dari" id="dari" class="form-control">
                                        <span class="red dari" style="color: red"></span>
                                    </div>
                                    <div class="col-6 col-xl-4 form-group">
                                        <label>Sampai :</label>
                                        <input type="date" onchange="myfunction2()" name="sampai" id="sampai" class="form-control">
                                        <span class="red sampai" style="color: red"></span>
                                    </div>
                                    <div class="form-group col-6 col-xl-2">
                                        <label for="">Cari :</label>
                                        <button class="btn btn-rounded form-control text-white" style="background-color: rgb(137, 137, 253)" name="filter" id="filter"> <i
                                                class="fa fa-search"></i></button>
                                    </div>
                                    <div class="form-group col-6 col-xl-2">
                                        <label for="">Reset :</label>
                                        <button class="btn btn-rounded btn-danger form-control" name="refresh" id="refresh"> <i
                                                class="fa fa-stop"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-6">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="cb"> ??? </b><br><small class="text-uppercase"> Total Seluruh Peserta Diklat  </small>@endslot
                                @slot('iconClass')  mdi mdi-account-group  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                        <div class="col-xl-6">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="cb5"> ??? </b><br><small class="text-uppercase">Telah & Belum Bersyahadah </small>@endslot
                                @slot('iconClass') mdi mdi-mdi mdi-contact-mail-outline  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <a class="text-uppercase" href="#" data-toggle="modal" data-target="#mod_cabang2"> <b id="cb2"> ??? </b><br><small> Pelaksana </small></a>@endslot
                                @slot('iconClass') mdi mdi-bank-outline  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <a class="text-uppercase" href="#" data-toggle="modal" data-target="#mod_kabupaten"> <b id="cb3"> ??? </b><br><small> Asal Peserta </small></a>@endslot
                                @slot('iconClass') mdi mdi-city  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <a class="text-uppercase" href="#" data-toggle="modal" data-target="#mod_cabang3"> <b id="cb4"> ??? </b><br><small> Program </small></a>@endslot
                                @slot('iconClass') fa fa-book  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="row p-3">
                                    <div class="form-group col-6 col-xl-6">
                                        <button class="text-right btn btn-sm mr-1 btn-outline-info" id="depan_all"><i class="fa fa-print"></i> SYAHADAH DEPAN</button>
                                        <button class="text-right btn btn-sm mr-1 btn-outline-info" id="belakang_all"><i class="fa fa-print"></i> SYAHADAH BELAKANG</button>
                                        {{-- <form action="#">
                                            <button class="btn btn-sm btn-info"><i class="fa fa-download"></i> Info Peserta</button>
                                        </form> --}}
                                        {{-- <button class="btn btn-sm btn-info"><i class="fa fa-search"></i> Cari Detail Peserta</button> --}}
                                    </div> 
                                    <div class="form-group col-6 col-xl-6 text-right">
                                        <form action="{{route('export.seluruh.peserta')}}" method="GET" enctype="multipart/form-data" id="export_data_peserta">@csrf
                                            <input type="hidden" name="from" id="from">
                                            <input type="hidden" name="till" id="till">
                                            <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-download"></i> Data Peserta</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-body table-responsive">
                                    <h4 class="card-title">Data Peserta Diklat</h4>
                                    <table id="datatable-buttons" class="table table-diklat table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                        <thead class="text-bold text-primary" style="text-transform: capitalize">
                                            <tr>
                                                <th>id</th>
                                                <th><input type="checkbox" id="master"> </th>
                                                <th>peserta</th>
                                                <th>asal</th>
                                                <th>TTL</th>
                                                <th>telp</th>
                                                <th>alamat</th>
                                                <th>cabang</th>
                                                <th>diklat</th>
                                                <th>tempat</th>
                                                <th>tanggal</th>
                                                <th>nilai</th>
                                                <th>Kriteria</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>

                                        <tbody style="text-transform: uppercase; font-size: 12px">
                                        </tbody>

                                        <tfoot class="text-primary" style="text-transform: capitalize">
                                            <tr>
                                                <th>id</th>
                                                <th></th>
                                                <th>peserta</th>
                                                <th>asal</th>
                                                <th>TTL</th>
                                                <th>telp</th>
                                                <th>alamat</th>
                                                <th>cabang</th>
                                                <th>diklat</th>
                                                <th>tempat</th>
                                                <th>tanggal</th>
                                                <th>nilai</th>
                                                <th>Kriteria</th>
                                                <th>Option</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    {{-- hapus peserta / diklat (tidak digunakan) --}}
                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade bs-example-modal-diklat-hapus" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="hapusdiklat"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group text-center">
                                                                <h5>Anda yakin akan menghapus Diklat tersebut ?</h5>
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

                    {{-- daftar cabang --}}
                    <div class="modal fade bs-example-modal-xl-2" id="mod_cabang2" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">DAFTAR CABANG YANG MENGADAKAN DIKLAT</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <div style="text-align: center">
                                            <form action="/export-laporan-data-cabang" method="POST">@csrf
                                                <input type="text" id="dari_download" name="dari" class="form-control mb-2" readonly>
                                                <input type="text" id="sampai_download" name="sampai" class="form-control mb-2" readonly>
                                                <button type="submit" class="btn btn-sm btn-primary">DOWNLOAD DATA</button>
                                            </form>
                                        </div>
                                        
                                        <table id="datatable-buttons2" class="table table-diklat-cabang table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary">
                                                <tr>
                                                    <th>CABANG</th>
                                                    <th>TOTAL DIKLAT</th>
                                                    <th>PROGRAM DIKLAT</th>
                                                    <th>GURU</th>
                                                    <th>SANTRI</th>
                                                </tr>
                                            </thead>
                    
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>
                    
                                            <tfoot class="text-bold text-primary">
                                                <tr>
                                                    <th>CABANG</th>
                                                    <th>TOTAL</th>
                                                    <th>PROGRAM DIKLAT</th>
                                                    <th>GURU</th>
                                                    <th>SANTRI</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <footer class="blockquote-footer">Updated at  <cite title="Source Title">2021</cite></footer>
                                    </blockquote>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                    {{-- daftar program --}}
                    <div class="modal fade bs-example-modal-xl-2" id="mod_cabang3" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">DAFTAR PROGRAM DIKLAT</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <table id="datatable-buttons4" class="table table-diklat-program table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary" style="font-size: 12px; text-transform: uppercase">
                                                <tr>
                                                    <th>Program</th>
                                                    <th>Peserta</th>
                                                    <th>Lulus</th>
                                                    <th>Belum</th>
                                                </tr>
                                            </thead>
                    
                                            <tbody style="text-transform: uppercase; font-size: 10px">
                                            </tbody>
                    
                                            <tfoot class="text-bold text-primary" style="font-size: 12px; text-transform: uppercase">
                                                <tr>
                                                    <th>Program</th>
                                                    <th>Peserta</th>
                                                    <th>Lulus</th>
                                                    <th>Belum</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <footer class="blockquote-footer">Updated at  <cite title="Source Title">2021</cite></footer>
                                    </blockquote>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                    {{-- daftar asal daerah peserta --}}
                    <div class="modal fade bs-example-modal-xl-3" id="mod_kabupaten" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">DAFTAR ASAL DAERAH PESERTA</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <table id="datatable-buttons3" class="table table-diklat-kabupaten table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary">
                                                <tr>
                                                    <th>Kabupaten</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                    
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>
                    
                                            <tfoot class="text-bold text-primary">
                                                <tr>
                                                   <th>Kabupaten</th>
                                                   <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <footer class="blockquote-footer">Updated at  <cite title="Source Title">2021</cite></footer>
                                    </blockquote>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                    {{-- qr code --}}
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

                    {{-- modal download syahadah depan --}}
                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade" id="modal-download-depan" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="" action="/pelatihan-cetak-depan-print-beberapa"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group text-center">
                                                                <h5>CETAK SYAHADAH DEPAN ?</h5>
                                                                <input type="hidden" class="form-control text-capitalize" id="idcetakdepan" name="id" required>
                                                            </div>
                                                            <div class="row" style="text-align: center">
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <input type="submit" id="btndownload" class="btn btn-primary" value="Ya, Cetak!" />
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

                    {{-- modal download syahadah belakang --}}
                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade" id="modal-download-belakang" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="" action="/pelatihan-cetak-belakang-print-beberapa"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group text-center">
                                                                <h5>CETAK SYAHADAH BELAKANG ?</h5>
                                                                <input type="hidden" class="form-control text-capitalize" id="idcetakbelakang" name="id" required>
                                                            </div>
                                                            <div class="row" style="text-align: center">
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <input type="submit" id="btndownload" class="btn btn-primary" value="Ya, Cetak!" />
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
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('.modal-scan').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                id = button.data('id')
                nama_peserta = button.data('nama_peserta')
                var modal = $(this)
                $('#nama_peserta').html(nama_peserta);
                document.getElementById("qr-code").src = id;
            })
            $('.bs-example-modal-diklat-hapus').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
            })
            $('#hapusdiklat').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.delete')}}",
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
                        //sweetalert and redirect
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btnhapus').val('Ya, Hapus!');
                        $('.bs-example-modal-diklat-hapus').modal('hide');
                        $('#btntambah').attr('disabled',false);
                        swal({ title: "Success!",
                            text: "Kriteria Tersebut Berhasil Di Dihapus!",
                            type: "success"})
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });
            
            $(document).ready(function(){
                //ready load data
                load_data();

                function load_data(dari = '', sampai = '')
                {
                    //pilih cabang
                    $('#sel_cabang').select2('destroy').select2({
                        placeholder: 'Select an item',
                        ajax: {
                            url: "{{route('diklat.diklat_cabang_select')}}",
                            dataType: 'json',
                            delay: 250,
                            processResults: function (data) {
                            return {
                                results:  $.map(data, function (item) {
                                    return {
                                        text: item.kode,
                                        text: item.name,
                                        id: item.id   
                                    }
                                })
                            };
                            },
                            cache: true
                        }
                    });

                    //total diklat dan cabang yang mengadakan diklat
                    $.ajax({
                        url:'{{ route("diklat.peserta_tot") }}',
                        type: 'get',
                        dataType: 'json',
                        data:{dari:dari, sampai:sampai},
                        success:function(data) {
                            document.getElementById('cb').innerHTML = data;
                            console.log(data);
                        }
                    });
                    $.ajax({
                        url:'{{ route("diklat.diklat_cabang_tot") }}',
                        type: 'get',
                        dataType: 'json',
                        data:{dari:dari, sampai:sampai},
                        success:function(data) {
                            document.getElementById('cb2').innerHTML = data;
                            console.log(data);
                        }
                    });

                    $.ajax({
                        url:'{{ route("diklat.peserta_kabupaten_tot") }}',
                        type: 'get',
                        dataType: 'json',
                        data:{dari:dari, sampai:sampai},
                        success:function(data) {
                            document.getElementById('cb3').innerHTML = data;
                            console.log(data);
                        }
                    });

                    $.ajax({
                        url:'{{ route("diklat.peserta_program_tot") }}',
                        type: 'get',
                        dataType: 'json',
                        data:{dari:dari, sampai:sampai},
                        success:function(data) {
                            document.getElementById('cb4').innerHTML = data;
                            console.log(data);
                        }
                    });

                    $.ajax({
                        url:'/diklat-total-seluruh-peserta-bersyahadah',
                        type: 'get',
                        dataType: 'json',
                        data:{dari:dari, sampai:sampai},
                        success:function(data) {
                            document.getElementById('cb5').innerHTML = data;
                            console.log(data);
                        }
                    });

                    //data diklat dan data cabang diklat
                    $('.table-diklat').DataTable({
                        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                        destroy: true,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url:'{{ route("diklat.seluruh_peserta_data") }}',
                            data:{dari:dari, sampai:sampai}
                        },
                        columns: [
                            {
                            data:'id',
                            name:'id',
                            },
                            {
                            data:'check',
                            orderable:false
                            },
                            {
                            data:'name',
                            name:'name',
                            },
                            {
                            data:'kabupaten',
                            name:'kabupaten.nama'
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
                            data:'cabang',
                            name:'cabang.name',
                            },
                            {
                            data:'program',
                            name:'program.name',
                            },
                            {
                            data:'tempat',
                            name:'pelatihan.tempat',
                            },
                            {
                            data:'tanggal',
                            name:'tanggal'
                            },
                            {
                            data:'nilai',
                            name:'nilai'
                            },
                            {
                            data:'kriteria',
                            name:'kriteria'
                            },
                            {
                            data:'action',
                            name:'action'
                            },
                        ]
                    });
                    //export peserta

                    $('#datatable-buttons3').DataTable({
                        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                        destroy: true,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url:'{{ route("diklat.peserta_kab") }}',
                            data:{dari:dari, sampai:sampai}
                        },
                        columns: [
                            {
                            data:'kabupaten',
                            name:'kabupaten.nama'
                            },
                            {
                            data:'action',
                            name:'action'
                            },
                            
                        ]
                    });

                    $('.table-diklat-cabang').DataTable({
                        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                        "columnDefs": [
                            { "type": "numeric-comma", targets: "_all" }
                        ],
                        destroy: true,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url:'{{ route("diklat.peserta_cabang_pilih") }}',
                            data:{dari:dari, sampai:sampai}
                        },
                        columns: [
                            {
                            data:'cabang',
                            name:'name'
                            },
                            {
                            data:'jumlahdiklat',
                            name:'jumlahdiklat'
                            },
                            {
                            data:'namadiklat',
                            name:'namadiklat'
                            },
                            {
                            data:'total_guru',
                            name:'total_guru'
                            },
                            {
                            data:'total_santri',
                            name:'total_santri'
                            },
                            
                        ]
                    });

                    $('#datatable-buttons4').DataTable({
                        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                        destroy: true,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url:'{{ route("diklat.peserta_program_pilih") }}',
                            data:{dari:dari, sampai:sampai}
                        },
                        columns: [
                            {
                            data:'program',
                            name:'program.name'
                            },
                            {
                            data:'total_semua',
                            name:'total_semua'
                            },
                            {
                            data:'total_lulus',
                            name:'total_lulus'
                            },
                            {
                            data:'total_belum',
                            name:'total_belum'
                            },
                            // {
                            // data:'action',
                            // name:'action'
                            // },
                            
                        ]
                    });
                }

                $('#dari').on('change', function() {
                    $('#dari_download').val(this.value);
                });
                $('#sampai').on('change', function() {
                    $('#sampai_download').val(this.value);
                });

                $('#filter').click(function(){
                    var dari = $('#dari').val();
                    var sampai = $('#sampai').val();
                    if(dari != '' &&  sampai != '')
                    {
                        load_data(dari, sampai);
                    }
                    else
                    {
                        alert('Kedua tanggal harus diisi');
                    }
                });

                $('#refresh').click(function(){
                    $('#dari').val('');
                    $('#sampai').val('');
                    $('#from').val('');
                    $('#till').val('');
                    $('#dari_download').val('');
                    $('#sampai_download').val('');
                    load_data();
                });
            });

            function myfunction() {
                var x = document.getElementById("dari").value;
                document.getElementById("from").value = x;
            }

            function myfunction2() {
                var y = document.getElementById("sampai").value;
                document.getElementById("till").value = y;
            }

            $('#master').on('click', function(e) {
                if($(this).is(':checked',true))  
                {
                    $(".sub_chk").prop('checked', true);  
                } else {  
                    $(".sub_chk").prop('checked',false);  
                }  
            });

            // cetak syahadah depan
            $('#depan_all').on('click', function(e) {
            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });

            if(allVals.length <=0)  
            {  
                alert("PILIH PESERTA YANG AKAN DI CETAK SYAHADAH DEPAN");  
            }else {  
                var join_selected_values = allVals.join(",");
                    $('#modal-download-depan').modal('show');
                    $('#idcetakdepan').val(join_selected_values);
            }  
            });

            // cetak syahadah belakang
            $('#belakang_all').on('click', function(e) {
            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });

            if(allVals.length <=0)  
            {  
                alert("PILIH PESERTA YANG AKAN DI CETAK SYAHADAH BELAKANG");  
            }else {  
                var join_selected_values = allVals.join(",");
                    $('#modal-download-belakang').modal('show');
                    $('#idcetakbelakang').val(join_selected_values);
            }  
            });
        </script>
@endsection