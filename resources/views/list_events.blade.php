<div class="list-group">

    @forelse ($events as $event)

        <a href="/events/{{$event->id}}" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{$event->title}}</h5>
            </div>
            <p class="mb-1">{{$event->description}}</p>

            <small class="text-info">
                <i class="fa fa-calendar-check-o"></i>
                {{date('d/m/Y H:i', strtotime($event->start_at))}}
            </small>

            <br>

            <small class="text-secondary">
                <i class="fa fa-calendar-minus-o"></i>
                {{date('d/m/Y H:i', strtotime($event->end_at))}}
            </small>

        </a>

    @empty

        <div class="alert alert-secondary" role="alert">
            {{$emptyMessage}}
        </div>

    @endforelse

</div>