@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h3>List of all events</h3>
      </div>
      <div class="col-sm-3">
        <a class="btn btn-sm btn-success" href="{{ route('Events.create') }}">Create New Event</a>
      </div>

      <div class="col-sm-3">
              <a class="btn btn-sm btn-success" href="{{ route('myevents') }}">My events </a>
            </div>
            <div class="col-sm-3">
                          <a class="btn btn-sm btn-success" href="{{ route('today') }}">today  events </a>
                        </div>
    </div>

    @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{$message}}</p>
      </div>
    @endif

    <table class="table table-hover table-sm">
      <tr>
        <th width = "50px"><b>No.</b></th>
        <th width = "300px">Titile</th>
        <th>Desciption</th>
        <th>Start date</th>
        <th>End date</th>
        <th width = "180px">Action</th>
      </tr>

      @foreach ($Events as $Event)
        <tr>
          <td><b>{{++$i}}.</b></td>
          <td>{{$Event->title}}</td>
          <td>{{$Event->description}}</td>
           <td>{{$Event->start}}</td>
          <td>{{$Event->end}}</td>
          <td>
            <form action="{{ route('Events.destroy', $Event->id) }}" method="post">
              <a class="btn btn-sm btn-success" href="{{route('Events.show',$Event->id)}}">Show</a>



              </form>
          </td>
        </tr>
      @endforeach
    </table>
  <form action="{{url('export')}}" enctype="multipart/form-data">
    <button class="btn btn-success" type="submit">Export</button>
      </form>


{!! $Events->links() !!}
  </div>
@endsection
