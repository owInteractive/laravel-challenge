@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __("auth.login") }}
        </div>
        <form method="POST" action="{{ url('register') }}">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group {{ $errors->has('name') ? ' has-warning' : '' }}">
                    <label for="name">{{ __("auth.name") }}:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder=""
                           aria-describedby="helpId" required>
                    @if ($errors->has('name'))
                        <span class="form-text">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('email') ? ' has-warning' : '' }}">
                    <label for="email">{{ __("auth.email") }}:</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder=""
                           aria-describedby="helpId">
                    @if ($errors->has('email'))
                        <span class="form-text">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password') ? ' has-warning' : '' }}">
                    <label for="password">{{ __("auth.password") }}:</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder=""
                           aria-describedby="helpId" required>
                    @if ($errors->has('password'))
                        <span class="form-text">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password_confirmation') ? ' has-warning' : '' }}">
                    <label for="password_confirmation">{{ __("auth.password_confirmation") }}:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder=""
                           aria-describedby="helpId" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="form-text">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-info"><i class="fas fa-user-plus mr-1"></i>{{ __("auth.register") }}</button>
            </div>
        </form>
    </div>
@endsection
