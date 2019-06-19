@extends('layouts.template')

@section('content')


<div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">
  
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                <div class="col-lg-6">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-2">Reseting Your Password?</h1>
                      <p class="mb-4">Hey look only you got the link to reset your password enter your new password and remember to write it down somewhere safe! :D</p>
                    </div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                            {{ csrf_field() }}
    
                        <input type="hidden" name="token" value="{{ $token }}">
                      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" class="form-control form-control-user" id="email"  aria-describedby="emailHelp" placeholder="Enter Email Address..."name="email" value="{{ $email or old('email') }}" required autofocus>

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
                      <button type="submit" class="btn btn-primary btn-user btn-block">
                        Reset Password
                      </button>
                    </form>
                    <hr>
                    <div class="text-center">
                      <a class="small" href="{{ route('register') }}">Create an Account!</a>
                    </div>
                    <div class="text-center">
                      <a class="small" href="{{ route('login') }}" >Take me to the login portal!</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
  
        </div>
  
      </div>



@endsection
