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
                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br></p>

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
                                <div class="col-md-12 col-12 form-group " style="margin-bottom: 10px" id="dynamic_field">
                                    <button type="button" class="btn btn-outline-primary btn-sm"
                                                name="add" id="add"><i class="fa fa-plus"></i></button>
                                    @foreach ($trainer->macamtrainer as $key=> $item)
                                        @if ($key > 0)
                                        <button type="button" class="btn btn-outline-danger btn-sm btn_remove"><i class="fa fa-minus"></i></button>
                                        @endif
                                        <label for="" style="margin-top: 20px"> Trainer</label>
                                        <?php $macam = App\Models\Macamtrainer::all();?>
                                        <select name="trainer[]" class="form-control" required>
                                            @foreach ($macam as $item)
                                                <option value="{{item}}">{{$item->jenis}}</option>
                                            @endforeach
                                        </select>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <div class="form-group text-right">
                                <input type="submit" id="z" class="btn btn-outline-primary" value="Submit!">
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
