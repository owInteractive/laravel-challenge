@extends('layout')

@section('title', $editar->title)

@section('content')
@auth
<div class="container">
        <div class="bg-white p-5 shadow rounded">

        <div><label><h1>{{ $editar->title }}</h1></div>
            <div>
            <label> Descripcion del evento <p class="text-secondary">{{ $editar->description }}</p></label></div>
            <div>
            <label> Fecha de Inicio <p class="text-secondary">{{ $editar->dataI }}</p></label></div>
            <div>
            <label> Fecha de Fin <p class="text-secondary">{{ $editar->dataF }}</p></label></div>
            <div>
            <label> Creacion del evento <p class="text-secondary">{{ $editar->created_at->diffForHumans() }}</p></label></div>
            <div>
                       
            <a class="btn btn-primary btn-lg btn-block" href="{{ route('Datos.edit', $editar) }}">Editar</a>
            <a class="btn btn-primary btn-lg btn-block " href="#" onclick="document.getElementById('delete-editar').submit()">Eliminar</a>
      
            <form id="delete-editar" method="post" action="{{ route('Datos.eliminar', $editar) }}">
            @csrf @method('delete')
            </form><br>
            <a class="btn btn-outline-secondary btn-block" href="{{ route('Datos.index') }}">Regresar</a>
</div>
</div>
@endauth
@endsection

