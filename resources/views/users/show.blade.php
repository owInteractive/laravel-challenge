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
            <div class="panel panel-default">
                {{$user->name}}
            </div>           
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Events ({{count($user->events)}})</div>
                <div class="panel-body">
                    @isset($events)
                        <table class="table table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>Event</th>
                                    <th>Description</th>
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