<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-main">
        <div class="container-fluid">

            <!-- Logo container-->
            <div class="logo">
                <a href="{{ route('start') }}" class="logo">
                    <span class="logo-small">{{config('app.name') }}</span>
                    <span class="logo-large">{{config('app.name') }}</span>
                </a>
            </div>
            <!-- End Logo container-->

            <div class="menu-extras topbar-custom">

                <ul class="list-unstyled topbar-right-menu float-right mb-0">

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle waves-effect nav-user" data-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="/img/d/users/avatar-1.jpg" alt="user" class="rounded-circle"> <span
                                class="ml-1 pro-user-name">{{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                            <!-- item-->
                            <a href="{{ route('my.account.get') }}" class="dropdown-item notify-item">
                                <i class="fi-head"></i> <span>{{__('labels.MyAccount')}}</span>
                            </a>

                            <!-- item-->
                            <a href="{{ route('change-password') }}" class="dropdown-item notify-item">
                                <i class="fi-cog"></i> <span>{{__('labels.ChangePassword')}}</span>
                            </a>

                            <!-- item-->
                            <a href="{{ url('/logout') }}" class="dropdown-item notify-item"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fi-power"></i> <span>{{__('labels.Logout')}}</span>
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                        </div>
                    </li>

                    <li class="menu-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle nav-link">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>
                </ul>
            </div>
            <!-- end menu-extras -->

            <div class="clearfix"></div>

        </div>
        <!-- end container -->
    </div>
    <!-- end topbar-main -->

    <div class="navbar-custom bg-dark">
        <div class="container-fluid">
            <div id="navigation">
                <!-- Navigation Menu-->

                <ul class="navigation-menu">

                    <li class="has-submenu">
                        <a href="#">
                            <i class="icon-home"></i>My Events
                        </a>
                        <ul class="submenu">
                            <li><a href="{{route('dashboard')}}">See All</a> </li>
                            <li><a href="{{ route('events.import.get') }}">Import Events</a> </li>
                            <li><a href="{{ route('events.export', ['type' => 'csv']) }}">Export Events</a> </li>
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="javascript:void(0)">
                            <i class="icon-people"></i>Convide amigos
                            <i class="fa fa-warning text-warning"></i>
                        </a>
                    </li>


                </ul>
                <!-- End navigation menu -->
            </div>
            <!-- end #navigation -->
        </div>
        <!-- end container -->
    </div>
    <!-- end navbar-custom -->
</header>
<!-- End Navigation Bar-->