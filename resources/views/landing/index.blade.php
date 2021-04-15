@extends('layouts.theme.master')

@section('content')
    

    <!-- Slider -->
    <div class="tp-banner-container">
        <div class="tp-banner">
            <ul>
                <li data-transition="random-static" data-slotamount="7" data-masterspeed="1000" data-saveperformance="on">
                    <img src="{{asset('assets/images/slides/2.jpg')}}" alt="slider-image"/>
                    <div class="overlay"></div>

                    <div class="tp-caption sfb title-slide box center color-white large style2" data-x="112" data-y="207" data-speed="1500" data-start="1500" data-easing="Power3.easeInOut">
                    Tingkatkan Amal dengan <br>  <span> Berdonasi</span></div>
                   
                    <div class="tp-caption" data-x="112" data-y="528" data-speed="1000" data-start="2000" data-easing="Power3.easeInOut"><button href="#" class="btn btn-success">Klik Untuk Donasi</button></div>
                    <div class="tp-caption sft desc-slide center color-white style3" data-x="112" data-y="396" data-speed="1000" data-start="1500" data-easing="Power3.easeInOut">
                    <br><br> </div>

                    
                </li>

                <li data-transition="random-static" data-slotamount="7" data-masterspeed="1000" data-saveperformance="on">
                    <img src="{{asset('assets/images/slides/1.jpg')}}" alt="slider-image"/>
                    <div class="overlay"></div>

                    <div class="tp-caption sfr title-slide box center color-white large style1" data-x="112" data-y="272" data-speed="1500" data-start="1500" data-easing="Sine.easeInOut">No one has become <br> poor from <span>Giving</span></div>

                    <div class="tp-caption sfl flat-button border-white start" data-x="116" data-y="464" data-speed="1500" data-start="1500" data-easing="Sine.easeInOut"><a href="#">Learn More</a></div>
                </li>                

                <li data-transition="random-static" data-slotamount="7" data-masterspeed="1000" data-saveperformance="on">
                    <img src="{{asset('assets/images/slides/4.jpg')}}" alt="slider-image"/>
                    <div class="overlay"></div>

                    <div class="tp-caption sfr title-slide box center color-white large style1" data-x="112" data-y="272" data-speed="1500" data-start="1500" data-easing="Sine.easeInOut">The best use of your<br>money is <span>Giving</span></div>

                    <div class="tp-caption sfl flat-button border-white start" data-x="116" data-y="464" data-speed="1500" data-start="1500" data-easing="Sine.easeInOut"><a href="#">Learn More</a></div>
                 
                </li>
            </ul>
        </div>
    </div>

    <section class="flat-row flat-featured-causes no-padding" style="background-image:  linear-gradient(to top, rgba(255,0,0,0), rgb(0, 255, 115));">
        <div class="container" style="background-color: white">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="flat-causes bg-transparent">
                        <div class="text-left">
                            <p>PROGRAM <span> UTAMA </span></p>
                        </div><!-- /text-left -->
                        <div class="featured-causes" >
                            <div class="block">
                                <div class=" style2">
                                    <img src="{{asset('assets/images/about/index-2/1.jpg')}}" alt="image">
                                    <div class="transparent"></div>
                                </div>
                            </div><!-- /item -->

                            <div class="item">
                                <div class=" style3">
                                    <img src="{{asset('assets/images/about/index-2/1.jpg')}}" alt="image">
                                    <div class="transparent"></div>
                                </div>
                                
                            </div><!-- /item -->

                            <div class="item">
                                <div class=" style4">
                                    <img src="{{asset('assets/images/about/index-2/3.jpg')}}" alt="image">
                                    <div class="transparent"></div>
                                </div>
                                
                            </div><!-- /item -->
                        </div><!-- /featured-causes -->
                    </div>
                    
                </div><!-- /col-md-10 col-md-offset-1 -->
                {{-- <div class="block">                 --}}
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2" style="margin-top: 20px">
                            <div class="title-section" >
                                <h4></h4>
                                <h2 ><span class="text-primary">Spesial</span> Ramadhan</h2>
                            </div>
                        </div><!-- /.col-md-8 -->
                    </div><!-- /.row -->
                {{-- </div> --}}
                {{-- <section class="main-content blog-post v1">
                    <div class="container"> --}}
                        
                        <div class="container" style="background-color: white">
                            <div class="widget widget-recent-posts" style="margin-top: 20px">
                                <h5 class="widget-title">Rubik INSPIRASI</h5>
                            </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="post-wrap">
                                    <article class="post margin-bottom70px">
                                        
                                        <div class="entry-image">
                                            <img src="{{asset('assets/images/blog/blog-5.jpg')}}" alt="image">
                                        </div>
                                        <div class="content-post">
                                            <div class="title-education">
                                                <p>Rubik Inspirasi</p>
                                            </div>
                                            <h4 class="title-post">
                                                <a href="#">Judul Rubik Inspirasi</a>
                                            </h4>
                                            <div class="entry-meta">                              
                                                <span class="author"><a href="#">Penulis</a></span>
                                                <span class="date"><a href="#">May 02, 2016</a></span>
                                                <span class="comment"><a href="#">34 Comments</a></span>
                                            </div><!-- /.entry-meta -->
            
                                            <div class="entry-content">
                                                <p>Konten tentang potongan rubik inspirasi yang disampaikan secara singkat. namun apabila di klcik baca kisah akan menampilkan keseluruhan kisah pada rubik inspirasi</p>
                                            </div><!-- /entry-post -->
                                            <div class="more">
                                                <button class="btn btn-primary"> Baca Kisah</button>
                                            </div>
                                            <div class="lengkap text-right" style="float-right">
                                                <button class="btn btn-success"> Kisah Lainnya</button>
                                            </div>
                                        </div><!-- /content-post -->
                                    </article><!-- /post -->
                                </div><!-- /post-wrap -->
                            </div><!-- /col-md-8 -->   
    
                            <div class="col-md-4">
                                <div class="sidebar">
                                    <div class="widget widget-recent-posts">
                                        <h5 class="widget-title">Rubik HIKMAH</h5>
                                        <ul class="recent-posts clearfix">
                                            <li>
                                                <div class="thumb">
                                                    <img src="{{asset('assets/images/blog/widget/1.jpg')}}" alt="image">
                                                </div>
                                                <div class="text">
                                                    <a href="#">Judul Rubik Hikmah</a>
                                                    <p>May 10, 2016</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="thumb">
                                                    <img src="{{asset('assets/images/blog/widget/2.jpg')}}" alt="image">
                                                </div>
                                                <div class="text">
                                                    <a href="#">Judul Rubik Hikmah</a>
                                                    <p>May 10, 2016</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="thumb">
                                                    <img src="{{asset('assets/images/blog/widget/3.jpg')}}" alt="image">
                                                </div>
                                                <div class="text">
                                                    <a href="#">Judul Rubik Hikmah</a>
                                                    <p>May 10, 2016</p>
                                                </div>
                                            </li>
                                        </ul><!-- /popular-news clearfix -->
                                        <div class="text" >
                                            <button class="btn btn-success" type="button" style="margin-top: 20px; colgroup: #1dc3c9;">LEBIH BANYAK HIKMAH</button>
                                        </div>
                                    </div><!-- /widget widget-recent-posts -->
                                </div><!-- /sidebar -->
                            </div><!-- /col-md-4 -->
                              
                        </div><!-- /.row -->
                    </div>
                    <div class="row" style="margin-top: 50px">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="title-section ">
                                <h4 >Bergabung Dengan Kami</h4>
                                <h2 ><span>Acara</span> Mendatang</h2>
                            </div>
                        </div><!-- /.col-md-8 -->
                    </div><!-- /.row -->
                    <div class="container" style="background-color: white">
                        <div class="row">
                            <div class="col-md-12" style="margin-top: 50px">
                                <div class="flat-events">
                                    <article class="entry clearfix">                       
                                        <div class="events-post">
                                            <a href="#"><img src="{{asset('assets/images/about/index-2/5.jpg')}}" alt="image"></a>
                                        </div><!-- /.events-post -->
            
                                        <div class="content-post">
                                            <p class="date">June 05, 2021 </p>
                                            <small id="demo1"></small>

                                            <h2 class="title-post"><a href="#">Diklat</a></h2>
                                            <div class="meta-post clearfix">
                                                <ul>                                           
                                                    <li class="time">10.00 am</li>
                                                    
                                                    <li class="address">
                                                        <a href="#">PonPes Nurul Falah</a>
                                                    </li>
                                                </ul>
                                            </div><!-- /.meta-post -->                                   
                                            <div class="entry-post">
                                                
                                                <p>Acara diklat... yang dibawakan oleh....</p> 
            
                                                <div class="more">
                                                    <button href="#" class="btn btn-success">DAFTAR</button>
                                                </div>                                   
                                            </div><!-- /.entry-post -->
                                        </div><!-- /content-post -->                            
                                    </article><!-- /.entry -->                        
            
                                    <article class="entry clearfix entry-style1">                       
                                        <div class="events-post">
                                            <a href="#"><img src="{{asset('assets/images/about/index-2/6.jpg')}}" alt="image"></a>
                                        </div><!-- /.events-post -->
            
                                        <div class="content-post">
                                            <p class="date">June 05, 2021 </p>
                                            <p id="demo2"></p>
                                            
                                            <h2 class="title-post"><a href="#">Diklat</a></h2>
                                            <div class="meta-post clearfix">
                                                <ul>                                           
                                                    <li class="time">10.00 am</li>
                                                    
                                                    <li class="address">
                                                        <a href="#">PonPes Nurul Falah</a>
                                                    </li>
                                                </ul>
                                            </div><!-- /.meta-post -->                                   
                                            <div class="entry-post">
                                                
                                                <p>Acara diklat... yang dibawakan oleh....</p> 
            
                                                <div class="more">
                                                    <button href="#" class="btn btn-success">DAFTAR</button>
                                                </div>                                   
                                            </div><!-- /.entry-post -->
                                        </div><!-- /content-post -->                               
                                    </article><!-- /.entry -->
                                </div><!-- /flat-events -->
                            </div><!-- /.col-md-12 -->
                        </div>
                    </div>

                    <div class="row" style="margin-top: 50px">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="title-section ">
                                <h4 >Tetap terhubung</h4>
                                <h2 ><span>Berita & Artikel </span> Terbaru</h2>
                            </div>
                        </div><!-- /.col-md-8 -->
                    </div><!-- /.row -->

                    
                        <div class="container" style="background-color: white">
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 50px">
                                    <div class="recent-causes">
                                        <div class="post">
                                            <div class="wrap-post">
                                                <div class="img-recent-causes">
                                                    <a href="#"><img src="{{ asset('assets/images/about/index-1/17.jpg') }}" alt="image"></a>
                                                </div>
                                                <div class="post-recent-causes">
                                                    <h6 class="title-post">
                                                        <a href="#">JUDUL ARTIKEL / BERITA</a>
                                                    </h6>
                                                    <span class="badge badge-primary">ARTIKEL</span>
                                                </div>
                                                <div class="entry-post">
                                                
                                                    <p>Cuplikan Konten Berita / Artikel Cuplikan Konten Berita / Artikel</p> 
                                                    
                                                    <div class="more" style="margin-top: 20px">
                                                        <a href="#" class="btn btn-success">BACA</a>
                                                    </div>                                   
                                                </div><!-- /.entry-post -->
                                            </div>
                                        </div><!-- /post -->
                                        <div class="post">
                                            <div class="wrap-post">
                                                <div class="img-recent-causes">
                                                    <a href="#"><img src="{{ asset('assets/images/about/index-1/17.jpg') }}" alt="image"></a>
                                                </div>
                                                <div class="post-recent-causes">
                                                    <h6 class="title-post">
                                                        <a href="#">JUDUL ARTIKEL / BEITA</a>
                                                    </h6>
                                                    <span class="badge badge-primary">BERITA</span>
                                                </div>
                                                <div class="entry-post">
                                                
                                                    <p>Cuplikan Konten Berita / Artikel Cuplikan Konten Berita / Artikel</p> 
                                                    
                                                    <div class="more" style="margin-top: 20px">
                                                        <a href="#" class="btn btn-success">BACA</a>
                                                    </div>                                   
                                                </div><!-- /.entry-post -->
                                            </div>
                                        </div><!-- /post -->

                                        <div class="post">
                                            <div class="wrap-post">
                                                <div class="img-recent-causes">
                                                    <a href="#"><img src="{{ asset('assets/images/about/index-1/17.jpg') }}" alt="image"></a>
                                                </div>
                                                <div class="post-recent-causes">
                                                    <h6 class="title-post">
                                                        <a href="#">JUDUL BERITA / ARTIKEL</a>
                                                        
                                                    </h6>
                                                    <span class="badge badge-primary">ARTIKEL</span>
                                                </div>
                                                <div class="entry-post">
                                                
                                                    <p>Cuplikan Konten Berita / Artikel Cuplikan Konten Berita / Artikel</p> 
                                                    
                                                    <div class="more" style="margin-top: 20px">
                                                        <a href="#" class="btn btn-success">BACA</a>
                                                    </div>                                   
                                                </div><!-- /.entry-post -->
                                            </div>
                                        </div><!-- /post -->
                                        
                                    </div><!-- /recent-causes -->
                                    
                                </div><!-- /col-md-12 -->
                                
                            </div><!-- /row -->
                            <div class="lengkap text-center" style="margin-bottom: 20px">
                                <button class="btn btn-primary">Selengkapnya</button>
                            </div>
                        </div><!-- /container -->
                        <section class="flat-member">
                            <div class="title-section" >
                                <h4 style="margin-top: 50px">Pengurus Pondok Pesantren Nurul Falah</h4>
                                {{-- <h2><span>Our</span> Volunteers</h2> --}}
                            </div>
                            <div class="container" style="background-color: white">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        
                                    </div><!-- /.col-md-8 -->
                                </div><!-- /.row -->
                    
                                <div class="row">
                                    <div class="flat-member-carousel" data-item="3" data-nav="true" data-dots="false" data-auto="false">
                                        <div class="cs-module-4">
                                            <div class="item">
                                                <div class="overlay"></div>
                                                <img src="{{ asset('assets/images/pengurus.png') }}" alt="image">
                                            </div>
                                            <div class="demo">
                                                <div class="cs-post">
                                                    <div class="cs-post-header">
                                                        <div class="cs-category-links">
                                                            <h6 class="name"><a href="#">Juwel Khan</a></h6>
                                                            <span class="position">Student</span> 
                    
                                                            <div class="cs-post-footer">
                                                                <div class="cs-footer-share">
                                                                    <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                                                    <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                                                    <a href="#" target="_blank"><i class="fa fa-google-plus"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>                                
                                                    </div> 
                                                </div> 
                                            </div>
                                        </div>
                    
                                        <div class="cs-module-4">
                                            <div class="item">
                                                <div class="overlay"></div>
                                                <img src="{{ asset('assets/images/pengurus.png') }}" alt="image">
                                            </div>
                                            <div class="demo">
                                                <div class="cs-post">
                                                    <div class="cs-post-header">
                                                        <div class="cs-category-links">
                                                            <h6 class="name"><a href="#">Binika Sharma</a></h6>
                                                            <span class="position">Student</span> 
                    
                                                            <div class="cs-post-footer">
                                                                <div class="cs-footer-share">
                                                                    <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                                                    <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                                                    <a href="#" target="_blank"><i class="fa fa-google-plus"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>                                
                                                    </div> 
                                                </div> 
                                            </div>
                                        </div>
                    
                                        <div class="cs-module-4">
                                            <div class="item">
                                                <div class="overlay"></div>
                                                <img src="{{ asset('assets/images/pengurus.png') }}" alt="image">
                                            </div>
                                            <div class="demo">
                                                <div class="cs-post">
                                                    <div class="cs-post-header">
                                                        <div class="cs-category-links">
                                                            <h6 class="name"><a href="#">Akbar Hossain</a></h6>
                                                            <span class="position">Student</span> 
                    
                                                            <div class="cs-post-footer">
                                                                <div class="cs-footer-share">
                                                                    <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                                                    <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                                                    <a href="#" target="_blank"><i class="fa fa-google-plus"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>                                
                                                    </div> 
                                                </div> 
                                            </div>
                                        </div>
                    
                                        <div class="cs-module-4">
                                            <div class="item">
                                                <div class="overlay"></div>
                                                <img src="{{ asset('assets/images/pengurus.png') }}" alt="image">
                                            </div>
                                            <div class="demo">
                                                <div class="cs-post">
                                                    <div class="cs-post-header">
                                                        <div class="cs-category-links">
                                                            <h6 class="name"><a href="#">Minhaz Abedin</a></h6>
                                                            <span class="position">Student</span> 
                    
                                                            <div class="cs-post-footer">
                                                                <div class="cs-footer-share">
                                                                    <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                                                    <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                                                    <a href="#" target="_blank"><i class="fa fa-google-plus"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>                                
                                                    </div> 
                                                </div> 
                                            </div>
                                        </div>
                                    </div><!-- /flat-member-carousel -->
                                </div><!-- /row -->
                            </div><!-- /container -->
                        </section><!-- /flat-row flat-member -->
                    {{-- </div><!-- /.container -->   
                </section><!-- /main-content blog-post --> --}}
            </div><!-- /row -->
        </div><!-- /container -->
    </section><!-- /flat-row flat-urgent-causes no-padding -->

    <section class="flat-row flat-about-charry">
        <div class="container">
            
        </div><!-- /.container -->   
    </section><!-- /flat-row flat-about-charry -->
    <!--Float Wa-->
    <div class="floating-btn">
        <div class="fab-container">
            <div class="fab fab-icon-holder">
                <i class="fa fa-whatsapp"></i>
            </div>
            <ul class="fab-options">
                <li>
                    <span class="fab-label">Nurul Falah Utama</span>
                    <a class="fab-icon-holder" href="#">                
                        <i class="fa fa-whatsapp"></i>
                    </a>
                </li>
                <li>
                    <span class="fab-label">Nurul Falah Laziz</span>
                    <a class="fab-icon-holder" href="#">
                        <i class="fas fa fa-whatsapp"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    {{-- <section class="flat-row flat-our-events">
        <div class="container">
            
        </div><!-- /contrainer -->
    </section><!-- /flat-row flat-our-events -->    --}}
@endsection

@section('script')
<script>
    // Set the date we're counting down to
    var countDownDate = new Date("Jan 5, 2022 15:37:25").getTime();
    
    // Update the count down every 1 second
    var x = setInterval(function() {
    
      // Get today's date and time
      var now = new Date().getTime();
        
      // Find the distance between now and the count down date
      var distance = countDownDate - now;
        
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
      // Output the result in an element with id="demo"
      document.getElementById("demo1").innerHTML = days + ":d " + hours + ":h "
      + minutes + ":m " + seconds + ":s ";
      document.getElementById("demo2").innerHTML = days + ":d " + hours + ":h "
      + minutes + ":m " + seconds + ":s ";
        
      // If the count down is over, write some text 
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
        
      }
    }, 1000);
    </script>
@endsection