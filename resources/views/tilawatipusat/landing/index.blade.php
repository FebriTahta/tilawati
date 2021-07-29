@extends('layouts.tilawatipusat_landing.master')
@section('head')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection
@section('content')
    <!-- Banner Section -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ asset('tilawatipusat/landing/images/banner.jpg') }}" class="d-block w-100" alt="gambar">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
    </div>
	<!-- End Banner Section -->

    <!--Daftar Diklat-->
    <section class="faq-section">
		<div class="pattern-layer" style="background-image: url({{ asset('tilawatipusat/landing/images/background/7.jpg') }})"></div>
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title centered">
				<div class="title">Data E-Certificate</div>
				<h2>Cetak E-Certificate</h2>
				<div class="separate"></div>
			</div>
			<div class="row clearfix">
				@foreach ($diklat as $key=>$item)
                <!-- Accordion Column -->
				<div class="accordion-column col-lg-6 col-md-12 col-sm-12">
					<!-- Accordian Box -->
					<ul class="accordion-box">	
						<!--Block-->
						<li class="accordion block"> <?php date_default_timezone_set('Asia/Jakarta'); $date=$item->tanggal;?>
							<div class="acc-btn"><div class="icon-outer"><span class="icon icon-plus flaticon-plus-symbol"></span> <span class="icon icon-minus flaticon-substract"></span></div><span> {{ Carbon\Carbon::parse($date)->isoFormat('D MMMM Y') }} -</span> {{ $item->program->name }}</div>
							<div class="acc-content">
								<div class="content">
									<div class="text">
										<p class="text-capitalize">
                                        {{ strtoupper($item->cabang->name) }} - {{ $item->cabang->kabupaten->nama }}  <br/>
                                        Tempat pelaksanaan : {{ $item->tempat }}</p>
                                        <hr>
                                        <div class="form-group text-right">
                                            <a href="/e-certificate/{{ $item->slug }}" class="btn btn-sm btn-success">masuk</a>
                                        </div>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
                @endforeach
			</div>
		</div>
	</section>
    <!--End Daftar Diklat-->
@endsection