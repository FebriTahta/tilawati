@extends('layouts.tilawatipusat_layouts.master')

@section('title') Sertifikat @endsection
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
         @slot('title') sertifikat    @endslot
         @slot('title_li')    @endslot
    @endcomponent

                    <div class="row">
                        <div class="col-lg-12">
                            @if(Session::has('fail'))
                                <div class="col-lg-12 alert alert-danger">
                                {{Session::get('fail')}}
                                </div>
                            @endif
                            <form action="/generate-program-id" method="POST">
                                @csrf
                                <button type="submit">generate</button>
                            </form>
                            <div class="card">
                                <div class="card-body">
                                    {{-- <h4 class="card-title">Data Sertifikat</h4> --}}
                                    <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modal-sertifikat"><i class="fa fa-plus"></i> sertifikat baru</button>
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2">
                                        <table id="data-diklat" class="table table-diklat table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary" style="text-transform: capitalize">
                                                <tr>
                                                    <th>Sertifikat Program</th>
                                                    <th>Tanggal</th>
                                                    <th>Pelaksana</th>
                                                    <th>Certificate</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
    
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>

                                            <tfoot class="text-primary" style="text-transform: capitalize">
                                                <tr>
                                                    <th>Sertifikat Program</th>
                                                    <th>Tanggal</th>
                                                    <th>Pelaksana</th>
                                                    <th>Certificate</th>
                                                    <th>Action</th>
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
                                                    <input type="hidden" id="id" name="id">
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

                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade" id="modal-generatex" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body text-danger">
                                        <div class="sec-title centered">
                                            <div class="title"></div>
                                            <div class="separate"></div>
                                        </div>
                                        <form action="/generate-program-id" method="POST">@csrf
                                            <input type="text" id="id" name="id">
                                            <button type="submit"> generate </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.modal -->
                    </div>

                    {{-- modal sertifikat baru --}}
                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade" id="modal-sertifikat" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="sec-title centered">
                                            <div class="title"></div>
                                            <div class="separate"></div>
                                        </div>
                                        <form action="{{route('store.induksertifikat')}}" method="POST" enctype="multipart/form-data">@csrf
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-12 col-xl-12 border-bottom">
                                                            <input type="radio" id="1" name="waktu" value="1" onclick="myFunction2()" checked >
                                                            <label for="1">satu hari</label><br>
                                                            <input type="radio" id="2" name="waktu" value="2"  onclick="myFunction()">
                                                            <label for="2">lebih dari satu hari</label>
                                                        </div>
                                                    
                                                        <div class="form-group col-12 col-xl-6">
                                                            <label for="tanggal">Tanggal</label>
                                                            <input type="date" id="tanggal" name="tgl_awal" class="form-control" required>
                                                        </div>
                                                        <div class="form-group col-12 col-xl-6" id="tgl" style="display: none">
                                                            <label for="sampai">Sampai</label>
                                                            <input type="date" id="sampai" name="tgl_akhir" class="form-control" >
                                                        </div>
                                                        
                                                        <div class="form-group col-12 col-xl-6">
                                                            <label for="program">Program</label>
                                                            <input list="listprogram" name="program" class="form-control" id="program" required>
                                                            <datalist id="listprogram">
                                                                @foreach ($program as $pro)
                                                                    <option value="{{$pro->name}}">
                                                                @endforeach
                                                            </datalist>
                                                        </div>
                                                        <div class="form-group col-12 col-xl-6">
                                                            <label for="cabang">Pelaksana</label>
                                                            <input list="listcabang" name="cabang" class="form-control" id="cabang" required>
                                                            <datalist id="listcabang">
                                                                @foreach ($cabang as $cab)
                                                                    <option value="{{$cab->name}}">
                                                                @endforeach
                                                            </datalist>
                                                        </div>
                                                        <br>
                                                        <div class="form-group col-12 col-xl-12">
                                                            <label for="tempat">Tempat Penyelenggaraan</label>
                                                            <textarea name="tempat" id="tempat" cols="30" rows="2" class="form-control" required></textarea>
                                                        </div>
                                                        <div class="form-group col-12 col-xl-12 text-right">
                                                            <input type="submit" class="btn btn-sm btn-primary" value="Submit!">
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
            function myFunction() {
                document.getElementById("tgl").style.removeProperty( 'display' );
                console.log('kelihatan');
            }
            function myFunction2() {
                document.getElementById("tgl").style.display = "none";
                console.log('hilang');
            }
        </script>
        <script>
            $(document).ready(function(){
                $('#sel_cabang').select2({
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
            })
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

            $('#modal-generatex').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
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
                            url:'{{ route("data.induksertifikat") }}',
                        },
                        columns: [
                            {
                            data:'program_name',
                            name:'program_name'
                            },
                            {
                            data:'tanggal',
                            name:'tgl_awal'
                            },
                            {
                            data:'cabang',
                            name:'cabang_name'
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