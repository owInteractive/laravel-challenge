<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.template.head')
    @yield('extra-styles')
    <link rel="stylesheet"
          href="{{ asset('template/css/style.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('template/css/styles.css') }}">
</head>

<body class="theme-orange theme-white">
@include('layouts.template.loader')
<div class="overlay"></div>
@include('layouts.template.menu')
<section class="content">
    <div class="body_scroll">
        @yield('content')
    </div>
</section>
@include('layouts.template.scripts')
@yield('extra-scripts')
</body>
</html>
