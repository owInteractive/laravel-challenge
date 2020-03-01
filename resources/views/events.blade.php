<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
    <link href="{{ asset('fullcalendar/core/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('fullcalendar/daygrid/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('fullcalendar/timegrid/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('fullcalendar/list/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('fullcalendar/bootstrap/main.css') }}" rel='stylesheet' />

    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{asset('fullcalendar/core/main.js')}}"></script>
    <script src="{{asset('fullcalendar/daygrid/main.js')}}"></script>
    <script src="{{asset('fullcalendar/timegrid/main.js')}}"></script>
    <script src="{{asset('fullcalendar/list/main.js')}}"></script>
    <script src="{{asset('fullcalendar/bootstrap/main.js')}}"></script>
    <script src="{{asset('fullcalendar/interaction/main.js')}}"></script>
    <script src="{{asset('fullcalendar/moment/main.js')}}"></script>
    <script src="{{asset('js/calendar.js')}}"></script>

    <title>My Calendar App</title>

</head>

<body>
    <div>
        <h3 class="text-center">My Calendar App</h3>
    </div>

    <div class="container" id="calendar"></div>


</body>

</html>