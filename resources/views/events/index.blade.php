@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <h1>Today Events</h1>
                @foreach ($events_today as $event)
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
        <div class="row">
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
    </div>  
@endsection