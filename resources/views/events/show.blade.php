@extends('layout')

@section('content')

    <div class="card mt-3">

        <div class="card-header d-flex justify-content-between">
            <span class="align-self-center">{{$event->title}}</span>

            <form method="post" onsubmit="return confirm('Are you sure do you want to @if($amIOwner) delete @else leave @endif this event?')">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="btn btn-sm btn-danger" type="submit">
                    @if($amIOwner) Delete @else Leave @endif event
                </button>
            </form>

        </div>

        <div class="card-body row">

            <div class="col-md-9">

                <form method="post">

                    @if($amIOwner)
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                    @endif

                    <div class="form-group">
                        <label for="inputTitle">Title</label>
                        <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Event title"
                               value="{{$event->title}}" @if(!$amIOwner) disabled @endif>
                    </div>

                    <div class="form-group">
                        <label for="inputDescription">Description</label>
                        <textarea name="description" class="form-control" id="inputDescription"
                                  @if(!$amIOwner) disabled @endif rows="3">{{$event->description}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="inputStart">Start in</label>
                        <input type="text" name="start" class="form-control form_datetime" id="inputStart"
                               readonly value="{{ date('m/d/Y H:i', strtotime($event->start_at)) }}" @if(!$amIOwner) disabled @endif>
                    </div>

                    <div class="form-group">
                        <label for="inputEnd">End in</label>
                        <input type="text" name="end" class="form-control form_datetime" id="inputEnd"
                               readonly value="{{ date('m/d/Y H:i', strtotime($event->end_at)) }}" @if(!$amIOwner) disabled @endif>
                    </div>

                    @if($amIOwner)
                        <button type="submit" class="btn btn-primary">Update event</button>
                    @endif

                </form>

            </div>

            <div class="col-md-3 mt-4 mt-md-0 border-left">

                <div class="d-flex justify-content-between mb-2">
                    <span class="align-self-center">Participants</span>
                    @if($amIOwner)
                        <button data-toggle="modal" data-target="#exampleModal"
                                class="btn btn-sm btn-secondary">Invite</button>
                    @endif
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


    @if($amIOwner)
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Invite a participant</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="/events/{{$event->id}}/invite" method="post">

                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inputEmail">E-mail</label>
                                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="E-mail" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Invite</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endif

@endsection