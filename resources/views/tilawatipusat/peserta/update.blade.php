@extends('layouts.tilawatipusat_layouts.master')
@section('css')
 <!-- DataTables -->
 <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
 <!-- Select2 -->
 <link href="{{URL::asset('tilawatipusat/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('common-tilawatipusat.breadcrumb')
@slot('title') UPDATE   @endslot
@slot('title_li') PESERTA   @endslot
@endcomponent
<form action="{{route('update.data.peserta')}}" method="POST" enctype="multipart/form-data">@csrf
    <div class="row">
        @if ($alertFm = Session::get('success'))
            <div class="card card-body col-xl-12" style="max-width: 100%; margin-bottom: 20px;">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $alertFm }}</strong>
                </div>
            </div>
            <hr>
        @endif
        <div class="form-group col-xl-4">
            <input type="hidden" name="id" value="{{$peserta->id}}">
            <label for="nama">Nama Peserta</label>
            <input type="text" class="form-control text-uppercase" value="{{$peserta->name}}" id="nama" name="name"  >    
        </div>
        <div class="form-group col-xl-2">
            <label for="nama">Gelar</label>
            <input type="text" class="form-control" value="{{$peserta->gelar}}" id="gelar" name="gelar">    
        </div>
        <div class="form-group col-12">
            <h5>BIODATA</h5>
        </div>
        <div class="form-group col-12 col-xl-6">
            <label for="tmptlahir"><i class="text-danger">*</i> Tempat Lahir (Kab / Kota)</label>
            <select name="tmptlahir" id="tmptlahir" class="form-control" style="max-height: 40px; color: rgb(0, 0, 0); font-size: 13px;" >
                <option value="">{{$peserta->tmptlahir}}</option>
            </select>
        </div>
        <div class="form-group col-12 col-xl-6">
            <label for="tgllahir"><i class="text-danger">*</i> Tanggal Lahir</label>
            {{$peserta->tgllahir}}
            <input type="date" value="{{$peserta->tgllahir}}" name="tgllahir" id="tgllahir" class="form-control" style="max-height: 40px; color: rgb(0, 0, 0); font-size: 13px;"  >
        </div>
        <div class="form-group col-12">
            <h5>ALAMAT LENGKAP</h5>
        </div>
        <div class="form-group col-3 col-xl-3">
            <label for="kode"><i class="text-danger">*</i> Kode</label>
            <input type="text" id="kode" name="kode" value="62" class="form-control" style="max-height: 40px;" readonly  >
        </div>
        <div class="form-group col-9 col-xl-6">
            <label for="phone"><i class="text-danger">*</i> Nomor WA (AKTIF)</label>
            <input type="number" value="{{$peserta->telp}}" pattern="[0-9]*" inputmode="numeric" id="phone" onkeypress="return hanyaAngka(event)" name="phone" class="form-control" style="max-height: 40px;"  >
            <code style="" id="kodephone"></code>
        </div>
        <div class="form-group col-12 col-xl-3">
            <label for="pos"><i class="text-danger">*</i> Kode Pos</label>
            <input type="number" value="{{$peserta->pos}}" id="pos" name="pos" class="form-control" style="max-height: 40px;"  >
            <code style="" id="kodepos"></code>
        </div>
        <div class="form-group col-12 col-xl-6">
            <label for="kabupaten_id"><i class="text-danger">*</i> Kabupaten / Kota</label>
            <select name="kabupaten_id" id="kabupaten_id" class="form-control" style="max-height: 40px; color: rgb(0, 0, 0); font-size: 13px;"  >
                @if ($peserta->kabupaten_id !== null)
                    <option value="{{$peserta->kabupaten_id}}">{{$peserta->kabupaten->nama}}</option>
                @endif
            </select>
        </div>
        <div class="form-group  col-12 col-xl-6">
            <label for="kecamatan_id"><i class="text-danger">*</i> Kecamatan</label>
            <select name="kecamatan_id" id="kecamatan_id" class="form-control text-uppercase" style="max-height: 40px; color: rgb(0, 0, 0); font-size: 13px;"  >
                @if ($peserta->kecamatan_id !== null)
                <option value="{{$peserta->kecamatan_id}}">{{$peserta->kecamatan->nama}}</option>
                @endif
            </select>
        </div>
        <div class="form-group  col-12 col-xl-6">
            <label for="kelurahan_id"><i class="text-danger">*</i> Kelurahan</label>
            <select name="kelurahan_id" id="kelurahan_id" class="form-control text-uppercase" style="max-height: 40px; color: rgb(0, 0, 0); font-size: 13px;"  >
                @if ($peserta->kelurahan_id !== null)
                <option value="{{$peserta->kelurahan_id}}">{{$peserta->kelurahan->nama}}</option>
                @endif
            </select>
        </div>
        <div class="form-group  col-12 col-xl-12">
            <label for="alamat"><i class="text-danger">*</i> Alamat Sesuai KTP</label>
            <textarea name="alamat" class="form-control text-uppercase" id="" cols="30" rows="5"  >{{$peserta->alamat}}</textarea>
        </div>
        <div class="form-group col-12 col-xl-12">
            <label for="">Brsyahadah</label>
            <select name="bersyahadah" id="" class="form-control text-uppercase">
                <option value="{{$peserta->bersyahadah}}">
                @if ($peserta->bersyahadah == 1)
                    Bersyahadah
                @else
                    Belum Bersyahadah
                @endif
                </option>
                <option value="1">Bersyahadah</option>
                <option value="0">Belum Bersyahadah</option>
            </select>
        </div>
        <div class="form-group col-12 col-xl-12">
            <label for="">Kriteria</label>
            <textarea name="kriteria" class="form-control" name="" id="" cols="30" rows="2">{{$peserta->kriteria}}</textarea>
        </div>
        <div class="form-group col-12">
            {{-- <button class="btn btn-info" type="submit">UPDATE DATA</button> --}}
            <input type="submit" class="btn btn-info" value="UPDATE DATA" id="daftar">
            <a href="/diklat-peserta/{{$peserta->pelatihan_id}}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</form>
