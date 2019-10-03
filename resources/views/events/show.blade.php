@extends('layouts.app')
<head>

<meta property="og:title" content="Join to the event {{$event->title}}" />

<meta property="og:image" content="http://sharethis.com/images/logo.jpg" />
<meta property="og:description" content="ShareThis is its people. It's imperative that we hire smart,innovative people who can work intelligently as we continue to disrupt the very category we created. Come join us!" />
<meta property="og:site_name" content="ShareThis" />
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5d95e2afd1f7c80012256e59&product=inline-share-buttons" async="async"></script>

</head>
@section('content')
<div class="container">
        <div class="form-group">
            <input class="form-control" type="text" name="title" id="title" value="{{$event->title}}">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="description" id="description">{{$event->description}}</textarea>
        </div>
        <div class="form-group">
            <input class="form-control" type="date" name="beginDate" id="beginDate" value="{{date('Y-m-d', strtotime($event->start))}}"> <input class="form-control" type="time" name="beginTime" id="beginTime" value="{{date('H:i', strtotime($event->start))}}">
        </div>
        <div class="form-group">
            <input class="form-control"type="date" name="endDate" id="endDate" value="{{date('Y-m-d', strtotime($event->end))}}"> <input class="form-control" type="time" name="endTime" id="endTime" value="{{date('H:i', strtotime($event->end))}}">
        </div>
        
        <div class="sharethis-inline-share-buttons"></div>
</div>
@endsection