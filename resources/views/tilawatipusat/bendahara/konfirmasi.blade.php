<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Potenza - Job Application Form Wizard with Resume upload and Branch feature">
    <meta name="author" content="Ansonika">
    <title style="text-transform: capitalize">konfirmasi data</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{ asset('tilawatipusat/registrasi/img/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{ asset('tilawatipusat/registrasi/img/apple-touch-icon-72x72-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{ asset('tilawatipusat/registrasi/img/apple-touch-icon-114x114-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{ asset('tilawatipusat/registrasi/img/apple-touch-icon-144x144-precomposed.png') }}">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{ asset('tilawatipusat/registrasi/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('tilawatipusat/registrasi/css/menu.css') }}" rel="stylesheet">
    <link href="{{ asset('tilawatipusat/registrasi/css/style.cs') }}s" rel="stylesheet">
	<link href="{{ asset('tilawatipusat/registrasi/css/vendors.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('tilawatipusat/css/bootstrap-dark.min.css')}}" id="bootstrap-dark" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('tilawatipusat/css/bootstrap.min.css')}}" id="bootstrap-light" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('tilawatipusat/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('tilawatipusat/css/app-rtl.min.css')}}" id="app-rtl" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('tilawatipusat/css/app-dark.min.css')}}" id="app-dark" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('tilawatipusat/css/app.min.css')}}" id="app-light" rel="stylesheet" type="text/css" />

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('tilawatipusat/registrasi/css/custom.css') }}" rel="stylesheet">
	
	<!-- MODERNIZR MENU -->
	<script src="{{ asset('tilawatipusat/registrasi/js/modernizr.js') }}"></script>

    <!--CDN DATATABLE-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        table.dataTable.peserta td:nth-child(3) {
        width: 100px;
        max-width: 100px;
        word-break: break-all;
        white-space: pre-line;
        text-align: center;
        }
        table.dataTable.peserta th:nth-child(3) {
        width: 100px;
        max-width: 100px;
        word-break: break-all;
        white-space: pre-line;
        text-align: center;
        }
    </style>
</head>

