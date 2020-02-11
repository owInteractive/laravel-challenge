<div>
    <form action="{{route('events.export')}}" method="post">
        {{ csrf_field() }}
        <button class="btn btn-primary btn-sm">Export</button>
    </form>
</div>
