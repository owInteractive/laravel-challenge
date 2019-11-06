@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form class="form" method="POST" action="{{ route('events.update', $event->id) }}">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading">Edit event</div>
                    <div class="panel-body">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Title<span class="text-danger">*</label>
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $event->title) }}" required autofocus>
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="control-label">Description<span class="text-danger">*</label>
                            <textarea id="description" class="form-control" name="description" rows="8" required>{{ old('description',$event->description) }}</textarea>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif                        
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('start_at') ? ' has-error' : '' }}">
                                    <label for="start_at" class="control-label">Start at<span class="text-danger">*</label>
                                    <input id="start_at" type="text" class="form-control" name="start_at" value="{{ old('start_at',$event->start_at) }}" required>
                                    @if ($errors->has('start_at'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('start_at') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('end_at') ? ' has-error' : '' }}">
                                    <label for="end_at" class="control-label">End at<span class="text-danger">*</label>                           
                                    <input id="end_at" type="text" class="form-control" name="end_at" value="{{ old('end_at',$event->end_at) }}" required>
                                    @if ($errors->has('end_at'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('end_at') }}</strong>
                                        </span>
                                    @endif
                                </div>           
                            </div>
                        </div>            
                    </div>
                    <div class="panel-footer">                       
                        <button type="submit" class="btn btn-primary">
                            Edit event
                        </button>
                        <a href="{{url(route('events.index'))}}" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </form>  
        </div>
    </div>
</div>
@endsection