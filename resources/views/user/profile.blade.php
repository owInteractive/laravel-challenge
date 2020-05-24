@extends('layouts.app')

@section('card-header')
    {{ __('profile.title') }}
@endsection

@section('card-body')
    <form method="POST" action="{{ url('update_profile') }}" id="profileUpdate">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('name') ? ' has-warning' : '' }}">
            <label for="name">{{ __("profile.form.name") }}:</label>
            <input type="text" name="name" id="name" class="form-control" placeholder=""
                   aria-describedby="helpId" value="{{ Auth::user()->name }}" required>
            @if ($errors->has('name'))
                <span class="form-text">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('email') ? ' has-warning' : '' }}">
            <label for="email">{{ __("profile.form.email") }}:</label>
            <input type="email" name="email" id="email" class="form-control" placeholder=""
                   aria-describedby="helpId" value="{{ Auth::user()->email }}" required>
            @if ($errors->has('email'))
                <span class="form-text">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </form>
@endsection

@section('card-footer')
    <button type="submit" class="btn btn-info" onclick="document.getElementById('profileUpdate').submit()">
        <i class="fas fa-user-plus mr-1"></i>{{ __("profile.update") }}
    </button>
@endsection