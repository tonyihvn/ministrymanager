@extends('layouts.theme')

@section('content')
    @php $pagename="dashboard"; @endphp

    <h3 class="page-title">Dashboard | <small style="color: green">Periodic Performance</small></h3>
    <div class="row">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Stats</h3>
            </div>
            <div class="panel-body">
                <div class="container">
                    <div class="row" style="position: relative;">
                        <div class="col-lg-2 col-sm-6">
                            <div class="card-box bg-blue">
                                <div class="inner">
                                    <h3> {{$hmembers->count()}} </h3>
                                    <p> Total Members</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                </div>
                                <a href="/members" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-6">
                            <div class="card-box bg-green">
                                <div class="inner">
                                    <h3> {{$hmembers->where('status','New Member')->count()}} </h3>
                                    <p> New Members</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                </div>
                                <a href="/members" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                            <div class="card-box bg-orange">
                                <div class="inner">
                                    <h3> {{$hmembers->where('status','Worker')->count()}} </h3>
                                    <p> Workers </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                                </div>
                                <a href="/members" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                            <div class="card-box bg-red">
                                <div class="inner">
                                    <h3> {{$mytasks->count()}} </h3>
                                    <p> Tasks / To Do </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-tasks"></i>
                                </div>
                                <a href="/tasks" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <a href="http://www.uiuxstream.com/dashboard-user-profile-page-design-using-bootstrap-4/">uiuxstream</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Church Attendance | Last 4 Weeks</h3>
                </div>
                <div class="panel-body">

                    <div id="attendance-chart" style="height: 300px"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Upcoming Programmes/Events</h3>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>

                            <tr>

                                <th>Title</th>
                                <th>Date</th>
                                <th>Host/Organizer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($uprogrammes as $up)
                                <tr>
                                    <td>{{$up->title}}</td>
                                    <td>{{$up->from==$up->to?$up->from:$up->from." to ".$up->to}}</td>
                                    <td>{{$up->ministry}}</td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        body{
            background:#eee;
            }

            .card-box {
                position: relative;
                color: #fff;
                padding: 20px 10px 40px;
                margin: 30px 0px;
            }
            .card-box:hover {
                text-decoration: none;
                color: #f1f1f1;
            }
            .card-box:hover .icon i {
                font-size: 100px;
                transition: 1s;
                -webkit-transition: 1s;
            }
            .card-box .inner {
                padding: 5px 10px 0 10px;
            }
            .card-box h3 {
                font-size: 27px;
                font-weight: bold;
                margin: 0 0 8px 0;
                white-space: nowrap;
                padding: 0;
                text-align: left;
            }
            .card-box p {
                font-size: 15px;
            }
            .card-box .icon {
                position: absolute;
                top: auto;
                bottom: 5px;
                right: 5px;
                z-index: 0;
                font-size: 72px;
                color: rgba(0, 0, 0, 0.15);
            }
            .card-box .card-box-footer {
                position: absolute;
                left: 0px;
                bottom: 0px;
                text-align: center;
                padding: 3px 0;
                color: rgba(255, 255, 255, 0.8);
                background: rgba(0, 0, 0, 0.1);
                width: 100%;
                text-decoration: none;
            }
            .card-box:hover .card-box-footer {
                background: rgba(0, 0, 0, 0.3);
            }
            .bg-blue {
                background-color: #00c0ef !important;
            }
            .bg-green {
                background-color: #00a65a !important;
            }
            .bg-orange {
                background-color: #f39c12 !important;
            }
            .bg-red {
                background-color: #d9534f !important;
            }

    </style>


@endsection
