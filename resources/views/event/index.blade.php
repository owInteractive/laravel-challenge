@extends('layouts.app')

@section('content')
<div class="container">
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
            <td>{{$event->date_time_start}}</td>
            <td>{{$event->title}}</td>
            <td>{{$event->date_time_end}}</td>
            <td>{{$event->description}}</td>
            <td><a href="{{ route('event.edit',$event->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
              <form action="{{ route('event.destroy', $event->id)}}" method="post">
                <div class="hidden">
                @csrf
                @method('DELETE')
              </div>
                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div>
        @endsection