@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="form-group">
                <div class="col-md-5">
                    <a href="{{ route('events.index',['q' => 'all']) }}" class="btn btn-default">All events</a>
                    <a href="{{ route('events.index',['q' => 'next']) }}" class="btn btn-default">Next events</a>
                    <a href="{{ route('events.index',['q' => 'today']) }}" class="btn btn-default">Today's events</a>
                </div>
                <div class="col-md-1 col-md-offset-4"><a href="{{ route('export') }}" class="btn btn-success">Export all</a>
                </div>
                <div class="col-md-1"><a href="{{ route('import')}}" class="btn btn-success">Import</a>
                </div>
                <div class="col-md-1"><a href="{{ route('events.create') }}" class="btn btn-primary">New event</a>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                <br>
            @endif
            @if(session()->get('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
                <br>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Title</td>
                        <td>Start</td>
                        <td>End</td>
                        <td>Description</td>
                        <td class="text-center" colspan="4">Action</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr>
                        <td><strong class="text-info">{{ $event->title }}</strong></td>
                        <td>
                        {{\Carbon\Carbon::parse($event->start_at)->format('d/m/Y')}}<br>
                        at: {{\Carbon\Carbon::parse($event->start_at)->format('H:i')}}
                        </td>
                        <td>
                        {{\Carbon\Carbon::parse($event->end_at)->format('d/m/Y')}}<br>
                        at: {{\Carbon\Carbon::parse($event->end_at)->format('H:i')}}
                        </td>
                        <td>{{$event->description}}</td>
                        <td><a href="{{ route('events.edit',$event->id) }}" class="btn btn-primary">Edit</a></td>
                        <td><a href="{{ route('export', ['id' => $event->id]) }}" class="btn btn-success">Export</a></td>
                        <td><a href="{{ route('invite', $event->id) }}" class="btn btn-default">Invite</a></td>
                        <td>
                        <form method="POST" action="{{ route('events.destroy', $event->id) }}">
                            <div class="hidden">
                                @method('DELETE')
                                {!! method_field('delete') !!}
                                {!! csrf_field() !!}
                            </div>
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $events->appends($filter)->links() }}
        <div>
    </div>
@endsection