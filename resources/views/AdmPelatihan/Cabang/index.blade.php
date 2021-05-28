@extends('layouts.adm.master')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="float-right page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Diklat</a></li>
                <li class="breadcrumb-item active">Cabang</li>
                <li class="breadcrumb-item active" id="clock"></li>
            </ol>
        </div>
        {{-- <h5 class="page-title">Cabang</h5> --}}
    </div>
</div>
<!-- end row -->

<div class="row">
    <!--flash massage-->
    @include('layouts.sess.flash_message')
    <!--flash massage-->
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
                <a href="{{route('cabang.create')}}" type="button" class="btn btn-primary waves-effect waves-light m-t-20" style="min-width: 100px"><i class="fa fa-plus"></i> Cabang</a>
            </div>
            @endif
        </div>
    </div>
    <div class="col-xl-10">
        <div class="card m-b-30 m-t-10">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">                      
                            <table id="datatable" class="table datas table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="mt-100">
                                <tr>
                                    <th>Nama Cabang</th>
                                    <th>Kepala Cabang</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten</th>
                                    <th>Kecamatan</th>
                                    <th>Kelurahan</th>
                                    <th>Alamat</th>
                                    <th>Telephone</th>
                                    <th>Email</th>
                                    <th>Teritorial</th>
                                    <th>Kode Pos</th>
                                    <th>Alamat Ekspedisi</th>
                                    <th>Total Lembaga Yang Dinaungi </th>
                                    <th class="text-center">Opsi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $item=auth()->user() ?>
                                    @if ( $item->role == "cabang")
                                        <tr>
                                            <td>{{ $item->cabang->name }}</td>
                                            <td>{{ $item->cabang->kepala->name }}</td>
                                            <td>{{ $item->cabang->provinsi->nama }}</td>
                                            <td>{{ $item->cabang->kabupaten->nama }}</td>
                                            <td>{{ $item->cabang->kecamatan->nama }}</td>
                                            <td>{{ $item->cabang->kelurahan->nama }}</td>
                                            <td>{{ $item->cabang->alamat }}</td>
                                            <td>{{ $item->cabang->telp }}</td>
                                            <td>{{ $item->cabang->user->email }}</td>
                                            <td>{{ $item->cabang->teritorial }}</td>
                                            <td>{{ $item->cabang->pos }}</td>
                                            <td>{{ $item->cabang->ekspedisi }} lembaga</td>
                                            
                                            <td class="text-center">
                                                <button type="button" data-id="{{ $item->cabang->id }}" data-name="{{ $item->cabang->name }}" class="btn waves-effect waves-light text-white" style="background-color: rgb(134, 134, 252)" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-pencil"></i></button>
                                                <button type="button" data-id="{{ $item->cabang->id }}" data-name="{{ $item->cabang->name }}" class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-center"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($dt_cabang as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->kepala->name }}</td>
                                            <td>{{ $item->provinsi->nama }}</td>
                                            <td>{{ $item->kabupaten->nama }}</td>
                                            <td>{{ $item->kecamatan->nama }}</td>
                                            <td>{{ $item->kelurahan->nama }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->telp }}</td>
                                            <td>{{ $item->user->email }}</td>
                                            <td>{{ $item->teritorial }}</td>
                                            <td>{{ $item->pos }}</td>
                                            <td>{{ $item->ekspedisi }}</td>
                                            <td>{{ $item->lembaga->count() }} lembaga</td>
                                            <td class="text-center">
                                                <a href="{{ route('cabang.edit',$item->id) }}" type="button" class="btn waves-effect waves-light text-white" style="background-color: rgb(134, 134, 252)"><i class="fa fa-pencil"></i></a>
                                                <button type="button" data-id="{{ $item->id }}" data-name="{{ $item->name }}" class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-center"><i class="fa fa-trash"></i></button>
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

<!--  Modal content for the above example -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: cornflowerblue">
                <h5 class="modal-title mt-0 text-white" id="myLargeModalLabel">Cabang Baru</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cabang.store') }}" method="POST">@csrf
                    <p id="demo"></p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target=".bs-example-modal-center"><i class="fa fa-plus"></i> Kepala Cabang</button><br><br>
                            </div>
                            <div class="col-md-9">
                                <input type="hidden" class="form-control" id="kepala_id" name="kepala_id" value="" required>
                                <input type="text" class="form-control" value="" name="kepala" readonly id="kepalax" placeholder=" * Pilih Kepala Cabang..." data-toggle="modal" data-target=".bs-example-modal-center2">
                            </div>
                        </div>
                        {{-- <label><i class="text-danger">*</i> Nama Kepala Cabang</label> --}}
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder=" * Nama Cabang..." required>
                    </div>
                    <div class="form-group">
                        <textarea name="alamat" class="form-control" id="" cols="20" rows="3"> Alamat Lengkap Cabang...</textarea>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <select name="pro_id" class="form-control"  required>
                                    <option value=""> Provinsi </option>
                                    @foreach ($dt_props2 as $prop)
                                        <option value="{{ $prop->id }}">{{ $prop->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <select name="kab_id" id="kab_id" class="form-control" required>
                                    <option value=""> Kabupaten/Kota </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <select name="kec_id" id="kec_id" class="form-control" required>
                                    <option value=""> Kecamatan </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <select name="kel_id" id="kel_id" class="form-control" required>
                                    <option value=""> Kelurahan </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea type="text" rows="3" name="ekspedisi" class="form-control" placeholder="Alamat Ekspedisi..." >Alamat Ekspedisi... </textarea>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email..." required>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <input type="text" name="telp" class="form-control" placeholder="Telp..." >
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <input type="text" name="pos" class="form-control" placeholder="Kode Pos..." >
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <input type="text" name="teritorial" class="form-control" placeholder="teritorial..." >
                            </div>
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

<!--modal hapus-->
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(245, 106, 106)">
                <h5 class="modal-title mt-0 text-white">Hapus Cabang</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="conf text-center">
                    <p>Yakin Akan Menghapus Cabang Berikut ?</p>
                    <p class="bold text-uppercase" id="name"></p>
                </div>
                <div class="block">
                    <form action="{{ route('cabang.hapus') }}" method="POST">@csrf
                        <div class="form-group">
                            <input type="hidden" name="id" id="id">
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection
@section('script')
<script type="application/javascript">
    $('.bs-example-modal-center').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var modal = $(this)
        // modal.find('.modal-title').text('DETAIL USER');
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').text(name);
        
    })
</script>


@endsection