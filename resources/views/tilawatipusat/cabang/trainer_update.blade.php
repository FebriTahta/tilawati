@extends('layouts.tilawatipusat_layouts.master')

@section('title') Cabang @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
        @slot('title') Trainer @endslot
        @slot('title_li') {{ substr($trainer->cabang->kabupaten->nama, 5) }} @endslot
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
                                <input type="hidden" name="id" id="id">
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
                            <div class="form-group text-right">
                                {{-- <input type="submit" id="z" class="btn btn-outline-primary" value="BACK!"> --}}
                                <a href="{{url()->previous()}}" class="btn btn-outline-primary">BACK</a>
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

    <!-- Required datatable js -->
    <script src="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/pdfmake/pdfmake.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ URL::asset('tilawatipusat/js/pages/datatables.init.js') }}"></script>

    <script>

    </script>
@endsection
