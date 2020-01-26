@extends('layouts.app')

@section('content')
<div class="panel panel-default">
        <div class="panel-heading">Event</div>
        <div class="panel-heading">Event</div>
        <div class="panel-body">
        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="{{ route('event.store') }}">
          <form class="form-horizontal" method="POST" action="{{ route('event.store', ['id' => $event->id])}}">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {{ csrf_field() }}
              <label for="email" class="col-md-2 control-label">Begins</label>
            <div class="form-group">
              <div class="col-md-3">
              <div class="hidden">
                <input class="form-control" type="date" name="begin">
                @csrf
              </div>
              </div>
              <label for="email" class="col-md-2 control-label">Ends</label>
              <label for="title" class="col-md-2 control-label">Title</label>
              <div class="col-md-3">
              <div class="col-md-9">
                <input class="form-control" type="date" name="begin">
                <input required id="title" type="text" class="form-control" name="title" value={{$event->title}}>
              </div>
              </div>
            </div>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="form-group">
              <label for="password" class="col-md-2 control-label">Description</label>
              <label for="date_time_start" class="col-md-2 control-label">Begins</label>
              <div class="col-md-8">
              <div class="col-md-4">
                <textarea id="password" class="form-control" name="password" required></textarea>
                <input class="form-control" type="datetime-local" name="date_time_start">
              </div>
              <label for="date_time_end" class="col-md-1 control-label">Ends</label>
              <div class="col-md-4">
                <input class="form-control" type="datetime-local" name="date_time_end">
              </div>
              </div>
            </div>
            </div>
            <div class="form-group">
            <div class="form-group">
              <div class="col-md-2 col-md-offset-10">
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
                <button type="submit" class="btn btn-primary">
                  Create
                  Save
                </button>
                </button>
              </div>
              </div>
            </div>
            </div
@endsection