<div class="list-group border-0">
    <a href="{{ url('') }}" class="list-group-item bg-transparent border-0 border-bottom">
        {{ env('APP_NAME') }}
    </a>
    <a href="{{ url('events') }}" class="list-group-item bg-transparent border-0 border-bottom">List Events</a>
    <a href="{{ url('events/create') }}" class="list-group-item bg-transparent border-0 border-bottom">Create Events</a>
</div>