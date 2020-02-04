@extends('layouts.app')
@section('content')
<div class="container-fluid">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    @if ($message = Session::get('error'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="col-md-12">
        <h4>Change Profile</h4>
        <form method="post" action="{{route('users.update')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Name</label>
                <input type="text" class="form-control" name="name"  value="{{ $user->name }}" required />
            </div>
            <div class="form-group">
                <label for="title">E-mail</label>
                <input type="email" class="form-control" name="email"  value="{{ $user->email }}" required />
            </div>
            <div class="form-group">              
                <label for="title">Password</label>
                <input type="password" class="form-control"  name="password" pattern=".{6,}" title="Six or more characters" required/>
            </div>
            <div class="form-group">     
                <label for="title">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" pattern=".{6,}" title="Six or more characters" minlength="6" required />
            </div>  
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection