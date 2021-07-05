@extends('layouts.tilawatipusat_layouts.master')

@section('title') Cabang @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') Cabang   @endslot
         @slot('title_li') Tilawati   @endslot
    @endcomponent
                    <div class="row">
                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="cb"> 2,456 </b> Cabang  @endslot
                                @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="kb"> 2,456 </b> Kabupaten  @endslot
                                @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="pv"> 2,456 </b>  Provinsi  @endslot
                                @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
                                @slot('price')  @endslot
                                
                            @endcomponent
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                    
                                    <h4 class="card-title">Data Cabang</h4>
                                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br><code>Data Import dan Eksport Berbeda Format (Berhati-hati ketika meng-importkan data baru)</code></p>
                                    <button class="btn btn-sm btn-success  mr-1" style="width:130px ; margin-bottom: 5px" data-toggle="modal" data-target=".bs-example-modal-cabang"><i class="mdi mdi-cloud-upload"></i> import cabang</button>
                                    <button class="btn btn-sm btn-success  mr-1" style="width:130px ; margin-bottom: 5px" data-toggle="modal" data-target=".bs-example-modal-rpq" ><i class="mdi mdi-cloud-upload"></i> import rpq</button>
                                    <button class="btn btn-sm btn-success  mr-1" style="width:130px ; margin-bottom: 5px"><i class="mdi mdi-plus"></i> tambah cabang</button>
                    
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <table id="datatable-buttons" class="table table-cabang table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary">
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Kepala</th>
                                                    <th>Provinsi</th>
                                                    <th>Kabupaten</th>
                                                    <th>Telephone</th>
                                                    <th>Alamat</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
    
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>

                                            <tfoot class="text-bold text-primary">
                                                <tr>
                                                   <th>Nama</th>
                                                   <th>Kepala</th>
                                                   <th>Provinsi</th>
                                                   <th>Kabupaten</th>
                                                   <th>Telephone</th>
                                                   <th>Alamat</th>
                                                   <th>Status</th>
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

                    <!--modal import cabang-->
                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade bs-example-modal-cabang" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                                                        <form id="importcabang"  method="POST" enctype="multipart/form-data">@csrf
                                                            <input type="hidden" id="import_tipe" value="munaqisy">
                                                            <div class="form-group">
                                                                <label for="">Import Data "Cabang" (hanya Excel File format .xlsx)</label>
                                                                <input type="file" class="form-control" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                                                            </div>
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
                    <!--modal import rpq-->
                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade bs-example-modal-rpq" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                                                        <form id="importrpq"  method="POST" enctype="multipart/form-data">@csrf
                                                            <input type="hidden" id="import_tipe" value="munaqisy">
                                                            <div class="form-group">
                                                                <label for="">Import Data "RPQ" (hanya Excel File format .xlsx)</label>
                                                                <input type="file" class="form-control" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="submit" name="import" id="btnimportrpq" class="btn btn-info" value="Import"/>
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

                    <div class="modal fade bs-example-modal-kepala-bagian-lama" id="mod_cabang2" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">DAFTAR PROVINSI DARI CABANG</h5>
                                    <button type="button" class="close" data-dismiss="modal" onclick="tutup_pilih_kepala()" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{-- <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive"> --}}
                                        <form id="pilih_kepala_bagian_form" method="post" enctype="multipart/form-data">@csrf
                                            <input type="hidden" id="lembaga_kode" name="kode">
                                            <input type="submit" style="margin-bottom: 20px" id="pilih_kepala_bagian_btn" class="btn btn-sm btn-info" value="Konfirmasi">
                                            <table id="datatable-buttons2" class="table prov table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
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
                                        <footer class="blockquote-footer">Updated at  <cite title="Source Title">2021</cite></footer>
                                    {{-- </blockquote> --}}
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade bs-example-modal-kepala-lembaga" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                                                <button class="btn btn-info text-capitalize" style="width: 100%; height: 59px;" onclick="kepala_bagian()">kepala bagian yang sudah ada</button>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <button class="btn btn-success text-capitalize" style="width: 100%; height: 59px;">kepala bagian baru</button>
                                            </div>
                                        </div>
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
        <script src="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.js')}}"></script>
        <script src="{{ URL::asset('tilawatipusat/libs/jszip/jszip.min.js')}}"></script>
        <script src="{{ URL::asset('tilawatipusat/libs/pdfmake/pdfmake.min.js')}}"></script>

        <!-- Datatable init js -->
        <script src="{{ URL::asset('tilawatipusat/js/pages/datatables.init.js')}}"></script>

        <script>
            var kode;
            function tutup_pilih_kepala() {
                $("#pilih_kepala_bagian_form")[0].reset();
            }
            $('.bs-example-modal-kepala-lembaga').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                id = button.data('kode')
                var modal = $(this)
                kode = modal.find('.modal-body #id').val(id);
                
            })

            function kepala_bagian() {
                $('.bs-example-modal-kepala-lembaga').modal('hide');
                $('.bs-example-modal-kepala-bagian-lama').modal('show');
                var ya = $('.memilih_lembaga').val();
                document.getElementById('lembaga_kode').value=ya;
                console.log(ya);
            }

            $('#pilih_kepala_bagian_form').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "/diklat-kepala-bagian-pilih-cabang",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#pilih_kepala_bagian_btn').attr('disabled','disabled');
                    $('#pilih_kepala_bagian_btn').val('Proses Update Data');
                },
                success: function(data){
                        if(data.success)
                        {
                            //sweetalert and redirect
                            var oTable = $('#datatable-buttons').dataTable();
                            oTable.fnDraw(false);
                            $("#pilih_kepala_bagian_form")[0].reset();
                            $('#pilih_kepala_bagian_btn').val('Konfirmasi!');
                            $('.bs-example-modal-kepala-bagian-lama').modal('hide');
                            $('#pilih_kepala_bagian_btn').attr('disabled',false);
                            swal({ title: "Success!",
                                text: "Kepala Cabang Sudah Dipilih!",
                                type: "success"})
                        }else{
                            $('#pilih_kepala_bagian_btn').val('Konfirmasi!');
                            $('#pilih_kepala_bagian_btn').attr('disabled',false);
                            swal({ title: "Error!",
                                text: "Pilih Kepala Lembaga / Cabang Terlebih Dahulu!",
                                type: "error"})
                        }
                    }
                });
            });

            $(document).ready(function(){

                $('#datatable-buttons2').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url:'{{ route("diklat.kepala_pilih") }}',
                },
                columns: [
                    {
                    data:'name',
                    name:'name'
                    },
                    {
                    data:'bagian',
                    name:'cabang.name',
                    name:'lembaga.name',
                    },
                    {
                    data:'pilih',
                    name:'pilih'
                    }
                ]
                });

                $.ajax({
                    url:'{{ route("diklat.cabang_kab") }}',
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        document.getElementById('kb').innerHTML = data;
                        console.log(data);
                    }
                });

                $.ajax({
                    url:'{{ route("diklat.cabang_pro") }}',
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        document.getElementById('pv').innerHTML = data;
                        console.log(data);
                    }
                });

                $.ajax({
                    url:'{{ route("diklat.cabang_tot") }}',
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
                    url:'{{ route("diklat.cabang_data") }}',
                },
                columns: [
                    {
                    data:'name',
                    name:'name'
                    },
                    {
                    data:'kepala',
                    name:'kepala.name',
                    orderable:false,
                    },
                    {
                    data:'provinsi',
                    name:'provinsi.nama'
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
                    data:'alamat',
                    name:'alamat'
                    },
                    {
                    data:'status',
                    name:'status'
                    },
                ]
                });
            })

            //import rpq
            $('#importrpq').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('import.rpq')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnimportrpq').attr('disabled','disabled');
                    $('#btnimportrpq').val('Importing Process');
                },
                success: function(data){
                    if(data.success)
                    {
                        //get total data cabang
                        $.ajax({
                            url:'{{ route("dashboard.cabang") }}',
                            type: 'get',
                            dataType: 'json',
                            success:function(data) {
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
                        $('#btnimport').attr('disabled',false);
                        $('.bs-example-modal-rpq').modal('hide');
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
            //import cabang
            $('#importcabang').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('import.cabang')}}",
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
                        $("#importcabang")[0].reset();
                        toastr.success(data.success);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btnimport').val('Import');
                        $('#btnimport').attr('disabled',false);
                        $('.bs-example-modal-cabang').modal('hide');
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
        </script>
@endsection