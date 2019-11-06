@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <a href="{{url(route('events.create'))}}" class="btn btn-primary btn-lg">Create New Event</a>
        </div>
        <!-- TODAY EVENTS -->
        <div class="row">
            <h1><small><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></small> Today events</h1>
            <div class="list-group">
            @forelse ($events_today as $event)
                <a href="{{route('events.show',$event->id)}}" class="list-group-item list-group-item-action">                    
                    <small class="text-muted">{{ $event->start_at->format('h:m:s') }}</small>
                    <strong>{{$event->title}}</strong>
                    <small class="pull-right help-block"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ $event->owner->name }}</small>
                    
                </a>
            @empty
                <li class="list-group-item">There is no evento for next 5 days</li>    
            @endforelse
            </div>
        </div>
        <!-- NEXT 5 DAYS -->
        <div class="row">
            <h1><small><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></small> Next 5 days events</h1>
            <div class="list-group">
            @forelse ($events_next as $event)
                <a href="{{route('events.show',$event->id)}}" class="list-group-item list-group-item-action">
                    <small class="text-muted">{{ $event->start_at->format('d/m/Y h:m:s') }}</small>
                    <strong>{{$event->title}}</strong>
                    <small class="pull-right help-block"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ $event->owner->name }}</small>
                </a>
            @empty
                <li class="list-group-item">There is no evento for next 5 days</li>    
            @endforelse
            </div>
        </div>
        <!-- ALL EVENTS -->
        <div class="row">
            <h1><small><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></small> All events</h1>
            <div class="list-group">
                @forelse ($events as $event)
                    <a href="{{route('events.show',$event->id)}}" class="list-group-item list-group-item-action">
                        <small class="text-muted">{{ $event->start_at->format('d/m/Y') }}</small>
                        <strong>{{$event->title}}</strong>
                        <small class="pull-right help-block"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ $event->owner->name }}</small>
                    </a>
                @empty
                    <li class="list-group-item">There is no evento for next 5 days</li>    
                @endforelse
            </div>
            <div>
                {{ $events->links() }}
            </div>
        </div>
    </div>  
@endsection