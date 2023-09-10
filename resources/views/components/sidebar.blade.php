<style>
    .sidebar-nav .nav-link {
        color: #fff !important;
        background: transparent !important;
    }

    .sidebar-nav .nav-link i {
        color: #fff !important;
    }

    .sidebar-nav .nav-link.collapsed {
        color: #fff !important;
        background: #3182fc !important;
    }
</style>

<aside id="sidebar" class="sidebar bg-primary">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item text-white">
            <a href="{{ route('dashboard') }}" @class(['nav-link', 'collapsed' => request()->is('dashboard')])>
                <i class="fa-solid fa-gauge"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @can('is_admin')
            <li class="nav-heading text-white">Data Master</li>

            <li class="nav-item text-white">
                <a href="{{ route('pasien.index') }}" @class(['nav-link', 'collapsed' => request()->is('pasien*')])>
                    <i class="fa-solid fa-hospital-user"></i>
                    <span>Pasien</span>
                </a>
            </li>

            <li class="nav-item text-white">
                <a href="{{ route('poli.index') }}" @class(['nav-link', 'collapsed' => request()->is('poli*')])>
                    <i class="fa-solid fa-building"></i>
                    <span>Poli</span>
                </a>
            </li>

            <li class="nav-item text-white">
                <a href="{{ route('dokter.index') }}" @class(['nav-link', 'collapsed' => request()->is('dokter*')])>
                    <i class="fa-solid fa-user-doctor"></i>
                    <span>Dokter</span>
                </a>
            </li>

            <li class="nav-item text-white">
                <a href="{{ route('admin.index') }}" @class(['nav-link', 'collapsed' => request()->is('admin*')])>
                    <i class="fa-solid fa-user-tie"></i>
                    <span>Admin</span>
                </a>
            </li>
        @endcan

        <li class="nav-heading text-white">Kunjungan</li>

        <li class="nav-item text-white">
            <a href="{{ route('kunjungan.index') }}" @class(['nav-link', 'collapsed' => request()->is('kunjungan*')])>
                <i class="fa-solid fa-hospital-user"></i>
                <span>Kunjungan</span>
            </a>
        </li>

        @can('is_admin_poli')
            <li class="nav-heading text-white">Antrian</li>
            <li class="nav-item text-white">
                <a href="{{ route('antrian.index') }}" @class(['nav-link', 'collapsed' => request()->is('antrian*')])>
                    <i class="fa-solid fa-arrow-down-1-9"></i>
                    <span>Antrian</span>
                </a>
            </li>
        @endcan

        <li class="nav-heading text-white">Aksi</li>
        {{-- <li class="nav-item text-white">
            <a @class(['nav-link', 'collapsed' => request()->is('')])>
                <i class="fa-solid fa-user"></i>
                <span>Profile</span>
            </a>
        </li> --}}

        <li class="nav-item text-white">
            <a class="nav-link" href="javascript:document.getElementById('form-logout').submit()">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </a>
        </li>

    </ul>

</aside>
