@extends('core.base')

@section('content')

<div class="col-12 pt-4">
       <div class="box-content">
         <div>
             <h2 style="display: inline-block">Eventos</h2>
             <div class="btn-group pl-3" role="group">
               <a class="btn btn-success" href="{{ route('event.index', Event::FILTER_EVENTS_TODAY ) }}" role="button">Hoje</a>
               <a class="btn btn-secondary" href="{{ route('event.index', Event::FILTER_EVENTS_NEXT_5_DAYS ) }}" role="button">Próximos 5 dias</a>
               <a class="btn btn-info" href="{{ route('event.index', Event::FILTER_EVENTS_ALL ) }}" role="button">Todos</a>
               <a class="btn btn-warning" href="{{ route('event.export', $flag) }}" role="button">Exportar CSV</a>
               <a class="btn btn-success" href="{{ route('event.import') }}" role="button">Importar CSV</a>
         </div>

          <span class="btn btn-primary btn-rounded waves-effect waves-light btn-create" style="float:right">
               <a class="btn btn-primary" href="{{ route('event.create') }}" role="button">
                  Novo Evento
               </a>
          </span>
         </div>

         <br>
         @if (session('success'))
             <div class="alert alert-success" style="padding-top: 15px;">
                 {{ session('success') }}
             </div>
          @endif
         <div class="table-responsive">
           <table class="table table-bordered">
             <thead>
               <tr>
                 <th>ID</th>
                 <th>Titulo</th>
                 <th>Inicio</th>
                 <th>Término</th>
                 <th>action</th>
               </tr>
             </thead>
             <tbody>
               <tr>
                 @forelse ($events as $event)
 									<td>{{ $event->id }}</td>
 									<td>{{ $event->title }}</td>
 									<td>{{ date('d/m/Y H:i', strtotime(str_replace('-','/', $event->ts_start))) }}</td>
 									<td>{{ date('d/m/Y H:i', strtotime(str_replace('-','/', $event->ts_end))) }}</td>
 									<td>
 										<button type="button" class="btn btn-primary" onclick="javascript:window.location.href ='{{ route('event.edit', ['id'=> $event->id] ) }}';">Editar</button>&nbsp;
                    <button type="button" class="btn btn-info" onclick="javascript:window.location.href ='{{ route('event.inviteFriend', ['id'=> $event->id] ) }}';">Convidar Amigo</button>&nbsp;
 										<button type="button" class="btn btn-danger btn-xs waves-effect waves-light" onclick="javascript:window.location.href ='{{ route('event.index', ['id'=> $event->id] ) }}';">Delete</button>
 									</td>
 									</tr>
 								@empty
    									 <tr><td colspan="6">Nenhum registro !</td></tr>
 								@endforelse
             </tbody>
           </table>
         </div>
       </div>
     </div>

@endsection
