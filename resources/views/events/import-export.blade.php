@extends('layouts.app')
@section('card-header')
@endsection
@section('card-body')
<form method="POST" action="{{ url('import') }}" id="postFile" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group {{ $errors->has('file') ? ' has-warning' : '' }}">
        <label for="file">{{ __("event.form.file") }}:</label>
        <input type="file" name="file" id="file" class="form-control" placeholder=""
               aria-describedby="helpId" required>
        @if ($errors->has('file'))
            <span class="form-text">
                <strong>{{ $errors->first('file') }}</strong>
            </span>
        @endif
    </div>
</form>
@endsection
@section('card-footer')
    <button onclick="document.getElementById('postFile').submit()" class="btn btn-success mx-2">Import Events</button>
    <a href="#" class="btn btn-success" onclick="window.open('/export', '_self').close()">Export Events</a>
@endsection