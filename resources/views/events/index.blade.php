@extends('layouts.app')

@section('content')
    @foreach ($events as $event)
        <h1>{{$event->title}}</h1>
        <small>{{ $event->start_at }} - {{ $event->end_at }}</small>
        <p>{{$event->description}}</p>

    @endforeach
@endsection