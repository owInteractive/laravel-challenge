@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <h4>Import to CSV</h4>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <form action="{{ route('csv.upload') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <input type="file" name="imported-file" accept=".csv" />
              <button class="btn btn-primary" type="submit">Import</button>
            </div>
        </form>

        <h4>Export to CSV</h4>
        <form action="{{route('csv.export')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <button class="btn btn-success" type="submit">Export</button>
        </form>
    </div>
</div>
@endsection