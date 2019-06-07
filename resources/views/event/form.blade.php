@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Event</div>
        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="{{ route('event.store') }}">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-2 control-label">Begins</label>
              <div class="col-md-3">
                <input class="form-control" type="date" name="begin">
              </div>
              <label for="email" class="col-md-2 control-label">Ends</label>
              <div class="col-md-3">
                <input class="form-control" type="date" name="begin">
              </div>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-2 control-label">Description</label>
              <div class="col-md-8">
                <textarea id="password" class="form-control" name="password" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-2 col-md-offset-10">
                <button type="submit" class="btn btn-primary">
                  Create
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