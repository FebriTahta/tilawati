@extends('layouts.tilawatipusat_layouts.master')

@section('title')
    Dashboard
    
@endsection
@section('css')
    <style>
        table.dataTable.prov td:nth-child(2) {
            width: 20px;
            max-width: 20px;
            word-break: break-all;
            white-space: pre-line;
            text-align: center;
        }

        table.dataTable.prov th:nth-child(2) {
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
    integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
    crossorigin=""/>

    <link href="https://fonts.cdnfonts.com/css/boobookitty" rel="stylesheet">
                
    <link href="https://fonts.cdnfonts.com/css/ringo" rel="stylesheet">

    <link href="https://fonts.cdnfonts.com/css/origin" rel="stylesheet">

    <link href="https://fonts.cdnfonts.com/css/sannisa" rel="stylesheet">

    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">

     <!-- Make sure you put this AFTER Leaflet's CSS -->
    <style>
        #map {
            position: absolute;
            right: 0;
            left: 0;
            bottom: 0;
            top: 0; 
            height: 250px;
        }
        
    </style>

    <!-- High Chart -->
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            /* min-width: 320px; */
            max-width: 100%;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
        
        .number {
            font-family: 'Poppins', sans-serif;
            font-size: 30px !important;
        }

        .keterangan {
            /* font-family: 'BooBooKitty', sans-serif; */
            font-family: 'Poppins', sans-serif;
            font-size: 14px !important;
        }
    </style>

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

    

@endsection

