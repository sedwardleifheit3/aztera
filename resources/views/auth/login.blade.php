@extends('layouts.auth')

@section('content')

<div class="cls-content-sm panel">
    <div class="panel-body">
        <div class="mar-ver pad-btm">
            <h1 class="h3">{{ config('app.name', 'Enartis') }}</h1>
            <p>Sign In to your account</p>
        </div>
        <form  method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}" >
                <input id="email" type="email"  placeholder="Email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="password" placeholder="Password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="checkbox pad-btm text-left">
                <input id="remember-me" class="magic-checkbox" type="checkbox" name="remember" {{ old('remember_me') ? 'checked' : '' }}>
                <label for="remember-me">Remember me</label>
            </div>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
        </form>
    </div>

    <div class="pad-all">
        <a href="{{ route('password.request') }}" class="btn-link mar-rgt">Forgot password ?</a>
        <!--
        <div class="media pad-top bord-top">
            <div class="pull-right">
                <a href="#" class="pad-rgt"><i class="psi-facebook icon-lg text-primary"></i></a>
                <a href="#" class="pad-rgt"><i class="psi-twitter icon-lg text-info"></i></a>
                <a href="#" class="pad-rgt"><i class="psi-google-plus icon-lg text-danger"></i></a>
            </div>
            <div class="media-body text-left text-bold text-main">
                Login with
            </div>
        </div>
        -->
    </div>
</div>
@endsection
