@extends('layouts.tilawatipusat_layouts.master')

@section('title') ijazah belakang @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') ijazah belakang    @endslot
         @slot('title_li') CETAK   @endslot
    @endcomponent
                    {{-- <div class="row">
                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="cb"> 2,456 </b> ijazah depan guru  @endslot
                                @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                    </div> --}}

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Ijazah Belakang</h4>
                                    <p class="card-title-desc">Ter-update berdasarkan Tahun {{date('Y')}} </br></p>
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2">
                                        <form target="_blank" action="{{ route('diklat.belakang_cetak') }}" method="POST">@csrf
                                            <div class="form-group">
                                                <label for="">Jenis Program</label>
                                                <select name="program_id" id="" class="form-control text-capitalize" required>
                                                    <option value="">= Pilih Jenis Program =</option>
                                                    @foreach ($dt_pro as $item)
                                                        <option class="text-capitalize" value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Program Pelatihan</label>
                                                <select name="pelatihan_id" id="pelatihan_id" class="form-control text-capitalize" required>
                                                    <option class="text-capitalize" value="">= Pilih Program Pelatihan =</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-print"></i> Cetak</button>
                                            </div>
                                        </form>
                                        <footer class="blockquote-footer">Updated at  <cite title="Source Title">{{date('Y')}}</cite></footer>
                                    </blockquote>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Alternatif Cetak Berkala</h4>
                                    <p class="card-title-desc">Gunakan tombol berikut ini apabila file yang akan dicetak terlalu banyak dan tidak dapat di handle oleh server </br></p>
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <form target="_blank" action="{{ route('diklat.belakang_cetak_bagian_1') }}" method="POST">@csrf
                                                    <input type="text" class="form-control" name="pelatihan_id" id="pelatihan_id_bagian_1">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak Bagian 1</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-2">
                                                <form target="_blank" action="{{ route('diklat.belakang_cetak_bagian_2') }}" method="POST">@csrf
                                                    <input type="text" class="form-control" name="pelatihan_id" id="pelatihan_id_bagian_2">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak Bagian 2</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <footer class="blockquote-footer">Updated at  <cite title="Source Title">{{date('Y')}}</cite></footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>

                        {{--   --}}


                    </div>
                    <!-- end row -->

@endsection

@section('script')

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
                                        $('select[name="pelatihan_id"]').append('<option value="'+ value.id +'">'+ value.id +" | "+ value.cabang.name + " | " + value.program.name + " | " + value.tanggal + " | " + value.tempat + '</option>');
                                        $('#pelatihan_id_bagian_1').val(value.id);
                                        $('#pelatihan_id_bagian_2').val(value.id);
                                    });
                                    console.log(data);
                                }
                            });
                        }else{
                            $('select[name="pelatihan_id"]').empty().disabled();
                        }
                    });

                    $('#pelatihan_id').on('change', function () {
                        var pelatihan_id = $(this).val();
                        if (pelatihan_id) {
                            $('#pelatihan_id_bagian_1').val(pelatihan_id);
                            $('#pelatihan_id_bagian_2').val(pelatihan_id);
                        }else{
                            alert("Pilih Pelatihan Terlebih Dahulu");
                        }
                        
                    })
                });
            </script>
@endsection