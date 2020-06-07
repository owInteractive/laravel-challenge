@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Detail </h3>
        <hr>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <strong>Event title  : </strong> {{$Events->title}}
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <strong>Event  Description : </strong> {{$Events->description}}
        </div>
      </div>
      <div class="col-md-12">
        <a href="{{route('Events.index')}}" class="btn btn-sm btn-success">Back</a>
      </div>
    </div>
  </div>
@endsection
