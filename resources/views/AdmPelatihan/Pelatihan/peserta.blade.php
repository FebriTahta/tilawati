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
                <li class="breadcrumb-item active">Data Entri</li>
            </ol>
        </div>
        <h5 class="page-title">Data Entri</h5>
    </div>
</div>
<!-- end row -->

<div class="row">
    <!--flash massage-->
    @include('layouts.sess.flash_message')
    <!--flash massage-->
    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="float-left p-1 mr-3 " style="min-width: 100px">
                    <div class="text-center bg-primary rounded p-3">
                        <p class="text-white mb-0" id="bln">October</p>
                        <h2 class="text-white mb-0" id="tgl"></h2>
                        <p class="text-white mb-0" id="hari"></p>
                    </div>
                </div>
                <div class="post-details text-right">
                    <h2 class="text-muted" id="clock">jam</h2>
                    <h5 class="text-muted">Selamat Beraktifitas</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class=" m-b-30 bg-transparent">
            <div class="row">
                <div class="col-lg-4">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-center"><i class="fa fa-plus"></i> Tambah Peserta</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-center1"><i class="fa fa-plus"></i> Import Peserta</button>
                </div>
            </div>
        </div>
    </div>    
    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="mt-100">
                                        <tr>
                                            {{-- <th>id</th> --}}
                                            <th style="width: 10%">Nama</th>
                                            <th style="width: 20%">Alamat</th>
                                            <th>Kota</th>
                                            <th>Telp</th>
                                            <th>Tmp Lahir</th>
                                            <th style="width: 5%">fs</th>
                                            <th style="width: 5%">tj</th>
                                            <th style="width: 5%">gm</th>
                                            <th style="width: 5%">sl</th>
                                            @if ($dt_pel->keterangan=="GURU")
                                            <th style="width: 5%">mt</th>
                                            @endif
                                            <th>Syahadah</th>
                                            <th>kriteria</th>
                                            <th class="text-center">...</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($dt_pes as $item)
                                        <tr>
                                            {{-- <td>{{ $item->id }}</td> --}}
                                            <td style="width: 10%">{{ $item->name }}</td>
                                            <td style="width: 20%">{{ $item->alamat }}</td>
                                            <td>{{ $item->kota }}</td>
                                            <td>{{ $item->telp }}</td>
                                            <td>{{ $item->tmptlahir }}</td>
                                            <td style="width: 5%">{{ $item->fs }}</td>
                                            <td style="width: 5%">{{ $item->tj }}</td>
                                            <td style="width: 5%">{{ $item->gm }}</td>
                                            <td style="width: 5%">{{ $item->sl }}</td>
                                            @if ($dt_pel->keterangan=="GURU")
                                            <td style="width: 5%">{{ $item->mt }}</td>
                                            @endif
                                            <td>
                                                @if ($item->bersyahadah==1)
                                                    lulus
                                                    @else
                                                    tdk lulus
                                                @endif
                                            </td>
                                            <td>{{ $item->kriteria }}</td>
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
                                    <input type="number" name="pelatihan_id" value="{{ $dt_pel->id }}" class="form-control">
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
                                    <input type="hidden" class="form-control text-uppercase" name="lembaga" id="lembaga">
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="">Nama</label>
                                    <input type="text" name="name" class="form-control text-uppercase" placeholder="">
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" placeholder="" name="email">
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="">Tempat Lahir</label>
                                    <input type="text" name="tmptlahir" class="form-control text-uppercase" placeholder="" >
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="">Tanggal Lahir</label>
                                    <input type="date" name="tgllahir" class="form-control" placeholder="" >
                                </div>
                                <div class="form-group col-xl-12">
                                    <label for="">Alamat</label>
                                    <textarea name="alamat" class="form-control text-uppercase" id="" cols="30" rows=""></textarea>
                                </div>
                                
                                <div class="form-group col-xl-6">
                                    <label for="">Kota</label>
                                    <input type="text" name="kota" class="form-control text-uppercase">
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="">Telp</label>
                                    <input type="text" placeholder="" class="form-control " name="telp">
                                </div>
                                <div class="form-group col-sm-4">
                                    <input type="number" class="form-control" name="fs" placeholder="fs" max="28" min="23" required>
                                </div>
                                <div class="form-group col-sm-4">
                                    <input type="number" class="form-control" name="tj" placeholder="tj" max="45" min="35" required>
                                </div>
                                <div class="form-group col-sm-4">
                                    <input type="number" class="form-control" name="gm" placeholder="gm" max="10" min="7" required>
                                </div>
                                <div class="form-group col-sm-4">
                                    <input type="number" class="form-control" name="sl" placeholder="sl" max="7" min="5" required>
                                </div>
                                @if ($dt_pel->keterangan == 'GURU')
                                <div class="form-group col-sm-4">
                                    <input type="number" class="form-control" name="mt" placeholder="mt">
                                </div>
                                @endif
                                <div class="form-gorup col-sm-12">
                                    <div class="form-group">
                                        <div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="bersyahadah" value="1" class="custom-control-input form-control" id="customCheck1" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                <label class="custom-control-label" for="customCheck1">Bersyahadah</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xl-12">
                                    <input type="jidil" class="form-control text-uppercase" name="jidil" placeholder="Jilid..">
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
                                    <input type="hidden" class="form-control text-uppercase" name="kriteria" id="kriteria" required>
                                </div>
                                <div class="form-group col-xl-12">
                                    <input type="text" class="form-control text-uppercase" placeholder="munaqisy">
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
                                    @if ($dt_pel->keterangan=="SANTRI")
                                    <form action="{{ route('import.peserta') }}" method="POST" enctype="multipart/form-data">@csrf
                                    @elseif($dt_pel->keterangan=="GURU")
                                    <form action="{{ route('import.pesertaG') }}" method="POST" enctype="multipart/form-data">@csrf
                                    @elseif($dt_pel->keterangan=="TOT_INSTRUKTUR")
                                    <form action="{{ route('import.pesertaToT') }}" method="POST" enctype="multipart/form-data">@csrf
                                    @endif
                                        <div class="form-group">
                                            <input type="hidden" value="{{ $dt_pel->id }}" name="id">
                                            <label for="">Import Data Peserta "{{ $dt_pel->keterangan }}" Pelatihan (hanya Excel File format .xlsx)</label>
                                            <input type="file" class="form-control" name="file" accept=".xlsx" required>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Import</button>
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
<script>
    $(document).ready(function() {
            $('select[name="krits"]').on('change', function() {
                var kriteria_name = $(this).val();
                document.getElementById("kriteria").value = kriteria_name;
            });
        });
    $(document).ready(function() {
        $('select[name="lemb"]').on('change', function() {
            var lembaga = $(this).val();
            document.getElementById("lembaga").value = lembaga;
        });
    });
