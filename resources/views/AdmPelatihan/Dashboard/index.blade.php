@extends('layouts.adm.master')
@section('content')
<div class="page-content-wrapper ">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><span id="hari"></span> <span id="tgl"></span> <span id="bln"></span></li>
                        <li class="breadcrumb-item active"><span id="clock"></span></li>
                    </ol>
                </div>
                <h5 class="page-title text-uppercase">Dashboard</h5>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat m-b-30">
                    <div class="p-3 text-white" style="background-color: rgb(114, 228, 203)">
                        <div class="mini-stat-icon">
                            <i class="fa fa-leanpub float-right mb-0"></i>
                        </div>
                        <h6 class="text-uppercase mb-0">TOTAL DIKLAT</h6>
                    </div>
                    <div class="card-body">
                        <div class="border-bottom pb-4 text-center">
                            <h2>50</h2><h5>DIKLAT</h5>
                            <div class="float-left">
                                {{-- <h6 class="m-0">20 Cabang</h6> --}}
                            </div>
                            <div class="float-right">
                                {{-- <h6 class="m-0">30 Lembaga</h6> --}}
                            </div>
                        </div>
                        <div class="mt-4 text-muted">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat m-b-30">
                    <div class="p-3 text-white" style="background-color: rgb(75, 152, 253)">
                        <div class="mini-stat-icon">
                            <i class="fa fa-building-o float-right mb-0"></i>
                        </div>
                        <h6 class="text-uppercase mb-0">TOTAL CABANG</h6>
                    </div>
                    <div class="card-body">
                        <div class="border-bottom pb-4 text-center">
                            <h2>50</h2><h5>CABANG</h5>
                        </div>
                        <div class="mt-4 text-muted">
                            <div class="float-left">
                                {{-- <p class="m-0">50 Guru</p> --}}
                            </div>
                            <div class="float-right">
                                {{-- <p class="m-0">30 Santri</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat m-b-30">
                    <div class="p-3 text-white" style="background-color: rgb(124, 152, 243)">
                        <div class="mini-stat-icon">
                            <i class="fa fa-bank float-right mb-0"></i>
                        </div>
                        <h6 class="text-uppercase mb-0">TOTAL LEMBAGA</h6>
                    </div>
                    <div class="card-body">
                        <div class="border-bottom pb-4 text-center">
                            <h2>50</h2><h5>LEMBAGA</h5>
                        </div>
                        <div class="mt-4 text-muted">
                            <div class="float-left">
                                {{-- <p class="m-0">50 Guru</p> --}}
                            </div>
                            <div class="float-right">
                                {{-- <p class="m-0">30 Santri</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat m-b-30">
                    <div class="p-3 text-white" style="background-color: rgb(185, 124, 243)">
                        <div class="mini-stat-icon">
                            <i class="fa fa-address-card-o float-right mb-0"></i>
                        </div>
                        <h6 class="text-uppercase mb-0">TOTAL PESERTA DIKLAT</h6>
                    </div>
                    <div class="card-body">
                        <div class="border-bottom pb-4 text-center">
                            <h2>50</h2><h5>PESERTA</h5>
                        </div>
                        <div class="mt-4 text-muted">
                            <div class="float-left">
                                {{-- <p class="m-0">50 Guru</p> --}}
                            </div>
                            <div class="float-right">
                                {{-- <p class="m-0">30 Santri</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card m-b-30">
                    {{-- <div class="card-body" style="min-height: 436px">
                        <h4 class="mt-0 header-title mb-4 text-uppercase">History Aktifitas Diklat</h4>
                        <ul class="list-unstyled activity-list">
                            <li class="activity-item">
                                <span class="activity-date">14 April</span>
                                <span class="activity-text">Cabang CAS Surabaya</span>
                                <p class="text-muted mt-2">Diklat Tilawati</p>
                            </li>
                            <li class="activity-item">
                                <span class="activity-date">13 April</span>
                                <span class="activity-text">Cabang CAS Surabaya</span>
                                <p class="text-muted mt-2">Diklat Tilawati</p>
                            </li>
                            <li class="activity-item">
                                <span class="activity-date">12 April</span>
                                <span class="activity-text">Cabang CAS Surabaya</span>
                                <p class="text-muted mt-2">Diklat Tilawati</p>
                            </li>
                        </ul>
                    </div> --}}
                    <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th style="width: 20%">Name</th>
                            <th style="width: 20%">Cabang</th>
                            <th style="width: 20%">Lembaga</th>
                            <th style="width: 10%">Telp</th>
                            <th style="width: 30%">Alamat</th>
                            <th>Diklat</th>
                        </tr>
                        </thead>


                        <tbody>
                        {{-- @foreach ($peserta as $item) --}}
                            <tr>
                                <td>febri rizqi tahta nugraha</td>
                                <td>citra anak soleh</td>
                                <td>baitul ghufron</td>
                                <td>081329146514</td>
                                <td>jl simo jawar gang 3 no 104 rt 02 rw 01</td>
                                <td>
                                    <ul>
                                        <li>diklat tilawati lancar membaca (lulus)</li>
                                        <li>diklat tahfiz (lulus)</li>
                                        <li>diklat tilawah (tidak lulus)</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>febri rizqi tahta nugraha</td>
                                <td>citra anak soleh</td>
                                <td>baitul ghufron</td>
                                <td>081329146514</td>
                                <td>jl simo jawar gang 3 no 104 rt 02 rw 01</td>
                                <td>
                                    <ul>
                                        <li>diklat tilawati lancar membaca (lulus)</li>
                                        <li>diklat tahfiz (lulus)</li>
                                        <li>diklat tilawah (tidak lulus)</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>febri rizqi tahta nugraha</td>
                                <td>citra anak soleh</td>
                                <td>baitul ghufron</td>
                                <td>081329146514</td>
                                <td>jl simo jawar gang 3 no 104 rt 02 rw 01</td>
                                <td>
                                    <ul>
                                        <li>diklat tilawati lancar membaca (lulus)</li>
                                        <li>diklat tahfiz (lulus)</li>
                                        <li>diklat tilawah (tidak lulus)</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>febri rizqi tahta nugraha</td>
                                <td>citra anak soleh</td>
                                <td>baitul ghufron</td>
                                <td>081329146514</td>
                                <td>jl simo jawar gang 3 no 104 rt 02 rw 01</td>
                                <td>
                                    <ul>
                                        <li>diklat tilawati lancar membaca (lulus)</li>
                                        <li>diklat tahfiz (lulus)</li>
                                        <li>diklat tilawah (tidak lulus)</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>febri rizqi tahta nugraha</td>
                                <td>citra anak soleh</td>
                                <td>baitul ghufron</td>
                                <td>081329146514</td>
                                <td>jl simo jawar gang 3 no 104 rt 02 rw 01</td>
                                <td>
                                    <ul>
                                        <li>diklat tilawati lancar membaca (lulus)</li>
                                        <li>diklat tahfiz (lulus)</li>
                                        <li>diklat tilawah (tidak lulus)</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>febri rizqi tahta nugraha</td>
                                <td>citra anak soleh</td>
                                <td>baitul ghufron</td>
                                <td>081329146514</td>
                                <td>jl simo jawar gang 3 no 104 rt 02 rw 01</td>
                                <td>
                                    <ul>
                                        <li>diklat tilawati lancar membaca (lulus)</li>
                                        <li>diklat tahfiz (lulus)</li>
                                        <li>diklat tilawah (tidak lulus)</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>febri rizqi tahta nugraha</td>
                                <td>citra anak soleh</td>
                                <td>baitul ghufron</td>
                                <td>081329146514</td>
                                <td>jl simo jawar gang 3 no 104 rt 02 rw 01</td>
                                <td>
                                    <ul>
                                        <li>diklat tilawati lancar membaca (lulus)</li>
                                        <li>diklat tahfiz (lulus)</li>
                                        <li>diklat tilawah (tidak lulus)</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>febri rizqi tahta nugraha</td>
                                <td>citra anak soleh</td>
                                <td>baitul ghufron</td>
                                <td>081329146514</td>
                                <td>jl simo jawar gang 3 no 104 rt 02 rw 01</td>
                                <td>
                                    <ul>
                                        <li>diklat tilawati lancar membaca (lulus)</li>
                                        <li>diklat tahfiz (lulus)</li>
                                        <li>diklat tilawah (tidak lulus)</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>febri rizqi tahta nugraha</td>
                                <td>citra anak soleh</td>
                                <td>baitul ghufron</td>
                                <td>081329146514</td>
                                <td>jl simo jawar gang 3 no 104 rt 02 rw 01</td>
                                <td>
                                    <ul>
                                        <li>diklat tilawati lancar membaca (lulus)</li>
                                        <li>diklat tahfiz (lulus)</li>
                                        <li>diklat tilawah (tidak lulus)</li>
                                    </ul>
                                </td>
                            </tr>
                        {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card m-b-30" style="min-height: 436px">
                    <div class="card-body">
                        <h4 class="mt-0 header-title mb-4 text-uppercase">DATA PESERTA</h4>
                        <div class="row">
                            <div class="form-group col-4">
                                <input type="date" id="dari" class="form-control">
                            </div>
                            <div class="form-group col-4">
                                <input type="date" id="sampai" class="form-control">
                            </div>
                            <div class="form-group col-4">
                                <button class="btn btn-rounded btn-primary form-control"> <i class="fa fa-search"></i> CARI</button>
                            </div>
                        </div>
                        
                        <div class="panel-body">
                            <canvas id="canvas" height="350" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">DATA PESERTA PELATIHAN</h4>
                        <p class="text-muted m-b-30 font-14">Table berikut menampilkan seluruh data peserta pelatihan yang ada beserta cabang, lembaga, jenis pelatihan, dan keterangan lulus atau tidaknya peserta tersebut
                        </p>
                        <div class="table table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th style="width: 20%">Name</th>
                                <th style="width: 20%">Cabang</th>
                                <th style="width: 20%">Lembaga</th>
                                <th style="width: 10%">Telp</th>
                                <th style="width: 30%">Alamat</th>
                                <th>Diklat</th>
                            </tr>
                            </thead>


                            <tbody>
                            {{-- @foreach ($peserta as $item) --}}
                                <tr>
                                    <td>febri rizqi tahta nugraha</td>
                                    <td>citra anak soleh</td>
                                    <td>baitul ghufron</td>
                                    <td>081329146514</td>
                                    <td>jl simo jawar gang 3 no 104 rt 02 rw 01</td>
                                    <td>
                                        <ul>
                                            <li>diklat tilawati lancar membaca (lulus)</li>
                                            <li>diklat tahfiz (lulus)</li>
                                            <li>diklat tilawah (tidak lulus)</li>
                                        </ul>
                                    </td>
                                </tr>
                            {{-- @endforeach --}}
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    $(document).ready(function () {
       getDataForChart();

    });
    function getDataForChart() {
        $.ajax({
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('dashboard.chart') }}",
            dataType: "JSON",
            success: function (response) {

                make_chart(response.content.monthNames, response.content.user);
            }
        });
    }
    function make_chart(monthNames, user) {
        var ctx = document.getElementById('canvas').getContext('2d');
        var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: monthNames,
            datasets: [{
                label: 'Data Diklat',
                data: user,
                borderColor: "green",
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

</script>
@endsection
