@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <h4>New Event</h4>
        <form action="{{ route('store') }}" method="POST" >
            {{ csrf_field() }}
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="New Party" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="This is a Happy Birthday" required></textarea>
            </div>
            <div class="form-group">
                <label for="start">Start Event</label>
                <input type="datetime-local" class="form-control" id="start" name="start" min="2020-02-01T00:00" required>
            </div>
            <div class="form-group">
                <label for="end">End Event</label>
                <input type="datetime-local" class="form-control" id="end" name="end" min="2020-02-01T00:00" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection