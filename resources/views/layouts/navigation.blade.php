@php
    $lowStockItems = \App\Models\Item::where('stock', '<=', 5)->get();
@endphp

<!-- SIDEBAR -->
<div class="sidebar d-flex flex-column p-3 shadow" id="sidebar">
    <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none border-bottom border-secondary pb-3 w-100 justify-content-center">
        <!-- Jika Anda punya logo, bisa ganti text ini dengan tag <img> -->
        <span class="fs-5 fw-bold tracking-wider">{{ \App\Models\Setting::get('app_name', 'INVENTORY') }}</span>
    </a>
    
    <ul class="nav nav-pills flex-column mb-auto mt-3 gap-1">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link fw-bold {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>
        
        <!-- MASTER DATA (Dapat Dilihat Semua Role) -->
        <li class="nav-item mt-3 mb-1"><span class="text-white-50 small fw-bold text-uppercase px-3">Master Data</span></li>
        
        @role('Super Admin|Admin')
            <li>
                <a href="{{ route('categories.index') }}" class="nav-link fw-bold {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <i class="bi bi-tags me-2"></i> Kategori
                </a>
            </li>
        @endrole

        <!-- Daftar Barang (Tampil untuk Semua Role Termasuk Kasir) -->
        <li>
            <a href="{{ route('items.index') }}" class="nav-link fw-bold {{ request()->routeIs('items.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam me-2"></i> Daftar Barang
            </a>
        </li>

        @role('Super Admin|Admin')
            <li>
                <a href="{{ route('mutations.index') }}" class="nav-link fw-bold {{ request()->routeIs('mutations.*') ? 'active' : '' }}">
                    <i class="bi bi-arrow-left-right me-2"></i> Mutasi Stok
                </a>
            </li>
        @endrole

        <!-- TRANSAKSI -->
        <li class="nav-item mt-3 mb-1"><span class="text-white-50 small fw-bold text-uppercase px-3">Transaksi</span></li>
        <li>
            <a href="{{ route('transactions.index') }}" class="nav-link fw-bold {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                <i class="bi bi-cart-check me-2"></i> Kasir & Transaksi
            </a>
        </li>

        @role('Super Admin|Admin')
            <li>
                <a href="{{ route('reports.index') }}" class="nav-link fw-bold {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-bar-graph me-2"></i> Laporan
                </a>
            </li>
        @endrole

        @role('Super Admin')
            <li class="nav-item mt-3 mb-1"><span class="text-white-50 small fw-bold text-uppercase px-3">Sistem</span></li>
            <li>
                <a href="{{ route('users.index') }}" class="nav-link fw-bold {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="bi bi-people me-2"></i> Manajemen User
                </a>
            </li>
            <li>
                <a href="{{ route('activity-logs.index') }}" class="nav-link fw-bold {{ request()->routeIs('activity-logs.*') ? 'active' : '' }}">
                    <i class="bi bi-journal-text me-2"></i> Log Aktivitas
                </a>
            </li>
        @endrole
    </ul>

    <!-- PROFIL USER (POJOK KIRI BAWAH) -->
    <hr class="text-secondary mt-auto">
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
            <!-- Lingkaran Inisial -->
            <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle fw-bold me-2 shadow-sm" style="width: 35px; height: 35px; font-size: 1.1rem;">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <strong class="d-none d-sm-inline">{{ Auth::user()->name }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser">
            <li><a class="dropdown-item fw-bold" href="{{ route('profile.edit') }}">Profil Saya</a></li>
            @role('Super Admin')
                <li><a class="dropdown-item fw-bold" href="{{ route('settings.index') }}">Pengaturan Aplikasi</a></li>
            @endrole
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger fw-bold">Log Out</button>
                </form>
            </li>
        </ul>
    </div>
</div>

<!-- TOPBAR NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom topbar px-4">
    <div class="container-fluid p-0">
        <!-- Tombol Hamburger Mobile -->
        <button class="btn btn-outline-dark fw-bold d-md-none me-3" id="sidebarToggle">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </button>

        <div class="d-flex align-items-center ms-auto">
            <!-- Dropdown Notifikasi Lonceng -->
            <div class="dropdown">
                <button class="btn btn-light position-relative text-dark border p-2 d-flex align-items-center justify-content-center rounded-circle shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 42px; height: 42px;">
                    <!-- Ikon Lonceng SVG -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                    </svg>
                    @if($lowStockItems->count() > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light" style="font-size: 0.7rem;">
                            {{ $lowStockItems->count() }}
                        </span>
                    @endif
                </button>
                
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" style="width: 320px;">
                    <li class="dropdown-header bg-dark text-white d-flex justify-content-between align-items-center py-2 rounded-top">
                        <span class="fw-bold">Peringatan Stok</span>
                        <span class="badge bg-danger">{{ $lowStockItems->count() }} Item</span>
                    </li>
                    <div style="max-height: 250px; overflow-y: auto;">
                        @forelse($lowStockItems as $item)
                            <li>
                                <div class="dropdown-item d-flex justify-content-between align-items-center py-2 border-bottom text-wrap">
                                    <div class="me-2">
                                        <div class="fw-bold text-dark" style="font-size: 0.85rem;">{{ $item->name }}</div>
                                        <div class="text-dark fw-bold" style="font-size: 0.75rem;">Sisa: <span class="text-danger fw-bold">{{ $item->stock }}</span></div>
                                    </div>
                                    @role('Super Admin|Admin')
                                        <a href="{{ route('mutations.create', ['item_id' => $item->id]) }}" class="btn btn-sm btn-dark fw-bold flex-shrink-0" style="font-size: 0.7rem;">Restock</a>
                                    @endrole
                                </div>
                            </li>
                        @empty
                            <li><span class="dropdown-item text-center text-dark fw-bold small py-4">Semua stok barang aman!</span></li>
                        @endforelse
                    </div>
                </ul>
            </div>
        </div>
    </div>
</nav>