@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h3>List of today s events </h3>
      </div>

      <div class="col-md-12">
              <a href="{{route('Events.index')}}" class="btn btn-sm btn-success">Back</a>
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

      </tr>

      @foreach ($Events as $Event)
        <tr>
          <td><b>{{++$i}}.</b></td>
          <td>{{$Event->title}}</td>
          <td>{{$Event->description}}</td>
           <td>{{$Event->start}}</td>
          <td>{{$Event->end}}</td>
          <td>
              <a class="btn btn-sm btn-success" href="{{route('Events.show',$Event->id)}}">Show</a>
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
