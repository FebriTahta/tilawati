@extends('layouts.tilawatipusat_layouts.master')

@section('title') diklat @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') diklat   @endslot
         @slot('title_li') diklat Tilawati   @endslot
    @endcomponent
                    <div class="row">
                        <div class="col-xl-4">
                            @component('common-tilawatipusat.dashboard-widget')
                            
                                @slot('title') <b id="cb"> 2,456 </b> diklat  @endslot
                                @slot('iconClass') mdi mdi-tag-plus-outline  @endslot
                                @slot('price')   @endslot
                                
                            @endcomponent
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                    
                                    <h4 class="card-title">Data diklat</h4>
                                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br></p>
                                    <button class="btn btn-sm btn-success  mr-1" style="width:130px " data-toggle="modal" data-target=".bs-example-modal-diklat"><i class="mdi mdi-plus"></i> tambah diklat</button>
                    
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2">
                                        <table id="datatable-buttons" class="table table-diklat table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary" style="text-transform: capitalize">
                                                <tr>
                                                    <th>diklat</th>
                                                </tr>
                                            </thead>
    
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>

                                            <tfoot class="text-primary" style="text-transform: capitalize">
                                                <tr>
                                                    <th>diklat</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <footer class="blockquote-footer">Updated at  <cite title="Source Title">2021</cite></footer>
                                    </blockquote>
                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <!--modal import diklat-->
                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade bs-example-modal-diklat" id="modal1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0">DIKLAT BARU</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                       <form action="{{ route('pelatihan.store') }}" method="POST">@csrf
                                           <div class="form-group">
                                                <div class="row">
                                                    <div class="form-group col-xl-6">
                                                        <label for="">Tanggal</label>
                                                        <input type="date" name="tanggal" class="form-control " required>
                                                    </div>
                                                    <div class="form-group col-xl-6">
                                                        <label for="">Cabang</label>
                                                        <input type="hidden" class="form-control text-capitalize" id="cabsid" name="cabang_id">
                                                        {{-- <input type="text" data-target="#exampleModalScrollable" id="cabs" class="text-capitalize form-control" data-toggle="modal" readonly placeholder="*Click me"> --}}
                                                        <!-- For defining select2 -->
                                                        <select id='sel_emp' class="form-control">
                                                            <option value='0'>-- Select Cabang --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-control text-capitalize" placeholder="Nama Pelatihan..." required>
                                                </div>
                                                <div class="form-group">
                                                    <select name="program_id" class="form-control text-capitalize" id="" required>
                                                        <option value="">= Pilih Program =</option>
                                                        @foreach ($dt_program as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Tempat</label>
                                                    <textarea name="tempat" class="form-control text-capitalize" id="" cols="30" rows=""></textarea>
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
                                           <div class="form-group text-right">
                                               <button class="btn btn-primary" type="submit"> <i class="fa fa-save"></i> Save</button>
                                           </div>
                                       </form>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>

@endsection

@section('script')

        <!-- Script Select2-->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
            $(document).ready(function(){
                select2
                $( "#sel_cabang" ).select2({
                    ajax: { 
                    url: "{{route('diklat.diklat_cabang_select')}}",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                        results: response
                        };
                    },
                    cache: true
                    }
            
                });

                $.ajax({
                    url:'{{ route("diklat.diklat_tot") }}',
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        document.getElementById('cb').innerHTML = data;
                        console.log(data);
                    }
                });

                $('#datatable-buttons').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url:'{{ route("diklat.diklat_data") }}',
                },
                columns: [
                    
                    {
                    data:'name',
                    name:'name'
                    },
                    
                ]
                });
            })
            
        </script>
@endsection