@extends('layouts.theme')

@section('content')
    @php $modal="report"; @endphp

    <h3 class="page-title">Reports | <small style="color: green">All Reports</small></h3>
    <div class="row">
            <div class="panel">
                <div class="panel-heading">

                        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#hfellowship">Add New</a>


                </div>
                <div class="panel-body">
                    <table class="table  responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>#</th>
                                <th>Report Title</th>
                                <th>Ministry / Unit</th>
                                <th>Report Date</th>
                                <th>Written By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($reports as $report)
                            <tr>
                                <td>{{ $report->id }}</td>
                                <td>{!! $report->title ."<br>". $report->subtitle!!}</td>
                                <td>{!! $report->ministry->name ."<br>". $report->ministry_unit !!}</td>
                                <td>{{ $report->report_date }}</td>
                                <td>{{ $report->written_by }}</td>
                                <td class="btn-group">
                                    <a href="{{url('view-report/'.$report->id)}}" class="btn btn-primary btn-xs">View</a>
                                    <a href="{{url('edit-report/'.$report->id)}}" class="btn btn-warning btn-xs">Edit</a>
                                    <a href="{{url('delete-report/'.$report->id)}}" class="btn btn-danger btn-xs">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

    </div>
@endsection
