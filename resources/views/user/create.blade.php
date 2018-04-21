@extends('layouts.app')

@section('content')
    <div id="page-head"></div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add New</h3>
                    </div>

                    <!--Block Styled Form -->
                    <!--===================================================-->
                    <form method="POST" action="{{ route('users.store') }}">
                        {{ csrf_field() }}
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label class="control-label">Name</label>
                                        <input name="name" type="text" class="form-control" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="control-label">Email</label>
                                        <input  name="email" type="email" class="form-control" value="{{  old('email')   }}">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('role_id') ? ' has-error' : '' }}">
                                        <label class="control-label">Role</label>
                                        <select name="role_id" alt="Role"  class="form-control">
                                            <option value="" selected="selected">Select Role</option>
                                            @foreach ($roles as $role)
                                                @if(old('role_id') !== null)
                                                <option value="{{$role->id}}" {{ (old('role_id') == $role->id) ? 'selected' : '' }}>{{$role->name}}</option>
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
                                <div class="col-lg-12 -col-sm-6">
                                    <hr class="new-section-sm bord-no">
                                    <p class="text-main text-bold mar-no">Password</p>
                                    <hr class="new-section-sm bord-no">

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label class="control-label">New Password</label>
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
                                        <input id="password-confirm" name="password_confirmation" type="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-right">
                            <a href="/configurations" class="btn btn-danger" type="submit">Cancel</a>
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

@endsection
