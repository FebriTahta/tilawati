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
    <link href="{{ URL::asset('tilawatipusat/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('tilawatipusat/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @component('common-tilawatipusat.breadcrumb')
        @slot('title')
            diklat
        @endslot
        @slot('title_li')
            TILAWATI
        @endslot
    @endcomponent
    {{-- <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="row p-3">
                    <div class="col-12 col-xl-12 form-group" style="text-transform: uppercase">
                        Cari data <b>syahadah</b> berdasarkan <b>tanggal diterbitkannya syahadah</b>
                        <hr>
                    </div>
                    <div class="col-6 col-xl-4 form-group">
                        <label>Dari :</label>
                        <input type="date" name="dari" id="dari" class="form-control">
                        <span class="red dari" style="color: red"></span>
                    </div>
                    <div class="col-6 col-xl-4 form-group">
                        <label>Sampai :</label>
                        <input type="date" name="sampai" id="sampai" class="form-control">
                        <span class="red sampai" style="color: red"></span>
                    </div>
                    <div class="form-group col-6 col-xl-2">
                        <label for="">Cari :</label>
                        <button class="btn btn-rounded form-control text-white" style="background-color: rgb(137, 137, 253)"
                            name="filter" id="filter"> <i class="fa fa-search"></i></button>
                    </div>
                    <div class="form-group col-6 col-xl-2">
                        <label for="">Reset :</label>
                        <button class="btn btn-rounded btn-danger form-control" name="refresh" id="refresh"> <i
                                class="fa fa-stop"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="row">
        @if (auth()->user()->role == 'cabang')
            <input type="hidden" id="stat" value="{{ auth()->user()->role }}">
            <input type="hidden" id="stat_id" value="{{ auth()->user()->cabang->id }}">
            @if (auth()->user()->cabang->ttd == null)
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="avatar-sm font-size-20 mr-3">
                                    <span class="avatar-title bg-soft-primary text-primary rounded">
                                        <i
                                            class="mdi mdi-mdi mdi-contact-mail-outline
                                            tag-plus-outline"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <div class="font-size-16 mt-2" style="color: rgb(255, 145, 145)">UPLOAD tanda tangan
                                        "Kepala Cabang" untuk memproses syahadah<br>
                                        <u><a href="#" data-toggle="modal" data-target="#modalupload"
                                                style="color: darkcyan">Klik disini untuk upload file TTD Kepala
                                                Cabang</a></u>
                                    </div>
                                </div>
                            </div>
                            <h4 class="mt-4"></h4>
                        </div>
                    </div>
                </div>
            @else
            @endif
        @else
            <input type="hidden" id="stat" value="pusat">
        @endif

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="avatar-sm font-size-20 mr-3">
                            <span class="avatar-title bg-soft-primary text-primary rounded">
                                <i
                                    class="mdi mdi-mdi mdi-contact-mail-outline
                                    tag-plus-outline"></i>
                            </span>
                        </div>
                        <div class="media-body">
                            <div class="font-size-16 mt-2">Belum mengirimkan TTD <br> <b id="cb"
                                    style="color: blue">?</b> Cabang</div>
                        </div>
                    </div>
                    <h4 class="mt-4"></h4>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="avatar-sm font-size-20 mr-3">
                            <span class="avatar-title bg-soft-primary text-primary rounded">
                                <i
                                    class="mdi mdi-mdi mdi-contact-mail-outline
                                    tag-plus-outline"></i>
                            </span>
                        </div>
                        <div class="media-body">
                            <div class="font-size-16 mt-2">Belum di audit petugas <br> <b id="cb2"
                                    style="color: blue">?</b> Cabang</div>
                        </div>
                    </div>
                    <h4 class="mt-4"></h4>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="avatar-sm font-size-20 mr-3">
                            <span class="avatar-title bg-soft-primary text-primary rounded">
                                <i
                                    class="mdi mdi-mdi mdi-contact-mail-outline
                                    tag-plus-outline"></i>
                            </span>
                        </div>
                        <div class="media-body">
                            <div class="font-size-16 mt-2">TTD Fix <br> <b id="cb3" style="color: blue">?</b> Cabang
                            </div>
                        </div>
                    </div>
                    <h4 class="mt-4"></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">DAFTAR E SYAHADAH</h4>
                    <p class="card-title-desc"></p>
                    <input type="hidden" id="user" value="{{ auth()->user()->role }}">
                    @if (auth()->user()->role == 'cabang')
                        <input type="hidden" id="cabang" value="{{ auth()->user()->cabang->id }}">
                    @endif
                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                        <table id="datatable-buttons" class="table table-cabang table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead class="text-bold text-primary" style="text-transform: uppercase; font-size: 12px">
                                <tr>
                                    <th>TTD</th>
                                    <th style="width: 20%">Cabang</th>
                                    <th>Kepala Cabang</th>
                                    <th>Status</th>
                                    <th style="width: 20%">Opsi</th>
                                </tr>
                            </thead>

                            <tbody style="font-size: 12px; text-transform: uppercase">
                            </tbody>

                        </table>
                        <footer class="blockquote-footer">Updated at <cite title="Source Title">{{ date('Y') }}</cite>
                        </footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->


    <div class="modal fade" id="modalupload" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <form id="formupload"> @csrf
                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="header" style="text-align: center; margin-bottom: 20px">
                                        <h5>UPLOAD TTD KEPALA CABANG
                                            <br>
                                            <u id="kepalacabang"></u>
                                        </h5>
                                    </div>
                                    <div class="body">
                                        <div class="form-group">
                                            <input type="hidden" id="id" class="form-control" name="id">
                                            <select name="status_ttd" id="status_ttd" class="form-control" required>
                                                <option value="">:: STATUS ::</option>
                                                <option value="menunggu">:: UJI ::</option>
                                                <option value="fix">:: FIX ::</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="ttd" accept="image/*"
                                            >
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <div class="modal-footer">
                        <input type="submit" id="btnupload" class="btn btn-sm btn-info" value="UPLOAD">
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" id="modaldel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <form id="formdel"> @csrf
                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="header" style="text-align: center; margin-bottom: 20px">
                                        <h5>REMOVE FILE TTD KEPALA CABANG ?
                                            <br>
                                            <u id="kepalacabang"></u>
                                        </h5>
                                    </div>
                                    <div class="body">
                                        <p>Yakin akan menghapus secara permanen file ttd kepala cabang tersebut ?</p>
                                        <input type="hidden" id="id" class="form-control" name="id">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <div class="modal-footer">
                        <input type="submit" id="btndel" class="btn btn-sm btn-danger" value="DELETE">
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    @if (auth()->user()->role == 'cabang')
        <div class="modal fade" id="modalupload" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <form id="formupload"> @csrf
                        <div class="modal-body">
                            <div class="col-xl-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="header" style="text-align: center; margin-bottom: 20px">
                                            <h5>UPLOAD TTD KEPALA CABANG
                                                <br>
                                                <u>{{ auth()->user()->cabang->kepalacabang }}</u>
                                            </h5>
                                        </div>
                                        <div class="body">
                                            <input type="file" class="form-control" name="ttd" accept="image/*"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <div class="modal-footer">
                            <input type="submit" id="btnupload" class="btn btn-sm btn-info" value="UPLOAD">
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endif



    <input type="text" value="{{ auth()->user()->role }}" style="display: none">
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
        var pelatihan_id;

        $('#modalupload').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var kepalacabang = button.data('kepalacabang')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            console.log(id);
            modal.find('.modal-body #kepalacabang').html(kepalacabang);
        })

        $('#modaldel').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var kepalacabang = button.data('kepalacabang')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            console.log(id);
            modal.find('.modal-body #kepalacabang').html(kepalacabang);
        })

        $('#modalb52').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            pelatihan_id = id;
        })


        $('#linkdepans').on('click', function() {
            swal({
                title: "SYAHADAH V.1",
                text: 'Tekan "OK" untuk mengunduh syahadah depan V.1',
                type: "success"
            }).then(okay => {
                if (okay) {
                    window.location.href = "/cetak-syahadah-depan-b5/" + pelatihan_id;
                }
            });
        })

        $('#linkbelakang').on('click', function() {
            swal({
                title: "SYAHADAH V.1",
                text: 'Tekan "OK" untuk mengunduh syahadah belakang V.1',
                type: "success"
            }).then(okay => {
                if (okay) {
                    window.location.href = "/cetak-syahadah-belakang-b5/" + pelatihan_id;
                }
            });
        })

        $('#linkdepanbelakang').on('click', function() {
            swal({
                title: "SYAHADAH V.2",
                text: 'Tekan "OK" untuk mengunduh syahadah V.2',
                type: "success"
            }).then(okay => {
                if (okay) {
                    window.location.href = "/cetak-syahadah-depan-belakang-b5/" + pelatihan_id;
                }
            });
        })

        $('.bs-example-modal-diklat-link').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var slug = button.data('slug')
            var modal = $(this)
            modal.find('.modal-body #link').val(slug);
            // modal.find('.modal-body #bukalink').attr(slug);
            var a = document.getElementById("bukalink");
            a.href = slug;
        })



        function myFunction() {
            /* Get the text field */
            var copyText = document.getElementById("link");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);

            /* Alert the copied text */
            alert("Copied the text: " + copyText.value);
        }

        $(document).ready(function() {
            var stat = $('#stat').val();

            load_data();
            count_data();

            function load_data(dari = '', sampai = '') {
                toastr.success('menampilkan daftar syahadah');
                $('#datatable-buttons').DataTable({
                    //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/daftar-ttd-cabang',
                        data: {
                            dari: dari,
                            sampai: sampai
                        }
                    },
                    columns: [{
                            data: 'image_ttd',
                            name: 'ttd'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'kepalacabang',
                            name: 'kepalacabang'
                        },
                        {
                            data: 'status_ttd',
                            name: 'status_ttd'
                        },
                        {
                            data: 'opsi',
                            name: 'opsi'
                        },
                    ]
                });
            }

            function count_data(dari = '', sampai = '') {
                $.ajax({
                    url: '/total-ttd-cabang',
                    type: 'get',
                    dataType: 'json',
                    data: {
                        dari: dari,
                        sampai: sampai
                    },
                    success: function(data) {
                        toastr.success('menampilkan data perhitungan syahadah');
                        document.getElementById('cb').innerHTML = data.belum_mengirim;
                        document.getElementById('cb2').innerHTML = data.sudah_mengirim;
                        document.getElementById('cb3').innerHTML = data.fix_mengirim;
                    }
                });
            }

            $('#filter').click(function() {
                var dari = $('#dari').val();
                var sampai = $('#sampai').val();
                if (dari != '' && sampai != '') {
                    load_data(dari, sampai);
                    count_data(dari, sampai);
                } else {
                    alert('Both Date is required');
                }
            });

            $('#refresh').click(function() {
                $('#dari').val('');
                $('#sampai').val('');
                load_data();
            });



            $('#formupload').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "/audit-ttd-cabang",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#btnupload').attr('disabled', 'disabled');
                        $('#btnupload').val('Proses upload...');
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            var oTable = $('#datatable-buttons').dataTable();
                            oTable.fnDraw(false);
                            $('#modalupload').modal('hide');
                            $("#formupload")[0].reset();
                            $('#btnupload').val('UPLOAD');
                            $('#btnupload').attr('disabled', false);
                            toastr.success(data.message);
                            swal({
                                title: "SUCCESS!",
                                text: data.message,
                                type: "success"
                            });
                            $.ajax({
                                url: '/total-ttd-cabang',
                                type: 'get',
                                dataType: 'json',
                                success: function(data) {
                                    toastr.success('menampilkan data perhitungan syahadah');
                                    document.getElementById('cb').innerHTML = data.belum_mengirim;
                                    document.getElementById('cb2').innerHTML = data.sudah_mengirim;
                                    document.getElementById('cb3').innerHTML = data.fix_mengirim;
                                }
                            });
                        } else {
                            $("#formupload")[0].reset();
                            $('#btnupload').val('UPLOAD');
                            $('#btnupload').attr('disabled', false);
                            toastr.error(data.message);
                            swal({
                                title: "SUCCESS!",
                                text: data.message,
                                type: "error"
                            });
                            $('#modalupload').modal('hide');
                        }
                    },
                    error: function(data) {
                        // console.log(data);
                    }
                });
            });

            $('#formdel').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "/remove-ttd-cabang",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#btndel').attr('disabled', 'disabled');
                        $('#btndel').val('Proses deleting...');
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            var oTable = $('#datatable-buttons').dataTable();
                            oTable.fnDraw(false);
                            $('#modaldel').modal('hide');
                            $("#formdel")[0].reset();
                            $('#btndel').val('DELETE');
                            $('#btndel').attr('disabled', false);
                            toastr.success(data.message);
                            swal({
                                title: "SUCCESS!",
                                text: data.message,
                                type: "success"
                            });

                            $.ajax({
                                url: '/total-ttd-cabang',
                                type: 'get',
                                dataType: 'json',
                                success: function(data) {
                                    toastr.success('menampilkan data perhitungan syahadah');
                                    document.getElementById('cb').innerHTML = data.belum_mengirim;
                                    document.getElementById('cb2').innerHTML = data.sudah_mengirim;
                                    document.getElementById('cb3').innerHTML = data.fix_mengirim;
                                }
                            });

                        } else {
                            $("#formdel")[0].reset();
                            $('#btndel').val('REMOVE');
                            $('#btndel').attr('disabled', false);
                            toastr.error(data.message);
                            swal({
                                title: "SUCCESS!",
                                text: data.message,
                                type: "error"
                            });
                            $('#modalupload').modal('hide');
                        }
                    },
                    error: function(data) {
                        // console.log(data);
                    }
                });
            });
        })
    </script>
@endsection
