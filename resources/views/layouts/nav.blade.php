<nav class="navbar navbar-expand-lg navbar-light py-3" id="sideNav">
    <div class="container">
      <a class="nav-link js-scroll-trigger" href="{{ url('/') }}">Events</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          @if (Auth::guest())
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('register') }}">Register</a></li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/newEvents') }}">
                        Create Events
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ url('/import') }}">
                        Import CSV
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Events <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('/allEvents') }}">
                            All Events
                        </a>    
                        <a class="dropdown-item" href="{{ url('/') }}">
                            Today Events
                        </a>
                        <a class="dropdown-item" href="{{ url('/eventsNext') }}">
                            Next Five Days Events
                        </a> 
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
        
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('events.myevents', ['user'=>Auth::id()]) }}">
                            My Events
                        </a>    
                        <a class="dropdown-item"  href="{{ route('users.myprofile', ['user'=>Auth::id()]) }}">
                            My Profile
                        </a>
                        <a class="dropdown-item"  href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                                        class="nav-link js-scroll-trigger">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
                
            @endif
        </ul>
      </div>
    </div>
</nav>