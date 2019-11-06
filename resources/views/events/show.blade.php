@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">       
            <ol class="breadcrumb">
                <li><a href="{{url('/home')}}">Home</a></li>
                <li><a href="{{route('events.index')}}">Events</a></li>
                <li class="active">Show</li>           
            </ol>        
        </div>
        <div class="row">
            <div class="panel panel-default">
                @if(Gate::allows('update', $event) && Gate::allows('delete', $event) )
                <div class="panel-heading">
                    @can('update', $event)
                        <a href="{{route('events.edit', $event->id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit Event</a>
                    @endcan
                    @can('invite', $event)
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalInvite">
                            <span class="glyphicon glyphicon-send" aria-hidden="true"></span> Invite attendee
                        </a>
                    @endcan
                    @can('delete', $event)
                        <a href="" id="delete-event" class="pull-right btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Remove</a>
                        <form id="delete-form" action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                    @endcan                  
                </div>
                @endif
                <div class="panel-body">
                    <h1 class="event-title">
                        <small><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></small>  
                        {{$event->title}}
                    </h1>
                    <h4 class="text-muted">
                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span> {{ $event->start_at->format('d/m/Y h:m:s') }} - {{ $event->start_at->format('d/m/Y h:m:s') }}
                        · <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Created by <a href="{{route('users.show', $event->owner->id)}}">{{ $event->owner->name }}</a>
                    </h4>
                    <div class="event-description">
                        {{$event->description}}
                    </div>
                </div>
            </div>           
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Attendees ({{count($event->attendees)}})</div>
                @if(count($event->attendees)>0)
                    <div class="panel-body">
                        <table class="table table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subscribed at</th>
                                    <!-- <th>Actions</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($event->attendees as $attendee)
                                    <tr>
                                        <td>
                                            <a href="{{route('users.show', $attendee->id)}}">{{ $attendee->name }}</a>
                                        </td>
                                        <td class="text">
                                            <a href="{{route('users.show', $attendee->id)}}">
                                            <span>{{ $attendee->email }}</span>
                                            </a>
                                        </td>
                                        <td>{{$attendee->pivot->created_at}}</td>
                                        <!-- <td>
                                            @can('update', $event)
                                                Edit
                                            @endcan
                                        </td> -->
                                    </tr>
                                @endforeach    
                            </tbody>
                        </table>
                        
                    </div>
                @else
                    <div class="panel-body text-center">
                        <h4>There is no attendee for this event yet.</h4>
                        @can('invite', $event)
                        <a href="" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalInvite"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> Invite attendee for this event</a>
                        @endcan
                    </div>
                @endif               
            </div>           
        </div>
    </div>

    <div class="modal fade" id="modalInvite" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <form method="POST" action="{{route('events.invite', $event->id)}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Invite a friend to this event</h4>
                </div>
                <div class="modal-body">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Insert a valid email">
                            </div>
                        </div>
                    </div>                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><span aria-hidden="true" class="glyphicon glyphicon-send"></span> Send invite</button>
                </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </form>
    </div>
@endsection

@section('scripts')
<script>
    $(function () {
        $("#delete-event").click(function (e) {
            e.preventDefault();
            var confirm_value = confirm('Are you sure you want to delete this event?');
            
            if (confirm_value)
                $('#delete-form').submit();
        })
    });
</script>
@endsection