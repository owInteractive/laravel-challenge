@extends('layouts.app')

@section('content')
<div class="container">

    @foreach ($events as $event)
        {{$event->title}}
    @endforeach
    <div class="container d-flex justify-content-center">
        {{ $events->links() }}
    </div>    
</div>
@endsection