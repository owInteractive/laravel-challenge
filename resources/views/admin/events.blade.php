@extends('adminlte::page')

@section('title', 'Eventos')

@section('content_header')
    <h1>
        <a href="{{ route('events.index') }}" class="btn btn-sm btn-default @if($days === "All Events") bg-gradient-secondary @endif">All Events</a>
        <a href="{{ route('events.today') }}" class="btn btn-sm btn-default  @if($days === "Today Events") bg-gradient-secondary @endif">Today Events</a>
        <a href="{{ route('events.lastdays') }}" class="btn btn-sm btn-default  @if($days === "Events next 5 days") bg-gradient-secondary @endif">Events next 5 days</a>
        <a href="{{ route('events.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> New Event</a>
        <a href="{{ route('eventsimport') }}" class="btn btn-sm btn-info"> Import Events</a>
        <a class="btn btn-sm btn-info" href="{{ route('export') }}"><i class="fas fa-file-export"></i> Export Events</a>
    </h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
                @foreach($events as $event)
                <tr>
                    <td>{{$event->title}}</td>
                    <td>{{ date('d/m/Y', strtotime($event->start_date)) }}</td>
                    <td>{{ date('d/m/Y', strtotime($event->end_datetime)) }}</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-user-plus"></i> Invite Friends</a>                    
                        <a href="{{ route('events.edit', ['event' => $event->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-danger" id="{{ $event->id }}">
                            <i class="fas fa-trash">
                            </i> Delete
                        </button>
                    </td>
                </tr>
                @endforeach
        </table>
    </div>
</div>

<div class="modal fade" id="modal-danger">
    <div class="modal-dialog modal-lg">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Delete Event</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this event?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
          <form id="delete_event" method="POST" action="">
            @method('DELETE')
            @csrf
            <button class="btn btn-outline-light">Yes</button>
        </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

{{ $events->links() }}

@endsection