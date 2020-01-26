@extends('adminlte::page')

@section('title', 'Eventos - Show')
@section('content_header')
    <h1 class="m-0 text-dark">Detalhes do Evento</h1>
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
                    <fieldset>
                        <legend style="border-bottom:1px solid black;">
                            Período
                        </legend>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Início:</h4>
                                {{date('d-m-Y H:i:s',strtotime($event->start))}}
                            </div>
                            <div class="col-md-6">
                                <h4>Fim:</h4>
                                {{date('d-m-Y H:i:s',strtotime($event->end))}}
                            </div>
                        </div>
                    </fieldset>

                    <fieldset style="margin-top:20px;" >
                        <legend style="border-bottom:1px solid black;">
                            Evento
                        </legend>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Nome:</h4>
                                {{$event->title}}
                            </div>
                            <div class="col-md-6">
                                <h4>Descrição:</h4>
                                {{$event->description}}
                            </div>
                        </div>
                    </fieldset>
                    
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Presenças confirmadas:</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Nome do Convidado</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($event->confirmations as $confirmation)
                                <tr>
                                    <td>
                                    {{$confirmation->name}}                    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                   
                </div>
            </div>
        </div>
    </div>

@stop
