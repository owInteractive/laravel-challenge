@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">All your Events</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <form class="form-inline" method="POST" action="{{ route('export-event') }}" style="display: inline-block; padding-right: 20px;">
                                {{ csrf_field() }}
                                <select class="form-control" name="filter" id="filter" style="display: none;">
                                    <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>All events</option>
                                    <option value="today" {{ $filter == 'today' ? 'selected' : '' }}>Today Events</option>
                                    <option value="next_5_days" {{ $filter == 'next_5_days' ? 'selected' : '' }}>Events for the next 5 days</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Export Events</button>
                            </form>
                            <form class="form-inline" method="POST" enctype="multipart/form-data" action="{{ route('import-event') }}" style="display: inline-block; padding-right: 20px;">
                                {{ csrf_field() }}
                                <input type="file" class="form-control" id="csv_file" name="csv_file">
                                <button type="submit" class="btn btn-primary">Import Events</button>
                            </form>
                        </div>
                        <div class="col-md-12 form-group">
                            <form class="form-inline" method="GET" action="{{ route('your-events') }}" style="display: inline-block; padding-right: 20px;">
                                <div class="form-group">
                                    <select class="form-control" name="filter" id="filter">
                                        <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>All events</option>
                                        <option value="today" {{ $filter == 'today' ? 'selected' : '' }}>Today Events</option>
                                        <option value="next_5_days" {{ $filter == 'next_5_days' ? 'selected' : '' }}>Events for the next 5 days</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>
                        </div>
                    </div>
                    @foreach ($eventsPaginated as $event)
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Title: </b>{{ $event->title }}</p>
                                <p><b>Description: </b>{{ $event->description }}</p>
                                <p><b>Start Date: </b>{{ $event->start_datetime }}</p>
                                <p><b>End Date: </b>{{ $event->end_datetime }}</p>
                                <p><b>Invited Friends: </b>{{ $event->invited_friends_str }}</p>
                                <form method="POST" action="{{ route('edit-event') }}" class="form-inline" style="display: inline-block;">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id_event" value="{{ $event->id }}">
                                    <input type="hidden" name="title" value="{{ $event->title }}">
                                    <input type="hidden" name="description" value="{{ $event->description }}">
                                    <input type="hidden" name="start_datetime" value="{{ $event->start_datetime }}">
                                    <input type="hidden" name="end_datetime" value="{{ $event->end_datetime }}">
                                    <input type="hidden" name="invited_friends" value="{{ $event->invited_friends }}">
                                    <button class="btn btn-primary">Edit Event</button>
                                </form>
                                <form method="POST" action="{{ route('delete-event') }}" class="form-inline" style="display: inline-block;">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id_event" value="{{ $event->id }}">
                                    <button class="btn btn-danger">Delete Event</button>
                                </form>
                                <hr>
                            </div>
                        </div>
                    @endforeach
                    {{ $eventsPaginated->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection