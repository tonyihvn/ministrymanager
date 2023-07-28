@extends('layouts.theme')

@section('content')
    @php $modal="accounthead"; @endphp

    <h3 class="page-title">House | <small style="color: green">Fellowships</small></h3>
    <div class="row">
            <div class="panel">
                <div class="panel-heading">

                        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#hfellowship">Add New</a>


                </div>
                <div class="panel-body">
                    <table class="table  responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Name</th>
                                <th>Location</th>
                                <th>Address</th>
                                <th>About</th>
                                <th>Leader</th>
                                <th>Meeting Day/Time</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($housefellowships as $hf)

                                <tr>
                                    <td><b>{{$hf->name}}</b></td>
                                    <td>{{$hf->location}}</td>
                                    <td>{{$hf->address}}</td>
                                    <td>{{$hf->about}}</td>
                                    <td>{{is_numeric($hf->leader)?$users->where('id',$hf->leader)->first()->name:$hf->leader}}</td>
                                    <td>{{$hf->activities}}</td>
                                    <td>

                                        <button class="label label-primary" id="ach{{$hf->id}}" onclick="hfellowship({{$hf->id}})"  data-toggle="modal" data-target="#hfellowship" data-name="{{$hf->name}}"  data-location="{{$hf->location}}"  data-address="{{$hf->address}}" data-about="{{$hf->about}}" data-leader="{{$hf->leader}}" data-activities="{{$hf->activities}}">Edit</button>
                                        <a href="/hf-activities/{{$hf->id}}" class="label label-success">Activities</a>
                                    <a href="/delete-hfel/{{$hf->id}}" class="label label-danger"  onclick="return confirm('Are you sure you want to delete the house fellowship {{$hf->name}}?')">Delete</a>
                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div style="text-align: right">
                        {{$housefellowships->links("pagination::bootstrap-4")}}
                    </div>
                </div>
            </div>

    </div>


    <!-- Button to Open the Modal -->


  <!-- The Modal -->
  <div class="modal" id="hfellowship">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New House Fellowship</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

            <form method="POST" action="{{ route('addhfellowship') }}">
                @csrf
                <input type="hidden" name="id" id="id">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" id="location" class="form-control">
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control">
                </div>

                <div class="form-group">
                    <label for="about">About the H. Fellowship</label>
                    <input type="text" name="about" id="about" class="form-control">
                </div>

                <div class="form-group">
                    <label for="leader" class="control-label">Leader</label>
                    <select class="form-control" name="leader" id="leader">
                        <option value="" selected>Leader</option>
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label for="activities"  class="control-label">Meeting Day/Time</label>
                    <textarea name="activities" id="activities" class="form-control" placeholder="Day/Time" rows="4"></textarea>
                </div>




                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Add H. Fellowship') }}
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
