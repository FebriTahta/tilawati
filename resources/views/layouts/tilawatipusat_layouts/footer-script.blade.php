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
        @if (auth()->user()->role !== 'pusat')
        @php
                        $pengurus = App\Models\Penguruscabang::where('cabang_id', auth()->user()->cabang->id)->get();
                        $nama_pengurus = [];
                        $tot = [];
                        foreach ($pengurus as $key => $value) {
                            # code...
                            if ($value->nama_pengurus !== null) {
                                # code...
                                $nama_pengurus[] = $value->nama_pengurus;
                                $tot[] = 1;
                            }
                        }
                        $data_pengurus = array_sum($tot);
                        $data_syirkah  = auth()->user()->cabang->syirkah;
                    @endphp
        @else
                @php
                        $data_pengurus = 5;
                        $data_syirkah  = 1;
                @endphp
        @endif
        
       <!-- Toast -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
       <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        @if (auth()->user()->role !== 'pusat' && $data_pengurus < 5 || $data_syirkah == null)
        <script>
                $(document).ready(function() {
                        $('.belum-lengkap').on('click', function () {
                                toastr.error('lengkapi data pengurus cabang & upload dokumen syirkah');
                                swal({
                                title: "MAAF!",
                                text: 'lengkapi data pengurus cabang & upload dokumen syirkah pada menu : Data Cabang Se-Indonesia',
                                type: "error"
                                });
                        })
                });
        </script>
        @endif
       