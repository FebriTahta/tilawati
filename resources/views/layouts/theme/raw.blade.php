<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->
<style>
    .tes::before{
        content: '';
        position: absolute;
        background-color: #30b8ac;
        width: 3px;
        height: 90%;
        bottom: 0;
    }
</style>
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Charry - Charry HTML Templates</title>

    <meta name="author" content="themesflat.com">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Bootstrap  -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/stylesheets/bootstrap.css')}}" >

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/stylesheets/style.css')}}">

    <!-- Responsive -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/stylesheets/responsive.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/stylesheets/revolution-slider.css')}}">

    <!-- Colors -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/stylesheets/colors/color2.css')}}" id="colors">
    
    <!-- Animation Style -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/stylesheets/animate.css')}}">

    <!-- Favicon and touch icons  -->
    <link href="{{asset('assets/icon/apple-touch-icon-48-precomposed.png')}}" rel="apple-touch-icon-precomposed" sizes="48x48">
    <link href="{{asset('assets/icon/apple-touch-icon-32-precomposed.png')}}" rel="apple-touch-icon-precomposed">
    <link href="{{asset('assets/icon/favicon.png')}}" rel="shortcut icon">

    <!--[if lt IE 9]>
        <script src="javascript/html5shiv.js"></script>
        <script src="javascript/respond.min.js"></script>
    <![endif]-->
</head> 

