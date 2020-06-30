@extends('layout')
@section('title')
CONTACTO
@endsection

@section('content')
@auth

<div class="container">
<div class="row">
        <div class="col-12 sm-10 col-lg-6 mx-auto">


@include('partials.errorvalidacion')
<form class="bg-white py-3 px-4 shadow rounded" method="post" action="{{ route('Datos.store') }}">
    <div><h1>CREAR EVENTO</h1></div>
    <hr>
@include('Datos.formulario', ['btnText' => 'Crear'])

</form>
</div>
</div>
</div>
@endauth
@endsection
   