@extends('layouts.adm.master')
{{-- @section('head')
    
@endsection --}}
@section('content')
{{-- <div class="page-content-wrapper ">
    <div class="container-fluid"> --}}
        
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Diklat</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                        <li class="breadcrumb-item active" id="clock"></li>
                    </ol>
                </div>
                <div class="float-left page-breadcrumb">
                    <ol class="breadcrumb">
                        <span id="tgl"></span>&nbsp; <li class="breadcrumb-item active" id="bln"></li>
                        <li class="breadcrumb-item active" id="hari"></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card m-b-30">
                    <div class="card">
                        <div class="row p-3">
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
                                <button class="btn btn-rounded form-control text-white" style="background-color: rgb(137, 137, 253)" name="filter" id="filter" onclick="search()"> <i
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
            </div>
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
                            <h2 id="dk">0</h2>
                            {{-- <h5><button class="btn btn-sm text-white waves-effect waves-dark" data-toggle="modal" data-target=".bs-example-modal-lg-diklat" style="background-color: rgb(114, 228, 203)">Click Me</button></h5> --}}
                            <div class="float-left">
                                {{-- <h6 class="m-0">20 Cabang</h6> --}}
                            </div>
                            <div class="float-right">
                                {{-- <h6 class="m-0">30 Lembaga</h6> --}}
                            </div>
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
                            <h2 id="cb">0</h2>
                            {{-- <h5><button class="btn btn-sm text-white" style="background-color: rgb(75, 152, 253)">Click Me</button></h5> --}}
                        </div>
                        
                            <div class="float-left">
                                {{-- <p class="m-0">50 Guru</p> --}}
                            </div>
                            <div class="float-right">
                                {{-- <p class="m-0">30 Santri</p> --}}
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
                            <h2 id="lb">0</h2>
                            {{-- <h5><button class="btn btn-sm text-white" style="background-color: rgb(124, 152, 243)">Click Me</button></h5> --}}
                        </div>
                        
                            <div class="float-left">
                                {{-- <p class="m-0">50 Guru</p> --}}
                            </div>
                            <div class="float-right">
                                {{-- <p class="m-0">30 Santri</p> --}}
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
                            <h2 id="pd">0</h2>
                            {{-- <button class="btn btn-sm text-white" style="background-color: rgb(185, 124, 243)">Click Me</button> --}}
                        </div>
                        
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
        <!-- end row -->
        <div class="row">
            {{-- chart2 --}}
            <div class="col-xl-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h2 class="mt-0 header-title mb-4 text-uppercase">DATA DIKLAT</h2>
                        <div class="panel-body show-chart2">
                            <canvas id="myChart" height="350" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            {{-- chart1 --}}
            <div class="col-xl-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h2 class="mt-0 header-title mb-4 text-uppercase">DATA PESERTA DIKLAT</h2>
                        <div class="panel-body show-chart">
                            <canvas id="canvas" height="350" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12" id="data_p">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h2 class="mt-0 header-title mb-4 text-uppercase">DATA DIKLAT</h2>
                        <div class="table-responsive">
							<table id="datatable_diklat" class="table datas table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Diklat</th>
                                        <th>Tanggal</th>
                                        <th>Cabang</th>
                                        <th>Tempat</th>
                                    </tr>
                                </thead>
                                <tbody class="text-capitalize"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12" id="data_p">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h2 class="mt-0 header-title mb-4 text-uppercase">DATA PESERTA DIKLAT</h2>
                        <div class="table-responsive">
                            <table id="datatable" class="table datas table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>ID Peserta</th>
                                    <th>Peserta</th>
                                    <th>Status</th>
                                    <th>Telp</th>
                                    <th>Asal</th>
                                    <th>Alamat</th>
                                    <th>Sebagai</th>
                                    <th>No. Diklat</th>
                                    <th>Diklat</th>
                                    <th>Kriteria</th>
                                </tr>
                                </thead>
                                <tbody class="text-capitalize"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div>
