@extends('layout')

@section('content')

    <div class="card mt-3">

        <div class="card-header">
            <span class="align-self-center">New Event</span>
        </div>

        <div class="card-body">

            <form method="post">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="inputTitle">Title</label>
                    <input type="text" name="title" class="form-control" id="inputTitle"
                           placeholder="Event title" value="{{old('title')}}">
                </div>

                <div class="form-group">
                    <label for="inputDescription">Description</label>
                    <textarea name="description" class="form-control" id="inputDescription" rows="3">{{old('description')}}</textarea>
                </div>

                <div class="form-group">
                    <label for="inputStart">Start in</label>
                    <input type="datetime-local" name="start" class="form-control"
                           id="inputStart" value="{{old('start_at')}}">
                </div>

                <div class="form-group">
                    <label for="inputEnd">End in</label>
                    <input type="datetime-local" name="end" class="form-control"
                           id="inputEnd" value="{{old('end_at')}}">
                </div>

                <button type="submit" class="btn btn-primary">Create event</button>

            </form>

        </div>

    </div>

@endsection