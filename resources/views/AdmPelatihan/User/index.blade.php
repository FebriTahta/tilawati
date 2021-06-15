@extends('layouts.adm.master')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="float-right page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Diklat</a></li>
                <li class="breadcrumb-item active">User</li>
            </ol>
        </div>
        <div class="float-left page-breadcrumb">
            <ol class="breadcrumb">
                <span id="tgl"></span>&nbsp; <li class="breadcrumb-item active" id="bln"></li>
                <li class="breadcrumb-item active" id="hari"></li>
            </ol>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <!--flash massage-->
    @include('layouts.sess.flash_message')
    <!--flash massage-->
    <div class="col-xl-3" style="align-content: center;text-align: center">
        <div class="card mini-stat m-b-30">
            <div class="p-3 text-white" style="background-color: rgb(0, 208, 223)">
                <div class="mini-stat-icon">
                    <i class="fa fa-bank float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0">TOTAL</h6>
            </div>
            <div class="card-body text-left">
                <div class="border-bottom">
                    <blockquote class="blockquote font-18">
                        <h2 id="cb">???</h2>
                        <footer class="blockquote-footer">User</footer>
                    </blockquote>
                </div>
            </div>
        </div>        
    </div>

    <div class="col-xl-9">
        <div class="card mini-stat m-b-30">
            <div class="p-3 text-white" style="background-color: rgb(0, 208, 223)">
                <div class="mini-stat-icon">
                    <i class="fa fa-user float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0">data User</h6>
            </div>
            <div class="card-body">
                <div class="border-bottom">
                    <blockquote class="text-left">
                        <table id="datatable_user" class="table datas table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="mt-100">
                            <tr>
                                <th>Username</th>
                                <th>Sebagai</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                        <footer class="blockquote-footer">Data User terbaru berdasarkan tahun 2021</footer>
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
@endsection

@section('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script>
        $(document).ready(function() {
        $.ajax({
            url:'{{ route("dashboard.user") }}',
            type: 'get',
            dataType: 'json',
            success:function(data) {
                document.getElementById('cb').innerHTML = data;
                console.log(data);
            }
        });
        $('#datatable_user').DataTable({
        //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: {
            url:'{{ route("user.data") }}',
        },
        columns: [
            {
            data:'username',
            name:'username'
            },
            {
            data:'role',
            name:'role'
            }
        ]
        });
    })
    </script>
@endsection