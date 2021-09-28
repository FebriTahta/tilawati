@extends('layouts.tilawatipusat_layouts.master')

@section('title') konfirmasi @endsection
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
         @slot('title') konfirasi   @endslot
         @slot('title_li') DATA DIKLAT   @endslot
    @endcomponent
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
                            
                                @slot('title') <b id="cb"> ??? </b><br><small> Total Diklat  </small>@endslot
                                @slot('iconClass') mdi mdi-home-analytics  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                        <div class="col-xl-6">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <a href="#" data-toggle="modal" data-target="#mod_cabang2"> <b id="cb2"> ??? </b><br><small> Cabang yang Mengadakan Diklat</small></a>@endslot
                                @slot('iconClass') mdi mdi-bank-outline  @endslot
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
                                                    <th>program diklat</th>
                                                    <th>cabang</th>
                                                    <th>tanggal</th>
                                                    <th>Peserta</th>
                                                    <th>...</th>
                                                </tr>
                                            </thead>
    
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>

                                            <tfoot class="text-primary" style="text-transform: capitalize">
                                                <tr>
                                                    <th>program diklat</th>
                                                    <th>cabang</th>
                                                    <th>tanggal</th>
                                                    <th>Peserta</th>
                                                    <th>...</th>
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

                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade" id="modal-download" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="" action="/export-peserta-pendaftaran"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group text-center">
                                                                <h5>Mengunduh Daftar Peserta Pendaftaran ?</h5>
                                                                <input type="hidden" class="form-control text-capitalize" id="id" name="id" required>
                                                            </div>
                                                            <div class="row" style="text-align: center">
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <input type="submit" id="btndownload" class="btn btn-primary" value="Ya, Unduh!" />
                                                                </div>
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                        No, Cancel!
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div><!-- container fluid -->
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>

                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade" id="modal-download2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="" action="/diklat-cetak-surat-pengiriman"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group text-center">
                                                                <h5>Cetak Surat Pengiriman ?</h5>
                                                                <input type="hidden" class="form-control text-capitalize" id="id" name="id" required>
                                                            </div>
                                                            <div class="row" style="text-align: center">
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <input type="submit" id="btndownload" class="btn btn-primary" value="Ya, Unduh!" />
                                                                </div>
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                        No, Cancel!
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div><!-- container fluid -->
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>

                    <div class="modal fade bs-example-modal-xl-2" id="mod_cabang2" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">DAFTAR CABANG YANG MENGADAKAN DIKLAT</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <table id="datatable-buttons2" class="table table-diklat-cabang table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary">
                                                <tr>
                                                    <th>Cabang</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                    
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>
                    
                                            <tfoot class="text-bold text-primary">
                                                <tr>
                                                   <th>Cabang</th>
                                                   <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <footer class="blockquote-footer">Updated at  <cite title="Source Title">2021</cite></footer>
                                    </blockquote>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

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
            $('.bs-example-modal-diklat-hapus').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
            })
            $('#modal-download').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
            })

            $('#modal-download2').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
            })
            
            $(document).ready(function(){
                //ready load data
                load_data();

                function load_data(dari = '', sampai = '')
                {
                    //pilih cabang
                    $('#sel_cabang').select2('destroy').select2({
                        placeholder: 'Select an item',
                        ajax: {
                            url: "{{route('diklat.diklat_cabang_select')}}",
                            dataType: 'json',
                            delay: 250,
                            processResults: function (data) {
                            return {
                                results:  $.map(data, function (item) {
                                    return {
                                        text: item.kode,
                                        text: item.name,
                                        id: item.id   
                                    }
                                })
                            };
                            },
                            cache: true
                        }
                    });

                    //total diklat dan cabang yang mengadakan diklat
                    $.ajax({
                        url:'{{ route("diklat.diklat_tot") }}',
                        type: 'get',
                        dataType: 'json',
                        data:{dari:dari, sampai:sampai},
                        success:function(data) {
                            document.getElementById('cb').innerHTML = data;
                            console.log(data);
                        }
                    });
                    $.ajax({
                        url:'{{ route("diklat.diklat_cabang_tot") }}',
                        type: 'get',
                        dataType: 'json',
                        data:{dari:dari, sampai:sampai},
                        success:function(data) {
                            document.getElementById('cb2').innerHTML = data;
                            console.log(data);
                        }
                    });

                    //data diklat dan data cabang diklat
                    $('.table-diklat').DataTable({
                        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                        destroy: true,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url:'{{ route("data_diklat_konfirmasi") }}',
                            data:{dari:dari, sampai:sampai}
                        },
                        columns: [
                            {
                            data:'program',
                            name:'program.name'
                            },
                            {
                            data:'cabang',
                            name:'cabang.name'
                            },
                            {
                            data:'tanggal',
                            name:'tanggal'
                            },
                            {
                            data:'peserta',
                            name:'peserta'
                            },
                            {
                            data:'unduh',
                            name:'unduh'
                            },
                            
                            
                        ]
                    });

                    $('.table-diklat-cabang').DataTable({
                        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                        destroy: true,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url:'{{ route("diklat.diklat_cabang_data") }}',
                            data:{dari:dari, sampai:sampai}
                        },
                        columns: [
                            {
                            data:'cabang',
                            name:'cabang.name'
                            },
                            {
                            data:'action',
                            name:'action'
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