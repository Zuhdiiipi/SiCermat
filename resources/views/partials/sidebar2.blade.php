<div class="sidebar" data-background-color="dark">
    {{-- Logo SiCermat --}}
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="{{ url('/') }}" class="logo text-decoration-none">
                <span class="navbar-brand text-white fw-bold fs-4">SiCermat</span>
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
                {{-- @if (Auth::user()->role === 'petugas_pertanian' || Auth::user()->role === 'admin') --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#komoditasPertanian" aria-expanded="false">
                        <i class="fas fa-leaf"></i>
                        <p>Komoditas Pertanian</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="komoditasPertanian">
                        <ul class="nav nav-collapse list-unstyled">
                            <li>
                                <a href="{{ route('dashboard', ['category' => 'pertanian']) }}">
                                    <i class="fas fa-eye me-2 ms-3"></i>
                                    <span>Lihat Komoditas</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dashboard', ['category' => 'pertanian']) }}">
                                    <i class="fas fa-plus-circle me-2 ms-3"></i>
                                    <span>Tambah Komoditas</span>
                                </a>
                            </li>
                        </ul>`
                    </div>
                </li>
                {{-- @endif --}}

                {{-- Tampilkan hanya untuk petugas perikanan --}}
                {{-- @if (Auth::user()->role === 'petugas_perikanan' || Auth::user()->role === 'admin') --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#komoditasPerikanan" aria-expanded="false">
                        <i class="fas fa-fish"></i>
                        <p>Komoditas Perikanan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="komoditasPerikanan">
                        <ul class="nav nav-collapse list-unstyled">
                            <li>
                                <a href="{{ route('dashboard', ['category' => 'perikanan']) }}">
                                    <i class="fas fa-eye me-2 ms-3"></i>
                                    <span>Lihat Komoditas</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dashboard', ['category' => 'perikanan']) }}">
                                    <i class="fas fa-plus-circle me-2 ms-3"></i>
                                    <span>Tambah Komoditas</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- @endif --}}

                {{-- Admin khusus (opsional): kelola user dan wilayah --}}
                {{-- @if (Auth::user()->role === 'admin') --}}
                <li class="nav-item {{ request()->is('regions*') ? 'active' : '' }}">
                    <a href="{{ route('regions.index') }}">
                        <i class="fas fa-map-marked-alt"></i>
                        <p>Kelola Wilayah</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-users-cog"></i>
                        <p>Kelola Pengguna</p>
                    </a>
                </li>
                {{-- @endif --}}

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
                            <li>
                                <a href="{{ route('dashboard', ['category' => 'perikanan']) }}">
                                    <i class="fas fa-sign-out-alt me-2 ms-3"></i>
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
