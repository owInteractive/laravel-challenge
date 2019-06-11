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
                                <a href="{{ route('admin.events.export', ['type_event' => 'all']) }}" class="btn btn-primary">
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
                                <a href="{{ route('admin.events.export', ['type_event' => 'today']) }}" class="btn btn-primary">
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
                                <a href="{{ route('admin.events.export', ['type_event' => 'next_five_days']) }}" class="btn btn-primary">
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
    </div>
@endsection
