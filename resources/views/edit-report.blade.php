@extends('layouts.theme')
@section('content')
                    <h3 class="page-title">Edit Report </h3>

                    <div class="panel">

                        <div class="panel-body">
                            <form action="{{url('update-report/'.$report->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Report Title</label>
                                    <input type="text" name="title" class="form-control" value="{{$report->title}}">
                                </div>

                                <div class="form-group">
                                    <label for="subtitle">Report Subtitle</label>
                                    <input type="text" name="subtitle" class="form-control" value="{{$report->subtitle}}">
                                </div>

                                <div class="form-group">
                                    <label for="ministry">Ministry / Unit</label>
                                    <select name="ministry" class="form-control">
                                        <option value="{{$report->ministry->id}}">{{$report->ministry->name}}</option>
                                        @foreach($ministries as $ministry)
                                            <option value="{{$ministry->id}}">{{$ministry->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="report_date">Report Date</label>
                                    <input type="date" name="report_date" class="form-control" value="{{$report->report_date}}">
                                </div>

                                <div class="form-group">
                                    <label for="written_by">Written By</label>
                                    <input type="text" name="written_by" class="form-control" value="{{$report->written_by}}">
                                </div>

                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea type="text" name="body" class="form-control" rows="4">{{$report->body}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="{{$report->status}}">{{$report->status}}</option>
                                        <option value="Draft">Draft</option>
                                        <option value="Published">Published</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update Report</button>
                                </div>

                            </form>
                        </div>

                    </div>


@endsection
