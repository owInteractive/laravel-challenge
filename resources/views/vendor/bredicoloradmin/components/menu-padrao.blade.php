<ul class="nav">
    <li class="nav-header">Navigation</li>
    
    {{ $slot }}
    
    {{--  Não remova. A não ser, que coloque todas as rotas manualmente  --}}
    @if(count(config('bredidashboard.menu')))
    @forelse(config('bredidashboard.menu') as $indexMenu => $itemMenu)
    
        @if(is_string($indexMenu) and $indexMenu == 'multiple')
            <li class="has-sub {{ activeMenu($itemMenu['activeMenu']) }}">
            {{-- <li class="has-sub {{ (isset($itemMenu['multiple']['activeMenu'])) ? activeMenu($itemMenu['multiple']['activeMenu']) : '' }}"> --}}
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="{{ (isset($itemMenu['icone'])) ? $itemMenu['icone'] : 'fa fa-th-large' }}"></i>
                    <span>{{ $itemMenu['nome'] }}</span>
                </a>
                @if(isset($itemMenu['rotas']))
                <ul class="sub-menu">
                    @foreach($itemMenu['rotas'] as $itemSubmenu)
                        @can($itemSubmenu['permissao'])
                        <li class="{{ activeMenu($itemSubmenu['activeMenu']) }}">
                            <a href="{{ $itemSubmenu['link'] }}">
                                {{-- <i class="{{ (isset($itemSubmenu['icone'])) ? $itemSubmenu['icone'] : 'fa fa-th-large' }}"></i> --}}
                                <span>{{ $itemSubmenu['nome'] }}</span>
                            </a>
                        </li>
                        @endcan
                    @endforeach
                </ul>
                @endif
            </li>
        @else
            @can($itemMenu['permissao'])
            <li class="{{ activeMenu($itemMenu['activeMenu']) }}">
                <a href="{{ $itemMenu['link'] }}">
                    <i class="{{ (isset($itemMenu['icone'])) ? $itemMenu['icone'] : 'fa fa-th-large' }}"></i>
                    <span>{{ $itemMenu['nome'] }}</span>
                </a>
            </li>
            @endcan
        @endif
    @empty
    @endforelse
    @endif
    {{--  Loadmenu  --}}

    {{--  Loadmenu  --}}
    {{--
    <li class="has-sub {{ activeMenu(['bredidashboard::controle.grupo-usuario', 'bredidashboard::controle.usuario', 'bredidashboard::controle.permissao']) }}">
        <a href="javascript:;">
          <b class="caret"></b>
          <i class="fa fa-key"></i>
          <span>Controle de Acesso</span>
        </a>
        <ul class="sub-menu">
            @can('controle.grupo-usuario.index')
                <li class="{{ activeMenu('bredidashboard::controle.grupo-usuario') }}">
                    <a href="{{ route('bredidashboard::controle.grupo-usuario.index') }}">Grupo de Usuários</a>
                </li>
            @endcan
            @can('controle.usuario.index')
                <li class="{{ activeMenu('bredidashboard::controle.usuario') }}">
                    <a href="{{ route('bredidashboard::controle.usuario.index') }}">Usuários</a>
                </li>
            @endcan
            @can('controle.permissao.edit')
                <li class="{{ activeMenu('bredidashboard::controle.permissao') }}">
                    <a href="{{ route('bredidashboard::controle.permissao.edit') }}">Permissões</a>
                </li>
            @endcan
        </ul>
    </li>
    @if(in_array(Auth::user()->email, config('bredidashboard.superadmin')))
    <li class="has-sub {{ activeMenu(['bredidashboard::controle.config']) }}">
        <a href="javascript:;">
            <b class="caret"></b>
            <i class="fas fa-cogs"></i>
            <span>Sistema</span>
        </a>
        <ul class="sub-menu">
            <li class="has-sub {{ activeMenu('bredidashboard::controle.config') }}">
                <a href="{{ route('bredidashboard::controle.config.edit') }}">
                    Configurações e Layout
                </a>
            </li>
        </ul>
    </li>
    @endif
    --}}
    <!-- begin sidebar minify button -->
    <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
    <!-- end sidebar minify button -->
</ul>