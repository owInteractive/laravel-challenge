@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">My Events</h1>
    <div class="card-group">
        <div class="col-lg-12">
            <div class="row">
                @forelse ($events as $event)
                    <div class="card text-center col-sm-6">
                        <div class="card-body">
                            <a href="{{ route('events.show', ['id'=>$event->id]) }}"><h5 class="card-title">{{$event->title}}</h5></a>
                            <p class="card-text">Begin: {{$event->start}}</p>
                            <p class="card-text">End: {{$event->end}}</p>
                            <div class="container d-flex justify-content-center display-inline">
                                <a href="{{ route('events.show', ['id'=>$event->id]) }}" class="badge badge-secondary">See More <i class="fas fa-plus"></i></a>
                                @if(Auth::id()==$event->users_id)
                                    <a href="{{ route('events.edit', ['user'=>Auth::id(), 'id'=>$event->id]) }}" class="badge badge-secondary">Edit/Delete <i class="fas fa-edit"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <h3 class="text-center">You don't have events.</h3>
                @endforelse
            </div>
        </div>
    </div>

    <div class="container d-flex justify-content-center">
        {{ $events->links() }}
    </div>
    
    <div class="container d-flex justify-content-center display-inline">
        @if(count($events)!=0)
            <div class="btn-group dropright">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Export
                </button>
                <div class="dropdown-menu">
                    <form action="{{url('export', ['archive'=>'csv', 'type'=>'my'])}}" enctype="multipart/form-data">
                        <button class="dropdown-item" type="submit">in CSV</button>
                    </form>
                    <form action="{{url('export', ['archive'=>'xls', 'type'=>'my'])}}" enctype="multipart/form-data">
                        <button class="dropdown-item" type="submit">in XLS</button>
                    </form>
                    <form action="{{url('export', ['archive'=>'txt', 'type'=>'my'])}}" enctype="multipart/form-data">
                        <button class="dropdown-item" type="submit">in TXT</button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ url('/newEvents') }}"><button type="button" class="btn btn-secondary">Create Event</button></a>
        @endif
    </div>    
  
</div>
@endsection