</div> --}}
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<script>
    //bersiap
    $(document).ready(function(){
    //load data data table
    load_data();
    function load_data(dari = '', sampai = '')
    {
        $.ajax({
            url:'{{ route("dashboard.diklat") }}',
            data:{dari:dari, sampai:sampai},
            type: 'get',
            dataType: 'json',
            success:function(data) {
                document.getElementById('dk').innerHTML = data;
                console.log(data);
            }
        });
        $.ajax({
            url:'{{ route("dashboard.peserta") }}',
            data:{dari:dari, sampai:sampai},
            type: 'get',
            dataType: 'json',
            success:function(data) {
                document.getElementById('pd').innerHTML = data;
                console.log(data);
            }
        });
        $.ajax({
            url:'{{ route("dashboard.cabang") }}',
            data:{dari:dari, sampai:sampai},
            type: 'get',
            dataType: 'json',
            success:function(data) {
                document.getElementById('cb').innerHTML = data;
                console.log(data);
            }
        });
        $.ajax({
            url:'{{ route("dashboard.lembaga") }}',
            data:{dari:dari, sampai:sampai},
            type: 'get',
            dataType: 'json',
            success:function(data) {
                document.getElementById('lb').innerHTML = data;
                console.log(data);
            }
        });
        //diklat
        $('#datatable_diklat').DataTable({
        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: {
            url:'{{ route("dashboard.diklat_data") }}',
            data:{dari:dari, sampai:sampai}
        },
        columns: [
            {
                data:'id',
                name:'id',
            },
            {
            data:'name',
            name:'name'
            },
            {
            data:'tanggal',
            name:'tanggal'
            },
            {
            data:'cabang',
            name:'cabang'
            },
            {
            data:'tempat',
            name:'tempat'
            },
        ]
        });
        //peserta diklat
        $('#datatable').DataTable({
        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: {
            url:'{{ route("peserta.filter") }}',
            data:{dari:dari, sampai:sampai}
        },
        columns: [
            {
            data:'id',
            name:'id'
            },
            {
            data:'name',
            name:'name'
            },
            {
            data:'bersyahadah',
            name:'bersyahadah',
            render: function(data) { 
                if(data==1) {
                  return '<span class="badge badge-primary">Bersyahadah</span>'; 
                }
                else {
                  return '<span class="badge badge-danger">Belum Bersyahadah</span>';
                }

              },
            },
            {
            data:'telp',
            name:'telp'
            },
            {
            data:'kota',
            name:'kota'
            },
            {
            data:'alamat',
            name:'alamat'
            },
            {
            data:'sebagai',
            name:'sebagai'
            },
            {
            data:'pelid',
            name:'pelid'
            },
            {
            data:'pelatihan',
            name:'pelatihan'
            },
            {
            data:'kriteria',
            name:'kriteria'
            },
            
        ]
        });
    }
    $('#filter').click(function(){
        var dari = $('#dari').val();
        var sampai = $('#sampai').val();
        if(dari != '' &&  sampai != '')
        {
            $('#datatable').DataTable().destroy();
            load_data(dari, sampai);
        }
        else
        {
            alert('Both Date is required');
        }
    });


    $('#refresh').click(function(){
        $('#dari').val('');
        $('#sampai').val('');
        $('#datatable').DataTable().destroy();
        load_data();
        getDataForChart();
        getDataForChart2();
    });

});
</script>

<script>
    $(document).ready(function () {
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
            type:'search'
        }
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('dashboard.chart') }}",
            data: rage,
            dataType: "JSON",
            success: function (response) {
                if (response.status=='error') {
                    $(".sampai").text(response.errors.finish);
                    $(".dari").text(response.errors.start);
                } else{
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
            success: function (response) {
                if (response.status=='error') {
                    $(".sampai").text(response.errors.finish);
                    $(".dari").text(response.errors.start);
                } else{
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
            data:{type:'all'},
            dataType: "JSON",
            success: function (response) {
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
            data:{type:'all'},
            dataType: "JSON",
            success: function (response) {
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
</script>

@endsection
