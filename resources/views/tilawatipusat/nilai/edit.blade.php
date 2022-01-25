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
         @slot('title')Detail  @endslot
         @slot('title_li')  NILAI  @endslot
    @endcomponent
    <div class="row">
        <div class="col-xl-6">
            @component('common-tilawatipusat.dashboard-widget')
                
                @slot('title') <p><b> TOTAL NILAI RATA-RATA</b></p> <b> {{ $rata2 }}</b> &nbsp;&nbsp;
                {{$peserta->pelatihan->kategori}}
                @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
                @slot('price')   @endslot
                
            @endcomponent
        </div>
        <div class="col-xl-6">
            @component('common-tilawatipusat.dashboard-widget')
            
                @slot('title') <p><b>{{ strtoupper($peserta->name) }}</b></p><b class="text-capitalize"> {{ $peserta->pelatihan->program->name }}</b> &nbsp;&nbsp;
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
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>    
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @endif
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2">
                                        <div id="menilai"  method="POST" enctype="multipart/form-data">
                                            <form action="{{route('diklat.nilai_update')}}" method="POST">@csrf
                                                <div class="form-group">
                                                    <input type="hidden" id="id" value="{{$peserta->id}}" name="peserta_id">
                                                </div>
                                                <div class="row">
                                                    @foreach ($peserta->nilai as $key=>$item)
                                                        <div class="form-group col-xl-6 col-12">
                                                            <input type="hidden" class="form-control" name="id[{{$key}}]" value="{{$item->id}}" readonly>
                                                            <input type="hidden" class="form-control" name="penilaian_id[{{$key}}]" value="{{$item->penilaian->id}}" readonly>
                                                            <small>{{strtoupper($item->penilaian->name)}}</small>
                                                            <input type="text" class="form-control" name="nominal[{{$key}}]" value="{{$item->nominal}}">  
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="form-group">
                                                    <label for="program">KRITERIA</label>
                                                    <input list="listkriteria" name="mykriteria" value="{{$peserta->kriteria}}" class="form-control">
                                                    <datalist id="listkriteria">
                                                        @foreach ($kriteria as $krit)
                                                            <option value="{{$krit->name}}">
                                                        @endforeach
                                                    </datalist>
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-primary">UPDATE PENILAIAN</button>
                                            </form>
                                            <a style="margin-top: 10px"  href="/diklat-peserta/{{$peserta->pelatihan_id}}" type="btton" class="btn btn-sm btn-secondary">KEMBALI KE DAFTAR PESERTA</a>
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