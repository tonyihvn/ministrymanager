@extends('layouts.theme')

@section('content')
    @php $pagetype="report"; @endphp

    <h3 class="page-title">Tasks | <small style="color: green">TO DOs</small></h3>
    <div class="row">
        <div class="panel">

            <div class="panel-body">
                <table class="table  responsive-table" id="products">
                    <thead>
                        <tr style="color: ">
                            <th>Title</th>
                            <th style="width: 30% !important;">Details</th>
                            <th>Member Info</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Assigned To</th>
                            <th>Set Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td><b>{{ $task->title }}</b></td>
                                <td>{{ $task->activities }}</td>
                                <td>{{ is_numeric($task->member) ? $users->where('id', $task->member)->first()->name : $task->member }}
                                </td>
                                <td>{{ $task->date }}</td>
                                <td>{{ $task->status }}</td>
                                <td>{{ is_numeric($task->assigned_to) ? $users->where('id', $task->assigned_to)->first()->name : $task->assigned_to }}
                                </td>

                                <td>
                                    <a href="/inprogresstask/{{ $task->id }}/{{ $task->member }}"
                                        class="label label-warning">In Progress</a>
                                    <a href="/completetask/{{ $task->id }}/{{ $task->member }}"
                                        class="label label-success">Completed</a>

                                    <a href="/delete-task/{{ $task->id }}" class="label label-danger"
                                        onclick="return confirm('Are you sure you want to delete this task? {{ $task->title }}?')">Delete</a>
                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
                <div style="text-align: right">
                    {{ $tasks->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

    </div>
@endsection
