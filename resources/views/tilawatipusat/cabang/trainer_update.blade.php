@extends('layouts.tilawatipusat_layouts.master')

@section('title')
    Cabang
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('tilawatipusat/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('tilawatipusat/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('tilawatipusat/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('tilawatipusat/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @component('common-tilawatipusat.breadcrumb')
        @slot('title')
            Trainer
        @endslot
        @slot('title_li')
            {{ substr($trainer->cabang->kabupaten->nama, 5) }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title text-uppercase">{{ $trainer->name }} - Trainer Cabang
                        {{ substr($trainer->cabang->kabupaten->nama, 5) }}
                    </h4>
                    <code class="card-title-desc">Sedang Dalam Pengembangan </br></code>

                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                        <form id="trainer_store" class="text-capitalize" method="POST" enctype="multipart/form-data">@csrf
                            <div class="row">
                                <input type="hidden" name="id" id="id" value="{{ $trainer->id }}">
                                <input type="hidden" name="cabang_id" value="{{ $trainer->cabang_id }}">
                                <div class="col-md-6 col-12 form-group">
                                    <label for="">Nama</label>
                                    <input type="text" id="name" name="name" value="{{ $trainer->name }}"
                                        class="form-control text-capitalize" required>
                                </div>
                                <div class="col-md-6 col-12 form-group">
                                    <label for="">WA / Telp</label>
                                    <input type="number" id="telp" name="telp" value="{{ $trainer->telp }}"
                                        class="form-control" required>
                                </div>
                                <div class="col-md-6 col-12 form-group">
                                    <label for="">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" id="" cols="3"
                                        rows="3">{{ $trainer->alamat }}</textarea>
                                </div>
                                <div class="col-md-6 col-12 form-group">
                                    <h5 class="border-bottom">STATUS INSTRUKTUR SAAT INI</h5>
                                    @foreach ($trainer->macamtrainer as $key => $item)
                                        <p>{{ $key + 1 }} - {{ $item->jenis }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            {{-- <div class="row">

                                @foreach ($instruktur as $item)
                                    
                                @endforeach

                                @foreach ($macam as $items)
                                <div class="col-md-6 col-12 form-group">
                                    <label for="">{{$items->jenis}}</label>
                                    <input type="text" id="" name="" value=""
                                        class="form-control" required>
                                </div>
                                @endforeach
                            </div> --}}
                            {{-- <h5 class="border-bottom">ISI "Ok" SESUAI STATUS TRAINER</h5> --}}
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- <div class="row">
                                    @foreach ($macam as $key => $items)
                                        
                                            <div class="col-md-6 col-12 form-group">
                                                <label for="">{{ $items->jenis }}</label>
                                                <input type="text" id="" name="macamtrainer_id[{{$key+1}}]" class="form-control">
                                            </div>
                                        
                                    @endforeach
                                    </div> --}}
                                    <div class="form-group mb-0">
                                        <label class="control-label">Sebagai</label>
                                        <select class="select2 form-control select2-multiple" name="status[]" multiple="multiple"
                                            data-placeholder="Status Trainer ..." required>
                                            <optgroup label="-">
                                                @foreach ($macam as $key => $items)
                                                <option value="{{ $items->id }}">{{ $items->jenis }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group text-right">
                                <input type="submit" id="z" class="btn btn-outline-primary" value="UPDATE!">

                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">BACK</a>
                            </div>
                        </form>
                        <footer class="blockquote-footer">Updated at <cite title="Source Title">2021</cite></footer>
                    </blockquote>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    {{-- MODAL --}}
@endsection

@section('script')
    <!-- Toast -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="{{ URL::asset('tilawatipusat/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    <!-- form advanced init -->
    <script src="{{ URL::asset('tilawatipusat/js/pages/form-advanced.init.js') }}"></script>
    <!-- Required datatable js -->
    <script src="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/pdfmake/pdfmake.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ URL::asset('tilawatipusat/js/pages/datatables.init.js') }}"></script>

    <script>
        $('#trainer_store').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('update.data.trainer') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#z').attr('disabled', 'disabled');
                    $('#z').val('Proses Update Data');
                },
                success: function(data) {
                    if (data.success) {
                        toastr.success(data.success);
                        $('#z').val('UPDATE!');
                        $('#z').attr('disabled', false);
                        swal({
                            title: "Success!",
                            text: "Data Trainer Di Update!",
                            type: "success"
                        }).then(okay => {
                            if (okay) {
                                window.location.href = "/data-trainer/cabang";
                            }
                        });
                    } else {
                        $('#z').val('UPDATE!');
                        $('#z').attr('disabled', false);
                        swal({
                            title: "Error!",
                            text: "Asal lembaga peserta sudah tidak aktif, mohon hubungi Admin Tilawati Pusat!",
                            type: "error"
                        })
                    }
                },
            });
        });
    </script>
@endsection
