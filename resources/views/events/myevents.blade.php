@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">My Events</h1>
    @include('layouts.messages')
    <div class="card-group">
        <div class="col-lg-12">
            <div class="row">
                @forelse ($events as $event)
                    @include('layouts.card')    
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