@extends('layouts.app')

@section('content')
<div class="container card">
    <h2 class="text-center">Edit Event</h2>
    @include('layouts.messages')

    <form method="POST" action="{{ route('events.update', ['user'=>Auth::id(), 'id'=>$event->id]) }}" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" value="{{$event->title}}" required maxlength="250">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" required maxlength="5000">{{$event->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="beginDate">Date Event Begin</label>
            <input class="form-control" type="date" name="beginDate" id="beginDate" value="{{date('Y-m-d', strtotime($event->start))}}" required>
            <label for="beginTime">Hour Event Begin</label>
            <input class="form-control" type="time" name="beginTime" id="beginTime" value="{{date('H:i', strtotime($event->start))}}" required>
        </div>
        <div class="form-group">
            <label for="endDate">Date Event End</label>
            <input class="form-control"type="date" name="endDate" id="endDate" value="{{date('Y-m-d', strtotime($event->end))}}" required>
            <small>Choose date after start date</small>
            <br>
            <label for="endTime">Hour Event End</label>
            <input class="form-control" type="time" name="endTime" id="endTime" value="{{date('H:i', strtotime($event->end))}}" required>
        </div>
        
        <div class="container d-flex justify-content-center display-inline">
            <button type="submit" id="submit" class="btn btn-secondary"> Update </button>
            <button class="fadeIn fourth btn btn-danger" href="{{ route('events.destroy', ['user'=>Auth::id(), 'id'=>$event->id]) }}"
                onclick="event.preventDefault();
                document.getElementById('delete-form').submit();"> 
                Delete
            </button>
        </div>

    </form>
    <form id="delete-form" method="POST" action="{{ route('events.destroy', ['user'=>Auth::id(), 'id'=>$event->id]) }}" enctype="multipart/form-data" style="display:none;">
        {{ method_field('DELETE') }}
        {!! csrf_field() !!}
    </form>
  
</div>
@endsection