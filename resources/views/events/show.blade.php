@extends('layout')

@section('content')

    <div class="card mt-3">

        <div class="card-header d-flex justify-content-between">
            <span class="align-self-center">{{$event->title}}</span>

            <form method="post" onsubmit="return confirm('Are you sure do you want to delete this event?')">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="btn btn-sm btn-danger" type="submit">
                    Delete event
                </button>
            </form>

        </div>

        <div class="card-body row">

            <div class="col-9">

                <form method="post">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label for="inputTitle">Title</label>
                        <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Event title"
                               value="{{$event->title}}">
                    </div>

                    <div class="form-group">
                        <label for="inputDescription">Description</label>
                        <textarea name="description" class="form-control" id="inputDescription" rows="3">{{$event->description}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="inputStart">Start in</label>
                        <input type="datetime-local" name="start" class="form-control" id="inputStart" value="{{$event->getStartAtAsW3c()}}">
                    </div>

                    <div class="form-group">
                        <label for="inputEnd">End in</label>
                        <input type="datetime-local" name="end" class="form-control" id="inputEnd" value="{{$event->getEndAtAsW3c()}}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update event</button>

                </form>

            </div>

            <div class="col-3 border-left">

                <div class="d-flex justify-content-between mb-2">
                    <span class="align-self-center">Participants</span>
                    <button type="submit" class="btn btn-sm btn-secondary">Invite</button>
                </div>

                <ul class="list-group">
                    @foreach($event->participants as $participant)
                        <li @if($participant->pivot->owner == true) title="Owner" @endif class="list-group-item">
                            <small>
                                {{$participant->name}}
                                @if($participant->pivot->owner == true)
                                    <i class="fa fa-star text-warning"></i>
                                @endif
                            </small>
                        </li>
                    @endforeach
                </ul>

            </div>

        </div>

    </div>

@endsection