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
    
    

    <div class="col-md-12 ">
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
                            <span class="d-none d-sm-block">BIODATA</span>
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
                                        <span>Kota / Kabupaten </span><br>
                                        <b class="text-capitalize">{{ strtolower($item->kabupaten->nama) }}</b><br>
                                        <span>Telephone </span><br>
                                        <b class="text-capitalize">{{ strtolower($item->telp) }}</b><br>
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
                                        <span>Telphone</span><br>
                                        <b class="text-capitalize">{{ strtolower($item->telp) }}</b><br>
                                        <span>Tahun Masuk / Bergabung</span><br>
                                        <b class="text-capitalize">{{ Carbon\Carbon::parse($item->tahunmasuk)->isoFormat('D MMMM Y') }}</b><br>
                                        <span>Status</span><br>
                                        <b class="text-capitalize">{{ $item->status }}</b>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane " id="settings" role="tabpanel">

                        <form method="post" id="formkepala" enctype="multipart/form-data">@csrf 
                            <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                                <footer class="blockquote-footer">  <cite title="Source Title">Data Diri</cite></footer>
                                <div class="row">
                                    <div class="form-group col-xl-6">
                                        <input type="hidden" name="id" id="kepala_id" class="form-control" value="{{ $data->id }}">
                                        <i class="text-danger">* </i><label for="NIK">NIK</label>
                                        <input type="text" class="form-control" placeholder="NIK (16 digit)" maxlength="16" minlength="16" size="16" name="nik" value="{{ $data->nik }}" readonly>
                                    </div>
                                    <div class="form-group col-xl-6">
                                        <i class="text-danger">* </i><label for="NAMA">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="name" value="{{ $data->name }}" readonly>
                                    </div>
                                    <div class="form-group col-xl-6">
                                        <i class="text-danger">* </i><label for="TELP">Telephone</label>
                                        <input type="number" name="telp" value="{{ $data->telp }}" class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-xl-6">
                                        <i class="text-danger">* </i><label for="GENDER">Gender</label>
                                        <select name="gender" id="" class="form-control" readonly>
                                            <option value="{{ $data->gender }}">{{ $data->gender }}</option>
                                            
                                        </select>
                                    </div>
                                    <div class="form-group col-xl-6">
                                        <i class="text-danger">* </i><label for="">Tempat Lahir (Kota / Kab)</label>
                                        <input type="text" value="{{ $data->tmptlahir }}" name="tmptlahir" class="form-control text-capitalize" readonly>
                                    </div>
                                    <div class="form-group col-xl-6">
                                        <i class="text-danger">* </i><label for="">Tanggal Lahir</label>
                                        <input type="date" value="{{ $data->tgllahir }}" name="tgllahir" class="form-control" readonly>
                                    </div>
                                </div><hr>
                                <footer class="blockquote-footer">  <cite title="Source Title">Bio Data (Sesuai KTP)</cite></footer>
                                <div class="row">
                                    <div class="form-group col-xl-6">
                                        <label><i class="text-danger">*</i> Provinsi</label>
                                        <select name="provinsi_id" id="mySelect" class="form-control" readonly>
                                                @if ($data->provinsi_id == null)
                                                    <option value=""></option>
                                                @else
                                                    <option value="{{ $data->provinsi_id }}">{{ $data->provinsi->nama }}</option>
                                                @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-xl-6">
                                        <label><i class="text-danger">*</i> Kabupaten / Kota</label>
                                        <select id="kabupaten_id" name="kabupaten_id" class="form-control" >
                                            @if ($data->kabupaten_id == null)
                                                <option value=""></option>
                                            @else
                                            <option value="{{ $data->kabupaten_id }}">{{ $data->kabupaten->nama }}</option>
                                            @endif
                                                
                                        </select>
                                    </div>
                                    <div class="form-group col-xl-6">
                                        <label><i class="text-danger">*</i> Kecamatan</label>
                                        <select id="kecamatan_id" name="kecamatan_id" class="form-control" >
                                            @if ($data->kecamatan_id == null)
                                                <option value=""></option>
                                            @else
                                            <option value="{{ $data->kecamatan_id }}">{{ $data->kecamatan->nama }}</option>    
                                            @endif
                                            
                                        </select>
                                    </div>
                                    <div class="form-group col-xl-6">
                                        <label><i class="text-danger">*</i> Kelurahan</label>
                                        <select id="kelurahan_id" name="kelurahan_id" class="form-control" >
                                            @if ($data->kelurahan_id == null)
                                                <option value=""></option>
                                            @else
                                            <option value="{{ $data->kelurahan_id }}">{{ $data->kelurahan->nama }}</option>
                                            @endif
                                           
                                        </select>
                                    </div>
                                    <div class="form-group col-xl-6">
                                        <i class="text-danger">* </i><label for="">Alamat</label>
                                        <textarea name="alamat" id="" cols="30" rows="5" class="form-control" readonly>{{ $data->alamat }}</textarea>
                                    </div>
                                </div>
                                <hr>
                                <footer class="blockquote-footer"> <cite title="Source Title">Data Pendukung</cite></footer>
                                <div class="row">
                                    <div class="form-group col-xl-6">
                                        <i class="text-danger">* </i><label for="">Pendidikan terakhir</label>
                                        <input type="text" name="pendidikanter" value="{{ $data->pendidikanter }}" class="form-control">
                                    </div>
                                    <div class="form-group col-xl-6">
                                        <i class="text-danger">* </i><label for="">Tahun Lulus</label>
                                        <input type="date" name="tahunlulus" class="form-control" value="{{ $data->tahunlulus }}" readonly>
                                    </div>
                                    <div class="form-group col-xl-6">
                                        <i class="text-danger">* </i><label for="">Pekerjaan</label>
                                        <input type="text" value="{{ $data->pekerjaan }}" name="pekerjaan" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xl-6">
                                        <i class="text-danger"></i><label for="">Foto <span class="text-warning"></span></label>
                                            
                                                <img @if ($data->photo == null) src="https://placehold.it/80x80" @else src="{{ asset('photo/'.$data->photo) }}" @endif id="preview" class="img-thumbnail">
                                    </div>
                                </div>
                            </blockquote>
                            </form>
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