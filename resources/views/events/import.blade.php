@extends('layouts.dashboard.app')
@section('content')
<div class="row m-t-50">
    <div class="col-lg-12">
        <div class="card-box">
            <h4 class="header-title mb-4">
                Import Events

            </h4>
            <form method='post' action="{{ route('events.import') }}" enctype='multipart/form-data'>
                {{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-2 col-form-label">Default file input</label>
                    <div class="col-10">
                        <input type="file" class="form-control" name="file">
                    </div>
                </div>
                   
                <input type='submit' name='submit' value='Import' class="btn btn-block btn-custom btn-dark waves-effect waves-light">
                <a href="{{route('dashboard')}}" class="btn btn-danger btn-block">Back My Events </a>
            </form>
        </div>
    </div>
</div>

@endsection