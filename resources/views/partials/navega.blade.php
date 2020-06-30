<nav class="navbar bg-white shadow-sm">
    <div class="container">
        <a class="navbar" href="{{ route('Home')}}">
        {{ config('app.name') }}
        </a>
    
        <ul class="nav nav-pills">
            <il class="nav-item">
                <a class="nav-link {{ setActive('Home')}}" href="{{ route('Home')}}">@lang('Inicio')</a></il>
            
           

            
            @auth

            <il class="nav-item">
                <a class="nav-link {{ setActive('Datos.*')}} " href="{{ route('Datos.index')}}">@lang('Eventos')</a></il>
            <il class="nav-item">
                <a class="nav-link {{ setActive('Contacto')}}" href="{{ route('Contacto')}}">@lang('Invitar')</a></il>
            <li class="nav-item">
                <a class="nav-link {{ setActive('logout-form')}}" href="#" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ ('Cerrar Sesión') }}</a></li>


                    
                
            @else
                <il><a class="nav-link {{ setActive('login')}}"href="{{ route('login') }}">Iniciar Sesion</a></il>
                <il><a class="nav-link {{ setActive('login')}}"href="{{ route('register') }}">Registrarse</a></il>
                
            @endauth
            
            
        </ul>
    </div>        
</nav>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>
      