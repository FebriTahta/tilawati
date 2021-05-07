@extends('layouts.adm.master')
@section('head')
    <style>
        table.dataTable.kepalas td:nth-child(2) {
  width: 20px;
  max-width: 20px;
  word-break: break-all;
  white-space: pre-line;
  text-align: center;
}
    </style>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="float-right page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Pelatihan</a></li>
                <li class="breadcrumb-item"><a href="{{route('lembaga.index')}}">Lembaga</a></li>
                <li class="breadcrumb-item active">Lembaga Baru</li>
            </ol>
        </div>
        <h5 class="page-title">Lembaga</h5>
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
        <div class="card m-b-30">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">                          
                            <div class="form">
                                <form action="{{ route('lembaga.store') }}" method="POST">@csrf
                                    <div class="form-group">
                                        <label><i class="text-danger">*</i> Pilih Lembaga</label>
                                        @if (auth()->user()->role=="cabang")
                                            <input type="hidden" name="cabang_id" value="{{ auth()->user()->cabang->id }}" required>
                                        @else
                                        <select name="cabang_id" id="cabang_id" class="form-control" required>
                                            <option value="">= Daftar Nama Lembaga Yang Telah Terdaftar =</option>
                                            @foreach ($dt_cabang as $item)
                                                <option class="form-control text-uppercase" value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target=".bs-example-modal-center"><i class="fa fa-plus"></i> Kepala Lembaga</button><br><br>
                                        <input type="hidden" class="form-control" id="kepala_id" name="kepala_id" required>
                                        <label><i class="text-danger">*</i> Kepala Lembaga</label>
                                        <input type="text" name="kepala" id="kepalax" class="form-control" placeholder="Nama Kepala Lembaga..." data-toggle="modal" data-target=".bs-example-modal-center2" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <label><i class="text-danger">*</i> Nama Lembaga</label>
                                        <input type="text" name="name" class="form-control" placeholder="" required>
                                    </div>
                                    <div class="form-group">
                                        <label><i class="text-danger">*</i> Alamat Lengkap Lembaga</label>
                                        <textarea name="alamat" class="form-control" id="" cols="10" rows="10" required></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label><i class="text-danger">*</i> Provinsi</label>
                                                <input type="hidden" name="provinsi" id="provinsi" value="" required>
                                                <input type="text" class="form-control" name="provinsi_id" id="provinsi_id" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <input type="hidden" name="kabupaten" id="kabupaten" value="" required>
                                                <label><i class="text-danger">*</i> Kabupaten/Kota</label>
                                                <input type="text" class="form-control" name="kabupaten_id" id="kabupaten_id" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label><i class="text-danger">*</i> Kecamatan</label>
                                                <select name="kecamatan_id" id="kecamatan_id" class="form-control" required>
                                                    <option value="">* </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label><i class="text-danger">*</i> Kelurahan</label>
                                                <select name="kelurahan_id" id="" class="form-control" required>
                                                    <option value="">* </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label> Kode Pos</label>
                                                <input type="number" class="form-control" placeholder="" >
                                            </div>
                                        </div>
                                        <div class="col-xl-6 form-group">
                                            <label><i class="text-danger">*</i> Email Lembaga</label>
                                            <input type="email" class="form-control" name="email" placeholder="" required>
                                        </div>
                                        <div class="col-xl-6 form-group">
                                            <label> Website lembaga</label>
                                            <input type="text" class="form-control" name="web" placeholder="Dikosongi apabila belum ada website">
                                        </div>
                                        <div class="col-xl-6 form-group">
                                            <label><i class="text-danger">*</i> Telephone Lembaga (Kantor / Hp)</label>
                                            <input type="text" class="form-control" name="telp" placeholder="" required>
                                        </div>
                                        <div class="col-xl-6 form-group">
                                            <label><i class="text-danger">*</i> Pengelola</label>
                                            <select name="pengelola" id="pengelola" class="form-control" required>
                                                <option value="">*</option>
                                                <option value="1">Yayasan</option>
                                                <option value="2">Masjid</option>
                                                <option value="3">Pribadi</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6 form-group">
                                            <div class="form-group">
                                                <label><i class="text-danger">*</i> Jenjang Kelembagaan</label>
                                                <select name="jenjang_id" id="" class="form-control" required>
                                                    <option value="">*</option>
                                                    @foreach ($dt_jenis as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 form-group">
                                            <label for=""><i class="text-danger">*</i> Tahun Berdiri</label>
                                            <input type="date" class="form-control" name="tahunberdiri" placeholder="Tahun Berdiri" >
                                        </div>
                                        <div class="col-4 form-group">
                                            <label for=""><i class="text-danger">*</i> Tahun Masuk</label>
                                            <input type="date" class="form-control" name="tahunmasuk" placeholder="Tahun Masuk" >
                                        </div>
                                        <div class="col-4 form-group">
                                            <label for="">Status</label>
                                            <select name="status" id="" class="form-control" required>
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
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
</div>
<!-- end row -->
<div class="col-sm-6 col-md-3 m-t-30">
    <div class="modal fade bs-example-modal-center" id="ya" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">KEPALA LEMBAGA BARU</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <form action="javascript:void(0)" method="POST" id="formKepalaStore" name="formKepalaStore">@csrf
                        <div class="row">
                            <div class="form-group col-xl-12">
                                <label><i class="text-danger">*</i> NIK</label>
                                <input type="text" name="nik" class="form-control " placeholder="NIK (16 digit)" maxlength="16" size="16" required>
                            </div>
                            <div class="form-group col-xl-12">
                                <label><i class="text-danger">*</i> Nama Lengkap</label>
                                <input type="text" class="form-control " name="name" placeholder="" required>
                            </div>
                            <div class="form-group col-xl-12">
                                <label for=""><i class="text-danger">*</i> Alamat Lengkap...</label>
                                <textarea type="text" class="form-control " name="alamat" required></textarea>
                            </div>
                            <div class="form-group col-xl-6">
                                <label for=""><i class="text-danger">*</i> Telephone</label>
                                <input type="text" name="telp" class="form-control" required>
                            </div>
                            <div class="form-group col-xl-6">
                                <label for=""><i class="text-danger">*</i> Gender</label><br>
                                <div class="row">
                                    <input type="radio" name="gender" value="L" class="col-sm-6" required> Laki-laki
                                    <input type="radio" name="gender" value="P" class="col-sm-6" required> Perempuan
                                </div>
                            </div>
                            <div class="form-group col-xl-6">
                                <label for=""><i class="text-danger">*</i> Pendidikan Terakhir</label>
                                <input type="text" class="form-control" name="pendidikanter" required>
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
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
{{-- modal 2 --}}
<div class="col-sm-6 col-md-3 m-t-30">
    <div class="modal fade bs-example-modal-center2" id="modalkepala" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">PILIH CALON KEPALA LEMBAGA BERIKUT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table kepalas table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                 <tr>
                                     <th>Daftar Nama Kepala Cabang</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script>
    //pilih
function pilih()
        {
            var pil = $( "#pilih:checked" ).val();
            console.log(pil);
            $("#kepala_id").val(pil);
            $("#modalkepala").modal('hide');
            if(pil) {
                $.ajax({
                    url: '/fetch4/' + pil,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $("#kepalax").val(data.name);
                        console.log(data);
                    }
                });
            }
        }
