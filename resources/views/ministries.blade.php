@extends('layouts.theme')

@section('content')
    @php $modal="accounthead"; @endphp

    <h3 class="page-title">Minstries | <small style="color: green">Service Areas</small></h3>
    <div class="row">
            <div class="panel">
                <div class="panel-heading">
                    
                        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#ministry">Add New</a>
                    
                    
                </div>
                <div class="panel-body">
                    <table class="table  responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Name</th>
                                <th>Details</th>
                                <th>Leader</th>
                                <th>Activities</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ministries as $mins)

                                <tr>
                                    <td><b>{{$mins->name}}</b></td>
                                    <td>{{$mins->details}}</td>
                                    <td>{{is_numeric($mins->leader)?$users->where('id',$mins->leader)->first()->name:$mins->leader}}</td>
                                    <td>{{$mins->activities}}</td>
                                    <td>
                                        
                                        <button class="label label-primary" id="ach{{$mins->id}}" onclick="ministry({{$mins->id}})"  data-toggle="modal" data-target="#ministry" data-name="{{$mins->name}}" data-details="{{$mins->details}}" data-leader="{{$mins->leader}}" data-activities="{{$mins->activities}}">Edit</button>
                                    <a href="/delete-mins/{{$mins->id}}" class="label label-danger"  onclick="return confirm('Are you sure you want to delete the ministry {{$mins->name}}?')">Delete</a>
                                    </td>
                                    
                                </tr>
                            @endforeach
                            
                            
                        </tbody>
                    </table>
                    <div style="text-align: right">
                        {{$ministries->links("pagination::bootstrap-4")}}
                    </div>
                </div>
            </div>
        
    </div>
    

    <!-- Button to Open the Modal -->

  
  <!-- The Modal -->
  <div class="modal" id="ministry">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Ministry</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            
            <form method="POST" action="{{ route('addministry') }}">
                @csrf
                <input type="hidden" name="id" id="id">
                                
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="details">Details</label>
                    <input type="text" name="details" id="details" class="form-control">
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
                    <label for="activities"  class="control-label">Activities</label>
                    <textarea name="activities" id="activities" class="form-control" placeholder="Activities" rows="4"></textarea>
                </div>
            

                

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Add Ministry') }}
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