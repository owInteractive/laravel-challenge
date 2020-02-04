@extends('layouts.app')
@section('content')
<div class="container-fluid">
  @if ($message = Session::get('success'))
          <div class="alert alert-success">
              <p>{{ $message }}</p>
          </div>
  @endif
  <div class="col-md-12">
    <h4>List of Events</h4>
    <div class="">
      <form method="GET" action="{{ route('events') }}">
        <div class="form-row align-items-center">
          <div class="col-auto">
            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" name="today_events" id="today_events" value="1">
              <label class="form-check-label" for="today_events">
                Today events
              </label>
            </div>
          </div>
          <div class="col-auto">
            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" name="next_events" id="next_events" value="5">
              <label class="form-check-label" for="next_events">
                Next events
              </label>
            </div>
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-2">Apply Filters</button>
          </div>
        </div>
      </form>
    </div>
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Start</th>
            <th scope="col">End</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $event->title }}</td>
                <td style="max-width: 50ch;">{{ $event->description }}</td>
                <td>{{ \Carbon\Carbon::parse($event->start)->format('d/m/Y - H:i')}}</td>
                <td>{{ \Carbon\Carbon::parse($event->end)->format('d/m/Y - H:i')}}</td>
                <td>
                  <form action="{{ route('destroy', $event->id) }}" method="POST">
                    <input type="hidden" name="_method" value="DELETE" />                
                    {{ csrf_field() }}
                    <a class="btn btn-info" href="#" onclick="InviteEvent.showURL({{$event->id}})"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
                    <a class="btn btn-secondary" href="{{ route('edit', $event->id) }}"><i class="fa fa-edit"></i></a>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-remove"></i></button>
                  </form>
                </td>
            @endforeach
        </tbody>
    </table>    
  </div>
  @if ($events instanceof \Illuminate\Pagination\AbstractPaginator)
    {{ $events->links('vendor.pagination.custom') }}
  @endif
</div>
<script>
  $(function() {
     InviteEvent = (function(){
        return {
          showURL: function(event_id) {
            var url = "{{ url('/events/invite')}}" + "/"+ event_id ;
            alert("Invite People sending this URL: " + url);
          }
        }
    })();

    $("#next_events").click(function() {
        $('#today_events').prop('checked',false);
    });

    $("#today_events").click(function() {
        $('#next_events').prop('checked',false);
    });

  });
</script> 
 
@endsection
