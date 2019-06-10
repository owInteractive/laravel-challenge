@extends('layouts.backend')

@section('page')
    <h2 class="text-2xl mt-6">Dashboard</h2>

    <div class="flex items-stretch w-full mt-5">
        <div class="self-start bg-white w-6/12 mr-5 max-h-screen overflow-auto rounded border-t-2 border-blue-600">
            <h3 class="text-xl p-5">Today Events - {{\Carbon\Carbon::now()->format('D d, M')}}</h3>

            @forelse($today_events as $today_event)
                <div class="inline-block w-full hover:bg-gray-200 border-b-2 p-5 flex justify-between">
                    <div class="pt-2">
                        <span class="block text-base text-blue-600">{{$today_event->title}}</span>
                        <span class="text-gray-700">{{$today_event->starts_at->format('H:i A')}}</span>
                        <span class="text-gray-700">to</span>
                        <span class="text-gray-700">{{$today_event->ends_in->format('H:i A')}}</span>
                        <span class="block text-sm text-gray-700 pt-2">Description: {{$today_event->description}}</span>
                    </div>
                </div>
            @empty
                <div class="text-blue-600 p-5">
                    <span>No events registered today.</span>
                </div>
            @endforelse
        </div>

        <div class="self-start bg-white w-6/12 max-h-screen overflow-auto rounded border-t-2 border-blue-600">
            <h3 class="text-xl p-5 ">Next 5 Days Events</h3>
            @forelse($next_events as $next_event)
                <div class="inline-block w-full hover:bg-gray-200 border-b-2 p-5 flex justify-between">
                    <div class="pt-2">
                        <p class="text-base text-gray-700 font-medium">
                            {{$next_event->starts_at->format('D, M d')}}
                        </p>
                        <span class="text-gray-700">{{$next_event->starts_at->format('H:i A')}}</span>
                        <span class="text-gray-700">to</span>
                        <span class="text-gray-700">{{$next_event->ends_in->format('H:i A')}}</span>
                        <span class="text-base ml-10 text-blue-600">{{$next_event->title}}</span>
                        <span class="block text-sm text-gray-700 pt-2">Description: {{$next_event->description}}</span>
                    </div>
                </div>
            @empty
                <div class="text-blue-600 p-5">
                    <span>No event registered for the next days.</span>
                </div>
            @endforelse
            <div class="flex justify-center">
                {{ $next_events->links() }}
            </div>
        </div>
    </div>
@endsection