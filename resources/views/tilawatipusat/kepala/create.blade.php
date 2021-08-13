@extends('layouts.tilawatipusat_layouts.master')

@section('title') Kepala Bagian Baru @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('tilawatipusat/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .file {
        visibility: hidden;
        position: absolute;
        }
    </style>
@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') CREATE   @endslot
         @slot('title_li') Kepala Bagian   @endslot
    @endcomponent
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php 
                                        $datax = App\Models\Cabang::where('kode',$data2->kode)->first();
                                        $datay = App\Models\Lembaga::where('kode',$data2->kode)->first();
                                    ?>
                                    <input type="hidden" id="cabang_lembaga" class="form-control" @if($datax == null && $datay !== null) value="lembaga" @elseif($datax !== null && $datay == null) value="cabang" @endif>
                                    <h4 class="card-title">Data Kepala Bagian <b class="text-info text-capitalize">
                                        @if($datax == null && $datay !== null) lembaga @elseif($datax !== null && $datay == null) cabang @endif
                                        {{ strtolower($data2->name) }} </b>
                                    </h4>
                                    <p class="card-title-desc"><code>Pastikan seluruh data kepala bagian diisi dengan benar</code></p>
                                    <form method="post" id="formkepala" enctype="multipart/form-data">@csrf 
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <footer class="blockquote-footer">  <cite title="Source Title">Data Diri</cite></footer>
                                        <div class="row">
                                            <div class="form-group col-xl-6">
                                                <input type="hidden" name="kode" id="kode" class="form-control" value="{{ $data2->kode }}">
                                                <input type="hidden" name="id" id="kepala_id" class="form-control" value="">
                                                <i class="text-danger">* </i><label for="NIK">NIK</label>
                                                <input type="text" class="form-control" placeholder="NIK (16 digit)" maxlength="16" minlength="16" size="16" name="nik" value="" required>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <i class="text-danger">* </i><label for="NAMA">Nama Lengkap</label>
                                                <input type="text" class="form-control" name="name" value="" required>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <i class="text-danger">* </i><label for="TELP">Telephone</label>
                                                <input type="number" name="telp" value="" class="form-control" required>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <i class="text-danger">* </i><label for="GENDER">Gender</label>
                                                <select name="gender" id="" class="form-control" required>
                                                    <option value="">*</option>
                                                    <option value="L">Laki-laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <i class="text-danger">* </i><label for="">Tempat Lahir (Kota / Kab)</label>
                                                <input type="text" value="" name="tmptlahir" class="form-control text-capitalize" required>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <i class="text-danger">* </i><label for="">Tanggal Lahir</label>
                                                <input type="date" value="" name="tgllahir" class="form-control" required>
                                            </div>
                                        </div><hr>
                                        <footer class="blockquote-footer">  <cite title="Source Title">Bio Data (Sesuai KTP)</cite></footer>
                                        <div class="row">
                                            <div class="form-group col-xl-6">
                                                <label><i class="text-danger">*</i> Provinsi</label>
                                                <select name="provinsi_id" id="mySelect" class="form-control" >
                                                    
                                                        <option value="">*</option>
                                                        @foreach ($dt_props2 as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                        @endforeach

                                                </select>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label><i class="text-danger">*</i> Kabupaten / Kota</label>
                                                <select id="kabupaten_id" name="kabupaten_id" class="form-control" >
                                                    
                                                        <option value="">*</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label><i class="text-danger">*</i> Kecamatan</label>
                                                <select id="kecamatan_id" name="kecamatan_id" class="form-control" >
                                                    
                                                        <option value="">*</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <label><i class="text-danger">*</i> Kelurahan</label>
                                                <select id="kelurahan_id" name="kelurahan_id" class="form-control" >
                                                   
                                                        <option value="">*</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <i class="text-danger">* </i><label for="">Alamat</label>
                                                <textarea name="alamat" id="" cols="30" rows="5" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <footer class="blockquote-footer"> <cite title="Source Title">Data Pendukung</cite></footer>
                                        <div class="row">
                                            <div class="form-group col-xl-6">
                                                <i class="text-danger">* </i><label for="">Pendidikan terakhir</label>
                                                <input type="text" name="pendidikanter" value="" class="form-control">
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <i class="text-danger">* </i><label for="">Tahun Lulus</label>
                                                <input type="date" name="tahunlulus" class="form-control" value="" required>
                                            </div>
                                            <div class="form-group col-xl-6">
                                                <i class="text-danger">* </i><label for="">Pekerjaan</label>
                                                <input type="text" value="" name="pekerjaan" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-xl-6">
                                                <i class="text-danger"></i><label for="">Foto <span class="text-warning">(boleh tidak diisi)</span></label>
                                                    <div class="input-group my-3">
                                                        <input type="file" name="photo" value="" class="file" accept="image/*">
                                                        <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
                                                        <div class="input-group-append">
                                                            <button type="button" class="browse btn btn-primary">Browse...</button>
                                                        </div>
                                                    </div> 
                                                        <img  src="https://placehold.it/80x80"  id="preview" class="img-thumbnail">
                                            </div>
                                        </div>
                                            <div class="form-group text-right">
                                                <input type="submit" id="btnsubmit" class="btn btn-info" value="Submit!">
                                            </div>
                                    </blockquote>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <!--modal import kepala-->
                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade bs-example-modal-kepala" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0">IMPORT DATA kepala </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="importkepala"  method="POST" enctype="multipart/form-data">@csrf
                                                            <input type="hidden" id="import_tipe" value="munaqisy">
                                                            <div class="form-group">
                                                                <label for="">Import Data "kepala" (hanya Excel File format .xlsx)</label>
                                                                <input type="file" class="form-control" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
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
                    <!--modal import rpq-->
                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade bs-example-modal-rpq" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0">IMPORT DATA RPQ </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="importrpq"  method="POST" enctype="multipart/form-data">@csrf
                                                            <input type="hidden" id="import_tipe" value="munaqisy">
                                                            <div class="form-group">
                                                                <label for="">Import Data "RPQ" (hanya Excel File format .xlsx)</label>
                                                                <input type="file" class="form-control" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="submit" name="import" id="btnimportrpq" class="btn btn-info" value="Import"/>
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

        <script>
        $(document).on("click", ".browse", function() {
            var file = $(this).parents().find(".file");
            file.trigger("click");
        });
        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {   
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });

        $('#kota').select2('destroy').select2({
                placeholder: 'Select an item',
                ajax: {
                    url: "/diklat-peserta-kota-select",
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
        
        
        $('#formkepala').submit(function(e) {
            if (cabang_lembaga == 'cabang') {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.kepala_cabang_store')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnsubmit').attr('disabled','disabled');
                    $('#btnsubmit').val('Proses Menyimpan Data');
                    
                },
                success: function(data){
                    if(data.success)
                    {
                        $("#formkepala")[0].reset();
                        $('#btnsubmit').val('Submit!');
                        $('#btnsubmit').attr('disabled',false);
                        swal({ title: "Success!",
                            text: "Kepala Bagian Baru Berhasil Di Tabahkan!",
                            type: "success"}).then(okay => {
                            if (okay) {
                                window.location.href = "/diklat-cabang";
                            }
                        });
                    }
                    else{
                        $('#btnsubmit').val('Buat Baru');
                        $('#btnsubmit').attr('disabled',false);
                        swal({ title: "Error!",
                            text: "NIK sudah terdaftar, silahkan masukan NIK sesuai KTP",
                            type: "error"})
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            } else {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.kepala_lembaga_store')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnsubmit').attr('disabled','disabled');
                    $('#btnsubmit').val('Proses Menyimpan Data');
                    
                },
                success: function(data){
                    if(data.success)
                    {
                        $("#formkepala")[0].reset();
                        $('#btnsubmit').val('Submit!');
                        $('#btnsubmit').attr('disabled',false);
                        swal({ title: "Success!",
                            text: "Kepala Bagian Baru Berhasil Di Tabahkan!",
                            type: "success"}).then(okay => {
                            if (okay) {
                                window.location.href = "/diklat-lembaga";
                            }
                        });
                    }else{
                        $('#btnsubmit').val('Buat Baru');
                        $('#btnsubmit').attr('disabled',false);
                        swal({ title: "Error!",
                            text: "NIK sudah terdaftar, silahkan masukan NIK sesuai KTP",
                            type: "error"})
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            }
        
        });
        $(document).ready(function() {
            var cabang_lembaga = $('#cabang_lembaga').val();
            console.log(cabang_lembaga);

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
        })
        </script>
        @endsection