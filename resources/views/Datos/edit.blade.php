@extends('layout')

@section('content')
@auth


<div class="container">
<div class="row">
        <div class="col-12 sm-10 col-lg-6 mx-auto">


<form class="bg-white py-3 px-4 shadow rounded" method="post" action="{{ route('Datos.update', $editar) }}">
<div><h1>MODIFICAR EVENTO</h1></div>
    <hr>
@method('patch')
@include('partials.errorvalidacion')
@include('Datos.formulario',['btnText'=> 'Actualizar'] )

</form>
</div>
</div>
</div>
@endauth
@endsection