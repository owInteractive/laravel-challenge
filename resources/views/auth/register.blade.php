@extends('layout')

@section('title', 'OW Calendar | Register')

@section('content')

    <div class="card mt-3">

        <div class="card-header d-flex justify-content-between">
            <span class="align-self-center">Sign up</span>

            <div>
                <a href="/login" class="btn btn-primary btn-sm">Sign in</a>
            </div>

        </div>

        <div class="card-body">

            <form method="post" action="{{ route('register') }}">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" name="name" class="form-control" id="inputName"
                           placeholder="Name" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="inputEmail">E-mail</label>
                    <input type="email" name="email" class="form-control" id="inputEmail"
                           placeholder="E-mail" value="{{ old('email') }}" required>
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

                <button type="submit" class="btn btn-primary">Register</button>

            </form>

        </div>

    </div>
    
@endsection