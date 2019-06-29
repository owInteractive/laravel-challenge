@extends('bredicoloradmin::layouts.controle')

@section('content')
    <!-- begin breadcrumb -->
    @component('bredicoloradmin::components.migalha')
        <li class="breadcrumb-item"><a href="{{ route('controle.event.index') }}">Events Today</a></li>
    @endcomponent
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Events Today</h1>
    <!-- end page-header -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-green-lighter">
                <div class="stats-icon"><i class="fa fa-clock"></i></div>
                <div class="stats-info">
                    <h4>TOTAL EVENTS TODAY</h4>
                    <p>{{ $events->count() }}</p>	
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
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            </div>
            <h4 class="panel-title">Events Today</h4>
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
                            <td>
                                @if(\Carbon\Carbon::now() > \Carbon\Carbon::parse($event->end))
                                    <label class="label label-danger">{{ $event->title}}</label>
                                @else
                                    {{ $event->title}}
                                @endif
                            </td>
                            <td>{{ $event->description }}</td>
                            <td>{{ $event->start }}</td>
                            <td>{{ $event->end }}</td>
                            <td class="with-btn" nowrap="">
                                @if ($event->user_id == auth()->user()->id)
                                    
                                        <a href="{{ route('controle.event.edit', $event->id) }}" class="btn btn-sm btn-primary width-60 m-r-2">Edit</a>
                                    
                                @else
                                    <a href="{{ route('controle.event.show', $event->id) }}" class="btn btn-sm btn-primary width-60 m-r-2">View</a>
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
                
            </table>
        </div>
    </div>
    <!-- end panel -->
@stop