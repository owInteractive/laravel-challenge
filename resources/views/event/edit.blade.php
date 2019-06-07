@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Event</div>
        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="{{ route('event.update') }}">
            {{ csrf_field() }}
            <div class="form-group">
              @csrf
              <label for="title" class="col-md-2 control-label">Title</label>
              <div class="col-md-8">
                <input id="title" type="text" class="form-control" name="title">
              </div>
            </div>
            <div class="form-group">
              <label for="date_time_start" class="col-md-2 control-label">Begins</label>
              <div class="col-md-3">
                <input class="form-control" type="datetime-local" name="date_time_start">
              </div>
              <label for="date_time_end" class="col-md-2 control-label">Ends</label>
              <div class="col-md-3">
                <input class="form-control" type="datetime-local" name="date_time_end">
              </div>
            </div>
            <div class="form-group">
              <label for="description" class="col-md-2 control-label">Description</label>
              <div class="col-md-8">
                <textarea id="description" class="form-control" name="description"></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-2 col-md-offset-10">
                <button type="submit" class="btn btn-primary">
                  Update
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection