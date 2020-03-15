<aside id="leftsidebar"
       class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn"
                type="button">
            <em class="zmdi zmdi-menu"></em>
        </button>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image"
                       href="{{ route('users.edit', auth()->user()->id) }}">
                        <img src="{{ asset('template/images/profile_av.jpg') }}"
                             alt="User">
                    </a>
                    <div class="detail">
                        <small>{{ auth()->user()->name }}</small><br />
                        <small>{{ auth()->user()->email }}</small>
                    </div>
                </div>
            </li>
            <li class="{{ menuActive(['events']) }}">
                <a href="{{ route('events.index') }}">
                    <em class="zmdi zmdi-assignment"></em>
                    <span>@lang('system.text.events')</span>
                </a>
            </li>
            <li class="{{ menuActive(['users']) }}">
                <a href="{{ route('users.index') }}">
                    <em class="zmdi zmdi-account"></em>
                    <span>@lang('system.text.users')</span>
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                    <em class="zmdi zmdi-power"></em>
                    <span>@lang('system.text.logout')</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
</aside>
