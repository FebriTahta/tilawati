@extends('layouts.tilawatipusat_layouts.master')

@section('title')
    Cabang
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    
@endsection
@section('content')
    @component('common-tilawatipusat.breadcrumb')
        @slot('title')
            Munaqisy
        @endslot
        @slot('title_li')
            {{ substr($cabang->kabupaten->nama, 5) }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title text-uppercase">Data Munaqisy Cabang {{ substr($cabang->kabupaten->nama, 5) }}
                    </h4>
                    <p class="card-title-desc">Ter-update berdasarkan Tahun {{date('Y')}} </br></p>
                    <button class="btn btn-sm btn-outline-info mb-2 mr-1 text-uppercase" style="font-size: 12px "
                    data-toggle="modal" data-target="#modal-add"><i class="mdi mdi-plus"></i> Tambah
                    Munaqisy</button>
                    <a href="/export-template-munaqisy" class="btn btn-sm btn-outline-primary mb-2 mr-1 text-uppercase"
                        style="font-size: 12px "><i class="mdi mdi-download"></i> Template Munaqisy</a>

                    <button class="btn btn-sm btn-outline-success mb-2 mr-1 text-uppercase" style="font-size: 12px "
                        data-toggle="modal" data-target="#modal_import"><i class="mdi mdi-import"></i> Import
                        Munaqisy</button>

                    <a href="/export-template-munaqisy-data/{{ $cabang->id }}"
                        class="btn btn-sm btn-outline-warning mb-2 mr-1 text-uppercase" style="font-size: 12px "><i
                            class="mdi mdi-download"></i> Unduh Data Munaqisy</a>

                            {{-- <a href="/hapus/data/munaqisy/{{$cabang->id}}"
                                class="btn btn-sm btn-outline-danger mb-2 mr-1 text-uppercase" style="font-size: 12px "><i
                                    class="fa fa-trash"></i> Bersihkan Data Munaqisy</a> --}}
                    
                    {{-- <a href="/hapus/data/munaqisy/{{$cabang->id}}" type="button">lol</a> --}}


                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                        <table id="tabel-trainer" class="table table-cabang table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead class="text-bold text-primary" style="text-transform: uppercase; font-size: 12px">
                                <tr>
                                    <th>Nama</th>
                                    <th>Wa / Telp</th>
                                    <th>Alamat</th>
                                    <th>...</th>
                                </tr>
                            </thead>

                            <tbody style="font-size: 12px">
                            </tbody>

                            <tfoot class="text-bold text-primary" style="text-transform: uppercase; font-size: 12px">
                                <tr>
                                    <th>Nama</th>
                                    <th>Wa / Telp</th>
                                    <th>Alamat</th>
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
    <div class="modal fade bs-example-modal-trainer-cabang" id="modal_import" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">IMPORT DATA MUNAQISY </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <form id="importtrainer" method="POST" enctype="multipart/form-data">@csrf
                                        <input type="hidden" id="import_tipe" value="munaqisy">
                                        <div class="form-group">
                                            <label for="">Import Data "Munaqisy" (hanya Format Excel sesuai Template
                                                .xlsx)</label><br>
                                            <code>Import ulang akan menghapus data lama dan menggantinya dengan data yang baru.</code>
                                            <input type="file" class="form-control" name="file"
                                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="import" id="btnimport" class="btn btn-info"
                                                value="Import" />
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

    <div class="modal fade bs-example-modal-trainer-edit" id="modal-add" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Data Munaqisy</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <form id="trainer_store" class=" " method="POST"
                                    enctype="multipart/form-data">@csrf
                                    <div class="row">
                                        <input type="hidden" name="id" id="id">
                                        <div class="col-md-6 col-12 form-group">
                                            <label for="">Nama</label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                required>
                                        </div>
                                        <div class="col-md-6 col-12 form-group">
                                            <label for="">WA / Telp</label>
                                            <input type="number" id="telp" name="telp" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 col-12 form-group">
                                            <label for="">Alamat</label>
                                            <textarea name="alamat" id="alamat" class="form-control" id="" cols="3"
                                                rows="3"></textarea>
                                        </div>
                                        <div class="col-md-6 col-12 form-group">
                                            <label for="">STATUS</label>
                                            <input type="text" id="stats" name="stats" value="Munaqisy" class="form-control" readonly>
                                        </div>
                                        {{-- <div class="col-md-12 col-12 form-group " style="margin-bottom: 10px"
                                            id="dynamic_field">
                                            <label for=""><button type="button" class="btn btn-outline-primary btn-sm"
                                                    name="add" id="add"><i class="fa fa-plus"></i></button>
                                                Trainer</label>
                                            <select name="trainer" id="trainer" class="form-control" required>
                                                <option value="Instruktur Strategi">Instruktur Strategi</option>
                                                <option value="Instruktur Lagu">Instruktur Lagu</option>
                                                <option value="Instruktur Strategi & Lagu">Instruktur Strategi & Lagu
                                                </option>
                                                <option value="Munaqisy">Munaqisy</option>
                                                <option value="Supervisor">Supervisor</option>
                                            </select>
                                        </div> --}}
                                    </div>
                                    <hr>
                                    {{-- @php
                                         $macam = App\Models\Macamtrainer::all();
                                    @endphp
                                        <h5 class="border-bottom">ISI "Ok" SESUAI STATUS MUNAQISY</h5>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    @foreach ($macam as $key => $items)
                                                        <div class="col-md-6 col-12 form-group">
                                                            <label for="">{{ $items->jenis }}</label>
                                                            <input type="text" id=""
                                                                name="macamtrainer_id[{{ $key + 1 }}]"
                                                                class="form-control">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div> --}}
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
                                            <h5>Anda yakin akan menghapus Munaqisy tersebut ?</h5>
                                            <input type="hidden" class="form-control  " id="id" name="id"
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
        var i;
        $('#add').click(function() {
            i++;
            $('#dynamic_field').append('<tr class="col-xl-12" id="row' + i +
                '" class="dynamic-added"><td>' +
                '<label for="" style="margin-top:10px"><button type="button" name="remove" id="' + i +
                '" class="btn btn-sm btn-danger btn_remove"> <i class="fa fa-minus"></i></button> Trainer</label>' +
                '<select name="trainer" class="form-control mb-10" required>' +
                '<option value="Instruktur Strategi">Instruktur Strategi</option>' +
                '<option value="Instruktur Lagu">Instruktur Lagu</option>' +
                '<option value="Instruktur Strategi & Lagu">Instruktur Strategi & Lagu</option>' +
                '<option value="Munaqisy">Munaqisy</option>' +
                '<option value="Supervisor">Supervisor</option>' +
                '</select>' +
                '</td><td></td></tr>');
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
            console.log(button_id);
        });
        $('#trainer_store').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/store-munaqisy-cabang",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#z').attr('disabled', 'disabled');
                    $('#z').val('Proses Menyimpan Data');
                },
                success: function(data) {
                    if (data.status == 200) {
                        //sweetalert and redirect
                        $("#trainer_store")[0].reset();
                        toastr.success(data.message);
                        $('#modal-add').modal('hide');
                        $('#z').val('Submit');
                        $('#z').attr('disabled', false);
                        var oTable = $('#tabel-trainer').dataTable();
                        oTable.fnDraw(false);
                        swal({
                            title: "Success!",
                            text: data.message,
                            type: "success"
                        })
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
                url: "/remove-munaqisy-cabang",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnhapus').attr('disabled', 'disabled');
                    $('#btnhapus').val('Proses Hapus Data');
                },
                success: function(data) {
                    if (data.status == 200) {
                        //sweetalert and redirect
                        var oTable = $('#tabel-trainer').dataTable();
                        oTable.fnDraw(false);
                        $('#btnhapus').val('Ya, Hapus!');
                        $('#modal_hapus').modal('hide');
                        $('#btnhapus').attr('disabled', false);
                        toastr.success(data.message);
                        swal({
                            title: "Success!",
                            text: data.message,
                            type: "success"
                        })
                    }else{
                        toastr.danger(data.success);
                        swal({
                            title: "Maaf",
                            text: "Your data is " + data.message,
                            type: "error"
                        })
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('#importtrainer').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('import.munaqisy') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnimport').attr('disabled', 'disabled');
                    $('#btnimport').val('Importing Process');
                },
                success: function(data) {
                    if (data.success) {
                        //sweetalert and refresh datatable
                        $("#importtrainer")[0].reset();
                        toastr.success(data.success);
                        var oTable = $('#tabel-trainer').dataTable();
                        oTable.fnDraw(false);
                        $('#btnimport').val('Import');
                        $('#btnimport').attr('disabled', false);
                        $('.bs-example-modal-trainer-cabang').modal('hide');
                        // swal("Done!", data.message, "success");
                    }
                    if (data.error) {
                        $('#message').html('<div class="alert alert-danger">' + data.error + '</div>');
                        $('#btnimport').attr('disabled', false);
                        $('#btnimport').val('Import');
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
            var alamat = button.data('alamat')
            // var trainer = button.data('trainer')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #alamat').val(alamat);
            modal.find('.modal-body #telp').val(telp);
            // modal.find('.modal-body #trainer').val(trainer);
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
                    url: '{{ route('list.munaqisy.cabang') }}',
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    
                    {
                        data: 'telp',
                        name: 'telp'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
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
