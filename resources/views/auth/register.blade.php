@extends('layouts.app', ['bodyClass' => 'bg-gradient-primary'])

@section('content')
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Name" value="{{ old('name') }}">

                                    @if ($errors->has('name'))
                                        <small class="mt-2 pl-3 text-danger">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </small>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <small class="mt-2 pl-3 text-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </small>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="password_confirmation" name="password_confirmation" placeholder="Repeat Password">
                                    </div>
                                    <div class="col-sm-12">
                                        @if ($errors->has('password'))
                                            <small class="mt-2 pl-3 text-danger">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