<body class="header-sticky home-boxed">
    <div class="loader">
        <span class="loader1 block-loader"></span>
        <span class="loader2 block-loader"></span>
        <span class="loader3 block-loader"></span>
    </div>
    <!-- Header --> 
    <header id="header" class="header clearfix"> 
        <div class="header-wrap clearfix">
            <div id="logo" class="logo" style="min-height: 50px">
                <a href="index.html" rel="home">
                    {{-- <img src="{{asset('assets/images/logo.png')}}" alt="LOGO"> --}}
                    <img src="{{asset('assets/images/nf_logo.png')}}" style="width: 150px" alt="LOGO">
                </a>
            </div><!-- /.logo -->            
            <div class="nav-wrap">
                <div class="btn-menu">
                    <span></span>
                </div><!-- //mobile menu button -->
                <nav id="mainnav" class="header-sticky home mainnav">
                    <ul class="menu">                         
                        <li class="has-sub"><a href="about.html">About</a>
                        </li> 

                        <li><a href="programs.html">Programs</a>
                        </li>

                        <li><a href="causes.html">Causes</a>              
                        </li>

                        <li class="has-sub"><a href="gallery.html">Gallery</a>   
                        </li>

                        <li><a href="blog.html">News</a>
                            <ul class="submenu"> 
                                <li><a href="blog-single.html">Blog Single</a></li> 
                            </ul><!-- /.submenu --> 
                        </li>

                        <li><a href="contact.html">Contact</a>
                        </li>
                    </ul><!-- /.menu -->
                </nav><!-- /.mainnav -->    
            </div><!-- /.nav-wrap -->

            <div class="flat-information">
                <ul class="flat-socials">                   
                </ul>

                <div id ="s" class="search-box show-search">
                    <a href="#search" class="flat-search"><i class="fa fa-search"></i></a> 
                    <div class="submenu top-search">
                        <div class="widget widget_search">
                            <form class="search-form">
                                <input type="search" class="search-field" placeholder="Search …">
                                <input type="submit" class="search-submit">
                            </form>
                        </div>
                    </div>        
                </div><!-- /.show-search -->
            </div>
        </div><!-- /.header-inner --> 
    </header><!-- /.header -->

    <!-- Slider -->
    <div class="tp-banner-container">
        <div class="tp-banner">
            <ul>
                <li data-transition="random-static" data-slotamount="7" data-masterspeed="1000" data-saveperformance="on">
                    <img src="{{asset('assets/images/slides/2.jpg')}}" alt="slider-image"/>
                    <div class="overlay"></div>

                    <div class="tp-caption sfb title-slide box center color-white large style2" data-x="112" data-y="207" data-speed="1500" data-start="1500" data-easing="Power3.easeInOut">
                    Every problem has <br> a great <span>Solution</span></div>
                   

                    <div class="tp-caption sft desc-slide center color-white style3" data-x="112" data-y="396" data-speed="1000" data-start="1500" data-easing="Power3.easeInOut">
                    Consectetur ed do eiusmod tempor incid idunLorem ipsum dolor sit amet, con <br>sectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore <br> magna aliqua enim ad minim veniam quis</div>

                    <div class="tp-caption sfl flat-button border-white start" data-x="112" data-y="528" data-speed="1000" data-start="2000" data-easing="Power3.easeInOut"><a href="#">Learn More</a></div>
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

    <section class="flat-row flat-featured-causes no-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="flat-causes bg-transparent">
                        <div class="text-left">
                            <p>Event Mendatang</p>
                        </div><!-- /text-left -->
                        <div class="featured-causes" >
                            <div class="block">
                                <div class="causes-img style1">
                                    <img src="{{asset('assets/images/about/index-2/1.jpg')}}" alt="image">
                                    <div class="transparent"></div>
                                </div>
                            </div><!-- /item -->

                            <div class="item">
                                <div class="causes-img style1">
                                    <img src="{{asset('assets/images/about/index-2/1.jpg')}}" alt="image">
                                    <div class="transparent"></div>
                                </div>
                                
                            </div><!-- /item -->

                            <div class="item">
                                <div class="causes-img style1">
                                    <img src="{{asset('assets/images/about/index-2/3.jpg')}}" alt="image">
                                    <div class="transparent"></div>
                                </div>
                                
                            </div><!-- /item -->
                        </div><!-- /featured-causes -->
                    </div>
                </div><!-- /col-md-10 col-md-offset-1 -->
            </div><!-- /row -->
        </div><!-- /container -->
    </section><!-- /flat-row flat-urgent-causes no-padding -->

    <section class="flat-row flat-about-charry">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="title-section">
                        <h4>a little bit more</h4>
                        <h2><span>Berita</span> Terbaru</h2>
                    </div>
                </div><!-- /.col-md-8 -->
            </div><!-- /.row -->
            <div class="about-charry">
                <div class="row">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">
                        <img src="{{asset('assets/images/about/index-2/4.jpg')}}" alt="image">
                    </div>
                    <div class="col-md-4">
                        <div class="about-charry-post">
                            <h4 class="title-post">
                                <a href="#">We Serve the Huminity</a>
                            </h4>
                            <p>magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure</p>
                            <div class="about-button">
                                <button class="flat-button button-style" style="margin-top: 13px">Learn More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container -->   
    </section><!-- /flat-row flat-about-charry -->    

    

    {{-- <div class="page-title parallax parallax5">
        <div class="overlay"></div>            
        <div class="container">
            <div class="row">
                <div class="col-md-12">              
                    <div class="page-title-heading">     
                        <p>Join Us</p> 
                        <h2 class="title white">Lets make the world <br> better together</h2>
                    </div><!-- /.page-title-heading -->
                    <div class="parallax-button">
                        <button class="flat-button button-style">Become a Volunteer</button>
                    </div>
                </div><!-- /.col-md-12 -->  
            </div><!-- /.row -->  
        </div><!-- /.container -->          
    </div><!-- /page-title parallax parallax5 --> --}}

    <section class="flat-row flat-our-events">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="title-section">
                        <h4>Bergabung Dengan Kami</h4>
                        <h2><span>Next</span> Events</h2>
                    </div>
                </div><!-- /.col-md-8 -->
            </div><!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="flat-events">
                        <article class="entry clearfix">                       
                            <div class="events-post">
                                <a href="#"><img src="{{asset('assets/images/about/index-2/5.jpg')}}" alt="image"></a>
                            </div><!-- /.events-post -->

                            <div class="content-post">
                                <p class="date">June 05, 2016</p>
                                <h2 class="title-post"><a href="#">Duis temus nulla id conguet</a></h2>
                                <div class="meta-post clearfix">
                                    <ul>                                           
                                        <li class="time">10.00 am</li>
                                        <li class="address">
                                            <a href="#">Dhaka University</a>
                                        </li>
                                    </ul>
                                </div><!-- /.meta-post -->                                   
                                <div class="entry-post">
                                    <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. m ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> 

                                    <div class="more">
                                        <a href="#" class="">Learn More</a>
                                    </div>                                   
                                </div><!-- /.entry-post -->
                            </div><!-- /content-post -->                            
                        </article><!-- /.entry -->                        

                        <article class="entry clearfix entry-style1">                       
                            <div class="events-post">
                                <a href="#"><img src="{{asset('assets/images/about/index-2/6.jpg')}}" alt="image"></a>
                            </div><!-- /.events-post -->

                            <div class="content-post">
                                <p class="date">June 05, 2016</p>
                                <h2 class="title-post"><a href="#">Duis temus nulla id conguet</a></h2>
                                <div class="meta-post clearfix">
                                    <ul>                                           
                                        <li class="time">10.00 am</li>
                                        <li class="address">
                                            <a href="#">Dhaka University</a>
                                        </li>
                                    </ul>
                                </div><!-- /.meta-post -->                                   
                                <div class="entry-post">
                                    <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. m ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> 

                                    <div class="more">
                                        <a href="#">Learn More</a>
                                    </div>                                   
                                </div><!-- /.entry-post -->
                            </div><!-- /content-post -->                            
                        </article><!-- /.entry -->
                    </div><!-- /flat-events -->
                    
                </div><!-- /.col-md-12 -->
            </div>
        </div><!-- /contrainer -->
    </section><!-- /flat-row flat-our-events -->   
    

    <footer class="footer padding-top120px">
        <div class="footer-widgets">
            <div class="container">
                <div class="row"> 
                    <div class="col-md-5">  
                        <div class="widget widget-text">
                            <h4 class="widget-title">About Charry</h4>
                            <div class="text">                                
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
                            </div><!-- /.textwidget -->
                            <ul class="flat-socials">
                                <li class="facebook">
                                    <a href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="twitter">
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="google">
                                    <a href="#">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                                <li class="linkedin">
                                    <a href="#">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                                <li class="dribbble">
                                    <a href="#">
                                        <i class="fa fa-dribbble"></i>
                                    </a>
                                </li>
                            </ul>
                        </div><!-- /.widget -->      
                    </div><!-- /.col-md-5 --> 

                     <div class="col-md-3">  
                        <div class="widget contact-info">
                            <h4 class="widget-title">Address</h4>
                            <ul>
                                <li class="address"><a href="#">22, Bardeshi Amin Bazar</a></li>
                                <li class="address1"><a href="#">Dhaka, Bangladesh</a></li>
                                <li class="phone"><a href="#">+123 - 111 - 123456</a></li>
                                <li class="phone1"><a href="#">+123 - 111 - 123457</a></li>
                                <li class="email"><a href="#">email@website.com</a></li>  
                            </ul>
                        </div>  
                    </div><!-- /.col-md-3 -->

                     <div class="col-md-4">  
                        <div class="widget widget_mc4wp">
                            <div id="mc4wp-form-1" class="form mc4wp-form clearfix">
                            <h4 class="widget-title">Subscribe Us</h4>
                                <div class="mail-chimp">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna amader liqua.</p>
                                    <form action="#" id="mailform" method="get">
                                        <input type="email" id="m" class="mmm" placeholder="Your Email">
                                        <input type="submit" value="" id="gmail">
                                    </form>
                                </div>
                            </div>
                        </div>     
                    </div><!-- /.col-md-4 -->
                </div><!-- /.row -->    
            </div><!-- /.container -->
        </div><!-- /.footer-widgets -->
    </footer><!-- /footer -->

    <!-- Go Top -->
    <a class="go-top">
        <i class="fa fa-chevron-up"></i>
    </a>

    <!-- Javascript -->
    <script type="text/javascript" src="{{asset('assets/javascript/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/javascript/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/javascript/jquery.easing.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/javascript/owl.carousel.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/javascript/jquery.flexslider.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/javascript/jquery.sticky.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/javascript/imagesloaded.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/javascript/jquery.isotope.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/javascript/jquery-countTo.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/javascript/jquery-waypoints.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/javascript/jquery.cookie.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/javascript/main.js')}}"></script>

    <!-- Revolution Slider -->
    <script type="text/javascript" src="{{asset('assets/javascript/jquery.themepunch.tools.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/javascript/jquery.themepunch.revolution.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/javascript/slider.js')}}"></script>

</body>
</html>