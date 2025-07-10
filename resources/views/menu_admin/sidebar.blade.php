<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="d-flex align-items-center text-decoration-none">
            <span class="app-brand-logo">
                <!-- Ganti SVG dengan gambar logo -->
                <img src="{{ asset('/backend/assets/img/avatars/logo.png') }}" alt="Logo SPK BPJS" width="70"
                    height="70" style="border-radius: 50%; background-color: #ffffff; padding: 5px;">
            </span>
            <span class="app-brand-text fw-bold ms-2 fs-4 text-dark">SPK BPJS</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <!-- Digital Clock -->
   
    <div class="menu-inner-shadow"></div>
<hr>
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        {{-- KRITERIA --}}
        <li class="menu-item {{ Request::is('kriteria*') ? 'active' : '' }}">
            <a href="/kriteria" class="menu-link">
                <i class="menu-icon tf-icons bx bx-filter"></i>
                <div data-i18n="kriteria">Kriteria</div>
            </a>
        </li>
        {{-- ALTERNATIF --}}
        <li class="menu-item {{ Request::is('masyarakat*') ? 'active' : '' }}">
            <a href="/masyarakat" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Alternatif">Alternatif</div>
            </a>
        </li>

        {{-- PENILAIAN --}}
        <li class="menu-item {{ Request::is('penilaian*') ? 'active' : '' }}">
            <a href="/penilaian" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
                <div data-i18n="Penilaian">Penilaian</div>
            </a>
        </li>
        {{-- HITUNG --}}
        <li class="menu-item {{ Request::is('perhitungan*') ? 'active' : '' }}">
            <a href="/perhitungan" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calculator"></i>
                <div data-i18n="Perhitungan">Hitung</div>
            </a>
        </li>


        @if (auth()->check() && auth()->user()->role_id != 2)
            {{-- USER --}}

            <li class="menu-item {{ Request::is('user*') ? 'active' : '' }}">
                <a href="/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-circle"></i>
                    <div data-i18n="Analytics">User</div>
                </a>
            </li>
        @endif

    </ul>
</aside>
