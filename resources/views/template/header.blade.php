<body>
    <div class="container-fluid header">
        <div class="row">
        <div class="col-md-4">
            <span class="col-md-12  page-title">{{$title}}</span>
        </div>
        <div class="col-md-2 offset-md-6 login-widget">
            @if (Auth::check())
                <a class=""  href="{{route('profile')}}">Profile</a>
                /
                <a class=""  href="{{route('logout')}}">Logout</a>
            @else
                <a class=""  href="{{route('login')}}">Login</a>
                /
                <a class="" href="{{route('register')}}">Register</a>
            @endif
        </div>
        <nav>
            <a href="{{route('home')}}">Home</a>
            @if (Auth::check())
                <a href="{{route('events')}}">Events</a>
            @endif
        </nav>
        @yield('header')
        </div>
    </div>