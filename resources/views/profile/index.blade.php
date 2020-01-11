@extends('layout')

@section('content')

    <div class="card mt-3">

        <div class="card-header">
            <span>Profile</span>
        </div>

        <div class="card-body row">

            <div class="col-6">

                <form method="post">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Name"
                               value="{{Auth::user()->name}}">
                    </div>

                    <div class="form-group">
                        <label for="inputEmail">E-mail</label>
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="E-mail"
                               value="{{Auth::user()->email}}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>

                </form>

            </div>

            <div class="col-6 border-left">

                <form method="post">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label for="inputCurrPass">Current Password</label>
                        <input type="password" name="current-password" class="form-control"
                               id="inputCurrPass" placeholder="Current Password">
                    </div>

                    <div class="form-group">
                        <label for="inputNewPass">New Password</label>
                        <input type="password" name="new-password" class="form-control"
                               id="inputNewPass" placeholder="New Password">
                    </div>

                    <div class="form-group">
                        <label for="inputConfNewPass">Confirm New Password</label>
                        <input type="password" name="confirm-new-password" class="form-control"
                               id="inputConfNewPass" placeholder="Confirm New Password">
                    </div>

                    <button type="submit" class="btn btn-primary">Change Password</button>

                </form>

            </div>

        </div>

    </div>

@endsection