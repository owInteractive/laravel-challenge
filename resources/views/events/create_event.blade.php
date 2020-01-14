@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Event</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('/store-event') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="title" class="form-control" name="title" required>
                                <span class="help-block" style="display: none;">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control" name="description" required></textarea>
                                <span class="help-block" style="display: none;">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="start_datetime" class="col-md-4 control-label">Start Event Date</label>

                            <div class="col-md-6">
                                <input id="start_datetime" type="text" class="form-control" name="start_datetime" required>
                                <span class="help-block" style="display: none;">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="end_datetime" class="col-md-4 control-label">End Event Date</label>

                            <div class="col-md-6">
                                <input id="end_datetime" type="text" class="form-control" name="end_datetime" required>
                                <span class="help-block" style="display: none;">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="end_datetime" class="col-md-4 control-label">Invite your friends</label>

                            <div class="col-md-6">
                            <select name="friends[]" id="friends" class="form-control" multiple>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>

                        @if(isset($status) && $status == 'success')
                            <div class="alert alert-success text-center" role="alert">
                                Event created successfully!
                            </div>
                        @elseif(isset($status) && $status == 'error during saving in db')
                            <div class="alert alert-danger text-center" role="alert">
                                Your event was not saved due to an error!
                            </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function($) {
        var options_date_picker = {
            format: 'DD/MM/YYYY HH:mm'
        };
        $("#start_datetime").datetimepicker(options_date_picker);
        $("#end_datetime").datetimepicker(options_date_picker);
    });
</script>
@endsection
