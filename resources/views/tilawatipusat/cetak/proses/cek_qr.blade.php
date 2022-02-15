@extends('layouts.tilawatipusat_layouts.master')

@section('content')

    @component('common-tilawatipusat.breadcrumb')
        @slot('title')
            Cek QR Code
        @endslot
        @slot('title_li')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-12">
            @component('common-tilawatipusat.dashboard2-widget')
                @slot('title')
                    <?php $diklat = App\Models\Pelatihan::where('id', $pelatihan_id)->first() ?>
                    <span class="text-capitalize">Cabang : Tilawati {{strtolower(substr($diklat->cabang->kabupaten->nama,5))}} ({{$diklat->cabang->name}})</span>
                @endslot
                @slot('total')
                    <span id="tot_pes">{{ $diklat->program->name }}</span>
                @endslot
                @slot('chartId')
                @endslot
                @section('from')
                    <p class="mb-0"><span class="badge badge-soft-success mr-2"> <i class="mdi mdi-arrow-up"></i>
                        </span> Dari Total {{ $peserta->count() }} Peserta</p>
                @endsection
            @endcomponent
        </div>
        <div class="col-xl-6">

            <div class="row">
                <div class="col-md-6">

                    @component('common-tilawatipusat.dashboard2-widget')
                        @slot('title')
                            Total Peserta
                        @endslot
                        @slot('total')
                            <span id="tot_pes">{{ $peserta->where('bersyahadah', 1)->count() }}</span>
                            <span>Lulus</span>
                        @endslot
                        @slot('chartId')
                        @endslot
                        @section('from')
                            <p class="mb-0"><span class="badge badge-soft-success mr-2"> <i class="mdi mdi-arrow-up"></i>
                                </span> Dari Total {{ $peserta->count() }} Peserta</p>
                        @endsection
                    @endcomponent
                </div>
                <div class="col-md-6">

                    @component('common-tilawatipusat.dashboard2-widget2')
                        @slot('title')
                            Total QR Code
                        @endslot
                        @slot('total')
                            <span id="tot_qr"> </span> Qr Code
                        @endslot
                        @slot('chartId')
                        @endslot
                        @section('from2')
                            <p class="mb-0"><span class="badge badge-soft-success mr-2"> <i
                                        class="mdi mdi-arrow-up"></i></span> Peserta Siap Cetak</p>
                        @endsection
                    @endcomponent

                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card" style="height: 120px">
                <div class="card-header" style="color: blue">
                    CETAK SYAHADAH :
                </div>
                <div class="card-body">
                    <form id="create_qr" method="POST"> @csrf
                        <input type="hidden" name="pelatihan_id" id="pel_id" value="{{ $pelatihan_id }}">
                        {{-- <button id="generate" type="submit" onclick="Generates()" class="btn btn-sm btn-outline-primary">generate</button> --}}
                        {{-- <input type="submit" class="btn btn-success" value="generate" id="generatebtn"> --}}
                        <button type="submit" class="btn btn-outline-primary btn-sm">Generate</button>
                    </form>
                    {{-- <button style="float: right" class="btn btn-sm btn-outline-primary"><i class="fa fa-download"></i> Cetak
                        Syahadah</button> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('script')
    <!-- Toast -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">


    <script>
        $('#create_qr').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/generate_qr_peserta",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#generatebtn').attr('disabled', 'disabled');
                    $('#generatebtn').val('Proses Menyimpan Data');

                },
                success: function(data) {
                    if (data.success) {
                        // $("#tambahkriteria")[0].reset();
                        // var oTable = $('#datatable-buttons').dataTable();
                        // oTable.fnDraw(false);
                        $('#generatebtn').val('Generate');
                        // $('.bs-example-modal-kriteria-tambah').modal('hide');
                        $('#generatebtn').attr('disabled', false);



                        swal({
                            title: "Success!",
                            text: "OK!",
                            type: "success"
                        })
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>

    <script>
        var pelatihan_id = $('#pel_id').val();
        var total_peserta = $('#tot_pes').html();
        var total_qr = $('#tot_qr').html();
        var qr;
        $(document).ready(function() {

            // $.ajax({
            //     url: '/cek-qr-code/' + pelatihan_id,
            //     type: 'get',
            //     dataType: 'json',
            //     success: function(data) {
            //         $('#tot_qr').html(data);
            //         qr = data;
            //     }
            // });
            setInterval(function() {

                $.ajax({
                    url: '/cek-qr-code/' + pelatihan_id,
                    type: 'get',
                    dataType: 'json',
                    success: function(data) {
                        $('#tot_qr').html(data);
                        console.log('QR : ' + data);
                    }
                });

            }, 1000);

        })

        function Generates() {

            if (total_peserta != total_qr) {
                $.ajax({
                    url: '/generate_qr_peserta/' + pelatihan_id,
                    type: 'get',
                    dataType: 'json',
                    success: function(data) {
                        // batch update -> dijalankan sekali -> dibaca berulang kali
                        console.log(data);
                    }
                });
                setInterval(function() {

                    $.ajax({
                        url: '/cek-qr-code/' + pelatihan_id,
                        type: 'get',
                        dataType: 'json',
                        success: function(data) {
                            $('#tot_qr').html(data);
                            console.log('QR : ' + data);
                        }
                    });

                }, 1000);

            }




            // if (total_peserta != qr) {

            //     $.ajax({
            //         url: '/cek-qr-code/' + pelatihan_id,
            //         type: 'get',
            //         dataType: 'json',
            //         success: function(data) {
            //             $('#tot_qr').html(qr);
            //             console.log('qr : ' + qr);
            //             console.log('total peserta : ' + total_peserta);

            //         }
            //     });

            // } else {
            //     console.log('stop');
            // }
        }
    </script>
@endsection