@endsection

@section('script')
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
<script>
    function save() {
        $('#daftar').val('Memproses Pendaftaran....');
    }
    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
        return true;
    }
    $(document).ready(function(){
        var total = $('#total').val();
        console.log(total);
        $('#negara_id').select2({
            placeholder: 'Asal Negara',
            ajax: {
                url: "{{route('negara')}}",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.country_name,
                            id: item.id
                        }
                    })
                };
            },
                cache: true
            }
        });

        $('select[name="negara_id"]').on('change', function() {
            var negara = $(this).val();
            $.ajax({
                url: '/phone-code-daftar-negara/' + negara,
                type: "GET",
                dataType: "json",
                success:function(data) {                      
                    document.getElementById("kode1").value = data.phonecode;
                    
                }
            });
        });
        $('#pos').keyup(function(){
            postxtln    = $(this).val().length;
            if (postxtln !== 5) {
                document.getElementById('kodepos').style.display="";
                document.getElementById('kodepos').innerHTML = 'wajib terdiri dari 5 angka';
                $('#daftar').attr('disabled','disabled');
                $('#daftar').addClass('btn btn-danger');
                $('#daftar').val('Kesalahan Input');
            }else{
                document.getElementById('kodepos').style.display = "none";
                            $('#daftar').removeClass('btn btn-danger');
                            $('#daftar').addClass('btn btn-success');
                            $('#daftar').attr('disabled',false);
                            $('#daftar').val('UPDATE DATA');
            }
        })
        $('#phone').keyup(function() {
            phonetxtln  = $(this).val().length;
            formatphone = $(this).val().substr(0,1);
            notnumber   = $('#phone').val();
            if (formatphone != 8) {
                document.getElementById('kodephone').style.display = "";
                document.getElementById('kodephone').innerHTML = 'format nomor diawali angka 8';
                $('#daftar').attr('disabled','disabled');
                $('#daftar').addClass('btn btn-danger');
                $('#daftar').val('Kesalahan Input');
            }else{
                document.getElementById('kodephone').style.display = "none";
                if (phonetxtln > 12) {
                document.getElementById('kodephone').style.display = "";
                document.getElementById('kodephone').innerHTML = 'format nomor lebih dari 12 digit';
                $('#daftar').attr('disabled','disabled');
                $('#daftar').addClass('btn btn-danger');
                $('#daftar').val('Kesalahan Input');
                }else{
                    if (phonetxtln < 10) {
                    document.getElementById('kodephone').style.display = "";
                    document.getElementById('kodephone').innerHTML = 'format nomor kurang dari 10 digit';
                    $('#daftar').attr('disabled','disabled');
                    $('#daftar').addClass('btn btn-danger');
                    $('#daftar').val('Kesalahan Input');
                    }else{
                        if (isNaN(notnumber)) {
                            document.getElementById('kodephone').style.display = "";
                            document.getElementById('kodephone').innerHTML = 'hanya boleh format angka';
                            $('#daftar').attr('disabled','disabled');
                            $('#daftar').addClass('btn btn-danger');
                            $('#daftar').val('Kesalahan Input');
                        }else{
                            document.getElementById('kodephone').style.display = "none";
                            $('#daftar').removeClass('btn btn-danger');
                            $('#daftar').addClass('btn btn-success');
                            $('#daftar').attr('disabled',false);
                            $('#daftar').val('UPDATE DATA');
                        }
                    }
                }
            }
        });

        $('#phone1').keyup(function() {
            phonetxtln  = $(this).val().length;
            formatphone = $(this).val().substr(0,1);
            notnumber   = $('#phone1').val();
            document.getElementById('kodephone1').style.display = "none";
                if (phonetxtln > 12) {
                document.getElementById('kodephone1').style.display = "";
                document.getElementById('kodephone1').innerHTML = 'format number cant be more than 12 digit';
                $('#daftar').attr('disabled','disabled');
                $('#daftar').addClass('btn btn-danger');
                $('#daftar').val('Wrong Input');
                }else{
                    if (phonetxtln < 10) {
                    document.getElementById('kodephone1').style.display = "";
                    document.getElementById('kodephone1').innerHTML = 'format number cant be less than 10 digit';
                    $('#daftar').attr('disabled','disabled');
                    $('#daftar').addClass('btn btn-danger');
                    $('#daftar').val('Wrong Input');
                    }else{
                        if (isNaN(notnumber)) {
                            document.getElementById('kodephone1').style.display = "";
                            document.getElementById('kodephone1').innerHTML = 'only format number';
                            $('#daftar').attr('disabled','disabled');
                            $('#daftar').addClass('btn btn-danger');
                            $('#daftar').val('Wrong Input');
                        }else{
                            document.getElementById('kodephone1').style.display = "none";
                            $('#daftar').removeClass('btn btn-danger');
                            $('#daftar').addClass('btn btn-success');
                            $('#daftar').attr('disabled',false);
                            $('#daftar').val('UPDATE DATA');
                        }
                    }
                }
        })

        // default hidden negara lain
        var ya = $('#ya').val();
        if (ya == 1) {
            document.getElementById("nonid").style.display = "none";
        }else{
            // document.getElementById("nonid").style.removeProperty( 'display' );
        }

        var file_size = 0;
        var lebih = 0;
        for (let x = 0; x < total; x++) {
            $('#inputGroupFile02'+x).on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                
                //data
                for(var i=0; i< $(this).get(0).files.length; ++i){
                    var file1 = $(this).get(0).files[i].size;
                    if(file1){
                        $(this).next('.custom-file-label').html(fileName);
                    }
                }
            });

            $('#inputGroupFile02'+x).on('change',function(){
                
            });   
        }
    })
