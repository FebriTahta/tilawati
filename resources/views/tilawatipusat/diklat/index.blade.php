@extends('layouts.tilawatipusat_layouts.master')

@section('title') diklat @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('tilawatipusat/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="{{URL::asset('tilawatipusat/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('tilawatipusat/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('tilawatipusat/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('tilawatipusat/libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />


@endsection
@section('content')

    @component('common-tilawatipusat.breadcrumb')
         @slot('title') diklat   @endslot
         @slot('title_li') TILAWATI   @endslot
    @endcomponent
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="card">
                                <div class="row p-3">
                                    <div class="col-6 col-xl-4 form-group">
                                        <label>Dari :</label>
                                        <input type="date" name="dari" id="dari" class="form-control">
                                        <span class="red dari" style="color: red"></span>
                                    </div>
                                    <div class="col-6 col-xl-4 form-group">
                                        <label>Sampai :</label>
                                        <input type="date" name="sampai" id="sampai" class="form-control">
                                        <span class="red sampai" style="color: red"></span>
                                    </div>
                                    <div class="form-group col-6 col-xl-2">
                                        <label for="">Cari :</label>
                                        <button class="btn btn-rounded form-control text-white" style="background-color: rgb(137, 137, 253)" name="filter" id="filter"> <i
                                                class="fa fa-search"></i></button>
                                    </div>
                                    <div class="form-group col-6 col-xl-2">
                                        <label for="">Reset :</label>
                                        <button class="btn btn-rounded btn-danger form-control" name="refresh" id="refresh"> <i
                                                class="fa fa-stop"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (auth()->user()->role == 'pusat')
                            <div class="col-xl-4">
                                @component('common-tilawatipusat.dashboard-widget')
                                
                                    @slot('title') <b id="cb"> ??? </b><br><small> Total Diklat  </small>@endslot
                                    @slot('iconClass') mdi mdi-home-analytics  @endslot
                                    @slot('price')   @endslot
                                    
                                @endcomponent
                            </div>
                            
                            <div class="col-xl-4">
                                @component('common-tilawatipusat.dashboard-widget')
                                
                                    @slot('title') <a href="#" data-toggle="modal" data-target="#mod_cabang2"> <b id="cb2"> ??? </b><br><small> Cabang Pelaksana</small></a>@endslot
                                    @slot('iconClass') mdi mdi-bank-outline  @endslot
                                    @slot('price')   @endslot
                                    
                                @endcomponent
                            </div>

                            <div class="col-xl-4">
                                @component('common-tilawatipusat.dashboard-widget')
                                
                                    @slot('title') <a href="#" data-toggle="modal" data-target="#mod_program"> <b id="cb3"> ??? </b><br><small> Program Diklat</small></a>@endslot
                                    @slot('iconClass') fa fa-book  @endslot
                                    @slot('price')   @endslot
                                    
                                @endcomponent
                            </div>
                        @else
                            <div class="col-xl-4">
                                @component('common-tilawatipusat.dashboard-widget')
                                
                                    @slot('title') <b id="cb"> ??? </b><br><small> Total Diklat  </small>@endslot
                                    @slot('iconClass') mdi mdi-home-analytics  @endslot
                                    @slot('price')   @endslot
                                    
                                @endcomponent
                            </div>
                            <div class="col-xl-4">
                                @component('common-tilawatipusat.dashboard-widget')
                                
                                    @slot('title') <a href="#" data-toggle="modal" data-target="#mod_program"> <b id="cb3"> ??? </b><br><small> Program Diklat</small></a>@endslot
                                    @slot('iconClass') fa fa-book  @endslot
                                    @slot('price')   @endslot
                                    
                                @endcomponent
                            </div>
                            <div class="col-xl-4">
                                @component('common-tilawatipusat.dashboard-widget')
                                
                                    @slot('title')  <b id="cb4"> ??? </b> <br><small> Peserta</small>@endslot
                                    @slot('iconClass') fa fa-user  @endslot
                                    @slot('price')   @endslot
                                    
                                @endcomponent
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                    
                                    <h4 class="card-title">Data Diklat</h4>
                                    <p class="card-title-desc">Ter-update berdasarkan Tahun 2021 </br></p>
                                    {{-- <button class="btn btn-sm btn-success  mr-1" style="width:130px " data-toggle="modal" data-target=".bs-example-modal-diklat"><i class="mdi mdi-plus"></i> tambah diklat</button> --}}
                                    <a class="btn btn-sm btn-success  mr-1" style="width:130px " href="{{ route('diklat.create') }}"><i class="mdi mdi-plus"></i> tambah diklat</a>
                                    <input type="hidden" id="user" value="{{auth()->user()->role}}">
                                    @if (auth()->user()->role == 'cabang')
                                        <input type="hidden" id="cabang" value="{{auth()->user()->cabang->id}}">
                                    @endif
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        @if (auth()->user()->role == 'pusat')
                                            <table id="datatable-buttons" class="table table-diklat table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                                <thead class="text-bold text-primary" style="text-transform: capitalize; font-size: 12px">
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Cabang</th>
                                                        <th>Tanggal</th>
                                                        <th>Jenis Program</th>
                                                        <th>Peserta</th>
                                                        <th>Tempat</th>
                                                        <th>Link WA</th>
                                                        <th>Flyer</th>
                                                        <th>Registeasi</th>
                                                        <th>Option</th>
                                                    </tr>
                                                </thead>
        
                                                <tbody style="text-transform: uppercase; font-size: 10px">
                                                </tbody>

                                                <tfoot class="text-primary" style="text-transform: capitalize; font-size: 12px">
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Cabang</th>
                                                        <th>Tanggal</th>
                                                        <th>Jenis Program</th>                                                    
                                                        <th>Peserta</th>
                                                        <th>Tempat</th>
                                                        <th>Link WA</th>
                                                        <th>Flyer</th>
                                                        <th>Registeasi</th>
                                                        <th>Option</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        @else
                                            <table id="datatable-buttons" class="table table-diklat table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                                <thead class="text-bold text-primary" style="text-transform: capitalize; font-size: 12px">
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Cabang</th>
                                                        <th>Tanggal</th>
                                                        <th>Jenis Program</th>
                                                        <th>Peserta</th>
                                                        <th>Tempat</th>
                                                        {{-- <th>Link WA</th>
                                                        <th>Flyer</th>
                                                        <th>Registeasi</th> --}}
                                                        <th>Option</th>
                                                    </tr>
                                                </thead>
        
                                                <tbody style="text-transform: uppercase; font-size: 10px">
                                                </tbody>

                                                <tfoot class="text-primary" style="text-transform: capitalize; font-size: 12px">
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Cabang</th>
                                                        <th>Tanggal</th>
                                                        <th>Jenis Program</th>                                                    
                                                        <th>Peserta</th>
                                                        <th>Tempat</th>
                                                        {{-- <th>Link WA</th>
                                                        <th>Flyer</th>
                                                        <th>Registeasi</th> --}}
                                                        <th>Option</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        @endif
                                        
                                        <footer class="blockquote-footer">Updated at  <cite title="Source Title">{{date('Y')}}</cite></footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade bs-example-modal-diklat-kirim" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="card" style="text-align: center">
                                            <div class="card-header" style="margin-bottom: 10px">
                                                <div class="form-group text-center">
                                                    <h5>CETAK INFORMASI SURAT PENGIRIMAN</h5>
                                                </div>
                                            </div>
                                            <form action="/diklat-cetak-surat-pengiriman"  method="POST" enctype="multipart/form-data">@csrf
                                                <div class="row" >
                                                    <input type="hidden" style="border: none" class="form-control text-capitalize" id="id" name="id" required>
                                                    <div class="form-group col-6 col-xl-6">
                                                        <input type="submit" name="cetak_surat" id="btncetak" class="btn btn-success" value="Ya, Cetak!" />
                                                    </div>
                                                    <div class="form-group col-6 col-xl-6">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                            No, Cancel!
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>

                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade bs-example-modal-diklat-hapus" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="hapusdiklat"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group text-center">
                                                                <h5>Anda yakin akan menghapus Diklat tersebut ?</h5>
                                                                <input type="hidden" class="form-control text-capitalize" id="id" name="id" required>
                                                            </div>
                                                            <div class="row" style="text-align: center">
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <input type="submit" name="hapus" id="btnhapus" class="btn btn-danger" value="Ya, Hapus!" />
                                                                </div>
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                        No, Cancel!
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div><!-- container fluid -->
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>

                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade" id="modal-wa" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="diklat_store2"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group text-center">
                                                                <h5>Tambahkan Link Group WhatsApp!</h5>
                                                                <input type="hidden" class="form-control text-capitalize" id="id" name="id" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <textarea name="groupwa" class="form-control" id="groupwa" cols="30" rows="2" required></textarea>
                                                            </div>
                                                            <div class="form-group text-right">
                                                                <input type="submit" id="submitwa" class="btn btn-sm text-white" style="background-color: rgb(84, 198, 236)" value="Submit!">
                                                            </div>
                                                        </form>
                                                    </div><!-- container fluid -->
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>

                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade" id="modal-flyer" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body text-danger">
                                        <div class="sec-title centered">
                                            <div class="title"></div>
                                            <div class="separate"></div>
                                        </div>
                                        <form id="diklat_store3" class="was-validate" enctype="multipart/form-data">@csrf
                                            <div class="card">
                                                <div class="card-body">
                                                    <input type="hidden" id="id" name="id">
                                                    <input type="hidden" id="flyerid" name="flyerid">
                                                    <h4 class="card-title">Flyer Diklat</h4>
                                                    <p class="card-title-desc">Tambahkan / ubah flyer diklat untuk e-registrasi dibawah Ini</p>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="inputGroupFile02" accept="image/*" name="image" required/>
                                                            <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <input class="btn btn-primary" type="submit" id="btnimage" value="Submit Image!">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <img  src=""  id="preview" class="img-thumbnail">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.modal -->
                    </div>

                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade modal-scan" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0">SCAN QR CODE DIKLAT </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid text-center">
                                                        <img src="" alt="qr-code" id="qr-code" width="150px" height="150px">
                                                        <div class="text-center text-uppercase" style="margin-top: 10px">
                                                            <p class="text-info" id="nama_peserta"></p>
                                                        </div>
                                                    </div><!-- container fluid -->
                                                    <div class="form-group" style="text-align: center">
                                                        <form id="generate" method="POST">@csrf
                                                            <input type="hidden" name="slug" id="qr_slug" class="form-control" required>
                                                            <input style="width: 150px" type="submit" id="btngenerate" class="btn btn-sm btn-outline-primary" value="Generate QR">
                                                        </form>
                                                        <form target="_blank" action="/download_qr" method="POST"> @csrf
                                                            <input type="hidden" name="slug2" id="qr_slug2" class="form-control" required>
                                                            <button style="width: 150px; margin-top: 10px" type="submit" class="btn btn-sm btn-outline-info">Download</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>

                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade" id="modal-download" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="" action="/export-peserta-pendaftaran"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group text-center">
                                                                <h5>Mengunduh Daftar Peserta Pendaftaran ?</h5>
                                                                <input type="hidden" class="form-control text-capitalize" id="id" name="id" required>
                                                            </div>
                                                            <div class="row" style="text-align: center">
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <input type="submit" id="btndownload" class="btn btn-primary" value="Ya, Unduh!" />
                                                                </div>
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                        No, Cancel!
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div><!-- container fluid -->
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>

                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade" id="modal-download2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        <form id="" action="/diklat-cetak-surat-pengiriman"  method="POST" enctype="multipart/form-data">@csrf
                                                            <div class="form-group text-center">
                                                                <h5>Cetak Surat Pengiriman ?</h5>
                                                                <input type="hidden" class="form-control text-capitalize" id="id" name="id" required>
                                                            </div>
                                                            <div class="row" style="text-align: center">
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <input type="submit" id="btndownload" class="btn btn-primary" value="Ya, Unduh!" />
                                                                </div>
                                                                <div class="form-group col-6 col-xl-6">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                        No, Cancel!
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div><!-- container fluid -->
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                    
                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade bs-example-modal-diklat-edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <form id="diklat_store" class="text-capitalize"  method="POST" enctype="multipart/form-data">@csrf
                                                        <input type="hidden" id="id_edit" name="id" value="" required>
                                                        <div class="row">
                                                            <div class="col-md-6 col-12 form-group">
                                                                <label for="">tanggal</label>
                                                                <input type="date" id="tanggal_edit" name="tanggal" class="form-control text-capitalize" required>
                                                            </div>
                                                            {{-- <div class="col-md-6 col-12 form-group">
                                                                <label for="">sampai tanggal</label>
                                                                <small>(boleh kosong bila 1 hari)</small>
                                                                <input type="date" id="sampai_tanggal" name="sampai" class="form-control text-capitalize" >
                                                            </div> --}}
                                                            @if (auth()->user()->role == 'cabang')
                                                                <input type="hidden" name="cabang_id" value="{{auth()->user()->cabang->id}}">
                                                                @else
                                                                <div class="col-md-6 col-12 form-group">
                                                                    <label for="">cabang</label>
                                                                    <?php $cb = App\Models\Cabang::with('kabupaten')->get();?>
                                                                    <select name="cabang_id" id="cabang_edit" class="form-control text-capitalize" required>
                                                                        @foreach ($cb as $item)
                                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @endif
                                                            
                                                            <div class="col-md-6 col-12 form-group">
                                                                <label for="">program</label>
                                                                <select name="program_id" id="program_edit" class="form-control text-capitalize" required>
                                                                    @foreach ($dt_program as $item)
                                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @if (auth()->user()->role == 'pusat')
                                                            <div class="col-md-6 col-12 form-group">
                                                                <label for="">groupwa</label>
                                                                <textarea name="groupwa" id="groupwa1" cols="30" rows="2" class="form-control" >{{$item->groupwa}}</textarea>
                                                            </div>
                                                            <div class="col-md-6 col-12 form-group">
                                                                <label for="">Kuota Peserta (Online) </label>
                                                                <input type="number" class="form-control" name="max" id="max_peserta">
                                                            </div>
                                                            @endif
                                                            <input type="hidden" name="jenis" value="diklat" >
                                                            <div class="col-md-6 col-12 form-group">
                                                                <label for="">tempat pelaksanaan</label>
                                                                <textarea name="tempat" class="form-control text-capitalize" id="tempat_edit" cols="30" rows="3" ></textarea>
                                                            </div>
                                                            
                                                            <div class="col-md-6 col-12 form-group">
                                                                <label for="">keterangan</label>
                                                                <select name="keterangan" id="keterangan_edit" class="form-control text-capitalize">
                                                                    <option value="guru">Guru</option>
                                                                    <option value="santri">Santri</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group text-right">
                                                            <input type="submit" id="z" class="btn btn-outline-primary" value="Update!">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>

                    <div class="col-sm-6 col-md-3 m-t-30">
                        <div class="modal fade bs-example-modal-diklat-link" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="col-xl-12">
                                            <div class="card m-b-30">
                                                <div class="card-body">
                                                    <div class="form-gorup" style="margin-bottom: 20px">
                                                        <textarea name="" id="link" cols="30" rows="2" class="form-control" disabled></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="button" onclick="myFunction()" id="btn-copy" value="salin link!" class="btn btn-sm btn-outline-primary">
                                                        <a id="bukalink" target="_blank" class="btn btn-sm btn-outline-primary text-primary"> buka link!</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>

                    <div class="modal fade bs-example-modal-xl-2" id="mod_cabang2" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">DAFTAR CABANG YANG MENGADAKAN DIKLAT</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <table id="datatable-buttons2" class="table table-diklat-cabang table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary">
                                                <tr>
                                                    <th>Cabang</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                    
                                            <tbody style="text-transform: uppercase; font-size: 12px">
                                            </tbody>
                    
                                            <tfoot class="text-bold text-primary">
                                                <tr>
                                                   <th>Cabang</th>
                                                   <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <footer class="blockquote-footer">Updated at  <cite title="Source Title">2021</cite></footer>
                                    </blockquote>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                    <div class="modal fade bs-example-modal-xl-2" id="mod_program" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">DAFTAR PROGRAM PELAKSANAAN</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <blockquote class="blockquote font-size-16 mb-0 mt-2 table-responsive">
                                        <table id="datatable-buttons3" class="table table-diklat-program table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                            <thead class="text-bold text-primary" style="text-transform: uppercase; font-size: 10px">
                                                <tr>
                                                    <th>Program</th>
                                                    @if (auth()->user()->role=='pusat')
                                                    <th>Action</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody style="text-transform: uppercase; font-size: 10px">
                                            </tbody>
                                            <tfoot class="text-bold text-primary" style="text-transform: uppercase; font-size: 10px">
                                                <tr>
                                                    <th>Program</th>
                                                    @if (auth()->user()->role=='pusat')
                                                    <th>Action</th>
                                                    @endif
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <footer class="blockquote-footer">Updated at  <cite title="Source Title">2021</cite></footer>
                                    </blockquote>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                    <div class="modal fade bs-example-modal-xl-2" id="modal_share_cabang" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">BAGIKAN KONFIRMASI DIKLAT INI UNTUK CABANG</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                
                                <div class="modal-body">
                                    <form action="{{route('submit.forward.cabang')}}" method="post"> @csrf 
                                        <div class="form-group">
                                            <input type="hidden" id="pelatihan_id" name="pelatihan_id">
                                            <select name="cabang_id[]" id="sel_cabang" style="width: 100%" class="form-control select2 multiple" required>
                                                <option value=""> PILIH CABANG</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="submit" id="btnshare" class="btn btn-primary">
                                        </div>
                                    </form>


                                    <table id="tabel_share" class="table tabel_share table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                        <thead class="text-bold text-primary" style="text-transform: uppercase; font-size: 10px">
                                            <tr>
                                                <th>Cabang</th>
                                                <th>...</th>
                                            </tr>
                                        </thead>
                
                                        <tbody style="text-transform: uppercase; font-size: 10px">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                    <div class="modal fade bs-example-modal-xl-2" id="modalsyahadah_aktif" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">TERBITKAN SYAHADAH</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <div class="modal-body">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th style="width: 30%"><span>CABANG </span></th>
                                                <th style="width: 5%"><span>:</span></th>
                                                <th style="width: 65%"><span id="nama_cabang_syahadah"></span></th>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%"><span>PROGRAM </span></th>
                                                <th style="width: 5%"><span>:</span></th>
                                                <th style="width: 65%"><span id="nama_program_syahadah"></span></th>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%"><span>LULUS </span></th>
                                                <th style="width: 5%"><span>:</span></th>
                                                <th style="width: 65%"><u><span id="peserta_lulus_syahadah"></span> </u> <span> PESERTA</span></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <form id="formterbit">@csrf
                                        <input type="hidden" class="form-control" id="id" name="id" required>
                                        <input type="submit" id="btnterbit" class="btn btn-sm btn-primary" value="TERBITKAN SYAHADAH">
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                    <div class="modal fade bs-example-modal-xl-2" id="modalsyahadah_tarik" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">TERBITKAN SYAHADAH</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <div class="modal-body">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th style="width: 30%"><span>CABANG </span></th>
                                                <th style="width: 5%"><span>:</span></th>
                                                <th style="width: 65%"><span id="nama_cabang_syahadah"></span></th>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%"><span>PROGRAM </span></th>
                                                <th style="width: 5%"><span>:</span></th>
                                                <th style="width: 65%"><span id="nama_program_syahadah"></span></th>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%"><span>LULUS </span></th>
                                                <th style="width: 5%"><span>:</span></th>
                                                <th style="width: 65%"><u><span id="peserta_lulus_syahadah"></span> </u> <span> PESERTA</span></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <form id="formtarik">@csrf
                                        <input type="hidden" class="form-control" id="id" name="id" required>
                                        <input type="submit" id="btntarik" class="btn btn-sm btn-danger" value="TARIK SYAHADAH">
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    
<input type="text" value="{{auth()->user()->role}}" style="display: none">
@endsection

@section('script')

        <!-- Script Select2-->
        <script src="{{URL::asset('/tilawatipusat/libs/select2/select2.min.js')}}"></script>
        <script src="{{URL::asset('/tilawatipusat/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{URL::asset('/tilawatipusat/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
        <script src="{{URL::asset('/tilawatipusat/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
        <script src="{{URL::asset('/tilawatipusat/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

        <!-- form advanced init -->
        <script src="{{URL::asset('/tilawatipusat/js/pages/form-advanced.init.js')}}"></script>

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
            $('#formshare').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "submit-forward-cabang",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnshare').attr('disabled','disabled');
                    $('#btnshare').val('Proses Menyimpan Data');
                },
                success: function(data){
                    //sweetalert and redirect
                    $("#formshare")[0].reset();
                        toastr.success(data.success);
                        $('#btnshare').val('Buat Baru');
                        $('#btnshare').attr('disabled',false);
                        swal({ title: "Success!",
                            text: "Diklat Baru Berhasil Dibuat!",
                            type: "success"});
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

            $('#formterbit').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "/terbitkan-syahadah",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnterbit').attr('disabled','disabled');
                    $('#btnterbit').val('Proses Menerbitkan Syahadah');
                },
                success: function(data){
                    //sweetalert and redirect
                        toastr.success(data.message);
                        $('#btnterbit').val('TERBITKAN SYAHADAH');
                        $('#btnterbit').attr('disabled',false);
                        $('#modalsyahadah_aktif').modal('hide');
                        swal({ title: "Success!",
                            text: data.message,
                            type: "success"
                        });
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

            $('#formtarik').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "/tarik-syahadah",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btntarik').attr('disabled','disabled');
                    $('#btntarik').val('Proses Menerbitkan Syahadah');
                },
                success: function(data){
                    //sweetalert and redirect
                        toastr.success(data.message);
                        $('#btntarik').val('TERBITKAN SYAHADAH');
                        $('#btntarik').attr('disabled',false);
                        $('#modalsyahadah_tarik').modal('hide');
                        swal({ title: "Success!",
                            text: data.message,
                            type: "warning"
                        });
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

            $('#sel_cabang').select2('destroy').select2({
                    placeholder: 'Select an item',
                    ajax: {
                        url: "{{route('diklat.diklat_cabang_select')}}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.kode,
                                    text: item.name,
                                    id: item.id   
                                }
                            })
                        };
                        },
                        cache: true
                    }
                });

            $('.modal-scan').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var nama_peserta = button.data('nama_diklat')
                var slug  = button.data('slug')
                var modal = $(this)
                $('#nama_peserta').html(nama_peserta);
                $('#qr_slug').val(slug);
                $('#qr_slug2').val(slug);
                console.log(slug);
                document.getElementById("qr-code").src = id;
            })

            $('#modal_share_cabang').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var pelatihan_id = button.data('id')
                var modal = $(this)
                $('#pelatihan_id').val(pelatihan_id);
                console.log(pelatihan_id);
                $('.tabel_share').DataTable({
                            //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                            searching:false,info:false,
                            destroy: true,
                            processing: true,
                            serverSide: true,
                            ajax: {
                                url:'/data_forward_konfirm_cabang/'+pelatihan_id,
                            },
                            columns: [
                                {
                                data:'cabang',
                                name:'cabang.name'
                                },
                                {
                                data:'action',
                                name:'action'
                                },
                                
                            ]
                        });
            })

            $('#inputGroupFile02').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            });
            $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {   
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });
        </script>
        <script>
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#generate').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('generate_qr')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btngenerate').attr('disabled','disabled');
                    $('#btngenerate').val('Proses Generate QR');
                },
                success: function(data){
                    if(data.success)
                    {
                        //sweetalert and redirect
                        toastr.success(data.success);
                        $('.modal-scan').modal('hide');
                        $('#btngenerate').val('Generate');
                        $('#btngenerate').attr('disabled',false);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        swal({ title: "Success!",
                            text: "QR Berhasil Dibuat!",
                            type: "success"})
                    }
                    if(data.error)
                    {
                        $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
                        $('#z').attr('disabled',false);
                        $('#z').val('Import');
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

            $('#diklat_store').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.store')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#z').attr('disabled','disabled');
                    $('#z').val('Proses Menyimpan Data');
                },
                success: function(data){
                    if(data.success)
                    {
                        //sweetalert and redirect
                        $("#diklat_store")[0].reset();
                        toastr.success(data.success);
                        $('.bs-example-modal-diklat-edit').modal('hide');
                        $('#z').val('Update');
                        $('#z').attr('disabled',false);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        swal({ title: "Success!",
                            text: "Diklat Baru Berhasil Diperbarui!",
                            type: "success"})
                    }
                    if(data.error)
                    {
                        $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
                        $('#z').attr('disabled',false);
                        $('#z').val('Import');
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

            $('#diklat_store2').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.storeeditwa')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#submitwa').attr('disabled','disabled');
                    $('#submitwa').val('Proses Menyimpan Data');
                },
                success: function(data){
                    if(data.success)
                    {
                        //sweetalert and redirect
                        $("#diklat_store2")[0].reset();
                        toastr.success(data.success);
                        $('#modal-wa').modal('hide');
                        $('#submitwa').val('Update');
                        $('#submitwa').attr('disabled',false);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                    }
                    if(data.error)
                    {
                        $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
                        $('#z').attr('disabled',false);
                        $('#z').val('Import');
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

            $('#diklat_store3').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.storeflyer')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnimage').attr('disabled','disabled');
                    $('#btnimage').val('Proses Menyimpan Data');
                },
                success: function(data){
                    if(data.success)
                    {
                        //sweetalert and redirect
                        $("#diklat_store3")[0].reset();
                        toastr.success(data.success);
                        $('#modal-flyer').modal('hide');
                        $('#btnimage').val('Submit!');
                        $('#btnimage').attr('disabled',false);
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                    }
                    if(data.error)
                    {
                        $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
                        $('#z').attr('disabled',false);
                        $('#z').val('Import');
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });

            $('.bs-example-modal-diklat-kirim').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
            })

            $('#modal-wa').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var linkwa = button.data('link')
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #groupwa').val(linkwa);
                modal.find('.modal-body #id').val(id);
                console.log(linkwa);
            })

            $('#modalsyahadah_aktif').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var nama_cabang_syahadah = button.data('nama_cabang_syahadah')
                var nama_program_syahadah = button.data('nama_program_syahadah')
                var peserta_lulus_syahadah = button.data('peserta_lulus_syahadah')
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #nama_cabang_syahadah').html(nama_cabang_syahadah);
                modal.find('.modal-body #nama_program_syahadah').html(nama_program_syahadah);
                modal.find('.modal-body #peserta_lulus_syahadah').html(peserta_lulus_syahadah);
                modal.find('.modal-footer #id').val(id);
            })

            $('#modalsyahadah_tarik').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var nama_cabang_syahadah = button.data('nama_cabang_syahadah')
                var nama_program_syahadah = button.data('nama_program_syahadah')
                var peserta_lulus_syahadah = button.data('peserta_lulus_syahadah')
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #nama_cabang_syahadah').html(nama_cabang_syahadah);
                modal.find('.modal-body #nama_program_syahadah').html(nama_program_syahadah);
                modal.find('.modal-body #peserta_lulus_syahadah').html(peserta_lulus_syahadah);
                modal.find('.modal-footer #id').val(id);
            })

            $('#modal-flyer').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var img = button.data('img')
                var flyerid = button.data('flyerid')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #flyerid').val(flyerid);
                // modal.find('.modal-body #preview').src(img);
                document.getElementById("preview").src = img;
            })

            $('.bs-example-modal-diklat-hapus').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
            })
            $('.bs-example-modal-diklat-link').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var slug = button.data('slug')
                var modal = $(this)
                modal.find('.modal-body #link').val(slug);
                // modal.find('.modal-body #bukalink').attr(slug);
                var a = document.getElementById("bukalink");
                a.href = slug;
            })
            function myFunction() {
                /* Get the text field */
                var copyText = document.getElementById("link");

                /* Select the text field */
                copyText.select();
                copyText.setSelectionRange(0, 99999); /* For mobile devices */

                /* Copy the text inside the text field */
                navigator.clipboard.writeText(copyText.value);
                
                /* Alert the copied text */
                alert("Copied the text: " + copyText.value);
            }
            
            $('.bs-example-modal-diklat-edit').on('show.bs.modal', function(event) {
                var button  = $(event.relatedTarget)
                var id      = button.data('id')
                var tempat  = button.data('tempat')
                var keterangan = button.data('keterangan')
                var tanggal = button.data('tanggal')
                var program_id = button.data('program')
                var cabang_id = button.data('cabang')
                var groupwa = button.data('groupwa')
                var sampai_tanggal = button.data('sampai_tanggal')
                var max = button.data('max')
                var modal   = $(this)
                modal.find('.modal-body #id_edit').val(id);
                modal.find('.modal-body #tempat_edit').val(tempat);
                modal.find('.modal-body #keterangan_edit').val(keterangan);
                modal.find('.modal-body #tanggal_edit').val(tanggal);
                modal.find('.modal-body #program_edit').val(program_id);
                modal.find('.modal-body #cabang_edit').val(cabang_id);
                modal.find('.modal-body #groupwa1').val(groupwa);
                modal.find('.modal-body #sampai_tanggal').val(sampai_tanggal);
                modal.find('.modal-body #max_peserta').val(max);
            })

            $('#modal-download').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
            })

            $('#modal-download2').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
            })

            $('#hapusdiklat').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type:'POST',
                url: "{{ route('diklat.delete')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#btnhapus').attr('disabled','disabled');
                    $('#btnhapus').val('Proses Hapus Data');
                },
                success: function(data){
                    if(data.success)
                    {
                        //sweetalert and redirect
                        var oTable = $('#datatable-buttons').dataTable();
                        oTable.fnDraw(false);
                        toastr.success(data.success);
                        $('#btnhapus').val('Ya, Hapus!');
                        $('.bs-example-modal-diklat-hapus').modal('hide');
                        $('#btnhapus').attr('disabled',false);
                        // swal({ title: "Success!",
                        //     text: "Diklat Berhasil Di Dihapus!",
                        //     type: "success"})
                        $.ajax({
                            url:'{{ route("diklat.diklat_tot") }}',
                            type: 'get',
                            dataType: 'json',
                            data:{dari:dari, sampai:sampai},
                            success:function(data) {
                                document.getElementById('cb').innerHTML = data;
                                console.log(data);
                            }
                        });
                        $.ajax({
                                url:'{{ route("diklat.diklat_program_tot") }}',
                                type: 'get',
                                dataType: 'json',
                                data:{dari:dari, sampai:sampai},
                                success:function(data) {
                                    document.getElementById('cb3').innerHTML = data;
                                    console.log(data);
                                }
                            });
                        $.ajax({
                            url:'{{ route("diklat.diklat_cabang_tot") }}',
                            type: 'get',
                            dataType: 'json',
                            data:{dari:dari, sampai:sampai},
                            success:function(data) {
                                document.getElementById('cb2').innerHTML = data;
                                console.log(data);
                            }
                        });
                    }
                },
                error: function(data)
                {
                    console.log(data);
                    }
                });
            });
            
            $(document).ready(function(){
                //ready load data
                load_data();

                function load_data(dari = '', sampai = '')
                {
                    //pilih cabang
                    $('#sel_cabang').select2('destroy').select2({
                        placeholder: 'Select an item',
                        ajax: {
                            url: "{{route('diklat.diklat_cabang_select')}}",
                            dataType: 'json',
                            delay: 250,
                            processResults: function (data) {
                            return {
                                results:  $.map(data, function (item) {
                                    return {
                                        text: item.kode,
                                        text: item.name,
                                        id: item.id   
                                    }
                                })
                            };
                            },
                            cache: true
                        }
                    });

                    //total diklat dan cabang yang mengadakan diklat
                    
                    var user    = $('#user').val();
                    var cabang  = $('#cabang').val();
                    if (user == 'pusat') {
                        //keterangan cabang mengadakan diklat
                        $('.table-diklat-program').DataTable({
                        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                            destroy: true,
                            processing: true,
                            serverSide: true,
                            ajax: {
                                url:'{{ route("diklat.diklat_program_data") }}',
                                data:{dari:dari, sampai:sampai}
                            },
                            columns: [
                                {
                                data:'program',
                                name:'program.name'
                                },
                                {
                                data:'action',
                                name:'action'
                                },
                                
                            ]
                        });

                        $('.table-diklat-program').DataTable({
                        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                            destroy: true,
                            processing: true,
                            serverSide: true,
                            ajax: {
                                url:'{{ route("diklat.diklat_program_data") }}',
                                data:{dari:dari, sampai:sampai}
                            },
                            columns: [
                                {
                                data:'program',
                                name:'program.name'
                                },
                                {
                                data:'action',
                                name:'action'
                                },
                                
                            ]
                        });
                        
                        $.ajax({
                            url:'{{ route("diklat.diklat_tot") }}',
                            type: 'get',
                            dataType: 'json',
                            data:{dari:dari, sampai:sampai},
                            success:function(data) {
                                document.getElementById('cb').innerHTML = data;
                                console.log(data);
                            }
                        });
                        $.ajax({
                                url:'{{ route("diklat.diklat_program_tot") }}',
                                type: 'get',
                                dataType: 'json',
                                data:{dari:dari, sampai:sampai},
                                success:function(data) {
                                    document.getElementById('cb3').innerHTML = data;
                                    console.log(data);
                                }
                            });
                        $.ajax({
                            url:'{{ route("diklat.diklat_cabang_tot") }}',
                            type: 'get',
                            dataType: 'json',
                            data:{dari:dari, sampai:sampai},
                            success:function(data) {
                                document.getElementById('cb2').innerHTML = data;
                                console.log(data);
                            }
                        });
                        //data diklat
                        $('.table-diklat').DataTable({
                            //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                            destroy: true,
                            processing: true,
                            serverSide: true,
                            ajax: {
                                url:'{{ route("diklat.diklat_data") }}',
                                data:{dari:dari, sampai:sampai}
                            },
                            columns: [
                                {
                                data:'id',
                                name:'id'
                                },
                                {
                                data:'cabang',
                                name:'cabang.name'
                                },
                                {
                                data:'tanggal',
                                name:'tanggal'
                                },
                                {
                                data:'program',
                                name:'program.name'
                                },
                                {
                                data:'peserta',
                                name:'peserta'
                                },
                                {
                                data:'tempat_diklat',
                                name:'tempat'
                                },
                                {
                                data:'groupwa',
                                name:'groupwa'
                                },
                                {
                                data:'flyer',
                                name:'flyer'
                                },
                                {
                                data:'linkpendaftaran',
                                name:'linkpendaftaran'
                                },
                                {
                                data:'action',
                                name:'action'
                                },
                                
                            ]
                        });
                    }else{
                        
                        $('.table-diklat-program').DataTable({
                        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                            destroy: true,
                            processing: true,
                            serverSide: true,
                            ajax: {
                                url:'/diklat-diklat-program-cabang/' +cabang,
                                data:{dari:dari, sampai:sampai}
                            },
                            columns: [
                                {
                                data:'program',
                                name:'program.name'
                                },
                                
                            ]
                        });
                        
                        // data diklat cabang
                        $.ajax({
                            url:'/diklat-diklat-total-diklat-cabang/'+cabang,
                            type: 'get',
                            dataType: 'json',
                            data:{dari:dari, sampai:sampai},
                            success:function(data) {
                                document.getElementById('cb').innerHTML = data;
                                console.log(data);
                            }
                        });
                        $.ajax({
                                url:'/diklat-diklat-total-program-cabang/'+cabang,
                                type: 'get',
                                dataType: 'json',
                                data:{dari:dari, sampai:sampai},
                                success:function(data) {
                                    document.getElementById('cb3').innerHTML = data;
                                    console.log(data);
                                }
                            });

                            $.ajax({
                                url:'/diklat-diklat-total-peserta-cabang/'+cabang,
                                type: 'get',
                                dataType: 'json',
                                data:{dari:dari, sampai:sampai},
                                success:function(data) {
                                    document.getElementById('cb4').innerHTML = data;
                                    console.log(data);
                                }
                            });

                        $('.table-diklat').DataTable({
                            //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                            destroy: true,
                            processing: true,
                            serverSide: true,
                            ajax: {
                                url:'/diklat-diklat-data-cabang/'+cabang,
                                data:{dari:dari, sampai:sampai}
                            },
                            columns: [
                                {
                                data:'id',
                                name:'id'
                                },
                                {
                                data:'cabang',
                                name:'cabang.name'
                                },
                                {
                                data:'tanggal',
                                name:'tanggal'
                                },
                                {
                                data:'program',
                                name:'program.name'
                                },
                                {
                                data:'peserta',
                                name:'peserta'
                                },
                                {
                                data:'tempat',
                                name:'tempat'
                                },
                                // {
                                // data:'groupwa',
                                // name:'groupwa'
                                // },
                                // {
                                // data:'flyer',
                                // name:'flyer'
                                // },
                                // {
                                // data:'linkpendaftaran',
                                // name:'linkpendaftaran'
                                // },
                                {
                                data:'action',
                                name:'action'
                                },
                                
                            ]
                        });
                    }

                    $('.table-diklat-cabang').DataTable({
                        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                        destroy: true,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url:'{{ route("diklat.diklat_cabang_data") }}',
                            data:{dari:dari, sampai:sampai}
                        },
                        columns: [
                            {
                            data:'cabang',
                            name:'cabang.name'
                            },
                            {
                            data:'action',
                            name:'action'
                            },
                            
                        ]
                    });
                }
                $('#filter').click(function(){
                    var dari = $('#dari').val();
                    var sampai = $('#sampai').val();
                    if(dari != '' &&  sampai != '')
                    {
                        load_data(dari, sampai);
                    }
                    else
                    {
                        alert('Both Date is required');
                    }
                });

                $('#refresh').click(function(){
                    $('#dari').val('');
                    $('#sampai').val('');
                    load_data();
                });
            });

            $('#program_edit').on('change', function () {
                var val = this.value;
                if (val == 1) {
                    $('#keterangan_edit').val('santri');
                }else if(val == 2 || val == 3){
                    $('#keterangan_edit').val('guru');
                }else if(val == ""){
                    $('#keterangan_edit').val('');
                }
                
            })
            
        </script>
@endsection