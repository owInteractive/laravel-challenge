@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container">
        <div class="col-md-12 justify-content-md-center">
            <div class="card">
                <div class="card-body">    
                <form action="{{ route('event.update',$event->id) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group text-center">
                            <label class="label-control">Titulo Evento</label>
                            <input type="text" class="form-control  text-center"  name="titulo" value="{{ $event->titulo }}">
                        </div>
                        <div class="form-group text-center">
                                <label class="label-control">Descrição Evento</label>
                                <input type="text" class="form-control  text-center"  name="descricao" value="{{ $event->descricao }}">
                            </div>
                            <div class="row">
                                    <div class="form-group col-md-6 text-center">
                                            <label class="label-control">Data Inicio</label>
                                            <input type="text" id="datepicker" class="form-control text-center" name="dataInicio" value='{{ $event->dataInicio }}'/>
                                        </div>
                                        <div class="form-group col-md-6 text-center">
                                                <label class="label-control">Data Fim</label>
                                                <input type="text" id="datepicker1" class="form-control text-center" name="dataFim" value='{{ $event->dataFim }}'/>
                                         </div>
                            </div>
                            <br>
                        <div class="text-center">
                            <input type="submit" class="btn btn-success" value="Atualizar">
                            <a href="{{ route('home') }}">
                                <input type="button" class="btn btn-danger" value="Voltar">
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


 
