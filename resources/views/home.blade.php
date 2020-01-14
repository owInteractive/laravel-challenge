@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <p><a href="{{ route('create-event') }}">Click here to create your event.</a></p>
                    <p><a href="{{ route('your-events') }}">Click here to see all of your events</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
