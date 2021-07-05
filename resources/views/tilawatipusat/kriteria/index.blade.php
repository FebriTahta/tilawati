@extends('layouts.tilawatipusat_layouts.master')

@section('title') kriteria @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') kriteria   @endslot
         @slot('title_li') Syahadah   @endslot
    @endcomponent
                    <div class="row">
                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="cb"> 2,456 </b> Kriteria Syahadah @endslot
                                @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                    
                                    <h4 class="card-title">Data kriteria</h4>
                                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br></p>
                                    <button onclick="tambahKriteria()" class="btn btn-sm btn-success  mr-1" style="width:130px "><i class="mdi mdi-plus"></i> tambah kriteria</button>
                    
                                    <blockquote class="table-responsive blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <table id="datatable-buttons" class="table table-kriteria table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary text-capitalize">
                                                <tr>
                                                    <th>kriteria</th>
                                                    <th>untuk</th>
                                                    <th>program</th>
                                                    <th>option</th>
                                                </tr>
                                            </thead>
    
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>

                                            <tfoot class="text-primary text-capitalize">
                                                <tr>
                                                    <th>kriteria</th>
                                                    <th>untuk</th>
                                                    <th>program</th>
                                                    <th>option</th>
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

                    <!--modal import kriteria-->
                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade bs-example-modal-kriteria-update" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0">UPDATE KRITERIA</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="updatekriteria"  method="POST" enctype="multipart/form-data">@csrf
                                                            
                                                            <div class="form-group">
                                                                <label for="">Kriteria</label>
                                                                <input type="text" name="name" id="name" class="form-control text-capitalize" required>
                                                                <input type="hidden" name="id" id="id" class="form-control">
                                                            </div>
                                                            <div class="form-group"> 
                                                                <select name="untuk" id="untuks" class="form-control text-capitalize" required>
                                                                    <option value="guru">Guru</option>
                                                                    <option value="santri">Santri</option>
                                                                    <option value="instruktur">instruktur</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="submit" name="update" id="btnupdate" class="btn btn-info" value="Update" />
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
                        <div class="modal fade bs-example-modal-kriteria-tambah" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0">TAMBAH KRITERIA SYAHADAH</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="tambahkriteria"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group">
                                                                <label for="">Kriteria</label>
                                                                <input type="text" name="name" id="name" class="form-control text-capitalize" required>
                                                                <input type="hidden" name="id" id="id" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <select name="program_id" id="" class="form-control">
                                                                    @foreach ($pro as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group"> 
                                                                <select name="untuk" class="form-control text-capitalize" id="untuk">
                                                                    <option value="guru">Guru</option>
                                                                    <option value="santri">Santri</option>
                                                                    <option value="instruktur">instruktur</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="submit" name="tambah" id="btntambah" class="btn btn-info" value="Tambah" />
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

                    <!--modal import kriteria hapus-->
                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade bs-example-modal-kriteria-hapus" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="hapuskriteria"  method="POST" enctype="multipart/form-data">@csrf
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
            function tambahKriteria() {
                $('.bs-example-modal-kriteria-tambah').modal('show');
            }
            $('#tambahkriteria').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.kriteria_store')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btntambah').attr('disabled','disabled');
                    $('#btntambah').val('Proses Menyimpan Data');
                    
                },
                success: function(data){
                    if(data.success)
                    {
                        $("#tambahkriteria")[0].reset();
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btntambah').val('Simpan');
                        $('.bs-example-modal-kriteria-tambah').modal('hide');
                        $('#btntambah').attr('disabled',false);
                        swal({ title: "Success!",
                            text: "Kriteria Baru Berhasil Di Tabahkan!",
                            type: "success"})
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

            $('#hapuskriteria').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.kriteria_delete')}}",
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
                        $('.bs-example-modal-kriteria-hapus').modal('hide');
                        $('#btnhapus').attr('disabled',false);
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

            $('#updatekriteria').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.kriteria_store')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnupdate').attr('disabled','disabled');
                    $('#btnupdate').val('Proses Update Data');
                },
                success: function(data){
                    if(data.success)
                    {
                        //sweetalert and redirect
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btnupdate').val('update');
                        $('.bs-example-modal-kriteria-update').modal('hide');
                        $('#btnupdate').attr('disabled',false);
                        swal({ title: "Success!",
                            text: "Kriteria Berhasil Di Update!",
                            type: "success"})
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

             $('.bs-example-modal-kriteria-update').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                id = button.data('id')
                name = button.data('name')
                untuk = button.data('untuk')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
                modal.find('.modal-body #untuks option:selected').text(untuk);
                
            })

            $('.bs-example-modal-kriteria-hapus').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
            })
            $(document).ready(function(){
                
                $.ajax({
                    url:'{{ route("diklat.kriteria_tot") }}',
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
                    url:'{{ route("diklat.kriteria_data") }}',
                },
                columns: [
                    
                    {
                    data:'name',
                    name:'name'
                    },
                    {
                    data:'untuk',
                    name:'untuk'
                    },
                    {
                    data:'program',
                    name:'program.name'
                    },
                    {
                    data:'option',
                    name:'option'
                    },
                    
                ]
                });
            })
            
        </script>
@endsection