        <!-- JAVASCRIPT -->
        <script src="{{ URL::asset('tilawatipusat/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{ URL::asset('tilawatipusat/libs/bootstrap/bootstrap.min.js')}}"></script>
        <script src="{{ URL::asset('tilawatipusat/libs/metismenu/metismenu.min.js')}}"></script>
        <script src="{{ URL::asset('tilawatipusat/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{ URL::asset('tilawatipusat/libs/node-waves/node-waves.min.js')}}"></script>

        @yield('script')

        <!-- App js -->
        <script src="{{ URL::asset('tilawatipusat/js/app.min.js')}}"></script>

        @yield('script-bottom')