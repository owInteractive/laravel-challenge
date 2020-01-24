@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Eventos</h1>
@stop

@section('content')

    <div class="row">
      <div class="col-lg-12 margin-tb">
          <div class="pull-left">
              <h2></h2>
          </div>
          <div class="pull-right">
              <a class="btn btn-success" href="{{ route('events.create') }}"> Criar</a>
          </div>
          <div class="pull-right">
            <a class="btn btn-success" href="{{ route('events.import') }}"> Importar</a>
        </div>
      </div>
    </div>

    <div class="row">
        <div class="col-12">

          @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
          @endif


            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Eventos</h3>
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
