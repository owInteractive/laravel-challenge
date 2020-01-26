
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Invite</div>
        <div class="panel-body">
          <div class="row">
              <label class="col-md-12 control-label">Send invites to event: {{$event->title}}</label><br>            
          </div>
          <form class="form-horizontal" method="POST" action="{{ route('invite', ['id' => $event->id])}}">
            {{ csrf_field() }}
            <div class="form-group">
              <div class="hidden">
                @csrf
              </div><br>
              <div class="col-md-12">
              <label for="emails">Send to: <br></label><br>
              (E-mails: separate by coma ex. example@email.com, example2@email.com, ...)<br>
                <textarea id="emails" class="form-control" name="emails"></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-1 col-md-offset-9">
                <a href="{{ route('event.index') }}" class="btn btn-default">Cancel</a>
              </div>
              <div class="col-md-1">
                <button type="submit" class="btn btn-primary">
                  Invite
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