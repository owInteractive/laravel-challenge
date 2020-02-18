@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Event</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('events.update', $event->id) }}">
                            {{ method_field('put') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title" class="col-md-2 control-label">Title</label>
                                <div class="col-md-9 {{ $errors->has('title') ? 'has-error' : '' }}">
                                    <input required id="title" type="text" class="form-control" name="title" value="{{ $event->title }}">
                                    @if ($errors->has('title'))
                                        <div class="text-danger">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="start_at" class="col-md-2 control-label">Begins</label>
                                <div class="col-md-4 {{ $errors->has('start_at') ? 'has-error' : '' }}">
                                    <input class="form-control" type="datetime-local" name="start_at" value="{{ \Carbon\Carbon::parse($event->start_at)->format('Y-m-d\TH:i') }}">
                                    @if ($errors->has('start_at'))
                                        <div class="text-danger">
                                            {{ $errors->first('start_at') }}
                                        </div>
                                    @endif
                                </div>
                                <label for="end_at" class="col-md-1 control-label">Ends</label>
                                <div class="col-md-4 {{ $errors->has('end_at') ? 'has-error' : '' }}">
                                    <input class="form-control" type="datetime-local" name="end_at" value="{{ \Carbon\Carbon::parse($event->end_at)->format('Y-m-d\TH:i') }}">
                                    @if ($errors->has('end_at'))
                                        <div class="text-danger">
                                            {{ $errors->first('end_at') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-md-2 control-label">Description</label>
                                <div class="col-md-9 {{ $errors->has('description') ? 'has-error' : '' }}">
                                    <textarea id="description" class="form-control" name="description">{{ $event->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <div class="text-danger">
                                            {{ $errors->first('description') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="col-md-1 col-md-offset-9">
                                    <a href="{{ route('events.index') }}" class="btn btn-default">Cancel</a>
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