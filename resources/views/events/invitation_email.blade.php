@extends('layouts.app')

@section('content')
    <p>You have been invited by <span class="font-bold">{{ $user->name }}</span> to participate in the <span
                class="font-bold">{{ $event->title }}</span> on day <span
                class="font-bold">{{ $event->starts_at }}</span>.</p>

    <a href="{{ route('events.invite.confirm', $invite->code) }}">Click here to confirm presence.</a>
@endsection