@extends('layouts.tilawatipusat_layouts.master')

@section('title') Profile Kepala Bagian @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="{{URL::asset('tilawatipusat/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />


@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') KEPALA BAGIAN  @endslot
         @slot('title_li')   @endslot
    @endcomponent
    <div class="row">
    
    <div class="col-md-12 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="profile-widgets py-3">

                    <div class="text-center">
                        <div class="">
                            <img src="{{ asset('photo/'.$data->photo) }}" alt="" class="avatar-lg mx-auto img-thumbnail rounded-circle">
                            <div class="online-circle"></div>
                        </div>

                        <div class="mt-3 text-uppercase">
                            <a href="#" class="text-dark font-weight-medium font-size-16">
                                {{ $data->name }}
                            </a>
                        </div>
                        <p>{{ $data->telp }}</p>
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
                            <span class="d-none d-sm-block">KEPALA BAGIAN</span>
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
                            <div class="text-capitalize">
                                <div class="text-center">
                                    <h5 class="text-capitalize text-primary">{{ strtolower($data->name) }}</h5>
                                </div>
                                @if ($data->cabang->count() == 0)
                                
                                @else
                                    @foreach ($data->cabang as $item)
                                    <hr>
                                    <div class="text-center">
                                        <p class="text-info">Kepala Cabang<br><b>{{ $item->name }}</b></p>
                                    </div>
                                    <div class="text-muted">
                                        <span>Alamat Cabang</span><br>
                                        <b class="text-capitalize">{{ strtolower($item->alamat) }}</b><br>
                                    </div>
                                    @endforeach
                                @endif
                                @if ($data->lembaga->count() == 0)
                                <hr>
                                @else
                                    @foreach ($data->lembaga as $item)
                                    <hr>
                                    <div class="text-center">
                                        <p class="text-info">Kepala Lembaga<br><b>{{ $item->name }} - {{ $item->kabupaten->nama }}</b></p>
                                    </div>
                                    <div class="text-muted">
                                        <span>Alamat lembaga</span><br>
                                        <b class="text-capitalize">{{ strtolower($item->alamat) }}</b><br>
                                        <span>Tahun Masuk / Bergabung</span><br>
                                        <b class="text-capitalize">{{ Carbon\Carbon::parse($item->tahunmasuk)->isoFormat('D MMMM Y') }}</b>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane " id="settings" role="tabpanel">

                        <div class="row mt-4">
                            
                        </div>

                        <div class="row">
                            <div class="col-12">
                                
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