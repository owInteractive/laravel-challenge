<!doctype html>
    <html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ env("APP_NAME") }}</title>
        <link rel="stylesheet" href="{{ asset("css/app.css") }}" />
    </head>
    <body>
        @if(\Illuminate\Support\Facades\Auth::check())
            @include("layouts.logged_in")
        @else
            @include("layouts.not_logged_in")
        @endif
        <script src="{{ asset("js/app.js") }}"></script>
    </body>
</html>