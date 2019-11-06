@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form class="form" method="POST" action="{{ route('events.store') }}">
                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading">Create an event</div>
                    <div class="panel-body">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="name">Title</label>
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description">Description</label>
                            <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif                        
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('start_at') ? ' has-error' : '' }}">
                                    <label for="start_at">Start at</label>
                                    <input id="start_at" type="text" class="form-control" name="start_at" value="{{ old('start_at') }}" required>
                                    @if ($errors->has('start_at'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('start_at') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('end_at') ? ' has-error' : '' }}">
                                    <label for="end_at">End at</label>                           
                                    <input id="end_at" type="text" class="form-control" name="end_at" value="{{ old('end_at') }}" required>
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
                            Create event
                        </button>
                        <a href="{{url(route('events.index'))}}" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </form>  
        </div>
    </div>
</div>
@endsection