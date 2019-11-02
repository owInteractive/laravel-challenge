@extends('layouts.dashboard.app')

@section('content')

<!-- Begin page -->
<div class="accountbg bg-dark"></div>

<div class="wrapper-page account-page-full">

    <div class="card">
        <div class="card-block">

            <div class="account-box">

                <div class="card-box">
                    <h2 class="text-center pb-4">
                        <a href="/" class="text-dark">
                            <span>{{config('app.name') }}</span>
                        </a>
                    </h2>

                    <form method="POST" class="form-horizontal" action="{{ route('register') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="name">{{ __('labels.FullName') }}</label>
                                <input id="name" type="text"
                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                    value="{{ old('name') }}" required autofocus
                                    placeholder="{{ __('placeholders.FullName') }}">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="email">{{ __('labels.Email') }}</label>

                                <input id="email" type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                    value="{{ old('email') }}" required placeholder="{{ __('placeholders.Email') }}">

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="password">{{ __('labels.Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" required placeholder="{{ __('placeholders.Password') }}">
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="password-confirm">{{ __('labels.ConfirmPassword') }}</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required
                                    placeholder="{{ __('placeholders.ConfirmPassword') }}">
                            </div>
                        </div>

                        <div class="form-group row text-center m-t-10">
                            <div class="col-12">
                                <button type="submit" class="btn btn-block btn-custom waves-effect waves-light btn-dark"
                                    type="submit">
                                    {{ __('labels.Register') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="row m-t-10">
                        <div class="col-sm-12 text-center">
                            <p class="text-muted">{{ __('labels.AlreadyHas') }} <a href="{{route('login')}}"
                                    class="text-dark m-l-5"><b>{{ __('labels.Enter') }}</b></a></p>
                        </div>
                    </div>

                    <div class="text-center m-t-20">
                        <p>{{ __('labels.Year') }} © {{config('app.name') }}</p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>



@endsection