@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="card">
            <div class="col-md-12">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0"> Lista de Eventos</h4>
                  <p class="card-category"> Todos seus eventos</p>
                </div>
                <div class="row">
                 <a href="{{ route('event.create') }}">
                 <input type="button" class="btn btn-success ml-3 mt-2" value = "Cadastrar Evento">
                </a>
                <a href="{{ route('eventE','csv')}}"  target="_BLANK">
                    <input type="button" class="btn btn-success ml-3 mt-2" value = "Exporta Eventos">
                   </a>
                  <form action="{{ route('importExcel') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                      <input type="file"  class="btn btn-success ml-3 mt-2" name="import_file" required>
                      <a target="_BLANK" >
                        <input type="submit" class="btn btn-primary"  value="Enviar Arquivo">
                      </a>
                      
                    </form>
                </div>
                <div class="card-body">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-secondary active" id="allDay">
                         <input type="radio" name="options" id="allDay" autocomplete="off" checked> Todos Eventos
                        </label>
                        <label class="btn btn-secondary" id="nowDay">
                            <input type="radio" name="options" id="nowDay" autocomplete="off"> Eventos Hoje
                          </label>
                        <label class="btn btn-secondary" id="nextDay">
                          <input type="radio" name="options" id="nextDay" autocomplete="off"> Proximos 5 dias
                        </label>
                        </div>
                        
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class="">
                        <th>ID</th>
                        <th>Titulo Evento</th>
                        <th>Dia</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </thead>
                      <tbody class="eventBody">
                        @foreach ($event as $e)
                            
                        <tr>
                          <td>{{ $e->id }}</td>
                          <td>{{ $e->titulo }}</td>
                          <td>{{ $e->dataInicio }}</td>
                          <td>
                          <a href="{{ route('event.edit',$e->id) }}">
                              <input type="button" value="alterar" class="btn btn-warning">
                            </a>
                          </td>
                          <td>
                              <a href="{{ route('event.destroy',$e->id) }}">
                                  <input type="button" value="excluir" class="btn btn-danger">
                                </a>
                              </td>
                          <td>
                                  <input type="button" value="Convidar" class="btn btn-info convite" data-toggle="modal" data-target="#Modal">
                                  <input type="text"  class ="idConvite" value="{{ $e->id }}" hidden>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{ $event->links() }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<form method="POST" action="{{  route('mail') }}">
  <div class="modal fade" id="Modal" tabindex="-1" role="">
      <div class="modal-dialog modal-login" role="document">
          <div class="modal-content">
              <div class="card card-signup card-plain">
                  <div class="modal-header">
                    <div class="card-header text-center">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="material-icons">clear</i>
                      </button>
                    
                    </div>
                  </div>
                  <div class="modal-body">
                        {{ csrf_field() }}
                          <p class="description text-center">Enviar por E-mail</p>
                          <div class="card-body">
  
                              <div class="form-group col-md-12">
                                <input type="text" class="form-control tagInput" data-role="tagsinput" placeholder="Digite emails para enviar" name="emails" value="" >
                              </div>
                                  <input type="text" name="id" class="idEnviarConvite" value="" hidden>
                          <p class="description text-center">Use tab para adicionar varios E-mail</p>

                              </div>
                              <div class="modal-footer justify-content-center">
                                    <input type="submit" class="btn btn-success envModal" value="Enviar">
                              </div>
                   
                  </div>
              </div>
          </div>
      </div>
  </div>
</form>
@endsection
