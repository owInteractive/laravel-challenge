<?php
$url = empty(Request::segment(2)) == true ? Request::segment(1) : Request::segment(2);
 $activePage = empty($activePage) == true ? $url : $activePage;
?>
<div class="sidebar" data-color="purple" data-background-color="white"
  data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <div class="logo">
    <a href="" class="simple-text logo-normal text-center">
      {{ auth()->user()->name }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item  {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#users" aria-expanded="false">
          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
          <p>{{ __('Users') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' show' : '' }}"
          id="users">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> MP </span>
                <span class="sidebar-normal">{{ __('My profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li
        class="nav-item {{ ($activePage == 'event' || $activePage == 'today' || $activePage == 'five' || $activePage == 'calendar' || $activePage == 'invite' ) ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#events" aria-expanded="false">
          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
          <p>{{ __('Events') }}
            <b class="caret"></b>
          </p>
        </a>
        <div
          class="collapse {{ ($activePage == 'event' || $activePage == 'today' || $activePage == 'five' || $activePage == 'calendar' || $activePage == 'invite') ? ' show' : '' }} "
          id="events">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'event' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('event.index') }}">
                <span class="sidebar-mini"> ME </span>
                <span class="sidebar-normal">{{ __('My Events') }}</span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'today' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('event.today') }}">
                <span class="sidebar-mini"> ED </span>
                <span class="sidebar-normal"> {{ __('Today') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'five' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('event.five') }}">
                <span class="sidebar-mini"> FD </span>
                <span class="sidebar-normal"> {{ __('+ FIVE DAYS') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>


      <li class="nav-item{{ $activePage == 'event' ? ' active' : '' }}">

      </li>
    </ul>
  </div>
</div>