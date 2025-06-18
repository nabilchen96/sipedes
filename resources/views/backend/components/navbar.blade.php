<nav class="navbar-vertical navbar">
    <div class="nav-scroller">
        <!-- Brand logo -->
        <a class="navbar-brand" href="./index.html">
            <!-- <img src="{{ asset('dash-ui/assets/images/brand/logo/logo.svg') }}" alt="" /> -->
            <h2 style="color: white;">SIPEDES</h2>
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link has-arrow  active " href="{{ url('dashboard') }}">
                    <i class="bi bi-ui-checks-grid nav-icon icon-xs me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item" style="padding-left: 24px; padding-right: 24px;">
                <input id="level" style="height: 35px;" type="text" class="form-control" value="{{ strtoupper(Auth::user()->role) }}" readonly=""
                    fdprocessedid="t48x8q">
            </li>
            <li class="nav-item">
                <div class="navbar-heading">Main Menu</div>
            </li>
            @if(Auth::user()->role == 'Admin')
                <li class="nav-item">
                    <a class="nav-link has-arrow  active " href="{{ url('user') }}">
                        <i class="bi bi-person-circle nav-icon icon-xs me-2"></i> User
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link has-arrow  active " href="{{ url('wilayah') }}">
                        <i class="bi bi-geo-alt nav-icon icon-xs me-2"></i> Wilayah
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link has-arrow  active " href="{{ url('jabatan') }}">
                        <i class="bi bi-layers nav-icon icon-xs me-2"></i> Jabatan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link has-arrow  active " href="{{ url('bank') }}">
                        <i class="bi bi-bank nav-icon icon-xs me-2"></i> Bank
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link has-arrow  active " href="{{ url('profil') }}">
                    <i class="bi bi-person-circle nav-icon icon-xs me-2"></i> Perangkat Desa
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link has-arrow  active " href="./index.html">
                    <i class="bi bi-door-closed-fill nav-icon icon-xs me-2"></i> Log Out
                </a>
            </li>
        </ul>
    </div>
</nav>