@extends('layouts.theme')

@section('content')
    @php $pagename="member_home"; @endphp


                @if ($mytasks->count() > 0)
                    <h3>My Assigned Tasks</h3>
                    <div class="row">
                        <div class="panel">

                            <div class="panel-body">
                                <table class="table  responsive-table" id="products">
                                    <thead>
                                        <tr style="color: ">
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mytasks as $task)
                                            <tr>
                                                <td><b>{{ $task->title }}</b></td>
                                                <td>{{ $task->date }}</td>
                                                <td>{{ $task->status }}</td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>

                                <div class="row">
                                    <a href="{{urel('tasks')}}">View All Tasks</a>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif

                @if (auth()->user()->role=="Followup" && $settings->followups->count() > 0)
                    <h3>General Follow-up Activities</h3>
                    <div class="row">
                        <div class="panel">

                            <div class="panel-body">
                                <table class="table  responsive-table" id="products">
                                    <thead>
                                        <tr style="color: ">
                                            <th>Member</th>
                                            <th>Activities</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($settings->followups as $fup)
                                            <tr>
                                                <td><b>{{ $fup->Member->name }}</b><br>
                                                    <small>{{ $fup->date }}</small></td>
                                                <td>{{ $fup->discussion }} <i><small>Next Action: {{ $fup->nextaction }}</small></i></td>
                                                <td><a href="{{ url('member/'.$fup->member) }}" class="btn btn-sm btn-primary">View</a></td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                @endif

    <div class="row">
        <div class="panel-body">
            <div class="container">
               <h3>You are welcome to <b style="color: {{$settings->color}};">{{$settings->ministry_name}}</b></h3>
               <small>{{$settings->motto}}</small>
            </div>


                @if($settings->mode=="InActive")
                    <b style="color: red">This church has not been activated on the MinistryHub, if you are the Admin of this church please contact MinistryHUb at: <br>account@ministryhub.com.ng</b>

                @endif
                @foreach ($programmes as $prog)
                    <div class="card" style="background-color: white; padding: 5px;">
                        @isset($prog->picture)
                            <img src="{{asset('/images/'.$prog->picture)}}"  class="card-img-top" alt="{{$settings->logo}}">
                        @endisset

                        <div class="card-body">
                        <h5 class="card-title"><a href="/post/{{$prog->id}}"><b>{{$prog->title}}</b></h5>
                        <p class="card-text">Date:
                            {{$prog->from==$prog->to?$prog->from:$prog->from." to ".$prog->to}} <br>

                            {!!substr($prog->details,0,10) . "..."!!}
                        </p>
                        <a href="/post/{{$prog->id}}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                @endforeach


        </div>
    </div>




    <style>
            .card {
            flex-direction: row;
            }
            .card img {
            width: 100%;
            height: auto;
            }
    </style>


@endsection
