@extends('layout')
@section('title')
EVENTOS
@endsection

@section('content')
@auth


<div class="container">
<div class="bg-white p-5 shadow rounded">
<div><h1>PROGRAMA TUS ACTIVIDADES</h1></div>
<div>A continuación pordras visualizar, agregar, actualizar y eliminar tus actividades:</div>
@if(session('status'))
{{ session('status')}}
@endif
<hr>
   
    <ul class="list-group">
        @forelse($editar as $EventoTtem)
            <li class="list-group-item mb-3 shadow-sm">
            <a class="d-flex justify-content-between aling-items-center" 
            href="{{ route('Datos.show', $EventoTtem) }}">
            <span>{{ $EventoTtem->title}}</span>
            <span class="text-secondary">{{ $EventoTtem->created_at->format('d/m/y - H:i')}}</span>
            </a></li>
    
    @empty
    <li class="list-group-item mb-3 shadow-sm">En el momento no tenemos informacion</li>

        @endforelse
        {{ $editar->links() }}
        @auth
        <br>
        
        <a class="btn btn-primary btn-lg btn-block" href= "{{ route('Datos.crear') }}">Crear evento</a>
        <br>
        <a class="btn btn-outline-secondary" href="/exportar">Descarga tus eventos</a>
        <br>
        <form action="{{ route('importar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(Session::has('message'))
            <p>{{ Session::get('message') }}</p>
            @endif
            <button class="btn btn-outline-secondary btn-block">Sube tu información</button>
            <input  type="file" name="file" accept=".csv">
            <br>
            </div>      
        </form>

   

        
       

               </form>
      
          </div>
                  
        
        <div>
    @endauth
    </lu>
</div>
@endauth
@endsection
   