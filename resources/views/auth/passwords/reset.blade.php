@extends('layouts.dashboard.app')

@section('content')
<div class="accountbg bg-dark"></div>

<div class="wrapper-page account-page-full">

    <div class="card">
        <div class="card-block">

            <div class="account-box">

                <div class="card-box p-5">
                    <h2 class="text-uppercase text-center pb-4">
                        <a href="/" class="text-dark">
                            <span>{{config('app.name') }}</span>
                        </a>
                    </h2>
                    <div class="text-center m-b-20">
                        <p class="text-muted m-b-0">Reset your password</p>
                    </div>
                    <form method="post" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{$token}}">

                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="email">Email</label>

                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="password">Password</label>

                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row text-center m-t-10">
                            <div class="col-12">
                                <button class="btn btn-block btn-dark btn-custom waves-effect waves-light" type="submit">Reset Password</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>

        </div>
    </div>

    <div class="m-t-40 text-center">
        <p class="account-copyright"><?= date('Y') ?> © {{config('app.name') }}</p>
    </div>

</div>
@endsection
