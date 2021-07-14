@extends('layouts.tilawatipusat_layouts.master')

@section('title') cetak detail peserta @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') detail peserta    @endslot
         @slot('title_li') CETAK   @endslot
    @endcomponent
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Ijazah Depan</h4>
                                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br></p>
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2">
                                        <form target="_blank" action="{{ route('diklat.detail_cetak') }}" method="POST">@csrf
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
                                                <select name="pelatihan_id" id="" class="form-control text-capitalize" required>
                                                    <option class="text-capitalize" value="">= Pilih Program Pelatihan =</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-print"></i> Cetak</button>
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
                                    $('select[name="pelatihan_id"]').append('<option value="'+ value.id +'">'+ value.cabang.name + " | " + value.program.name + " | " + value.tanggal + " | " + value.tempat + '</option>');
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