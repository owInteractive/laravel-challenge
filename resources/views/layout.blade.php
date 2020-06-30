<!DOCTYPE html>
<html>
<head>
      <title>@yield('title')</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="stylesheet" href="{{ mix('css/app.css') }}">
      <script src="{{ mix('css/app.css') }}"></script>
      
</head>
<body>
    <div id="app" class="d-flex flex-column h-screen justify-content-between"> 
    <header>
        @include('partials.navega')
    </header>
    <main class="py-4">
        @yield('content')
    </main>

    <footer class="bg-white text-center text-black-40 py-4 shadow">
        {{ config('app.name') }} | Organización Colombiana {{ date('Y')}}
    </footer>

    </div>
</body>
</html>