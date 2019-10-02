@extends('layouts.app')

@section('content')
<div class="container">

    @foreach ($events as $event)
        {{$event->title}}
    @endforeach
  
</div>
@endsection