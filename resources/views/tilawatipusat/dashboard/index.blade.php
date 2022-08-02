@extends('layouts.tilawatipusat_layouts.master')

@section('title') Dashboard @endsection
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

    <!-- High Chart -->
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 320px;
            max-width: 660px;
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
    </style>

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-tilawatipusat.breadcrumb')
        @slot('title') Dashboard @endslot
        @slot('title_li') @endslot
    @endcomponent
    <div class="row">
        <div class="col-xl-3">
            <div class="card" style="min-height: 250px">
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                    </figure>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card" style="min-height: 250px">
                <div class="card-body">
                    @php
                        $jenjang1 = App\Models\Lembaga::select('jenjang')->distinct()->get();
                        $jenjang = App\Models\Lembaga::where('jenjang','PAUD/KB')->get();
                    @endphp
                    {{$jenjang1}}{{$jenjang1->count()}}
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card" style="min-height: 250px">
                <div class="card-body">
                    
                    {{$jenjang}}
                </div>
            </div>
        </div>
        
        <div class="col-xl-6">
            <div class="card" style="min-height: 250px">
                <div class="card-body">
                    <div class="">
                        <p class="text-info text-uppercase" style="font-size: 20px"><i class="fas fa-quote-left h4 text-primary" ></i> {{ $diklat_ini }} Kegiatan Terbaru</p>
                    </div>
                    <div id="reviewExampleControls" class="carousel slide review-carousel" data-ride="carousel">
                        <div class="carousel-inner">
                            @if ($diklat->count() == 0)
                                <p class="text-danger">BELUM ADA KEGIATAN DIKLAT BARU</p>
                            @else
                                @foreach ($diklat as $key => $item)
                                    <div class="carousel-item @if ($key == 0) active @endif text-capitalize">
                                        <div>
                                            <p>Diklat {{ $item->program->name }} <br> Pada :
                                                <b>{{ Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y') }},
                                                </b> {{ $item->tempat }}, diikuti <b>{{ $item->peserta->count() }}
                                                    peserta </b>
                                            </p>
                                            <div class="media mt-4">
                                                <div class="avatar-sm mr-3">
                                                    <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                        {{ $key + 1 }}
                                                    </span>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="font-size-16 mb-1">{{ $item->cabang->status }}</h5>
                                                    <p class="mb-2 text-uppercase">{{ $item->cabang->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <a class="carousel-control-prev" href="#reviewExampleControls" role="button" data-slide="prev">
                            <i class="mdi mdi-chevron-left carousel-control-icon"></i>
                        </a>
                        <a class="carousel-control-next" href="#reviewExampleControls" role="button" data-slide="next">
                            <i class="mdi mdi-chevron-right carousel-control-icon"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="row card-body">
                    <div class="col-12 col-xl-3 form-group">
                        <label>Dari :</label>
                        <input type="date" name="dari" id="dari" class="form-control">
                        <span class="red dari" style="color: red"></span>
                    </div>
                    <div class="col-12 col-xl-3 form-group">
                        <label>Sampai :</label>
                        <input type="date" name="sampai" id="sampai" class="form-control">
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

           

        </div>
        {{-- <div class="row"> --}}
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
       
    </div>
    <div class="row">
    </div>
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

    <div class="modal fade bs-example-modal-xl-3" id="mod_cabang3" tabindex="-1" role="dialog"
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
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>


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
                
                $.ajax({
                    url: '{{ route('diklat.cabang_tot') }}',
                    data: {
                        dari: dari,
                        sampai: sampai
                    },
                    type: 'get',
                    dataType: 'json',
                    success: function(data) {
                        document.getElementById('cb').innerHTML = data;
                        console.log(data);
                    }
                });

               
                //lembaga
                $.ajax({
                    url: '{{ route('diklat.lembaga_kab') }}',
                    data: {
                        dari: dari,
                        sampai: sampai
                    },
                    type: 'get',
                    dataType: 'json',
                    success: function(data) {
                        document.getElementById('lmkb').innerHTML = data;
                        console.log(data);
                    }
                });

                $.ajax({
                    url: '{{ route('diklat.lembaga_pro') }}',
                    data: {
                        dari: dari,
                        sampai: sampai
                    },
                    type: 'get',
                    dataType: 'json',
                    success: function(data) {
                        document.getElementById('lmpv').innerHTML = data;
                        console.log(data);
                    }
                });

                $.ajax({
                    url: '{{ route('diklat.lembaga_tot') }}',
                    data: {
                        dari: dari,
                        sampai: sampai
                    },
                    type: 'get',
                    dataType: 'json',
                    success: function(data) {
                        document.getElementById('lm').innerHTML = data;
                        console.log(data);
                    }
                });
            }

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
                // $('#datatable').DataTable().destroy();
                load_data();
                data_cabang();
                getDataForChart();
                getDataForChart2();
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
                        make_chart(response.content.monthNames, response.content.peserta);
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
                        make_chart2(response.content.monthNames2, response.content.pel);
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
                    make_chart(response.content.monthNames, response.content.peserta);
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
                    make_chart2(response.content.monthNames2, response.content.pel);
                    console.log(response.content.pel);
                }
            });
        };

        function make_chart(monthNames, peserta) {
            $('.show-chart').html('');
            //membuat chart baru
            $('.show-chart').html(`<canvas id="canvas" height="350" width="600"></canvas>`)
            var ctx = document.getElementById('canvas').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: monthNames,
                    datasets: [{
                        label: 'JUMLAH PESERTA DIKLAT',
                        backgroundColor: "rgb(185, 124, 243)",
                        data: peserta,
                        borderColor: "rgb(91, 233, 138)",
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
        };

        function make_chart2(monthNames2, pel) {
            $('.show-chart2').html('');
            //membuat chart baru
            $('.show-chart2').html(`<canvas id="myChart" height="350" width="600"></canvas>`)
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: monthNames2,
                    datasets: [{
                        label: 'JUMLAH DIKLAT',
                        backgroundColor: "rgb(114, 228, 203)",
                        data: pel,
                        borderColor: "rgb(91, 233, 138)",
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

        $('#generate').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('generate_qr_tilawati')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btngenerate').attr('disabled','disabled');
                    $('#btngenerate').val('Proses Generate QR');
                },
                success: function(data){
                    if(data.success)
                    {
                        toastr.success(data.success);
                        $('#btngenerate').val('Generate');
                        $('#btngenerate').attr('disabled',false);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        swal({ title: "Success!",
                            text: "QR Berhasil Dibuat!",
                            type: "success"})
                    }
                    if(data.error)
                    {
                        $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
                        $('#z').attr('disabled',false);
                        $('#z').val('Import');
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });
    </script>

    <!--High Chart-->
    <script>
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
                pointFormat: '{series.name}: <b>{point.percentage:.5f}%</b>'
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
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: [{
                    name: 'Chrome',
                    y: 61.41,
                    sliced: true,
                    selected: true
                }, {
                    name: 'Internet Explorer',
                    y: 11.84
                }, {
                    name: 'Firefox',
                    y: 10.85
                }, {
                    name: 'Edge',
                    y: 4.67
                }, {
                    name: 'Safari',
                    y: 4.18
                }, {
                    name: 'Other',
                    y: 7.05
                }]
            }]
        });
    </script>
@endsection
