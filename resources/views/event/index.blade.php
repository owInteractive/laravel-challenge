@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="form-group">
      <div class="col-md-5">
        <a href="{{ route('event.filter','all')}}" class="btn btn-default">All events</a>
        <a href="{{ route('event.filter','five')}}" class="btn btn-default">Week's events</a>
        <a href="{{ route('event.filter','today')}}" class="btn btn-default">Today's events</a>
      </div>
      <div class="col-md-1 col-md-offset-4"><a href="{{ route('export.all')}}" class="btn btn-success">Export all</a>
      </div>
      <div class="col-md-1"><a href="{{ route('import')}}" class="btn btn-success">Import</a>
      </div>
      <div class="col-md-1"><a href="{{ route('event.show', 0)}}" class="btn btn-primary">New event</a>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}
      </div><br />
      @endif
      <table class="table table-striped">
        <thead>
          <tr>
            <td>Start</td>
            <td>Title</td>
            <td>End</td>
            <td>Description</td>
            <td colspan="2">Action</td>
          </tr>
        </thead>
        <tbody>
          @foreach($events as $event)
          <tr>
            <td>
              {{\Carbon\Carbon::parse($event->start_datetime)->format('d/m/Y')}}<br>
              at: {{\Carbon\Carbon::parse($event->start_datetime)->format('H:i')}}
            </td>
            <td><strong class="text-info">{{$event->title}}</strong></td>
            <td>
              {{\Carbon\Carbon::parse($event->end_datetime)->format('d/m/Y')}}<br>
              at: {{\Carbon\Carbon::parse($event->end_datetime)->format('H:i')}}
            </td>
            <td>{{$event->description}}</td>
            <td><a href="{{ route('event.show',$event->id)}}" class="btn btn-primary">Edit</a></td>
            <td><a href="{{ route('export.single', $event->id)}}" class="btn btn-success">Export</a></td>
            <td><a href="{{ route('invite', $event->id)}}" class="btn btn-default">Send invites</a></td>
            <td>
              <form method="POST" action="{{ route('event.destroy', $event->id)}}">
                <div class="hidden">
                  @csrf
                  @method('DELETE')
                  {!! method_field('delete') !!}
                  {!! csrf_field() !!}
                </div>
                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $events->links() }}
      <div>
        @endsection