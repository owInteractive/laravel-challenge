<nav class="navbar navbar-expand-lg navbar-light py-3" id="sideNav">
    <div class="container">
      <a class="nav-link js-scroll-trigger" href="{{ url('/') }}">Events</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
            
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="{{ url('/pacotes') }}">Pacotes</a>
          </li>
        
          @if (Auth::guest())
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('register') }}">Register</a></li>
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Eventos <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('/events') }}">
                            Eventos de Hoje
                        </a>
                        <a class="dropdown-item" href="{{ url('/eventsNext') }}">
                            Eventos próximos cinco dias
                        </a>
                        <a class="dropdown-item" href="{{ url('/allEvents') }}">
                            Todos os Eventos
                        </a>     
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link js-scroll-trigger" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ route('events.myevents', ['user'=>Auth::id()]) }}">Meus Eventos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ url('/newEvents') }}">Criar Evento</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ route('users.myprofile', ['user'=>Auth::id()]) }}">Meu Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"
                                            class="nav-link js-scroll-trigger">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
      </div>
    </div>
</nav>