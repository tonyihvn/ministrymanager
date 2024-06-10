@extends('layouts.theme')

@section('content')
    @php $modal="programme"; $pagename = "programmes"; @endphp

    <h3 class="page-title">{{$programmes->first()->name ?? ''}}<small style="color: green">Activities</small></h3>
    <div class="row">
            <div class="panel">
                <div class="panel-heading">
                    @isset($message)
                        <div class="alert alert-dismissable alert-info">Your Programme has been successfully placed!</div>
                    @endisset
                        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#programme">Add New</a>


                </div>
                <div class="panel-body">
                    <table class="table  responsive-table">
                        <thead>
                            <tr style="color: ">

                                <th>Title</th>
                                <th>Date</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($programmes as $prog)

                                <tr>

                                    <td><a href="/post/{{$prog->id}}"><b>{{$prog->title}}</b></td>
                                    <td><b>{{$prog->from==$prog->to?$prog->from:$prog->from." to ".$prog->to}}</b></td>


                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                </div>
            </div>

    </div>


    <!-- Button to Open the Modal -->


  <!-- The Modal -->
  <div class="modal" id="programme">
    <div class="modal-dialog"  style="width: 90%">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

            <form method="POST" action="{{ route('addprogramme') }}" id="programmesform" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id">

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="type">Type</label>
                        <select class="form-control" name="type" id="type">
                            <option value="Activity Report">Activity Report</option>
                          <option value="News">News</option>
                          <option value="Event">Event</option>
                          <option value="Programme">Programme</option>
                          <option value="Announcement">Announcement</option>
                          <option value="Sermon">Sermon/Message</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="from">Start Date</label>
                        <input type="date" name="from" id="from" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="to">End Date</label>
                        <input type="date" name="to" id="to" class="form-control">
                    </div>

                </div>

                <div class="form-group">
                    <label for="details"  class="control-label">Details</label>
                    <textarea name="details" id="details" class="form-control richtext" placeholder="Details" rows="10" style="min-height: 100px;"></textarea>
                </div>
                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="category">Category</label>

                        <select class="form-control" name="category" id="category">
                        <option value="Upcoming">Upcoming</option>
                        <option value="Past">Past</option>
                        <option value="Periodic">Periodic</option>
                        <option value="Others">Others</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="ministry" class="control-label">Organizer / Host</label>
                        <select class="form-control" name="ministry" id="ministry">

                                <option value="{{$programmes->first()->name??''}}">{{$programmes->first()->name??''}}</option>

                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <input type="hidden" id="oldpicture" name="oldpicture">
                    <label for="picture">Upload Featured Image  <i>(best resolution: 1920/1080pixel)</i></label>
                    <input type="file" name="picture" id="picture" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Publish Post') }}
                    </button>
                </div>


            </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger modaldismiss" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>


@endsection
