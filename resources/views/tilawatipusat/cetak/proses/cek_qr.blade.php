@extends('layouts.tilawatipusat_layouts.master')

@section('content')

    @component('common-tilawatipusat.breadcrumb')
        @slot('title') Cek QR Code @endslot
        @slot('title_li') @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-6">

            <div class="row">
                <div class="col-md-6">

                    @component('common-tilawatipusat.dashboard2-widget')
                        @slot('title') Total Peserta @endslot
                        @slot('total') <span id="tot_pes">{{ $peserta->where('bersyahadah', 1)->count() }}</span>
                        <span>Lulus</span>@endslot
                        @slot('chartId') @endslot
                        @section('from')
                            <p class="mb-0"><span class="badge badge-soft-success mr-2"> <i class="mdi mdi-arrow-up"></i>
                                </span> Dari Total {{ $peserta->count() }} Peserta</p>
                        @endsection
                    @endcomponent
                </div>
                <div class="col-md-6">

                    @component('common-tilawatipusat.dashboard2-widget2')
                        @slot('title') Total QR Code @endslot
                        @slot('total') <span id="tot_qr"> </span> Qr Code @endslot
                        @slot('chartId') @endslot
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
                    CETAK SYAHADAH : <input type="hidden" id="pel_id" value="{{ $pelatihan_id }}">
                </div>
                <div class="card-body">
                    <button id="generate" onclick="Generates()" class="btn btn-sm btn-outline-primary">generate</button>
                    <button style="float: right" class="btn btn-sm btn-outline-primary"><i class="fa fa-download"></i> Cetak
                        Syahadah</button>
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
        var pelatihan_id = $('#pel_id').val();
        var total_peserta = $('#tot_pes').html();
        var total_qr = $('#tot_qr').html();
        var qr;
        $(document).ready(function() {

            $.ajax({
                url: '/cek-qr-code/' + pelatihan_id,
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    $('#tot_qr').html(data);
                    console.log(data);
                }
            });


            // function generate() {
            //     console.log(total_peserta);
            //     if (condition) {

            //     } else {

            //     }
            // }
        })

        function Generates() {
            $.ajax({
                url: '/generate_qr_peserta/' + pelatihan_id,
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    // batch update -> dijalankan sekali -> dibaca berulang kali
                }   
            });
            var pelatihan_id = $('#pel_id').val();
            var total_peserta = $('#tot_pes').html();
            var total_qr = $('#tot_qr').html();
            
            var i = 1;
            setInterval(function() {
                if (total_peserta != qr) {
                    $.ajax({
                        url: '/cek-qr-code/' + pelatihan_id,
                        type: 'get',
                        dataType: 'json',
                        success: function(data) {
                            qr = i;
                            $('#tot_qr').html(qr);
                            console.log('qr : ' + qr);
                            console.log('total peserta : ' + total_peserta);

                        }
                    });
                    
                } else {
                    console.log('stop');
                }

                i++;
            }, 1000);
        }
    </script>
@endsection
