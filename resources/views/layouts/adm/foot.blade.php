</div> <!-- content -->

<footer class="footer">
    © 2021 <b>Program Pelatihan PonPes Nurul Falah</b> <span class="d-none d-sm-inline-block"> - Crafted with <i
            class="mdi mdi-heart text-danger"></i> IT & Administrasi Team.</span>
</footer>

</div>
<!-- End Right content here -->

</div>
<!-- END wrapper -->


<!-- jQuery  -->
<script src="{{asset('adm/js/jquery.min.js')}}"></script>
<script src="{{asset('adm/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('adm/js/modernizr.min.js')}}"></script>
<script src="{{asset('adm/js/detect.js')}}"></script>
<script src="{{asset('adm/js/fastclick.js')}}"></script>
<script src="{{asset('adm/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('adm/js/jquery.blockUI.js')}}"></script>
<script src="{{asset('adm/js/waves.js')}}"></script>
<script src="{{asset('adm/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('adm/js/jquery.scrollTo.min.js')}}"></script>

<!-- Alertify js -->
<script src="{{ asset('adm/plugins/alertify/js/alertify.js') }}"></script>
<script src="{{ asset('adm/pages/alertify-init.js') }}"></script>

<!-- skycons -->
<script src="{{asset('adm/plugins/skycons/skycons.min.js')}}"></script>

<!-- Dropzone js -->
<script src="{{ asset('adm/plugins/dropzone/dist/dropzone.js') }}"></script>

<!-- skycons -->
<script src="{{asset('adm/plugins/peity/jquery.peity.min.js')}}"></script>

<!-- Required datatable js -->
<script src="{{asset('adm/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adm/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!-- Buttons examples -->
<script src="{{asset('adm/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('adm/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('adm/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{asset('adm/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{asset('adm/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{asset('adm/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('adm/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('adm/plugins/datatables/buttons.colVis.min.js')}}"></script>
<!-- Responsive examples -->
<script src="{{asset('adm/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('adm/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

<!-- Datatable init js -->
<script src="{{asset('adm/pages/datatables.init.js')}}"></script>

<!--Morris Chart-->
{{-- <script src="{{asset('adm/plugins/morris/morris.min.js')}}"></script>
<script src="{{asset('adm/plugins/raphael/raphael-min.js')}}"></script> --}}

<!-- dashboard -->
{{-- <script src="{{asset('adm/pages/dashboard.js')}}"></script> --}}

<!-- App js -->
<script src="{{asset('adm/js/app.js')}}"></script>

<script type="text/javascript">

$(document).ready(function () {
        let location = window.location.href;
        let split_link = location.split('/');
        if (split_link[3] !== 'dashboard') {
            setInterval(showTime, 500);
            calender();
        }
    });

    function showTime() {
        var a_p = "";
        var today = new Date();
        var curr_hour = today.getHours();
        var curr_minute = today.getMinutes();
        var curr_second = today.getSeconds();
        if (curr_hour < 12) {
            a_p = "AM";
        } else {
            a_p = "PM";
        }
        if (curr_hour == 0) {
            curr_hour = 12;
        }
        if (curr_hour > 12) {
            curr_hour = curr_hour - 12;
        }
        curr_hour = checkTime(curr_hour);
        curr_minute = checkTime(curr_minute);
        curr_second = checkTime(curr_second);
        document.getElementById('clock').innerHTML = "" + " " + curr_hour + " : " + curr_minute + " : " + curr_second +
            " " + a_p;
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }

    function calender() {
        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
            'November', 'Desember'
        ];
        var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth();
        var thisDay = date.getDay(),
            thisDay = myDays[thisDay];
        var yy = date.getYear();
        var year = (yy < 1000) ? yy + 1900 : yy;
        // document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
        console.log(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
        if (thisDay !== null) {

        }
        document.getElementById('hari').innerHTML = thisDay;
        document.getElementById('tgl').innerHTML = day;
        document.getElementById('bln').innerHTML = months[month];
    }
</script>

@yield('script')
<!-- Menampilkan Hari, Bulan dan Tahun -->
<br>

</body>

</html>
