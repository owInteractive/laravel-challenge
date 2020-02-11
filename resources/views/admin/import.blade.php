@extends('adminlte::page')

@section('title', 'Importar Eventos')

@section('content_header')
    <h1>Import Events</h1>
@endsection

@section('content')
    <div class="card bg-light mt-3">
        <div class="card-body">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control" required>
                <br>
                <button class="btn btn-success">Import</button>                
            </form>
        </div>
    </div>
@endsection