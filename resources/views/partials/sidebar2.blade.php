<div class="sidebar" data-background-color="dark">
    {{-- Logo SiCermat --}}
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="{{ url('/') }}" class="logo text-decoration-none">
                <span class="navbar-brand text-white fw-bold fs-4">SICERMAT</span>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
                <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
            </div>
        </div>
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">

                {{-- Dashboard --}}
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- Tampilkan hanya untuk petugas pertanian --}}
                {{-- <li class="nav-item"> --}}
                <li class="nav-item {{ request()->routeIs('pertanian.index') ? 'active' : '' }}">
                    <a href="{{ route('pertanian.index', ['category' => 'pertanian']) }}">
                        <i class="fas fa-leaf"></i>
                        <p>Komoditas Pertanian</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('perikanan.index') ? 'active' : '' }}">
                    <a href="{{ route('perikanan.index', ['category' => 'perikanan']) }}">
                        <i class="fas fa-fish"></i>
                        <p>Komoditas Perikanan</p>
                    </a>
                </li>

                {{-- Admin khusus (opsional): kelola user dan wilayah --}}
                @auth
                    @if (Auth::user()->role === 'admin')
                        <li class="nav-item {{ request()->is('regions*') ? 'active' : '' }}">
                            <a href="{{ route('regions.index') }}">
                                <i class="fas fa-map-marked-alt"></i>
                                <p>Kelola Wilayah</p>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}">
                                <i class="fas fa-users-cog"></i>
                                <p>Kelola Pengguna</p>
                            </a>
                        </li>
                    @endif
                @endauth
                <li class="nav-item {{ request()->routeIs('prices.index') ? 'active' : '' }}">
                    <a href="{{ route('prices.index') }}">
                        <i class="fas fa-money-bill-wave"></i>
                        <p>Harga</p>
                    </a>
                </li>

                {{-- Authentication --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#authentication" aria-expanded="false">
                        {{-- <i class="fas fa-fish"></i> --}}
                        <i class="fas fa-user-shield"></i>
                        <p>Authentication</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="authentication">
                        <ul class="nav nav-collapse list-unstyled">
                            <li>
                                <a href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-2 ms-3"></i>
                                    <span>Login</span>
                                </a>
                            </li>
                            @auth
                                <li>
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2 ms-3"></i>
                                        <span>Logout</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>

                            @endauth
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
