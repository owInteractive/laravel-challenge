@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome, Event list</div>

                <div class="panel-body">

                    <!-- Current Events -->
                    @if (count($events) > 0)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Current Events
                            </div>
        
                            <div class="panel-body">
                                <table class="table table-striped task-table">
                                    <thead>
                                        <th>Event</th>
                                        <th>Description</th>
                                        <th>Start At</th>
                                        <th>End At</th>
                                        <th>Share</th>
                                        <th>Details</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $event)
                                            <tr>
                                                <td class="table-text"><div>{{ $event->title }}</div></td>
                                                <td class="table-text"><div>{{ $event->description }}</div></td>
                                                <td class="table-text"><div>{{ date('d/m/Y', strtotime($event->starts_at)) }}</div></td>
                                                <td class="table-text"><div>{{ date('d/m/Y', strtotime($event->ends_at)) }}</div></td>
                                                <td class="table-text"><div><a href="https://www.facebook.com/sharer/sharer.php?u={{route('eventDetail', $event->id)}}" target="_blank">
                                                    Share with your friends
                                                    </a></div></td>
                                                <td>
                                                    <a href="{{route('eventDetail', $event->id)}}">
                                                        <button type="button" class="btn btn-primary">
                                                            <i class="fa fa-btn fa-trash"></i>See
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
