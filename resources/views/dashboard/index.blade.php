@extends('layout')

@section('content')
    <div class="card mt-3">

        <div class="card-header d-flex justify-content-between">
            <span class="align-self-center">Upcoming events</span>
            <div>
                <a href="/events" class="btn btn-secondary btn-sm">All events</a>
                <a href="/events/create" class="btn btn-primary btn-sm">New event</a>
            </div>
        </div>

        <div class="card-body">

            <h5>Today</h5>
            <div class="list-group">

                @forelse ($todayEvents as $event)

                    <a href="/events/{{$event->id}}" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{$event->title}}</h5>
                        </div>
                        <p class="mb-1">{{$event->description}}</p>
                        <small class="text-muted">{{$event->start_at}} - {{$event->end_at}}</small>
                    </a>

                @empty

                    <div class="alert alert-secondary" role="alert">
                        There are no events for today.
                    </div>

                @endforelse

            </div>

            <h5 class="mt-3">Next 5 days</h5>
            <div class="list-group">

                @forelse ($next5DaysEvents as $event)

                    <a href="/events/{{$event->id}}" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{$event->title}}</h5>
                        </div>
                        <p class="mb-1">{{$event->description}}</p>
                        <small class="text-muted">{{$event->start_at}} - {{$event->end_at}}</small>
                    </a>

                @empty

                    <div class="alert alert-secondary" role="alert">
                        There are no events for the next 5 days.
                    </div>

                @endforelse

            </div>

        </div>
    </div>
@endsection