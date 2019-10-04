@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="panel panel-default justify-content-center col-sm-6">
            <h3 class="text-center">Reset Password</h3>
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    
                    </div>

                    <div class="container d-flex justify-content-center">
                    
                        <button type="submit" class="btn btn-secondary">
                            Send Password Reset Link
                        </button>
                    
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
