@extends('layouts.app')

@section('content')
    @if(count($events)>0)
        <div class="container">
            <div class="row">
                <form class="form-inline clearfix" action="{{route('events.export')}}" enctype="multipart/form-data">
                    <a href="{{url(route('events.create'))}}" class="btn btn-primary btn-md">Create New Event</a>
                    <button type="submit" class="btn btn-md btn-default">
                        <span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span>
                        Export events
                    </button>
                    <a class="float-left btn btn-md btn-default" data-toggle="modal" data-target="#modalImport">
                        <span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span>
                        Import events
                    </a>
                </form>
            </div>
            <!-- TODAY EVENTS -->
            <div class="row">
                <h1><small><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></small> Today events</h1>
                <div class="list-group">
                @forelse ($events_today as $event)
                    <a href="{{route('events.show',$event->id)}}" class="list-group-item list-group-item-action">                    
                        <small class="text-muted">{{ $event->start_at }}</small>
                        <strong>{{$event->title}}</strong>
                        <small class="pull-right help-block"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ $event->owner->name }}</small>
                    </a>
                @empty
                    <li class="list-group-item">There is no events today</li>    
                @endforelse
                </div>
            </div>
            <!-- NEXT 5 DAYS -->
            <div class="row">
                <h1><small><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></small> Next 5 days events</h1>
                <div class="list-group">
                @forelse ($events_next as $event)
                    <a href="{{route('events.show',$event->id)}}" class="list-group-item list-group-item-action">
                        <small class="text-muted">{{ $event->start_at }}</small>
                        <strong>{{$event->title}}</strong>
                        <small class="pull-right help-block"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ $event->owner->name }}</small>
                    </a>
                @empty
                    <li class="list-group-item">There is no events for next 5 days</li>    
                @endforelse
                </div>
            </div>
            <!-- ALL EVENTS -->
            <div class="row">
                <h1><small><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></small> All events</h1>
                <div class="list-group">
                    @forelse ($events as $event)
                        <a href="{{route('events.show',$event->id)}}" class="list-group-item list-group-item-action">
                            <small class="text-muted">{{ $event->start_at }}</small>
                            <strong>{{$event->title}}</strong>
                            <small class="pull-right help-block"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ $event->owner->name }}</small>
                        </a>
                    @empty
                        <li class="list-group-item">There is no events</li>    
                    @endforelse
                </div>
                <div>
                    @if (count($events)>0)
                    {{ $events->links() }}
                    @endisset
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <h1>You don't have any event yet!</h1>
                        <form class="form-inline clearfix" action="{{route('events.export')}}" enctype="multipart/form-data">
                            <a href="{{url(route('events.create'))}}" class="btn btn-primary btn-lg">Create New Event</a> 
                            or
                            <a class="float-left btn btn-lg btn-default" data-toggle="modal" data-target="#modalImport">
                                <span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span>
                                Import events
                            </a>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
            
        </div>
    @endif
    <div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <form method="POST" action="{{route('events.import')}}" enctype="multipart/form-data">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Import Events</h4>
                </div>
                <div class="modal-body">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="events-import">Import events</label>
                                <input type="file" class="form-control" name="events-import">
                            </div>
                        </div>
                    </div>                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span> Import</button>
                </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </form>
    </div>
@endsection