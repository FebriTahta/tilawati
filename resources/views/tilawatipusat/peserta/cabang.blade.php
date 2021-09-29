@extends('layouts.tilawatipusat_layouts.master')

@section('title') Peserta @endsection
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
         @slot('title') Peeserta   @endslot
         @slot('title_li') DIKLAT   @endslot
    @endcomponent
                    <div class="row">
                        <input type="hidden" value="{{ $cabang->id }}" id="cabang_id">
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
                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="cb2" class="text-capitalize"> Cabang {{ $cabang->name }} </b> @endslot
                                @slot('iconClass') mdi mdi-bank-outline  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="cb"> ??? </b> Peserta  @endslot
                                @slot('iconClass')  mdi mdi-account-group  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <a href="#" data-toggle="modal" data-target="#mod_kabupaten" class="text-capitalize"> <b id="cb3"> ??? </b> Kota / Kabupaten</a>@endslot
                                @slot('iconClass') mdi mdi-city  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                    
                                    <h4 class="card-title">Data Peserta Diklat</h4>
                    
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <table id="datatable-buttons" class="table table-diklat table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary" style="text-transform: capitalize">
                                                <tr>
                                                    <th>peserta</th>
                                                    <th>asal</th>
                                                    <th>program pelatihan</th>
                                                    <th>tanggal</th>
                                                    <th>cabang</th>
                                                    
                                                    <th>telp</th>
                                                    <th>email</th>
                                                    <th>nilai</th>
                                                    <th>tanggal lahir</th>
                                                    <th>alamat</th>
                                                    <th>Kriteria</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
    
                                            <tbody style=" font-size: 12px" class="text-uppercase">
                                            </tbody>

                                            <tfoot class="text-primary" style="text-transform: uppercase">
                                                <tr>
                                                    <th>peserta</th>
                                                    <th>asal</th>
                                                    <th>program pelatihan</th>
                                                    <th>tanggal</th>
                                                    <th>cabang</th>
                                                    
                                                    <th>telp</th>
                                                    <th>email</th>
                                                    <th>nilai</th>
                                                    <th>tanggal lahir</th>
                                                    <th>alamat</th>
                                                    <th>Kriteria</th>
                                                    <th>Option</th>
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
                        <div class="modal fade bs-example-modal-diklat-hapus" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="hapusdiklat"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group text-center">
                                                                <h5>Anda yakin akan menghapus Diklat tersebut ?</h5>
                                                                <input type="hidden" class="form-control text-capitalize" id="id" name="id" required>
                                                            </div>
                                                            <div class="row" style="text-align: center">
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <input type="submit" name="hapus" id="btnhapus" class="btn btn-danger" value="Ya, Hapus!" />
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

                    <div class="modal fade bs-example-modal-xl-3" id="mod_kabupaten" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">DAFTAR KABUPATEN YANG MENGADAKAN DIKLAT</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <table id="datatable-buttons3" class="table table-diklat-kabupaten table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary">
                                                <tr>
                                                    <th>Kabupaten</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                    
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>
                    
                                            <tfoot class="text-bold text-primary">
                                                <tr>
                                                   <th>Kabupaten</th>
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

                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade modal-scan" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0">SCAN QR CODE PESERTA </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid text-center">
                                                        <img src="" alt="qr-code" id="qr-code" width="150px" height="150px">
                                                        <div class="text-center text-uppercase" style="margin-top: 10px">
                                                            <p class="text-info" id="nama_peserta"></p>
                                                        </div>
                                                    </div><!-- container fluid -->
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
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
            var cabang_id = $('#cabang_id').val();
            $('.modal-scan').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                id = button.data('id')
                var modal = $(this)
                document.getElementById("qr-code").src = id;
            })
            $('.bs-example-modal-diklat-hapus').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
            })
            $('#hapusdiklat').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.delete')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnhapus').attr('disabled','disabled');
                    $('#btnhapus').val('Proses Hapus Data');
                },
                success: function(data){
                    if(data.success)
                    {
                        //sweetalert and redirect
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#btnhapus').val('Ya, Hapus!');
                        $('.bs-example-modal-diklat-hapus').modal('hide');
                        $('#btntambah').attr('disabled',false);
                        swal({ title: "Success!",
                            text: "Kriteria Tersebut Berhasil Di Dihapus!",
                            type: "success"})
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });
            
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
                        url:'/diklat-peserta-diklat-cabang-total/'+cabang_id,
                        type: 'get',
                        dataType: 'json',
                        data:{dari:dari, sampai:sampai},
                        success:function(data) {
                            document.getElementById('cb').innerHTML = data;
                            console.log(data);
                        }
                    });

                    $.ajax({
                        url:'/diklat-peserta-diklat-cabang-kabupaten-total/'+cabang_id,
                        type: 'get',
                        dataType: 'json',
                        data:{dari:dari, sampai:sampai},
                        success:function(data) {
                            document.getElementById('cb3').innerHTML = data;
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
                            url:'/diklat-peserta-diklat-cabang-data/'+cabang_id,
                            data:{dari:dari, sampai:sampai}
                        },
                        columns: [
                            {
                            data:'name',
                            name:'name',
                            },
                            {
                            data:'kabupaten',
                            name:'kabupaten.nama'
                            },
                            {
                            data:'program',
                            name:'program.name',
                            searchable: false,
                            orderable: false,
                            },
                            {
                            data:'tanggal',
                            name:'tanggal'
                            },
                            {
                            data:'cabang',
                            name:'cabang.name',
                            searchable: false,
                            orderable: false,
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
                            data:'nilai',
                            name:'nilai'
                            },
                            {
                            data:'tgllahir',
                            name:'tgllahir',
                            },
                            {
                            data:'alamat',
                            name:'alamat'
                            },
                            {
                            data:'kriteria',
                            name:'kriteria'
                            },
                            {
                            data:'action',
                            name:'action'
                            },
                            
                        ]
                    });

                    $('#datatable-buttons3').DataTable({
                        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                        destroy: true,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url:'/diklat-peserta-diklat-kabupaten-cabang/'+cabang_id,
                            data:{dari:dari, sampai:sampai}
                        },
                        columns: [
                            {
                            data:'kabupaten',
                            name:'kabupaten.nama'
                            },
                            {
                            data:'action',
                            name:'action'
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