@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <ol class="breadcrumb">
                <li><a href="{{url('/home')}}">Home</a></li>
                <li><a href="{{route('events.index')}}">Events</a></li>
                <li class="active">Edit</li>              
            </ol>    
            <form class="form" method="POST" action="{{ route('events.update', $event->id) }}">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Event</div>
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
                                    <div class="input-group date" id="start_at_datetimepicker">
                                        <input id="start_at" type="text" class="form-control" name="start_at" value="{{ old('start_at',$event->start_at) }}" required>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
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
                                    <div class="input-group date" id="end_at_datetimepicker">
                                        <input id="end_at" type="text" class="form-control" name="end_at" value="{{ old('end_at',$event->end_at) }}" required>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
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
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Save
                        </button>
                        <a href="{{route('events.show', $event->id)}}" class="btn btn-default">Cancel</a>
                        <a href="" id="delete-event" class="btn btn-danger pull-right">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Remove
                        </a>
                        
                    </div>
                </div>
            </form>  
            <form id="delete-form" action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha256-yMjaV542P+q1RnH6XByCPDfUFhmOafWbeLPmqKh11zo=" crossorigin="anonymous" />
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>
<script>
    $(function () {
        $('#start_at_datetimepicker').datetimepicker({
           format: 'YYYY-MM-DD HH:mm:ss'
        });
        $('#end_at_datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false //Important! See issue #1075       
        });

        $("#start_at_datetimepicker").on("dp.change", function (e) {
            $('#end_at_datetimepicker').data("DateTimePicker").minDate(e.date);
        });

        $("#end_at_datetimepicker").on("dp.change", function (e) {
            $('#start_at_datetimepicker').data("DateTimePicker").maxDate(e.date);
        });

        $("#delete-event").click(function (e) {
            e.preventDefault();    
            var confirm_value = confirm('Are you sure you want to delete this event?');
            
            if (confirm_value)
                $('#delete-form').submit();
        })
    });
</script>
@endsection