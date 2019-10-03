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
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" required maxlength="250">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" required maxlength="5000"></textarea>
        </div>
        <div class="form-group">
            <label for="beginDate">Date Event Begin</label>
            <input class="form-control" type="date" name="beginDate" id="beginDate" required>
            <label for="beginTime">Hour Event Begin</label>
            <input class="form-control" type="time" name="beginTime" id="beginTime" required>
        </div>
        <div class="form-group">
            <label for="endDate">Date Event End</label>
            <input class="form-control"type="date" name="endDate" id="endDate" required>
            <small>Escolha data posterior a data de inicio</small>
            <br>
            <label for="endTime">Hour Event End</label>
            <input class="form-control" type="time" name="endTime" id="endTime" required>
        </div>
        
        <div class="container d-flex justify-content-center display-inline">
            <button type="submit" id="submit" class="btn btn-primary"> Save </button>
        </div>

    </form>
</div>
@endsection