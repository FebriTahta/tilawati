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
    <div class="row">
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
    </div>

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
            @elseif(auth()->user()->cabang->ttd !== null && auth()->user()->cabang->status_ttd == 'menunggu')
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
                                    <div class="font-size-16 mt-2" style="color: rgb(255, 145, 145)">Pengajuan File TTD Sukses<br>
                                        <span>Menunggu proses penyesuaian max (2x24 jam)</span>
                                    </div>
                                </div>
                            </div>
                            <h4 class="mt-4"></h4>
                        </div>
                    </div>
                </div>
            @elseif(auth()->user()->cabang->ttd !== null && auth()->user()->cabang->status_ttd == 'fix')
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
                                    <div class="font-size-16 mt-2" style="color: blue">File TTD Sudah Sesuai<br>
                                        <span>File syahadah baru sudah dapat di unduh / gunakan</span>
                                    </div>
                                </div>
                            </div>
                            <h4 class="mt-4"></h4>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <input type="hidden" id="stat" value="pusat">
        @endif
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
                            <div class="font-size-16 mt-2">Total Syahadah Yang Diterbitkan <br> <b id="cb"
                                    style="color: blue">?</b>
                                Penerbitan Syahadah & <b style="color: blue" id="cb2">?</b> Syahadah Peserta </div>
                        </div>
                    </div>
                    <h4 class="mt-4"></h4>
                </div>
            </div>
        </div>
    </div>

    {{-- display image ttd --}}
    @if (auth()->user()->role == 'cabang')
        @if (auth()->user()->cabang->ttd !== null && auth()->user()->cabang->status_ttd == 'menunggu' || auth()->user()->cabang->status_ttd == 'fix')
            <div class="row">
                <div class="col-lg-2">
                    <div class="card">
                        <div class="card-body">
                            <img src="img_ttd/{{ auth()->user()->cabang->ttd }}" style="max-width: 100%" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p>anda bisa meemperbarui file ttd yang sudah anda upload dengan klik tombol dibawah ini</p>
                            <a href="#" data-toggle="modal" data-target="#modaluploadulang">UPDATE FILE TTD KEPALA CABANG</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif


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
                                    <th style="width: 5%">Id</th>
                                    @if (auth()->user()->role == 'pusat')
                                        <th style="width: 17%">Cabang</th>
                                    @endif
                                    <th>Tanggal Pelatihan</th>
                                    <th>Tanggal Terbit</th>
                                    <th style="width: 30%">Program</th>
                                    <th style="width: 10%">Peserta Lulus</th>
                                    <th>Link</th>
                                    <th>Cetak</th>
                                </tr>
                            </thead>

                            <tbody style="font-size: 12px; text-transform: uppercase">
                            </tbody>

                            <tfoot class="text-bold text-primary" style="text-transform: uppercase; font-size: 12px">
                                <tr>
                                    <th style="width: 5%">Id</th>
                                    @if (auth()->user()->role == 'pusat')
                                        <th style="width: 17%">Cabang</th>
                                    @endif
                                    <th>Tanggal Pelatihan</th>
                                    <th>Tanggal Terbit</th>
                                    <th style="width: 30%">Program</th>
                                    <th style="width: 10%">Peserta Lulus</th>
                                    <th>Link</th>
                                    <th>Cetak</th>
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



    <div class="modal fade bs-example-modal-diklat-link" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-xl-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="form-gorup" style="margin-bottom: 20px">
                                    <textarea name="" id="link" cols="30" rows="4" class="form-control" disabled></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="button" onclick="myFunction()" id="btn-copy" value="salin link!"
                                        class="btn btn-sm btn-outline-primary">
                                    <a id="bukalink" target="_blank"
                                        class="btn btn-sm btn-outline-primary text-primary"> buka link!</a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="modalb5" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-xl-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="header" style="text-align: center; margin-bottom: 20px">
                                    <h5>PILIH CETAK DEPAN / BELAKANG</h5>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <button id="linkdepans" class="btn btn-success" style="width: 100%">CETAK
                                            DEPAN</button>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <button id="linkbelakang" class="btn btn-info" style="width: 100%">CETAK
                                            BELAKANG</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="modalb52" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-xl-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="header" style="text-align: center; margin-bottom: 20px">
                                    <h5>CETAK SYAHADAH VERSI 0.2</h5>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <button id="linkdepanbelakang" class="btn btn-info" style="width: 100%">CETAK
                                            VERSI 0.2</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
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

        <div class="modal fade" id="modaluploadulang" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <form id="formuploadulang"> @csrf
                        <div class="modal-body">
                            <div class="col-xl-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="header" style="text-align: center; margin-bottom: 20px">
                                            <h5>UPLOAD ULANG TTD KEPALA CABANG
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
                            <input type="submit" id="btnuploadulang" class="btn btn-sm btn-info" value="UPLOAD ULANG">
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

        $('#modalb5').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            pelatihan_id = id;
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
            if (stat == 'pusat') {

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
                            url: '/data-syahadah-pusat',
                            data: {
                                dari: dari,
                                sampai: sampai
                            }
                        },
                        columns: [{
                                data: 'id',
                                name: 'id'
                            },
                            {
                                data: 'cabang',
                                name: 'cabang.name'
                            },
                            {
                                data: 'tanggals',
                                name: 'tanggal'
                            },
                            {
                                data: 'tanggal_terbit',
                                name: 'updated_at'
                            },
                            {
                                data: 'program',
                                name: 'program.name'
                            },
                            {
                                data: 'peserta',
                                name: 'peserta'
                            },
                            {
                                data: 'linksyahadah',
                                name: 'linksyahadah'
                            },
                            {
                                data: 'cetak',
                                name: 'cetak'
                            },
                        ]
                    });
                }

                function count_data(dari = '', sampai = '') {
                    $.ajax({
                        url: '/total-syahadah-terbit-pusat',
                        type: 'get',
                        dataType: 'json',
                        data: {
                            dari: dari,
                            sampai: sampai
                        },
                        success: function(data) {
                            toastr.success('menampilkan data perhitungan syahadah');
                            document.getElementById('cb').innerHTML = data.terbit;
                            document.getElementById('cb2').innerHTML = data.peserta_terbit;
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

            } else {

                var stat_id = $('#stat_id').val();

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
                            url: '/data-syahadah-cabang/' + stat_id,
                            data: {
                                dari: dari,
                                sampai: sampai
                            }
                        },
                        columns: [{
                                data: 'id',
                                name: 'id'
                            },
                            {
                                data: 'tanggals',
                                name: 'tanggal'
                            },
                            {
                                data: 'tanggal_terbit',
                                name: 'updated_at'
                            },
                            {
                                data: 'program',
                                name: 'program.name'
                            },
                            {
                                data: 'peserta',
                                name: 'peserta'
                            },
                            {
                                data: 'linksyahadah',
                                name: 'linksyahadah'
                            },
                            {
                                data: 'cetak',
                                name: 'cetak'
                            },
                        ]
                    });
                }

                function count_data(dari = '', sampai = '') {
                    $.ajax({
                        url: '/total-syahadah-terbit-cabang/' + stat_id,
                        type: 'get',
                        dataType: 'json',
                        data: {
                            dari: dari,
                            sampai: sampai
                        },
                        success: function(data) {
                            toastr.success('menampilkan data perhitungan syahadah');
                            document.getElementById('cb').innerHTML = data.terbit;
                            document.getElementById('cb2').innerHTML = data.peserta_terbit;
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
            }

            $('#formupload').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "/upload-ttd-kepala-cabang",
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
                            $('#modalupload').modal('hide');
                            $("#formupload")[0].reset();
                            $('#btnupload').val('UPLOAD');
                            $('#btnupload').attr('disabled', false);
                            toastr.success(data.message);
                            swal({
                                title: "SUCCESS!",
                                text: data.message,
                                type: "success"
                            }).then(okay => {
                                if (okay) {
                                    window.location.href =
                                        "/daftar-syahadah-elektronik";
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

            $('#formuploadulang').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "/upload-ttd-ulang-kepala-cabang",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#btnuploadulang').attr('disabled', 'disabled');
                        $('#btnuploadulang').val('Proses upload...');
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            $('#modaluploadulang').modal('hide');
                            $("#formuploadulang")[0].reset();
                            $('#btnuploadulang').val('UPLOAD ULANG');
                            $('#btnuploadulang').attr('disabled', false);
                            toastr.success(data.message);
                            swal({
                                title: "SUCCESS!",
                                text: data.message,
                                type: "success"
                            }).then(okay => {
                                if (okay) {
                                    window.location.href =
                                        "/daftar-syahadah-elektronik";
                                }
                            });
                        } else {
                            $("#formuploadulang")[0].reset();
                            $('#btnuploadulang').val('UPLOAD');
                            $('#btnuploadulang').attr('disabled', false);
                            toastr.error(data.message);
                            swal({
                                title: "SUCCESS!",
                                text: data.message,
                                type: "error"
                            });
                            $('#modaluploadulang').modal('hide');
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
