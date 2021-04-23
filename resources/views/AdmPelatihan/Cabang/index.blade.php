@extends('layouts.adm.master')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="float-right page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Pelatihan</a></li>
                <li class="breadcrumb-item active">Cabang</li>
            </ol>
        </div>
        <h5 class="page-title">Cabang</h5>
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
                    @if (auth()->user()->role=='pusat')
                    <a href="{{route('cabang.create')}}" type="button" class="btn btn-primary waves-effect waves-light"><i class="fa fa-plus"></i> Tamabah Cabang Baru</a>
                    @endif
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
                                    <th>Nama Cabang</th>
                                    <th>Status</th>
                                    <th>Kepala</th>
                                    <th>Alamat</th>
                                    <th>Kota</th>
                                    <th>Propvinsi</th>
                                    <th>Telp</th>
                                    <th>Email</th>
                                    <th>KdPos</th>
                                    <th class="text-center">Opsi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if (auth()->user()->role=="cabang")
                                        <tr>
                                            <td>{{ auth()->user()->cabang->name }}</td>
                                            <td>{{ auth()->user()->cabang->status }}</td>
                                            <td>{{ auth()->user()->cabang->kepala }}</td>
                                            <td>{{ auth()->user()->cabang->alamat }}</td>
                                            <td>{{ auth()->user()->cabang->kota->name }}</td>
                                            <td>{{ auth()->user()->cabang->propinsi->name }}</td>
                                            <td>{{ auth()->user()->cabang->telp }}</td>
                                            <td>{{ auth()->user()->cabang->user->email }}</td>
                                            <td>{{ auth()->user()->cabang->pos }}</td>
                                            <td class="text-center">
                                                <button type="button" data-id="{{ auth()->user()->cabang->id }}" data-name="{{ auth()->user()->cabang->name }}" class="btn waves-effect waves-light text-white" style="background-color: rgb(134, 134, 252)"><i class="fa fa-pencil"></i></button>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($dt_cabang as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->kepala }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->city->name }}</td>
                                            <td>{{ $item->province->name }}</td>
                                            <td>{{ $item->telp }}</td>
                                            <td>{{ $item->user->email }}</td>
                                            <td>{{ $item->pos }}</td>
                                            <td class="text-center">
                                                <button type="button" data-id="{{ $item->id }}" data-name="{{ $item->name }}" class="btn waves-effect waves-light text-white" style="background-color: rgb(134, 134, 252)" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-pencil"></i></button>
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

<!--modal edit-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Large modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cabang.store') }}" method="POST">@csrf
                    <p id="demo"></p>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Nama Cabang..." required>
                    </div>
                    <div class="form-group">
                        <select name="status" class="form-control" id="" required>
                            <option value="cabang">Cabang</option>
                            <option value="calon cabang">Calon Cabang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="kepala" placeholder="Kepala Cabang..." >
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="jabatan" placeholder="Jabatan..." >
                    </div>
                    <div class="form-group">
                        <textarea name="alamat" class="form-control" id="" cols="20" rows="10">Alamat...</textarea>
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="form-group">
                                <select name="propinsi_id" class="form-control" id="mySelect" required>
                                    <option value="">= Propinsi =</option>
                                    {{-- @foreach ($dt_props as $prop)
                                       <option value="{{ $prop->id }}">{{ $prop->name }}</option>
                                   @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <select name="kota_id" id="kota" class="form-control" required>
                                    <option value="">= Kota =</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <input type="text" name="pos" class="form-control" placeholder="Kode Pos..." >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea type="text" name="ekspedisi" class="form-control" placeholder="Alamat Ekspedisi..." >Alamat Ekspedisi... </textarea>
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