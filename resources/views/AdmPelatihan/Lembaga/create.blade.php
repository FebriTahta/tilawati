@extends('layouts.adm.master')
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
                                        @if (auth()->user()->role=="cabang")
                                            <input type="hidden" name="cabang_id" value="{{ auth()->user()->cabang->id }}" required>
                                        @else
                                        <select name="cabang_id" id="" class="form-control" required>
                                            <option value="">= Pilih Cabang =</option>
                                            @foreach ($dt_cabang as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
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
                                            <option value="">= Pilih Status =</option>
                                            @foreach ($dt_jenis as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
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
                                                    @foreach ($dt_props as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
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
                                    <div class="form-group">
                                        <input type="number" name="telp" class="form-control" placeholder="Telp..." >
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
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
</div>
<!-- end row -->
@endsection
@section('script')
<script>
$(document).ready(function() {
        $('select[name="propinsi_id"]').on('change', function() {
            var propinsi_id = $(this).val();
            if(propinsi_id) {
                console.log(propinsi_id);
                $.ajax({
                    url: '/fetch/' + propinsi_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {                      
                        $('select[name="kota_id"]').empty();
                        $.each(data, function(key, value) {
                        $('select[name="kota_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        console.log(data);
                    }
                });
            }else{
                $('select[name="kota"]').empty().disabled();
            }
        });
    });
</script>
@endsection