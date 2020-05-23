@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __("auth.login") }}
        </div>
        <form method="POST" action="{{ url('login') }}">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group {{ $errors->has('email') ? ' has-warning' : '' }}">
                    <label for="email">E-mail:</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder=""
                           aria-describedby="helpId" required>
                    @if ($errors->has('password'))
                        <span class="form-text">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password') ? ' has-warning' : '' }}">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder=""
                           aria-describedby="helpId" required>
                    @if ($errors->has('password'))
                        <span class="form-text">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>
                <button type="submit" class="btn btn-info"><i class="fas fa-sign-in-alt mr-1"></i>{{ __("auth.login") }}</button>
            </div>
        </form>
    </div>
@endsection
