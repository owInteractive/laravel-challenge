@include('layouts.navbars.navs.guest')
<div class="wrapper wrapper-full-page">
  <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('{{ asset('img/theatro-pedro-II-1024x682.jpg') }}'); background-size: cover; background-position: top center;align-items: center;" data-color="black">
    @yield('content')
    @include('layouts.footers.guest')
  </div>
</div>
