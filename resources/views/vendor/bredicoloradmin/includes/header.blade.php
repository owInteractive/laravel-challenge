<div id="header" class="header navbar-default">
    <!-- begin navbar-header -->
    <div class="navbar-header">
        <a href="{{ route('bredidashboard::dashboard') }}" class="navbar-brand">
            
            @if(isset($config->logo) and !empty($config->logo))
                <img src="{{ $config->logo }}" alt="">
            @else
                <span class="navbar-logo"></span> 
            @endif
            {{--  <b>Color</b> Admin  --}}
            {{--  {{ env('APP_NAME') }}  --}}
        </a>
        <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <!-- end navbar-header -->

    <!-- begin header-nav -->
    <ul class="navbar-nav navbar-right">
        {{--  <li>
            <form class="navbar-form">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter keyword" />
                    <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </li>  --}}
        {{--  <li class="dropdown">
            <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
                <i class="fa fa-bell"></i>
                <span class="label">0</span>
            </a>
            <ul class="dropdown-menu media-list dropdown-menu-right">
                <li class="dropdown-header">NOTIFICATIONS (0)</li>
                <li class="text-center width-300 p-b-10">
                    No notification found
                </li>
            </ul>
        </li>  --}}
        <li class="dropdown navbar-user">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    @if(!empty(auth()->user()->imagem))
                        <img src="{{ route('imagem.render', 'user/p/' . auth()->user()->imagem) }}" alt="">
                    @else
                        <div class="image image-icon bg-black text-grey-darker">
                            <i class="fa fa-user"></i>
                        </div>
                    @endif

                <span class="d-none d-md-inline">{{ auth()->user()->name }}</span> <b class="caret"></b>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('bredidashboard::controle.profile.edit') }}" class="dropdown-item">Editar perfil</a>
                {{--  <a href="javascript:;" class="dropdown-item"><span class="badge badge-danger pull-right">2</span> Inbox</a>
                <a href="javascript:;" class="dropdown-item">Calendar</a>
                <a href="javascript:;" class="dropdown-item">Setting</a>  --}}
                <div class="dropdown-divider"></div>
                <a href="{{ route('bredidashboard::logout') }}" class="dropdown-item">Sair</a>
            </div>
        </li>
    </ul>
    <!-- end header navigation right -->
</div>