<body>
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->
	
	<div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div><!-- /loader_form -->
	
	<nav>
		<ul class="cd-primary-nav">
			<li><a href="index.html" class="animated_link">Version 1</a></li>
			<li><a href="index-2.html" class="animated_link">Version 2</a></li>
			<li><a href="index-3.html" class="animated_link">Version 3</a></li>
			<li><a href="index-4.html" class="animated_link">File Attachment demo</a></li>
			<li><a href="about.html" class="animated_link">About Us</a></li>
			<li><a href="contacts.html" class="animated_link">Contact Us</a></li>
			<li><a href="#0" class="animated_link">Purchase Template</a></li>
		</ul>
	</nav>
	<!-- /menu -->
	
	<div class="container-fluid" style="position: fixed">
	    <div class="row">
	        <div class="col-xl-4 col-12 content-left">
	            <div class="content-left-wrapper">
	                <a href="#" id="logo"><img src="{{ asset('assets/images/tilawati-white.png') }}" alt="" width="75" height="45"></a>
	                <div id="social">
	                    <ul>
	                        <li><a href="#0"><i class="icon-facebook"></i></a></li>
	                        <li><a href="#0"><i class="icon-twitter"></i></a></li>
	                        <li><a href="#0"><i class="icon-google"></i></a></li>
	                        <li><a href="#0"><i class="icon-linkedin"></i></a></li>
	                    </ul>
	                </div>
	                <!-- /social -->
	                <div><?php date_default_timezone_set('Asia/Jakarta'); $date=$diklat->tanggal;?>
	                    <figure><img src="{{ asset('tilawatipusat/registrasi/img/info_graphic_1.svg') }}" alt="" class="img-fluid" width="270" height="270"></figure>
	                    <h2 style="text-transform: uppercase">{{ $diklat->program->name }}</h2>
	                    <p>Diklat {{ $diklat->program->name }} <br/> diadakan oleh Cabang {{ $diklat->cabang->name }} - {{ $diklat->cabang->kabupaten->nama }} 
						<br/>Pada Tanggal {{ Carbon\Carbon::parse($date)->isoFormat('D MMMM Y') }}</p>
	                    <a href="#0" class="btn_1 rounded yellow">Periksa data anda</a>
	                    <a href="#start" class="btn_1 rounded mobile_btn yellow">Periksa data anda</a>
	                </div>
                    <input type="hidden" id="diklat" value="{{ $diklat->id }}">
	                <div class="copy">© 2020 Tilawati Pusat Nurul Falah</div>
	            </div>
	            <!-- /content-left-wrapper -->
	        </div>
	        <!-- /content-left -->
	        <div class="col-xl-8 col-12" style="padding: 2%;">
                <div class="card">
                    <div class="card-body">
                        <div class="head">
                            <h2 class="section_title" >Calon Peserta Diklat</h2>
                            <p class="main_question mobile_btn">Periksa dan konfirmasi data calon peserta diklat</p>
                        </div>
                        <div class="table-responsive">
                            <table id="data" class="table peserta table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                <thead style="text-transform: capitalize" class="text-success">
                                    <tr>
                                        <th>nama</th>
                                        <th>file</th>
                                        <th>konfirmasi</th>
                                    </tr>
                                </thead>
                                <tbody style="text-transform: uppercase">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
	        </div>
	        <!-- /content-right-->
	    </div>
	    <!-- /row-->
	</div>
	<!-- /container-fluid -->

	<div class="cd-overlay-nav">
		<span></span>
	</div>
	<!-- /cd-overlay-nav -->

	<div class="cd-overlay-content">
		<span></span>
	</div>
	<!-- /cd-overlay-content -->

	<a href="#0" class="cd-nav-trigger">Menu<span class="cd-icon"></span></a>
	<!-- /menu button -->

	<div class="modal fade" id="terms-file" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				{{-- <div class="modal-header">
					<h4 class="modal-title" style="text-transform: uppercase" id="termslabel">Persyaratan</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div> --}}
				<div class="modal-body text-center text-danger">
					<input type="hidden" id="id">
                    <img src="" id="file" alt="" class="img-fluid">
                    <hr>
                    <h5 style="text-transform: uppercase" id="termslabel"></h5>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	
	<!-- COMMON SCRIPTS -->
	<script src="{{ asset('tilawatipusat/registrasi/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('tilawatipusat/registrasi/js/common_scripts.min.js') }}"></script>
	<script src="{{ asset('tilawatipusat/registrasi/js/velocity.min.js') }}"></script>
	<script src="{{ asset('tilawatipusat/registrasi/js/common_functions.js') }}"></script>
	<script src="{{ asset('tilawatipusat/registrasi/js/file-validator.js') }}"></script>

    <script src="{{ URL::asset('tilawatipusat/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/metismenu/metismenu.min.js')}}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/node-waves/node-waves.min.js')}}"></script>


    <!-- App js -->
    <script src="{{ URL::asset('tilawatipusat/js/app.min.js')}}"></script>
	<!-- Wizard script-->
    
	{{-- <script src="{{ asset('tilawatipusat/registrasi/js/func_2.js') }}"></script> --}}

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
        var diklat = $('#diklat').val();
        $('#data').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                buttons: ['pdf'],
                ajax: {
                    url:'/konfirmasi-data-calon-peserta-diklat/'+ diklat,
                },
                columns: [
                    {
                    data:'name',
                    name:'name'
                    },
                    {
                    data:'check',
                    name:'check'
                    },
                    {
                    data:'konfirmasi',
                    name:'status'
                    }
                ]
                });
            
            $('#terms-file').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id      = button.data('id')
                var file    = button.data('file')
                var name    = button.data('name')
                var modal   = $(this)
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #file').attr('src', file);
                modal.find('.modal-body #termslabel').html(name);
            })
    </script>
</body>
</html>