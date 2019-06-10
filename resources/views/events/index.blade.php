@extends('layouts.backend')

@section('page')
    <div class="flex justify-between items-end w-10/12 mb-5">
        <h2 class="text-3xl mt-6 text-gray-800">Events</h2>

        <div class="mb-3 mr-10">
            <a href="{{route('events.create')}}" class="text-sm text-right text-white py-2 px-3 bg-blue-800 text-white rounded">Create</a>
        </div>
    </div>

    <events></events>
@endsection