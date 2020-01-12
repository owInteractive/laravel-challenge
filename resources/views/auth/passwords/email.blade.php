@extends('layout')

@section('content')

    @if (session('status'))
        <div class="alert alert-success mt-3">
            {{ session('status') }}
        </div>
    @endif

    <div class="card mt-3">

        <div class="card-header d-flex justify-content-between">
            <span class="align-self-center">Forgot password?</span>

            <div>
                <a href="/register" class="btn btn-secondary btn-sm">Sign up</a>
                <a href="/login" class="btn btn-primary btn-sm">Sign in</a>
            </div>

        </div>

        <div class="card-body">

            <form method="post" action="{{ route('password.email') }}">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="inputEmail">E-mail</label>
                    <input type="email" name="email" class="form-control" id="inputEmail"
                           placeholder="E-mail" value="{{ old('email') }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Send Password Reset Link</button>

            </form>

        </div>

    </div>
@endsection