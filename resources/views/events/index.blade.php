@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>All Events</h1>
        @foreach ($events as $event)
            @component('events.components.event')
                @slot('heading')
                    {{$event->title}}                
                @endslot

                @slot('body')
                    <p>{{$event->short_description}}</p>
                    <small>{{ $event->start_at->format('d/m/Y') }} to {{ $event->end_at->format('d/m/Y') }}</small>
                @endslot

            @endcomponent
        @endforeach
        {{ $events->links() }}
    </div>  
@endsection