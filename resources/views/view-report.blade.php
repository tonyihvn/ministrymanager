@extends('layouts.theme')

@section('content')
@php $modal="programme"; $pagename = "programmes"; @endphp


    <h3 class="page-title">View Report | <small style="color: green"></small></h3>
    <div class="row">
            <div class="panel">
                <div class="panel-heading">

                    <h3>Title: <strong>{{$report->title}}</strong> </h3>
                    <h4>Subtitle: <strong>{{$report->subtitle}}</strong></h4>
                    Ministry: <strong>{{$report->ministry->name}}</strong> | Report Date: <strong>{{$report->report_date}}</strong> | Written By: <strong>{{$report->written_by}}</strong>

                </div>
                <hr>
                <div class="panel-body">
                    <p>{!! $report->details !!}</p>
                </div>
            </div>

            <!-- Create a form for remarks -->
            <div class="panel">
                <div class="panel-heading">
                    <h4>Remarks</h4>
                </div>
                <div class="panel-body">
                    {!!$report->remarks!!}
                </div>

                <div class="panel-body">
                    <form action="{{route('addremark')}}" method="post">
                        @csrf
                        <input type="hidden" name="report_id" value="{{$report->id}}">
                        <div class="form-group">
                            <label for="remarks">Enter Remarks</label>
                            <textarea name="remarks" class="form-control" required></textarea>                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save Remarks</button>
                        </div>
                    </form>
                </div>
            </div>

    </div>
@endsection
