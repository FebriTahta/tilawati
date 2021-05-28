@extends('layouts.adm.master')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="float-right page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Diklat</a></li>
                <li class="breadcrumb-item active">Teritorial</li>
                <li class="breadcrumb-item active" id="clock"></li>
            </ol>
        </div>
        {{-- <h5 class="page-title">Lembaga</h5> --}}
    </div>
</div>
<!-- end row -->

<div class="row">
    <!--flash massage-->
    @include('layouts.sess.flash_message')

    <div class="col-xl-2" style="align-content: center;text-align: center">
        <div class="m-b-20" >
            <div class="text-center bg-primary rounded p-3 m-t-10 "style="text-align: center; max-width: 100px;">
                <p class="text-white mb-0" id="bln">October</p>
                <h2 class="text-white mb-0" id="tgl"></h2>
                <p class="text-white mb-0" id="hari"></p>
            </div>
            @if (auth()->user()->role=='pusat')
            <div style="text-align: center; max-width: 100px;">
                {{-- <button type="button" class="btn btn-primary m-t-10 waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg" style="min-width: 100px"><i class="fa fa-plus"></i> Cabang</button> --}}
                <a href="#" type="button" class="btn btn-primary m-t-10 waves-effect waves-light"><i class="fa fa-plus"></i> Teritorial</a>
            </div>
            @endif
        </div>
    </div>

    <div class="col-xl-10 m-t-10">
        <div class="card" style="box-shadow: 10px;">
            <div class="card-body mini-stat m-b-30">
                <div class="table-responsive">
                    <table id="datatablex" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Teritorial</th>
                                <th>Cabang</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#datatablex').DataTable({
            //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:'{{ route("teritorial.get") }}',
            },
            columns: [
                {
                data:'name',
                name:'name'
                },
                {
                data:'cabang_id',
                name:'cabang_id'
                },
                {
                    data: 'Actions', 
                    name: 'Actions',
                    orderable:false,
                    serachable:false,
                    sClass:'text-center'
                }
            ]
            });
        });

    </script>
@endsection