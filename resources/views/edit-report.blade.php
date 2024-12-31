@extends('layouts.theme')
@section('content')
@php $modal="programme"; $pagename = "programmes"; @endphp

                    <h3 class="page-title">Edit Report </h3>

                    <div class="panel">

                        <div class="panel-body">
                            <form action="{{route('updatereport')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Report Title</label>
                                    <input type="text" name="title" class="form-control" value="{{$report->title}}">
                                </div>

                                <div class="form-group">
                                    <label for="subtitle">Report Subtitle</label>
                                    <input type="text" name="subtitle" class="form-control" value="{{$report->subtitle}}">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="ministry">Ministry / Unit</label>
                                        <select name="ministry" class="form-control">
                                            <option value="{{$report->ministry->id}}">{{$report->ministry->name}}</option>
                                            @foreach($ministries as $ministry)
                                                <option value="{{$ministry->id}}">{{$ministry->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="report_date">Report Date</label>
                                        <input type="date" name="report_date" class="form-control" value="{{$report->report_date}}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="written_by">Written By</label>
                                        <input type="text" name="written_by" class="form-control" value="{{$report->written_by}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="details">Details</label>
                                    <textarea type="text" name="details" class="form-control richtext" rows="4">{!!$report->details!!}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="remarks">remarks</label>
                                    <textarea type="text" name="remarks richtext" class="form-control" rows="4">{!!$report->remarks!!}</textarea>
                                </div>



                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update Report</button>
                                </div>

                            </form>
                        </div>

                    </div>


@endsection
