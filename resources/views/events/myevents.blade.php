@extends('layouts.app')

@section('content')
<div class="container">

    @foreach ($events as $event)
        <a href="{{ route('events.edit', ['user'=>Auth::id(), 'id'=>$event->id]) }}">{{$event->title}}</a>
    @endforeach
  
</div>
@endsection