
@component('mail::message')

# New Invite

<h2>Hello, {{ $invite->email }}!</h2>


A new invite from event {{ $invite->title }}, {{ \Carbon\Carbon::parse($invite->start)->format('m/d/Y \a\t H:i') }}

@component('mail::button', ['url' => route('controle.invite.accept', $invite->token)])
    Accept here
@endcomponent

<br />
Thanks,<br>
Ow Interactive


@endcomponent
