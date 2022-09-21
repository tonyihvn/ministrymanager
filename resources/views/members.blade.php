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
                                <th width="20">#</th>
                                <th>Full Name</th>
                                <th>Status</th>
                                <th>Ministry</th>
                                <th>Phone Number</th>
                                <th>Assigned To</th>
                                <th>Location</th>
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
                                    <td>{{$member->id}}</td>
                                    <td>{{$member->name}}</td>
                                    <td>{{$member->status}}</td>
                                    <td>{{$member->ministry}}</td>
                                    <td>{{$member->phone_number}}</td>

                                    <td>{{($member->assigned_to) == '' ? 'Not Assigned' : (is_numeric($member->assigned_to)?$users->where('id',$member->assigned_to)->first()->name:$member->assigned_to)}}</td>

                                    <td>{{$member->location}}</td>
                                    <td width="90">
                                        <div class="btn-group">
                                            <a href="/edit-member/{{$member->id}}" class="label label-primary left"><i class="lnr lnr-pencil"></i></a>
                                            <a href="/member/{{$member->id}}/" class="label label-success"><i class="lnr lnr-eye"></i></a>
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
