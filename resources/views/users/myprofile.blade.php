@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <span class="badge badge-danger badge-pill">
                {{ $error }}
            </span>
        @endforeach
    @endif
    @if( \Session::has('message') )
        <span id="success" class="badge badge-success badge-pill">
            {{ \Session::get('message') }}
        </span>
    @endif
    
    <form method="POST" action="{{ route('users.update', ['user'=>Auth::id(), 'id'=>$user->id]) }}" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        {!! csrf_field() !!}
        <div class="form-group">
            <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <input class="form-control" type="text" name="email" id="email" value="{{$user->email}}">
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="password" id="password">
        </div>
        <div class="form-group">
            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>        
        </div>
        <button type="submit" id="submit" class="btn btn-primary"> Save </button>
        <button class="fadeIn fourth btn btn-danger" href="{{ route('users.destroy', ['user'=>Auth::id(), 'id'=>$user->id]) }}"
            onclick="event.preventDefault();
            document.getElementById('delete-form').submit();"> 
            Apagar
        </button>
    </form>
    <form id="delete-form" method="POST" action="{{ route('users.destroy', ['user'=>Auth::id(), 'id'=>$user->id]) }}" enctype="multipart/form-data" style="display:none;">
        {{ method_field('DELETE') }}
        {!! csrf_field() !!}
    </form>
   
  
</div>
@endsection