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
        <div class="float-left page-breadcrumb">
            <ol class="breadcrumb">
                <span id="tgl"></span>&nbsp; <li class="breadcrumb-item active" id="bln"></li>
                <li class="breadcrumb-item active" id="hari"></li>
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
        <div class="card mini-stat m-b-30">
            <div class="p-3 text-white" style="background-color: rgb(0, 208, 223)">
                <div class="mini-stat-icon">
                    <i class="fa fa-building-o float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0">TOTAL</h6>
            </div>
            <div class="card-body text-left">
                <div class="border-bottom">
                    <blockquote class="blockquote font-18">
                        <h2 id="cb">???</h2>
                        <footer class="blockquote-footer">Cabang</footer>
                    </blockquote>
                </div>
            </div>
        </div>        
    </div>
    <div class="col-xl-10">
        <div class="card mini-stat m-b-30">
            <div class="p-3 text-white" style="background-color: rgb(0, 208, 223)">
                <div class="mini-stat-icon">
                    <i class="fa fa-building-o float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0">data cabang</h6>
            </div>
            <div class="card-body">
                <div class="border-bottom">
                    <div class="m-t-20 m-b-20 text-right" style="margin-right: 15px">
                        <button type="button" data-toggle="modal" data-target=".bs-example-modal-cabang" class="btn btn-primary waves-effect waves-dark btn-sm"><i class="mdi mdi-cloud-upload"></i> Import Cabang</button>
                        <button type="button" data-toggle="modal" data-target=".bs-example-modal-rpq" class="btn btn-primary waves-effect waves-dark btn-sm"><i class="mdi mdi-cloud-upload"></i> Import RPQ</button>
                        <a href="{{route('cabang.create')}}" type="button" class="btn btn-primary waves-effect waves-light btn-sm"><i class="fa fa-plus"></i> Cabang</a>
                    </div>
                    <blockquote class="text-left">
                        <table id="datatable_cabang" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0;width: 100%">
                            <thead class="mt-100">
                            <tr>
                                {{-- <th>Nama Cabang</th>
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
                                <th class="text-center">Opsi</th> --}}
                                <th>Cabang</th>
                                <th>Kepala</th>
                                <th>Kota / Kabupaten</th>
                                <th>Provinsi</th>
                                <th>Telp</th>
                                <th>Alamat</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $item=auth()->user() ?>
                                {{-- @if ( $item->role == "cabang")
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
                                @endif --}}
                            </tbody>
                        </table>
                        <footer class="blockquote-footer">Data cabang terbaru berdasarkan tahun 2021</footer>
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="card m-b-30 ">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body mini-stat m-b-30">
                            
                            
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

<!-- modal hapus -->
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

<!-- modal import cabang-->
<div class="col-sm-6 col-md-3 m-t-30">
    <div class="modal fade bs-example-modal-cabang" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">IMPORT DATA CABANG </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <form id="importcabang"  method="POST" enctype="multipart/form-data">@csrf
                                        <input type="hidden" id="import_tipe" value="munaqisy">
                                        <div class="form-group">
                                            <label for="">Import Data "Cabang" (hanya Excel File format .xlsx)</label>
                                            <input type="file" class="form-control" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="import" id="btnimport" class="btn btn-info" value="Import" />
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

<!-- modal import cabang-->
<div class="col-sm-6 col-md-3 m-t-30">
    <div class="modal fade bs-example-modal-rpq" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">IMPORT DATA RPQ </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <form id="importrpq"  method="POST" enctype="multipart/form-data">@csrf
                                        <input type="hidden" id="import_tipe" value="munaqisy">
                                        <div class="form-group">
                                            <label for="">Import Data "RPQ" (hanya Excel File format .xlsx)</label>
                                            <input type="file" class="form-control" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="import" id="btnimportrpq" class="btn btn-info" value="Import"/>
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
@endsection
@section('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="application/javascript">

    $(document).ready(function() {
        $.ajax({
            url:'{{ route("dashboard.cabang") }}',
            type: 'get',
            dataType: 'json',
            success:function(data) {
                document.getElementById('cb').innerHTML = data;
                console.log(data);
            }
        });
        $('#datatable_cabang').DataTable({
        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: {
            url:'{{ route("cabang.data") }}',
        },
        columns: [
            {
            data:'name',
            name:'name'
            },
            {
            data:'kepala',
            name:'kepala.name'
            },
            {
            data:'kabupaten',
            name:'kabupaten.nama'
            },
            {
            data:'provinsi',
            name:'provinsi.nama'
            },
            {
            data:'telp',
            name:'telp'
            },
            {
            data:'alamat',
            name:'alamat'
            }
        ]
        });
    })

    $('.bs-example-modal-center').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var modal = $(this)
        // modal.find('.modal-title').text('DETAIL USER');
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').text(name);
        
    })

    $('#importcabang').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
        type:'POST',
        url: "{{ route('import.cabang')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        beforeSend:function(){
            $('#btnimport').attr('disabled','disabled');
            $('#btnimport').val('Importing Process');
        },
        success: function(data){
            if(data.success)
            {
                //get total data cabang
                $.ajax({
                    url:'{{ route("dashboard.cabang") }}',
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        document.getElementById('cb').innerHTML = data;
                        console.log(data);
                    }
                });
                //sweetalert and refresh datatable
                $("#importcabang")[0].reset();
                toastr.success(data.success);
                var oTable = $('#datatable_cabang').dataTable();
                oTable.fnDraw(false);
                $('#btnimport').val('Import');
                $('#btnimport').attr('disabled',false);
                $('.bs-example-modal-cabang').modal('hide');
                swal("Done!", data.message, "success");
            }
            if(data.error)
            {
                $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
                $('#btnimport').attr('disabled',false);
                $('#btnimport').val('Import');
            }
        },
        error: function(data)
        {
            console.log(data);
            }
        });
    });

    $('#importrpq').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
        type:'POST',
        url: "{{ route('import.rpq')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        beforeSend:function(){
            $('#btnimportrpq').attr('disabled','disabled');
            $('#btnimportrpq').val('Importing Process');
        },
        success: function(data){
            if(data.success)
            {
                //get total data cabang
                $.ajax({
                    url:'{{ route("dashboard.cabang") }}',
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        document.getElementById('cb').innerHTML = data;
                        console.log(data);
                    }
                });
                //sweetalert and refresh datatable
                $("#importrpq")[0].reset();
                toastr.success(data.success);
                var oTable = $('#datatable_cabang').dataTable();
                oTable.fnDraw(false);
                $('#btnimport').val('Import');
                $('#btnimport').attr('disabled',false);
                $('.bs-example-modal-rpq').modal('hide');
                swal("Done!", data.message, "success");
            }
            if(data.error)
            {
                $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
                $('#btnimport').attr('disabled',false);
                $('#btnimport').val('Import');
            }
        },
        error: function(data)
        {
            console.log(data);
            }
        });
    });
</script>


@endsection