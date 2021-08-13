<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Potenza - Job Application Form Wizard with Resume upload and Branch feature">
    <meta name="author" content="Ansonika">
    <title style="text-transform: uppercase">registrasi | {{ $diklat->program->name }}</title>

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
	                    <figure><img src="{{ asset('assets/images/ya.jpeg') }}" alt="" class="img-fluid" width="270" height="270"></figure>
	                    <h2 style="text-transform: uppercase">{{ $diklat->program->name }}</h2>
	                    <p>Diklat {{ $diklat->program->name }} <br/> diadakan oleh {{ $diklat->cabang->name }} - {{ $diklat->cabang->kabupaten->nama }} 
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
	                <div id="top-wizard">
	                    <span id="location"></span>
	                    <div id="progressbar"></div>
	                </div>
	                <!-- /top-wizard -->
	                <form id="wrapped" method="post" enctype="multipart/form-data">@csrf
	                    <input id="website" name="website" type="text" value="">
	                    <!-- Leave for security protection, read docs for details -->
	                    <div id="middle-wizard">
	                        <div class="step">
	                            <h2 class="section_title">Data Diri</h2>
	                            <h3 class="main_question">Personal info / Biodata</h3>
	                            <input type="hidden" name="pelatihan_id" value="{{ $diklat->id }}">
								<input type="hidden" name="cabang_id" value="{{ $diklat->cabang->id }}">
								<div class="form-group add_top_30">
	                                <label for="nik">NIK</label>
	                                <input type="number" maxlength="16" name="nik" id="nik" class="form-control required" onchange="getVals(this, 'nik_field');" required>
	                            </div>
								<div class="form-group">
	                                <label for="name">Nama Lengkap</label>
	                                <input type="text" name="name" id="name" class="form-control required" onchange="getVals(this, 'name_field');" required>
	                            </div>
	                            <div class="form-group">
	                                <label for="email">Email Address</label>
	                                <input type="email" name="email" id="email" class="form-control required" onchange="getVals(this, 'email_field');" required>
	                            </div>
	                            <div class="form-group">
	                                <label for="phone">Phone</label>
	                                <input type="number" name="phone" id="phone" class="form-control required">
	                            </div>
								<hr>
								<div class="row">
									<div class="form-group text-center col-12 col-xl-12">
										<small>Tempat & Tanggal Lahir</small>
									</div>
									<div class="form-group col-6 col-xl-6">
										<label for="tmptlahir">Kabupaten / Kota</label>
										<input type="text" name="tmptlahir" id="tmptlahir" class="form-control required">
									</div>
									<div class="form-group col-6 col-xl-6">
										{{-- <label for="tgllahir" style="text-transform: uppercase"></label> --}}
										<input type="date" name="tgllahir" id="tgllahir" class="form-control required">
									</div>
								</div>
	                        </div>
	                        <!-- /step-->

	                        <!-- /Start Branch ============================== -->
	                        <div class="step" data-state="branchtype">
	                            <h2 class="section_title">Data Diri</h2>
	                            <h3 class="main_question">Alamat Lengkap Sesuai KTP</h3>
	                            <div class="form-group">
									<label class="container_radio version_2">Alamat yang saya inputkan adalah benar
	                                    <input type="radio" name="availability" value="Full-time" class="required">
	                                    <span class="checkmark"></span>
	                                </label>
	                                <div class="row">
										<div class="form-group col-12 col-xl-12">
											<input type="hidden" id="diklat_id" name="pelatihan_id" value="{{ $diklat->id }}">
										</div>
										@if ($diklat->keterangan == 'santri')
										<div class="form-group col-12 col-xl-12">
											<label for=""><i class="text-danger">*</i> Asal Lembaga</label>
											<div class="form-group">
											   <select id="sel_lembaga" name="lembaga_id" class="form-control select2">
												   <option value="0"><i class="text-danger">*</i></option>
											   </select>
										   </div>
										</div>
										@endif
										
										
										<div class="form-group col-12 col-xl-6">
											<select name="provinsi_id" id="mySelect" class="form-control" required>
												<option value="">1* Provinsi</option>
												@foreach ($dt_props2 as $item)
												<option value="{{ $item->id }}">{{ $item->nama }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group col-12 col-xl-6">
											<select id="kabupaten_id" name="kabupaten_id" class="form-control" required>
												<option value="">2* Kabupaten / Kota</option>
											</select>
										</div>
										<div class="form-group col-12 col-xl-6">
											<select id="kecamatan_id" name="kecamatan_id" class="form-control" required>
												<option value="">3* Kecamatan</option>
											</select>
										</div>
										<div class="form-group col-12 col-xl-6">
											<select id="kelurahan_id" name="kelurahan_id" class="form-control " required>
												<option value="">4* Kelurahan</option>
											</select>
										</div>
										<div class="form-group col-12 col-xl-12">
											<label for=""><i class="text-danger">*</i> Alamat Lengkap Sesuai Domisili</label>
											<textarea name="alamat" class="form-control text-capitalize" id="" cols="30" rows="5" required></textarea>
										</div>
									</div>
	                            </div>
	                            <small>* Setujui bahwa alamat yang anda inputkan adalah benar </small>
	                        </div>

	                        <!-- /Work Availability > Full-time ============================== -->
							<div class="branch" id="Full-time">
	                            <div class="step" data-state="end">
	                                <h2 class="section_title">Dokumen Persyaratan</h2>
	                                <h3 class="main_question">Lampirkan dokumen persyaratan yang diminta</h3>
									@if ($registrasi->count() !== 0)
										@foreach ($registrasi as $item)
										<div class="form-group add_bottom_30 add_top_20">
											<input type="hidden" name="registrasi_id[]" value="{{ $item->id }}">
											<label style="text-transform: uppercase">{{ $item->name }}</label>
											<div class="fileupload">
												<input type="file" name="fileupload[]" accept="{{ $item->jenis }}" class="required">
												<br><small>(Jenis File: {{ $item->jenis }})</small>
											</div>
										</div>
										@endforeach
										<label class="custom">Data yang anda unggah sudah sesuai dengan persyaratan ?</label>
										<div class="form-group radio_input">
											<label class="container_radio mr-3">Yes
												<input type="radio" name="remotely_full_time" value="Yes" class="required">
												<span class="checkmark"></span>
											</label>
										</div>
									@else
										<label class="custom">Tidak ada permintaan dokumen khusus. pilih "Yes" dan lanjutkan ke tahap berikutnya</label>
										<div class="form-group radio_input">
											<label class="container_radio mr-3">Yes
												<input type="radio" name="remotely_full_time" value="Yes" class="required">
												<span class="checkmark"></span>
											</label>
										</div>
									@endif
	                            </div>
	                        </div>
	                        <!-- /step-->

	                        <!-- /Work Availability > Part-time ============================== -->
	                        <div class="branch" id="Part-time">
	                            <div class="step" data-state="end">
	                                <h2 class="section_title">Work Availability</h2>
	                                <h3 class="main_question">Additional info about "Part Time" availability</h3>
	                                <div class="form-group add_bottom_30">
	                                    <label>Minimum salary? (in USD)</label>
	                                    <label for="minimum_salary_part_time">Choose a range</label>
	                                    <div class="styled-select clearfix">
	                                        <select class="form-control required" id="minimum_salary_part_time" name="minimum_salary_part_time">
	                                            <option value="">Choose a range</option>
	                                            <option value="&lt;2k">&lt;2k</option>
	                                            <option value="3-5k">3-5k</option>
	                                            <option value="5-7k">5-7k</option>
	                                            <option value="7-10k">7-10k</option>
	                                            <option value="&gt;10k">&gt;10k</option>
	                                        </select>
	                                    </div>
	                                </div>
	                                <div class="form-group add_bottom_30">
	                                    <label>How soon would you be looking to start?</label>
	                                     <label for="start_availability_part_time">Choose your availability</label>
	                                    <div class="styled-select clearfix">
	                                        <select class="form-control required" id="start_availability_part_time" name="start_availability_part_time">
	                                            <option value="">Choose your availability</option>
	                                            <option value="I can start immediately">I can start immediately</option>
	                                            <option value="I need to give 2 or 4 weeks notice">I need to give 2–4 weeks notice</option>
	                                            <option value="I am passively browsing">I am passively browsing</option>
	                                            <option value="I will be available in a couple months">I will be available in a couple months</option>
	                                            <option value="I am not sure">I am not sure</option>
	                                        </select>
	                                    </div>
	                                </div>
	                                <label class="custom">When you prefer to work?</label>
	                                <div class="form-group radio_input">
	                                    <label class="container_radio mr-3">Morning
	                                        <input type="radio" name="day_preference_part_time" value="Morning" class="required">
	                                        <span class="checkmark"></span>
	                                    </label>
	                                    <label class="container_radio mr-3">Afternoon
	                                        <input type="radio" name="day_preference_part_time" value="Afternoon" class="required">
	                                        <span class="checkmark"></span>
	                                    </label>
	                                    <label class="container_radio">No Preferences
	                                        <input type="radio" name="day_preference_part_time" value="No Preferences" class="required">
	                                        <span class="checkmark"></span>
	                                    </label>
	                                </div>
	                            </div>
	                        </div>
	                        <!-- /step-->

	                        <!-- /Work Availability > Freelance-Contract ============================== -->
	                        <div class="branch" id="Freelance-Contract">
	                            <div class="step" data-state="end">
	                                <h2 class="section_title">Work Availability</h2>
	                                <h3 class="main_question">Additional info about "Freelance/Contract" availability</h3>
	                                <div class="form-group">
	                                    <label for="fixed_rate_contract">Minimum fixed rate? (in USD)</label>
	                                    <input type="text" name="fixed_rate_contract" id="fixed_rate_contract" class="form-control required">
	                                </div>
	                                <div class="form-group">
	                                    <label for="hourly_rate_contract">Minimum hourly rate? (in USD)</label>
	                                    <input type="text" name="hourly_rate_contract" id="hourly_rate_contract" class="form-control required">
	                                </div>
	                                <div class="form-group">
	                                    <label for="minimum_hours_conctract">Minimum hours for a contract?</label>
	                                    <input type="text" name="minimum_hours_conctract" id="minimum_hours_conctract" class="form-control required">
	                                </div>
	                                <label class="custom">Are you willing to work remotely?</label>
	                                <div class="form-group radio_input">
	                                    <label class="container_radio mr-3">Yes
	                                        <input type="radio" name="remotely_contract" value="Yes" class="required">
	                                        <span class="checkmark"></span>
	                                    </label>
	                                    <label class="container_radio">No
	                                        <input type="radio" name="remotely_contract" value="No" class="required">
	                                        <span class="checkmark"></span>
	                                    </label>
	                                </div>
	                            </div>
	                        </div>
	                        <!-- /step-->

	                        <div class="submit step" id="end">
	                            <div class="summary">
	                                <div class="wrapper">
	                                    <h3 style="text-transform: capitalize"><span id="name_field"></span>!</h3>
	                                    <p>tekan tombol submit untuk melakukan pendaftaran <br/> setelah mendaftar periksa email anda secara berkala pada <br/> <strong id="email_field"></strong></p>
	                                </div>
	                                <div class="text-center">
	                                    <div class="form-group terms">
	                                        <label class="container_check">Tolong baca dan setujui syarat & ketentuan berikut sebelum anda mendaftar <a href="#" data-toggle="modal" data-target="#terms-txt">Persyaratan & Ketentuan</a>
	                                            <input type="checkbox" name="terms" value="Yes" class="required">
	                                            <span class="checkmark"></span>
	                                        </label>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <!-- /step last-->

	                    </div>
	                    <!-- /middle-wizard -->
	                    <div id="bottom-wizard">
	                        <button type="button" name="backward" class="backward">Prev</button>
	                        <input type="button" id="next" name="forward" class="forward btn btn-success" value="Next">
	                        <button type="submit" name="process" class="submit">Submit</button>
							{{-- <input type="submit" name="submit" id="btnupdatenilai" class="btn btn-danger" value="Submit" /> --}}
	                    </div>
	                    <!-- /bottom-wizard -->
	                </form>
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
					<h4 class="modal-title" id="termsLabel">Syarat dan Ketentuan</h4>
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