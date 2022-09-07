@extends('layouts.theme')

<style>
    #gradientbg {
        background-image:
        linear-gradient(to bottom, rgba(8, 19, 87, 0.52), rgba(3, 3, 3, 0.93)),
        url('{{asset('/images/'.$program->picture)}}');
        padding: 10px;
        background-size: contain;
        background-repeat: no-repeat;
        padding-top: 300px;
    }
</style>
@section('content')

    <h3 class="page-title">{{$program->title}} | <small><b><i>Category: </i></b></small><small style="color: green;">{{$program->type}} - {{$program->category}} </small></h3>
    <div class="row" id="gradientbg">

            <div class="panel" style="background: white; opacity: 0.7;">
            {{--
                <div id="carouselId" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselId" data-slide-to="1"></li>
                        <li data-target="#carouselId" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img data-src="{{asset('/images/'.$program->picture)}}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img data-src="{{asset('/images/'.$program->picture)}}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img data-src="{{asset('/images/'.$program->picture)}}" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            --}}
                <div class="panel-heading">
                        @if ($program->type!="News")
                            <b>Host: </b> {{$program->ministry}}

                            <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#programme">I will be There</a>

                        @endif

                </div>
                <div class="panel-body">
                    <b>Date: </b> @if ($program->from==$program->to) {{$program->from}} @else  From: {{$program->from." To: ".$program->to}} @endif <br>

                    {!! $program->details !!}
                </div>
            </div>

    </div>


@endsection
