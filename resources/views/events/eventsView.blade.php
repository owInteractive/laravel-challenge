@extends('layouts.app')

@section('content')

    <div style="padding-left:10px;">
        <table class="table table-bordered table-hover" style="max-width: 90%">
            <thead>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{$event->title}}</td>
                    <td>{{$event->description}}</td>
                    <td>{{$event->start_date}}</td>
                    <td>{{$event->end_date}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@stop