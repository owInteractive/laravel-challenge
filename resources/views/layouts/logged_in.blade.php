<div class="overflow-hidden">
    <div class="row">
        {{-- Column designed to SideBar --}}
        <div class="col-2 bg-dark min-vh-100">
            @include('partials.sidebar')
        </div>
        {{-- Column designed to Navbar and Views --}}
        <div class="col-10">
            @include('partials.navbar')
            <div class="card border-0 bg-info">
                @hasSection('card-header')
                    <div class="card-body">
                        @yield('card-header')
                    </div>
                @endif
                @hasSection('card-body')
                    <div class="card-body">
                        @yield('card-body')
                    </div>
                @endif
                @hasSection('card-footer')
                    <div class="card-body">
                        @yield('card-footer')
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>