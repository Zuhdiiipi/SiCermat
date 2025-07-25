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
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#komoditasPertanian" aria-expanded="false">
                        <i class="fas fa-leaf"></i>
                        <p>Komoditas Pertanian</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="komoditasPertanian">
                        <ul class="nav nav-collapse list-unstyled">
                            <li>
                                <a href="{{ route('pertanian.index', ['category' => 'pertanian']) }}">
                                    <i class="fas fa-eye me-2 ms-3"></i>
                                    <span>Lihat Komoditas</span>
                                </a>
                            </li>
                            @auth
                                @if (Auth::user()->role === 'petugas_pertanian' || Auth::user()->role === 'admin')
                                    <li>
                                        <a href="{{ route('pertanian.create', ['category' => 'pertanian']) }}">
                                            <i class="fas fa-plus-circle me-2 ms-3"></i>
                                            <span>Tambah Komoditas</span>
                                        </a>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                    </div>
                </li>

                {{-- Tampilkan hanya untuk petugas perikanan --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#komoditasPerikanan" aria-expanded="false">
                        <i class="fas fa-fish"></i>
                        <p>Komoditas Perikanan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="komoditasPerikanan">
                        <ul class="nav nav-collapse list-unstyled">
                            <li>
                                <a href="{{ route('perikanan.index', ['category' => 'perikanan']) }}">
                                    <i class="fas fa-eye me-2 ms-3"></i>
                                    <span>Lihat Komoditas</span>
                                </a>
                            </li>
                            @auth
                                @if (Auth::user()->role === 'petugas_perikanan' || Auth::user()->role === 'admin')
                                    <li>
                                        <a href="{{ route('perikanan.create', ['category' => 'perikanan']) }}">
                                            <i class="fas fa-plus-circle me-2 ms-3"></i>
                                            <span>Tambah Komoditas</span>
                                        </a>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                    </div>
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

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#harga" aria-expanded="false">
                        <i class="fas fa-leaf"></i>
                        <p>Harga</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="harga">
                        <ul class="nav nav-collapse list-unstyled">
                            <li>
                                <a href="{{ route('prices.index') }}">
                                    <i class="fas fa-eye me-2 ms-3"></i>
                                    <span>Lihat Harga</span>
                                </a>
                            </li>
                            @auth
                                @if (Auth::user()->role === 'petugas_pertanian' || Auth::user()->role === 'admin')
                                    <li>
                                        <a href="{{ route('prices.create') }}">
                                            <i class="fas fa-plus-circle me-2 ms-3"></i>
                                            <span>Tambah Harga</span>
                                        </a>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                    </div>
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
                                {{-- <li>
                                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-link"
                                            style="text-decoration: none; color: inherit; padding: 0;">
                                            <i class="fas fa-sign-out-alt me-2 ms-3"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </li> --}}
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
