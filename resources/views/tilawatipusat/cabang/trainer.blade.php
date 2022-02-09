@extends('layouts.tilawatipusat_layouts.master')

@section('title') Cabang @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
        @slot('title') Cabang @endslot
        @slot('title_li') Tilawati @endslot
    @endcomponent
    <div class="row">
        <div class="col-xl-4">
            @component('common-tilawatipusat.dashboard-widget')

                @slot('title') <b id="cb"> 2,456 </b> Cabang @endslot
                @slot('iconClass') mdi mdi-bank-outline @endslot
                @slot('price') @endslot

            @endcomponent
        </div>
        <div class="col-xl-4">
            @component('common-tilawatipusat.dashboard-widget')

                @slot('title') <b id="kb"> 2,456 </b> Kabupaten @endslot
                @slot('iconClass') mdi mdi-city @endslot
                @slot('price') @endslot

            @endcomponent
        </div>
        <div class="col-xl-4">
            @component('common-tilawatipusat.dashboard-widget')

                @slot('title') <b id="pv"> 2,456 </b> Provinsi @endslot
                @slot('iconClass') mdi mdi-city-variant-outline
                @endslot
                @slot('price') @endslot

            @endcomponent
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Data Cabang</h4>
                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br></p>
                    <button class="btn btn-sm btn-success mb-2 mr-1" style="width:130px " data-toggle="modal"
                        data-target=".bs-example-modal-tambah-tainer"><i class="mdi mdi-plus"></i> Daftarkan
                        Trainer</button>

                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                        <table id="datatable-buttons" class="table table-cabang table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead class="text-bold text-primary" style="text-transform: uppercase; font-size: 10px">
                                <tr>
                                    <th>Nama</th>
                                    <th>Trainer</th>
                                    <th>Status</th>
                                    <th>Wa / Telp</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>

                            <tbody style="font-size: 10px">
                            </tbody>

                            <tfoot class="text-bold text-primary" style="text-transform: uppercase; font-size: 10px">
                                <tr>
                                    <th>Nama</th>
                                    <th>Trainer</th>
                                    <th>Status</th>
                                    <th>Wa / Telp</th>
                                    <th>Alamat</th>
                                </tr>
                            </tfoot>
                        </table>
                        <footer class="blockquote-footer">Updated at <cite title="Source Title">2021</cite></footer>
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
    <script src="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('tilawatipusat/libs/pdfmake/pdfmake.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ URL::asset('tilawatipusat/js/pages/datatables.init.js') }}"></script>

    <script>
        var kode;
        $('#form_tambah_trainer').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('diklat.cabang_store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#tambahlembaga_btn').attr('disabled', 'disabled');
                    $('#tambahlembaga_btn').val('Proses Menyimpan Data');

                },
                success: function(data) {
                    if (data.success) {
                        $("#form_tambah_cabang")[0].reset();
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        $('#tambahlembaga_btn').val('Submit!');
                        $('.bs-example-modal-tambah-cabang').modal('hide');
                        $('#tambahlembaga_btn').attr('disabled', false);
                        swal({
                            title: "Success!",
                            text: "Cabang Baru Berhasil Di Tabahkan!",
                            type: "success"
                        })
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('#datatable-buttons').DataTable({
        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('data.trainer.cabang') }}',
        },
        columns: [{
                data: 'name',
                name: 'name'
            },
            {
                data: 'telp',
                name: 'telp'
            },
            {
                data: 'trainer',
                name: 'trainer'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'alamat',
                name: 'alamat'
            },
            
        ]
        });
    </script>
@endsection
