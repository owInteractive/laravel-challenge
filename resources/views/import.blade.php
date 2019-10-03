@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <span class="badge badge-danger badge-pill">
                    {{ $error }}
                </span>
            @endforeach
        @endif
        @if( \Session::has('message') )
            <span id="success" class="badge badge-success badge-pill">
                {{ \Session::get('message') }}
            </span>
        @endif
        @if( \Session::has('error') )
            <span id="danger" class="badge badge-danger badge-pill">
                {{ \Session::get('error') }}
            </span>
        @endif
        <h1 class="text-center">CSV file to import</h1>
        <div class="row justify-content-center">
            <div class="panel panel-default justify-content-center">
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('events.importcsv') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                            <input id="csv_file" type="file" class="form-control" name="csv_file" required>
                        </div>
                        <div class="container d-flex justify-content-center display-inline">
                            <button type="submit" class="btn btn-primary">
                                Import CSV
                            </button>
                        </div>
                    </form>
                </div>       
            </div>
        </div>
    </div>
@endsection