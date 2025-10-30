<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="{{ asset('frontend/assets/img/logo.png') }}" alt=""> -->
            <h1 class="sitename">@yield('site_title', 'INTERNAL JAYA NIAGA SEMESTA')</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('permintaan.create') }}"
                        class="{{ request()->routeIs('permintaan.create') ? 'active' : '' }}">Pencarian Barang</a></li>
                <li><a href="{{ route('perdin.create') }}"
                        class="{{ request()->routeIs('perdin.create') ? 'active' : '' }}">Formulir Pengajuan
                        Perdin</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        @auth
            <form method="POST" action="{{ route('logout') }}" class="d-inline ms-3">
                @csrf
                <span class="me-2 text-white">{{ auth()->user()->name }}</span>
                <button class="btn btn-sm btn-outline-light">Logout</button>
            </form>
        @else
            <a class="btn-getstarted" href="{{ url('/login') }}">Login</a>
        @endauth

    </div>
</header>
