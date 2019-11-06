@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">       
            <ol class="breadcrumb">
                <li><a href="{{url('/home')}}">Home</a></li>
                <li><a href="{{route('events.index')}}">Users</a></li>
                <li class="active">Show</li>           
            </ol>        
        </div>
        <div class="row">
            <div class="panel {{ (auth()->user() == $user) ? 'panel-primary': 'panel-default' }}">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> User Details
                    @if(auth()->user() == $user )
                       <strong>(YOU)</strong>
                    @endif
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12"><strong>User Name:</strong> {{ $user->name }}</div>
                        <div class="col-md-12"><strong>Email: </strong>{{ $user->email }}</div>
                        <div class="col-md-12"><strong>Member since: </strong>{{ $user->created_at->format('d/m/Y h:m:s') }}</div>
                        <div class="col-md-12"><strong>Last update: </strong>{{ $user->updated_at->format('d/m/Y h:m:s') }}</div>
                    </div><br>
                    
                    <div class="row">
                        <div class="col-md-12">
                            @can('update', $user )
                                <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary">Update my profile</a>
                            @endcan
                        </div>
                    </div>
                    
                </div>
            </div>           
        </div>
        <div class="row">
            <div class="panel {{ (auth()->user() == $user) ? 'panel-primary': 'panel-default' }}">
                <div class="panel-heading"><span aria-hidden="true" class="glyphicon glyphicon-calendar"></span> Events ({{count($user->events)}})</div>
                <div class="panel-body">
                    @isset($events)
                        <table class="table table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>Event</th>
                                    <th>Description</th>
                                    <th>Author</th>
                                    <th>Starts at</th>
                                    <th>Ends at</th>
                                    <!-- <th>Actions</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td>
                                            <a href="{{route('events.show', $event->id)}}">{{ $event->title }}</a>
                                        </td>
                                        <td class="text">
                                            <a href="{{route('events.show', $event->id)}}">
                                            <span>{{ $event->description }}</span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('users.show', $event->owner->id)}}">
                                            {{ $event->owner->name }}
                                            </a>
                                        </td>
                                        <td>{{$event->start_at->format('d/m/Y')}}</td>
                                        <td>{{$event->end_at->format('d/m/Y')}}</td>
                                        <!-- <td>
                                            @can('update', $event)
                                                Edit
                                            @endcan
                                        </td> -->
                                    </tr>
                                @endforeach    
                            </tbody>
                            
                        </table>
                        {{$events->links()}}
                    @endisset

                    @empty($events)
                        The user doesn't have any events
                    @endempty
                    
                </div>
            </div>           
        </div>
    </div>  
@endsection