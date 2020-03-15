@extends('layouts.auth.page')

@section('content-login')
    <div class="col-lg-4 col-sm-12 m-auto">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                @include('flash::message')
            </div>
        </div>
        <form class="card auth_form"
              method="POST"
              action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="header">
                <h5>@lang('system.text.login')</h5>
            </div>
            <div class="body">
                <div class="input-group mb-3">
                    <input type="email"
                           class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                           placeholder="@lang('system.text.email')"
                           autofocus
                           value="{{ old('email') }}"
                           name="email"
                           required>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <em class="zmdi zmdi-account-circle"></em>
                        </span>
                    </div>
                    @if ($errors->has('email'))
                        <label id="email-error"
                               class="error"
                               for="email"><strong>{{ $errors->first('email') }}</strong></label>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="password"
                           class="form-control"
                           placeholder="@lang('system.text.password')"
                           name="password"
                           id="password"
                           required>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <em class="zmdi zmdi-lock"></em>
                        </span>
                    </div>
                    @if ($errors->has('password'))
                        <label id="password-error"
                               class="error"
                               for="password"><strong>{{ $errors->first('password') }}</strong></label>
                    @endif
                </div>
                <div class="checkbox">
                    <input type="checkbox"
                           name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">@lang('system.text.remember_me')</label>
                </div>
                <button type="submit"
                        class="btn btn-success btn-block waves-effect waves-light">
                    @lang('system.text.login')
                </button>
                <div class="text-center">
                    <a href="{{ route('register') }}"
                       class="btn btn-primary btn-block waves-effect waves-light">
                        @lang('system.text.i_new_here')
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
