@extends('layouts.tilawatipusat_layouts.master')

@section('title') Kepala Bagian @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') Kepala   @endslot
         @slot('title_li') Bagian   @endslot
    @endcomponent
                    <div class="row">
                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="cb"> ??? </b> Kepala bagian  @endslot
                                @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                    
                                    <h4 class="card-title">Data Kepala Bagian</h4>
                                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br><code>Data Import dan Eksport Berbeda Format (Berhati-hati ketika meng-importkan data baru)</code></p>
                                    <button class="btn btn-sm btn-success  mr-1" style="width:130px ; margin-bottom: 5px" data-toggle="modal" data-target=".bs-example-modal-kepala"><i class="mdi mdi-cloud-upload"></i> import kepala</button>
                                    <button class="btn btn-sm btn-success  mr-1" style="width:130px ; margin-bottom: 5px" data-toggle="modal" data-target=".bs-example-modal-rpq" ><i class="mdi mdi-cloud-upload"></i> import rpq</button>
                                    <button class="btn btn-sm btn-success  mr-1" style="width:130px ; margin-bottom: 5px"><i class="mdi mdi-plus"></i> tambah kepala</button>
                    
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <table id="datatable-buttons" class="table table-kepala table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary">
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Kabupaten</th>
                                                    <th>Alamat</th>
                                                    <th>Telephone</th>
                                                    
                                                    <th>Kepala</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
    
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>

                                            <tfoot class="text-bold text-primary">
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Kabupaten</th>
                                                    <th>Alamat</th>
                                                    <th>Telephone</th>
                                                    
                                                    <th>Kepala</th>
                                                    <th>Action</th>
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
                        <div class="modal fade bs-example-modal-kepala-hapus" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="hapuskepala"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group text-center">
                                                                <h5>Anda yakin akan menghapus Kepala Bagian tersebut ?</h5>
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

                $('#datatable-buttons').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url:'{{ route("diklat.kepala_data") }}',
                },
                columns: [
                    
                    {
                    data:'name',
                    name:'name'
                    },
                    {
                    data:'kabupaten',
                    name:'kabupaten'
                    },
                    {
                    data:'alamat',
                    name:'alamat',
                    render: function(data) { 
                            if(data !== null) {
                            return data;
                            }
                            else {
                            return '<span class="badge badge-danger">kosong</span>';
                            }

                        },
                    },
                    {
                    data:'telp',
                    name:'telp',
                    render: function(data) { 
                            if(data !== null) {
                            return data;
                            }
                            else {
                            return '<span class="badge badge-danger">kosong</span>';
                            }

                        },
                    },
                    
                    {
                    data:'bagian',
                    name:'bagian'
                    },
                    {
                    data:'action',
                    name:'action'
                    },
                ]
                });
            });

            $('.bs-example-modal-kepala-hapus').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
            })

            $('#hapuskepala').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.kepala_delete')}}",
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
                        $('.bs-example-modal-kepala-hapus').modal('hide');
                        $('#btnhapus').attr('disabled',false);
                        swal({ title: "Success!",
                            text: "Kepala Bagian Tersebut Berhasil Di Dihapus!",
                            type: "success"})
                    }if(data.error)
                    {
                        $('#btnhapus').val('Ya, Hapus!');
                        $('.bs-example-modal-kepala-hapus').modal('hide');
                        $('#btnhapus').attr('disabled',false);
                        swal({ title: "GAGAL!",
                            text: "Jangan Om!",
                            type: "error"})
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