@extends('layouts.app')

@section('content')

    <div class="card mt-3">
        <div class="row">
            <div class="col-md-6">
                <form action="/profile/update" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{Auth::user()->name}}"
                        >
                    </div>

                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{Auth::user()->email}}"
                        >
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>

            <div class="col-md-6 mt-4 mt-md-0 border-left">

                <form action="/profile/changePassword" method="post">

                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" name="current_password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="new_password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" name="confirm_new_password" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Change Password</button>

                </form>

            </div>

        </div>

    </div>

@endsection