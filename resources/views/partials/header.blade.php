<div class="main-header">

    <div class="main-header-logo"> 
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ asset('admin') }}/assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand"
                    height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        
    </div>
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom" data-background-color="dark">
        <div class="container-fluid">
            {{-- <a href="{{ url('/') }}" class="logo text-decoration-none"> --}}
            {{-- <span class="navbar-brand text-white fw-bold fs-4">Sistem Informasi Cek Harga Komoditas</span> --}}
            <h6 class="text-white">SISTEM INFORMASI CEK HARGA KOMODITAS</h6>
            {{-- </a> --}}
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="{{ asset('admin') }}/assets/img/profile.jpg" alt="..."
                                class="avatar-img rounded-circle" />
                        </div>
                        {{-- <span class="profile-username">
                            <span class="op-7">Hi,</span>
                            <span class="fw-bold">Admin</span>
                        </span> --}}
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <img src="{{ asset('admin') }}/assets/img/profile.jpg" alt="image profile"
                                            class="avatar-img rounded" />
                                    </div>
                                    <div class="u-text">
                                        <h4>Admin</h4>
                                        {{-- <p class="text-muted">hello@example.com</p>
                                        <a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View
                                            Profile</a> --}}
                                    </div>
                                </div>
                            </li>
                            {{-- <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">My Profile</a>
                                <a class="dropdown-item" href="#">My Balance</a>
                                <a class="dropdown-item" href="#">Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Logout</a>
                            </li> --}}
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
