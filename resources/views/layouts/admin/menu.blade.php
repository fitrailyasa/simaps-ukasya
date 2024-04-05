<!-- Sidebar Menu -->
@if (auth()->user()->roles_id == 1)
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link text-white @yield('activeDashboard')">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.tanding.index') }}" class="nav-link text-white @yield('table-tanding')">
                    <i class="nav-icon fas fa-tv"></i>
                    <p>
                        Atlet Tanding
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.pengundian-tanding.index') }}" class="nav-link text-white @yield('table-pengundian-tanding')">
                    <i class="nav-icon fas fa-random"></i>
                    <p>
                        Pengundian Tanding
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.bagan.tanding') }}" class="nav-link text-white @yield('table-bagan-tanding')">
                    <i class="nav-icon fas fa-chart-bar"></i>
                    <p>
                        Bagan Tanding
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.jadwal-tanding.index') }}" class="nav-link text-white @yield('table-jadwal-tanding')">
                    <i class="nav-icon fas fa-calendar"></i>
                    <p>
                        Jadwal Tanding
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.tgr.index') }}" class="nav-link text-white @yield('table-tgr')">
                    <i class="nav-icon fas fa-flag"></i>
                    <p>
                        Atlet TGR
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.pengundian-tgr.index') }}" class="nav-link text-white @yield('table-pengundian-tgr')">
                    <i class="nav-icon fas fa-random"></i>
                    <p>
                        Pengundian TGR
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.bagan.tgr') }}" class="nav-link text-white @yield('table-bagan-tgr')">
                    <i class="nav-icon fas fa-chart-bar"></i>
                    <p>
                        Bagan TGR
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.jadwal-tgr.index') }}" class="nav-link text-white @yield('table-jadwal-tgr')">
                    <i class="nav-icon fas fa-calendar"></i>
                    <p>
                        Jadwal TGR
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.gelanggang.index') }}" class="nav-link text-white @yield('table-gelanggang')">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                        Gelanggang
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.user.index') }}" class="nav-link text-white @yield('table-user')">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        User
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                    @csrf
                </form>
                <a href="#" class="nav-link text-white @yield('')"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out"></i>
                    <p>
                        Logout
                    </p>
                </a>
            </li>
        </ul>
    </nav>
@elseif (auth()->user()->roles_id == 2)
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('op.dashboard') }}" class="nav-link text-white @yield('activeDashboard')">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('op.tanding.index') }}" class="nav-link text-white @yield('table-tanding')">
                    <i class="nav-icon fas fa-tv"></i>
                    <p>
                        Atlet Tanding
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('op.pengundian-tanding.index') }}" class="nav-link text-white @yield('table-pengundian-tanding')">
                    <i class="nav-icon fas fa-random"></i>
                    <p>
                        Pengundian Tanding
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('op.bagan.tanding') }}" class="nav-link text-white @yield('table-bagan-tanding')">
                    <i class="nav-icon fas fa-chart-bar"></i>
                    <p>
                        Bagan Tanding
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('op.jadwal-tanding.index') }}" class="nav-link text-white @yield('table-jadwal-tanding')">
                    <i class="nav-icon fas fa-calendar"></i>
                    <p>
                        Jadwal Tanding
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('op.tgr.index') }}" class="nav-link text-white @yield('table-tgr')">
                    <i class="nav-icon fas fa-flag"></i>
                    <p>
                        Atlet TGR
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('op.pengundian-tgr.index') }}" class="nav-link text-white @yield('table-pengundian-tgr')">
                    <i class="nav-icon fas fa-random"></i>
                    <p>
                        Pengundian TGR
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('op.bagan.tgr') }}" class="nav-link text-white @yield('table-bagan-tgr')">
                    <i class="nav-icon fas fa-chart-bar"></i>
                    <p>
                        Bagan TGR
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('op.jadwal-tgr.index') }}" class="nav-link text-white @yield('table-jadwal-tgr')">
                    <i class="nav-icon fas fa-calendar"></i>
                    <p>
                        Jadwal TGR
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                    @csrf
                </form>
                <a href="#" class="nav-link text-white @yield('')"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out"></i>
                    <p>
                        Logout
                    </p>
                </a>
            </li>
        </ul>
    </nav>
@elseif (auth()->user()->roles_id == 3)
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link text-white @yield('activeDashboard')">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('beranda') }}" class="nav-link text-white">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Home
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                    @csrf
                </form>
                <a href="#" class="nav-link text-white @yield('')"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out"></i>
                    <p>
                        Logout
                    </p>
                </a>
            </li>
        </ul>
    </nav>
@elseif (auth()->user()->roles_id == 4)
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                    @csrf
                </form>
                <a href="#" class="nav-link text-white @yield('')"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out"></i>
                    <p>
                        Logout
                    </p>
                </a>
            </li>
        </ul>
    </nav>
@endif
<!-- /.sidebar-menu -->
