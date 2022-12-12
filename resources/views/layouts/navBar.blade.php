        <!-- Sidebar -->
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
        <!-- End of Sidebar -->
