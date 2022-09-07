@extends('layouts.theme')

@section('content')
    @php $pagename="member_home";@endphp



    <h3 class="page-title">Dashboard | <small style="color: green"> Updates, Tasks, Messages</small></h3>
    <div class="row">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Stats</h3>
            </div>
            <div class="panel-body">
                <div class="container">
                   <h3>Member Info</h3>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="container">
               <h3>You are welcome to <b style="color: {{$settings->color}};">{{$settings->ministry_name}}</b></h3>
               <small>{{$settings->motto}}</small>
            </div>
            <div class="panel-body">
                <table class="table  responsive-table">
                    <thead>
                        <tr style="color: ">
                            <th>Banner</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Host</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($programmes as $prog)
                            <tr>
                                <td width="10%">
                                    <a href="/post/{{$prog->id}}">
                                        <img src="{{asset('/images/'.$prog->picture)}}"  alt="{{$settings->logo}}" width="100%" height="auto">
                                    </a>
                                </td>
                                <td><a href="/post/{{$prog->id}}"><b>{{$prog->title}}</b></td>
                                <td><b>{{$prog->from==$prog->to?$prog->from:$prog->from." to ".$prog->to}}</b></td>
                                <td>{{$prog->type}}</td>
                                <td>{{$prog->category}}</td>
                                <td>{{$prog->ministry}}</td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>

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
                margin: 20px 0px;
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
