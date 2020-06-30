@extends('layout')
@section('content')
@auth

<div class="container">
    
    <div class="row">
        <div class="col-12-sm-10 col-lg-6 mx-auto ">
        <form class="bg-white shadow rounded py-3 px-4" method="post" action="{{ route('messages.store') }}">
@csrf
<div><h1>INVITA A TU AMIGO</h1></div>
@if(session('status'))
{{ session('status')}}
@endif
<hr>
    <div class="form-group">
    
    
        <label for="name">Nombre</label>
        <input class="form-control bg-light shadow-sm @error('name') is-invalid @enderror" 
        id="name" 
        name="name" 
        placeholder="Nombre.." 
        value="{{ old('name') }}">

        @error('name')
        <span class="invalid-feedback" role="alerta"><small>{{$message}}</small></span>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Dirección email</label>
        <input class="form-control bg-light shadow-sm @error('email') is-invalid @enderror"
        id="email" 
        type="email" 
        name="email" 
        placeholder="Email.." 
        value="{{ old('email') }}">

        @error('email')
        <span class="invalid-feedback" role="alerta"><small>{{$message}}</small></span>
        @enderror
        
    
    </div> 
        <div class="form-group">
        <label for="subject">Asunto</label>
        <input class="form-control bg-light shadow-sm @error('subject') is-invalid @enderror"
        id="subject"   
        name="subject" 
        placeholder="Asunto..." 
        value="{{ old('subject') }}">

    @error('subject')
        <span class="invalid-feedback" role="alerta"><small>{{$message}}</small></span>
        @enderror

    </div>
    <div class="form-group">
    <label for="content">Informacion</label>
    <textarea class="form-control bg-light shadow-sm @error('content') is-invalid @enderror"
    id="content"
    name="content" 
    placeholder="Mensaje..." 
    value="{{ old('content') }}"></textarea>

        @error('content')
        <span class="invalid-feedback" role="alerta"><small>{{$message}}</small></span>
        @enderror

    </div>
    <button class="bnt btn-primary btn-lg btn-block">@lang('Invitar')</button>
    <a class="btn btn-outline-secondary btn-block" href="{{ route('Datos.index') }}">Regresar</a>


</form>
        
        </div>       
    </div>
</div>

@endauth
@endsection
   