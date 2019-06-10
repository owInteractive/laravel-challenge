@extends('layouts.backend')

@section('page')
    <div class="mb-5">
        <h2 class="text-3xl mt-6 text-gray-800">New Event</h2>
    </div>

    <form class="bg-white w-full rounded shadow p-5 border-t-2 border-blue-600" action="{{route('events.store')}}" method="post">
        @include('events.__form')

        <button class="py-2 px-3 bg-blue-800 text-white rounded">Create Event</button>
    </form>
@endsection