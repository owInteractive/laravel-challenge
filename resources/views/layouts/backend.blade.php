@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="bg-gray-800 w-2/12 min-h-screen shadow">
            <h1 class="text-xl p-5 text-center text-gray-300">OW Interactive - Schedule</h1>

            <div class="m-4">
                <div class="flex justify-center">
                    <div class="h-12 w-12">
                        <span class="inline-block w-full h-full text-2xl bg-blue-500 text-gray-300 text-white text-center rounded-full flex flex-col justify-center text-uppercase">{{ auth()->user()->name_abbreviation }}</span>
                    </div>
                </div>

                <div class="w-full mb-4 mt-2">
                    <p class="block text-center text-base text-gray-300">{{ auth()->user()->name }}</p>
                    <p class="block text-center text-base text-gray-300">{{ auth()->user()->email }}</p>
                </div>

                <a href="{{route('dashboard')}}" class="block text-gray-300 hover:bg-blue-400 p-3">
                    <i class="fas fa-tachometer-alt pr-2"></i>
                    Dashboard
                </a>

                <a href="{{ route('events.index') }}" class="block text-gray-300 hover:bg-blue-400 p-3">
                    <i class="fas fa-calendar-alt pr-2"></i>
                    Events
                </a>

                <a href="{{ route('profile.edit') }}" class="block text-gray-300 hover:bg-blue-400 p-3">
                    <i class="fas fa-user pr-2"></i>
                    Edit Profile
                </a>

                <a href="javascript.void(0)" class="block text-gray-300 hover:bg-blue-400 p-3"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                    <i class="fas fa-sign-out-alt pr-2"></i>
                    Sair
                </a>

                <form action="{{route('logout')}}" hidden id="logout-form" method="post">
                    {{csrf_field()}}
                </form>

            </div>
        </div>

        <div class="min-h-screen w-10/12">
            <div class="w-full mx-auto">
                <div class="p-6">
                    @yield('page')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.3/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.3/build/css/themes/default.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('js')
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.3/build/alertify.min.js"></script>

    <script>
        alertify.set('notifier', 'position', 'top-right');
    </script>

    @if(session('success'))
        <script>
            alertify.success('{{session('success')}}');
        </script>
    @elseif(session('error'))
        <script>
            alertify.error('{{session('success')}}');
        </script>
    @elseif(session('info'))
        <script>
            alertify.notify('{{session('info')}}');
        </script>
    @endif
@endpush