@section('content')
    @component('common-tilawatipusat.breadcrumb')
        @slot('title')
            Dashboard
        @endslot
        @slot('title_li')
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    GENERAL DATA REPORT PEMBELAJARAN AL-QUR'AN METODE TILAWATI
                </div>
            </div>
        </div>
        <div class="col-xl-12" style="margin-bottom: 20px">
            <button class="btn btn-primary" data-toggle="modal" id="btnlaporan" data-target="#mod_cabang2" style="width: 100%">LAPORAN PERKEMBANGAN</button>
        </div>
        <div class="col-xl-6">
            <div class="card" style="min-height: 470px">
                <div class="card-body">
                    <h4 style="text-transform: uppercase; font-weight: 500; font-size: 25px">Data Perkembangan Metode Tilawati Di Indonesia</h4>
                    <p>Berdasarkan data yang telah dihimpun atau dilaporkan </p>

                    <div class="row">
                        <div class="col-sm-6">
                            {{-- <div class="form-group">
                                <span class="keterangan" style="font-size: 20px;"> MELATIH</span>
                            </div> --}}
                            <div class="form-group">
                                <a href="#" data-toggle="modal" data-target="#modalsantri"><h5 class="number" id="total_santri" style="font-size: 30px; font-weight: 700">{{number_format($santri,0,',','.')}} <span class="keterangan" style="font-size: 20px;"> SANTRI</span> </h5></a>
                            </div>
                            <div class="form-group">
                                <a href="#" data-toggle="modal" data-target="#modalguru"><h5 class="number"  id="total_guru" style="font-size: 30px; font-weight: 700">{{number_format($guru,0,',','.')}} <span class="keterangan" style="font-size: 20px;"> GURU </span> </h5></a>
                            </div>
                            <div class="form-group">
                                <a href="#" data-toggle="modal" data-target="#modalinstruktur"><h5 class="number" data-toggle="modal" data-target="#modalinstruktur" id="total_instruktur" style="font-size: 30px; font-weight: 700">{{number_format($instruktur,0,',','.')}} <span class="keterangan" style="font-size: 20px;"> INSTRUKTUR</span> </h5></a>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            {{-- <div class="form-group">
                                <span class="keterangan" style="font-size: 20px;"> MEMILIKI</span>
                            </div> --}}
                            <div class="form-group">
                                <h5 class="number" style="font-size: 30px; font-weight: 700">{{number_format(($cabang-1),0,',','.')}} <span class="keterangan" style="font-size: 20px;"> CABANG</span> </h5>
                            </div>
                            <div class="form-group">
                                <a href="#" data-toggle="modal" data-target="#modallembaga"><h5 class="number" style="font-size: 30px; font-weight: 700">{{number_format($lembaga,0,',','.')}} <span class="keterangan" style="font-size: 20px;"> LEMBAGA</span> </h5></a>
                            </div>
                            <div class="form-group">
                                <h5 class="number" style="font-size: 30px; font-weight: 700">{{number_format($kpa,0,',','.')}} <span class="keterangan" style="font-size: 20px;"> KPA</span> </h5>
                            </div>
                            <div class="form-group">
                                @if (auth()->user()->role == 'pusat')
                                <a href="#"><h5 class="number" style="font-size: 30px; font-weight: 700">{{number_format($trainer_instruktur,0,',','.')}} <span class="keterangan" style="font-size: 20px;"> TRAINER</span> </h5></a>
                                @else
                                <h5 class="number" style="font-size: 30px; font-weight: 700">{{number_format($trainer_instruktur,0,',','.')}} <span class="keterangan" style="font-size: 20px;"> TRAINER</span> </h5>
                                @endif
                            </div>
                            <div class="form-group">
                                <h5 class="number" style="font-size: 30px; font-weight: 700">{{number_format($total_munaqisy,0,',','.')}} <span class="keterangan" style="font-size: 20px;"> MUNAQISY</span> </h5>
                            </div>
                            <div class="form-group">
                                <h5 class="number" style="font-size: 30px; font-weight: 700">{{number_format($total_supervisor,0,',','.')}} <span class="keterangan" style="font-size: 20px;"> SUPERVISOR</span> </h5>
                            </div>
                        </div>


                        <div class="col-sm-12">
                            {{-- <h5 class="number" style="font-size: 30px; font-weight: 700">{{number_format(($cabang-1),0,',','.')}} <span class="keterangan" style="font-size: 20px;"> CABANG</span> </h5> --}}
                        </div>
                        <div class="col-sm-12">
                            {{-- <h5 class="number" style="font-size: 30px; font-weight: 700">{{number_format($lembaga,0,',','.')}} <span class="keterangan" style="font-size: 20px;"> LEMBAGA</span> </h5> --}}
                        </div>
                        <div class="col-sm-12">
                            {{-- <h5 class="number" style="font-size: 30px; font-weight: 700">{{number_format($kpa,0,',','.')}} <span class="keterangan" style="font-size: 20px;"> KPA</span> </h5> --}}
                        </div>
                        <div class="col-sm-12">
                            {{-- <h5 class="number" style="font-size: 30px; font-weight: 700">{{number_format($santri,0,',','.')}} <span class="keterangan" style="font-size: 20px;"> SANTRI</span> </h5> --}}
                        </div>
                        <div class="col-sm-12">
                            {{-- <h5 class="number" style="font-size: 30px; font-weight: 700">{{number_format($guru,0,',','.')}} <span class="keterangan" style="font-size: 20px;"> GURU </span> </h5> --}}
                        </div>
                        <div class="col-sm-6">
                            {{-- <h5 class="number" style="font-size: 30px; font-weight: 700">{{number_format($trainer,0,',','.')}} <span class="keterangan" style="font-size: 20px;"> TRAINER</span> </h5> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="col-md-6">
            <div class="row">
               
            </div>
        </div> --}}
        <div class="col-xl-3 col-md-6">
            <div class="card" style="min-height: 250px">
                <div class="card-body">
                    <figure class="highcharts-figure" style="max-width: 100%">
                        <div id="container" style="max-width: 100%"></div>
                    </figure>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card" style="min-height: 250px">
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="container2"></div>
                    </figure>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-md-12">
            {{-- tes --}}
            {{--  --}}
            <div class="card">
                @if(Session::has('fail'))
                    <div class="col-lg-12 alert alert-danger">
                    {{Session::get('fail')}}
                    </div>
                @endif
                <div class="row p-3">
                    <div class="col-6 col-xl-4 form-group">
                        <label>Dari :</label>
                        <input type="date" name="dari" id="dari"  class="form-control">
                        <span class="red dari" style="color: red"></span>
                    </div>
                    <div class="col-6 col-xl-4 form-group">
                        <label>Sampai :</label>
                        <input type="date" name="sampai" id="sampai"  class="form-control">
                        <span class="red sampai" style="color: red"></span>
                    </div>
                    <div class="form-group col-6 col-xl-2">
                        <label for="">Cari :</label>
                        <button class="btn btn-rounded form-control text-white" style="background-color: rgb(137, 137, 253)" name="filter" id="filter"> <i
                                class="fa fa-search"></i></button>
                    </div>
                    <div class="form-group col-6 col-xl-2">
                        <label for="">Reset :</label>
                        <button class="btn btn-rounded btn-danger form-control" name="refresh" id="refresh"> <i
                                class="fa fa-stop"></i></button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body" style="min-height: 500px">
                    <div id="map" style="height: 500px"></div>
                </div>
            </div>
        </div>

        {{-- <div class="col-xl-12">
            <div class="card">
                <div class="row card-body">
                    <div class="col-12 col-xl-3 form-group">
                        <label>Dari :</label>
                        <input type="month" name="dari" id="dari" class="form-control">
                        <span class="red dari" style="color: red"></span>
                    </div>
                    <div class="col-12 col-xl-3 form-group">
                        <label>Sampai :</label>
                        <input type="month" name="sampai" id="sampai" class="form-control">
                        <span class="red sampai" style="color: red"></span>
                    </div>
                    <div class="form-group col-12 col-xl-3">
                        <label for="">Cari :</label>
                        <button class="btn btn-rounded form-control text-white" style="background-color: rgb(137, 137, 253)"
                            name="filter" id="filter" onclick="search()"> <i class="fa fa-search"></i></button>
                    </div>
                    <div class="form-group col-12 col-xl-3">
                        <label for="">Reset :</label>
                        <button class="btn btn-rounded btn-danger form-control" name="refresh" id="refresh"> <i
                                class="fa fa-stop"></i></button>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="col-xl-6">
            <div class="card" style="min-height: 250px">
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="container3"></div>
                    </figure>
                </div>
            </div>
        </div>


        <div class="col-xl-6">
            <div class="card" style="min-height: 250px">
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="container4"></div>
                    </figure>
                </div>
            </div>
        </div>
        
    </div>



    {{-- <div class="row">
        
        
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="mt-0 header-title mb-4 text-uppercase">DATA DIKLAT</h5>
                    <div class="panel-body show-chart2">
                        <canvas id="myChart" height="350" width="600"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="mt-0 header-title mb-4 text-uppercase">DATA PESERTA DIKLAT</h5>
                    <div class="panel-body show-chart">
                        <canvas id="canvas" height="350" width="600"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div> --}}
    <!-- end row -->
    <!-- modal cabang -->
    <div class="modal fade bs-example-modal-xl" id="mod_cabang" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">DAFTAR CABANG</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                        <table id="datatable-buttons" class="table cab table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead class="text-bold text-primary">
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Kepala</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten</th>
                                    <th>Telephone</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody style="text-transform: uppercase; font-size: 12px">
                            </tbody>

                            <tfoot class="text-bold text-primary">
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Kepala</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten</th>
                                    <th>Telephone</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
                        </table>
                        <footer class="blockquote-footer">Updated at <cite title="Source Title">2021</cite></footer>
                    </blockquote>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- <div class="modal fade bs-example-modal-xl-3" id="mod_cabang3" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">DAFTAR KABUPATEN DARI CABANG</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="text" id="id" class="form-control">
                    <footer class="blockquote-footer">Updated at <cite title="Source Title">2021</cite></footer>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div> --}}

    <div class="modal fade bs-example-modal-xl-3" id="modallembaga" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">DATA SANTRI & GURU LEMBAGA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="font-weight: bold">
                    <div class="modal-body" style="font-weight: bold">
                        <div class="form-group">
                            SANTRI LEMBAGA : <span id="santri_lembaga"></span>
                        </div>
                        <div class="form-group">
                            GURU LEMBAGA : <span id="guru_lembaga"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade bs-example-modal-xl-3" id="modalsantri" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">KETERANGAN SANTRI</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="font-weight: bold">
                    <div class="form-group">
                        LULUS : <span id="santri_lulus"></span>
                    </div>
                    <div class="form-group">
                        BELUM LULUS : <span id="santri_belum_lulus"></span>
                    </div>
                    {{-- <div class="form-group">
                        <button class="btn btn-sm btn-primary" style="width:100%">UNDUH DATA</button>
                    </div> --}}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade bs-example-modal-xl-3" id="modalguru" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">KETERANGAN GURU</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="font-weight: bold">
                    <div class="form-group">
                        LULUS : <span id="guru_lulus"></span>
                    </div>
                    <div class="form-group">
                        BELUM LULUS : <span id="guru_belum_lulus"></span>
                    </div>
                    {{-- <div class="form-group">
                        <button class="btn btn-sm btn-primary" style="width:100%">UNDUH DATA</button>
                    </div> --}}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade bs-example-modal-xl-3" id="modalinstruktur" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">KETERANGAN INSTRUKTUR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="font-weight: bold">
                    <div class="form-group">
                        LULUS : <span id="instruktur_lulus"></span>
                    </div>
                    <div class="form-group">
                        BELUM LULUS : <span id="instruktur_belum_lulus"></span>
                    </div>
                    {{-- <div class="form-group">
                        <button class="btn btn-sm btn-primary" style="width:100%">UNDUH DATA</button>
                    </div> --}}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade bs-example-modal-xl-3" id="modalsantri" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">KETERANGAN SANTRI</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="font-weight: bold">
                    <div class="form-group">
                        LULUS : <span id="santri_lulus"></span>
                    </div>
                    <div class="form-group">
                        BELUM LULUS : <span id="santri_belum_lulus"></span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-sm btn-primary" style="width:100%">UNDUH DATA</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade bs-example-modal-xl-1" id="mod_cabang2" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">DAFTAR CABANG YANG MENGADAKAN DIKLAT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="/export-laporan-data-perkembangan" method="POST"> @csrf
                    <input type="hidden" id="dari1" name="dari" class="form-control">
                    <input type="hidden" id="sampai1" name="sampai" class="form-control">
                    <button class="btn btn-sm btn-info" style="width: 100%">DOWNLOAD DATA</button>
                </form>
                
                <div class="modal-body">
                    {{-- <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive"> --}}
                        {{-- <div style="text-align: center">
                            <form action="/export-laporan-data-cabang" method="POST">@csrf
                                <input type="text" id="dari_download" name="dari" class="form-control mb-2" readonly>
                                <input type="text" id="sampai_download" name="sampai" class="form-control mb-2" readonly>
                                <button type="submit" class="btn btn-sm btn-primary">DOWNLOAD DATA</button>
                            </form>
                        </div> --}}
                        <table id="datatable-buttons2" class="table table-diklat-cabang table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; max-width:100%">
                            <thead class="text-bold text-primary">
                                <tr>
                                    <th>CABANG</th>
                                    <th>TOTAL DIKLAT</th>
                                    {{-- <th>PROGRAM DIKLAT</th> --}}
                                    <th>GURU</th>
                                    <th>SANTRI</th>
                                    <th>KPA</th>
                                    <th>TRAINER</th>
                                    <th>MUNAQISY</th>
                                    <th>SUPERVISIOR</th>
                                </tr>
                            </thead>
    
                            <tbody style="text-transform: uppercase; font-size: 12px">
                            </tbody>
    
                            <tfoot class="text-bold text-primary">
                                <tr>
                                    <th>CABANG</th>
                                    <th>TOTAL</th>
                                    {{-- <th>PROGRAM DIKLAT</th> --}}
                                    <th>GURU</th>
                                    <th>SANTRI</th>
                                    <th>KPA</th>
                                    <th>TRAINER</th>
                                    <th>MUNAQISY</th>
                                    <th>SUPERVISIOR</th>
                                </tr>
                            </tfoot>
                        </table>
                        <footer class="blockquote-footer">Updated at  <cite title="Source Title">2021</cite></footer>
                    {{-- </blockquote> --}}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('script')
    <!--Toast-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- Required datatable js -->
    <script src="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/pdfmake/pdfmake.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ URL::asset('tilawatipusat/js/pages/datatables.init.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

    <!-- High Chart -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
    integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
    crossorigin=""></script>
    <script>
        var id_prov;

        

        $('#mod_cabang3').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            id_prov = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id_prov);
        })

        $(document).ready(function() {
            load_data();
            // data_cabang();
            function load_data(dari = '', sampai = '') {
                $('#btnlaporan').on('click', function () {
                    $('.table-diklat-cabang').DataTable({
                        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                        "columnDefs": [
                            { "type": "numeric-comma", targets: "_all" }
                        ],
                        destroy: true,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url:'{{ route("diklat.peserta_cabang_pilih") }}',
                            data:{dari:dari, sampai:sampai}
                        },
                        columns: [
                            {
                            data:'cabang',
                            name:'name'
                            },
                            {
                            data:'jumlahdiklat',
                            name:'jumlahdiklat'
                            },
                            // {
                            // data:'namadiklat',
                            // name:'namadiklat'
                            // },
                            {
                            data:'total_guru',
                            name:'total_guru'
                            },
                            {
                            data:'total_santri',
                            name:'total_santri'
                            },
                            {
                            data:'kpa',
                            name:'kpa'
                            },
                            {
                            data:'trainer',
                            name:'trainer'
                            },
                            {
                            data:'munaqisy',
                            name:'munaqisy'
                            },
                            {
                            data:'supervisor',
                            name:'supervisor'
                            },
                        ]
                    });
                });

                $.ajax({
                    url: '/search-infografis-data',
                    data: {
                        dari: dari,
                        sampai: sampai
                    },
                    type: 'get',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('#total_santri').html(data.santri + ' ' + '<span class="keterangan" style="font-size: 20px;"> SANTRI</span>');
                        $('#total_guru').html(data.guru + '' + '<span class="keterangan" style="font-size: 20px;"> GURU</span>');
                        $('#total_instruktur').html(data.instruktur + '' + '<span class="keterangan" style="font-size: 20px;"> INSTRUKTUR</span>');
                        $('#santri_lulus').html(data.santri_lulus + '' + '<span class="keterangan" style="font-size: 20px;"> SANTRI</span>');
                        $('#santri_belum_lulus').html(data.santri_tak_lulus + '' + '<span class="keterangan" style="font-size: 20px;"> SANTRI</span>');
                        $('#guru_lulus').html(data.guru_lulus + '' + '<span class="keterangan" style="font-size: 20px;"> GURU</span>');
                        $('#guru_belum_lulus').html(data.guru_tak_lulus + '' + '<span class="keterangan" style="font-size: 20px;"> GURU</span>');
                        $('#instruktur_lulus').html(data.instruktur_lulus + '' + '<span class="keterangan" style="font-size: 20px;"> INSTRUKTUR</span>');
                        $('#instruktur_belum_lulus').html(data.instruktur_tak_lulus + '' + '<span class="keterangan" style="font-size: 20px;"> INSTRUKTUR</span>');
                        $('#santri_lembaga').html(data.jml_santri + '' + '<span class="keterangan" style="font-size: 20px;"> SANTRI</span>');
                        $('#guru_lembaga').html(data.jml_guru + '' + '<span class="keterangan" style="font-size: 20px;"> GURU</span>');
                        toastr.success('Menampilkan Data');
                    }
                });

                $.ajax({
                    url: '{{ route("chart.perkembangan.bulanan") }}',
                    data: {
                        dari: dari,
                        sampai: sampai
                    },
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        Highcharts.chart('container4', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                align: 'left',
                                text: '<h2 style="text-transform:uppercase">Perkembangan Pengguna Metode Tilawati</h2>'
                            },
                            subtitle: {
                                align: 'left',
                                text: '<p>data diambil berdasarkan peserta diklat yang mendaftar online maupun offline pada tiap cabang yang tersebar di seluruh penjuru wilayah indonesia</p>'
                            },
                            accessibility: {
                                announceNewData: {
                                    enabled: true
                                }
                            },
                            xAxis: {
                                // type: 'category'
                                categories : response.namabulan
                            },
                            yAxis: {
                                title: {
                                    text: 'Total Pengguna Tilawati'
                                }

                            },
                            legend: {
                                enabled: false
                            },
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                    }
                                }
                            },

                            tooltip: {
                                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
                            },
                            
                            series: [
                                {
                                    name: "Pengguna Tilawati : ",
                                    colorByPoint: true,
                                    data: response.totalbulanan
                                }
                            ],
                        });
                    }
                });
            }

            $('#dari').on('change', function () {
                var x = document.getElementById("dari").value;
                document.getElementById("dari1").value = x;
            })

            $('#sampai').on('change',function(){
                var y = document.getElementById("sampai").value;
                document.getElementById("sampai1").value = y;
            })

            $('#filter').click(function() {
                var dari = $('#dari').val();
                var sampai = $('#sampai').val();
                if (dari != '' && sampai != '') {
                    // $('#datatable').DataTable().destroy();
                    load_data(dari, sampai);
                } else {
                    alert('Both Date is required');
                }
            });

            $('#refresh').click(function() {
                $('#dari').val('');
                $('#sampai').val('');
                $('#dari1').val('');
                $('#sampai1').val('');
                // $('#datatable').DataTable().destroy();
                load_data();
                // data_cabang();
                getDataForChart();
                getDataForChart2();
                toastr.warning('Mereset Data');
            });
        });
    </script>
    {{-- chart --}}
    <script>
        $(document).ready(function() {
            //mengambil data chart
            getDataForChart();
            getDataForChart2();

        });

        //berdasarkan pencarian data
        function search() {
            $(".sampai").text('');
            $(".dari").text('');
            let rage = {
                start: $('#dari').val(),
                finish: $('#sampai').val(),
                type: 'search'
            }
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('dashboard.chart') }}",
                data: rage,
                dataType: "JSON",
                success: function(response) {
                    if (response.status == 'error') {
                        $(".sampai").text(response.errors.finish);
                        $(".dari").text(response.errors.start);
                    } else {
                        // make_chart(response.content.monthNames, response.content.peserta);
                        console.log(response.content.peserta);
                    }

                }
            });
            //search2
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('dashboard.chart2') }}",
                data: rage,
                dataType: "JSON",
                success: function(response) {
                    if (response.status == 'error') {
                        $(".sampai").text(response.errors.finish);
                        $(".dari").text(response.errors.start);
                    } else {
                        // make_chart2(response.content.monthNames2, response.content.pel);
                    }

                }
            });
        }

        function getDataForChart() {
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('dashboard.chart') }}",
                data: {
                    type: 'all'
                },
                dataType: "JSON",
                success: function(response) {
                    // make_chart(response.content.monthNames, response.content.peserta);
                }
            });
        };

        function getDataForChart2() {
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('dashboard.chart2') }}",
                data: {
                    type: 'all'
                },
                dataType: "JSON",
                success: function(response) {
                    // make_chart2(response.content.monthNames2, response.content.pel);
                    console.log(response.content.pel);
                }
            });
        };

        // function make_chart(monthNames, peserta) {
        //     $('.show-chart').html('');
        //     //membuat chart baru
        //     $('.show-chart').html(`<canvas id="canvas" height="350" width="600"></canvas>`)
        //     var ctx = document.getElementById('canvas').getContext('2d');
        //     var myChart = new Chart(ctx, {
        //         type: 'bar',
        //         data: {
        //             labels: monthNames,
        //             datasets: [{
        //                 label: 'JUMLAH PESERTA DIKLAT',
        //                 backgroundColor: "rgb(185, 124, 243)",
        //                 data: peserta,
        //                 borderColor: "rgb(91, 233, 138)",
        //                 borderWidth: 1
        //             }]
        //         },
        //         options: {
        //             scales: {
        //                 y: {
        //                     beginAtZero: true
        //                 }
        //             }
        //         }
        //     });
        // };

        // function make_chart2(monthNames2, pel) {
        //     $('.show-chart2').html('');
        //     //membuat chart baru
        //     $('.show-chart2').html(`<canvas id="myChart" height="350" width="600"></canvas>`)
        //     var ctx = document.getElementById('myChart').getContext('2d');
        //     var myChart = new Chart(ctx, {
        //         type: 'line',
        //         data: {
        //             labels: monthNames2,
        //             datasets: [{
        //                 label: 'JUMLAH DIKLAT',
        //                 backgroundColor: "rgb(114, 228, 203)",
        //                 data: pel,
        //                 borderColor: "rgb(91, 233, 138)",
        //                 borderWidth: 1
        //             }]
        //         },
        //         options: {
        //             scales: {
        //                 y: {
        //                     beginAtZero: true
        //                 }
        //             }
        //         }
        //     });
        // }

        $('#generate').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('generate_qr_tilawati') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btngenerate').attr('disabled', 'disabled');
                    $('#btngenerate').val('Proses Generate QR');
                },
                success: function(data) {
                    if (data.success) {
                        toastr.success(data.success);
                        $('#btngenerate').val('Generate');
                        $('#btngenerate').attr('disabled', false);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        swal({
                            title: "Success!",
                            text: "QR Berhasil Dibuat!",
                            type: "success"
                        })
                    }
                    if (data.error) {
                        $('#message').html('<div class="alert alert-danger">' + data.error + '</div>');
                        $('#z').attr('disabled', false);
                        $('#z').val('Import');
                    }
                },
                error: function(data) {
                    // console.log(data);
                }
            });
        });
    </script>

    <!--High Chart-->
    <script>

        $(document).ready(function() {
            formal();
            non_formal();
            pengguna();
            pengguna_bulanan();
        })
        

        function formal()
        {
            $.ajax({
                url: '{{ route("chart.lembaga.formal") }}',
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    Highcharts.chart('container', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'LEMBAGA FORMAL'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        accessibility: {
                            point: {
                                valueSuffix: '%'
                            }
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.percentage:.1f} %'
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: [
                                {
                                name: 'PT / PTS / PTN',
                                y: data.formal_ptn,
                               
                                }, 
                                {
                                    name: 'SMA / MA',
                                    y: data.formal_sma
                                },
                                {
                                    name: 'SMP / MTs',
                                    y: data.formal_smp
                                }, 
                                {
                                    name: 'SD / MI',
                                    y: data.formal_sd
                                }, 
                                {
                                    name: 'TK',
                                    y: data.formal_tk,
                                    sliced: true,
                                    selected: true
                                }, 
                                
                            ]
                        }]
                    });
                }
            });
        }

        function non_formal()
        {
            $.ajax({
                url: '{{ route("chart.lembaga.nonformal") }}',
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    Highcharts.chart('container2', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'LEMBAGA NON FORMAL'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        accessibility: {
                            point: {
                                valueSuffix: '%'
                            }
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.percentage:.1f} %'
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: [
                                {
                                name: 'PONDOK PESANTREN',
                                y: data.pondok,
                               
                                }, 
                                {
                                    name: 'MADRASAH DINIYAH',
                                    y: data.madrasah
                                },
                                {
                                    name: "MAJLIS TA'LIM",
                                    y: data.majlis
                                }, 
                                {
                                    name: 'TPQ',
                                    y: data.tpq
                                }, 
                                {
                                    name: 'PRIVATE & BBAQ',
                                    y: data.private,
                                }, 
                                {
                                    name: 'NON FORMAL LAIN',
                                    y: data.lainnya,
                                    sliced: true,
                                    selected: true
                                }, 
                                
                            ]
                        }]
                    });
                }
            });
        }

        function pengguna()
        {
            $.ajax({
                url: '{{ route("chart.perkembangan.pengguna") }}',
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    // console.log(response.tahunan, '-' ,response.tahun);
                    Highcharts.chart('container3', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            align: 'left',
                            text: '<h2 style="text-transform:uppercase">Perkembangan Pengguna Metode Tilawati</h2>'
                        },
                        subtitle: {
                            align: 'left',
                            text: '<p>data diambil berdasarkan peserta diklat yang mendaftar online maupun offline pada tiap cabang yang tersebar di seluruh penjuru wilayah indonesia</p>'
                        },
                        accessibility: {
                            announceNewData: {
                                enabled: true
                            }
                        },
                        xAxis: {
                            // type: 'category'
                            categories : response.tahun
                        },
                        yAxis: {
                            title: {
                                text: 'Total Pengguna Tilawati'
                            }

                        },
                        legend: {
                            enabled: false
                        },
                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                }
                            }
                        },

                        tooltip: {
                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
                        },
                        
                        series: [
                            {
                                name: "Pengguna Tilawati : ",
                                colorByPoint: true,
                                data: response.tahunan
                            }
                        ],
                    });
                }
            });
        }


        function pengguna_bulanan()
        {
            $.ajax({
                url: '{{ route("chart.perkembangan.bulanan") }}',
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    console.log(response.namabulan, '-' ,response.totalbulanan);
                    
                    Highcharts.chart('container4', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            align: 'left',
                            text: '<h2 style="text-transform:uppercase">Perkembangan Pengguna Metode Tilawati</h2>'
                        },
                        subtitle: {
                            align: 'left',
                            text: '<p>data diambil berdasarkan peserta diklat yang mendaftar online maupun offline pada tiap cabang yang tersebar di seluruh penjuru wilayah indonesia</p>'
                        },
                        accessibility: {
                            announceNewData: {
                                enabled: true
                            }
                        },
                        xAxis: {
                            // type: 'category'
                            categories : response.namabulan
                        },
                        yAxis: {
                            title: {
                                text: 'Total Pengguna Tilawati'
                            }

                        },
                        legend: {
                            enabled: false
                        },
                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                }
                            }
                        },

                        tooltip: {
                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
                        },
                        
                        series: [
                            {
                                name: "Pengguna Tilawati : ",
                                colorByPoint: true,
                                data: response.totalbulanan
                            }
                        ],
                    });
                }
            });
        }
    </script>

    {{-- MAP --}}
    <script type="text/javascript">
        // MAPS 
        var map = L.map('map').setView([-4.1273358,120.137288], 5);
        var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 100,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var myIcon = L.icon({
            iconUrl : '<?= asset('pin_maps.png')?>',
            iconSize: [20,25],
        })
        // GET DATA CABANG
        $.ajax({
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('maps.data.cabang') }}",
            // data: rage,
            dataType: "JSON",
            success: function(response) {
                $.each( response.maps_cabang, function( key, value ) {
                    if (value.id == '79') {
                        var marker = L.marker([value.lng,value.lat]).addTo(map)
                        .bindPopup('<b>'+value.name+'</b> <br />Kepala : '+value.kepalacabang+' <br />Alamat : '+value.alamat+' <br /> Telp : '+value.telp+'').openPopup();
                    }else{
                        var marker = L.marker([value.lng,value.lat]).addTo(map)
                        .bindPopup('<b>'+value.name+'</b> <br />Kepala : '+value.kepalacabang+' <br />Alamat : '+value.alamat+' <br /> Telp : '+value.telp+'');
                    }
                    
                });
            }
        });

        // var marker = L.marker([-7.2754438,112.6426438],{
        //     // icon: myIcon
        // }).addTo(map)
        //     .bindPopup("<b>Tilawati Pusat!</b><br />Kepala : Dr. KH. Umar Jaeni, M. Pd	<br />Alamat : Pesantren Al- Qur'an Nurul Falah Surabaya. <br />Telp : 0318281278").openPopup();
    </script>
@endsection
