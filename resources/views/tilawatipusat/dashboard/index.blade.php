@extends('layouts.tilawatipusat_layouts.master')

@section('title') Dashboard @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <style>

    </style>
@endsection

@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') Dashboard   @endslot
         @slot('title_li')   @endslot
     @endcomponent
     <div class="row">
        <div class="col-xl-7">
            <div class="card" style="min-height: 265px">
                <div class="card-body">
                    <div class="mb-4 card-title">
                        <p><span class="text-primary"> {{ $diklat_ini }} </span> Kegiatan Diklat Terbaru</p>
                    </div>
                    <div class="mb-4">
                        <i class="fas fa-quote-left h4 text-primary"></i>
                    </div>
                    <div id="reviewExampleControls" class="carousel slide review-carousel" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($diklat as $key=>$item)
                                <div class="carousel-item @if($key==1) active @endif text-capitalize">
                                    <div>
                                        <p>Diklat {{ $item->program->name }}, pada : <b>{{ Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y') }}, </b>di {{ $item->tempat }}, diikuti <b>{{ $item->peserta->count() }} peserta </b></p>
                                        <div class="media mt-4">
                                            <div class="avatar-sm mr-3">
                                                <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                        {{ $key+1 }}
                                                    </span>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="font-size-16 mb-1">{{ $item->cabang->status }}</h5>
                                                <p class="mb-2">{{ $item->cabang->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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

        <div class="col-xl-5">
            @component('common-tilawatipusat.dashboard-widget')
        
            @slot('title') <a href="#"><b id="cb">5</b> <b>Cabang</b></a> <a href="#"><br> <span id="pv">10 </span> Provinsi & </a> <a href="#"><span id="kb">5 </span> Kabupaten / Kota </a> @endslot
            @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
            @slot('price')   @endslot
            
           
        @endcomponent

        @component('common-tilawatipusat.dashboard-widget')
        
            @slot('title') <a href="#"><b id="lm">5</b> <b>Lembaga</b></a> <a href=""><br> <span id="lmpv">10 </span> Provinsi & </a> <a href="#"><span id="lmkb">5 </span> Kabupaten / Kota </a> @endslot
            @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
            @slot('price')  @endslot
            
           
        @endcomponent
        </div>
        
        
    </div>
    <div class="row">
        <div class="col-xl-5">
            <div class="card">
                <div class="row card-body">
                    <div class="col-12 col-xl-12 form-group">
                        <label>Dari :</label>
                        <input type="date" name="dari" id="dari" class="form-control">
                        <span class="red dari" style="color: red"></span>
                    </div>
                    <div class="col-12 col-xl-12 form-group">
                        <label>Sampai :</label>
                        <input type="date" name="sampai" id="sampai" class="form-control">
                        <span class="red sampai" style="color: red"></span>
                    </div>
                    <div class="form-group col-12 col-xl-12">
                        <label for="">Cari :</label>
                        <button class="btn btn-rounded form-control text-white" style="background-color: rgb(137, 137, 253)" name="filter" id="filter" onclick="search()"> <i
                                class="fa fa-search"></i></button>
                    </div>
                    <div class="form-group col-12 col-xl-12">
                        <label for="">Reset :</label>
                        <button class="btn btn-rounded btn-danger form-control" name="refresh" id="refresh"> <i
                                class="fa fa-stop"></i></button>
                    </div>
                </div>
            </div>
            @component('common-tilawatipusat.dashboard-widget')
            
                @slot('title') <b id="dk">5</b> <b>Diklat</b> <br>   @endslot
                @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
                @slot('price')  @endslot
                
               
            @endcomponent
       
            @component('common-tilawatipusat.dashboard-widget')
            
                @slot('title') <b id="ps">5</b> <b>Peserta</b> <br>  @endslot
                @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
                @slot('price')  @endslot
                
               
            @endcomponent
       </div>
       <div class="col-xl-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="mt-0 header-title mb-4 text-uppercase">DATA DIKLAT</h5>
                    <div class="panel-body show-chart2">
                        <canvas id="myChart" height="350" width="600"></canvas>
                    </div>
                </div>
            </div>
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

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

        <script>
        $(document).ready(function(){
            load_data();
            function load_data(dari = '', sampai = '')
            {
             //peserta
            $.ajax({
                    url:'{{ route("diklat.peserta_tot") }}',
                    data:{dari:dari, sampai:sampai},
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        document.getElementById('ps').innerHTML = data;
                        console.log(data);
                    }
                });
            //diklat
            $.ajax({
                    url:'{{ route("diklat.diklat_tot") }}',
                    data:{dari:dari, sampai:sampai},
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        document.getElementById('dk').innerHTML = data;
                        console.log(data);
                    }
                });
            //cabang
            $.ajax({
                    url:'{{ route("diklat.cabang_kab") }}',
                    data:{dari:dari, sampai:sampai},
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        document.getElementById('kb').innerHTML = data;
                        console.log(data);
                    }
                });

                $.ajax({
                    url:'{{ route("diklat.cabang_pro") }}',
                    data:{dari:dari, sampai:sampai},
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        document.getElementById('pv').innerHTML = data;
                        console.log(data);
                    }
                });

                $.ajax({
                    url:'{{ route("diklat.cabang_tot") }}',
                    data:{dari:dari, sampai:sampai},
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        document.getElementById('cb').innerHTML = data;
                        console.log(data);
                    }
                });
            //lembaga
            $.ajax({
                    url:'{{ route("diklat.lembaga_kab") }}',
                    data:{dari:dari, sampai:sampai},
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        document.getElementById('lmkb').innerHTML = data;
                        console.log(data);
                    }
                });

                $.ajax({
                    url:'{{ route("diklat.lembaga_pro") }}',
                    data:{dari:dari, sampai:sampai},
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        document.getElementById('lmpv').innerHTML = data;
                        console.log(data);
                    }
                });

                $.ajax({
                    url:'{{ route("diklat.lembaga_tot") }}',
                    data:{dari:dari, sampai:sampai},
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        document.getElementById('lm').innerHTML = data;
                        console.log(data);
                    }
                });   
            }

            $('#filter').click(function(){
                var dari = $('#dari').val();
                var sampai = $('#sampai').val();
                if(dari != '' &&  sampai != '')
                {
                    // $('#datatable').DataTable().destroy();
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
                // $('#datatable').DataTable().destroy();
                load_data();
                getDataForChart();
                getDataForChart2();
            });
        });
        </script>
        {{-- chart --}}
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