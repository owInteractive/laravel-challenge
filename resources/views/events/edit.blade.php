@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <span class="badge badge-danger badge-pill">
                {{ $error }}
            </span>
        @endforeach
    @endif
    @if( \Session::has('message') )
        <span id="success" class="badge badge-success badge-pill">
            {{ \Session::get('message') }}
        </span>
    @endif

    <form method="POST" action="{{ route('events.update', $event->id) }}" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        {!! csrf_field() !!}
        <div class="form-group">
            <input class="form-control" type="text" name="title" id="title" value="{{$event->title}}">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="description" id="description">{{$event->description}}</textarea>
        </div>
        <div class="form-group">
            <input class="form-control" type="date" name="beginDate" id="beginDate" value="{{date('Y-m-d', strtotime($event->start))}}"> <input class="form-control" type="time" name="beginTime" id="beginTime" value="{{date('H:i', strtotime($event->start))}}">
        </div>
        <div class="form-group">
            <input class="form-control"type="date" name="endDate" id="endDate" value="{{date('Y-m-d', strtotime($event->end))}}"> <input class="form-control" type="time" name="endTime" id="endTime" value="{{date('H:i', strtotime($event->end))}}">
        </div>
        

        <button type="submit" id="submit" class="btn btn-primary"> Save </button>
        <button class="fadeIn fourth btn btn-danger" href="{{ route('events.destroy', $event->id) }}"
            onclick="event.preventDefault();
            document.getElementById('delete-form').submit();"> 
            Apagar
        </button>

    </form>
    <form id="delete-form" method="POST" action="{{ route('events.destroy', $event->id) }}" enctype="multipart/form-data" style="display:none;">
        {{ method_field('DELETE') }}
        {!! csrf_field() !!}
    </form>
  
</div>
@endsection