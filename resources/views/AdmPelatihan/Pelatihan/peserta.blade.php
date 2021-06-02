@extends('layouts.adm.master')
@section('head')
<style>
    .container {
  padding: 50px 200px;
}
.box {
  position: relative;
  background: #ffffff;
  width: 100%;
}
.box-header {
  color: #444;
  display: block;
  padding: 10px;
  position: relative;
  border-bottom: 1px solid #f4f4f4;
  margin-bottom: 10px;
}
.box-tools {
  position: absolute;
  right: 10px;
  top: 5px;
}
.dropzone-wrapper {
  border: 2px dashed #91b0b3;
  color: #92b0b3;
  position: relative;
  height: 150px;
}
.dropzone-desc {
  position: absolute;
  margin: 0 auto;
  left: 0;
  right: 0;
  text-align: center;
  width: 40%;
  top: 50px;
  font-size: 16px;
}
.dropzone,
.dropzone:focus {
  position: absolute;
  outline: none !important;
  width: 100%;
  height: 150px;
  cursor: pointer;
  opacity: 0;
}
.dropzone-wrapper:hover,
.dropzone-wrapper.dragover {
  background: #ecf0f5;
}
.preview-zone {
  text-align: center;
}
.preview-zone .box {
  box-shadow: none;
  border-radius: 0;
  margin-bottom: 0;
}
</style>
<link href="{{ asset('adm/plugins/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="float-right page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Pelatihan</a></li>
                <li class="breadcrumb-item active"><a href="/">Data Entri</a></li>
                <li><span id="clock"></span></li>
            </ol>
        </div>
        {{-- <h5 class="page-title">Data Entri</h5> --}}
    </div>
</div>
<!-- end row -->

<div class="row">
    <!--flash massage-->
    @include('layouts.sess.flash_message')
    <!--flash massage-->
    <div class="col-xl-2" style="align-content: center;text-align: center">
        <div class="m-b-20" >
            <div class="text-center bg-primary rounded p-3 m-t-10 "style="text-align: center; max-width: 100px;">
                <p class="text-white mb-0" id="bln">October</p>
                <h2 class="text-white mb-0" id="tgl"></h2>
                <p class="text-white mb-0" id="hari"></p>
            </div>
            {{-- @if (auth()->user()->role=='pusat') --}}
            <div style="text-align: center; max-width: 100px;">
                {{-- <button type="button" class="btn btn-primary m-t-10 waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg" style="min-width: 100px"><i class="fa fa-plus"></i> Cabang</button> --}}
                <button type="button" class="btn btn-primary waves-effect waves-light m-t-10" style="min-width: 100px" data-toggle="modal" data-target=".bs-example-modal-center"><i class="fa fa-plus"></i> Peserta</button>
                <button type="button" class="btn btn-primary waves-effect waves-light m-t-10" style="min-width: 100px" data-toggle="modal" data-target=".bs-example-modal-center1"><i class="fa fa-plus"></i> Import</button>
            </div>
            {{-- @endif --}}
        </div>
    </div>  
    <div class="col-xl-10">
        <div class="card m-b-30">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="mt-100">
                                        <tr>
                                            {{-- <th>id</th> --}}
                                            <th style="width: 10%">Nama</th>
                                            <th style="width: 10%">Kota</th>
                                            <th>Syahadah</th>
                                            <th>Kriteria</th>
                                            <th>Alamat</th>
                                            <th>Telp</th>
                                            <th>Tmp Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th style="width: 5%">fs</th>
                                            <th style="width: 5%">tj</th>
                                            <th style="width: 5%">gm</th>
                                            <th style="width: 5%">sl</th>
                                            @if ($dt_pel->keterangan=="guru")
                                            <th style="width: 5%">mt</th>
                                            @endif
                                            
                                            
                                            <th class="text-center">...</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($dt_pes as $item)
                                        <tr>
                                            {{-- <td>{{ $item->id }}</td> --}}
                                            <td style="width: 10%">{{ $item->name }}</td>
                                            <td style="width: 10%">{{ $item->kota }}</td>
                                            <td>
                                                @if ($item->bersyahadah==1)
                                                    lulus
                                                    @else
                                                    tdk lulus
                                                @endif
                                            </td>
                                            <td>{{ $item->kriteria }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->telp }}</td>
                                            <td>{{ $item->tmptlahir }}</td>
                                            <?php $tgl_lahir = ($item->tgllahir - 25569) * 86400?>
                                            <td>{{ gmdate('d F Y',$tgl_lahir) }}</td>
                                            <td style="width: 5%">{{ $item->fs }}</td>
                                            <td style="width: 5%">{{ $item->tj }}</td>
                                            <td style="width: 5%">{{ $item->gm }}</td>
                                            <td style="width: 5%">{{ $item->sl }}</td>
                                            @if ($item->pelatihan->keterangan=="guru")
                                            <td style="width: 5%">{{ $item->mt }}</td>
                                            @endif
                                            
                                            
                                            {{-- <td>{{ $item->pelatihan->id }}</td> --}}
                                            <td>
                                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
