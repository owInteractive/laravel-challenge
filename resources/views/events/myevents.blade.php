@extends('layouts.app')

@section('content')
<div class="container">

    @foreach ($events as $event)
        <a href="/events/edit/{{$event->id}}">{{$event->title}}</a>
    @endforeach
  
</div>
@endsection