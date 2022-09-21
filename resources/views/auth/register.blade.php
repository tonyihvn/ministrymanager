@extends('layouts.login-theme')

@section('content')

                    <div class="card">
                        <div class="card-header">
                            <h4 c>Sign Up</h4>
                        </div>
                        <div class="card-body">



                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <select class="form-control" name="settings_id" id="settings_id">

                                            <option value="1" selected>Select Church</option>

                                            @foreach ($ministrygroups as $ministrygroup)
                                                    @foreach ($ministrygroup->settings as $usrmin)
                                                        <option value="{{$usrmin->id}}">{{$usrmin->ministry_name}}</option>
                                                    @endforeach
                                            @endforeach
                                            <option value="None" style="color: darkOrange;">Not Listed? Add New Church</option>

                                        </select>
                                    </div>
                                </div>

                                <div id="newministry_box">
                                    <span style="color: darkOrange; font-size: 0.8em;">&Not; Note: This ministry will undergo verification process</span>

                                    <input type="hidden" name="newministry" id="newministry" value="Yes">

                                    <div class="form-group col-md-12">
                                        <label for="ministrygroup_id"  class="control-label ">Ministry</label>
                                        <select class="form-control" name="ministrygroup_id" id="ministrygroup_id">

                                            @foreach ($ministrygroups as $mg)
                                                <option value="{{$mg->id}}">{{$mg->ministry_group_name}}</option>
                                            @endforeach
                                            <option value="1">Others</option>

                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="ministry_name">Church Name</label>
                                        <input type="text" name="ministry_name" id="ministry_name" class="form-control" value="{{$settings->ministry_name}}">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="motto">Motto</label>
                                        <input type="text" name="motto" id="motto" class="form-control" value="{{$settings->motto}}">
                                    </div>

                                    <div class="form-group  col-md-12">
                                        <label for="min_address">Address</label>
                                        <input type="text" name="min_address" id="min_address" class="form-control" value="{{$settings->address}}">
                                    </div>

                                    <input type="hidden" name="mode" value="InActive">


                                </div>

                                <div class="row">
                                    <h4>User Info</h4><div class="form-group col-lg-12">
                                        <label for="name" class="control-label sr-only">{{ __('Name') }}</label>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="Full Name">

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="dob" class="control-label sr-only">Date of Birth</label>
                                            <input id="dob" name="dob" type="text" class="form-control datepicker" placeholder="Date of Birth">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="gender"  class="control-label sr-only">Gender</label>
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="" selected>Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label for="about"  class="control-label sr-only">About Member</label>
                                        <textarea name="about" class="form-control" placeholder="About Member" rows="4"></textarea>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group col-lg-12">
                                        <label for="address" class="control-label sr-only">Address</label>
                                            <input id="address" name="address" type="text" class="form-control" placeholder="Address">
                                    </div>

                                </div>



                                <div class="row">

                                    <div class="form-group col-lg-6 col-sm-12">
                                        <label for="phone_number" class="control-label sr-only">{{ __('Phone Number') }}</label>


                                            <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}"  autocomplete="phone_number" autofocus placeholder="Phone Number">

                                            @error('phone_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                    </div>

                                    <div class="form-group col-lg-6 col-sm-12">
                                        <label for="email" class="control-label sr-only">{{ __('E-Mail Address') }}</label>


                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="E-mail">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                    </div>


                                </div>

                                <div class="row">

                                    <div class="form-group col-lg-6">
                                        <label for="password" class="control-label sr-only">{{ __('Password') }}</label>


                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Password">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="password-confirm" class="control-label sr-only">{{ __('Confirm Password') }}</label>


                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="Confirm Password">

                                    </div>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror


                                </div>

                                <div class="form-group row mb-0">

                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Sign Up') }}
                                        </button> <br>
                                        Already had an account? <a href="{{url('login')}}">Login</a>

                                </div>

                            </form>


                        </div>

                    </div>


@endsection
