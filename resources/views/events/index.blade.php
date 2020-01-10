@extends('layout')

@section('content')
<div class="card mt-3">

    <div class="card-header d-flex justify-content-between">
        <span class="align-self-center">All Events</span>
        <a href="/events/create" class="btn btn-primary btn-sm">New event</a>
    </div>

    <div class="card-body">

        <div class="list-group">

                @foreach($events as $event)

                    <a href="/events/{{$event->id}}" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{$event->title}}</h5>
                        </div>
                        <p class="mb-1">{{$event->description}}</p>
                        <small class="text-muted">{{$event->start_at}} - {{$event->end_at}}</small>
                    </a>

                @endforeach

        </div>

        <div class="d-flex mt-4">
            <div class="mx-auto">
                {{ $events->links("pagination::bootstrap-4") }}
            </div>
        </div>

    </div>
</div>
@endsection