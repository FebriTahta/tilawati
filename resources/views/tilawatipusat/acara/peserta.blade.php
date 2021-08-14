@extends('layouts.tilawatipusat_layouts.master')

@section('title') peserta | acara @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') {{ $acara->judul }}   @endslot
         @slot('title_li')   @endslot
    @endcomponent

                    <div class="row">
                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="pv"> {{ $acara->peserta->count() }} </b>  Total Peserta  @endslot
                                @slot('iconClass') mdi mdi-smart-card-outline
                                @endslot
                                @slot('price')  @endslot
                                
                            @endcomponent
                        </div>
                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="pv"> {{ App\Models\Peserta::whereHas('donatur',function($ya){
                                    $ya->where('data','=',1);
                                })->count() }} </b>  Total Donatur  @endslot
                                @slot('iconClass') mdi mdi-city-variant-outline
                                @endslot
                                @slot('price')  @endslot
                                
                            @endcomponent
                        </div>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <input type="hidden" id="acara_id" value="{{ $acara->id }}">
                                    <h4 class="card-title text-uppercase">Daftar Peserta {{ $acara->judul }}</h4>
                                    <p class="card-title-desc"> pada tanggal {{ Carbon\Carbon::parse($acara->tanggal)->isoFormat('D MMMM Y') }} </br></p>
                                    <a href="/export-peserta-acara/{{ $acara->id }}" class="btn btn-sm btn-success  mr-1" style="width:130px "><i class="mdi mdi-download"></i> Download</a>
                    
                                    <blockquote class="table-responsive blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <table id="datatable-buttons" class="table table-kriteria table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary text-capitalize">
                                                <tr>
                                                    <th>Nama Peserta</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Provinsi</th>
                                                    <th>Kabupaten</th>
                                                    <th>Kecamatan</th>
                                                    <th>Donatur</th>
                                                </tr>
                                            </thead>
    
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>

                                            <tfoot class="text-primary text-capitalize">
                                                <tr>
                                                    <th>Nama Peserta</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Provinsi</th>
                                                    <th>Kabupaten</th>
                                                    <th>Kecamatan</th>
                                                    <th>Donatur</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <footer class="blockquote-footer">Updated at  <cite title="Source Title">2021</cite></footer>
                                    </blockquote>
                    
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
        
        <!-- Required datatable js -->
        <script src="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.js')}}"></script>
        <script src="{{ URL::asset('tilawatipusat/libs/jszip/jszip.min.js')}}"></script>
        <script src="{{ URL::asset('tilawatipusat/libs/pdfmake/pdfmake.min.js')}}"></script>

        <!-- Datatable init js -->
        <script src="{{ URL::asset('tilawatipusat/js/pages/datatables.init.js')}}"></script>

        <script>
            var acara = $('#acara_id').val();
            $(document).ready(function(){

                $('#datatable-buttons').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url:'/data-peserta-acara/'+acara,
                },
                columns: [
                    
                    {
                    data:'name',
                    name:'name'
                    },
                    {
                    data:'telp',
                    name:'telp'
                    },
                    {
                    data:'email',
                    name:'email'
                    },
                    {
                    data:'provinsi',
                    name:'provinsi.nama'
                    },
                    {
                    data:'kabupaten',
                    name:'kabupaten.nama'
                    },
                    {
                    data:'kecamatan',
                    name:'kecamatan.nama'
                    },
                    {
                    data:'donatur',
                    name:'donatur.data'
                    },
                    
                ]
                });
            })
            
        </script>
@endsection