@extends('layouts.theme')
@php $users = $hmembers @endphp
@section('content')

                    <div class="card">
                        <div class="card-header">
                            Add New Member
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Please Enter Required Fields</h4>

                            <form method="POST" action="{{ route('addnew') }}">

                                <div class="row">


                                    @csrf
                                    <input type="hidden" name="id" value="{{$user->id}}">

                                    <div class="col-md-4">


                                        <div class="form-group row">
                                            <label for="name" class="control-label ">{{ __('Name') }}</label>


                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}"  autocomplete="name" autofocus placeholder="Full Name">

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="dob" class="control-label ">Date of Birth</label>
                                                    <input id="dob" name="dob" type="date" class="form-control" value="{{ $user->dob }}" placeholder="Date of Birth">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="gender"  class="control-label ">Gender</label>
                                                <select class="form-control" name="gender" id="gender">
                                                    <option value="{{ $user->gender }}" selected>{{ $user->gender }}</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label for="phone_number" class="control-label ">{{ __('Phone Number') }}</label>


                                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $user->phone_number }}"  autocomplete="phone_number" autofocus placeholder="Phone Number">

                                                @error('phone_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                        </div>


                                        <div class="form-group row">
                                            <label for="about"  class="control-label ">About Member</label>
                                            <textarea name="about" class="form-control" placeholder="About Member" rows="4">{{ $user->about }}</textarea>
                                        </div>




                                    </div>
                                    <div class="col-md-3  col-md-offset-1">


                                        <div class="form-group row">
                                            <label for="address" class="control-label ">Address</label>
                                                <input id="address" name="address" type="text" value="{{ $user->address }}" class="form-control" placeholder="Address">
                                        </div>

                                        <div class="form-group row">
                                            <label for="location" class="control-label ">Location</label>
                                                <input id="location" name="location" type="text" class="form-control" value="{{ $user->location }}" placeholder="Location">
                                        </div>

                                        <div class="form-group row">
                                            <label for="house_fellowship"  class="control-label ">Closest House Fellowship</label>
                                            <select class="form-control" name="house_fellowship" id="house_fellowship">
                                            <option value="">Closest House Fellowship</option>
                                            <option value="{{ $user->house_fellowship }}" selected>{{ $user->house_fellowship }}</option>
                                            @foreach ($house_fellowships as $hfellowship)
                                                <option value="{{$hfellowship->name}}">{{$hfellowship->name}}</option>
                                            @endforeach


                                            </select>
                                        </div>

                                        <div class="form-group row">
                                            <label for="invited_by"  class="control-label ">Invited By</label>
                                            <select class="form-control" name="invited_by" id="invited_by">
                                                <option value="" >Invited By</option>
                                                <option value="{{ $user->invited_by }}" selected>{{ $user->invited_by!="" ? \App\Models\User::select('name')->where('id',$user->invited_by)->first()->name :'' }}</option>
                                                @foreach ($users as $usr)
                                                    <option value="{{$usr->id}}">{{$usr->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="form-group row">
                                            <label for="assigned_to"  class="control-label ">Assigned To</label>
                                            <select class="form-control" name="assigned_to" id="assigned_to">
                                                <option value="{{ $user->assigned_to }}" selected>{{  $user->assigned_to !="" ?  \App\Models\User::select('name')->where('id',$user->assigned_to)->first()->name :'' }}</option>
                                                @foreach ($users as $usr)
                                                    <option value="{{$usr->id}}">{{$usr->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-md-offset-1">


                                        <div class="form-group row">
                                            <label for="ministry"  class="control-label ">Ministry</label>
                                            <select class="form-control" name="ministry" id="ministry">
                                            <option value="{{ $user->ministry }}" selected>{{ $user->ministry }}</option>
                                            @foreach ($ministries as $ministry)
                                                <option value="{{$ministry->name}}">{{$ministry->name}}</option>
                                            @endforeach


                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label for="age_group"  class="control-label ">Age Group</label>
                                            <select class="form-control" name="age_group" id="age_group">
                                                <option value="{{ $user->age_group }}" selected>{{ $user->age_group }}</option>
                                                <option value="Children Also">Children Also</option>
                                                <option value="Teenager">Teenager</option>
                                                <option value="Youth">Youth</option>
                                                <option value="CWL">CWL</option>
                                                <option value="TKM">TKM</option>
                                            </select>
                                        </div>

                                        <div class="form-group row">
                                            <label for="status"  class="control-label ">Member Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="{{ $user->status }}" selected>{{ $user->status }}</option>
                                                <option value="Member">Member</option>
                                                <option value="New Member">New Member</option>
                                                <option value="Evangelised">Evangelised</option>
                                                <option value="Outreached">Outreached</option>
                                                <option value="Minister">Minister</option>
                                                <option value="Worker">Worker</option>
                                                <option value="Security">Security</option>
                                                <option value="Not Reachable">Not Reachable</option>
                                                <option value="Backslided">Backslided</option>

                                            </select>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="control-label ">{{ __('E-Mail Address') }}</label>


                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}"  autocomplete="email" placeholder="E-mail">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="control-label ">{{ __('Password') }}</label>
                                                <input type="hidden" name="oldpassword" value="{{ $user->password }}">

                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password"placeholder="Password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                        </div>

                                        <div class="form-group row">
                                            <label for="password-confirm" class="control-label ">{{ __('Confirm Password') }}</label>


                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password"  placeholder="Confirm Password">

                                        </div>

                                        <div class="form-group row">
                                            <label for="role"  class="control-label sr-only">Role</label>
                                            <select class="form-control" name="role" id="role">
                                                <option value="{{$user->role}}" selected>{{$user->role}}</option>
                                                <option value="Member">Member</option>
                                                <option value="Admin">Admin</option>
                                                <option value="Usher">Usher</option>
                                                <option value="Followup">Followup</option>
                                                <option value="Finance">Finance</option>
                                                @if ($settings->mode=="Maintenance")
                                                <option value="Super">Super</option>
                                                @endif
                                            </select>
                                        </div>


                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-4 col-md-offset-4">
                                        @if ($user->id)

                                            <a href="/delete-member/{{$user->id}}" class="btn btn-danger pull-left" onclick="return confirm('Are you sure you want to delete {{$user->name}}\'s account?')"><i class="fa fa-remove"></i> Delete Member</a>

                                        @endif
                                    </div>
                                    <div class="form-group col-md-4">

                                        <button type="submit" class="btn btn-primary  pull-right">
                                            <i class="fa fa-check"></i>
                                            {{ __('Update Member Info') }}
                                        </button>

                                    </div>

                                </div>

                            </form>


                        </div>
                        <div class="card-footer text-muted">
                            Info:
                        </div>
                    </div>


@endsection
