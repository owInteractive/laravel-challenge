@component('mail::message')
# Convite enviado de {{ $event['user']['name'] }} <{{ $event['user']['email'] }}>

Gostaria de participar desse evento?

@component('mail::button', ['url' => $url])
Sim, confirmar!
@endcomponent

@endcomponent
