@extends('layouts.app')

@section('content')
<div class="container card">
    <h2 class="text-center">My Profile</h2>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <span class="badge badge-danger badge-pill">
                {{ $error }}
            </span>
        @endforeach
    @endif
    @if( \Session::has('message') )
        <span id="success" class="badge badge-secondary badge-pill">
            {{ \Session::get('message') }}
        </span>
    @endif
    
    <form method="POST" action="{{ route('users.update', ['user'=>Auth::id(), 'id'=>$user->id]) }}" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}" required maxlength="250">
        </div>
        <div class="form-group">
            <label for="name">Email</label>
            <input class="form-control" type="text" name="email" id="email" value="{{$user->email}}" required maxlength="250">
        </div>
        <div class="form-group">
            <label for="name">Password</label>
            <input class="form-control" type="password" name="password" id="password" required minlength="6">
        </div>
        <div class="form-group">
            <label for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required minlength="6">        
        </div>
        <div class="container d-flex justify-content-center display-inline">
            <button type="submit" id="submit" class="btn btn-secondary"> Update </button>
            <button class="fadeIn fourth btn btn-danger" href="{{ route('users.destroy', ['user'=>Auth::id()]) }}"
                onclick="event.preventDefault();
                document.getElementById('delete-form').submit();"> 
                Delete
            </button>
        </div>
    </form>
    <form id="delete-form" method="POST" action="{{ route('users.destroy', ['user'=>Auth::id()]) }}" enctype="multipart/form-data" style="display:none;">
        {{ method_field('DELETE') }}
        {!! csrf_field() !!}
    </form>
   
  
</div>
@endsection