</script>
<script>
    function readFile(input) {
 if (input.files && input.files[0]) {
 var reader = new FileReader();
 
 reader.onload = function (e) {
 var htmlPreview = 
 '<img width="200" src="' + e.target.result + '" />'+
 '<p>' + input.files[0].name + '</p>';
 var wrapperZone = $(input).parent();
 var previewZone = $(input).parent().parent().find('.preview-zone');
 var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');
 
 wrapperZone.removeClass('dragover');
 previewZone.removeClass('hidden');
 boxZone.empty();
 boxZone.append(htmlPreview);
 };
 
 reader.readAsDataURL(input.files[0]);
 }
}function reset(e) {
 e.wrap('<form>').closest('form').get(0).reset();
 e.unwrap();
}$(".dropzone").change(function(){
 readFile(this);
});$('.dropzone-wrapper').on('dragover', function(e) {
 e.preventDefault();
 e.stopPropagation();
 $(this).addClass('dragover');
});$('.dropzone-wrapper').on('dragleave', function(e) {
 e.preventDefault();
 e.stopPropagation();
 $(this).removeClass('dragover');
});$('.remove-preview').on('click', function() {
 var boxZone = $(this).parents('.preview-zone').find('.box-body');
 var previewZone = $(this).parents('.preview-zone');
 var dropzone = $(this).parents('.form-group').find('.dropzone');
 boxZone.empty();
 previewZone.addClass('hidden');
 reset(dropzone);
});
</script>
@endsection