@extends('adminlte::page')

@section('title', 'Eventos - Criar')

@section('content_header')
    <h1 class="m-0 text-dark">Criar Evento</h1>
    {{-- <ol class="breadcrumb float-sm-right">
        <li class=""><a href="/home">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/events">Eventos</a></li>
        <li class="breadcrumb-item active"><a href="#">Criar</a></li>
    </ol> --}}

@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('events.store') }}" method="POST" >
                        @csrf

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Data/Hora Início</label>
                                <input type="date" name="start" class="form-control" placeholder="Data/Hora Início">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Data/Hora Término</label>
                                <input type="date" name="end" class="form-control" placeholder="Data/Hora Término">
                            </div>
                        </div>

                        <div class="col-md-12 form-group">
                            <input type="text" name="title" id="" class="form-control" placeholder="Título">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" name="description" id="" class="form-control col-md-12" placeholder="Descrição">
                        </div>

                        <button type="submit" class="btn btn-block btn-success">Salvar</button>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
