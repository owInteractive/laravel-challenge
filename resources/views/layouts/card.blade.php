<div class="card text-center col-sm-6">
    <div class="card-body">
        <a href="{{ route('events.show', ['id'=>$event->id]) }}"><h5 class="card-title">{{$event->title}}</h5></a>
        <p class="card-text">Begin: {{$event->start}}</p>
        <p class="card-text">End: {{$event->end}}</p>
        <div class="container d-flex justify-content-center display-inline">
            <a href="{{ route('events.show', ['id'=>$event->id]) }}" class="badge badge-secondary">See More <i class="fas fa-plus"></i></a>
            @if(Auth::id()==$event->users_id)
                <a href="{{ route('events.edit', ['user'=>Auth::id(), 'id'=>$event->id]) }}" class="badge badge-secondary" id="edit-badge">Edit/Delete <i class="fas fa-edit"></i></a>
            @endif
        </div>
    </div>
</div>