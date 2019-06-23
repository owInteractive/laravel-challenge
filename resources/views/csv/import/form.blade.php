@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">{{ trans('event.new_event') }}</div>

                    <div class="panel-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{{ session('success') }}</li>
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('csv.import') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('events_file') ? ' has-error' : '' }}">
                                <label class="control-label" for="events_file">{{ trans('csv.events_file') }}</label>
                                <input type="file" class="form-control" name="events_file" id="events_file" required>

                                @if ($errors->has('events_file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('events_file') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary">{{ trans('csv.import') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
