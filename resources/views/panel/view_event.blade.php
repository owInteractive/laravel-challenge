@extends('template.template')
@section('load_assets')
    <script src="{{url('js/events.js')}}" type="text/javascript" charset="utf-8"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="display: contents">
                <div class="content-data col-md-12">
                    <div class="col-md-12 event-list">
                        <div class="">
                            <span class="event-list-span"><i class="fa fa-calendar"></i> Event Form</span>
                        </div>
                        <form method="post" @if(isset($event)) action="{{route('events_edit', ['id_event' => $event->id])}}" @else action="{{route('events_create')}} @endif ">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <button class="close" data-close="alert"></button>
                                    @foreach ($errors->all() as $error)
                                        <span>{{$error}}</span><br>
                                    @endforeach
                                </div>
                            @endif
                            {{csrf_field()}}
                            @if(isset($event))
                                <input type="hidden" name="id_event" value="{{$event->id_event}}"/>
                            @endif
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label class="control-label" for="title">Title</label>
                                        <input @if(isset($event)) value="{{$event->title}}" @endif id="title" name="title" maxlength="50" type="text" class="form-control">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="control-label" for="description">Description</label>
                                        <input @if(isset($event)) value="{{$event->short_description}}" @endif id="description" maxlength="150" name="description" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="control-label" for="event_starts">Event starts</label>
                                        <input @if(isset($event)) value="{{$event->event_starts_at}}" @endif id="event_starts" maxlength="10" name="event_starts" type="text" class="form-control datepicker">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label" for="event_ends">Event ends</label>
                                        <input @if(isset($event)) value="{{$event->event_ends_at}}" @endif id="event_ends" maxlength="10" name="event_ends" type="text" class="form-control datepicker">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ URL::previous() }}" style="float: right" class="btn btn-light"><i class="fas fa-times"></i> Cancel</a>

                                        @if(isset($event))
                                        <button style="float: right" class="btn btn-light" type="submit"><i class="fas fa-edit"></i> Update event</button>
                                        @else
                                        <button style="float: right" class="btn btn-light" type="submit"><i class="fa fa-plus"></i> Add event</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
