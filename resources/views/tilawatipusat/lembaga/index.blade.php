@extends('layouts.tilawatipusat_layouts.master')

@section('title') lembaga @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') lembaga   @endslot
         @slot('title_li') lembaga Tilawati   @endslot
    @endcomponent
                    <div class="row">
                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="cb"> 2,456 </b> lembaga  @endslot
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
                    
                                    <h4 class="card-title">Data lembaga</h4>
                                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br><code>Data Import dan Eksport Berbeda Format (Berhati-hati ketika meng-importkan data baru)</code></p>
                                    <button class="btn btn-sm btn-success  mr-1" style="width:130px " data-toggle="modal" data-target=".bs-example-modal-lembaga"><i class="mdi mdi-cloud-upload"></i> import lembaga</button>
                                    <button class="btn btn-sm btn-success  mr-1" style="width:130px "><i class="mdi mdi-plus"></i> tambah lembaga</button>
                    
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2">
                                        <table id="datatable-buttons" class="table table-lembaga table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary">
                                                <tr>
                                                    <th>Kode</th>
                                                    <th>Name</th>
                                                    <th>Kepala</th>
                                                    <th>Kabupaten</th>
                                                    <th>Provinsi</th>
                                                    <th>Telephone</th>
                                                    <th>Guru</th>
                                                    <th>Santri</th>
                                                    <th>Alamat</th>
                                                    <th>Tahun Masuk</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
    
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>

                                            <tfoot class="text-primary">
                                                <tr>
                                                    <th>Kode</th>
                                                    <th>Name</th>
                                                    <th>Kepala</th>
                                                    <th>Kabupaten</th>
                                                    <th>Provinsi</th>
                                                    <th>Telephone</th>
                                                    <th>Guru</th>
                                                    <th>Santri</th>
                                                    <th>Alamat</th>
                                                    <th>Tahun Masuk</th>
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

                    <!--modal import lembaga-->
                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade bs-example-modal-lembaga" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0">IMPORT DATA lembaga </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="importlembaga"  method="POST" enctype="multipart/form-data">@csrf
                                                            <input type="hidden" id="import_tipe" value="munaqisy">
                                                            <div class="form-group">
                                                                <label for="">Import Data "lembaga" (hanya Excel File format .xlsx)</label>
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
            $(document).ready(function(){
                
                $.ajax({
                    url:'{{ route("diklat.lembaga_kab") }}',
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        document.getElementById('kb').innerHTML = data;
                        console.log(data);
                    }
                });

                $.ajax({
                    url:'{{ route("diklat.lembaga_pro") }}',
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        document.getElementById('pv').innerHTML = data;
                        console.log(data);
                    }
                });

                $.ajax({
                    url:'{{ route("diklat.lembaga_tot") }}',
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
                    url:'{{ route("diklat.lembaga_data") }}',
                },
                columns: [
                    {
                    data:'kode',
                    name:'kode'
                    },
                    {
                    data:'name',
                    name:'name'
                    },
                    {
                    data:'kepala',
                    name:'kepala.name'
                    },
                    {
                    data:'kabupaten',
                    name:'kabupaten.nama'
                    },
                    {
                    data:'provinsi',
                    name:'provinsi.nama'
                    },
                    {
                    data:'telp',
                    name:'telp'
                    },
                    {
                    data:'jml_guru',
                    name:'jml_guru'
                    },
                    {
                    data:'jml_santri',
                    name:'jml_santri'
                    },
                    {
                    data:'alamat',
                    name:'alamat'
                    },
                    {
                    data:'tahunmasuk',
                    name:'tahunmasuk'
                    },
                    {
                    data:'status',
                    name:'status',
                    render: function(data) { 
                            if(data == "Aktif") {
                                return '<span class=" badge badge-success">Aktif</span>'; 
                            }else{
                                return '<span class=" badge badge-danger">Non Aktif</span>'; 
                            }
                        },
                    },
                ]
                });
            })

            //import lembaga
            $('#importlembaga').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('import.lembaga')}}",
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
                        $("#importlembaga")[0].reset();
                        toastr.success(data.success);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btnimport').val('Import');
                        $('#btnimport').attr('disabled',false);
                        $('.bs-example-modal-lembaga').modal('hide');
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