@extends('layouts.tilawatipusat_layouts.master')

@section('title') Persyaratan @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') Persyaratan   @endslot
         @slot('title_li') Registrasi   @endslot
    @endcomponent
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                    
                                    <h4 class="card-title">Data persyaratan</h4>
                                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br></p>
                    
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <table id="datatable-buttons" class="table table-program table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary" style="text-transform: capitalize">
                                                <tr>
                                                    <th>program</th>
                                                    <th>Persyaratan</th>
                                                    <th>option</th>
                                                </tr>
                                            </thead>
    
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>

                                            <tfoot class="text-primary" style="text-transform: capitalize">
                                                <tr>
                                                    <th>program</th>
                                                    <th>Persyaratan</th>
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

                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade bs-example-modal-program-hapus" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="hapusprogram"  method="POST" enctype="multipart/form-data">@csrf
                                                            <input type="hidden" id="import_tipe" value="munaqisy">
                                                            <div class="form-group text-center">
                                                                <h5>Anda yakin akan menghapus Program tersebut ?</h5>
                                                                <input type="hidden" class="form-control text-capitalize" id="id" name="id" required>
                                                            </div>
                                                            <div class="row" style="text-align: center">
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <input type="submit" name="hapus" id="hapusP" class="btn btn-danger" value="Ya, Hapus!" />
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
                        <div class="modal fade bs-example-modal-kategori-quran" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0">File Persyaratan Registrasi </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="tambahkategori" method="POST" enctype="multipart/form-data">@csrf
                                                            <div id="rowquran">
                                                                <div class="form-group">
                                                                    <label for="">Persyaratan</label>
                                                                    <input type="hidden" name="program_id" class="form-control" id="program_id" required>
                                                                    <input type="text" style="text-transform: capitalize" class="form-control" name="name" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Jenis File</label>
                                                                    <select name="jenis" class="form-control" id="" required>
                                                                        <option value="">*</option>
                                                                        <option value="image/*">Gambar - Foto - Image</option>
                                                                        <option value=".doc,.pdf">Dokumen - doc - pdf</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="submit" name="simpan" id="btnsimpan" class="btn btn-info" value="Simpan" />
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
                        <div class="modal fade bs-example-modal-penilaian-update" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0">UPDATE PERSYARATAN</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="update-penilaian"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group">
                                                                <input type="hidden" id="id" name="id" class="form-control">
                                                                <input type="hidden" id="program_id" name="program_id" class="form-control">
                                                                <input type="hidden" id="kategori" name="kategori" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Penilaian</label>
                                                                <input type="text" id="name" name="name" class="form-control text-capitalize">
                                                            </div>
                                                            <div class="form-group">
                                                                <select name="jenis" class="form-control" id="jenis" required>
                                                                    <option value="">*</option>
                                                                    <option value="image/*">Gambar - Foto - Image</option>
                                                                    <option value=".doc,.pdf">Dokumen - doc - pdf</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="submit" name="simpan" id="btnupdatenilai" class="btn btn-info" value="Update" />
                                                                <input type="button" onclick="hapusNilai()" name="hapus" id="btnhapusnilai" class="btn btn-danger" value="Hapus" />
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
                        <div class="modal fade bs-example-modal-penilaian-hapus" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="hapus-penilaian"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group">
                                                                <input type="hidden" id="nilai_id" name="id" class="form-control">
                                                            </div>
                                                            <div class="row" style="text-align: center">
                                                                <div class="form-group col-12 col-xl-12 text-center">
                                                                    <h5>Anda yakin akan menghapus data tersebut ?</h5>
                                                                </div>
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <input type="submit" name="hapus" id="hapusnilai" class="btn btn-danger" value="Ya, Hapus!" />
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
            //inisialisasi variable penilaian
            
            $('.bs-example-modal-kategori-quran').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #program_id').val(id);
            })

            $('.bs-example-modal-penilaian-update').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                id = button.data('id')
                program_id = button.data('program_id');
                name = button.data('name');
                jenis = button.data('jenis');
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
                modal.find('.modal-body #jenis').val(jenis);
                modal.find('.modal-body #program_id').val(program_id);
                
            })
            function hapusNilai(){
                $('.bs-example-modal-penilaian-update').modal('hide');
                $('.bs-example-modal-penilaian-hapus').modal('show');
                document.getElementById('nilai_id').value=id;
                $('#hapus-penilaian').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.syarat.delete')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#hapusnilai').attr('disabled','disabled');
                    $('#hapusnilai').val('Proses Menghapus Data');
                },
                success: function(data){
                    if(data.success)
                    {
                        //sweetalert and redirect
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('.bs-example-modal-penilaian-hapus').modal('hide');
                        $('#hapusnilai').attr('disabled',false);
                        $('#hapusnilai').val('Ya, Hapus!');
                        swal({ title: "Success!",
                            text: "Penilaian Tersebut Berhasil Di Hapus!",
                            type: "success"})
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });
            }
            

            $('#update-penilaian').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.syarat.submit')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnupdatenilai').attr('disabled','disabled');
                    $('#btnupdatenilai').val('Proses Update Data');
                },
                success: function(data){
                    if(data.success)
                    {
                        //sweetalert and redirect
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        toastr.success(data.success);
                        $('#btnupdatenilai').val('Update');
                        $('.bs-example-modal-penilaian-update').modal('hide');
                        $('#btnupdatenilai').attr('disabled',false);
                        swal({ title: "Success!",
                            text: "Penilaian Baru Berhasil Di Update!",
                            type: "success"})
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

            $('#tambahkategori').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.syarat.submit')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnsimpan').attr('disabled','disabled');
                    $('#btnsimpan').val('Proses Menyimpan Data');
                },
                success: function(data){
                    if(data.success)
                    {
                        //sweetalert and redirect
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $("#tambahkategori")[0].reset();
                        toastr.success(data.success);
                        $('#btnsimpan').val('Buat Baru');
                        $('.bs-example-modal-kategori-quran').modal('hide');
                        $('#btnsimpan').attr('disabled',false);
                        swal({ title: "Success!",
                            text: "Persyaratan Baru Berhasil Ditambahkan!",
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

                $('#datatable-buttons').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url:'{{ route("diklat.syarat.data") }}',
                },
                columns: [
                    
                    {
                    data:'name',
                    name:'name'
                    },
                    {
                    data:'registrasi',
                    name:'registrasi.name'
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