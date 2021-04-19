@extends('layouts.adm.master')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="float-right page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Pelatihan</a></li>
                <li class="breadcrumb-item active">Data Entri</li>
            </ol>
        </div>
        <h5 class="page-title">Data Entri</h5>
    </div>
</div>
<!-- end row -->

<div class="row">
    <!--flash massage-->
    @include('layouts.sess.flash_message')
    <!--flash massage-->
    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="float-left p-1 mr-3 " style="min-width: 100px">
                    <div class="text-center bg-primary rounded p-3">
                        <p class="text-white mb-0" id="bln">October</p>
                        <h2 class="text-white mb-0" id="tgl"></h2>
                        <p class="text-white mb-0" id="hari"></p>
                    </div>
                </div>
                <div class="post-details text-right">
                    <h2 class="text-muted" id="clock">jam</h2>
                    <h5 class="text-muted">Selamat Beraktifitas</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class=" m-b-30 bg-transparent">
            <div class="row">
                <div class="col-lg-4">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-center"><i class="fa fa-plus"></i> Tambah Pelatihan Baru</button>
                    {{-- <a href="{{route('cabang.create')}}" type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-center"><i class="fa fa-plus"></i> Tamabah Cabang Baru</a> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body table-responsive">                          
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="mt-100">
                                <tr>
                                    <th>#</th>
                                    <th>username</th>
                                    <th>status</th>
                                    <th>email</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($dt_usr as$key=>$item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>{{ $item->email }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
</div>
<!-- end row -->
@endsection