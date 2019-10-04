@extends('layouts.app')
<head>

<meta property="og:title" content="Join the event {{$event->title}}! It starts {{$event->start}} and ends in {{$event->end}}!" />
<meta property="og:href" content="localhost:8000/events/{{$event->id}}" />
<meta property="og:description" content="{{$event->description}}" />
<meta property="og:site_name" content="Events" />
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5d95e2afd1f7c80012256e59&product=inline-share-buttons" async="async"></script>

</head>
@section('content')
<div class="container card">
    <h1 class="text-center">{{$event->title}}</h1>

    <p class="text-center">Description: {!! nl2br(e($event->description)) !!}</p>

    <small class="text-center">Begin: {{$event->start}}</small><br>
    <small class="text-center">End: {{$event->end}}</small>
    
    <div class="footer-section">  
        <h4 class="text-center">Invite your friends to this event</h4>
        <div class="sharethis-inline-share-buttons"></div>
    </div>
</div>
@endsection