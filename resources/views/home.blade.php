@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if(count($invites)>0)
                        You have invites to events
                        <table class="table table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>Event</th>
                                    <th>Date</th>
                                    <th>Author</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invites as $invite )
                                    <tr>
                                        <td>{{ $invite->event->title }}</td>
                                        <td>{{ $invite->event->start_at->format('d/m/Y') }}</td>
                                        <td><a href="{{route('users.show', $invite->event->owner->id)}}">{{ $invite->event->owner->name }}</a></td>
                                        <td>
                                            <a href="{{route('events.accept_invite', [$invite->event->id, $invite->token])}}" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Accept invite">
                                                <span aria-hidden="true" class="glyphicon glyphicon-ok"></span> 
                                            </a>
                                            <a href="{{route('events.reject_invite', [$invite->event->id, $invite->token])}}" id="reject-event" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Reject invite">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>    
                    @else
                        Your are logged in!    
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()

        $('#reject-event').click(function(e) {
            return confirm('Are you sure you want to reject this invite?');            
        });
    })
</script>
@endsection
