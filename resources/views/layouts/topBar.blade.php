 <!-- Topbar -->
 <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <button class="btn btn-link rounded-circle mr-3" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth()->user()->name}}</span>
                <i class="fa-solid fa-circle-user fa-xl"></i>
            </a>
            <!-- Dropdown - User Information -->
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('admin.sair')}}">Sair</a></li>
            </ul>
        </div>

    </ul>

</nav>
<!-- End of Topbar -->
