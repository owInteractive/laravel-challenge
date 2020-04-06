<!DOCTYPE html>
<html>
<head>
    <title>Invite Email</title>
    <style>
        html 
        { 
            font-family: Arial !important; 
        }
    </style>
</head>
<body>
    <h2>Hi, this is an invite to the following event!</h2>
    <p>Title: {{ $invite->event->title }}</p>
    <p>Description: {{ $invite->event->description }}</p>
    <p>Owner: {{ $invite->event->user->name }}</p>
    <p>Start Date: {{ $invite->event->event_starts_at }}</p>
    <p>End Date: {{ $invite->event->event_ends_at }}</p>

    <a href="{{route('invite_confirm', ['id_event' => $invite->id])}}"> Confirm Event</a>
    <a href="{{route('invite_refuse', ['id_event' => $invite->id])}}"> Refuse Event</a>
</body>
</html>