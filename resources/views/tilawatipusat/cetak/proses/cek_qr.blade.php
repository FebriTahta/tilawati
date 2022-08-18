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
            @component('common-tilawatipusat.dashboard2-widget3')
                @slot('title')
                    <?php $diklat = App\Models\Pelatihan::where('id', $pelatihan_id)->first(); ?>
                    @if (auth()->user()->role == 'pusat')
                    <span class="text-capitalize">Cabang : Tilawati
                        {{ $diklat->cabang->kabupaten->nama }}
                        ({{ $diklat->cabang->name }})</span>
                    @else
                    <span class="text-capitalize">Cabang : Tilawati
                        {{ strtolower(substr(auth()->user()->cabang->kabupaten->nama, 5)) }}
                        ({{ auth()->user()->cabang->name }})</span>
                    @endif
                @endslot
                @slot('total')
                    <span>{{ $diklat->program->name }}</span>
                @endslot
                @slot('chartId')
                @endslot
                @section('from3')
                    <p class="mb-0"><span class="badge badge-soft-success mr-2"> <i class="mdi mdi-arrow-up"></i>
                        </span> {{ $diklat->tanggal }}</p>
                @endsection
            @endcomponent
        </div>
        <div class="col-xl-6">
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
        <div class="col-xl 6">
            @component('common-tilawatipusat.dashboard2-widget2')
                @slot('title')
                    Total QR Code
                @endslot
                @slot('total')
                    <span id="tot_qr"> </span> Qr Code
                    {{-- <span>Untuk sementara QR di Non Aktifkan</span> --}}
                @endslot
                @slot('chartId')
                @endslot
                @section('from2')
                    <p class="mb-0"><span class="badge badge-soft-success mr-2"> <i class="mdi mdi-arrow-up"></i></span>
                        Peserta Siap Cetak</p>
                @endsection
            @endcomponent
        </div>

        <div class="col-xl-6" style="margin-top: 20px">
            <?php $peserta_salah = App\Models\Peserta::where('pelatihan_id', $pelatihan_id)
                ->where('bersyahadah', 1)
                ->get();
            $salah1 = 0;
            $salah2 = 0;
            $salah3 = 0; ?>
            @if ($peserta_salah->where('tmptlahir', null)->where('bersyahadah', 1)->count() > 0 && $peserta_salah->where('tmptlahir2', null)->where('bersyahadah', 1)->count())
                <div class="col-lg-12 alert alert-danger">
                    <p>{{ $salah1 = $peserta_salah->where('tmptlahir', null)->where('bersyahadah', 1)->count() }} Peserta
                        dengan kesalahan
                        penulisan
                        tempat lahir</p>
                    @foreach ($peserta_salah->where('tmptlahir', null)->where('bersyahadah', 1) as $item)
                        [ {{$item->id}} ] {{$item->name}}
                    @endforeach
                    
                </div>
            @endif
            @if ($peserta_salah->where('tgllahir', '-')->where('bersyahadah', 1)->count() > 0 || $peserta_salah->where('tgllahir', null)->count() > 0)
                <div class="col-lg-12 alert alert-danger">
                    <p>{{ $salah2 =$peserta_salah->where('tgllahir', null)->where('bersyahadah', 1)->count() +$peserta_salah->where('tgllahir', '-')->where('bersyahadah', 1)->count() }}
                        Peserta dengan kesalahan penulisan tanggal lahir</p>
                    @foreach ($peserta_salah->where('tgllahir', null)->where('bersyahadah', 1) as $item)
                        [ {{$item->id}} ] {{$item->name}}
                    @endforeach
                </div>
            @endif
            @if ($peserta_salah->where('kabupaten_id', null)->where('bersyahadah', 1)->count() > 0)
                <div class="col-lg-12 alert alert-danger">
                    <p>{{ $salah3 = $peserta_salah->where('kabupaten_id', null)->where('bersyahadah', 1)->count() }}
                        Peserta dengan
                        kesalahan
                        penulisan asal kabupaten / kota</p>
                    @foreach ($peserta_salah->where('kabupaten_id', null)->where('bersyahadah', 1) as $item)
                        [ {{$item->id}} ] {{$item->name}}
                    @endforeach
                   
                </div>
            @endif
            @if ($salah1 + $salah2 + $salah3 > 0)
                <a href="/diklat-peserta/{{ $pelatihan_id }}" class="btn btn-info"> KLIK DISINI MENUJU DATA PESERTA
                    DIKLAT</a>
            @endif
        </div>

        <div class="col-xl-6" style="margin-top: 20px">

            @if ($salah1 + $salah2 + $salah3 > 0)
                <div class="card card-body">

                    <code>Beberapa data peserta ini kosong / mengalami kesalahan penulisan. Mohon periksa kembali apabila
                        dilakukan pencetakan syahadah</code>
 
                </div>
            @endif
            <div class="row">
                <div class="col-xl-12" style="margin-top: 20px">
                    {{-- <form action="/generate_qr_peserta" method="POST" enctype="multipart/form-data">@csrf --}}
                    <form id="create_qr" method="POST" style="float: right"> @csrf
                        <input type="hidden" name="pelatihan_id2" id="pel_idqr" value="{{ $pelatihan_id }}">
                        <input type="submit" id="btnbuat" class="btn btn-primary" value="Generate Qr Code" >
                    </form>    
                </div>
                <div class="col-xl-12" style="margin-top: 20px">
                    <form action="{{ route('diklat.depan_cetak_syahadah') }}" method="POST" style="float: right">@csrf
                        <input type="hidden" name="pelatihan_id" value="{{ $pelatihan_id }}">
                        <div class="form-group" style="margin-right: 10px">
                            <input type="submit" id="btncetak" class="btn btn-outline-primary" value="Cetak Syahadah Depan">
                        </div>
                    </form>
                </div>
                @if (auth()->user()->role == 'pusat' || auth()->user()->role == 'cabang')
                <div class="col-xl-12" style="margin-top: 20px">
                    <form action="{{ route('depan.cetak_versi_lama') }}" method="POST" style="float: right">@csrf
                        <input type="hidden" name="pelatihan_id" value="{{ $pelatihan_id }}">
                        <div class="form-group" style="margin-right: 10px">
                            <input type="submit" id="btncetak" class="btn btn-outline-info" value="Cetak Syahadah Depan Versi Lama">
                        </div>
                    </form>
                </div>
                @endif
                <div class="col-xl-12">
                    <form id="reset_qr" method="POST" style="float: right"> @csrf
                    {{-- <form action="/reset-status-qr" method="POST" style="float: right"> @csrf --}}
                        <input type="hidden" name="pelatihan_id2" id="pel_id" value="{{ $pelatihan_id }}">
                        <input type="submit" id="btnreset" class="btn btn-danger" value="Reset Status QR" >
                    </form>  
                </div>

            </div>
        </div>

        
    @endsection

    @section('script')
        <!-- Toast -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">


        <script> 
        var pelatihan_id = $('#pel_idqr').val();
            $('#create_qr').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'GET',
                    url: "/generate_qr_peserta/"+pelatihan_id,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#btnbuat').attr('disabled', 'disabled');
                        $('#btnbuat').val('Generate QR Processing..');

                    },
                    success: function(data) {
                        if (data.success) {
                            $('#btnbuat').attr('disabled', 'disabled');
                            $('#btnbuat').val('SELESAI');
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });

            $('#reset_qr').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'GET',
                    url: "/reset-status-qr/"+pelatihan_id,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        // $('#btnreset').attr('disabled', 'disabled');
                        $('#btnreset').val('QR Berhasil Direset Ulang');

                    },
                    success: function(data) {
                        if (data.success) {
                            // $("#tambahkriteria")[0].reset();
                            // var oTable = $('#datatable-buttons').dataTable();
                            // oTable.fnDraw(false);
                            // $('#btnreset').attr('disabled', 'disabled');
                            $('#btnreset').val('OK. Reset Lagi ?');
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
                setInterval(function() {
                    // console.log(total_peserta);
                    if ($('#tot_qr').html() == total_peserta) {
                        $('#btnbuat').attr('disabled', 'disabled');
                        $('#btnbuat').val('SELESAI');
                    }
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
        </script>
    @endsection
