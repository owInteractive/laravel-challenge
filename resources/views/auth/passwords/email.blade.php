@extends('layouts.dashboard.app')

@section('content')


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
                    <div class="text-center m-b-20">
                        <p class="text-muted m-b-0"> {{__('messages.EnterYourEmail')}} </p>
                    </div>
                    <form method="POST" action="{{ route('password.email') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="emailaddress">Email</label>
                                <input id="email" type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                    value="{{ old('email') }}" required placeholder="email@example.com">

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row text-center m-t-10">
                            <div class="col-12">
                                <button class="btn btn-block btn-custom btn-dark waves-effect waves-light"
                                    type="submit">{{ __('labels.ResetPassword') }}</button>
                            </div>
                        </div>

                    </form>
                    <div class="row m-t-10">
                        <div class="col-sm-12 text-center">
                            <p class="text-muted">{{ __('labels.BackTo') }} <a href="{{route('login')}}"
                                    class="text-dark m-l-5"><b>Login</b></a></p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="m-t-40 text-center">
        <p class="account-copyright"><?= date('Y') ?> © {{config('app.name') }}</p>
    </div>

</div>
@endsection