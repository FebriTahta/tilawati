@extends('layouts.adm.master')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="float-right page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Pelatihan</a></li>
                <li class="breadcrumb-item active">Cetak Ijazah Depan</li>
            </ol>
        </div>
        <h5 class="page-title">Cetak Ijazah Depan</h5>
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
                            <div class="card m-b-30">
                                {{-- <div class="card-body"> --}}
                                    {{-- <div class="">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                                        </div>
                                    </div> --}}
                                {{-- </div> --}}
                            </div>                          
                            <form target="_blank" action="{{ route('depan.cetak') }}" method="POST">@csrf
                                <div class="form-group">
                                    <label for="">Jenis Program</label>
                                    <select name="program_id" id="" class="form-control" required>
                                        <option value="">= Pilih Jenis Program =</option>
                                        @foreach ($dt_pro as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>    
                                <div class="form-group">
                                    <label for="">Program Pelatihan</label>
                                    <select name="pelatihan_id" id="" class="form-control" required>
                                        <option value="">= Pilih Program Pelatihan =</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-print"></i> Cetak</button>
                                </div>
                            </form>        
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
        $('select[name="program_id"]').on('change', function() {
            var program_id = $(this).val();
            if(program_id) {
                console.log(program_id);
                $.ajax({
                    url: '/fetchpp/' + program_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {    
                        var tmp = data.toString().split(',');                  
                        $('select[name="pelatihan_id"]').empty();
                        $.each(data, function(key, value) {
                        $('select[name="pelatihan_id"]').append('<option value="'+ value.id +'">'+ value.id + " | " + value.name + " | " + value.tanggal + " | " + value.tempat +'</option>');
                        });
                        console.log(data);
                    }
                });
            }else{
                $('select[name="pelatihan_id"]').empty().disabled();
            }
        });
    });
</script>
@endsection