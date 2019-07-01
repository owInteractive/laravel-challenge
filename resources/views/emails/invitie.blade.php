
@component('mail::message')

# New Invite

## Hello, {{ $invite->email }}!

{{ auth()->user()->name }} has invited you to the event: 
# {{ $event->title }}

Starts on the {{ \Carbon\Carbon::parse($event->start)->format('d/m/Y H:i\h') }}

ends in {{ \Carbon\Carbon::parse($event->end)->format('d/m/Y H:i\h') }}
<br />

**Description**

> {!! nl2br($event->description) !!}

@component('mail::button', ['url' => route('controle.invite.accept', $invite->token)])
    Accept here
@endcomponent

<br />
Thanks,<br>
{{ env('APP_NAME') }}


@endcomponent
