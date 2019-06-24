@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">{{ trans('event.invitation_event') }}</div>

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

                        <form action="{{ route('event.invitation', $event) }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('emails') ? ' has-error' : '' }}">
                                <label class="control-label" for="emails">{{ trans('event.emails') }}</label>
                                <input type="text" class="form-control" name="emails" id="emails" value="{{ old('emails') }}" required autofocus>

                                <span class="help-block">
                                    <strong>Use ',' for separating emails.</strong>
                                </span>
                                @if ($errors->has('emails'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('emails') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary">{{ trans('event.button_save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
