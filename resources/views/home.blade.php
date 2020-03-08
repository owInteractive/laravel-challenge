@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Event
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Event Form -->
                    <form action="{{ url('event') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Event Title -->
                        <div class="form-group">
                            <label for="event-title" class="col-sm-3 control-label">Title</label>

                            <div class="col-sm-6">
                                <input type="text" name="title" id="event-title" class="form-control" value="{{ old('title') }}">
                            </div>
                        </div>

                        <!-- Event Description -->
                        <div class="form-group">
                            <label for="event-description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-6">
                                <input type="text" name="description" id="event-description" class="form-control" value="{{ old('description') }}">
                            </div>
                        </div>

                        <!-- Event Starts At -->
                        <div class="form-group">
                            <label for="event-startsAt" class="col-sm-3 control-label">Starts At</label>

                            <div class="col-sm-6">
                                <input type="date" name="startsAt" id="event-startsAt" class="form-control" value="{{ old('startsAt') }}">
                            </div>
                        </div>

                        <!-- Event Ends At -->
                        <div class="form-group">
                            <label for="event-endsAt" class="col-sm-3 control-label">Ends At</label>

                            <div class="col-sm-6">
                                <input type="date" name="endsAt" id="event-endsAt" class="form-control" value="{{ old('endsAt') }}">
                            </div>
                        </div>

                        <!-- Add Event Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Event
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Events -->
            @if (count($events) > 0)
            
                <div class="panel panel-default">
                    
                    <div class="panel-heading text-center">
                        
                        {{ $eventDay }} Events
                        
                        <div style="text-align:center;">
                            <form action="{{ url('import') }}" method="POST" id="import" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="custom-file">
                                    <input name="csv" type="file" class="custom-file-input" id="file" style="margin-left:30%" accept=".csv">
                                    <label class="custom-file-label" for="file" data-browse="Bestand kiezen">Chose a option</label>
                                  </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-trash"></i>Import CSV
                                </button>

                                <button type="button" class="btn btn-primary" id="export">
                                    <i class="fa fa-btn fa-trash"></i>Export CSV
                                </button>
                            </form>

                            
                        </div>                        

                        <div class="checkbox text-center">
                            <label>
                                <input type="radio" @if($eventDay == 'All') checked @endif name="day" onclick="window.location = '{{ route('home') }}'"> All
                            </label>
                            <label>
                                <input type="radio" @if($eventDay == 'Next five days') checked @endif name="day" onclick="window.location = '{{ route('five') }}'"> Next five Days
                            </label>
                            <label>
                                <input type="radio" @if($eventDay == 'Today') checked @endif name="day" onclick="window.location = '{{ route('today') }}'"> Today
                            </label>

                            
                        </div>
                        

                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Event</th>
                                <th>Start At</th>
                                <th>End At</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td class="table-text"><div>{{ $event->title }}</div></td>
                                        <td class="table-text"><div>{{ date('d/m/Y', strtotime($event->starts_at)) }}</div></td>
                                        <td class="table-text"><div>{{ date('d/m/Y', strtotime($event->ends_at)) }}</div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <form action="{{url('event/' . $event->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-event-{{ $event->id }}" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($eventDay == 'All')
                    <div class="text-center">
                        {{ $events->links() }}
                    </div>
                @endif

            @endif
        </div>
    </div>
    
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script>
    
    $(document).ready(function(){

        $('#export').click('click',function(){
            $.ajax({
                url: "{{url('export')}}/"+'{{ $eventDay }}',
                method: "GET",  
                data: {'_token': '{{ csrf_token() }}'},
                success: function(data) {
                    var a = document.createElement('a');
                    var url = data;
                    a.href = url;
                    a.download = 'Events.csv';
                    document.body.append(a);
                    a.click();
                    // a.remove();
                    // window.URL.revokeObjectURL(url);
                }
            });
        });

        $('#import').on('submit', function(){
            if( document.getElementById("file").files.length == 0 ){
                console.log("no files selected");
                return false;
            }
        });

    });

</script>