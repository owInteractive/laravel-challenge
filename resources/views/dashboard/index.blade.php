@extends('layout')

@section('title', 'OW Calendar | Dashboard')

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
            @include('subviews.list_events',
                ['events' => $todayEvents, 'emptyMessage' => 'There are no events for today.'])

            <h5 class="mt-3">Next 5 days</h5>
            @include('subviews.list_events',
                ['events' => $next5DaysEvents, 'emptyMessage' => 'There are no events for the next 5 days.'])

        </div>
    </div>
@endsection