@extends('bredicoloradmin::layouts.controle')

@section('content')
    <!-- begin breadcrumb -->
    @component('bredicoloradmin::components.migalha')
        <li class="breadcrumb-item"><a href="{{ route('controle.event.index') }}">Events</a></li>
    @endcomponent
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Events</h1>
    <!-- end page-header -->

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-green-lighter">
                <div class="stats-icon"><i class="fa fa-clock"></i></div>
                <div class="stats-info">
                    <h4>TOTAL EVENTS TODAY</h4>
                    <p>{{ $eventsToday->count() }}</p>	
                </div>
                <div class="stats-link">
                    <a href="{{ route('controle.event.today') }}">View List</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-blue-lighter">
                <div class="stats-icon"><i class="fa fa-calendar"></i></div>
                <div class="stats-info">
                    <h4>TOTAL EVENTS IN 5 DAYS</h4>
                    <p>{{ $eventsNextDays->count() }}</p>	
                </div>
                <div class="stats-link">
                    <a href="{{ route('controle.event.nextDays') }}">View List</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-grey-lighter">
                <div class="stats-icon"><i class="fa fa-calendar"></i></div>
                <div class="stats-info">
                    <h4>TOTAL EVENTS</h4>
                    <p>{{ $events->total() }}</p>	
                </div>
                <div class="stats-link">
                    <a href="javascript:;">View List</a>
                </div>
            </div>
        </div>
    </div>

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                
                <a href="{{ route('controle.event.create') }}" class="btn btn-xs btn-circle2 btn-success"><i class="fa fa-plus"></i> New Event</a>
                
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            </div>
            <h4 class="panel-title">Events</h4>
        </div>
        <div class="panel-body">
            <table class="table table-striped m-b-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Start</th>
                        <th>End</th>
                        <th width="1%">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @if($events->count() > 0)
                        @foreach($events as $event)
                        <tr>
                            <td>{{ $event->title}}</td>
                            <td>{{ $event->description}}</td>
                            <td>{{ $event->start}}</td>
                            <td>{{ $event->end}}</td>
                            <td class="with-btn" nowrap="">
                                @if ($event->user_id == auth()->user()->id)

                                        <a href="{{ route('controle.event.edit', $event->id) }}" class="btn btn-sm btn-primary width-60 m-r-2">Edit</a>
                                    
                                @else
                                    <a href="{{ route('controle.event.show', $event->id) }}" class="btn btn-sm btn-primary width-60 m-r-2">View</a>
                                @endif

                                @if ($event->user_id == auth()->user()->id)

                                        <a href="javascript:void(0)" data-url="{{ route('controle.event.destroy', $event->id) }}" class="btn btn-sm btn-white width-60 atencao">Delete</a>
                                    
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="5">
                            Nenhum registro foi encontrado.
                        </td>
                    </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            {{ $events->links() }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- end panel -->
@stop