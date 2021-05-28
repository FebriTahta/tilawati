@extends('layouts.adm.master')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="float-right page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('jenis.index')}}">Pelatihan</a></li>
                <li class="breadcrumb-item active">Kelembagaan</li>
                <li class="breadcrumb-item active" id="clock"></li>
            </ol>
        </div>
        {{-- <h5 class="page-title">Status Lembaga</h5> --}}
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
                    <button type="button" class="btn btn-primary waves-effect waves-light m-t-10" data-toggle="modal" data-target=".bs-example-modal-center " style="min-width: 100px"><i class="fa fa-plus"></i> Jenjang</button>
                </div>
                @endif
            </div>
        </div>

    <div class="col-xl-10">
        <div class="card m-b-30 m-t-10">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">                          
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="mt-100">
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th>Status</th>
                                    <th class="text-center" style="width: 10%">...</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dt_jenis as $key=>$item)
                                        <tr>
                                            <td style="width: 5%">{{$key+1}}</td>
                                            <td>{{$item->name}}</td>
                                            <td class="text-center" style="width: 10%">
                                                <button class="btn btn-sm btn-danger"data-toggle="modal" data-target="#myModal" data-kriteria="{{ $item->name }}" data-id="{{ $item->id }}"><i class="fa fa-trash"></i> </button>
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
                    <h5 class="modal-title mt-0">STATUS LEMBAGA BARU</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <form action="{{ route('jenis.store') }}" method="POST">@csrf
                       <div class="form-group">
                           <input type="name" class="form-control" name="name" placeholder="Pesantren / SD / SMP / SMA / Dll..." required>
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

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('jenjang.del') }}" method="POST">@csrf
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(243, 107, 107)">
                    <h5 class="modal-title mt-0 text-white" id="myModalLabel" >HAPUS JENJANG</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="kriteriaid">
                    <p id="kriteria"></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" style="background-color: rgb(243, 107, 107)" class="btn btn-danger waves-effect waves-light"><i class="fa fa-trash"></i> HAPUS</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('script')
<script type="application/javascript">
    $('#myModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var kriteria = button.data('kriteria')
        var id = button.data('id')
        var modal = $(this)
        modal.find('.modal-title').text('HAPUS JENJANG');
        modal.find('.modal-body #kriteria').text(' Yakin akan menghapus " ' + kriteria + ' " ?');
        modal.find('.modal-body #kriteriaid').val(id);
    })
</script>
@endsection