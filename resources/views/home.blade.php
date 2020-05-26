@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-10">Eventos </div>
                        <div class="col-md-2"><a href='{{ url("/export") }}'> EXPORTAR </a></div>
                    
                    </div>
                </div>

                <div class="panel-body">
                    <div align="center">
                            <a class="btn btn-default" href='{{ url("/home") }}'> TODOS </a>
                            <a class="btn btn-default" href='{{ url("/getTodayEvents") }}'> HOJE </a>
                            <a class="btn btn-default" href='{{ url("/getNext5DaysEvents") }}'> 5 DIAS </a>
                    </div>
                    <hr/>
                    <div class="col-md-8">

                        @if( count($basicEvents) > 0 )
                            @foreach($basicEvents->all() as $basicEvent)
                                <h4> {{ $basicEvent->title }} </h4>
                                <p> {{ $basicEvent->description }} </p>
                                <p> Amigos:  
                                    @foreach($friends as $friend)
                                        @if( $friend->event_id == $basicEvent->id )
                                            {{ $friend->name }},
                                        @endif
                                    @endforeach
                                </p>

                                @if( $basicEvent->start_date == $basicEvent->end_date ) 
                                    <p><strong> {{ date('d/m/Y', strtotime($basicEvent->start_date)) }}  </strong>
                                @else 
                                    <p> de <strong> {{ date('d/m/Y', strtotime($basicEvent->start_date)) }}  </strong>
                                        até <strong> {{ date('d/m/Y', strtotime($basicEvent->end_date)) }} </strong> </p>
                                @endif
                                

                                <ul class="nav nav-pills">
                                    <li role="presentation">
                                        <a class="btn btn-primary btn-sm" href='{{ url("/edit/{$basicEvent->id}") }}'> EDIT </a>
                                    </li>
                                    <li role="presentation">
                                        <a class="btn btn-danger btn-sm" href='{{ url("/delete/{$basicEvent->id}") }}'> DELETE </a>
                                    </li>
                                </ul>

                                <cite style=""> Created on: {{ date('d/m/Y, H:i', strtotime($basicEvent->updated_at)) }} </cite>
                                <hr/>
                            @endforeach
                        @else
                            <p> No post available </p>
                        @endif

                        {{ $basicEvents->links() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
