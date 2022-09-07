@extends('layouts.theme')

@section('content')
    @php $pagetype="report"; @endphp

    <h3 class="page-title">Bulk SMS | <small style="color: green">Send Bulk SMS</small></h3>
    <div class="row">

            <div class="card col-md-6 col-md-offset-3">
                <div class="card-body">

                    @isset($message)
                        <div class="alert alert-dismissable alert-info">Your message was sent successfully!</div>
                    @endisset

                    <div  style="text-align: right !important"><span class="label label-danger">Credit Balance: <b>{{ $creditbalance }}</b> </span></div>

                    <form method="POST" action="{{ route('sendsms') }}">
                        @csrf
                        <div class="form-group">
                            <label for="recipients">Recipients</label>
                            <input type="text" name="recipients" id="recipients" class="form-control" placeholder="e.g. 234803333333,2349000000,...">
                        </div>

                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea type="text" name="body" id="body" class="form-control" rows="4" maxlength="500"></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send SMS') }}
                            </button>
                        </div>




                    </form>
                </div>
            </div>

            <div class="panel">

                <div class="panel-body">
                    <table class="table  responsive-table" id="products">
                        <thead>
                            <tr>
                                <th width="20"><input type="checkbox" id="all" onclick="addnumber('all')" data-allnumbers="{{$allnumbers}}"></th>
                                <th>Full Name</th>
                                <th>Status</th>
                                <th>Ministry</th>
                                <th>Phone Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                            @php
                                $number = $member->phone_number;
                                if (substr($number,0,1)=="0") {
                                    $number = "234".ltrim($number,'0');
                                }
                            @endphp
                                <tr>
                                    <td>
                                        @isset($member->phone_number)
                                            <input type="checkbox" id="{{$number}}" onclick="addnumber({{$number}})" class="checkboxes">
                                        @endisset
                                    </td>
                                    <td>{{$member->name}}</td>
                                    <td>{{$member->status}}</td>
                                    <td>{{$member->ministry}}</td>
                                    <td>{{$number}}</td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>

    </div>



@endsection
