@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">       
            <ol class="breadcrumb">
                <li><a href="{{url('/home')}}">Home</a></li>
                <li><a href="{{route('events.index')}}">Events</a></li>                
            </ol>        
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('events.edit', $event->id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit Info</a>
                    <a href="" class="btn btn-primary"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> Invite attendee</a>
                    <a href="" class="pull-right btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Remove</a>
                </div>
                <div class="panel-body">
                    <h1 class="event-title">
                        <small><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></small>  
                        {{$event->title}}
                    </h1>
                    <h4 class="text-muted">
                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span> {{ $event->start_at->format('d/m/Y h:m:s') }} - {{ $event->start_at->format('d/m/Y h:m:s') }}
                        · <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Created by <a href="">{{ $event->owner->name }}</a>
                    </h4>
                    <div class="event-description">
                        {{$event->description}}
                    </div>
                </div>
            </div>           
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Participants (0)</div>
                <div class="panel-body text-center">
                    <h4>There is no attendee for this event</h4>
                    <a href="" class="btn btn-primary"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> Invite attendee for this event</a>
                </div>
            </div>           
        </div>
    </div>  
@endsection