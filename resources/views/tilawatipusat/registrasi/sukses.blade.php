<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Potenza - Job Application Form Wizard with Resume upload and Branch feature">
    <meta name="author" content="Ansonika">
    <title style="text-transform: capitalize">Registrasi | Sukses</title>

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

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('tilawatipusat/registrasi/css/custom.css') }}" rel="stylesheet">
	
	<!-- MODERNIZR MENU -->
	<script src="{{ asset('tilawatipusat/registrasi/js/modernizr.js') }}"></script>

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
	
	<div class="container-fluid">
	    <div class="row row-height">
	        <div class="col-xl-4 col-lg-4 content-left">
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
	                <div class="copy">© 2020 Tilawati Pusat Nurul Falah</div>
	            </div>
	            <!-- /content-left-wrapper -->
	        </div>
	        <!-- /content-left -->
	        <div class="col-xl-8 col-lg-8 content-right" id="start">
	            <div id="wizard_container">
	                <div>
	                    <div class="text-center" style="text-transform: uppercase">
							<h5>{{ $peserta->name }}</h5>
						</div>
						<hr>
						<div class="form-group text-center">
							<p>Terimakasih Telah Mendaftar</p>
							<p>{{ $diklat->program->name }} - Cabang {{ $diklat->cabang->name }} - {{ $diklat->cabang->kabupaten->nama }}</p>
						</div>
	                </div>
	                <!-- /top-wizard -->
	            </div>
	            <!-- /Wizard container -->
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
	
	<!-- Modal terms -->
	<div class="modal fade" id="terms-txt" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="termsLabel">Terms and conditions</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body" style="text-transform: capitalize">
					<ol>
						<li>- Data yang anda sertakan adalah data yang sebenar benarnya</li>
						<li>- Periksa Email anda secara berkala</li>
						<li>- Bergabunglah pada Group Whatsapp yang dilampirkan pada email</li>
					</ol>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn_1" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<div class="modal fade" id="terms-nik" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="termsLabel">Persyaratan</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body text-center text-danger">
					<p id="text-nik"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn_1" data-dismiss="modal">Close</button>
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

	<!-- Wizard script-->
	<script src="{{ asset('tilawatipusat/registrasi/js/func_2.js') }}"></script>
	<script>
		$(document).ready(function(){
			var txtlen; var phonetxtln; var formatphone;
			$(function() {
            $('#nik').keyup(function() {
                txtlen = $(this).val().length;
                var txtlennospace = $(this).val().replace(/\s+/g, '').length;
					if (txtlen <= 16 || txtlen >= 16) {
						$('#next').val('Jumlah NIK Tidak Sesuai '+txtlen+' dari 16 Digit');
						$('#next').attr('disabled','disabled');
					}
					if(txtlen == 16){
						$('#next').val('next');
						$('#next').attr('disabled',false);
					}
            	});
        	});
			$(function() {
				$('#phone').keyup(function() {
					phonetxtln = $(this).val().length;
					formatphone = $(this).val().substr(0,2);
					if (formatphone !== 08) {
						if (phonetxtln < 12 || phonetxtln > 13) {
							$('#next').val(''+phonetxtln+' Digit dari 12 / 13 Digit & dengan awalan 08' );
							$('#next').attr('disabled','disabled');
						}else if (phonetxtln == 12 || phonetxtln == 13){
							$('#next').val('Phone Number wajib dengan 08' );
							$('#next').attr('disabled','disabled');
						}
					}if(formatphone == 08) {
						if (phonetxtln < 12 || phonetxtln > 13) {
							$('#next').val('Phone Number '+phonetxtln+' dari 12 / 13 Digit' );
							$('#next').attr('disabled','disabled');
						}else if (phonetxtln == 12 || phonetxtln == 13){
							$('#next').val('next');
							$('#next').attr('disabled',false);
						}
					}
				});
        	});

		$('select[name="provinsi_id"]').on('change', function() {
                //mencari kota/kab dari provinsi 3 tingkat
                var provinsi_id = $(this).val();
                
                if(provinsi_id) {
                    
                    $.ajax({
                        url: '/fetch/' + provinsi_id,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {                     
                            $('select[name="kabupaten_id"]').empty();
                            $.each(data, function(key, value) {
                            $('select[name="kabupaten_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                            
                            var a = $( "#kabupaten_id option:selected" ).val();
                            
                            if(a) {
                            $.ajax({
                                    url: '/fetch2/' + a,
                                    type: "GET",
                                    dataType: "json",
                                    success:function(data) {                      
                                        $('select[name="kecamatan_id"]').empty();
                                        $.each(data, function(key, value) {
                                        $('select[name="kecamatan_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                        });
                                        
                                        var x = $( "#kecamatan_id option:selected" ).val();
                                        
                                        if(x) {
                                        $.ajax({
                                                url: '/fetch3/' + x,
                                                type: "GET",
                                                dataType: "json",
                                                success:function(data) {                      
                                                    $('select[name="kelurahan_id"]').empty();
                                                    $.each(data, function(key, value) {
                                                    $('select[name="kelurahan_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                                    });
                                                    
                                                    var x = $( "#kelurahan_id option:selected" ).val();
                                                    
                                                }
                                            });
                                        }else{
                                            $('select[name="kelurahan_id"]').empty().disabled();
                                        }
                                    }
                                });
                            }else{
                                $('select[name="kecamatan_id"]').empty().disabled();
                            }
                        }
                    });
                }else{
                    $('select[name="kabupaten_id"]').empty().disabled();
                }
            });

            $('select[name="kabupaten_id"]').on('change', function() {
                //mencari kecamatan dari kota/kab 2 tingkat
                var kabupaten_id = $(this).val();
                
                if(kabupaten_id) {
                    
                    $.ajax({
                        url: '/fetch2/' + kabupaten_id,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {                      
                            $('select[name="kecamatan_id"]').empty();
                            $.each(data, function(key, value) {
                            $('select[name="kecamatan_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                            
                            var x = $( "#kecamatan_id option:selected" ).val();
                            
                            if(x) {
                                $.ajax({
                                    url: '/fetch3/' + x,
                                    type: "GET",
                                    dataType: "json",
                                    success:function(data) {                      
                                        $('select[name="kelurahan_id"]').empty();
                                        $.each(data, function(key, value) {
                                        $('select[name="kelurahan_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                        });
                                        
                                        var x = $( "#kelurahan_id option:selected" ).val();
                                        
                                    }
                                });
                            }else{
                                $('select[name="kelurahan_id"]').empty().disabled();
                            }
                        }
                    });
                }else{
                    $('select[name="kecamatan_id"]').empty().disabled();
                }
            });
            
            $('select[name="kecamatan_id"]').on('change', function() {
                //mencari kelurahan dari kecamatan
                var kecamatan_id = $(this).val();
                
                if(kecamatan_id) {
                    
                    $.ajax({
                        url: '/fetch3/' + kecamatan_id,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {                      
                            $('select[name="kelurahan_id"]').empty();
                            $.each(data, function(key, value) {
                            $('select[name="kelurahan_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                            
                        }
                    });
                }else{
                    $('select[name="kelurahan_id"]').empty().disabled();
                }
            });
        })
		
	</script>
</body>
</html>