<!-- Footer Style Three -->
<footer class="footer-style-three">
    <div class="auto-container">
        <!-- Widgets Section -->
        <div class="widgets-section">
            <div class="row clearfix">
                
                <!--Footer Column-->
                <div class="footer-column col-lg-4 col-md-6 col-sm-12">
                    <div class="footer-widget social-widget">
                        <h6>Follow Us Now</h6>
                        <ul class="social-list">
                            <li><a href="https://www.facebook.com/pes.nurulfalah"><span class="icon fa fa-facebook"></span></a></li>
                            <li><a href="https://twitter.com/pes_nfsby"><span class="icon fa fa-twitter"></span></a></li>
                            <li><a href="https://instagram.com/pesantren_nurul_falah?utm_medium=copy_link"><span class="icon fa fa-instagram"></span></a></li>
                            <li><a href="https://youtube.com/channel/UC1Xkdp_DKN0hJL85UWxH_Gg"><span class="icon fa fa-youtube"></span></a></li>
                        </ul>
                    </div>
                </div>
                
                <!--Footer Column-->
                <div class="footer-column col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-widget logo-widget">
                        <div class="logo">
                            <a href="#"><img src="{{ asset('assets/images/nf_logo_white.png') }}" width="130px" alt="" /></a>
                        </div>
                        <div class="copyright">&copy; 2021 <a href="#">Management & IT </a> Tilawati Pusat.</div>
                    </div>
                </div>
                
                <!--Footer Column-->
                <div class="footer-column col-lg-4 col-md-6 col-sm-12">
                    <div class="footer-widget visit-widget">
                        <h6>Visit</h6>
                        <div class="text">
                            Jl. Ketintang Timur PTT VB, Pesantren Nurul Falah
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</footer>


</div>
<!--End pagewrapper-->

<!-- Search Popup -->
<div class="search-popup">
<button class="close-search style-two"><span class="flaticon-multiply"></span></button>
<button class="close-search"><span class="flaticon-up-arrow-1"></span></button>
<form method="post" action="blog.html">
    <div class="form-group">
        <input type="search" name="search-field" value="" placeholder="Search Here" required="">
        <button type="submit"><i class="fa fa-search"></i></button>
    </div>
</form>
</div>
<!-- End Header Search -->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-up"></span></div>
<script src="{{ asset('tilawatipusat/landing/js/jquery.js') }}"></script>
<script src="{{ asset('tilawatipusat/landing/js/popper.min.js') }}"></script>
<script src="{{ asset('tilawatipusat/landing/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('tilawatipusat/landing/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('tilawatipusat/landing/js/appear.js') }}"></script>
<script src="{{ asset('tilawatipusat/landing/js/parallax.min.js') }}"></script>
<script src="{{ asset('tilawatipusat/landing/js/tilt.jquery.min.js') }}"></script>
<script src="{{ asset('tilawatipusat/landing/js/jquery.paroller.min.js') }}"></script>
<script src="{{ asset('tilawatipusat/landing/js/owl.js') }}"></script>
<script src="{{ asset('tilawatipusat/landing/js/wow.js') }}"></script>
<script src="{{ asset('tilawatipusat/landing/js/nav-tool.js') }}"></script>
<script src="{{ asset('tilawatipusat/landing/js/jquery-ui.js') }}"></script>
<script src="{{ asset('tilawatipusat/landing/js/script.js') }}"></script>
@yield('script')
</body>
</html>