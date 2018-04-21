@extends('layouts.app')

@section('content')
    <div id="page-head">

    </div>


    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <div class="row">
            <div class="col-sm-6 col-lg-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $user->first_name . ' '. $user->last_name}}</h3>
                    </div>

                    <!--Block Styled Form -->
                    <!--===================================================-->
                    <form>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label class="control-label">Firstname</label>
                                        <input disabled name="first_name" type="text" class="form-control" value="{{ $user->first_name }}">
                                        @if ($errors->has('first_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        <label class="control-label">Lastname</label>
                                        <input disabled  name="last_name" type="text" class="form-control" value="{{ $user->last_name  }}">
                                        @if ($errors->has('last_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="control-label">Email</label>
                                        <input disabled name="email" type="email" class="form-control" value="{{ $user->email  }}">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                        <label class="control-label">Address</label>
                                        <input disabled name="address" type="text" class="form-control" value="{{ $user->address  }}">
                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                                        <label class="control-label">City</label>
                                        <input disabled  name="city" type="text" class="form-control" value="{{ $user->city  }}">
                                        @if ($errors->has('city'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('province') ? ' has-error' : '' }}">
                                        <label class="control-label">Province</label>
                                        <select disabled name="province" alt="Province" id="province" class="form-control">
                                            <option value="" selected="selected">Select Province</option>
                                            @foreach ($provinces as $key => $value)
                                                <option value="{{$key}}" {{ ($user->province == $key) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
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
                                        <input disabled name="postal_code" type="text" class="form-control" value="{{ $user->postal_code  }}">
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
                                        <input disabled name="phone" type="text" class="form-control" value="{{ $user->phone  }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('program_id') ? ' has-error' : '' }}">
                                        <label class="control-label">Program</label>
                                        <select disabled name="program_id" alt="Program"  class="form-control">
                                            <option value="" selected="selected">Select Program</option>
                                            @foreach ($programs as $program)
                                                <option value="{{$program->id}}" {{ ($user->program_id == $program->id)? 'selected' : '' }}>{{$program->name}}</option>
                                            @endforeach

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
                                        <select disabled name="role_id" alt="Role"  class="form-control">
                                            <option value="" selected="selected">Select Role</option>
                                            @foreach ($roles as $role)
                                                @if(isset($user->roles[0]))
                                                    <option value="{{$role->id}}" {{ ($user->roles[0]->id == $role->id) ? 'selected' : '' }}>{{$role->name}}</option>
                                                @else
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endif
                                            @endforeach

                                        </select>
                                        @if ($errors->has('role_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('role_id') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="panel-footer text-right">
                            <a href="{{ url('/admin/staffs') }}" class="btn btn-default" type="submit">Back</a>
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

@endsection
