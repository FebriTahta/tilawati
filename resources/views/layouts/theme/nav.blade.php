<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Pondok Pesantren Nurul Falah</title>

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
    <!--float wa-->
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/fab.css') }}">

    @yield('head')
    <style>
        .scopes{
            content: '';
            position: absolute;
            background-color: aqua;
            width: 3px;
            height: 90%;
            bottom: 0;
            left: -7px;
        }
    </style>

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
            <div id="logo" class="logo">
                <a href="index.html" rel="home">
                    {{-- <img src="{{asset('assets/images/logo.png')}}" alt="LOGO"> --}}
                    <img src="{{asset('assets/images/nf_logo.png')}}" style="width: 150px;" alt="LOGO">
                </a>
            </div><!-- /.logo -->            
            <div class="nav-wrap">
                <div class="btn-menu">
                    <span></span>
                </div><!-- //mobile menu button -->
                <nav id="mainnav" class="mainnav">
                    <ul class="menu"> 
                        <li class="home has-sub">
                            <a href="index.html">Home</a>
                            <ul class="submenu">
                                <li><a href="index.html">Home1</a></li>
                                <li><a href="index-v2.html">Home2</a></li>
                                <li><a href="index-v3.html">Home3</a></li>
                                <li><a href="index-v4.html">Home4</a></li>
                                <li><a href="index-v5.html">Home5</a></li>   
                            </ul><!-- /.submenu -->
                        </li>
                        <li class="has-sub"><a href="about.html">Profile</a>
                        </li> 

                        <li><a href="programs.html">Programs</a>
                        </li>

                        <li><a href="causes.html">Produk</a>              
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
                        <li><a href="{{ route('cabang.index') }}">Admin</a>
                        </li>
                    </ul><!-- /.menu -->
                </nav><!-- /.mainnav -->    
            </div><!-- /.nav-wrap -->

            <div class="flat-information">
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
                            <i class="fa fa-youtube"></i>
                        </a>
                    </li>
                    <li class="dribbble">
                        <a href="#">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </li>
                </ul>

                <div id ="s" class="search-box show-search">
                    {{-- <a href="#search" class="flat-search"><i class="fa fa-search"></i></a> 
                    <div class="submenu top-search">
                        <div class="widget widget_search">
                            <form class="search-form">
                                <input type="search" class="search-field" placeholder="Search …">
                                <input type="submit" class="search-submit">
                            </form>
                        </div>
                    </div>         --}}
                </div><!-- /.show-search -->
            </div>
        </div><!-- /.header-inner --> 
    </header><!-- /.header -->