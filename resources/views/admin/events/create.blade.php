@extends('layouts.app')
@section('title', 'Novo Evento | ')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('admin.events.index') }}">Eventos</a></li>
                    <li class="active">Novo Evento</li>
                </ol>

                <hr>

                @if($errors->all())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session()->exists('message'))
                    <div class="alert alert-{{ session()->get('type') }}">
                        {{ session()->get('message') }}
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">Novo Evento</div>

                    <form action="{{ route('admin.events.store') }}" method="post">
                        <div class="panel-body">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="">Título: </label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                            </div>

                            <div class="form-group">
                                <label for="">Descrição: </label>
                                <textarea name="description" rows="5" cols="30" class="form-control">{{ old('description') }}</textarea>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <label for="">Data Início: </label>
                                        <input type="date" name="date_start" class="form-control" value="{{ old('date_start') }}">
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="">Data Término: </label>
                                        <input type="date" name="date_end" class="form-control" value="{{ old('date_end') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer text-right">
                            <a href="{{ route('admin.events.index') }}" class="btn btn-default">
                                Retornar
                            </a>
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
