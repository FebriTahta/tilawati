@extends('layouts.adm.master')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="float-right page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Pelatihan</a></li>
                <li class="breadcrumb-item active">Lembaga</li>
            </ol>
        </div>
        <h5 class="page-title">Lembaga</h5>
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
                        <p class="text-white mb-0" id="bln"></p>
                        <h2 class="text-white mb-0" id="tgl"></h2>
                        <p class="text-white mb-0" id="hari"></p>
                    </div>
                </div>
                <div class="post-details text-right">
                    <h2 class="text-muted" id="clock"></h2>
                    <h5 class="text-muted">Selamat Beraktifitas</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class=" m-b-30 bg-transparent">
            <div class="row">
                <div class="col-lg-4">
                    <a href="{{route('lembaga.create')}}" type="button" class="btn btn-primary waves-effect waves-light"><i class="fa fa-plus"></i> Tamabah Lembaga Baru</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">                          
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="mt-100">
                                <tr>
                                    <th>Lembaga</th>
                                    <th>Kepala</th>
                                    <th>Status</th>
                                    <th>Alamat</th>
                                    <th>Kota</th>
                                    <th>Propinsi</th>
                                    <th>Total Guru</th>
                                    <th>Total Santri</th>
                                    <th>Aktif</th>
                                    <th>Tgl Masuk</th>
                                    <th class="text-center">...</th>
                                </tr>
                                </thead>
                                <tbody>
                                   @foreach ($dt_lembaga as $item)
                                       <tr>
                                           <td>{{ $item->name }}</td>
                                           <td>{{ $item->kepala }}</td>
                                           <td>{{ $item->jenis->name }}</td>
                                           <td>{{ $item->alamat }}</td>
                                           <td>{{ $item->kota->name }}</td>
                                           <td>{{ $item->propinsi->name }}</td>
                                           <td>{{ $item->totguru }}</td>
                                           <td>{{ $item->totsantri }}</td>
                                           <td>
                                               @if ($item->keanggotaan==1)
                                                   <p class="text-primary"> Aktif</p>
                                               @else
                                                   <p class="text-danger">Non Aktif</p>
                                               @endif
                                           </td>
                                           <td>{{ $item->tglmasuk }}</td>
                                           <td class="text-center">
                                               <button class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></button>
                                           </td>
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