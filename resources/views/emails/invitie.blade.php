
@component('mail::message')

# New Invitie

<h2>Hello, {{ $invitie->email }}!</h2>


A new invitie from event {{ $invitie->title }}, {{ \Carbon\Carbon::parse($invitie->start)->format('m/d/Y \a\t H:i') }}

@component('mail::button', ['url' => '/'])
    Accept here
@endcomponent

<br />
Thanks,<br>
Ow Interactive


@endcomponent
