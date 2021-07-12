@extends('layouts.tilawatipusat_layouts.master')

@section('title') diklat @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="{{URL::asset('tilawatipusat/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('tilawatipusat/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('tilawatipusat/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('tilawatipusat/libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />


@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') diklat   @endslot
         @slot('title_li') Buat Baru   @endslot
    @endcomponent
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                    
                                    <h4 class="card-title">BUAT DIKLAT BARU</h4>
                                    <p class="card-title-desc">Pastikan data diisi dengan benar </br></p>
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2">
                                        {{-- <form action="{{ route('pelatihan.store') }}" method="POST">@csrf --}}
                                        <form id="diklat_store" method="POST" enctype="multipart/form-data">@csrf
                                            <div class="form-group">
                                                 <div class="row">
                                                     <div class="form-group col-xl-6">
                                                         <label for="">Tanggal</label>
                                                         <input type="date" name="tanggal" class="form-control " required>
                                                     </div>
                                                     <div class="form-group col-xl-6">
                                                         <label for="">Cabang</label>
                                                         <input type="hidden" class="form-control text-capitalize" id="cabsid" name="cabang_id">
                                                         <div class="form-group">
                                                            <input type="hidden" name="cabang_id" id="y">
                                                            <select name="sel_cabang" id="sel_cabang" class="form-control select2">
                                                                <option value="0"> PILIH CABANG</option>
                                                            </select>
                                                        </div>
                                                     </div>
                                                 </div>
                                                 {{-- <div class="form-group">
                                                    <label for="">Nama Pelatihan</label>
                                                     <input type="text" name="name" class="form-control text-capitalize" required>
                                                 </div> --}}
                                                 <div class="form-group">
                                                    <label for="">Program</label>
                                                     <select name="program_id" class="form-control text-capitalize" id="" required>
                                                         <option value="">= Pilih Program =</option>
                                                         @foreach ($dt_program as $item)
                                                             <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                         @endforeach
                                                     </select>
                                                 </div>
                                                 <div class="form-group">
                                                     <label for="">Tempat</label>
                                                     <textarea name="tempat" class="form-control text-capitalize" id="" cols="30" rows="" required></textarea>
                                                 </div>
                                                 <div class="form-group">
                                                     <label for="">Keterangan</label>
                                                     <select name="keterangan" id="" class="form-control text-capitalize" required>
                                                         <option value="">= Untuk Guru / Santri =</option>
                                                         <option value="guru">GURU</option>
                                                         <option value="santri">SANTRI</option>
                                                         <option value="instruktur">INSTRUKTUR</option>
                                                     </select>
                                                 </div>
                                            </div>
                                            <div class="form-group text-right col-md-12">
                                                <button class="btn btn-primary" id="z" type="submit"> <i class="fa fa-save"></i> Save</button>
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
        
        <!-- Required datatable js -->
        <script src="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.js')}}"></script>
        <script src="{{ URL::asset('tilawatipusat/libs/jszip/jszip.min.js')}}"></script>
        <script src="{{ URL::asset('tilawatipusat/libs/pdfmake/pdfmake.min.js')}}"></script>

        <!-- Datatable init js -->
        <script src="{{ URL::asset('tilawatipusat/js/pages/datatables.init.js')}}"></script>

        <script>
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            
            $(document).ready(function(){
                $('.select2').on('change', function() {
                    var name = $(".select2 option:selected").text();
                    
                    $.ajax({
                        url: '/diklat-diklat-cabang-id-select/'+name,
                        type: 'get',
                        dataType: 'json',
                        success: function(data){
                            console.log(data.id);
                            $('#y').val(data.id)
                        }
                    });
                })

                $('#sel_cabang').select2('destroy').select2({
                    placeholder: 'Select an item',
                    ajax: {
                        url: "{{route('diklat.diklat_cabang_select')}}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.kode,
                                    text: item.name,
                                    id: item.id   
                                }
                            })
                        };
                        },
                        cache: true
                    }
                });
            });

            $('#diklat_store').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.store')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#store').attr('disabled','disabled');
                    $('#store').val('Proses Menyimpan Data');
                },
                success: function(data){
                    if(data.success)
                    {
                        //sweetalert and redirect
                        $("#diklat_store")[0].reset();
                        toastr.success(data.success);
                        $('#store').val('Buat Baru');
                        $('#store').attr('disabled',false);
                        swal({ title: "Success!",
                            text: "Diklat Baru Berhasil Dibuat!",
                            type: "success"}).then(okay => {
                            if (okay) {
                                window.location.href = "/diklat-diklat";
                            }
                        });
                    }
                    if(data.error)
                    {
                        $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
                        $('#btnimport').attr('disabled',false);
                        $('#btnimport').val('Import');
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });
            
        </script>
@endsection