<p>Hi,</p>

<p>Someone invited you to an event {{$event->title}}. It starts at {{ \Carbon\Carbon::parse($event->start)->diffForHumans() }} </p>

<a href="{{ route('accept', $invite->token) }}">Click here</a> to accept!