@extends('layouts.tilawatipusat_layouts.master')

@section('title') Cabang @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
        @slot('title') KPA @endslot
        @slot('title_li') - @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title text-uppercase">Data KPA Cabang {{ substr($cabang->kabupaten->nama, 5) }}</h4>
                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br></p>
                    <button class="btn btn-sm btn-success mb-2 mr-1 text-uppercase" style="width:130px; font-size: 12px "
                        data-toggle="modal" data-target="#modal-add"><i class="mdi mdi-plus"></i> TAMBAH
                        KPA</button>

                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                        <table id="tabel-trainer" class="table table-cabang table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead class="text-bold text-primary" style="text-transform: uppercase; font-size: 10px">
                                <tr>
                                    <th>Nama</th>
                                    <th>Ketua</th>
                                    <th>Wilayah</th>
                                    <th>Wa / Telp</th>
                                    <th>...</th>
                                </tr>
                            </thead>

                            <tbody style="font-size: 10px">
                            </tbody>

                            <tfoot class="text-bold text-primary" style="text-transform: uppercase; font-size: 10px">
                                <tr>
                                    <th>Nama</th>
                                    <th>Ketua</th>
                                    <th>Wilayah</th>
                                    <th>Wa / Telp</th>
                                    <th>...</th>
                                </tr>
                            </tfoot>
                        </table>
                        <footer class="blockquote-footer">Updated at <cite title="Source Title">2021</cite></footer>
                    </blockquote>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    {{-- MODAL --}}
    <div class="modal fade bs-example-modal-trainer-edit" id="modal-add" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Data Trainer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <form id="trainer_store" class="text-capitalize" method="POST"
                                    enctype="multipart/form-data">@csrf
                                    <div class="row">
                                        <input type="hidden" name="id" id="id">
                                        <div class="col-md-6 col-12 form-group">
                                            <label for="">Nama KPA</label>
                                            <input type="text" id="name" name="name" class="form-control text-capitalize"
                                                required>
                                        </div>
                                        <div class="col-md-6 col-12 form-group">
                                            <label for="">Ketua KPA</label>
                                            <input type="text" id="ketua" name="ketua" class="form-control text-capitalize"
                                                required>
                                        </div>
                                        <div class="col-md-6 col-12 form-group">
                                            <label for="">Wilayah</label>
                                            <textarea name="wilayah" id="wilayah" class="form-control" id="" cols="3"
                                                rows="3"></textarea>
                                        </div>
                                        <div class="col-md-6 col-12 form-group">
                                            <label for="">WA / Telp</label>
                                            <input type="number" id="telp" name="telp" class="form-control" required>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group text-right">
                                        <input type="submit" id="z" class="btn btn-outline-primary" value="Submit!">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="modal_hapus" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-xl-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <form id="hapustrainer" method="POST" enctype="multipart/form-data">@csrf
                                        <div class="form-group text-center">
                                            <h5>Anda yakin akan menghapus Trainer tersebut ?</h5>
                                            <input type="hidden" class="form-control text-capitalize" id="id" name="id"
                                                required>
                                        </div>
                                        <div class="row" style="text-align: center">
                                            <div class="form-group col-6 col-xl-6">
                                                <input type="submit" name="hapus" id="btnhapus" class="btn btn-danger"
                                                    value="Ya, Hapus!" />
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



@endsection

@section('script')

    <!-- Toast -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Required datatable js -->
    <script src="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/pdfmake/pdfmake.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ URL::asset('tilawatipusat/js/pages/datatables.init.js') }}"></script>

    <script>
        $('#trainer_store').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('store.kpa.cabang') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#z').attr('disabled', 'disabled');
                    $('#z').val('Proses Menyimpan Data');
                },
                success: function(data) {
                    if (data.success) {
                        //sweetalert and redirect
                        $("#trainer_store")[0].reset();
                        toastr.success(data.success);
                        $('#modal-add').modal('hide');
                        $('#z').val('Submit');
                        $('#z').attr('disabled', false);
                        var oTable = $('#tabel-trainer').dataTable();
                        oTable.fnDraw(false);
                        // swal({
                        //     title: "Success!",
                        //     text: "Trainer Baru Berhasil Ditambahkan!",
                        //     type: "success"
                        // })
                    }
                    if (data.error) {
                        $('#message').html('<div class="alert alert-danger">' + data.error + '</div>');
                        $('#z').attr('disabled', false);
                        $('#z').val('Submit!');
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('#hapustrainer').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('delete.kpa.cabang') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnhapus').attr('disabled', 'disabled');
                    $('#btnhapus').val('Proses Hapus Data');
                },
                success: function(data) {
                    if (data.success) {
                        //sweetalert and redirect
                        var oTable = $('#tabel-trainer').dataTable();
                        oTable.fnDraw(false);
                        $('#btnhapus').val('Ya, Hapus!');
                        $('#modal_hapus').modal('hide');
                        $('#btnhapus').attr('disabled', false);
                        toastr.success(data.success);
                        // swal({
                        //     title: "Success!",
                        //     text: "Diklat Berhasil Di Dihapus!",
                        //     type: "success"
                        // })
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('#modal_hapus').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        })
        $('#modal-add').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var telp = button.data('telp')
            var ketua = button.data('ketua')
            var wilayah = button.data('wilayah')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #wilayah').val(wilayah);
            modal.find('.modal-body #telp').val(telp);
            modal.find('.modal-body #ketua').val(ketua);
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#tabel-trainer').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('data.kpa.cabang') }}',
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'ketua',
                        name: 'ketua'
                    },
                    {
                        data: 'wilayah',
                        name: 'wilayah'
                    },
                    {
                        data: 'telp',
                        name: 'telp'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },

                ]
            });
        });
    </script>
@endsection
