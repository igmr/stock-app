<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('app.dashboard') }}" class="brand-link">
        <!--
        <img src="{{ url('assets/img/logo-black.png') }}" alt="AdminLTE Logo"
        style="opacity: .8" width="100%">
        -->
        <i class="fas fa-tint ml-3 mr-2 title-color"></i>
        <span class="brand-text font-weight-light">Sto<b class="title-color">CK</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('app.dashboard') }}" class="nav-link {{ $menu == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">OPERATIONS</li>
                <li class="nav-item">
                    <a href="{{ route('app.stock.index') }}" class="nav-link  {{ $menu == 'stock' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-check-circle"></i>
                        <p class="text">Stock</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('app.maintenance.index') }}"
                        class="nav-link  {{ $menu == 'maintenance' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tools"></i>
                        <p class="text">Maintenance</p>
                    </a>
                </li>
                <li class="nav-header">CATALOGS</li>
                <li class="nav-item">
                    <a href="{{ route('app.printer.index') }}"
                        class="nav-link  {{ $menu == 'printer' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-print"></i>
                        <p>Printers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('app.cartridge.index') }}"
                        class="nav-link {{ $menu == 'cartridge' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>Cartridges</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('app.brand.index') }}" class="nav-link {{ $menu == 'brand' ? 'active' : '' }}">
                        <i class="nav-icon fab fa-qq"></i>
                        <p>Brands</p>
                    </a>
                </li>
                <li class="nav-header">REPORTS</li>
                <li class="nav-item">
                    <a href="{{ route('app.report.history') }}"
                        class="nav-link {{ $menu == 'report.history' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-history"></i>
                        <p>History</p>
                    </a>
                </li>
                <li class="nav-header">ADMINISTRATION</li>
                <li class="nav-item">
                    <a href="{{ route('app.user.index') }}" class="nav-link {{ $menu == 'user' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"
                        onclick="event.preventDefault(); document.querySelector('#logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('auth.login.destroy') }}" method="POST"
                        style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
