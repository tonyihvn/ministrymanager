@extends('layouts.theme')
@section('content')
    @php $modal="programme"; $pagename = "programmes"; @endphp
                    <h3 class="page-title">Add New Report </h3>
                    <div class="panel">
                        <div class="panel-body">
                            <form action="{{route('addreport')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="title">Report Title</label>
                                        <input type="text" name="title" class="form-control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="subtitle">Report Subtitle</label>
                                        <input type="text" name="subtitle" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="details">Report Detail</label>
                                    <textarea name="details" class="form-control richtext"></textarea>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="report_date">Report Date</label>
                                        <input type="text" name="report_date" class="form-control datepicker">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="written_by">Written By</label>
                                        <input type="text" name="written_by" class="form-control">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="ministry_id">Ministry / Unit</label>
                                        <select name="ministry_id" class="form-control">
                                            <option value="">Select Ministry</option>
                                            @foreach($ministries as $ministry)
                                                <option value="{{$ministry->id}}">{{$ministry->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="ministry_unit">Unit</label>
                                        <input type="text" name="ministry_unit" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save Report</button>
                                </div>
                            </form>
                        </div>

                    </div>


@endsection
