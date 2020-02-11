@extends('adminlte::page')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>Edit Event</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
        <li class="breadcrumb-item active">Edit Event</li>
      </ol>
    </div>
</div>
@endsection

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <h4>Error</h4>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
        </ul>
    </div>
@endif

<div class="card">   
        <div class="card-body">
            <form method="POST" id="form_edit" action="{{ route('events.update', ['event' => $event->id]) }}">
                @method('PUT')
                @csrf      
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$event->title}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{$event->description}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="startdate" class="col-sm-2 col-form-label">Start Date</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('startdate') is-invalid @enderror" name="startdate" value="{{ date('d/m/Y', strtotime($event->start_date)) }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="enddate" class="col-sm-2 col-form-label">End Date</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('enddate') is-invalid @enderror" name="enddate" value="{{ date('d/m/Y', strtotime($event->end_datetime)) }}" required>
                    </div>
                </div>   
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                        <input type="submit" class="btn btn-success" value="Save Event">
                </div>
            </form>
        </div>
</div>
@endsection