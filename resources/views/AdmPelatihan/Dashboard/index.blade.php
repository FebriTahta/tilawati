@extends('layouts.adm.master')
@section('content')
<div class="page-content-wrapper ">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Drixo</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <h5 class="page-title">Dashboard</h5>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat m-b-30">
                    <div class="p-3 bg-primary text-white">
                        <div class="mini-stat-icon">
                            <i class="mdi mdi-cube-outline float-right mb-0"></i>
                        </div>
                        <h6 class="text-uppercase mb-0">New Orders</h6>
                    </div>
                    <div class="card-body">
                        <div class="border-bottom pb-4">
                            <span class="badge badge-success"> +11% </span> <span class="ml-2 text-muted">From previous period</span>
                        </div>
                        <div class="mt-4 text-muted">
                            <div class="float-right">
                                <p class="m-0">Last : 1325</p>
                            </div>
                            <h5 class="m-0">1456<i class="mdi mdi-arrow-up text-success ml-2"></i></h5>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat m-b-30">
                    <div class="p-3 bg-primary text-white">
                        <div class="mini-stat-icon">
                            <i class="mdi mdi-account-network float-right mb-0"></i>
                        </div>
                        <h6 class="text-uppercase mb-0">New Users</h6>
                    </div>
                    <div class="card-body">
                        <div class="border-bottom pb-4">
                                <span class="badge badge-success"> +22% </span> <span class="ml-2 text-muted">From previous period</span>
                        </div>
                        <div class="mt-4 text-muted">
                            <div class="float-right">
                                <p class="m-0">Last : 3426</p>
                            </div>
                            <h5 class="m-0">3567<i class="mdi mdi-arrow-up text-success ml-2"></i></h5>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat m-b-30">
                    <div class="p-3 bg-primary text-white">
                        <div class="mini-stat-icon">
                            <i class="mdi mdi-tag-text-outline float-right mb-0"></i>
                        </div>
                        <h6 class="text-uppercase mb-0">Average Price</h6>
                    </div>
                    <div class="card-body">
                        <div class="border-bottom pb-4">
                            <span class="badge badge-danger"> -02% </span> <span class="ml-2 text-muted">From previous period</span>
                        </div>
                        <div class="mt-4 text-muted">
                            <div class="float-right">
                                <p class="m-0">Last : 15.8</p>
                            </div>
                            <h5 class="m-0">14.5<i class="mdi mdi-arrow-down text-danger ml-2"></i></h5>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat m-b-30">
                    <div class="p-3 bg-primary text-white">
                        <div class="mini-stat-icon">
                            <i class="mdi mdi-cart-outline float-right mb-0"></i>
                        </div>
                        <h6 class="text-uppercase mb-0">Total Sales</h6>
                    </div>
                    <div class="card-body">
                        <div class="border-bottom pb-4">
                            <span class="badge badge-success"> +10% </span> <span class="ml-2 text-muted">From previous period</span>
                        </div>
                        <div class="mt-4 text-muted">
                            <div class="float-right">
                                <p class="m-0">Last : 14256</p>
                            </div>
                            <h5 class="m-0">15234<i class="mdi mdi-arrow-up text-success ml-2"></i></h5>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card m-b-30">
                    <div class="card-body" style="min-height: 436px">
                        <h4 class="mt-0 header-title mb-4 text-uppercase">History Aktifitas Diklat</h4>
                        <ul class="list-unstyled activity-list">
                            <li class="activity-item">
                                <span class="activity-date">12 Oct</span>
                                <span class="activity-text">Responded to need “Volunteer Activities”</span>
                                <p class="text-muted mt-2">Everyone realizes why a new common language would be desirable common words.</p>
                            </li>
                            <li class="activity-item">
                                <span class="activity-date">13 Oct</span>
                                <span class="activity-text">Uploaded this Images</span>
                                <p class="text-muted mt-2">Their separate existence is a myth</p>
                            </li>
                            <li class="activity-item">
                                <span class="activity-date">14 Oct</span>
                                <span class="activity-text">Uploaded this File</span>
                                <p class="text-muted mt-2 mb-4">The new common language will be more simple and regular their pronunciation.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card m-b-30" style="min-height: 436px">
                    <div class="card-body">
                        <h4 class="mt-0 header-title mb-4 text-uppercase">DATA DIKLAT TIAP BULAN</h4>
                        <div class="panel-body">
                            <canvas id="canvas" height="350" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    var year = <?php echo $year; ?>;
    var user = <?php echo $user; ?>;
    // var year = document.getElementById("year").value;
    // var year = document.getElementById("user").value;
    var barChartData = {
        labels: year,
        datasets: [{
            label: 'User',
            backgroundColor: "green",
            data: user
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'line',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Yearly User Joined'
                }
            }
        });
    };
</script>
@endsection