</div>

<!--modal-->
<div class="col-sm-6 col-md-3 m-t-30">
    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">PELATIHAN BARU</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <form action="{{ route('pelatihan.storepes') }}" method="POST">@csrf
                       <div class="form-group">
                            <div class="row">
                                <div class="form-group col-xl-6">
                                    <label for="">ID Program</label>
                                    <input type="number" name="pelatihan_id" value="{{ $dt_pel->id }}" class="form-control" required readonly>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="">Lembaga</label>
                                    <select name="lemb" id="" class="form-control">
                                        <option value="">= Pilih Lembaga =</option>
                                        @foreach ($dt_lem as $item)
                                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-xl-12">
                                    <input type="hidden" class="form-control text-capitalize" name="lembaga" id="lembaga">
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for=""><i class="text-danger">*</i> Nama</label>
                                    <input type="text" name="name" class="form-control text-capitalize" placeholder="" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for=""> Email</label>
                                    <input type="email" class="form-control" placeholder="" name="email">
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for=""><i class="text-danger">*</i> Tempat Lahir</label>
                                    <input type="text" name="tmptlahir" class="form-control text-capitalize" placeholder="" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for=""><i class="text-danger">*</i> Tanggal Lahir</label>
                                    <input type="date" id="tgllahir" name="tgllahir" onchange="tes()" class="form-control" placeholder="" required>
                                    <input type="hidden" id="y" name="tgllahir2">
                                </div>
                                <div class="form-group col-xl-12">
                                    <label for=""><i class="text-danger">*</i> Alamat</label>
                                    <textarea name="alamat" class="form-control text-capitalize" id="" cols="30" rows="" required></textarea>
                                </div>
                                
                                <div class="form-group col-xl-6">
                                    <label for=""><i class="text-danger">*</i> Kota</label>
                                    <input type="text" name="kota" class="form-control text-capitalize" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="">Telp</label>
                                    <input type="text" placeholder="" class="form-control " name="telp" required>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for=""><i class="text-danger">*</i> Fashohah <i class="text-danger">Max:28</i></label>
                                    <input type="number" class="form-control" onkeyup="myFunction()" id="fs" name="fs"  max="28" required>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for=""><i class="text-danger">*</i> Tajwid <i class="text-danger">Max:45</i></label>
                                    <input type="number" class="form-control" onkeyup="myFunction()" id="tj" name="tj"  max="45" required>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for=""><i class="text-danger">*</i> Ghorib Musykilat <i class="text-danger">Max:10</i></label>
                                    <input type="number" class="form-control" onkeyup="myFunction()" id="gm" name="gm"  max="10" required>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for=""><i class="text-danger">*</i> Suara dan Lagu <i class="text-danger">Max:7</i></label>
                                    <input type="number" class="form-control" onkeyup="myFunction()" id="sl" name="sl"  max="7" required>
                                </div>
                                @if ($dt_pel->keterangan == 'guru')
                                <div class="form-group col-sm-4">
                                    <label for=""><i class="text-danger">*</i> MICROTEACHING</label>
                                    <input type="number" class="form-control" id="mt" name="mt" max="90" min="50" required>
                                </div>
                                @endif
                                    <div class="form-group col-sm-12"></div>
                                    <div class="form-group col-xl-4 col-6">
                                        <label for="">Jumlah Nilai</label>
                                        <input type="text" readonly class="form-control" id="jumlah" name="jumlah" value="isi kategori penilaian">
                                    </div>
                                    <div class="form-group col-xl-4 col-6">
                                        <label for="">Penilaian Syahadah</label>
                                        <input type="text" readonly class="form-control" id="penilaian" value="lengkapi seluruh penilaian" name="penilaian">
                                    </div>
                                <div class="form-gorup col-sm-12">
                                    <div class="form-group">
                                        <div>
                                            <div class="custom-control custom-checkbox">
                                                {{-- <input type="checkbox" name="bersyahadah" value="1" class="custom-control-input form-control" id="customCheck1" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                <label class="custom-control-label" for="customCheck1">Bersyahadah</label> --}}
                                                <input type="text" id="syahadah" name="syahadah" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xl-12">
                                    <input type="jidil" class="form-control text-capitalize" name="jidil" placeholder="Jilid..">
                                </div>
                                <div class="form-group col-xl-12">
                                    <select name="krits" id="krits" class="form-control" required>
                                        <option value="">= Pilih Kriteria =</option>
                                        @foreach ($keterangans as $item)
                                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-xl-12">
                                    <input type="hidden" class="form-control text-capitalize" name="kriteria" id="kriteria" required>
                                </div>
                                <div class="form-group col-xl-12">
                                    <input type="text" class="form-control text-capitalize" placeholder="munaqisy">
                                </div>
                            </div>
                       </div>
                       <div class="form-group text-right">
                           <button class="btn btn-primary" type="submit"> <i class="fa fa-save"></i> Save</button>
                       </div>
                   </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

