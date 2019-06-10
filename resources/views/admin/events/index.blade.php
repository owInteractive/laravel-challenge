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

                <div class="panel panel-default">
                    <div class="panel-heading">Eventos</div>

                    <div class="panel-body">

                        <div class="text-right">
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
                                            <a href="#" class="btn btn-danger">Excluir</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{ $events->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
