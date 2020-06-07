@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h3>List of my events</h3>
      </div>
      <div class="col-sm-2">
        <a class="btn btn-sm btn-success" href="{{ route('Events.create') }}">Create New Events</a>
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
              <a class="btn btn-sm btn-warning" href="{{route('Events.edit',$Event->id)}}">Edit</a>


                        {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
              </form>
          </td>
        </tr>
      @endforeach
    </table>
<form action="{{url('import')}}" method="post" enctype="multipart/form-data">
                      <div class="col-md-6">
                        {{csrf_field()}}
                        <input type="file" name="imported-file"/>
                      </div>
                      <div class="col-md-6">
                          <button class="btn btn-primary" type="submit">Import</button>
                      </div>
                    </form>
{!! $Events->links() !!}
  </div>
@endsection
