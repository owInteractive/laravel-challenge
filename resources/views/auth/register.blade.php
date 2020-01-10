@extends('layout')

@section('content')

    <div class="card mt-3">

        <div class="card-header d-flex justify-content-between">
            <span class="align-self-center">Sign up</span>

            <div>
                <a href="/login" class="btn btn-primary btn-sm">Sign in</a>
            </div>

        </div>

        <div class="card-body">

            <form method="post">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" name="name" class="form-control" id="inputName" placeholder="Name">
                </div>

                <div class="form-group">
                    <label for="inputEmail">E-mail</label>
                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="E-mail">
                </div>

                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                </div>

                <div class="form-group">
                    <label for="inputPasswordConfirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirmation" placeholder="Confirm Password">
                </div>

                <button type="submit" class="btn btn-primary">Sign up</button>

            </form>

        </div>

    </div>
    
@endsection