@extends('layouts.tilawatipusat_layouts.master')

@section('title') Kode Negara @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') KODE   @endslot
         @slot('title_li') NEGARA   @endslot
    @endcomponent
                    <div class="row">
                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="cb"> {{$negara}} </b> Negara  @endslot
                                @slot('iconClass') mdi mdi-country-outline  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                    
                                    <h4 class="card-title">Data Negara</h4>
                                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br><code>Data Import dan Eksport Berbeda Format (Berhati-hati ketika meng-importkan data baru)</code></p>
                                    <button class="btn btn-sm btn-success  mr-1" style="margin-bottom: 5px" data-toggle="modal" data-target=".bs-example-modal-cabang"><i class="mdi mdi-cloud-upload"></i> import kode telephone baru</button>
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <table id="datatable-buttonsx" class="table table-cabang table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary">
                                                <tr>
                                                    <th>Nama Negara</th>
                                                    <th>Phone Code</th>
                                                    <th>Kode1</th>
                                                    <th>Kode2</th>
                                                </tr>
                                            </thead>
    
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>

                                            <tfoot class="text-bold text-primary">
                                                <tr>
                                                    <th>Nama Negara</th>
                                                    <th>Phone Code</th>
                                                    <th>Kode1</th>
                                                    <th>Kode2</th>
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
                                        <h5 class="modal-title mt-0">IMPORT COUNTRY PHONE CODE </h5>
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
                                                                <label for="">Import Kode "Telephone Berdasarkan Negara" (hanya Excel .xlxs dengan File format yang sudah ditentukan)</label>
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
            var kode;
            
            $('.bs-example-modal-kepala-lembaga').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                id = button.data('kode')
                var modal = $(this)
                $('#kepala_baru').attr('href', '/diklat-kepala-bagian-cabang-create/'+id);
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

            
            //import cabang
            $('#importcabang').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('import_kode')}}",
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

            $('#datatable-buttonsx').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url:'{{ route("data_negara") }}',
                },
                columns: [
                    {
                    data:'country_name',
                    name:'country_name'
                    },
                    {
                    data:'code',
                    name:'phonegara.phonecode'
                    },
                    {
                    data:'code1',
                    name:'code1'
                    },
                    {
                    data:'code2',
                    name:'code2'
                    },
                ]
                });
        </script>
@endsection

