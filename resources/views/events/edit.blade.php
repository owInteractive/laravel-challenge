@extends('adminlte::page')

@section('title', 'Eventos - Editar')
@section('content_header')
    <h1 class="m-0 text-dark">Editar Evento</h1>
    {{-- <ol class="breadcrumb float-sm-right">
        <li class=""><a href="/home">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/events">Eventos</a></li>
        <li class="breadcrumb-item active"><a href="#">Criar</a></li>
    </ol> --}}

@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('events.update',$event->id) }}" method="POST" >
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Data/Hora Início</label>
                            <input type="text" name="start" class="form-control" placeholder="Data/Hora Início" value="{{old('start',$event->start)}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Data/Hora Término</label>
                                <input type="text" name="end" class="form-control" placeholder="Data/Hora Término" value="{{old('end',$event->end)}}">
                            </div>
                        </div>

                        <div class="col-md-12 form-group">
                            <input type="text" name="title" class="form-control" placeholder="Título" value="{{old('title',$event->title)}}">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" name="description" class="form-control col-md-12" placeholder="Descrição" value="{{old('description',$event->description)}}">
                        </div>

                        <button type="submit" class="btn btn-block btn-success">Salvar</button>
                        <a href="/events" class="btn btn-block btn-default">Cancelar</a>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
