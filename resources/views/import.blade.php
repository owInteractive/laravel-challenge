@extends('layouts.app')

@section('content')
    <div class="container card">
        <h2 class="text-center">CSV file import</h2>
        @include('layouts.messages')
        <div class="row justify-content-center">
            <div class="panel panel-default justify-content-center">
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('events.importcsv') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                            <input id="csv_file" type="file" class="form-control" name="csv_file" accept = ".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, text/plain" required>
                        </div>
                        <div class="container d-flex justify-content-center">
                            <button type="submit" class="btn btn-secondary">
                                Import CSV
                            </button>
                        </div>
                    </form>
                </div>       
            </div>
            


                
        </div>
        

            
            
    </div>
    <div class="container justify-content-center">
            @if(count($events_created)!=0)
                <h2 class="text-center">Events Added</h2>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Begin Date</th>
                        <th scope="col">End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events_created as $event)
                            <tr>
                                <td><a href="{{ route('events.show', ['id'=>$event->id]) }}">{{$event->title}}</a></td>
                                <td>{{$event->start}}</td>
                                <td>{{$event->end}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif      
        </div>

    
@endsection