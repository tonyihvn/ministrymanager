@extends('layouts.theme')

@section('content')
    @php $modal="accounthead"; @endphp

    <h3 class="page-title">Account Heads | <small style="color: green">All Account Heads</small></h3>
    <div class="row">
            <div class="panel">
                <div class="panel-heading">

                        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#accounthead">Add New</a>


                </div>
                <div class="panel-body">
                    <table class="table  responsive-table">
                        <thead>
                            <tr style="color: ">
                                <th>Title</th>
                                <th>Category</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accountheads as $account)

                                <tr
                                    @if ($account->category=="Inflow")
                                        style="background-color: azure !important;"
                                    @endif
                                >
                                    <td>{{$account->title}}</td>
                                    <td>{{$account->category}}</td>
                                    <td>{{$account->type}}</td>
                                    <td>{{$account->description}}</td>
                                    <td><button class="label label-primary" id="ach{{$account->id}}" onclick="accountHead({{$account->id}})"  data-toggle="modal" data-target="#accounthead" data-title="{{$account->title}}" data-category="{{$account->category}}" data-type="{{$account->type}}" data-description="{{$account->description}}">Edit</button>
                                    <a href="/delete-acch/{{$account->id}}" class="label label-danger"  onclick="return confirm('Are you sure you want to delete {{$account->title}}\'s financial account head?')">Delete</a>
                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>

    </div>


    <!-- Button to Open the Modal -->


  <!-- The Modal -->
  <div class="modal" id="accounthead">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Account Head</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

            <form method="POST" action="{{ route('addaccounthead') }}">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" name="title" id="title" class="form-control" placeholder="e.g. Electricity BIlls, Diesel, Tithes">
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category"  class="form-control" id="category">
                        <option value="Inflow">Inflow / Income</option>
                        <option value="Expenditure">Expenditure</option>
                        <option value="Others">Others</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <input type="text" name="type" id="type" class="form-control" placeholder="e.g. Checks, Cash, Bank Transfers">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" class="form-control" placeholder="e.g. This is for fules and diesels">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Add Account Head') }}
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
