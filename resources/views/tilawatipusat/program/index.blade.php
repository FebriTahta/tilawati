@extends('layouts.tilawatipusat_layouts.master')

@section('title') program @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') program   @endslot
         @slot('title_li') program Tilawati   @endslot
    @endcomponent
                    <div class="row">
                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="cb"> 2,456 </b> program  @endslot
                                @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                    
                                    <h4 class="card-title">Data program</h4>
                                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br></p>
                                    <button class="btn btn-sm btn-success  mr-1" style="width:130px" onclick="tambahProgram()"><i class="mdi mdi-plus"></i> tambah program</button>
                    
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <table id="datatable-buttons" class="table table-program table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary" style="text-transform: capitalize">
                                                <tr>
                                                    <th>program</th>
                                                    <th>penilaian</th>
                                                    <th>option</th>
                                                </tr>
                                            </thead>
    
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>

                                            <tfoot class="text-primary" style="text-transform: capitalize">
                                                <tr>
                                                    <th>program</th>
                                                    <th>penilaian</th>
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

                    <!--modal tambah program-->
                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade bs-example-modal-program" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0">TAMBAH PROGRAM BARU</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="tambahprogram"  method="POST" enctype="multipart/form-data">@csrf
                                                            <input type="hidden" id="import_tipe" value="munaqisy">
                                                            <div class="form-group">
                                                                <label for="">Program</label>
                                                                <input type="text" class="form-control text-capitalize" name="name" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="submit" name="tambahP" id="tambahP" class="btn btn-info" value="Simpan" />
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
                        <div class="modal fade bs-example-modal-program-update" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0">UPDATE PROGRAM</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="updateprogram"  method="POST" enctype="multipart/form-data">@csrf
                                                            <input type="hidden" id="import_tipe" value="munaqisy">
                                                            <div class="form-group">
                                                                <input type="hidden" class="form-control text-capitalize" id="id" name="id" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" name="name" class="form-control" id="name" required>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <input type="submit" name="update" id="updateP" class="btn btn-warning" value="Update" />
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

                    <!--modal tambah kategori-->
                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade bs-example-modal-kategori" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0">Kategori Penilaian </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="row" id="rowbtn">
                                                        <input type="hidden" id="id" class="form-control">
                                                        <button class="col-md-5 col-5 btn btn-success text-center" onclick="pilihQuran()"
                                                        class="form-control" id="program_id">
                                                            <h5 class="text-white">Al-Qur'an</h5>
                                                        </button>
                                                        <div class="col-md-2 col-2"></div>
                                                        <button class="col-md-5 col-5 btn text-center" onclick="pilihSkill()"
                                                        style="background-color: rgb(112, 150, 255)">
                                                            <h5 class="text-white">Skill</h5>
                                                        </button>
                                                    </div>
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
                                        <h5 class="modal-title mt-0">Kategori Penilaian </h5>
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
                                                                <div class="heads text-center">
                                                                    <h5>Al-Qur'an</h5>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="hidden" class="form-control" id="quran_id" name="program_id" required>
                                                                    <input type="hidden" class="form-control" id="kategoriquran" name="kategori" value="al-qur'an" style="display: none">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Penilaian</label>
                                                                    <input type="text" style="text-transform: capitalize" class="form-control" name="name" required>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6 col-md-6 form-group">
                                                                        <label for="">Min</label>
                                                                        <input type="number"  class="form-control" name="min" required>
                                                                    </div>
                                                                    <div class="col-6 col-md-6 form-group">
                                                                        <label for="">Max</label>
                                                                        <input type="number" max="100" class="form-control" name="max" required>
                                                                    </div>
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
                        <div class="modal fade bs-example-modal-kategori-skill" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0">Kategori Penilaian </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="tambahkategori2" method="POST" enctype="multipart/form-data">@csrf
                                                            <div id="rowquran">
                                                                <div class="heads text-center">
                                                                    <h5>Skill's</h5>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="hidden" class="form-control" id="skill_id" name="program_id" required>
                                                                    <input type="hidden" class="form-control" id="kategoriquran" name="kategori" value="skill" style="display: none">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Penilaian</label>
                                                                    <input type="text" style="text-transform: capitalize" class="form-control" name="name" required>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6 col-md-6 form-group">
                                                                        <label for="">Min</label>
                                                                        <input type="number" min="10" class="form-control" name="min" placeholder="boleh kosong">
                                                                    </div>
                                                                    <div class="col-6 col-md-6 form-group">
                                                                        <label for="">Max</label>
                                                                        <input type="number" max="100" class="form-control" name="max" placeholder="boleh kosong">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="submit" name="simpan" id="btnsimpan2" class="btn btn-info" value="Simpan" />
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
                                        <h5 class="modal-title mt-0">UPDATE KATEGORI PENILAIAN </h5>
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
                                                                <label for="">Min</label>
                                                                <input type="text" id="min" name="min" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Max</label>
                                                                <input type="text" id="max" name="max" class="form-control">
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
            var id,program_id,name,min,max,kategori;

            $('#updateprogram').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.program_store')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#updateP').attr('disabled','disabled');
                    $('#updateP').val('Proses UUpdate Data');
                },
                success: function(data){
                    if(data.success)
                    {
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#updateP').val('Update');
                        $('.bs-example-modal-program-update').modal('hide');
                        $('#updateP').attr('disabled',false);
                        swal({ title: "Success!",
                            text: "Program Berhasil Di Update!",
                            type: "success"})
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

            $('#hapusprogram').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.program_delete')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#hapusP').attr('disabled','disabled');
                    $('#hapusP').val('Proses Hapus Data');
                },
                success: function(data){
                    if(data.success)
                    {
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#hapusP').val('Ya, Hapus!');
                        $('.bs-example-modal-program-hapus').modal('hide');
                        $('#hapusP').attr('disabled',false);
                        swal({ title: "Success!",
                            text: "Program Berhasil Di Hapus!",
                            type: "success"})
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

            $('#tambahprogram').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.program_store')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#tambahP').attr('disabled','disabled');
                    $('#tambahP').val('Proses Simpan Data');
                },
                success: function(data){
                    if(data.success)
                    {
                        $("#tambahprogram")[0].reset();
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#tambahP').val('Simpan');
                        $('.bs-example-modal-program').modal('hide');
                        $('#tambahP').attr('disabled',false);
                        swal({ title: "Success!",
                            text: "Program Baru Berhasil Di Simpan!",
                            type: "success"})
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

            function tambahProgram(){
                $('.bs-example-modal-program').modal('show');
            }
            $('.bs-example-modal-program-hapus').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
            })
            $('.bs-example-modal-program-update').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                id = button.data('id')
                name = button.data('name')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
            })
            $('.bs-example-modal-kategori').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
            })
            $('.bs-example-modal-penilaian-update').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                id = button.data('id')
                program_id = button.data('program_id');
                name = button.data('name');
                min = button.data('min');
                max = button.data('max');
                kategori = button.data('kategori');
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
                modal.find('.modal-body #program_id').val(program_id);
                modal.find('.modal-body #min').val(min);
                modal.find('.modal-body #max').val(max);
                modal.find('.modal-body #kategori').val(kategori);
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
                url: "{{ route('diklat.penilaian_delete')}}",
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
            
            function pilihQuran(){
                $('.bs-example-modal-kategori').modal('hide');
                $('.bs-example-modal-kategori-quran').modal('show');
                document.getElementById('quran_id').value=id;
            }

            function pilihSkill() {
                $('.bs-example-modal-kategori').modal('hide');
                $('.bs-example-modal-kategori-skill').modal('show');
                document.getElementById('skill_id').value=id;
            }

            $('#update-penilaian').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.penilaian_store')}}",
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
                url: "{{ route('diklat.penilaian_store')}}",
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
                            text: "Penilaian Baru Berhasil Ditambahkan!",
                            type: "success"})
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

            $('#tambahkategori2').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.penilaian_store')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnsimpan2').attr('disabled','disabled');
                    $('#btnsimpan2').val('Proses Menyimpan Data');
                },
                success: function(data){
                    if(data.success)
                    {
                        //sweetalert and redirect
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $("#tambahkategori2")[0].reset();
                        toastr.success(data.success);
                        $('#btnsimpan2').val('Buat Baru');
                        $('.bs-example-modal-kategori-skill').modal('hide');
                        $('#btnsimpan2').attr('disabled',false);
                        swal({ title: "Success!",
                            text: "Penilaian Baru Berhasil Ditambahkan!",
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
                
                $.ajax({
                    url:'{{ route("diklat.program_tot") }}',
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
                    url:'{{ route("diklat.program_data") }}',
                },
                columns: [
                    
                    {
                    data:'name',
                    name:'name'
                    },
                    {
                    data:'penilaian',
                    name:'penilaian.name'
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