@extends('layouts.app')

@section('content')
    <form action="{{ route('events.store') }}" method="POST">
        @include('subViews.eventsFields')
    </form>
@stop