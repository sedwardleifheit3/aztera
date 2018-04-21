@extends('layouts.app')

@section('content')
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

        <div id="page-title">
            <h1 class="page-header text-overflow">Staff</h1>

        </div>

        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}">Home</a></li>
            <li><a href="{{ route('staffs.index') }}">Staffs</a></li>
            <li class="active">Add New</li>
        </ol>
    </div>


    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <div class="row">
            <div class="col-sm-6 col-lg-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add New</h3>
                    </div>

                    <!--Block Styled Form -->
                    <!--===================================================-->
                    <form method="POST" action="{{ url('/admin/staffs') }}">
                        {{ csrf_field() }}
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label class="control-label">Firstname</label>
                                        <input name="first_name" type="text" class="form-control" value="{{ old('first_name') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        <label class="control-label">Lastname</label>
                                        <input name="last_name" type="text" class="form-control" value="{{ old('last_name') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="control-label">Email</label>
                                        <input name="email" type="email" class="form-control" value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                        <label class="control-label">Address</label>
                                        <input name="address" type="text" class="form-control" value="{{ old('address') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                                        <label class="control-label">City</label>
                                        <input name="city" type="text" class="form-control" value="{{ old('city') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('province') ? ' has-error' : '' }}">
                                        <label class="control-label">Province</label>
                                        <select name="province" alt="Province" id="province" class="form-control">
                                            <option value="" selected="selected">Select Province</option>
                                            <option value="AB">Alberta</option>
                                            <option value="BC">British Columbia</option>
                                            <option value="MB">Manitoba</option>
                                            <option value="NB">New Brunswick</option>
                                            <option value="NL">Newfoundland and Labrador</option>
                                            <option value="NT">Northwest Territories</option>
                                            <option value="NS">Nova Scotia</option>
                                            <option value="NU">Nunavut</option>
                                            <option value="ON">Ontario</option>
                                            <option value="PE">Prince Edward Island</option>
                                            <option value="QC">Quebec</option>
                                            <option value="SK">Saskatchewan</option>
                                            <option value="YT">Yukon</option>
                                        </select>
                                        @if ($errors->has('province'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('province') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('postal_code') ? ' has-error' : '' }}">
                                        <label class="control-label">Postal Code</label>
                                        <input name="postal_code" type="text" class="form-control" value="{{ old('postal_code') }}">
                                        @if ($errors->has('postal_code'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('postal_code') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label class="control-label">Phone</label>
                                        <input name="phone" type="text" class="form-control" value="{{ old('phone') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('program_id') ? ' has-error' : '' }}">
                                        <label class="control-label">Program</label>
                                        <select name="program_id" alt="Program"  class="form-control">
                                            <option value="" selected="selected">Select Program</option>
                                            <option value="1">Example</option>
                                        </select>
                                        @if ($errors->has('program_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('program_id') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('role_id') ? ' has-error' : '' }}">
                                        <label class="control-label">Role</label>
                                        <select name="role_id" alt="Role"  class="form-control">
                                            <option value="" selected="selected">Select Role</option>
                                            <option value="1" >Example</option>
                                        </select>
                                        @if ($errors->has('role_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('role_id') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12 -col-sm-6">
                                    <hr class="new-section-sm bord-no">
                                    <p class="text-main text-bold mar-no">Access</p>
                                    <hr class="new-section-sm bord-no">

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label class="control-label">Password</label>
                                        <input name="password" type="password" class="form-control">
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Confirm Password</label>
                                        <input id="password-confirm" name="password_confirmation" type="password" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-right">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                    <!--===================================================-->
                    <!--End Block Styled Form -->

                </div>
            </div>
        </div>
    </div>
    <!--===================================================-->
    <!--End page content-->
    {{--
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    --}}
@endsection
