@extends('layout')

@section('content')

    @if (session('status'))
        <div class="alert alert-success mt-3">
            {{ session('status') }}
        </div>
    @endif

    <div class="card mt-3">

        <div class="card-header d-flex justify-content-between">
            <span class="align-self-center">Reset your password</span>
        </div>

        <div class="card-body">

            <form method="post" action="{{ route('password.request') }}">

                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="inputEmail">E-mail</label>
                    <input type="email" name="email" class="form-control" id="inputEmail"
                           placeholder="E-mail" value="{{ $email or old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword"
                           placeholder="Password" required>
                </div>

                <div class="form-group">
                    <label for="inputPasswordConfirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control"
                           id="inputPasswordConfirmation" placeholder="Confirm Password" required>
                </div>

                <button type="submit" class="btn btn-primary">Reset Password</button>

            </form>

        </div>

    </div>

@endsection