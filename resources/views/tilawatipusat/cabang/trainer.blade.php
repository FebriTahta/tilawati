@extends('layouts.tilawatipusat_layouts.master')

@section('title') Cabang @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
        @slot('title') Trainer @endslot
        @slot('title_li') {{ substr($cabang->kabupaten->nama, 5) }} @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Data Cabang</h4>
                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br></p>
                    <button class="btn btn-sm btn-success mb-2 mr-1 text-uppercase" style="width:130px; font-size: 12px "
                        data-toggle="modal" data-target="#modal-add"><i class="mdi mdi-plus"></i> Add
                        Trainer</button>

                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                        <table id="tabel-trainer" class="table table-cabang table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead class="text-bold text-primary" style="text-transform: uppercase; font-size: 10px">
                                <tr>
                                    <th>Nama</th>
                                    <th>Trainer</th>
                                    <th>Status</th>
                                    <th>Wa / Telp</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>

                            <tbody style="font-size: 10px">
                            </tbody>

                            <tfoot class="text-bold text-primary" style="text-transform: uppercase; font-size: 10px">
                                <tr>
                                    <th>Nama</th>
                                    <th>Trainer</th>
                                    <th>Status</th>
                                    <th>Wa / Telp</th>
                                    <th>Alamat</th>
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
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Daftarkan Trainer Baru</h5>
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
                                        <div class="col-md-6 col-12 form-group">
                                            <label for="">Nama</label>
                                            <input type="text" id="nama" name="name" class="form-control text-capitalize"
                                                required>
                                        </div>
                                        <div class="col-md-6 col-12 form-group">
                                            <label for="">Trainer</label>
                                            <select name="trainer" class="form-control" required>
                                                <option value="Instruktur Strategi">Instruktur Strategi</option>
                                                <option value="Instruktur Lagu">Instruktur Lagu</option>
                                                <option value="Instruktur Strategi & Lagu">Instruktur Strategi & Lagu
                                                </option>
                                                <option value="Munaqisy">Munaqisy</option>
                                                <option value="Supervisor">Supervisor</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-12 form-group">
                                            <label for="">WA / Telp</label>
                                            <input type="number" name="telp" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 col-12 form-group">
                                            <label for="">Alamat</label>
                                            <textarea name="alamat" class="form-control" id="" cols="3"
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group text-right">
                                        <input type="submit" id="z" class="btn btn-outline-primary" value="Add!">
                                    </div>
                                </form>
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
                url: "{{ route('store.trainer.cabang') }}",
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
                        $('#z').val('Update');
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
                        $('#z').val('Add!');
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#tabel-trainer').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('list.trainer.cabang') }}',
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'trainer',
                        name: 'trainer'
                    },
                    {
                        data: 'stats',
                        name: 'stats'
                    },
                    {
                        data: 'telp',
                        name: 'telp'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    }

                ]
            });
        });
    </script>
@endsection
