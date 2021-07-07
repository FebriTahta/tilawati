@extends('layouts.tilawatipusat_layouts.scanbarcode')

@section('title') Profile Peserta @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="{{URL::asset('tilawatipusat/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />


@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') PESERTA  @endslot
         @slot('title_li')   @endslot
    @endcomponent
    <div class="row">
    <?php 
        $total  = $peserta->nilai->where("kategori","al-qur'an")->sum('nominal');
        $total2 = $peserta->nilai->where("kategori","skill")->sum('nominal');
        $total3 = $peserta->nilai->where("kategori","skill")->count();
        // $rata2 = $data->nilai->sum('nominal');
        $rata2  = ($total + $total2)/($total3+1);
    ?>
    <div class="col-md-12 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="profile-widgets py-3">

                    <div class="text-center">
                        <div class="">
                            <img src="{{ asset('assets/images/tilawati.png') }}" alt="" class="avatar-lg mx-auto img-thumbnail rounded-circle">
                            <div class="online-circle"><i class="fas fa-circle text-success"></i></div>
                        </div>

                        <div class="mt-3 text-uppercase">
                            <a href="#" class="text-dark font-weight-medium font-size-16">{{ $peserta->name }}</a>
                            <p class="text-body mt-1 mb-1 text-capitalize">{{ $peserta->pelatihan->program->name }}</p>
                            <span >{{ Carbon\Carbon::parse($peserta->tanggal)->isoFormat('D MMMM Y') }}</span>
                            <br>
                            @if ($peserta->nilai->count() == 0)
                                <span class="badge badge-danger text-capitalize">Belum dinilai</span>
                            @else
                                @if ($rata2 > 84)
                                    <span class="badge badge-info text-capitalize">Bersyahadah</span>
                                @elseif($rata2 < 84 && $rata2 < 75)
                                    <span class="badge badge-danger text-capitalize">Belum Bersyahadah</span>
                                @else
                                    <span class="badge badge-info text-capitalize">Bersyahadah</span>
                                @endif
                            @endif
                            <br>
                        </div>

                        <div class="row mt-4 border border-left-0 border-right-0 p-3">
                            <div class="col-md-12">
                                <h6 class="text-info">NILAI</h6>
                                <h5 class="mb-0">{{ $rata2 }}</h5>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-xl-9">
        <div class="card">
            <div class="card-body">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#experience" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Detail DIklat & Nilai</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
                            <span class="d-block d-sm-none"><i class="fa fa-user"></i></span>
                            <span class="d-none d-sm-block">Biodata</span>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="experience" role="tabpanel">
                        <div class="form-group" style="margin-top: 20px">
                            <h5 class="text-uppercase text-primary">Informasi Peserta</h5>
                            <div style="text-align: justify">
                                <p>Peserta @if($program->name !== 'munaqosyah santri') Diklat @endif yang bernama "<b class="text-capitalize">{{ $peserta->name }}</b>" telah mengikuti @if($program->name !== 'munaqosyah santri') Diklat @endif <b class="text-capitalize"> {{ $program->name }} </b> 
                                yang diadakan oleh Cabang : <b class="text-capitalize"> {{ $pelatihan->cabang->name }} - {{ $pelatihan->cabang->kabupaten->nama }} </b></br> pada tanggal <i>{{ $pelatihan->tanggal }}</i> 
                                di <b> {{ $pelatihan->tempat }} </b></p>
                                <p>Dengan hasil akhir penilaian yang telah diberikan, maka. <br>
                                    <b class="text-capitalize">{{ $peserta->name }}</b> dinyatakan 
                                    @if ($peserta->nilai->count() == 0)
                                    <span class="badge badge-danger text-capitalize">Belum dinilai</span>
                                @else
                                    @if ($rata2 > 84)
                                        <i class="text-info text-capitalize">Bersyahadah</i> dengan predikat <i class="text-info">BAIK</i>
                                    @elseif($rata2 < 84 && $rata2 < 75)
                                        <i class="text-danger text-capitalize">Belum Bersyahadah</i>
                                    @else
                                        <i class="text-warning text-capitalize">Bersyahadah (CUKUP)</i>
                                    @endif
                                @endif
                                </p>
                            </div>
                            <br><hr><h5 class="text-uppercase text-primary">Detail Nilai</h5>

                            @foreach ($peserta->nilai as $item)
                                @if ($item->kategori !== 'skill')
                                <hr>
                                <p>Al Qur'an</p>
                                    <div class="row text-capitalize" style="margin-top: 5px">
                                        <span class="col-6 col-md-6 text-left">{{ $item->penilaian->name }}</span>
                                        <span class="col-6 col-md-6 text-right text-info">{{ $item->nominal }}</span>
                                    </div>
                                @else
                                <hr>
                                <p>Skill</p>
                                    <div class="row text-capitalize" style="margin-top: 5px">
                                        <span class="col-12 col-md-12">{{ $item->penilaian->name }}</span>
                                        <span class="col-12 col-md-12 text-info">{{ $item->nominal }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="tab-pane " id="settings" role="tabpanel">

                        <div class="row mt-4">
                            <div class="@if ($program->name == 'munaqosyah santri') col-md-4 @else col-xl-6 @endif">
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control text-capitalize" id="firstname" value="{{ $peserta->name }}" readonly>
                                </div>
                            </div>
                            @if ($program->name == 'munaqosyah santri')
                            <div class="@if ($program->name == 'munaqosyah santri') col-md-4 @else col-xl-6 @endif">
                                <div class="form-group">
                                    <label for="firstname">Asal Lembaga</label>
                                    <input type="text" class="form-control text-capitalize" id="firstname" value="{{ $peserta->lembaga->name }}" readonly>
                                </div>
                            </div>
                            @endif
                            <div class="@if ($program->name == 'munaqosyah santri') col-md-4 @else col-xl-6 @endif">
                                <div class="form-group">
                                    <label for="lastname">No Telephone</label>
                                    <input type="text" class="form-control" id="lastname" value="{{ $peserta->telp }}" readonly>
                                </div>
                            </div> <!-- end col -->
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="userbio">Alamat</label>
                                    <textarea class="form-control" id="userbio" rows="4" readonly>{{ $peserta->alamat }}</textarea>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
        

</div>

    <div class="col-md-12 col-xl-9">

        <div class="card">
            
        </div>
    </div>
 

</div>
@endsection

@section('script')

        <!-- Script Select2-->
        <script src="{{URL::asset('/tilawatipusat/libs/select2/select2.min.js')}}"></script>
        <script src="{{URL::asset('/tilawatipusat/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{URL::asset('/tilawatipusat/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
        <script src="{{URL::asset('/tilawatipusat/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
        <script src="{{URL::asset('/tilawatipusat/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

        <!-- form advanced init -->
        <script src="{{URL::asset('/tilawatipusat/js/pages/form-advanced.init.js')}}"></script>

        <!-- Toast -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        
        <!-- form mask -->
        <script src="{{URL::asset('/tilawatipusat/libs/inputmask/inputmask.min.js')}}"></script>
        <!-- form mask init -->
        <script src="{{URL::asset('/tilawatipusat/js/pages/form-mask.init.js')}}"></script>

        
@endsection