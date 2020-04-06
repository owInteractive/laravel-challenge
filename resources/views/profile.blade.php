@extends('template.template')
@section('content')
    <div class="grid">
        @if($errors->any())
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                @foreach ($errors->all() as $error)
                    <span>{{$error}}</span><br>
                @endforeach
            </div>
        @endif
        <form action="{{route('profile')}}" method="POST" class="form login">
            {{ csrf_field() }}
            <div class="col-md-12 form-group">
                <label class="control-label" for="name">Name</label>
                <input value="{{ $user->name }}" id="name" name="name" maxlength="50" type="text" class="form-control" required>
            </div>

            <div class="col-md-12 form-group">
                <label class="control-label" for="email">E-mail</label>
                <input value="{{ $user->email }}" id="email" name="email" maxlength="150" type="email" class="form-control" required>
            </div>

            <div class="col-md-12 form-group">
                <label class="control-label" for="password">Password</label>
                <input value="" id="password" name="password" type="password" class="form-control">
            </div>

            <div class="col-md-12 form-group">
                <label class="control-label" for="password_confirmation">Password Confirmation</label>
                <input value="" id="password_confirmation" name="password_confirmation" type="password" class="form-control">
            </div>

            <div class="col-md-12 form-group">
                <input type="submit" class="btn btn-outline-secondary" value="Update">
            </div>
        </form>

    </div>
@endsection