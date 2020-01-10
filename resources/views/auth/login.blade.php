@extends('layout')

@section('content')
<div class="card mt-3">

    <div class="card-header d-flex justify-content-between">
        <span class="align-self-center">Login</span>

        <div>
            <a href="#" class="btn btn-secondary btn-sm">Forgot password?</a>
            <a href="#" class="btn btn-primary btn-sm">Sign up</a>
        </div>

    </div>

    <div class="card-body">

        <form method="post">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="inputEmail">E-mail</label>
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="E-mail">
            </div>

            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
            </div>

            <button type="submit" class="btn btn-primary">Sign in</button>

        </form>

    </div>

</div>
@endsection