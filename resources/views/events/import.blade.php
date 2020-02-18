@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Import</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('import') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="hidden">
                                    @csrf
                                </div>
                                <label for="file" class="col-md-2 control-label">CSV file</label>
                                <div class="col-md-9">
                                    <input type="file" name="events_file" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-1 col-md-offset-9">
                                    <a href="{{ route('events.index') }}" class="btn btn-default">Cancel</a>
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-success">
                                    Import
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