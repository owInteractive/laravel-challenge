@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h3>Edit Event </h3>
      </div>
    </div>

    @if ($errors->any())
      <div class="alert alert-danger">
        <strong>Whoops! </strong> there where some problems with your input.<br>
        <ul>
          @foreach ($errors as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{route('Events.update', $Events->id)}}" method="POST">
   // <input type="hidden" name="_token" value="{{ csrf_token() }}">

         {{ method_field('PUT') }}
                                  {{ csrf_field() }}
      <div class="row">
        <div class="col-md-12">
          <strong>Nama Siswa :</strong>
          <input type="text" name="title" class="form-control" value="{{$Events->title}}">
        </div>
        <div class="col-md-12">
          <strong>Alamat Siswa :</strong>
          <textarea class="form-control" name="description" rows="8" cols="80">{{$Events->description}}</textarea>
        </div>

                 <div class="col-md-12">
                          <h3>Start date  </h3>
                                   <input
                                       name="start"
                                       id="date"
                                       class="form-control"
                                       style="width: 100%; display: inline;"
                                       required=""
                                       value="{{$Events->start}}"
                                       type="date">
                                </div>

                                 <div class="col-md-12">
                           <h3>End date </h3>
                                           <input
                                               name="end"
                                               id="date"
                                               class="form-control"
                                               style="width: 100%; display: inline;"
                                               required=""
                                                value="{{$Events->end}}"
                                               type="date">
                                        </div>


        <div class="col-md-12">
          <a href="{{route('Events.index')}}" class="btn btn-sm btn-success">Back</a>
                 <button type="submit" class="btn btn-sm btn-primary">Submit</button>
        </div>
      </div>
    </form>
  </div>
@endsection
