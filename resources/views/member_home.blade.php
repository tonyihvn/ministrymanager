@extends('layouts.theme')

@section('content')
    @php $pagename="member_home";@endphp



    <div class="row">

        <div class="panel-body">
            <div class="container">
               <h3>You are welcome to <b style="color: {{$settings->color}};">{{$settings->ministry_name}}</b></h3>
               <small>{{$settings->motto}}</small>
            </div>
            <div class="panel-body">

                @if($settings->mode=="InActive")
                    <b style="color: red">This church has not been activated on the MinistryHub, if you are the Admin of this church please contact MinistryHUb at: <br>account@ministryhub.com.ng</b>

                @endif
                @foreach ($programmes as $prog)
                    <div class="card" style="width: 18rem;">
                        <img src="{{asset('/images/'.$prog->picture)}}"  class="card-img-top" alt="{{$settings->logo}}">

                        <div class="card-body">
                        <h5 class="card-title"><a href="/post/{{$prog->id}}"><b>{{$prog->title}}</b></h5>
                        <p class="card-text">
                            <b>{{$prog->from==$prog->to?$prog->from:$prog->from." to ".$prog->to}}</b><hr>
                            {!! $prog->details !!}
                        </p>
                        <a href="/post/{{$prog->id}}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>




    <style>
            .card {
            flex-direction: row;
            }
            .card img {
            width: 30%;
            }
    </style>


@endsection
