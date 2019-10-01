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
    <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="form-group">
            <input class="form-control" type="text" name="title" id="title">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="description" id="description"></textarea>
        </div>
        <div class="form-group">
            <input class="form-control" type="date" name="beginDate" id="beginDate"> <input class="form-control" type="time" name="beginTime" id="beginTime">
        </div>
        <div class="form-group">
            <input class="form-control"type="date" name="endDate" id="endDate"> <input class="form-control" type="time" name="endTime" id="endTime">
        </div>
        

        <button type="submit" id="submit" class="btn btn-primary"> Save </button>

    </form>
</div>
@endsection