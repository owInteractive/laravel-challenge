@extends('adminlte::page')

@section('title', 'Meu Perfil')

@section('content_header')
    <h1>My Profile</h1>
@endsection

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <h4>Error</h4>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
        </ul>
    </div>
@endif

<div class="card"> 
    <div class="card-body">
        <form method="POST" id="form_edit" action="{{ route('profile.update') }}">
            @method('PUT')
            @csrf      
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$profile->name}}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$profile->email}}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">New Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="password_confirmation" class="col-sm-2 col-form-label">Password Confirmation</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{$profile->password_confirmation}}" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                    <input type="submit" class="btn btn-success" value="Salvar">
            </div>
        </form>
    </div>
</div>
@endsection