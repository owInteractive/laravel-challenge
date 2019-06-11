@extends('layouts.app')
@section('title', 'Eventos | ')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">Eventos</li>
                </ol>

                <hr>

                @isset($events)
                    <div class="panel panel-default">
                        <div class="panel-heading">Todos os Eventos</div>

                        <div class="panel-body">

                            <div class="text-right">
                                <a href="{{ route('admin.events.export', ['type_event' => 'all']) }}"
                                   class="btn btn-primary">
                                    Download (.csv)
                                </a>
                                <a href="{{ route('admin.events.create') }}" class="btn btn-success">
                                    Novo Evento
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Título</th>
                                        <th>Data Início</th>
                                        <th>Data Término</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($events as $event)
                                        <tr>
                                            <td>{{ $event->id }}</td>
                                            <td>{{ $event->title }}</td>
                                            <td>{{ \App\Models\Event::convertStringToDate($event->date_start) }}</td>
                                            <td>{{ \App\Models\Event::convertStringToDate($event->date_end)  }}</td>
                                            <td>
                                                <a href="{{ route('admin.events.edit', ['event' => $event->id]) }}"
                                                   class="btn btn-warning">Alterar</a>
                                                <a href="#" class="btn btn-danger" data-id="{{$event->id}}"
                                                   data-action="{{ route('admin.events.delete', ['event' => $event->id]) }}"
                                                   onclick="deleteEvent(this)">
                                                    Excluir
                                                </a>
                                                <button type="button" class="btn btn-default" data-id="{{$event->id}}"
                                                        onclick="showModal('modalSendInvite', {{$event->id}})">Convidar
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $events->links() }}
                            </div>


                        </div>
                    </div>
                @endif

                @isset($eventsToday)
                    <div class="panel panel-default">
                        <div class="panel-heading">Eventos de Hoje</div>

                        <div class="panel-body">

                            <div class="text-right">
                                <a href="{{ route('admin.events.export', ['type_event' => 'today']) }}"
                                   class="btn btn-primary">
                                    Download (.csv)
                                </a>
                                <a href="{{ route('admin.events.create') }}" class="btn btn-success">
                                    Novo Evento
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Título</th>
                                        <th>Data Início</th>
                                        <th>Data Término</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($eventsToday as $event)
                                        <tr>
                                            <td>{{ $event->id }}</td>
                                            <td>{{ $event->title }}</td>
                                            <td>{{ \App\Models\Event::convertStringToDate($event->date_start) }}</td>
                                            <td>{{ \App\Models\Event::convertStringToDate($event->date_end)  }}</td>
                                            <td>
                                                <a href="{{ route('admin.events.edit', ['event' => $event->id]) }}"
                                                   class="btn btn-warning">Alterar</a>
                                                <a href="#" class="btn btn-danger" data-id="{{$event->id}}"
                                                   data-action="{{ route('admin.events.delete', ['event' => $event->id]) }}"
                                                   onclick="deleteEvent(this)">
                                                    Excluir
                                                </a>
                                                <button type="button" class="btn btn-default" data-id="{{$event->id}}"
                                                             onclick="showModal('modalSendInvite', {{$event->id}})">Convidar
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $eventsToday->links() }}
                            </div>

                        </div>
                    </div>
                @endif

                @isset($eventsNextFiveDays)
                    <div class="panel panel-default">
                        <div class="panel-heading">Eventos para os próximos 5 dias</div>

                        <div class="panel-body">

                            <div class="text-right">
                                <a href="{{ route('admin.events.export', ['type_event' => 'next_five_days']) }}"
                                   class="btn btn-primary">
                                    Download (.csv)
                                </a>
                                <a href="{{ route('admin.events.create') }}" class="btn btn-success">
                                    Novo Evento
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Título</th>
                                        <th>Data Início</th>
                                        <th>Data Término</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($eventsNextFiveDays as $event)
                                        <tr>
                                            <td>{{ $event->id }}</td>
                                            <td>{{ $event->title }}</td>
                                            <td>{{ \App\Models\Event::convertStringToDate($event->date_start) }}</td>
                                            <td>{{ \App\Models\Event::convertStringToDate($event->date_end)  }}</td>
                                            <td>
                                                <a href="{{ route('admin.events.edit', ['event' => $event->id]) }}"
                                                   class="btn btn-warning">Alterar</a>
                                                <a href="#" class="btn btn-danger" data-id="{{$event->id}}"
                                                   data-action="{{ route('admin.events.delete', ['event' => $event->id]) }}"
                                                   onclick="deleteEvent(this)">
                                                    Excluir
                                                </a>
                                                <button type="button" class="btn btn-default" data-id="{{$event->id}}"
                                                        onclick="showModal('modalSendInvite', {{$event->id}})">Convidar
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $eventsNextFiveDays->links() }}
                            </div>

                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="modal fade" id="modalSendInvite" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Convidar Amigo</h4>
                    </div>
                    <form name="form_send_invite" action="{{route('admin.events.sendInvite')}}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="email" name="guest_email" class="form-control"
                                       placeholder="Informe o melhor e-mail do convidado">

                                <input type="hidden" name="id" id="event_id" value="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
