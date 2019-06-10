@extends('layouts.backend')

@section('page')
    <div class="flex justify-between items-end w-9/12 mb-5">
        <h2 class="text-3xl mt-6 text-gray-800">Events</h2>

        <div class="flex">
            <div class="mb-3 mr-5">
                <a href="{{route('events.export')}}"
                   class="text-sm text-right text-white py-2 px-3 bg-blue-800 text-white rounded">
                    <i class="fas fa-file-download pr-2"></i>Export
                </a>
            </div>

            <div class="mb-3 mr-5">
                <a href="{{route('events.import')}}"
                   class="text-sm text-right text-white py-2 px-3 bg-blue-800 text-white rounded">
                    <i class="fas fa-file-upload pr-2"></i>Import
                </a>
            </div>

            <div class="mb-3 mr-10">
                <a href="{{route('events.create')}}"
                   class="text-sm text-right text-white py-2 px-3 bg-blue-800 text-white rounded">Create</a>
            </div>
        </div>
    </div>

    <events></events>
@endsection