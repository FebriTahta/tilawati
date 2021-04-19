@extends('layouts.adm.master')
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
                                        <input type="text" class="form-control" name="name" placeholder="Nama Cabang..." required>
                                    </div>
                                    <div class="form-group">
                                        <select name="status" class="form-control" id="" required>
                                            <option value="cabang">Cabang</option>
                                            <option value="calon cabang">Calon Cabang</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="kepala" placeholder="Kepala Cabang..." >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="jabatan" placeholder="Jabatan..." >
                                    </div>
                                    <div class="form-group">
                                        <textarea name="alamat" class="form-control" id="" cols="20" rows="10">Alamat...</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <select name="propinsi_id" class="form-control" id="mySelect" required>
                                                    <option value="">= Propinsi =</option>
                                                    @foreach ($dt_props as $prop)
                                                       <option value="{{ $prop->id }}">{{ $prop->name }}</option>
                                                   @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <select name="kota_id" id="kota" class="form-control" required>
                                                    <option value="">= Kota =</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <input type="text" name="pos" class="form-control" placeholder="Kode Pos..." >
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
                    url: '/public/fetch/' + propinsi_id,
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