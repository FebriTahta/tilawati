@extends('layouts.tilawatipusat_layouts.master')

@section('title') Sertifikat @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') Sertifikat    @endslot
         @slot('title_li') IMPORT   @endslot
    @endcomponent
                    {{-- <div class="row">
                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="cb"> 2,456 </b> ijazah depan guru  @endslot
                                @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                    </div> --}}

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Sertifikat</h4>
                                    <p class="card-title-desc">Data Sertifikat Berdasarkan Diklat </br></p>
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2">
                                        {{-- <form target="_blank" action="{{ route('diklat.belakang_cetak') }}" method="POST">@csrf
                                            <div class="form-group">
                                                <label for="">Jenis Program</label>
                                                <select name="program_id" id="" class="form-control text-capitalize" required>
                                                    <option value="">= Pilih Jenis Program =</option>
                                                    @foreach ($dt_pro as $item)
                                                        <option class="text-capitalize" value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Program Pelatihan</label>
                                                <select name="pelatihan_id" id="" class="form-control text-capitalize" required>
                                                    <option class="text-capitalize" value="">= Pilih Program Pelatihan =</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-print"></i> Cetak</button>
                                            </div>
                                        </form> --}}
                                        <table id="data-diklat" class="table table-diklat table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary" style="text-transform: capitalize">
                                                <tr>
                                                    <th>program diklat</th>
                                                    <th>pelaksana</th>
                                                    <th>tanggal</th>
                                                    <th>sertifikat</th>
                                                    <th>...</th>
                                                </tr>
                                            </thead>
    
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>

                                            <tfoot class="text-primary" style="text-transform: capitalize">
                                                <tr>
                                                    <th>program diklat</th>
                                                    <th>pelaksana</th>
                                                    <th>tanggal</th>
                                                    <th>sertifikat</th>
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
                        <div class="modal fade" id="modal-import" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body text-danger">
                                        <div class="sec-title centered">
                                            <div class="title"></div>
                                            <div class="separate"></div>
                                        </div>
                    
                                        <form id="formimport" action="" class="was-validate" enctype="multipart/form-data">@csrf
                                            <div class="card">
                                                <div class="card-body">
                                                    <input type="text" id="id" name="id">
                                                    <h4 class="card-title">File import</h4>
                                                    <p class="card-title-desc">Pastikan file yang akan anda import sudah sesuai dengan format ketentuan yang berlaku</p>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="inputGroupFile02" name="file"/>
                                                            <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <input class="btn btn-primary" type="submit" id="btnimport" value="import">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.modal -->
                    </div>
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
            $('#inputGroupFile02').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
            $('#modal-import').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var modal = $(this)
                $('#id').val(id);
                console.log(id);
            })

            $('#formimport').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('import.certificate')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnimport').attr('disabled','disabled');
                    $('#btnimport').val('Importing Process');
                },
                success: function(data){
                    if(data.success)
                    {
                        //sweetalert and refresh datatable
                        $("#formimport")[0].reset();
                        toastr.success(data.success);
                        var oTable = $('#data-diklat').dataTable();
                        oTable.fnDraw(false);
                        $('#btnimport').val('Import');
                        $('#btnimport').attr('disabled',false);
                        $('#modal-import').modal('hide');
                        swal("Done!", data.message, "success");
                    }
                    if(data.error)
                    {
                        $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
                        $('#btnimport').attr('disabled',false);
                        $('#btnimport').val('Import');
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

            $('.table-diklat').DataTable({
                        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                        destroy: true,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url:'{{ route("sertifikat.daftar.pelatihan") }}',
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
                            data:'certificate',
                            name:'certificate'
                            },
                            {
                            data:'action',
                            name:'action'
                            },
                            
                        ]
                });
        </script>
        
@endsection