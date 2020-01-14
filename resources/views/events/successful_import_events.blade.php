@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Import Events</div>

                <div class="panel-body">
                    @if(isset($status) && $status == 'success')
                        <div class="alert alert-success text-center" role="alert">
                            Importation successful made!
                        </div>
                    @elseif(isset($status) && $status == 'incorrect format')
                        <div class="alert alert-danger text-center" role="alert">
                            Incorrect file format!
                        </div>
                    @elseif(isset($status) && $status == 'error during saving in db')
                        <div class="alert alert-danger text-center" role="alert">
                            Your event was not saved due to an error!
                        </div>
                    @endif
                    <p><a href="{{ route('your-events') }}">Click here to go back to your events.</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
