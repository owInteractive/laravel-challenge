@extends('adminlte::page')

@section('title', 'Eventos')

@section('content_header')
    <h1 class="m-0 text-dark">Eventos</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
      <div class="alert alert-success">
          <p>{{ $message }}</p>
      </div>
    @endif
    @if ($messageerror = Session::get('error'))
      <div class="alert alert-danger">
          <p>{{ $messageerror }}</p>
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
@stop
