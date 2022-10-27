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
                        <input type="hidden" id="stat" value="{{ auth()->user()->role }}">
                        <input type="hidden" id="stat_id" value="{{ auth()->user()->cabang->id }}">
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
                            <div class="font-size-16 mt-2">Total Syahadah Yang Diterbitkan <br> <b id="cb" style="color: blue">?</b>
                                Penerbitan Syahadah & <b style="color: blue" id="cb2">?</b> Syahadah Peserta </div>
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

    

    <div class="modal fade bs-example-modal-diklat-link" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
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
                                        <button id="linkdepans" class="btn btn-success" style="width: 100%">CETAK DEPAN</button>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <button id="linkbelakang" class="btn btn-info" style="width: 100%">CETAK BELAKANG</button>
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
                                        <button id="linkdepanbelakang" class="btn btn-info" style="width: 100%">CETAK VERSI 0.2</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


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
                    window.location.href = "/cetak-syahadah-depan-b5/"+pelatihan_id;
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
                    window.location.href = "/cetak-syahadah-belakang-b5/"+pelatihan_id;
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
                    window.location.href = "/cetak-syahadah-depan-belakang-b5/"+pelatihan_id;
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
                        url:'/total-syahadah-terbit-pusat',
                        type: 'get',
                        dataType: 'json',
                        data:{dari:dari, sampai:sampai},
                        success:function(data) {
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

            }else{

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
                            url: '/data-syahadah-cabang/'+stat_id,
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
                        url:'/total-syahadah-terbit-cabang/'+stat_id,
                        type: 'get',
                        dataType: 'json',
                        data:{dari:dari, sampai:sampai},
                        success:function(data) {
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
        })
    </script>
@endsection
