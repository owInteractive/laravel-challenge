<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    @yield('pre_js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">


    <!-- Styles -->
    <link href="{{ mix('css/d/schedule.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body>

    @if (Auth::guest())
    @yield('content')
    @else
    <div id="app">
        @include('layouts.dashboard._header')
        <div class="wrapper">
                
            <div class="container-fluid">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
    
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
                @yield('content')
            </div>

            <vue-snotify></vue-snotify>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    {{ __('labels.Year') }} © {{config('app.name') }}
                </div>
            </div>
        </div>
    </footer>
    @endif
    <!-- Scripts -->
    <!-- Scripts -->
    <script src="{{ mix('js/d/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script src="{{ mix('js/d/jquery.slimscroll.js') }}"></script>
    <script src="{{ mix('js/d/jquery.app.js') }}"></script>
    @yield('js')
</body>

</html>