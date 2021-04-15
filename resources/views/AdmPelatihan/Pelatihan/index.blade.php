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
                        <div class="card-body">                          
                            <table id="" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="mt-100">
                                <tr>
                                    <th style="width: 10%">ID Program</th>
                                    <th>Cabang</th>
                                    <th>Nomer</th>
                                    <th>Tanggal</th>
                                    <th>Pelatihan</th>
                                    <th>Jenis Program</th>
                                    <th>Tempat</th>
                                    <th>Keterangan</th>
                                    <th class="text-center">...</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($dt_pel as $item)
                                    <tr>
                                        <td style="width: 10%">{{ $item->id }}</td>
                                        <td>{{ $item->cabang->name }}</td>
                                        <td>{{ $item->nomer }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->program->name }}</td>
                                        <td>{{ $item->tempat }}</td>
                                        <td>{{ $item->peserta->count() }} &nbsp; {{ $item->keterangan }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></button>
                                            <a class="btn btn-sm text-white" style="background-color: rgb(131, 131, 248)" href="/pelatihan-data-entri/{{ $item->id }}/data"><i class="fa fa-user"></i></a>
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
<!--modal-->
<div class="col-sm-6 col-md-3 m-t-30">
    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">PELATIHAN BARU</h5>
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
                                    <input type="date" name="tanggal" class="form-control" required>
                                </div>
                                <div class="form-group col-xl-6">
                                    <label for="">Cabang</label>
                                    <select name="cabang_id" id="" class="form-control" required>
                                        <option value="">= Pilih Cabang =</option>
                                        @foreach ($dt_c as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-xl-6">
                                    <input type="number" name="nomor" class="form-control" placeholder="Nomer..">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Nama Pelatihan..." required>
                            </div>
                            <div class="form-group">
                                <select name="program_id" class="form-control" id="" required>
                                    <option value="">= Pilih Program =</option>
                                    @foreach ($dt_p as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tempat</label>
                                <textarea name="tempat" class="form-control" id="" cols="30" rows=""></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <select name="keterangan" id="" class="form-control" required>
                                    <option value="">= Untuk Guru / Santri =</option>
                                    <option value="GURU">GURU</option>
                                    <option value="SANTRI">SANTRI</option>
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