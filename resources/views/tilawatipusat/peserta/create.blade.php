@extends('layouts.tilawatipusat_layouts.master')

@section('title') Peserta @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="{{URL::asset('tilawatipusat/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />


@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') PESERTA {{ $diklat->program->name }}  @endslot
         @slot('title_li')   @endslot
    @endcomponent
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <h4 class="card-title">TAMBAHKAN PESERTA BARU</h4>
                                    <p class="card-title-desc">Pastikan data diisi dengan benar</p>
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2">
                                        <form id="tambahPeserta" method="POST" enctype="multipart/form-data">@csrf
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="form-group col-xl-12">
                                                        <input type="hidden" id="diklat_id" name="pelatihan_id" value="{{ $diklat_id }}">
                                                        <input type="hidden" value="{{ $kabupaten_id }}" class="form-control text-capitalize" name="kabupaten_id" id="kabupaten_id">
                                                    </div>
                                                    @if ($diklat->keterangan == 'santri')
                                                    <div class="form-group col-12 col-xl-12">
                                                        <label for=""><i class="text-danger">*</i> Asal Lembaga</label>
                                                        <div class="form-group">
                                                           <select id="sel_lembaga" name="lembaga_id" class="form-control select2">
                                                               <option value="0"><i class="text-danger">*</i></option>
                                                           </select>
                                                       </div>
                                                    </div>
                                                    @endif
                                                    <div class="form-group col-12 col-xl-6">
                                                        <label for=""><i class="text-danger">*</i> Nama</label>
                                                        <input type="text" name="name" class="form-control text-capitalize" placeholder="" required>
                                                    </div>
                                                    <div class="form-group col-12 col-xl-6">
                                                        <label for=""> Email</label>
                                                        <input type="email" class="form-control input-mask" data-inputmask="'alias':'email'" placeholder="_@_._" name="email">
                                                    </div>
                                                    <div class="form-group col-12 col-xl-6">
                                                        <label for=""><i class="text-danger">*</i> Telp</label>
                                                        <input type="telp" placeholder="081351265451" pattern="[0-9]{3}[0-9]{3}[0-9]{3}[0-9]{3}" maxlength="12" class="form-control " name="telp" required>
                                                    </div>
                                                    <div class="form-group col-12 col-xl-6">
                                                        <label for=""><i class="text-danger">*</i> Asal Kota</label>
                                                        <select id="kota" name="kota" class="form-control select2" required>
                                                            <option value="0"><i class="text-danger"></i></option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-12 col-xl-6">
                                                        <label for=""><i class="text-danger">*</i> Tempat Lahir</label>
                                                        <select id="kota2" name="tmptlahir" class="form-control select2" required>
                                                            <option value="0"><i class="text-danger"></i></option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-12 col-xl-6">
                                                        <label for=""><i class="text-danger">*</i> Tanggal Lahir</label>
                                                        <input type="date" id="tgllahir" name="tgllahir" class="form-control" placeholder="" required>
                                                        <input type="hidden" id="y" name="tgllahir2">
                                                    </div>
                                                    <div class="form-group col-xl-12">
                                                        <label for=""><i class="text-danger">*</i> Alamat Lengkap Sesuai Domisili</label>
                                                        <textarea name="alamat" class="form-control text-capitalize" id="" cols="30" rows="5" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group text-right">
                                                    <input type="submit" class="btn btn-info" id="btnSimpan" value="Simpan!">
                                                </div>
                                           </div>
                                        </form>
                                        <footer class="blockquote-footer">Updated at  <cite title="Source Title">2021</cite></footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
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
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var kab = $('#kabupaten_id').val();
            var dik_id = $('#diklat_id').val();

            $('#sel_lembaga').select2('destroy').select2({
                placeholder: 'Select an item',
                ajax: {
                    url: "/diklat-peserta-lembaga-select/"+kab,
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.name + " - " + item.alamat + " - " +item.kode+  " - " +item.status,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
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

            $('#kota2').select2('destroy').select2({
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

            $('#tambahPeserta').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.peserta_store')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnSimpan').attr('disabled','disabled');
                    $('#btnSimpan').val('Proses Menyimpan Data');
                },
                success: function(data){
                    if(data.success)
                    {
                        //sweetalert and redirect
                        $("#tambahPeserta")[0].reset();
                        toastr.success(data.success);
                        $('#btnSimpan').val('Buat Baru');
                        $('#btnSimpan').attr('disabled',false);
                        swal({ title: "Success!",
                            text: "Peserta Baru Berhasil Dibuat!",
                            type: "success"}).then(okay => {
                            if (okay) {
                                window.location.href = "/diklat-peserta/"+dik_id;
                            }
                        });
                    }else{
                        $('#btnSimpan').val('Buat Baru');
                        $('#btnSimpan').attr('disabled',false);
                        swal({ title: "Error!",
                            text: "Asal lembaga peserta sudah tidak aktif, mohon hubungi Admin Tilawati Pusat!",
                            type: "error"})
                    }
                },
            });
            });
            
        </script>
@endsection