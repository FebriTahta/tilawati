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
                <li class="breadcrumb-item"><a href="{{route('cabang.index')}}">Cabang</a></li>
                <li class="breadcrumb-item active">Cabang Baru</li>
            </ol>
        </div>
        <h5 class="page-title">Cabang</h5>
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
                                <form action="{{ route('cabang.store') }}" method="POST">@csrf
                                    <p id="demo"></p>
                                    <div class="form-group">
                                        <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target=".bs-example-modal-center"><i class="fa fa-plus"></i> Kepala Cabang</button><br><br>
                                        <input type="hidden" class="form-control" id="kepala_id" name="kepala_id" value="" required>
                                        <label><i class="text-danger">*</i> Nama Kepala Cabang</label>
                                        <input type="text" class="form-control" value="" name="kepala" readonly id="kepalax" placeholder=" * Nama Kepala Cabang..." data-toggle="modal" data-target=".bs-example-modal-center2">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder=" * Nama Cabang..." required>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="alamat" class="form-control" id="" cols="20" rows="10"> Alamat Lengkap Cabang...</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <select name="pro_id" class="form-control"  required>
                                                    <option value=""> Provinsi </option>
                                                    @foreach ($dt_props2 as $prop)
                                                       <option value="{{ $prop->id_prov }}">{{ $prop->nama }}</option>
                                                   @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <select name="kab_id" id="kab_id" class="form-control" required>
                                                    <option value=""> Kabupaten/Kota </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <select name="kec_id" id="kec_id" class="form-control" required>
                                                    <option value=""> Kecamatan </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <select name="kel_id" id="kel_id" class="form-control" required>
                                                    <option value=""> Kelurahan </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea type="text" name="ekspedisi" class="form-control" placeholder="Alamat Ekspedisi..." >Alamat Ekspedisi... </textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control" placeholder="Email..." required>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <input type="text" name="telp" class="form-control" placeholder="Telp..." >
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <input type="text" name="pos" class="form-control" placeholder="Kode Pos..." >
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <input type="text" name="teritorial" class="form-control" placeholder="teritorial..." >
                                            </div>
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
                    <h5 class="modal-title mt-0">KEPALA CABANG BARU</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <form action="javascript:void(0)" method="POST" id="formKepalaStore" name="formKepalaStore">@csrf
                        <div class="row">
                            <div class="form-group col-xl-12">
                                <label><i class="text-danger">*</i> Nama Lengkap</label>
                                <input type="text" class="form-control text-uppercase" name="name" placeholder="" required>
                            </div>
                            <div class="form-group col-xl-6">
                                <label><i class="text-danger">*</i> Tempat Lahir</label>
                                <input type="text" class="form-control text-uppercase" name="tmptlahir" placeholder="" required>
                            </div>
                            <div class="form-group col-xl-6">
                                <label><i class="text-danger">*</i> Tanggal Lahir</label>
                                <input type="date" class="form-control text-uppercase" name="tgllahir" placeholder="" required>
                            </div>
                            <div class="form-group col-xl-12">
                                <label for=""><i class="text-danger">*</i> Alamat Lengkap...</label>
                                <textarea type="text" class="form-control text-uppercase" name="alamat" required></textarea>
                            </div>
                            <div class="form-group col-xl-6">
                                <label><i class="text-danger">*</i> Provinsi</label>
                                <select name="provinsi_id" id="mySelect" class="form-control" >
                                    <option value="">* Provinsi</option>
                                    @foreach ($dt_props2 as $item)
                                    <option value="{{ $item->id_prov }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-xl-6">
                                <label><i class="text-danger">*</i> Kabupaten / Kota</label>
                                <select id="kabupaten_id" name="kabupaten_id" class="form-control" >
                                    <option value="">* Kabupaten / Kota</option>
                                </select>
                            </div>
                            <div class="form-group col-xl-6">
                                <label><i class="text-danger">*</i> Kecamatan</label>
                                <select id="kecamatan_id" name="kecamatan_id" class="form-control" >
                                    <option value="">* Kecamatan</option>
                                </select>
                            </div>
                            <div class="form-group col-xl-6">
                                <label><i class="text-danger">*</i> Kelurahan</label>
                                <select id="kelurahan_id" name="kelurahan_id" class="form-control" >
                                    <option value="">* Kelurahan</option>
                                </select>
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
                                <label for=""><i class="text-danger">*</i> Pekerjaan</label>
                                <input type="text" class="form-control" name="pekerjaan" required>
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
                    <h5 class="modal-title mt-0">PILIH SALAH SATU KEPALA CABANG BERIKUT</h5>
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
<script>
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
        $('select[name="provinsi_id"]').on('change', function() {
            //mencari kota/kab dari provinsi 3 tingkat
            var provinsi_id = $(this).val();
            console.log(provinsi_id);
            if(provinsi_id) {
                
                $.ajax({
                    url: '/fetch/' + provinsi_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {                     
                        $('select[name="kabupaten_id"]').empty();
                        $.each(data, function(key, value) {
                        $('select[name="kabupaten_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        console.log(data);
                        var a = $( "#kabupaten_id option:selected" ).val();
                        console.log("kabupaten"+a);
                        if(a) {
                        $.ajax({
                                url: '/fetch2/' + a,
                                type: "GET",
                                dataType: "json",
                                success:function(data) {                      
                                    $('select[name="kecamatan_id"]').empty();
                                    $.each(data, function(key, value) {
                                    $('select[name="kecamatan_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                    });
                                    console.log(data);
                                    var x = $( "#kecamatan_id option:selected" ).val();
                                    console.log("kecamatan"+x);
                                    if(x) {
                                    $.ajax({
                                            url: '/fetch3/' + x,
                                            type: "GET",
                                            dataType: "json",
                                            success:function(data) {                      
                                                $('select[name="kelurahan_id"]').empty();
                                                $.each(data, function(key, value) {
                                                $('select[name="kelurahan_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                                });
                                                console.log(data);
                                                var x = $( "#kelurahan_id option:selected" ).val();
                                                console.log("kelurahan"+x);
                                            }
                                        });
                                    }else{
                                        $('select[name="kelurahan_id"]').empty().disabled();
                                    }
                                }
                            });
                        }else{
                            $('select[name="kecamatan_id"]').empty().disabled();
                        }
                    }
                });
            }else{
                $('select[name="kabupaten_id"]').empty().disabled();
            }
        });

        $('select[name="kabupaten_id"]').on('change', function() {
            //mencari kecamatan dari kota/kab 2 tingkat
            var kabupaten_id = $(this).val();
            console.log(kabupaten_id);
            if(kabupaten_id) {
                
                $.ajax({
                    url: '/fetch2/' + kabupaten_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {                      
                        $('select[name="kecamatan_id"]').empty();
                        $.each(data, function(key, value) {
                        $('select[name="kecamatan_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        console.log(data);
                        var x = $( "#kecamatan_id option:selected" ).val();
                        console.log("kecamatan"+x);
                        if(x) {
                            $.ajax({
                                url: '/fetch3/' + x,
                                type: "GET",
                                dataType: "json",
                                success:function(data) {                      
                                    $('select[name="kelurahan_id"]').empty();
                                    $.each(data, function(key, value) {
                                    $('select[name="kelurahan_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                    });
                                    console.log(data);
                                    var x = $( "#kelurahan_id option:selected" ).val();
                                    console.log("kelurahan"+x);
                                }
                            });
                        }else{
                            $('select[name="kelurahan_id"]').empty().disabled();
                        }
                    }
                });
            }else{
                $('select[name="kecamatan_id"]').empty().disabled();
            }
        });
        
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
        //input kepala
        $('#formKepalaStore').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
            type:'POST',
            url: "{{ route('cabang.kepalaS')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
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

        //dependensi daerah2
        $('select[name="pro_id"]').on('change', function() {
            //mencari kota/kab dari provinsi 3 tingkat
            var pro_id = $(this).val();
            console.log(pro_id);
            if(pro_id) {
                
                $.ajax({
                    url: '/fetch/' + pro_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {                     
                        $('select[name="kab_id"]').empty();
                        $.each(data, function(key, value) {
                        $('select[name="kab_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        console.log(data);
                        var a = $( "#kab_id option:selected" ).val();
                        console.log("kabupaten"+a);
                        if(a) {
                        $.ajax({
                                url: '/fetch2/' + a,
                                type: "GET",
                                dataType: "json",
                                success:function(data) {                      
                                    $('select[name="kec_id"]').empty();
                                    $.each(data, function(key, value) {
                                    $('select[name="kec_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                    });
                                    console.log(data);
                                    var x = $( "#kec_id option:selected" ).val();
                                    console.log("kecamatan"+x);
                                    if(x) {
                                    $.ajax({
                                            url: '/fetch3/' + x,
                                            type: "GET",
                                            dataType: "json",
                                            success:function(data) {                      
                                                $('select[name="kel_id"]').empty();
                                                $.each(data, function(key, value) {
                                                $('select[name="kel_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                                });
                                                console.log(data);
                                                var x = $( "#kel_id option:selected" ).val();
                                                console.log("kelurahan"+x);
                                            }
                                        });
                                    }else{
                                        $('select[name="kel_id"]').empty().disabled();
                                    }
                                }
                            });
                        }else{
                            $('select[name="kec_id"]').empty().disabled();
                        }
                    }
                });
            }else{
                $('select[name="kab_id"]').empty().disabled();
            }
        });

        $('select[name="kab_id"]').on('change', function() {
            //mencari kecamatan dari kota/kab 2 tingkat
            var kab_id = $(this).val();
            console.log(kab_id);
            if(kab_id) {
                
                $.ajax({
                    url: '/fetch2/' + kab_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {                      
                        $('select[name="kec_id"]').empty();
                        $.each(data, function(key, value) {
                        $('select[name="kec_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        console.log(data);
                        var x = $( "#kec_id option:selected" ).val();
                        console.log("kecamatan"+x);
                        if(x) {
                            $.ajax({
                                url: '/fetch3/' + x,
                                type: "GET",
                                dataType: "json",
                                success:function(data) {                      
                                    $('select[name="kel_id"]').empty();
                                    $.each(data, function(key, value) {
                                    $('select[name="kel_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                    });
                                    console.log(data);
                                    var x = $( "#kel_id option:selected" ).val();
                                    console.log("kelurahan"+x);
                                }
                            });
                        }else{
                            $('select[name="kel_id"]').empty().disabled();
                        }
                    }
                });
            }else{
                $('select[name="kec_id"]').empty().disabled();
            }
        });
        
        $('select[name="kec_id"]').on('change', function() {
            //mencari kelurahan dari kecamatan
            var kec_id = $(this).val();
            console.log(kec_id);
            if(kec_id) {
                
                $.ajax({
                    url: '/fetch3/' + kec_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {                      
                        $('select[name="kel_id"]').empty();
                        $.each(data, function(key, value) {
                        $('select[name="kel_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        console.log(data);
                    }
                });
            }else{
                $('select[name="kel_id"]').empty().disabled();
            }
        });
    });
</script>
@endsection