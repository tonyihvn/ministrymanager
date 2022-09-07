@extends('layouts.theme')

@section('content')
    @php $pagetype="report"; $modal="accounthead"; @endphp

    <h3 class="page-title">Attendance | <small style="color: green">Management</small></h3>
    <div class="row">
            <div class="panel">
                <div class="panel-heading" style="text-align: center !important">
                    @isset($message)
                        {{$message}}
                    @endisset
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#attendance">Add New</a>


                </div>
                <div class="panel-body">
                    <table class="table  responsive-table" id="products">
                        <thead>
                            <tr style="color: ">
                                <th>Date</th>
                                <th>Activity</th>
                                <th>Men</th>
                                <th>Women</th>
                                <th>Children</th>
                                <th>Remarks</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendance as $attend)

                                <tr>
                                    <td>{{$attend->date}}</td>
                                    <td>{{$attend->activity}}</td>
                                    <td>{{$attend->men}}</td>
                                    <td>{{$attend->women}}</td>
                                    <td>{{$attend->children}}</td>
                                    <td>{{$attend->remarks}}</td>
                                    <td>
                                        <span class="label label-success" style="font-weight: bold;">Total: {{$attend->men+$attend->women+$attend->children}}</span>
                                        <button class="label label-primary" id="ach{{$attend->id}}" onclick="attendance({{$attend->id}})"  data-toggle="modal" data-target="#attendance" data-date="{{$attend->date}}" data-activity="{{$attend->activity}}" data-men="{{$attend->men}}" data-women="{{$attend->women}}" data-children="{{$attend->children}}" data-remarks="{{$attend->remarks}}">Edit</button>
                                    <a href="/delete-attd/{{$attend->id}}" class="label label-danger"  onclick="return confirm('Are you sure you want to delete {{$attend->date}}\'s Attendance Record?')">Delete</a>
                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div style="text-align: right">
                        {{$attendance->links("pagination::bootstrap-4")}}
                    </div>
                </div>
            </div>

    </div>


    <!-- Button to Open the Modal -->


  <!-- The Modal -->
  <div class="modal" id="attendance">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Attendance Record</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

            <form method="POST" action="{{ route('addattendance') }}">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="row">
                    <div class="form-group col-md-3">
                    <label for="men">Men</label>
                    <input type="number" name="men" id="men" class="form-control" value="0">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="women">Women</label>
                        <input type="number" name="women" id="women" class="form-control" value="0">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="children">Children</label>
                        <input type="number" name="children" id="children" class="form-control" value="0">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="stayedback">Stayed Back</label>
                        <input type="number" name="stayedback" id="stayedback" class="form-control" placeholder="for 2nd Service"  aria-describedby="helpId">
                        <small id="helpId" class="form-text text-muted">Optional</small>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="date">Date</label>
                        <input type="text" name="date" id="date" class="form-control datepicker" value="{{date("Y-m-d")}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="activity">Activity</label>
                        <select name="activity"  class="form-control">
                            <option value="Sunday Service">Sunday Service</option>
                            <option value="Midweek Services">Midweek Service</option>
                            <option value="Programme">Programme</option>
                        </select>
                    </div>
                </div>




                <div class="form-group">
                    <label for="remarks">Remarks</label>
                    <input type="text" name="remarks" id="remarks" class="form-control" placeholder="e.g. 1st Service, Programme name">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Save Attendance') }}
                    </button>
                </div>


            </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>


@endsection
