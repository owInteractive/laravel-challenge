@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h3>New Event  </h3>
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

    <form action="{{route('Events.store')}}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

      @csrf
      <div class="row">
        <div class="col-md-12">
          <strong>NEvent name :</strong>
          <input type="text" name="title" class="form-control" placeholder="Nama Siswa">
        </div>

        <div class="col-md-12">
          <strong>Add description :</strong>
          <textarea class="form-control" placeholder="Description " name="description" rows="8" cols="80"></textarea>
        </div>
         <div class="col-md-12">
          <h3>Start date  </h3>
                   <input
                       name="start"
                       id="date"
                       class="form-control"
                       style="width: 100%; display: inline;"
                       required=""
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
                               type="date">
                        </div>

        <div class="col-md-12" centered>
          <a href="{{route('Events.index')}}" class="btn btn-sm btn-success">Back</a>
          <button type="submit" class="btn btn-sm btn-primary">Submit</button>
        </div>


      </div>
    </form>
<form action="{{url('import')}}" method="post" enctype="multipart/form-data">
                      <div class="col-md-6">
                        {{csrf_field()}}
                        <input type="file" name="imported-file"/>
                      </div>
                      <div class="col-md-6">
                          <button class="btn btn-primary" type="submit">Import</button>
                      </div>
                    </form>
  </div>
@endsection
