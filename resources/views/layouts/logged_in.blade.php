<div class="bg-light-custom">
    @include('partials.navbar_logged')
    <div class="row" >
        {{-- Column designed to SideBar --}}
        <div class="col-2 bg-grey min-vh-100 overflow-auto">
            @include('partials.sidebar')
        </div>
        {{-- Column designed to Navbar and Views --}}
        <div class="col-10" style="overflow-y: scroll !important; max-height: 91vh; z-index: 99999">
            <div class="card min-vh-30 border-0 shadow mr-3">
                @hasSection('card-header')
                    <div class="card-body border-bottom">
                        @yield('card-header')
                    </div>
                @endif
                @hasSection('card-body')
                    <div class="card-body border-bottom">
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