@extends('layout')

@section('content')
<div class="card mt-3">

    <div class="card-header d-flex justify-content-between">
        <span class="align-self-center">All Events</span>
        <a href="/events/create" class="btn btn-primary btn-sm">New event</a>
    </div>

    <div class="card-body">

        @include('list_events',
                ['events' => $events, 'emptyMessage' => 'There are no events to show.'])

        <div class="d-flex mt-4">
            <div class="mx-auto">
                {{ $events->links("pagination::bootstrap-4") }}
            </div>
        </div>

    </div>
</div>
@endsection