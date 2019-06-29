@component('bredicoloradmin::components.menu-padrao')
    
<li class="{{ activeMenu('bredidashboard::dashboard') }}">
    <a href="{{ route('bredidashboard::dashboard') }}">
        <i class="fa fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
    {{ \Carbon\Carbon::now() }}
</li>
<li class="{{ activeMenu(['controle.event']) }} has-sub">
    <a href="javascript:;">
        <i class="fa fa-tachometer-alt"></i>
        <b class="caret"></b>
        <span>Events</span>
    </a>
    <ul class="sub-menu">
        <li class="{{ activeMenu(['controle.event.create']) }}">
            <a href="{{ route('controle.event.create') }}">
                Create Event
            </a>
        </li>
        <li class="{{ activeMenu(['controle.event.today']) }}">
            <a href="{{ route('controle.event.today') }}">
                Events Today
            </a>
        </li>
        <li class="{{ activeMenu(['controle.event.nextDays']) }}">
            <a href="{{ route('controle.event.nextDays') }}">
                Next 5 days
            </a>
        </li>
        <li class="{{ activeMenu(['controle.event.index']) }}">
            <a href="{{ route('controle.event.index') }}">
                All Events
            </a>
        </li>
    </ul>
</li>

{{--  Loadmenu  --}}

@endcomponent

{{-- Exemplo de menu e níveis --}}
{{-- <li class="has-sub">
    <a href="javascript:;">
        <b class="caret"></b>
        <i class="fa fa-align-left"></i>
        <span>Menu Level</span>
    </a>
    <ul class="sub-menu">
        <li class="has-sub">
            <a href="javascript:;">
                <b class="caret"></b>
                Menu 1.1
            </a>
            <ul class="sub-menu">
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        Menu 2.1
                    </a>
                    <ul class="sub-menu">
                        <li><a href="javascript:;">Menu 3.1</a></li>
                        <li><a href="javascript:;">Menu 3.2</a></li>
                    </ul>
                </li>
                <li><a href="javascript:;">Menu 2.2</a></li>
                <li><a href="javascript:;">Menu 2.3</a></li>
            </ul>
        </li>
        <li><a href="javascript:;">Menu 1.2</a></li>
        <li><a href="javascript:;">Menu 1.3</a></li>
    </ul>
</li> --}}