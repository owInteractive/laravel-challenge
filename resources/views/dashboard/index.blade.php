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

                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Event title 1</h5>
                    </div>
                    <p class="mb-1">Event description 1.</p>
                    <small class="text-muted">09/01/2020 8h - 13/01/2020 18h</small>
                </a>

                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Event title 2</h5>
                    </div>
                    <p class="mb-1">Event description 2.</p>
                    <small class="text-muted">09/01/2020 8h - 13/01/2020 18h</small>
                </a>

            </div>

            <h5 class="mt-3">Next days</h5>

            <div class="list-group">

                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Event title 1</h5>
                    </div>
                    <p class="mb-1">Event description 1.</p>
                    <small class="text-muted">09/01/2020 8h - 13/01/2020 18h</small>
                </a>

                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Event title 2</h5>
                    </div>
                    <p class="mb-1">Event description 2.</p>
                    <small class="text-muted">09/01/2020 8h - 13/01/2020 18h</small>
                </a>

            </div>

        </div>
    </div>
@endsection