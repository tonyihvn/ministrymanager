@extends('layouts.theme')

@section('content')
    @php $pagetype="report"; $users = $members; @endphp

    <h3 class="page-title">Members | <small style="color: green">All Members</small></h3>
    <div class="row">



            <div class="panel">

                <div class="panel-body">
                    <table class="table  responsive-table" id="products">
                        <thead>
                            <tr style="color: ">
                                <th width="20" class="visible-md visible-lg">#</th>
                                <th>Full Name</th>
                                <th>Status</th>
                                <th class="visible-md visible-lg">Ministry</th>
                                <th class="visible-md visible-lg">Phone Number</th>
                                <th class="visible-md visible-lg">Assigned To</th>
                                <th class="visible-md visible-lg">Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)

                                <tr
                                    @if ($member->gender=="Female")
                                        style="background-color: azure !important;"
                                    @endif
                                >
                                    <td class="visible-md visible-lg">{{$member->id}}</td>
                                    <td>{{$member->name}}</td>
                                    <td>{{$member->status}}</td>
                                    <td class="visible-md visible-lg">{{$member->ministry}}</td>
                                    <td class="visible-md visible-lg">{{$member->phone_number}}</td>

                                    <td class="visible-md visible-lg">{{($member->assigned_to) == '' ? 'Not Assigned' : (is_numeric($member->assigned_to)?$users->where('id',$member->assigned_to)->first()->name:$member->assigned_to)}}</td>

                                    <td class="visible-md visible-lg">{{$member->location}}</td>
                                    <td>
                                        <div class="btn-group">
                                            @if (auth()->user()->role=="Admin" || auth()->user()->role=="Super")
                                                <a href="/edit-member/{{$member->id}}" class="btn btn-primary btn-xs">Edit</a>
                                            @endif
                                            <a href="/member/{{$member->id}}/" class="btn btn-success btn-xs">View</a>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>

    </div>



@endsection
