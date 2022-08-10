@extends('layouts.tilawatipusat_layouts.master')

@section('title')
    Peserta
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="{{ URL::asset('tilawatipusat/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
        @slot('title')
            Detail
        @endslot
        @slot('title_li')
            NILAI
        @endslot
    @endcomponent
    @if ($peserta->pelatihan->program->name == "munaqosyah santri")
    <div class="row">
        <div class="col-xl-6">
            @component('common-tilawatipusat.dashboard-widget')
                @slot('title')
                    <?php
                                    $lulus_tak='';
                                    foreach ($peserta->nilai->where("kategori","al-qur'an") as $key => $value) {
                                        # code...
                                        $penil = App\Models\Penilaian::find($value->penilaian_id);
                                        if ($value->nominal < $penil->min) {
                                            # code...
                                            $lulus_tak = $key+1;
                                        }
                                    }
                    ?>
                    
                    <p><b> TOTAL NILAI </b></p> <b>UTAMA : {{ $rata1 }} & RATA-RATA : {{ $rata2 }}</b> &nbsp;&nbsp;
                    @if ($lulus_tak > 0)
                        <b class="badge badge-warning">BELUM BERSYAHADAH SEBAGIAN NILAI DIBAWAH STANDAR</b>
                    @else
                        @if ($rata1 > 69)
                            <b class="badge badge-info">BERSYAHADAH</b>
                        @else
                            <b class="badge badge-warning">BELUM BERSYAHADAH</b>
                        @endif
                    @endif
                @endslot
                @slot('iconClass')
                    mdi mdi-tag-plus-outline
                @endslot
                @slot('price')
                @endslot
            @endcomponent
        </div>
        <div class="col-xl-6">
            @component('common-tilawatipusat.dashboard-widget')
                @slot('title')
                    <p><b>{{ strtoupper($peserta->name) }}</b></p><b class="text-uppercase">
                        {{ $peserta->pelatihan->program->name }}</b> &nbsp;&nbsp;
                @endslot
                @slot('iconClass')
                    mdi mdi-tag-plus-outline
                @endslot
                @slot('price')
                @endslot
            @endcomponent
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-xl-6">
            @component('common-tilawatipusat.dashboard-widget')
                @slot('title')
                    <?php
                                    $lulus_tak='';
                                    foreach ($peserta->nilai->where("kategori","al-qur'an") as $key => $value) {
                                        # code...
                                        $penil = App\Models\Penilaian::find($value->penilaian_id);
                                        if ($value->nominal < $penil->min) {
                                            # code...
                                            $lulus_tak = $key+1;
                                        }
                                    }
                    ?>
                    
                    <p><b> TOTAL NILAI </b></p> <b>UTAMA : {{ $rata1 }} & RATA-RATA : {{ $rata2 }}</b> &nbsp;&nbsp;
                    @if ($lulus_tak > 0)
                        <b class="badge badge-warning">BELUM BERSYAHADAH SEBAGIAN NILAI DIBAWAH STANDAR</b>
                    @else
                        @if ($rata1 > 74)
                            <b class="badge badge-info">BERSYAHADAH</b>
                        @else
                            <b class="badge badge-warning">BELUM BERSYAHADAH</b>
                        @endif
                    @endif
                @endslot
                @slot('iconClass')
                    mdi mdi-tag-plus-outline
                @endslot
                @slot('price')
                @endslot
            @endcomponent
        </div>
        <div class="col-xl-6">
            @component('common-tilawatipusat.dashboard-widget')
                @slot('title')
                    <p><b>{{ strtoupper($peserta->name) }}</b></p><b class="text-uppercase">
                        {{ $peserta->pelatihan->program->name }}</b> &nbsp;&nbsp;
                @endslot
                @slot('iconClass')
                    mdi mdi-tag-plus-outline
                @endslot
                @slot('price')
                @endslot
            @endcomponent
        </div>
    </div>
    @endif
    
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('diklat.nilai_update') }}" method="POST">@csrf
                @if ($peserta->program->name == "standarisasi guru al qur'an level 1")
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title-desc"> Isi Jilid ini apabila peserta diklat belum lulus / belum
                                bersyahadah </br></div>
                            <div class="jilid">
                                <label for="jilid">JILID</label>
                                <input type="text" class="form-control" name="jilid" id="jilid"
                                    value="{{ $peserta->jilid }}">
                            </div>
                        </div>
                    </div>
                @endif
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
                            <div id="menilai" method="POST" enctype="multipart/form-data">

                                <div class="form-group">
                                    <input type="hidden" id="id" value="{{ $peserta->id }}" name="peserta_id">
                                </div>
                                <div class="row">
                                    @foreach ($peserta->nilai as $key => $item)
                                        <div class="form-group col-xl-6 col-12">
                                            <input type="hidden" class="form-control" name="id[{{ $key }}]"
                                                value="{{ $item->id }}" readonly>
                                            <input type="hidden" class="form-control"
                                                name="penilaian_id[{{ $key }}]"
                                                value="{{ $item->penilaian->id }}" readonly>
                                            <small>{{ strtoupper($item->penilaian->name) }}</small><br><small>{{ ' MAX : ' . $item->penilaian->max . ' MIN : ' . $item->penilaian->min }}</small>
                                            <input type="number" class="form-control" name="nominal[{{ $key }}]"
                                                max="{{ $item->penilaian->max }}" 
                                                value="{{ $item->nominal }}">
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary">UPDATE PENILAIAN</button>
                                <br>
                                <a style="margin-top: 10px" href="/diklat-peserta/{{ $peserta->pelatihan_id }}"
                                    type="btton" class="btn btn-sm btn-secondary">KEMBALI KE DAFTAR PESERTA</a>
                                <footer class="blockquote-footer">Updated at <cite title="Source Title">2021</cite></footer>
                        </blockquote>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('script')
    <!-- Script Select2-->
    <script src="{{ URL::asset('/tilawatipusat/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/tilawatipusat/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/tilawatipusat/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ URL::asset('/tilawatipusat/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ URL::asset('/tilawatipusat/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    <!-- form advanced init -->
    <script src="{{ URL::asset('/tilawatipusat/js/pages/form-advanced.init.js') }}"></script>

    <!-- Toast -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- form mask -->
    <script src="{{ URL::asset('/tilawatipusat/libs/inputmask/inputmask.min.js') }}"></script>
    <!-- form mask init -->
    <script src="{{ URL::asset('/tilawatipusat/js/pages/form-mask.init.js') }}"></script>

    <script>
        $(document).ready(function() {

            // var k = $('#kriteria_id').text();
            // var pel_id = $('#pelatihan_id').val();
            // document.getElementById('kriterias').value=k;
            var id = $('#id').val();
            console.log(id);
            $('#updateNilai').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('diklat.nilai_update') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#btnsubmit').attr('disabled', 'disabled');
                        $('#btnsubmit').val('Proses Submit Data');
                    },
                    success: function(data) {
                        if (data.success) {
                            toastr.success(data.success);
                            $('#btnsubmit').val('Submit Nilai');
                            $('#btnsubmit').attr('disabled', false);
                            swal({
                                title: "Success!",
                                text: "Diklat Baru Berhasil Dibuat!",
                                type: "success"
                            }).then(okay => {
                                if (okay) {
                                    window.location.href = "/diklat-peserta/" + id;
                                }
                            });
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endsection
