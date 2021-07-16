@extends('layouts.tilawatipusat_layouts.master')

@section('title') diklat @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="{{URL::asset('tilawatipusat/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('tilawatipusat/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('tilawatipusat/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('tilawatipusat/libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />


@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') diklat   @endslot
         @slot('title_li') TILAWATI   @endslot
    @endcomponent
    <input type="hidden" id="cabang_id" value="{{ $data->id }}">
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
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
                        <div class="col-xl-6">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b href="#" class="text-uppercase"> <b id="cb2" class="text-info"> CABANG  {{ $data->name }} </b> </b>@endslot
                                @slot('iconClass') mdi mdi-bank-outline  @endslot
                                @slot('price')  @endslot
                                
                            @endcomponent
                        </div>
                        <div class="col-xl-6">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="cb">  </b> Total Diklat @endslot
                                @slot('iconClass') mdi mdi-home-analytics  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                    
                                    <h4 class="card-title">Data Diklat</h4>
                                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br></p>
                    
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <table id="datatable-buttons" class="table table-diklat table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary" style="text-transform: capitalize">
                                                <tr>
                                                    <th>kode</th>
                                                    <th>diklat</th>
                                                    <th>tanggal</th>
                                                    
                                                    <th>tempat</th>
                                                    <th>peserta</th>
                                                </tr>
                                            </thead>
    
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>

                                            <tfoot class="text-primary" style="text-transform: capitalize">
                                                <tr>
                                                    <th>kode</th>
                                                    <th>diklat</th>
                                                    <th>tanggal</th>
                                                    
                                                    <th>tempat</th>
                                                    <th>peserta</th>
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

        <!-- Script Select2-->
        <script src="{{URL::asset('/tilawatipusat/libs/select2/select2.min.js')}}"></script>
        <script src="{{URL::asset('/tilawatipusat/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{URL::asset('/tilawatipusat/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
        <script src="{{URL::asset('/tilawatipusat/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
        <script src="{{URL::asset('/tilawatipusat/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

        <!-- form advanced init -->
        <script src="{{URL::asset('/tilawatipusat/js/pages/form-advanced.init.js')}}"></script>

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
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var cabang_id = $('#cabang_id').val();
            console.log(cabang_id);
            
            $(document).ready(function(){
                //ready load data
                load_data();

                function load_data(dari = '', sampai = '')
                {
                    $.ajax({
                        url:'/diklat-diklat-total-diklat-cabang/'+cabang_id,
                        type: 'get',
                        dataType: 'json',
                        data:{dari:dari, sampai:sampai},
                        success:function(data) {
                            document.getElementById('cb').innerHTML = data;
                            console.log(data);
                        }
                    });

                    $('.table-diklat').DataTable({
                        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                        destroy: true,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url:'/diklat-diklat-data-cabang/'+cabang_id,
                            data:{dari:dari, sampai:sampai}
                        },
                        columns: [
                            {
                            data:'id',
                            name:'id'
                            },
                            {
                            data:'program',
                            name:'program.name'
                            },
                            {
                            data:'tanggal',
                            name:'tanggal'
                            },
                            
                            {
                            data:'tempat',
                            name:'tempat'
                            },
                            {
                            data:'peserta',
                            name:'peserta'
                            },
                            
                        ]
                    });
                }
                $('#filter').click(function(){
                    var dari = $('#dari').val();
                    var sampai = $('#sampai').val();
                    if(dari != '' &&  sampai != '')
                    {
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
                    load_data();
                });
            });
            
        </script>
@endsection