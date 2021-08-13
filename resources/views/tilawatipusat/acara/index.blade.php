@extends('layouts.tilawatipusat_layouts.master')

@section('title') acara @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') Acara   @endslot
         @slot('title_li')    @endslot
    @endcomponent

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                    
                                    <h4 class="card-title">Daftar Acara</h4>
                                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br></p>
                                    <button onclick="tambahKriteria()" class="btn btn-sm btn-success  mr-1" style="width:130px "><i class="mdi mdi-plus"></i> tambah acara</button>
                    
                                    <blockquote class="table-responsive blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <table id="datatable-buttons" class="table table-kriteria table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary text-capitalize">
                                                <tr>
                                                    <th>judul</th>
                                                    <th>sub judul</th>
                                                    <th>tempat</th>
                                                    <th>tanggal</th>
                                                    <th>jam</th>
                                                    <th>gambar</th>
                                                    <th>peserta</th>
                                                </tr>
                                            </thead>
    
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>

                                            <tfoot class="text-primary text-capitalize">
                                                <tr>
                                                    <th>judul</th>
                                                    <th>sub judul</th>
                                                    <th>tempat</th>
                                                    <th>tanggal</th>
                                                    <th>jam</th>
                                                    <th>gambar</th>
                                                    <th>peserta</th>
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
                                        <h5 class="modal-title mt-0">Acara Baru</h5>
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
                                                            <input type="hidden" name="id" id="id" class="form-control">
                                                            <div class="row">
                                                                <div class="form-group col-xl-6 col-12">
                                                                    <label for=""><i class="text-danger">* </i>Judul</label>
                                                                    <input type="text" name="judul" id="judul" class="form-control text-capitalize" required>
                                                                </div>
                                                                <div class="form-group col-xl-6 col-12">
                                                                    <label for="">Sub Judul</label>
                                                                    <input type="text" name="subjudul" id="subjudul" class="form-control text-capitalize">
                                                                </div>
                                                                <div class="form-group col-xl-6 col-12">
                                                                    <label for=""><i class="text-danger">* </i>Tempat</label>
                                                                    <input type="text" name="tempat" id="tempat" class="form-control text-capitalize" required>
                                                                </div>
                                                                <div class="form-group col-xl-6 col-12">
                                                                    <label for=""><i class="text-danger">* </i>Tanggal</label>
                                                                    <input type="date" name="tanggal" id="tanggal" class="form-control text-capitalize" required>
                                                                </div>
                                                                <div class="form-group col-xl-6 col-12">
                                                                    <label for=""><i class="text-danger">* </i>Jam</label>
                                                                    <input type="time" name="jam" id="jam" class="form-control text-capitalize" required>
                                                                </div>
                                                                <div class="form-group col-xl-12 col-12">
                                                                    <i class="text-danger"></i><label for=""><i class="text-danger">* </i> Foto <span class="text-success">(Flyer Acara)</span></label>
                                                                        <div class="input-group" style="margin-bottom: 30px">
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input" accept="image/*" name="image" id="inputGroupFile02" id="file"/>
                                                                                <label class="custom-file-label" id="pilih_gambar" for="inputGroupFile02">Pilih File</label>
                                                                            </div>
                                                                        </div>
                                                                            <img  src="https://placehold.it/80x80" style="max-width: 100%"  id="preview" class="img-thumbnail">
                                                                </div>
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
            $('input[type="file"]').change(function(e) {
                var fileName = e.target.files[0].name;
                var len      = fileName.length;
                if (len > 20) {
                    document.getElementById("pilih_gambar").innerHTML = fileName.substring(0,20) + "...";
                } else {
                    document.getElementById("pilih_gambar").innerHTML = fileName;
                }
                $("#file").val(fileName);

                var reader = new FileReader();
                reader.onload = function(e) {   
                // get loaded data and render thumbnail.
                document.getElementById("preview").src = e.target.result;
                };
                // read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);
            });
            function tambahKriteria() {
                $('.bs-example-modal-kriteria-tambah').modal('show');
            }
            $('#tambahkriteria').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('acara.store')}}",
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
                            text: "Acara Baru Berhasil Di Tabahkan!",
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

                $('#datatable-buttons').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url:'{{ route("acara.data") }}',
                },
                columns: [
                    
                    {
                    data:'judul',
                    name:'judul'
                    },
                    {
                    data:'subjudul',
                    name:'subjudul'
                    },
                    {
                    data:'tempat',
                    name:'tempat'
                    },
                    {
                    data:'tanggal',
                    name:'tanggal'
                    },
                    {
                    data:'jam',
                    name:'jam'
                    },
                    {
                    data:'gambar',
                    name:'gambar'
                    },
                    {
                    data:'peserta',
                    name:'peserta'
                    },
                    
                ]
                });
            })
            
        </script>
@endsection