<nav class="pcoded-navbar navbar-collapsed">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo">
            <a href="index.html" class="b-brand">
                <div class="b-bg">
                    <i class="feather icon-trending-up"></i>
                </div>
                <span class="b-title">SYSMAX</span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>Principal</label>
                </li>
                <li class="nav-item active">
                    <a href="{{route('home')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                @if(auth()->check() && auth()->user()->hasPermissionThroughRole('view-cliente'))
                <li  class="nav-item">
                    <a href="{{route('clientes.index')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Clientes</span></a>
                </li>
                @endif

                @if(auth()->check() && auth()->user()->hasPermissionThroughRole('view-venda'))
                <li  class="nav-item">
                    <a href="{{route('vendas.index')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-shopping-cart "></i></span><span class="pcoded-mtext">Vendas</span></a>
                </li>
                @endif

                @if(auth()->check() && auth()->user()->hasPermissionThroughRole('view-atendimento'))
                <li  class="nav-item">
                    <a href="{{route('atendimentos.index')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-globe "></i></span><span class="pcoded-mtext">Fila Atendimento</span></a>
                </li>
                @endif

                @if(auth()->check() && auth()->user()->hasPermissionThroughRole('view-associacao'))
                <li  class="nav-item">
                    <a href="{{route('associacao.index')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-star "></i></span><span class="pcoded-mtext">Associação</span></a>
                </li>
                @endif

                @if(auth()->check() && auth()->user()->hasPermissionThroughRole('view-receber'))
                <li  class="nav-item">
                    <a href="{{route('receber.index')}}" class="nav-link"><span class="pcoded-micon"><i class="fa fa-money-bill "></i></span><span class="pcoded-mtext">Contas a Receber</span></a>
                </li>
                @endif



                <li class="nav-item pcoded-menu-caption">
                    <label>Cadastro</label>
                </li>
                <li data-username="basic components Button Alert Badges breadcrumb Paggination progress Tooltip popovers Carousel Cards Collapse Tabs pills Modal Grid System Typography Extra Shadows Embeds" class="nav-item pcoded-hasmenu">
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Auxiliares</span></a>
                    <ul class="pcoded-submenu">

                        @if(auth()->check() && auth()->user()->hasPermissionThroughRole('view-categoria'))
                        <li class=""><a href="{{route('categorias.index')}}" class="">Categorias</a></li>
                        @endif

                        @if(auth()->check() && auth()->user()->hasPermissionThroughRole('view-produto'))
                        <li class=""><a href="{{route('produtos.index')}}" class="">Produtos</a></li>
                        @endif

                        @if(auth()->check() && auth()->user()->hasPermissionThroughRole('view-setor'))
                        <li class=""><a href="{{route('setores.index')}}" class="">Setores</a></li>
                        @endif

                        @if(auth()->check() && auth()->user()->hasPermissionThroughRole('view-formaPagamento'))
                        <li class=""><a href="{{route('forma_pagamentos.index')}}" class="">Forma de Pagamentos</a></li>
                        @endif

                        @if(auth()->check() && auth()->user()->hasPermissionThroughRole('view-raca'))
                        <li class=""><a href="{{route('racas.index')}}" class="">Raças</a></li>
                        @endif

                        @if(auth()->check() && auth()->user()->hasPermissionThroughRole('view-vacina'))
                        <li class=""><a href="{{route('vacinas.index')}}" class="">Vacinas</a></li>
                        @endif

                        @if(auth()->check() && auth()->user()->hasPermissionThroughRole('view-nfce'))
                        <li class=""><a href="{{route('nfces.index')}}" class="">NFCE</a></li>
                        @endif

                        @if(auth()->check() && auth()->user()->hasPermissionThroughRole('view-plano'))
                        <li class=""><a href="{{route('planos.index')}}" class="">Planos</a></li>
                        @endif

                    </ul>
                </li>



                @if(auth()->check() && auth()->user()->hasPermissionThroughRole('view-admin'))
                <li class="nav-item pcoded-menu-caption">
                    <label>Administração</label>
                </li>
                <li data-username="Authentication Sign up Sign in reset password Change password Personal information profile settings map form subscribe" class="nav-item pcoded-hasmenu">
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-lock"></i></span><span class="pcoded-mtext">Gestão de Usuários</span></a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="{{route('users.index')}}" class="">Usuários</a></li>
                        <li class=""><a href="{{route('roles.index')}}" class="" >Papeis</a></li>
                        <li class=""><a href="{{route('permissions.index')}}" class="" >Permissões</a></li>
                    </ul>
                </li>
                @endif


            </ul>
        </div>
    </div>
</nav>
