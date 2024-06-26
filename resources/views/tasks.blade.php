@extends('layouts.theme')

@section('content')

<style>
    @media only screen and (max-width: 800px) {
        /* Force table to not be like tables anymore */
        #no-more-tables table,
        #no-more-tables thead,
        #no-more-tables tbody,
        #no-more-tables th,
        #no-more-tables td,
        #no-more-tables tr {
        display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        #no-more-tables thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
        }

        #no-more-tables tr { border: 1px solid #ccc; margin-bottom: 5px; }

        #no-more-tables td {
        /* Behave like a "row" */
        border: none;
        border-bottom: 1px solid #eee;
        position: relative;
        padding-left: 22%;
        white-space: normal;
        text-align:left;
        }

        #no-more-tables td:before {
        /* Now like a table header */
        position: absolute;
        /* Top/left values mimic padding */
        top: 6px;
        left: 6px;
        width: 75%;
        padding-right: 1px;
        white-space: nowrap;
        text-align:left;
        font-weight: bold;
        }

        /*
        Label the data
        */
        #no-more-tables td:before { content: attr(data-title); }
    }
</style>
    @php $pagetype="report"; @endphp

    <h3 class="page-title">Tasks | <small style="color: green">TO DOs</small></h3>
    <div class="row">
        <div class="panel">

            <div class="panel-body">
                <div id="no-more-tables">
                    <table class="table  responsive-table" id="products" style="font-size: 0.9em">
                        <thead>
                            <tr style="color: ">
                                <th>Title</th>
                                <th>Details</th>
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
                                    <td data-title="Title: "><b>{{ $task->title }}</b></td>
                                    <td data-title="Details: ">{{ $task->activities }}</td>
                                    <td data-title="Member: ">{{ is_numeric($task->member) ? $users->where('id', $task->member)->first()->name : $task->member }}
                                    </td>
                                    <td data-title="Date: ">{{ $task->date }}</td>
                                    <td data-title="Status: ">{{ $task->status }}</td>
                                    <td data-title="Assigned To: ">{{ is_numeric($task->assigned_to) ? $users->where('id', $task->assigned_to)->first()->name : $task->assigned_to }}
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
                </div>
                <div style="text-align: right">
                    {{ $tasks->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

    </div>
@endsection
