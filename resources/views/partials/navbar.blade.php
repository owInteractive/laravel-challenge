<nav class="navbar navbar-expand-lg navbar-light bg-light">
    @if(!Auth::check())
        <a class="navbar-brand" href="#">{{ env("APP_NAME") }}</a>
    @else
        <a class="navbar-nav b4-" href="#">Welcome, {{ Auth::user()->name }}</a>
    @endif
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        @if(Auth::check())
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <form method="POST" action="{{ url("/logout") }}">
                        {{ csrf_field() }}
                        <button class="btn btn-outline-danger" type="submit">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        @else
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="btn btn-link" href="{{ url("/login") }}">
                        <i class="fas fa-sign-in-alt mr-1"></i> {{ __("auth.login") }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-link" href="{{ url("/register") }}">
                        <i class="fas fa-user-plus mr-1"></i> {{ __("auth.register") }}
                    </a>
                </li>
            </ul>
        @endif
    </div>
</nav>