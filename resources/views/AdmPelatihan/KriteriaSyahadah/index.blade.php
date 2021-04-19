@extends('layouts.adm.master')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="float-right page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Pelatihan</a></li>
                <li class="breadcrumb-item active">Kriteria Syahadah</li>
            </ol>
        </div>
        <h5 class="page-title">Kriteria Syahadah</h5>
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
                    <a href="{{route('lembaga.create')}}" data-toggle="modal" data-target=".bs-example-modal-center" type="button" class="btn btn-primary waves-effect waves-light"><i class="fa fa-plus"></i> Tamabah Kriteria Baru</a>
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
                                    <th style="width: 5%">#</th>
                                    <th style="width: 60%">Kriteria</th>
                                    <th style="width: 20%">Untuk</th>
                                    <th style="width: 15%" class="text-center">...</th>
                                </tr>
                                </thead>
                                <tbody class="text-uppercase">
                                   @foreach ($krtr as $key=>$item)
                                       <tr>
                                           <td>{{ $key+1 }}</td>
                                           <td>{{ $item->name }}</td>
                                           <td>{{ $item->untuk }}</td>
                                           <td class="text-center">
                                                <button type="button" data-id="{{ $item->id }}" data-name="{{ $item->name }}" class="btn waves-effect waves-light text-white" style="background-color: rgb(134, 134, 252)"><i class="fa fa-pencil"></i></button>
                                               <button class="btn btn-danger"data-toggle="modal" data-target="#myModal" data-kriteria="{{ $item->name }}"><i class="fa fa-trash"></i> </button>
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
                    <h5 class="modal-title mt-0">KRITERIA BARU</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <form action="{{ route('kriteria.store') }}" method="POST">@csrf
                       <div class="form-group">
                           <input type="text" class="form-control text-uppercase" name="name" placeholder="Kriteria..." required>
                       </div>
                       <div class="form-group">
                           <input type="radio" value="GURU" name="untuk"> GURU 
                           <input type="radio" value="SANTRI" name="untuk"> SANTRI 
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
                <p>Cras mattis consectetur purus sit amet fermentum.
                    Cras justo odio, dapibus ac facilisis in,
                    egestas eget quam. Morbi leo risus, porta ac
                    consectetur ac, vestibulum at eros.</p>
                <p>Praesent commodo cursus magna, vel scelerisque
                    nisl consectetur et. Vivamus sagittis lacus vel
                    augue laoreet rutrum faucibus dolor auctor.</p>
                <p>Aenean lacinia bibendum nulla sed consectetur.
                    Praesent commodo cursus magna, vel scelerisque
                    nisl consectetur et. Donec sed odio dui. Donec
                    ullamcorper nulla non metus auctor
                    fringilla.</p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('kriteria.delete') }}" method="POST">@csrf
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(243, 107, 107)">
                    <h5 class="modal-title mt-0 text-white" id="myModalLabel" >HAPUS KRITERIA SYAHADAH</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
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
        modal.find('.modal-title').text('HAPUS KRITERIA');
        modal.find('.modal-body #kriteria').text(' Yakin akan menghapus " ' + kriteria + ' " ?');
        modal.find('.modal-body #kriteria').val(id);
    })
</script>
@endsection