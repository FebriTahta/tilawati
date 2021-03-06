@extends('layouts.tilawatipusat_layouts.master')

@section('title') daftar peserta @endsection
@section('css')

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="{{URL::asset('tilawatipusat/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        table.dataTable.peserta td:nth-child(4) {
        width: 260px;
        word-break: break-all;
        white-space: pre-line;
        text-align: center;
        }
        table.dataTable.peserta th:nth-child(4) {
        width: 260px;
        word-break: break-all;
        white-space: pre-line;
        text-align: center;
        }
    </style>

@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title'){{ $diklat->program->name }}   @endslot
         @slot('title_li') @endslot
    @endcomponent
    <input type="hidden" id="pelatihan_id" value="{{ $diklat->id }}">
                    <div class="row">
                        <div class="col-xl-8">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id=""> Cabang {{ $diklat->cabang->name }} - {{ $diklat->cabang->kabupaten->nama }} - <span class="text-info">{{ Carbon\Carbon::parse($diklat->tanggal)->isoFormat('D MMMM Y') }}</span></b>  @endslot
                                @slot('iconClass')mdi mdi-account-group  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>

                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="cb"> ??? </b> Peserta  @endslot
                                @slot('iconClass')mdi mdi-account-group  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <input type="hidden" id="jenis_program" value="{{ $diklat->program->name }}">
                                    <h4 class="card-title text-capitalize">Data Pendaftaran Peserta Pelatihan </h4>
                                    @if ($diklat->program->penilaian->count() == 0)
                                        <code>Diklat ini belum memiliki kategori penilaian -> <a href="/diklat-program">tentukan kategori penilaian </a></code><br>
                                    @endif
                                    @if ($diklat->program->registrasi->count() == 0)
                                        <code>Diklat ini belum memiliki syarat pendaftaran -> <a href="/diklat-persyaratan"> tentukan syarat pendaftaran </a></code>
                                    @endif
                                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br></p>
                                    
                                    
                                    <input type="hidden" id="pelatihan_id" value="{{ $diklat->id }}">
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <div id="message"></div>
                                        <table id="datatable-buttons" class="table table-peserta table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary" style="text-transform: capitalize">
                                                <tr> 
                                                    <th>peserta</th>
                                                    <th>kab / kota</th>
                                                    <th>phone</th>
                                                    <th>dokumen</th>
                                                    <th>status</th>
                                                    <th>...</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>
                                            <tfoot class="text-primary">
                                                <tr>
                                                    <th>peserta</th>
                                                    <th>kab / kota</th>
                                                    <th>phone</th>
                                                    <th>dokumen</th>
                                                    <th>status</th>
                                                    <th>...</th>
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

                    {{-- file --}}
                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade" id="modal_file" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body text-center" >
                                        <div class="card">
                                            {{-- <p class="text-uppercase text-primary" id="peserta_name"></p> --}}
                                            <h5 class="text-uppercase text-primary" id="img_name"></h5>
                                            <div class="card-body">
                                                <img src="" id="img_file" style="width: auto; max-height: 100%; max-width: 100%" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                    {{-- file --}}

                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade bs-example-modal-kriteria-hapus" id="hapusData" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="formacc2"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group text-center">
                                                                <h5>Tulis alasan pendaftaran peserta tersebut tidak diterima!</h5>
                                                                <input type="hidden" class="form-control text-capitalize" id="id" name="id" required>
                                                                <input type="hidden" value="2" name="acc">
                                                            </div>
                                                            <div class="row" style="text-align: center">
                                                                <div class="form-group col-12 col-xl-12">
                                                                    <textarea name="alasan" id="alasan" cols="10" rows="2" class="form-control" required></textarea>
                                                                </div>
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <input type="submit" id="btntolak" class="btn btn-danger" value="Ya, Tolak!" />
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
                        <div class="modal fade modal-acc" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <span class="text-uppercase">Konfirmasi Pendaftaran</span>
                                        <input type="text" id="nama_peserta" class="form-control text-uppercase" style="border: none; text-align: center">
                                        <hr>
                                        <form id="formacc" action="#" method="POST" enctype="multipart/form-data">@csrf
                                            <div class="row">
                                                <input type="hidden" name="id" id="id" required>
                                                <input type="hidden" value="1" name="acc" id="acc" required>
                                                <div class="form-group col-6 col-xl-6">
                                                    <input type="submit" id="btnterima" class="btn btn-success" value="Terima!">
                                                </div>
                                                <div class="form-group col-6 col-xl-6">
                                                    <button class="btn btn-secondary" data-dismiss="modal">Cancel!</button>
                                                </div>
                                            </div>
                                        </form>
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
            //terima pendaftaran
            $('.modal-acc').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var name = button.data('name')
                var modal = $(this)
                modal.find('.modal-body #nama_peserta').val(name);
                modal.find('.modal-body #id').val(id);
                console.log(name);
            })
            //tolak pendaftaran
            $('#hapusData').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
            })
            $('#modal_file').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                file = button.data('file')
                name = button.data('name')
                img_name = button.data('img_name')
                var modal = $(this)
                document.getElementById("img_file").src = file;
            })

            $('#formacc').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('acc')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnterima').attr('disabled','disabled');
                    $('#btnterima').val('Proses Terima Data');
                },
                success: function(data){
                    if(data.success)
                    {
                        //sweetalert and redirect
                        toastr.success(data.success);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btnterima').val('Ya, Terima!');
                        $('.modal-acc').modal('hide');
                        $('#btnterima').attr('disabled',false);
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

            $('#formacc2').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('acc')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btntolak').attr('disabled','disabled');
                    $('#btntolak').val('Proses Data Ditolak');
                },
                success: function(data){
                    if(data.success)
                    {
                        //sweetalert and redirect
                        toastr.error(data.success);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btntolak').val('Ya, Tolak!');
                        $('#hapusData').modal('hide');
                        $('#btntolak').attr('disabled',false);
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

            $(document).ready(function(){
                var jenis_program = $('#jenis_program').val();
                console.log(jenis_program);
                var k = $('#kriteria_id').text();
                var pel_id = $('#pelatihan_id').val();
                var pelatihan_id = $('#pelatihan_id').val();
                $.ajax({
                    url:'/diklat-total-peserta-pelatihan/'+pelatihan_id,
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
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
                        url:'/konfirmasi-data-peserta/'+pel_id,
                    },
                    columns: [
                        {
                        data:'name',
                        name:'name'
                        },
                        {
                        data:'kabupaten',
                        name:'kabupaten.nama'
                        },
                        {
                        data:'telp',
                        name:'telp'
                        },
                        {
                        data:'registrasi',
                        name:'registrasi'
                        },
                        {
                        data:'status',
                        name:'status'
                        },
                        {
                        data:'action',
                        name:'action'
                        },
                        
                    ]
                    });
                
            })
            
        </script>
@endsection