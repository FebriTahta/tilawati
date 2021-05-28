@extends('layouts.adm.master')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="float-right page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Diklat</a></li>
                <li class="breadcrumb-item active">Lembaga</li>
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
    <!--flash massage-->
    {{-- <div class="col-xl-12">
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
    </div> --}}
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
                <a href="{{route('lembaga.create')}}" type="button" class="btn btn-primary m-t-10 waves-effect waves-light"><i class="fa fa-plus"></i> Lembaga</a>
            </div>
            @endif
        </div>
    </div>
    {{-- <div class="col-xl-12">
        <div class=" m-b-30 bg-transparent">
            <div class="row">
                <div class="col-lg-4">
                    <a href="{{route('lembaga.create')}}" type="button" class="btn btn-primary waves-effect waves-light"><i class="fa fa-plus"></i> Tamabah Lembaga Baru</a>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="col-xl-10">
        <div class="card m-b-30">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">                          
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="mt-100 text-capitalize">
                                <tr>
                                    <th>Nama Lembaga</th>
                                    <th>Asal Cabang</th>
                                    <th>Kelembagaan</th>
                                    <th>Kepala Lembaga</th>
                                    <th>Jenjang</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten/Kota</th>
                                    <th>Telp</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                    <th>Tahun Berdiri</th>
                                    <th>Tahun Masuk</th>
                                    <th class="text-center">...</th>
                                </tr>
                                </thead>
                                <tbody class="text-capitalize">
                                    @if (auth()->user()->role=='cabang')
                                        @foreach (auth()->user()->cabang->lembaga as $item)
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @if ($item->kepala==null)
                                                    kosong
                                                @else
                                                    {{ $item->kepala->name}}
                                                @endif
                                            </td>
                                            <td>{{ $item->jenjang->name }}</td>
                                            <td style="width: 20%">{{ $item->alamat }}</td>
                                            <td>{{ $item->kabupaten->nama }}</td>
                                            <td>{{ $item->provinsi->nama }}</td>
                                            <td>{{ $item->telp }}</td>
                                            <td>
                                                @if ($item->status==1)
                                                    Aktif</p>
                                                @else
                                                    Non Aktif</p>
                                                @endif
                                            </td>
                                            <td>{{ $item->tglmasuk }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm text-white" style="background-color: rgb(151, 151, 255)"> <i class="fa fa-pencil"></i></button>
                                                <button class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></button>
                                            </td>
                                        @endforeach
                                    @else
                                        @foreach ($dt_l as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->cabang->name }}</td>
                                            <td>{{ $item->jenjang->name }}</td>
                                            <td>
                                                @if ($item->kepala == null)
                                                    kepala kosong
                                                @else
                                                {{ $item->kepala->name}}
                                                @endif
                                            </td>
                                            <td>{{ $item->jenjang->name }}</td>
                                            <td>{{ $item->provinsi->nama }}</td>
                                            <td>{{ $item->kabupaten->nama }}</td>
                                            <td>{{ $item->telp }}</td>
                                            <td style="width: 20%">{{ $item->alamat }}</td>
                                            <td>
                                                @if ($item->status==1)
                                                    Aktif</p>
                                                @else
                                                    Non Aktif</p>
                                                @endif
                                            </td>
                                            <td>{{ $item->tahunberdiri }}</td>
                                            <td>{{ $item->tahunmasuk }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm text-white" style="background-color: rgb(151, 151, 255)"> <i class="fa fa-pencil"></i></button>
                                                <button class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
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
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">UPDATE DATA LEMBAGA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('lembaga.store') }}" method="POST">@csrf
                    <div class="form-group">
                        @if (auth()->user()->role=="cabang")
                            <input type="hidden" name="cabang_id" value="{{ auth()->user()->cabang->id }}" required>
                        @else
                        <select name="cabang_id" id="" class="form-control" required>
                            <option value="">= Pilih Cabang =</option>
                            {{-- @foreach ($dt_cabang as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach --}}
                        </select>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Nama Lembaga..." required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="kepala" class="form-control" placeholder="Nama Kepala Lembaga..." >
                    </div>
                    <div class="form-group">
                        <select name="jenis_id" id="" class="form-control" required>
                            <option value="">= Jenjang Lembaga =</option>
                            {{-- @foreach ($dt_jenis as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="alamat" class="form-control" id="" cols="20" rows="10">Alamat...</textarea>
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="form-group">
                                <select name="propinsi_id" id="" class="form-control" required>
                                    <option value="">= Pilih Propinsi =</option>
                                    {{-- @foreach ($dt_props as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <select name="kota_id" id="" class="form-control" required>
                                    <option value="">= Pilih Kota =</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Kode Pos..." >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                            <div class="form-group">
                                <input type="number" name="telp" class="form-control" placeholder="Telp..." >
                            </div>
                        </div>
                        <div class="col-6 form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email Lembaga..." required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="number" name="pengelola" class="form-control" placeholder="Pengelola..." >
                    </div>
                    <div class="row">
                        <div class="col-4 form-group">
                            <input type="number" class="form-control" name="totguru" placeholder="Total Guru" >
                        </div>
                        <div class="col-4 form-group">
                            <input type="number" class="form-control" name="totsantri" placeholder="Total Santri" >
                        </div>
                        <div class="col-4 form-group">
                            <input type="text" class="form-control" name="waktubelajar" placeholder="Waktu Belajar" >
                        </div>
                        <div class="col-4 form-group">
                            <label for="">Tahun Berdiri</label>
                            <input type="date" class="form-control" name="tahunberdiri" placeholder="Tahun Berdiri" >
                        </div>
                        <div class="col-4 form-group">
                            <label for="">Tahun Masuk</label>
                            <input type="date" class="form-control" name="tglmasuk" placeholder="Tanggal Masuk" >
                        </div>
                        <div class="col-4 form-group">
                            <label for="">Keanggotaan Aktif</label>
                            <select name="keanggotaan" id="" class="form-control" required>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-primary"> <i class="fa fa-save "></i> &nbsp; Save</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection