@extends('layouts.tilawatipusat_layouts.master')

@section('title')
    diklat
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="{{ URL::asset('tilawatipusat/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('tilawatipusat/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('tilawatipusat/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('tilawatipusat/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @component('common-tilawatipusat.breadcrumb')
        @slot('title')
            User
        @endslot
        @slot('title_li')
            TILAWATI
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Data User</h4>
                    <div class="card-title-desc">
                        <form action="/reset-password" method="POST">@csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger  mr-1 mb-1"><i
                                    class="fa fa-info"></i> Reset Username & Password</button><br>
                                    <code>Jangan di tekan apabila tidak ingin seluruh data username dan password cabang berubah</code>
                        </form>
                    </div>
                    <hr>
                    
                    <form id="formadd">@csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Cabang yang belum memiliki hak akses</label>
                                    <select name="cabang_id" class="form-control" id="cabang_id">
                                        @if ($cabang_tanpa_user->count() > 0)
                                            @foreach ($cabang_tanpa_user as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @else
                                            <option value="">Kosong</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" id="username" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="pass" id="pass" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>-</label>
                                <input type="submit" id="btnadd" class="btn btn-primary" style="width: 100%" value="BUAT USER BARU">
                            </div>
                        </div>
                    </form>
                    
                    
                    <hr>
                    <form action="/export-user" method="POST">@csrf
                        <button class="btn btn-sm btn-outline-success  mr-1 mb-1" style="width:130px " type="submit"><i
                                class="fa fa-print"></i> Export</button>
                    </form>

                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                        <table id="datatable-buttons" class="table table-diklat table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead class="text-bold text-primary" style="text-transform: capitalize; font-size: 12px">
                                <tr>
                                    <th>kota</th>
                                    <th>username</th>
                                    <th>pass</th>
                                    <th>cabang</th>
                                    <th>opsi</th>
                                </tr>
                            </thead>

                            <tbody style="font-size: 10px">
                            </tbody>

                            <tfoot class="text-primary" style="text-transform: capitalize; font-size: 12px">
                                <tr>
                                    <th>kota</th>
                                    <th>username</th>
                                    <th>pass</th>
                                    <th>cabang</th>
                                    <th>opsi</th>
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

    <div class="modal fade bs-example-modal-diklat-edit" id="modal-edit" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-xl-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <form id="ubahpassform" method="POST">@csrf
                                    <div class="row">
                                        <div class="form-group col-xl-6">
                                            <label for="username">username</label>
                                            <input type="hidden" id="id" class="form-control" name="id">
                                            <input type="text" id="username" class="form-control" name="username">
                                        </div>
                                        <div class="form-group col-xl-6">
                                            <label for="pass">password</label>
                                            <input type="text" id="pass" class="form-control" name="pass">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="form-group col-xl-6">
                                            <input type="submit" id="btnedit" class="btn btn-sm btn-outline-danger" value="Update User">
                                        </div>
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
    <!-- Script Select2-->
    <script src="{{ URL::asset('/tilawatipusat/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/tilawatipusat/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/tilawatipusat/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ URL::asset('/tilawatipusat/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ URL::asset('/tilawatipusat/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    <!-- form advanced init -->
    <script src="{{ URL::asset('/tilawatipusat/js/pages/form-advanced.init.js') }}"></script>

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
        $('#modal-edit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var username = button.data('username')
            var pass = button.data('pass')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #username').val(username);
            modal.find('.modal-body #pass').val(pass);

        });

        $('#ubahpassform').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('ganti_pass') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnedit').attr('disabled', 'disabled');
                    $('#btnedit').val('Proses Menyimpan Perubahan Data');

                },
                success: function(data) {
                    if (data.success) {
                        toastr.success(data.success);
                        $("#ubahpassform")[0].reset();
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btnedit').val('Submit!');
                        $('#modal-edit').modal('hide');
                        $('#btnedit').attr('disabled', false);
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
            $('#datatable-buttons').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/data-pengguna',
                },
                columns: [{
                        data: 'kota',
                        name: 'kabupaten.nama'
                    },
                    {
                        data: 'username',
                        name: 'user.username'
                    },
                    {
                        data: 'pass',
                        name: 'user.pass'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'opsi',
                        name: 'opsi'
                    },
                ]
            });
        })

        $('#formadd').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "/buat-user-baru",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#btnadd').attr('disabled', 'disabled');
                        $('#btnadd').val('Process...');
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            $("#formadd")[0].reset();
                            $('#btnadd').val('BUAT USER BARU');
                            $('#btnadd').attr('disabled', false);
                            toastr.success(response.message);
                            swal({
                                title: "SUCCESS!",
                                text: response.message,
                                type: "success"
                            }).then(okay => {
                                if (okay) {
                                    window.location.href = "/daftar-pengguna";
                                }
                            });
                        } else {

                            $('#btnadd').val('BUAT USER BARU!');
                            $('#btnadd').attr('disabled', false);

                            var values = '';
                            jQuery.each(response.message, function (key, value) {
                                values += '<p>'+ value +'</p>'
                            });
                            swal({
                                title : "Maaf",
                                html : values,
                                type : "error",
                            });
                            
                            toastr.error(values);
                            // $('#errList').html("");
                            // $('#errList').addClass('alert alert-danger');
                            // $.each(response.errors, function(key, err_values) {
                            //     $('#errList').append('<div>' + err_values + '</div>');
                            // });
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
    </script>
@endsection
