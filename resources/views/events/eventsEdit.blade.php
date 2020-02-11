@extends('layouts.app')

@section('content')
    <form action="{{ route('events.update', ['event' => $event]) }}" method="POST">
        {{method_field('PATCH')}}
        @include('subViews.eventsFields')
    </form>
@stop