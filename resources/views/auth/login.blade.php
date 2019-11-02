@extends('layouts.dashboard.app')

@section('content')

<!-- Begin page -->
<div class="accountbg bg-dark"></div>

<div class="wrapper-page account-page-full">

    <div class="card">
        <div class="card-block">

            <div class="account-box">

                <div class="card-box">
                    <h2 class="text-uppercase text-center pb-4">
                        <a href="/" class="text-dark">
                            <span>{{config('app.name') }}</span>
                        </a>
                    </h2>

                    <form method="POST" action="{{ route('login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="email">{{ __('labels.Email') }}</label>

                                <input id="email" type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                    value="{{ old('email') }}" required autofocus>

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

                                @if (Route::has('password.request'))
                                <a class="text-muted pull-right" href="{{ route('password.request') }}">
                                    <small>{{ __('messages.Forgot Your Password?') }}</small>
                                </a>
                                @endif

                                <input id="password" type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <div class="checkbox checkbox-custom">
                                    <input type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('messages.Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row text-center m-t-10">
                            <div class="col-12">
                                <button type="submit" class="btn btn-block btn-dark waves-effect waves-light">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="row m-t-10">
                        <div class="col-sm-12 text-center">
                            <p class="text-muted">{{ __('labels.NewtoHere') }} <a href="{{route('register')}}"
                                    class="text-dark m-l-5"><b>{{ __('labels.SingUp') }}</b></a></p>
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