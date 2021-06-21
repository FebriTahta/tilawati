@extends('layouts.adm.master')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="float-right page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Diklat</a></li>
                <li class="breadcrumb-item active">Lembaga</li>
                <li class="breadcrumb-item active" id="clock"></li>
            </ol>
        </div>
        <div class="float-left page-breadcrumb">
            <ol class="breadcrumb">
                <span id="tgl"></span>&nbsp; <li class="breadcrumb-item active" id="bln"></li>
                <li class="breadcrumb-item active" id="hari"></li>
            </ol>
        </div>
        {{-- <h5 class="page-title">Lembaga</h5> --}}
    </div>
</div>
<!-- end row -->

<div class="row">
    <!--flash massage-->
    @include('layouts.sess.flash_message')
    <!--flash massage-->
    {{-- <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="float-left p-1 mr-3 " style="min-width: 100px">
                    <div class="text-center bg-primary rounded p-3">
                        <p class="text-white mb-0" id="bln"></p>
                        <h2 class="text-white mb-0" id="tgl"></h2>
                        <p class="text-white mb-0" id="hari"></p>
                    </div>
                </div>
                <div class="post-details text-right">
                    <h2 class="text-muted" id="clock"></h2>
                    <h5 class="text-muted">Selamat Beraktifitas</h5>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="col-xl-2" style="align-content: center;text-align: center">
        <div class="m-b-20" >
            <div class="text-center bg-primary rounded p-3 m-t-10 "style="text-align: center; max-width: 100px;">
                <p class="text-white mb-0" id="bln">October</p>
                <h2 class="text-white mb-0" id="tgl"></h2>
                <p class="text-white mb-0" id="hari"></p>
            </div>
            @if (auth()->user()->role=='pusat')
            <div style="text-align: center; max-width: 100px;">
                <a href="{{route('lembaga.create')}}" type="button" class="btn btn-primary m-t-10 waves-effect waves-light"><i class="fa fa-plus"></i> Lembaga</a>
            </div>
            @endif
        </div>
    </div> --}}
    <div class="col-xl-4" style="align-content: center;text-align: left">
        <div class="card mini-stat m-b-10 m-t-10">
            <div class="card-body text-left">
                <div class="border-bottom">
                    <blockquote class="blockquote font-18">
                        <h2 id="cb">???</h2>
                        <footer class="blockquote-footer">lembaga</footer>
                    </blockquote>
                </div>
            </div>
        </div>        
    </div>
    <div class="col-xl-4" style="align-content: center;text-align: left">
        <div class="card mini-stat m-b-10 m-t-10">
            <div class="card-body text-left">
                <div class="border-bottom">
                    <blockquote class="blockquote font-18">
                        <h2 id="cb2">???</h2>
                        <footer class="blockquote-footer">kabupaten - kota</footer>
                    </blockquote>
                </div>
            </div>
        </div>        
    </div>
    <div class="col-xl-4" style="align-content: center;text-align: left">
        <div class="card mini-stat m-b-10 m-t-10">
            <div class="card-body text-left">
                <div class="border-bottom">
                    <blockquote class="blockquote font-18">
                        <h2 id="cb3">???</h2>
                        <footer class="blockquote-footer">Provinsi</footer>
                    </blockquote>
                </div>
            </div>
        </div>        
    </div>
    {{-- <div class="col-xl-12">
        <div class=" m-b-30 bg-transparent">
            <div class="row">
                <div class="col-lg-4">
                    <a href="{{route('lembaga.create')}}" type="button" class="btn btn-primary waves-effect waves-light"><i class="fa fa-plus"></i> Tamabah Lembaga Baru</a>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="col-xl-10">
        <div class="card m-b-30">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">                          
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="mt-100 text-capitalize">
                                <tr>
                                    <th>Nama Lembaga</th>
                                    <th>Asal Cabang</th>
                                    <th>Kelembagaan</th>
                                    <th>Kepala Lembaga</th>
                                    <th>Jenjang</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten/Kota</th>
                                    <th>Telp</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                    <th>Tahun Berdiri</th>
                                    <th>Tahun Masuk</th>
                                    <th class="text-center">...</th>
                                </tr>
                                </thead>
                                <tbody class="text-capitalize">
                                    @if (auth()->user()->role=='cabang')
                                        @foreach (auth()->user()->cabang->lembaga as $item)
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @if ($item->kepala==null)
                                                    kosong
                                                @else
                                                    {{ $item->kepala->name}}
                                                @endif
                                            </td>
                                            <td>{{ $item->jenjang->name }}</td>
                                            <td style="width: 20%">{{ $item->alamat }}</td>
                                            <td>{{ $item->kabupaten->nama }}</td>
                                            <td>{{ $item->provinsi->nama }}</td>
                                            <td>{{ $item->telp }}</td>
                                            <td>
                                                @if ($item->status==1)
                                                    Aktif</p>
                                                @else
                                                    Non Aktif</p>
                                                @endif
                                            </td>
                                            <td>{{ $item->tglmasuk }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm text-white" style="background-color: rgb(151, 151, 255)"> <i class="fa fa-pencil"></i></button>
                                                <button class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></button>
                                            </td>
                                        @endforeach
                                    @else
                                        @foreach ($dt_l as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->cabang->name }}</td>
                                            <td>{{ $item->jenjang->name }}</td>
                                            <td>
                                                @if ($item->kepala == null)
                                                    kepala kosong
                                                @else
                                                {{ $item->kepala->name}}
                                                @endif
                                            </td>
                                            <td>{{ $item->jenjang->name }}</td>
                                            <td>{{ $item->provinsi->nama }}</td>
                                            <td>{{ $item->kabupaten->nama }}</td>
                                            <td>{{ $item->telp }}</td>
                                            <td style="width: 20%">{{ $item->alamat }}</td>
                                            <td>
                                                @if ($item->status==1)
                                                    Aktif</p>
                                                @else
                                                    Non Aktif</p>
                                                @endif
                                            </td>
                                            <td>{{ $item->tahunberdiri }}</td>
                                            <td>{{ $item->tahunmasuk }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm text-white" style="background-color: rgb(151, 151, 255)"> <i class="fa fa-pencil"></i></button>
                                                <button class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div> --}}

    <div class="col-xl-12">
        <div class="card mini-stat m-b-30">
            <div class="p-3 text-white" style="background-color: rgb(0, 208, 223)">
                <h6 class="fa fa-bank float-right mb-0"></h6>
                <h6 class="text-uppercase mb-0">data lembaga</h6>
            </div>
            <div class="card-body">
                <div class="border-bottom">
                    <div class="m-t-20 m-b-20 text-right m-r-10">
                        <button type="button" data-toggle="modal" data-target=".bs-example-modal-lembaga
                        " class="btn btn-primary waves-effect waves-dark btn-sm"><i class="mdi mdi-cloud-upload"></i> Import</button>
                        <a href="{{route('lembaga.create')}}" type="button" class="btn btn-primary waves-effect waves-light btn-sm"><i class="fa fa-plus"></i> Lembaga</a>
                    </div>
                    <blockquote class="text-left table-responsive">
                        <table id="datatable_lembaga" class="table datas table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="mt-100">
                            <tr>
                                <th>Lembaga</th>
                                <th>Kepala</th>
                                <th>Telephone</th>
                                <th>Kabupaten</th>
                                <th>Provinsi</th>
                                <th>Alamat</th>
                                <th>Est Guru</th>
                                <th>Est Santri</th>
                                <th>Tahun Masuk</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>Lembaga</th>
                                    <th>Kepala</th>
                                    <th>Telp</th>
                                    <th>Kabupaten</th>
                                    <th>Provinsi</th>
                                    <th>Alamat</th>
                                    <th>Estimasi Guru</th>
                                    <th>Estimasi Santri</th>
                                    <th>Tahun Masuk</th>
                                </tr>
                            </tfoot>
                        </table>
                        <footer class="blockquote-footer">Data lembaga terbaru berdasarkan tahun 2021</footer>
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="card m-b-30 ">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body mini-stat m-b-30">
                            
                            
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
</div>
<!-- end row -->

<!--modal update data lembaga-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">UPDATE DATA LEMBAGA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('lembaga.store') }}" method="POST">@csrf
                    <div class="form-group">
                        @if (auth()->user()->role=="cabang")
                            <input type="hidden" name="cabang_id" value="{{ auth()->user()->cabang->id }}" required>
                        @else
                        <select name="cabang_id" id="" class="form-control" required>
                            <option value="">= Pilih Cabang =</option>
                            {{-- @foreach ($dt_cabang as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach --}}
                        </select>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Nama Lembaga..." required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="kepala" class="form-control" placeholder="Nama Kepala Lembaga..." >
                    </div>
                    <div class="form-group">
                        <select name="jenis_id" id="" class="form-control" required>
                            <option value="">= Jenjang Lembaga =</option>
                            {{-- @foreach ($dt_jenis as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="alamat" class="form-control" id="" cols="20" rows="10">Alamat...</textarea>
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="form-group">
                                <select name="propinsi_id" id="" class="form-control" required>
                                    <option value="">= Pilih Propinsi =</option>
                                    {{-- @foreach ($dt_props as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <select name="kota_id" id="" class="form-control" required>
                                    <option value="">= Pilih Kota =</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Kode Pos..." >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                            <div class="form-group">
                                <input type="number" name="telp" class="form-control" placeholder="Telp..." >
                            </div>
                        </div>
                        <div class="col-6 form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email Lembaga..." required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="number" name="pengelola" class="form-control" placeholder="Pengelola..." >
                    </div>
                    <div class="row">
                        <div class="col-4 form-group">
                            <input type="number" class="form-control" name="totguru" placeholder="Total Guru" >
                        </div>
                        <div class="col-4 form-group">
                            <input type="number" class="form-control" name="totsantri" placeholder="Total Santri" >
                        </div>
                        <div class="col-4 form-group">
                            <input type="text" class="form-control" name="waktubelajar" placeholder="Waktu Belajar" >
                        </div>
                        <div class="col-4 form-group">
                            <label for="">Tahun Berdiri</label>
                            <input type="date" class="form-control" name="tahunberdiri" placeholder="Tahun Berdiri" >
                        </div>
                        <div class="col-4 form-group">
                            <label for="">Tahun Masuk</label>
                            <input type="date" class="form-control" name="tglmasuk" placeholder="Tanggal Masuk" >
                        </div>
                        <div class="col-4 form-group">
                            <label for="">Keanggotaan Aktif</label>
                            <select name="keanggotaan" id="" class="form-control" required>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-primary"> <i class="fa fa-save "></i> &nbsp; Save</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- modal import-->
<div class="col-sm-6 col-md-3 m-t-30">
    <div class="modal fade bs-example-modal-lembaga" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">IMPORT DATA LEMBAGA </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <form id="importlembaga"  method="POST" enctype="multipart/form-data">@csrf
                                        <div class="form-group">
                                            <label for="">Import Data "Lembaga" (hanya Excel File format .xlsx)</label>
                                            <input type="file" class="form-control" name="file" accept=".xlsx" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="import" id="btnimport" class="btn btn-info" value="Import" />
                                        </div>
                                    </form>
                                </div><!-- container fluid -->
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

<!-- modal add kepala -->
<div class="col-sm-6 col-md-3 m-t-30">
    <div class="modal fade bs-example-modal-kepala" id="tambah_kepala" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">TAMBAH KEPALA LEMBAGA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12">
                        <div class="row">
                            <div style="background-color: rgb(64, 216, 203)" data-toggle="modal" data-target="#tambah_kepala_baru" class="text-white col-12 card card-body text-center m-b-10 btn-sm waves-effect waves-dark btn-rounded">
                                KEPALA LEBAGA BARU
                            </div>
                            <div style="background-color: rgb(64, 216, 122)" data-toggle="modal" data-target="#tambah_kepala_lama" class="text-white col-12 card card-body text-center m-b-10 btn-sm waves-effect waves-dark btn-rounded">
                                KEPALA LEBAGA LAMA
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

<!-- modal add kepala baru-->
<div class="col-sm-6 col-md-3 m-t-30">
    <div class="modal fade bs-example-modal-kepala-baru" id="tambah_kepala_baru" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">KEPALA LEMBAGA BARU</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <form action="javascript:void(0)" method="POST" id="formKepalaStore" name="formKepalaStore">@csrf
                            <div class="row">
                                <div class="form-group col-xl-6">
                                    <label><i class="text-danger">*</i> NIK</label>
                                    <input type="text" name="nik" class="form-control " placeholder="NIK (16 digit)" maxlength="16" size="16" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label><i class="text-danger">*</i> Nama Lengkap</label>
                                    <input type="text" class="form-control text-capitalize" name="name" placeholder="" required>
                                </div>
                                <div class="form-group col-xl-12">
                                    <label for=""><i class="text-danger">*</i> Alamat Lengkap...</label>
                                    <textarea type="text" class="form-control text-capitalize" name="alamat" required></textarea>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for=""><i class="text-danger">*</i> Telephone</label>
                                    <input type="text" name="telp" class="form-control" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for=""><i class="text-danger">*</i> Gender</label><br>
                                    <div class="row col-12">
                                        <div class="col-2"></div>
                                        <input type="radio" name="gender" value="L" class="col-2" required><span> Laki-laki </span>
                                    </div>
                                    <div class="row col-12">
                                        <div class="col-2"></div>
                                        <input type="radio" name="gender" value="P" class="col-2" required><span> Perempuan </span>
                                    </div>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for=""><i class="text-danger">*</i> Pendidikan Terakhir</label>
                                    <input type="text" class="form-control text-capitalize" name="pendidikanter" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for=""><i class="text-danger">*</i> Tahun Lulus</label>
                                    <input type="date" class="form-control" name="tahunlulus" required>
                                </div>
                                <div class="form-group text-right col-xl-12">
                                    <button class="btn btn-primary" id="btn-save" type="submit"> <i class="fa fa-save"></i> Save</button>
                                </div>
                            </div>
                       </form>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

<!-- modal add kepala lama-->
<div class="col-sm-6 col-md-3 m-t-30">
    <div class="modal fade bs-example-modal-kepala-lama" id="tambah_kepala_lama" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">DAFTAR KEPALA LEMBAGA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="datatable_kepala" class="table kepalas table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                 <tr>
                                     <th>Daftar Nama Kepala Lembaga</th>
                                     <th class="text-center">PILIH</th>
                                 </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
@endsection

@section('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script>
    $('#tambah_kepala_baru').on('show.bs.modal', function(event) {
        $('#tambah_kepala').modal('hide');
        var button = $(event.relatedTarget)
        // 
        var modal = $(this)
        //
        //input kepala lembaga
        $('#formKepalaStore').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: "{{ route('lembaga.kepalaS')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $("#formKepalaStore")[0].reset();
                    toastr.success(data.success);
                    $("#tambah_kepala_baru").modal('hide');
                    var oTable = $('#datatable_lembaga').dataTable();
                    oTable.fnDraw(false);
                    $("#btn-save").html('Submit');
                    $("#btn-save"). attr("disabled", false);
                },
                error: function(data){
                console.log(data);
                }
            });
        });
    })
    $('#tambah_kepala_lama').on('show.bs.modal', function(event) {
        $('#tambah_kepala').modal('hide');
        // 
        var modal = $(this)
        //
        //view kepala lembaga
        $('#datatable_kepala').DataTable({
        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: {
            url:'{{ route("cabang.kepalaV") }}',
            },
            columns: [
                {
                data:'kepala',
                name:'kepala.name'
                },
                
                {
                data:'pilih',
                name:'pilih'
                },
            ]
        });
    })
    $(document).ready(function() {
        //get total data cabang
        $.ajax({
                url:'{{ route("dashboard.lembaga") }}',
                type: 'get',
                dataType: 'json',
                success:function(data) {
                document.getElementById('cb').innerHTML = data;
                console.log(data);
            }
        });

        $.ajax({
                url:'{{ route("dashboard.lembagakab") }}',
                type: 'get',
                dataType: 'json',
                success:function(data) {
                document.getElementById('cb2').innerHTML = data;
                console.log(data);
            }
        });

        $.ajax({
                url:'{{ route("dashboard.lembagapro") }}',
                type: 'get',
                dataType: 'json',
                success:function(data) {
                document.getElementById('cb3').innerHTML = data;
                console.log(data);
            }
        });
        
        $('#datatable_lembaga').DataTable({
        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: {
            url:'{{ route("lembaga.data") }}',
        },
        columns: [
            {
            data:'name',
            name:'name',
            },
            {
            data:'kepala',
            name:'kepala.name'
            },
            {
            data:'telp',
            name:'telp',
            render: function(data) { 
                if(data == null) {
                    return '<span class="btn btn-sm badge badge-danger">Kosong</span>'; 
                }else{
                    return data;
                }
              },
            },
            {
            data:'kabupatem',
            name:'kabupaten.nama',
            },
            {
            data:'provinsi',
            name:'provinsi.nama'
            },
            {
            data:'alamat',
            name:'alamat',
            render: function(data) { 
                if(data == null) {
                    return '<span class="btn btn-sm badge badge-danger">Kosong</span>'; 
                }else{
                    return data;
                }
              },
            },
            {
            data:'jml_guru',
            name:'jml_guru'
            },
            {
            data:'jml_santri',
            name:'jml_santri'
            },
            {
            data:'tahunmasuk',
            name:'tahunmasuk'
            },
        ]
        });
    })

    $('#importlembaga').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
        type:'POST',
        url: "{{ route('import.lembaga')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        beforeSend:function(){
            $('#btnimport').attr('disabled','disabled');
            $('#btnimport').val('Importing Process');
        },
        
        success: function(data){
            if(data.success)
            {
                //get total data cabang
                $.ajax({
                    url:'{{ route("dashboard.lembaga") }}',
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        document.getElementById('cb').innerHTML = data;
                        console.log(data);
                    }
                });
                //sweetalert and refresh datatable
                $("#importlembaga")[0].reset();
                toastr.success(data.success);
                var oTable = $('#datatable_lembaga').dataTable();
                oTable.fnDraw(false);
                $('#btnimport').val('Import');
                $('#btnimport').attr('disabled',false);
                $('.bs-example-modal-lembaga').modal('hide');
                swal("Done!", data.message, "success");
            }
            if(data.error)
            {
                $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
                $('#btnimport').attr('disabled',false);
                $('#btnimport').val('Import');
            }
        },
        error: function(data)
        {
            console.log(data);
            }
        });
    });
</script>
@endsection