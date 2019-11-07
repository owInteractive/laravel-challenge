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
                        <div class="col-md-12"><strong>Member since: </strong>{{ $user->created_at}}</div>
                        <div class="col-md-12"><strong>Last update: </strong>{{ $user->updated_at}}</div>
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
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-4">
                            <span aria-hidden="true" class="glyphicon glyphicon-calendar"></span> 
                            Events ({{count($user->events)}})
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <form class="d-inline clearfix" action="{{route('events.export')}}" enctype="multipart/form-data">
                        <button type="submit" class="btn btn-md btn-default">
                            <span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span>
                            Export events
                        </button>
                        <a class="float-left btn btn-md btn-default" data-toggle="modal" data-target="#modalImport">
                            <span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span>
                            Import events
                        </a>
                    </form>
                    
                    <br>

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
                                        <td>{{$event->start_at}}</td>
                                        <td>{{$event->end_at}}</td>
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