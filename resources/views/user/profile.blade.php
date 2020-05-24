@extends('layouts.app')

@section('card-header')
    {{ __('profile.title') }}
@endsection

@section('card-body')
    <form method="POST" action="{{ url('profile/update') }}" id="profileUpdate">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('name') ? ' has-warning' : '' }}">
            <label for="name">{{ __("profile.form.name") }}</label>
            <input type="text" name="name" id="name" class="form-control" placeholder=""
                   aria-describedby="helpId" value="{{ Auth::user()->name }}" required>
            @if ($errors->has('name'))
                <span class="form-text">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('email') ? ' has-warning' : '' }}">
            <label for="email">{{ __("profile.form.email") }}</label>
            <input type="email" name="email" id="email" class="form-control" placeholder=""
                   aria-describedby="helpId" value="{{ Auth::user()->email }}" required>
            @if ($errors->has('email'))
                <span class="form-text">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </form>
    <form method="POST" action="{{ url('profile/update_password') }}" id="passwordUpdate" class="border-top">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('old_password') ? ' has-warning' : '' }}">
            <label for="old_password">{{ __("profile.form.old_password") }}</label>
            <input type="password" name="old_password" id="old_password" class="form-control" placeholder=""
                   aria-describedby="helpId" required>
            @if ($errors->has('old_password'))
                <span class="form-text">
                    <strong>{{ $errors->first('old_password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('password') ? ' has-warning' : '' }}">
            <label for="password">{{ __("profile.form.password") }}</label>
            <input type="password" name="password" id="password" class="form-control" placeholder=""
                   aria-describedby="helpId" required>
            @if ($errors->has('password'))
                <span class="form-text">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-warning' : '' }}">
            <label for="password_confirmation">{{ __("profile.form.password_confirmation") }}</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder=""
                   aria-describedby="helpId" required>
            @if ($errors->has('password_confirmation'))
                <span class="form-text">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>
    </form>
@endsection

@section('card-footer')
    <button type="submit" class="btn btn-info" onclick="document.getElementById('profileUpdate').submit()">
        <i class="fas fa-user-plus mr-1"></i>{{ __("profile.update") }}
    </button>
    <button type="submit" class="btn btn-warning mx-3" onclick="document.getElementById('profileUpdate').submit()">
        <i class="fas fa-user-plus mr-1"></i>{{ __("profile.update_password") }}
    </button>
@endsection