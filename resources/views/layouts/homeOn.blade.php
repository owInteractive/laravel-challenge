<h1 class="text-center">Events Happening Today</h1>
<div class="card-group">
    <div class="col-lg-12">
        <div class="row">
            @forelse ($events as $event)
                @include('layouts.card')
            @empty
                <h3 class="text-center">There are no events happening today.</h3>
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
                <form action="{{url('export', ['archive'=>'csv', 'type'=>'today'])}}" enctype="multipart/form-data">
                    <button class="dropdown-item" type="submit">in CSV</button>
                </form>
                <form action="{{url('export', ['archive'=>'xls', 'type'=>'today'])}}" enctype="multipart/form-data">
                    <button class="dropdown-item" type="submit">in XLS</button>
                </form>
                <form action="{{url('export', ['archive'=>'txt', 'type'=>'today'])}}" enctype="multipart/form-data">
                    <button class="dropdown-item" type="submit">in TXT</button>
                </form>
            </div>
        </div>
    @else
        <a href="{{ url('/newEvents') }}"><button type="button" class="btn btn-secondary">Create Event</button></a>
    @endif
</div>
