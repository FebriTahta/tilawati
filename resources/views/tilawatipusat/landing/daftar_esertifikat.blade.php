@extends('layouts.tilawatipusat_landing.master')

@section('head')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        table.dataTable.peserta td:nth-child(2) {
        width: 150px;
        max-width: 150px;
        word-break: break-all;
        white-space: pre-line;
        text-align: center;
        }
        table.dataTable.peserta th:nth-child(2) {
        width: 150px;
        max-width: 150px;
        word-break: break-all;
        white-space: pre-line;
        text-align: center;
        }
    </style>
@endsection

@section('content')
    <section class="recipe-section-two">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <div class="title">Unduh E-Certificate</div>
                <h2>{{ $diklat->program->name }}</h2>
                <?php date_default_timezone_set('Asia/Jakarta'); $date=$diklat->tanggal;?>
                {{-- <p>( {{ Carbon\Carbon::parse($date)->isoFormat('D MMMM Y') }} )</p> --}}
                <p>(10 - 11 Juli 2021)</p>
                <div class="separate"></div>
            </div>
        </div>
        <div class="card">
            <input type="hidden" value="{{ $diklat->id }}" id="diklat">
            <div class="card-body">
                <div class="auto-container">
                    <!-- Sec Title Two -->
                    <div class="table-responsive">
                        <span class="sec-title-two">
                            <a 
                            @auth href="#" class="title" 
                                data-toggle="modal" data-target="#import"
                            @else
                                class="title" 
                            @endauth>Daftar Peserta
                            </a>
                        </span>
                        <table id="data" class="table peserta table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead style="text-transform: capitalize" class="text-success">
                                <tr>
                                    <th>nama</th>
                                    <th>....</th>
                                </tr>
                            </thead>
                            <tbody style="text-transform: capitalize">
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="separator"></div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-body text-danger">
                    <div class="sec-title centered">
                        <div class="title">Import Data Dokumen E-Certificate Peserta Diklat</div>
                        <div class="separate"></div>
                    </div>

					<form id="formimport" action="" class="was-validate" enctype="multipart/form-data">@csrf
                        <div class="card">
                            <div class="card-body">
                                <input type="hidden" name="tanggal" value="{{ $diklat->tanggal }}">
                                <input type="hidden" name="id" value="{{ $diklat->id }}">
                                <h4 class="card-title">File import</h4>
                                <p class="card-title-desc">Pastikan file yang akan anda import sudah sesuai dengan ketentuan yang berlaku</p>
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
	</div>
@endsection

@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/pdfmake/pdfmake.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{ URL::asset('tilawatipusat/js/pages/datatables.init.js')}}"></script>

    <!-- Toast -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script>
    $('#inputGroupFile02').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
    </script>
    <script>
        $('#formimport').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('import.e_certificate')}}",
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
                        var oTable = $('#data').dataTable();
                        oTable.fnDraw(false);
                        $('#btnimport').val('Import');
                        $('#btnimport').attr('disabled',false);
                        $('#import').modal('hide');
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
    </script>
    <script>
        var diklat = $('#diklat').val();
        console.log(diklat);
        $('#data').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                buttons: ['pdf'],
                ajax: {
                    url:'/data/e-certificate/'+diklat,
                },
                columns: [
                    {
                    data:'name',
                    name:'peserta.name'
                    },
                    {
                    data:'download',
                    name:'download'
                    },
                   
                ]
                });
    </script>
@endsection