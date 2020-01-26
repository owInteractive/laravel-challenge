@extends('adminlte::page')

@section('title', 'Eventos')

@section('content_header')
    <h1 class="m-0 text-dark">Eventos</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5><i class="icon fas fa-ban"></i> Erro!</h5>
        {{ $message }}
      </div>
    @endif
    @if ($messageerror = Session::get('error'))
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Erro!</h5>
        {{ $messageerror }}
      </div>

    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div style="text-align:left;" class="col-md-6">
                      <a class="btn btn-success" href="{{ route('events.create') }}"> Criar Novo</a>
                    
                    </div>
                    <div style="text-align:right;" class="col-md-6">
                      <a class="btn btn-success" href="{{ route('events.import') }}"> Importar</a>
                      <a class="btn btn-info" href="{{ route('events.export') }}"> Exportar</a>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>                  
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Início</th>
                        <th>Fim</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($events as $event)
                            <tr>
                                <td>{{$event->id}}.</td>
                                <td>{{$event->title}}</td>
                                <td>{{$event->description}}</td>
                                <td>{{$event->start}}</td>
                                <td>{{$event->end}}</td>
                                <td>
                                  <form action="{{ route('events.destroy',$event->id) }}" method="POST">
   
                                    <a class="btn btn-info" href="{{ route('events.show',$event->id) }}">Show</a>
                    
                                    <a class="btn btn-primary" href="{{ route('events.edit',$event->id) }}">Edit</a>
                   
                                    @csrf
                                    @method('DELETE')
                      
                                    <button type="submit" class="btn btn-danger">Delete</button>

                                  <a class="btn btn-success" href="#" onclick="chooseEvent('{{$event->title}}','{{$event->description}}','{{route('/events')}}')"  data-toggle="modal" data-target="#myModal">Compartilhar</a>

                                </form>
                                {{-- <a href="{{ route('events.edit',$event->id) }}" class="btn btn-secondary">Editar</a>
                                <a href="{{ route('events.destroy',$event->id) }}" class="btn btn-danger">Deletar</a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>

                  {{$events->links()}}
                </div>


                <!-- /.card-body -->
                {{-- <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">«</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                  </ul>
                </div> --}}
              </div>
        </div>
    </div>


    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Compartilhar</h4>
      </div>
      <div class="modal-body">
        <ul>
          <li style="list-style-type: none;">
            <a class="btn btn-app" onclick="shareEvent('whats')">
              <i class="fas fa-barcode"></i> Whatsapp
            </a>
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

@stop

<script>

let eventDetails = {
  title: '',
  description: '',
  url:''
};

function chooseEvent(title, description, url){
  eventDetails.description = description;
  eventDetails.title = title;
  eventDetails.url = url;
}

function shareEvent(by){

  let message= `Você foi convidado para o evento ${eventDetails.title} - ${eventDetails.description}. Clique no link e confirme sua presença: ${eventDetails.url}`

  window.open(
    'https://api.whatsapp.com/send?text='+message,
    '_system', 'location=yes'); 
    return false;
}
</script>