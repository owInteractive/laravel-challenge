@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Event</div>
        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="{{ route('event.store', ['id' => $event->id])}}">
            {{ csrf_field() }}
            <div class="form-group">
              <div class="hidden">
                @csrf
              </div>
              <label for="title" class="col-md-2 control-label">Title</label>
              <div class="col-md-9">
                <input required id="title" type="text" class="form-control" name="title" value={{$event->title}}>
              </div>
            </div>
            <div class="form-group">
              <label for="start_datetime" class="col-md-2 control-label">Begins</label>
              <div class="col-md-4">
                <input class="form-control" type="date" name="start_datetime">
              </div>
              <label for="end_datetime" class="col-md-1 control-label">Ends</label>
              <div class="col-md-4">
                <input class="form-control" type="date" name="end_datetime">
              </div>
            </div>
            <div class="form-group">
              <label for="description" class="col-md-2 control-label">Description</label>
              <div class="col-md-9">
                <textarea id="description" class="form-control" name="description"></textarea>
              </div>
            </div>
            <br>
            <div class="form-group">
              <div class="col-md-1 col-md-offset-9">
              <a href="{{ route('event.index') }}" class="btn btn-default">Cancel</a>
              </div>
              <div class="col-md-1">
                <button type="submit" class="btn btn-primary">
                  Save
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