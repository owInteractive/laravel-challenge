@extends('layouts.template')

@section('content')
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
                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    
                      <input type="text" class="form-control form-control-user" id="name" placeholder="Tell me your name" name="name" value="{{ old('name') }}" required autofocus>

                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                    </div>
                    
                  <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control form-control-user" id="email" placeholder="Put your email here"name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="password" class="form-control form-control-user" id="password" placeholder="What is the password ?"name="password" required>

                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="col-sm-6">
                      <input type="password" class="form-control form-control-user" id="password-confirm" placeholder="Can you repeat?"name="password_confirmation" required>
                    </div>
                  </div>
                  <button type='submit' class="btn btn-primary btn-user btn-block">
                    Register Account
                  </button>
                  
                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                </div>
                <div class="text-center">
                  <a class="small" href="{{ route('login') }}">Oh take me to the Login page!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
