@extends('layouts.app')

@section('content')
    <div style="padding-left:10px;">
        <div class="p-3">
            <div style="display: flex; padding: 5px;">
                @include('subViews.import')
                @include('subViews.export')
            </div>
            <ul class="nav nav-tabs" id="eventsTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="today-events-tab" data-toggle="tab" href="#today-events" role="tab"
                       aria-controls="today-events"
                       aria-selected="true">Today Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="5-days-events-tab" data-toggle="tab" href="#5-days-events" role="tab"
                       aria-controls="5-days-events" aria-selected="false">Events for the next 5 days</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" id="all-events-tab" data-toggle="tab" href="#all-events" role="tab"
                       aria-controls="all-events"
                       aria-selected="false">All Events</a>
                </li>
            </ul>
            <div class="tab-content" id="eventsTabContent">
                <div class="tab-pane fade" id="today-events" role="tabpanel" aria-labelledby="today-events-tab">
                    @include('subViews.listEvents', ['events' => $todayEvents])
                </div>
                <div class="tab-pane fade" id="5-days-events" role="tabpanel" aria-labelledby="5-days-events-tab">
                    @include('subViews.listEvents', ['events' => $fiveDayEvents])
                </div>
                <div class="tab-pane fade active in" id="all-events" role="tabpanel" aria-labelledby="all-events-tab">
                    @include('subViews.listEvents', ['events' => $paginatedEvents])
                    <nav>
                        <ul class="pagination justify-content-end">
                            {{$paginatedEvents->links('vendor.pagination.bootstrap-4')}}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

@stop