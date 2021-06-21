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
         @slot('title') {{ $peserta->name }} @endslot
         @slot('title_li')  NILAI  @endslot
    @endcomponent
    <div class="row">
        <div class="col-xl-4">
            @component('common-tilawatipusat.dashboard-widget')
            
                @slot('title') <p> Nilai </p> <b> {{ $rata2 }}</b> &nbsp;&nbsp;
                @if ($rata2 > 82)
                <b class="badge badge-info">lulus (Baik)</b>
                @else
                <b class="badge badge-warning">lulus (Cukup)</b>
                @endif  @endslot
                @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
                @slot('price')   @endslot
                
            @endcomponent
        </div>
        <div class="col-xl-8">
            @component('common-tilawatipusat.dashboard-widget')
            
                @slot('title') <p>Program Diklat</p> <b class="text-capitalize"> {{ $peserta->pelatihan->program->name }}</b> &nbsp;&nbsp;
                @endslot
                @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
                @slot('price')   @endslot
                
            @endcomponent
        </div>
    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <p class="card-title-desc">Rincian Nilai Peserta </br></p>
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2">
                                        <form id="updateNilai" method="POST" enctype="multipart/form-data">@csrf
                                            <input type="hidden" value="{{ $peserta->id }}" name="peserta_id">
                                            <input type="hidden" value="{{ $peserta->pelatihan_id }}" name="pelatihan_id" id="id">
                                            <input type="hidden" value="{{ $peserta->tanggal }}" name="tanggal">
                                            <input type="hidden" name="name" value="{{ $peserta->name }}">
                                            <div class="row">
                                                @foreach ($peserta->nilai as $item)
                                                    @if ($item->kategori !== 'skill')
                                                        <div class="form-group col-xl-6 col-12">
                                                            <label for="" class="text-capitalize">{{ $item->penilaian->name }}
                                                                @if ($item->penilaian->max !== null || $item->penilaian->min !== null)
                                                                    <br><i class="text-danger">Min:{{ $item->penilaian->min }}</i> & <i class="text-danger">Max:{{ $item->penilaian->max }}</i>
                                                                @endif
                                                            </label>
                                                            <input type="hidden" readonly name="id" value="{{ $item->id }}">
                                                            <input type="hidden" name="kategori[]" value="{{ $item->penilaian->kategori }}">
                                                            <input type="hidden" name="penilaian_id[]" value="{{ $item->penilaian->id }}">
                                                            <input type="number" readonly id="nominal[]" value="{{ $item->nominal }}" name="nominal[]" min="{{ $item->penilaian->min }}" max="{{ $item->penilaian->max }}" class="form-control">
                                                        </div>
                                                    @else
                                                        <div class="form-group col-xl-6 col-12">
                                                            <label for="" class="text-capitalize">{{ $item->penilaian->name }}
                                                                @if ($item->penilaian->max !== null || $item->penilaian->min !== null)
                                                                    <br><i class="text-danger">Min:{{ $item->penilaian->min }}</i> & <i class="text-danger">Max:{{ $item->penilaian->max }}</i>
                                                                @else<br><br>
                                                                @endif
                                                            </label>
                                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                                            <input type="hidden" name="kategori[]" value="{{ $item->penilaian->kategori }}">
                                                            <input type="hidden" name="penilaian_id[]" value="{{ $item->penilaian->id }}">
                                                            <input type="number" readonly id="nominal[]" value="{{ $item->nominal }}" name="nominal[]" min="{{ $item->penilaian->min }}" max="{{ $item->penilaian->max }}" class="form-control">
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="">Sebagai</label>
                                                <select name="kriteria_id" id="kriteria_id" class="form-control">
                                                    @foreach ($peserta->pelatihan->program->kriteria as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" class="form-control" id="kriterias" name="kriteria">
                                            </div> --}}
                                            {{-- <div class="form-group text-right">
                                                <input type="submit" class="form-control btn btn-info" id="btnsubmit" value="Update Nilai">
                                            </div> --}}
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
            $(document).ready(function(){

                // var k = $('#kriteria_id').text();
                // var pel_id = $('#pelatihan_id').val();
                // document.getElementById('kriterias').value=k;
                var id = $('#id').val();
                console.log(id);
                $('#updateNilai').submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                    type:'POST',
                    url: "{{ route('diklat.nilai_update')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    beforeSend:function(){
                        $('#btnsubmit').attr('disabled','disabled');
                        $('#btnsubmit').val('Proses Submit Data');
                    },
                    success: function(data){
                        if(data.success)
                        {
                            toastr.success(data.success);
                            $('#btnsubmit').val('Submit Nilai');
                            $('#btnsubmit').attr('disabled',false);
                            swal({ title: "Success!",
                                text: "Diklat Baru Berhasil Dibuat!",
                                type: "success"}).then(okay => {
                                if (okay) {
                                    window.location.href = "/diklat-peserta/"+id;
                                }
                            });
                        }
                    },
                    error: function(data)
                    {
                        console.log(data);
                        }
                    });
                });
            });
        </script>
@endsection