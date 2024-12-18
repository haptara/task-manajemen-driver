<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


    <div class="app-brand demo ">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/favicon.png') }}" alt="Logo" width="42">
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">FLUFFY</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>



    <ul class="menu-inner py-1">
        <li class="menu-item {{ request()->is('dashboard*') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>


        <li class="menu-header small text-uppercase"><span class="menu-header-text" data-i18n="Main Menu">Main
                Menu</span>
        </li>
        <li class="menu-item {{ request()->is('driver*') ? 'active' : '' }}">
            <a href="{{ route('driver') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-group'></i>
                <div class="text-truncate" data-i18n="Driver">Driver</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('vehicles*') ? 'active' : '' }}">
            <a href="{{ route('vehicles') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-car-garage'></i>
                <div class="text-truncate" data-i18n="Vehicle">Vehicle</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('tasks*') ? 'active' : '' }}">
            <a href="{{ route('tasks') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-task"></i>
                <div class="text-truncate" data-i18n="Task">Task</div>
            </a>
        </li>

        <!-- Misc -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text" data-i18n="Misc">Misc</span>
        </li>

        <li class="menu-item {{ request()->is('report*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">

                <i class="menu-icon tf-icons bx bxs-file"></i>
                <div class="text-truncate" data-i18n="Report">Report</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('driver/data-driver') ? 'active' : '' }}">
                    <a href="app-logistics-dashboard.html" class="menu-link">
                        <div class="text-truncate" data-i18n="Durasi Tugas">Durasi Tugas</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-logistics-fleet.html" class="menu-link">
                        <div class="text-truncate" data-i18n="Rekap Tugas">Rekap Tugas</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div class="text-truncate" data-i18n="Pengaturan">Pengaturan</div>
            </a>
        </li>
        <li class="menu-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <a href="javascript:void(0);" class="menu-link" onclick="this.closest('form').submit()">
                    <i class='menu-icon tf-icons bx bx-log-out'></i>
                    <div class="text-truncate" data-i18n="Logout">Logout</div>
                </a>
            </form>
        </li>
    </ul>



</aside>
