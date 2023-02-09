<div>
            {{-- <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fa-solid fa-fish-fins"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">MoradaFisher <sup>1.0</sup></div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="index.html">
                        <i class="fas fa-house"></i>
                        <span>Início</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Cadastro
                </div>

                <!-- Nav Item - Charts -->
                <li class="nav-item @if(url()->current() === route("funcionarios.index")) active @endif">
                    <a
                        class="nav-link"
                        href="{{route("funcionarios.index")}}"
                    >
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Funcionários</span></a>
                </li>

                <!-- Nav Item - Tables -->
                <li class="nav-item @if(url()->current() === route("produtos.index")) active @endif">
                    <a class="nav-link" href="{{route('produtos.index')}}">
                        <i class="fa-solid fa-cart-plus"></i>
                        <span>Produtos</span></a>
                </li>

                <!-- Nav Item - Tables -->
                <li class="nav-item @if(url()->current() === route("lancamentos.index") || url()->current() === route("lancamentos.cadastrar")) active @endif">
                    <a class="nav-link" href="{{route('lancamentos.index')}}">
                        <i class="fa-sharp fa-solid fa-basket-shopping"></i>
                        <span>Lançamentos</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Relatórios
                </div>

                 <!-- Nav Item - Tables -->
                 <li class="nav-item @if(url()->current() === route("dashboard.index")) active @endif">
                    <a class="nav-link" href="{{route('dashboard.index')}}">
                        <i class="fa-solid fa-gauge-high"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Nav Item - Tables -->
                <li class="nav-item @if(url()->current() === route("dashboard.funcionario")) active @endif">
                    <a class="nav-link" href="{{route('dashboard.funcionario')}}">
                        <i class="fa-solid fa-chalkboard-user"></i>
                        <span>Funcionário</span></a>
                </li>

                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar --> --}}

            <div class="offcanvas offcanvas-start bg-gradient-dark text-white navbar-nav" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="d-flex align-items-center justify-content-between h4 my-2">
                        <div class="sidebar-brand-icon rotate-n-15">
                            <i class="fa-solid fa-fish-fins"></i>
                        </div>
                        <div class="sidebar-brand-text mx-3">MoradaFisher <sup class="text-xs">1.0</sup></div>
                    </div>
                    <div class="text-xs text-uppercase text-bold text-white-50 mt-4">
                        Cadastro
                    </div>
                    @if(Auth::user()->can('funcionario_listar'))
                    <div class="nav-item d-flex justify-content-start align-items-center my-3">
                        <a
                            class="nav-link-offset text-decoration-none @if(url()->current() === route("funcionarios.index")) text-white fw-bold @else text-white-50 @endif"
                            href="{{route("funcionarios.index")}}"
                        >
                            <i class="fa-solid fa-user-plus"></i>
                            <span class="ml-2">Funcionários</span>
                        </a>
                    </div>
                    @endif
                    @if(Auth::user()->can('lancamento_listar'))
                    <div class="nav-item d-flex justify-content-start align-items-center my-3">
                        <a
                            class="nav-link-offset text-decoration-none opacity-100 opacity-50-hover @if(url()->current() === route("lancamentos.index")) text-white fw-bold @else text-muted @endif"
                            href="{{route("lancamentos.index")}}"
                        >
                        <i class="fa-sharp fa-solid fa-basket-shopping"></i>
                            <span class="ml-2">Lançamentos</span>
                        </a>
                    </div>
                    @endif

                    @if(Auth::user()->can('dashboard_listar') || Auth::user()->can('dashboard_funcionarios'))
                    <div class="text-xs text-uppercase text-bold text-white-50 mt-4">
                        Relatórios
                    </div>
                    @endif

                    @if(Auth::user()->can('dashboard_listar'))
                    <div class="nav-item d-flex justify-content-start align-items-center my-3">
                        <a
                            class="nav-link-offset text-decoration-none opacity-100 opacity-50-hover @if(url()->current() === route("dashboard.index")) text-white fw-bold @else text-muted @endif"
                            href="{{route("dashboard.index")}}"
                        >
                        <i class="fa-solid fa-gauge-high"></i>
                        <span class="ml-2">Dashboard</span>
                        </a>
                    </div>
                    @endif
                    @if(Auth::user()->can('dashboard_funcionarios'))
                    <div class="nav-item d-flex justify-content-start align-items-center my-3">
                        <a
                            class="nav-link-offset text-decoration-none opacity-100 opacity-50-hover @if(url()->current() === route("dashboard.funcionario")) text-white fw-bold @else text-muted @endif"
                            href="{{route("dashboard.funcionario")}}"
                        >
                        <i class="fa-solid fa-chalkboard-user"></i>
                        <span class="ml-2">Funcionário</span>
                        </a>
                    </div>
                    @endif
                    <div class="nav-item d-flex justify-content-start align-items-center my-3">
                        <a
                            class="nav-link-offset text-decoration-none opacity-100 opacity-50-hover @if(url()->current() === route("dashboard.exportar")) text-white fw-bold @else text-muted @endif"
                            href="{{route("dashboard.exportar")}}"
                        >
                        <i class="fa-solid fa-download"></i>
                        <span class="ml-2">Exportar</span>
                        </a>
                    </div>

                    @if(Auth::user()->can('usuario_perfil') || Auth::user()->can('usuario_listar'))
                    <div class="text-xs text-uppercase text-bold text-white-50 mt-4">
                        Configurações
                    </div>
                    @endif
                    @if(Auth::user()->can('usuario_perfil'))
                    <div class="nav-item d-flex justify-content-start align-items-center my-3">
                        <a
                            class="nav-link-offset text-decoration-none opacity-100 opacity-50-hover @if(url()->current() === route("admin.cadastro.papel")) text-white fw-bold @else text-muted @endif"
                            href="{{route("admin.cadastro.papel")}}"
                        >
                        <i class="fa-solid fa-address-card"></i>
                        <span class="ml-2">Perfil de Acesso</span>
                        </a>
                    </div>
                    @endif
                    @if(Auth::user()->can('usuario_listar'))
                    <div class="nav-item d-flex justify-content-start align-items-center my-3">
                        <a
                            class="nav-link-offset text-decoration-none opacity-100 opacity-50-hover @if(url()->current() === route("admin.cadastro.usuarios")) text-white fw-bold @else text-muted @endif"
                            href="{{route("admin.cadastro.usuarios")}}"
                        >
                        <i class="fa-solid fa-user"></i>
                        <span class="ml-2">Usuários</span>
                        </a>
                    </div>
                    @endif
                </div>
            </div>

</div>