$(document).ready(function() {
//show data kepala
$('#datatable').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url:'{{ route("cabang.kepalaV") }}',
                },
                columns: [
                    {
                    data:'name',
                    name:'name'
                    },
                    {
                    data:'pilih',
                    name:'pilih'
                    },
                ]
                });
});    
</script>
<script>
$(document).ready(function() {
    toastr.options = {
        "closeButton": true,
        //   "newestOnTop": true,
        "newestOnBottom": true,
        "positionClass": "toast-bottom-right"
        };
        
        //input kepala
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
                        $("#ya").modal('hide');
                        var oTable = $('#datatable').dataTable();
                        oTable.fnDraw(false);
                        $("#btn-save").html('Submit');
                        $("#btn-save"). attr("disabled", false);
                    },
                    error: function(data){
                    console.log(data);
                    }
                    });
                });
    
    //trigger ajax untuk provinsi kabupaten kecamatan kelurahan
    $('select[name="cabang_id"]').on('change', function() {
            //mencari kota/kab dari provinsi 3 tingkat
            var cabang_id = $(this).val();
            console.log(cabang_id);
            if(cabang_id) {
                $.ajax({
                    url: '/fetch5/' + cabang_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        var p_id = data.provinsi_id;
                        var p_id2 = data.kabupaten_id;
                        console.log(p_id);
                        console.log(p_id2);
                        $("#provinsi").val(p_id);
                        $("#kabupaten").val(p_id2);
                        $.ajax({
                            url: '/fetch6/' + p_id,
                            type: "GET",
                            dataType: "json",
                            success:function(dp) {
                                var pid = dp.nama;
                                console.log(pid);
                                $("#provinsi_id").val(pid);
                            }
                        });
                        $.ajax({
                            url: '/fetch7/' + p_id2,
                            type: "GET",
                            dataType: "json",
                            success:function(dk) {
                                var pid2 = dk.nama;
                                var pid3 = dk.id;
                                console.log(pid2);
                                $("#kabupaten_id").val(pid2);
                                $.ajax({
                                    url: '/fetch2/' + pid3,
                                    type: "GET",
                                    dataType: "json",
                                    success:function(dk) {
                                        $('select[name="kecamatan_id"]').empty();
                                        $.each(dk, function(key, value) {
                                        $('select[name="kecamatan_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                        });
                                        var x = $( "#kecamatan_id option:selected" ).val();
                                        console.log(x);
                                        $.ajax({
                                            url: '/fetch3/' + x,
                                            type: "GET",
                                            dataType: "json",
                                            success:function(dkel) {                      
                                                $('select[name="kelurahan_id"]').empty();
                                                $.each(dkel, function(key, value) {
                                                $('select[name="kelurahan_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                                });
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    }
                });
            }else{
                $("#provinsi_id").empty().disabled();
            }
        });
        //dari kecamatan 
        $('select[name="kecamatan_id"]').on('change', function() {
            //mencari kelurahan dari kecamatan
            var kecamatan_id = $(this).val();
            console.log(kecamatan_id);
            if(kecamatan_id) {
                
                $.ajax({
                    url: '/fetch3/' + kecamatan_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {                      
                        $('select[name="kelurahan_id"]').empty();
                        $.each(data, function(key, value) {
                        $('select[name="kelurahan_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        console.log(data);
                    }
                });
            }else{
                $('select[name="kelurahan_id"]').empty().disabled();
            }
        });
});
</script>
@endsection