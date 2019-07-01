@extends('layouts.page')
@section('content')
<div class="error">
    <h4>New Invite for you</h4>
    <h2>
        {!! $event->title !!}
    </h2>
    <p>
        {!! nl2br($event->description) !!}
    </p>
    <p>
        <strong>
            {{ \Carbon\Carbon::parse($event->start)->format('m/d/Y H:i\h ') }} at {{ \Carbon\Carbon::parse($event->end)->format('m/d/Y H:i\h') }}
        </strong>
    </p>

    <label  class="label label-success"><strong>by:</strong> {{ $event->user->name }}</label>

    <div class="error-content">
        <div class="error-message">
            {{ \Carbon\Carbon::parse($event->start)->format('m/d/Y') }} at {{ \Carbon\Carbon::parse($event->end)->format('m/d/Y') }}
        </div>
        <div class="error-desc m-b-30">
            @if(\Carbon\Carbon::now() > \Carbon\Carbon::parse($event->end))
            <a href="javascript:void(0)" class="btn btn-primary disabled">Event Expired</a>
            @else
                <a href="{{ route('controle.invite.accepting', $invite->token) }}" class="btn btn-success">Join the event</a>
            @endif
        </div>
        <div>
            <a href="/" class="btn btn-primary btn-xs p-l-20 p-r-20">Go Home</a>
        </div>
    </div>
</div>
@endsection