<!--modal-->
<div class="col-sm-6 col-md-3 m-t-30">
    <div class="modal fade bs-example-modal-center1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">DATA PESERTA PELATIHAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="container-fluid">
                                   
                                    @if ($dt_pel->program->name=="munaqosyah santri")
                                    <form id="importpeserta"  method="POST" enctype="multipart/form-data">@csrf
                                        <input type="hidden" id="import_tipe" value="santri">
                                    @elseif($dt_pel->program->name=="standarisasi guru al qur'an")
                                    <form id="importpeserta"  method="POST" enctype="multipart/form-data">@csrf
                                        <input type="hidden" id="import_tipe" value="guru">
                                    @elseif($dt_pel->program->name=="tahfidz")
                                    <form id="importpeserta"  method="POST" enctype="multipart/form-data">@csrf
                                        <input type="hidden" id="import_tipe" value="tahfidz">
                                    @elseif($dt_pel->program->name=="training of trainer")
                                    <form id="importpeserta"  method="POST" enctype="multipart/form-data">@csrf
                                        <input type="hidden" id="import_tipe" value="trainer">
                                    @elseif($dt_pel->program->name=="munaqisy")
                                    <form id="importpeserta"  method="POST" enctype="multipart/form-data">@csrf
                                        <input type="hidden" id="import_tipe" value="munaqisy">
                                    @endif
                                        <div class="form-group">
                                            <input type="hidden" value="{{ $dt_pel->id }}" name="id">
                                            <input type="hidden" value="{{ $dt_pel->tanggal }}" name="tanggal">
                                            <label for="">Import Data Peserta "{{ $dt_pel->program->name }}" Pelatihan (hanya Excel File format .xlsx)</label>
                                            <input type="file" class="form-control" name="file" accept=".xlsx" required>
                                        </div>
                                        <div class="form-group">
                                            {{-- <button class="btn btn-sm btn-primary" id="btnimport"><i class="fa fa-save"></i> Import</button> --}}
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
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script>
        function tes() {
            var x = $('#tgllahir').val();
            
                var date= new Date(x);
                var bulan = '' + (date.getMonth()+1);
                var tanggal = '' + (date.getDate());
                var tahun = date.getFullYear();
                if (bulan.length<2) {
                    var p = '0'+ bulan;
                }else{
                    var p = bulan;
                }
                if (tanggal.length<2) {
                    var pp= '0'+tanggal;
                }else{
                    var pp = tanggal;
                }
                var restgl = p+'/'+pp+'/'+tahun;
                console.log(restgl);
                console.log(date.getMonth()+1+'/'+date.getDate()+'/'+date.getFullYear());
            var res = x.replace("-","/");
            var a = res.replace("-","/");
            console.log(a);
            var b = $('#y').val(restgl);
        }
        function myFunction()
        {
            let x1 = document.getElementById("fs").value;
            let x2 = document.getElementById("tj").value;
            var x3 = document.getElementById("gm").value;
            var x4 = document.getElementById("sl").value;
            // var x5 = document.getElementById("mt").value;
            let zx = parseInt(x1) + parseInt(x2) + parseInt(x3) + parseInt(x4);
            if (isNaN(zx)) {
                document.getElementById("jumlah").value = "lengkapi seluruh kriteria penilaian";
                document.getElementById("penilaian").value = "menunggu";
            }else{
                document.getElementById("jumlah").value = zx;
                if (zx < 70) {
                    document.getElementById("penilaian").value = "belum bersyahadah";
                    document.getElementById("syahadah").value = "0";
                }else{
                    document.getElementById("penilaian").value = "bersyahadah";
                    document.getElementById("syahadah").value = "1";
                }
            }
        }
    
    </script>
    <script>
        $(document).ready(function() {
            $('select[name="krits"]').on('change', function() {
                var kriteria_name = $(this).val();
                document.getElementById("kriteria").value = kriteria_name;
            });
            $('select[name="lemb"]').on('change', function() {
            var lembaga = $(this).val();
            document.getElementById("lembaga").value = lembaga;
            });
            //import

            $('#importpeserta').submit(function(e) {
                var import_tipe = $('#import_tipe').val();
                if (import_tipe == 'santri') {
                    var import_peserta = "{{ route('import.peserta')}}";
                } else if(import_tipe == 'guru') {
                    var import_peserta = "{{ route('import.pesertaG')}}";
                } else if(import_tipe == 'tahfidz') {
                    var import_peserta = "{{ route('import.pesertaTahfidz')}}";
                } else if(import_tipe == 'munaqisy') {
                    var import_peserta = "{{ route('import.pesertaMunaqisy')}}";
                } else if(import_tipe == 'trainer') {
                    var import_peserta = "{{ route('import.pesertaToT')}}";
                }
                $('#process').css('display', 'block');
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: import_peserta,
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnimport').attr('disabled','disabled');
                    $('#btnimport').val('Importing');
                },
                success: function(data){

                    if(data.success)
                        {
                            $("#importpeserta")[0].reset();
                            toastr.success(data.success);
                            // $("#bs-example-modal-center1").modal('hide');
                            // var oTable = $('#datatable').dataTable();
                            // oTable.fnDraw(false);
                            $('#btnimport').val('Import');
                            $('#btnimport').attr('disabled',false);
                            
                        }
                        if(data.error)
                        {
                            $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
                            $('#btnimport').attr('disabled',false);
                            $('#btnimport').val('Import');
                        }
                },
                error: function(data){
                console.log(data);
                }
                });
            });
        });
    </script>
@endsection