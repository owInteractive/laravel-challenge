@extends('layouts.app')

@section('content')
<div class="container">
    @if( \Session::has('error') )
        <span id="danger" class="badge badge-danger badge-pill">
            {{ \Session::get('error') }}
        </span>
    @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <h1>Events!</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