</script>
<script>
    function myFunction() {
        document.getElementById("id").style.removeProperty( 'display' );
        document.getElementById("nonid").style.display = "none";
        console.log('kelihatan');
        $('#tmptlahir').attr('disabled',false);
        $('#tgllahir').attr('disabled',false);
        $('#kode').attr('disabled',false);
        $('#phone').attr('disabled',false);
        $('#pos').attr('disabled',false);
        $('#kabupaten_id').attr('disabled',false);
        $('#kecamatan_id').attr('disabled',false);
        $('#kelurahan_id').attr('disabled',false);
        $('#alamat').attr('disabled',false);
    }
    function myFunction2() {
        document.getElementById("nonid").style.removeProperty( 'display' );
        document.getElementById("id").style.display = "none";
        $('#tmptlahir').attr('disabled','disabled');
        $('#tgllahir').attr('disabled','disabled');
        $('#kode').attr('disabled','disabled');
        $('#phone').attr('disabled','disabled');
        $('#pos').attr('disabled','disabled');
        $('#kabupaten_id').attr('disabled','disabled');
        $('#kecamatan_id').attr('disabled','disabled');
        $('#kelurahan_id').attr('disabled','disabled');
        $('#alamat').attr('disabled','disabled');
        console.log('hilang');
    }
    function disbuttom() {
        $('#daftar').attr('disabled','disabled');
        $('#daftar').val('Proses Mendaftar...');
    }
</script>
<script>
    $('select[name="kabupaten_id"]').on('change', function() {
        //mencari kecamatan dari kota/kab 2 tingkat
        var kabupaten_id = $(this).val();
        
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
                    
                    var x = $( "#kecamatan_id option:selected" ).val();
                    
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
                                
                                var x = $( "#kelurahan_id option:selected" ).val();
                                
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
                    
                }
            });
        }else{
            $('select[name="kelurahan_id"]').empty().disabled();
        }
    });
</script>
<script>
        $('#kabupaten_id').select2({
            // placeholder: 'Kab / kota asal',
            ajax: {
                url: "{{route('kabupaten')}}",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.nama,
                            id: item.id
                        }
                    })
                };
            },
                cache: true
            }
        });
        $('#tmptlahir').select2({
            // placeholder: 'Kab / kota asal',
            ajax: {
                url: "{{route('kabupaten')}}",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.nama,
                            id: item.id
                        }
                    })
                };
            },
                cache: true
            }
        });
        $('#kecamatan_id').select2({
            // placeholder: 'Kab / kota asal',
        });
        $('#kelurahan_id').select2({
            // placeholder: 'Kab / kota asal',
        });
</script>
@endsection