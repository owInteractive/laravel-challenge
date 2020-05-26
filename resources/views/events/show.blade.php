@extends('layouts.app')
@section("card-body")
    <form method="POST" action="{{ url('events') . "/" . $event->id }}" id="eventUpdate">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('title') ? ' has-warning' : '' }}">
            <label for="title">{{ __("event.form.title") }}:</label>
            <input type="text" name="title" id="title" class="form-control" placeholder=""
                   value="{{ $event->title }}" aria-describedby="helpId" required>
            @if ($errors->has('title'))
                <span class="form-text">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('description') ? ' has-warning' : '' }}">
            <label for="description">{{ __("event.form.description") }}:</label>
            <input type="text" name="description" id="description" class="form-control" placeholder=""
                   value="{{ $event->description }}" aria-describedby="helpId" required>
            @if ($errors->has('description'))
                <span class="form-text">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group {{ $errors->has('start_date') ? ' has-warning' : '' }}">
                    <label for="start_date">{{ __("event.form.start_date") }}</label>
                    <input type="text" name="start_date" id="start_date" class="form-control" placeholder=""
                           value="{{ $event->start_date }}" aria-describedby="helpId" required>
                    @if ($errors->has('start_date'))
                        <span class="form-text">
                            <strong>{{ $errors->first('start_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col">
                <div class="form-group {{ $errors->has('end_date') ? ' has-warning' : '' }}">
                    <label for="end_date">{{ __("event.form.end_date") }}</label>
                    <input type="text" name="end_date" id="end_date" class="form-control" placeholder=""
                           value="{{ $event->end_date }}" aria-describedby="helpId" required>
                    @if ($errors->has('end_date'))
                        <span class="form-text">
                            <strong>{{ $errors->first('end_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </form>
@endsection
@section("card-footer")
    <button type="submit" class="btn btn-info" onclick="document.getElementById('eventUpdate').submit()">
        <i class="fas fa-user-plus mr-1"></i>{{ __("event.create.register") }}
    </button>
    <script>

        $.datetimepicker.setLocale('en');
        $('input[id="start_date"]').datetimepicker();
        $('input[id="end_date"]').datetimepicker();
    </script>
@endsection