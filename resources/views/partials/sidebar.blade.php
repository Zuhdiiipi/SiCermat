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
            
            {{-- <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button> --}}
        </div>
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">

                {{-- Dashboard --}}
                <li class="nav-item active">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- Komoditi Pertanian --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#komoditasPertanian" aria-expanded="false">
                        <i class="fas fa-leaf"></i>
                        <p>Komoditi Pertanian</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="komoditasPertanian">
                        <ul class="nav nav-collapse list-unstyled">
                            <li>
                                <a href="{{ route('dashboard') }}">
                                    <i class="fas fa-eye me-2 ms-3"></i> 
                                    <span>Lihat Komoditi</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dashboard') }}">
                                    <i class="fas fa-plus-circle me-2 ms-3"></i>
                                    <span>Tambah Komoditi</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                {{-- Komoditi Perikanan --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#komoditasPerikanan" aria-expanded="false">
                        <i class="fas fa-fish"></i>
                        <p>Komoditi Perikanan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="komoditasPerikanan">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('dashboard') }}">
                                    <i class="fas fa-eye me-2 ms-3"></i>
                                    <span>Lihat Komoditi</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dashboard') }}">
                                    <i class="fas fa-plus-circle me-2 ms-3"></i>
                                    <span>Tambah Komoditi</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>
