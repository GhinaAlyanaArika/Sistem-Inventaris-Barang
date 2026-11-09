<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">Daftar Kategori</h2>
    </x-slot>

    <div class="py-4">
        <div class="container-fluid max-w-7xl mx-auto">

            <!-- FORM PENCARIAN -->
            <div class="card bg-white shadow-sm border-0 rounded-4 mb-4">
                <div class="card-body p-3">
                    <form method="GET" action="{{ route('categories.index') }}" class="row g-2 align-items-center">
                        <div class="col-md-9">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted fw-bold">Cari</span>
                                <input type="text" name="search" class="form-control border-start-0 shadow-none fw-bold text-dark" placeholder="Cari berdasarkan nama kategori..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-dark w-100 fw-bold rounded-3">
                                Filter
                            </button>
                            
                            <!-- Cek apakah ada pencarian atau sorting yang aktif -->
                            @if(request()->anyFilled(['search', 'sort']))
                                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary w-100 fw-bold rounded-3 d-flex align-items-center justify-content-center text-decoration-none">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- TABEL DATA KATEGORI -->
            <div class="card bg-white shadow-sm border-0 rounded-4 overflow-hidden">
                
                <!-- CARD HEADER EDGE-TO-EDGE -->
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-0" style="border-bottom: 2px solid #adb5bd !important;">
                    <h5 class="m-0 fw-bold text-dark">Manajemen Kategori</h5>
                    <a href="{{ route('categories.create') }}" class="btn btn-dark fw-bold rounded-pill px-4">
                        Tambah Kategori
                    </a>
                </div>

                <!-- CARD BODY P-0 -->
                <div class="card-body p-0">
                    
                    @if (session('success'))
                        <div class="p-3 mb-0">
                            <div class="alert alert-success alert-dismissible fade show rounded-3 fw-bold mb-0" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="p-3 mb-0">
                            <div class="alert alert-danger alert-dismissible fade show rounded-3 fw-bold mb-0" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 w-100">
                            <thead class="bg-light text-dark small text-uppercase" style="border-bottom: 2px solid #adb5bd;">
                                <tr>
                                    <th class="px-4 py-3 border-0 fw-bold text-dark text-start" style="width: 35%;">
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-dark text-decoration-none d-flex align-items-center gap-1">
                                            Nama Kategori
                                            @if(request('sort') == 'name')
                                                <small>{{ request('direction') == 'desc' ? '▼' : '▲' }}</small>
                                            @else
                                                <small class="text-muted">↕</small>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="px-4 py-3 border-0 fw-bold text-dark text-center" style="width: 30%;">Deskripsi</th>
                                    <th class="px-4 py-3 border-0 fw-bold text-dark text-end" style="width: 35%;">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-center" style="width: 125px;">Aksi</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                @forelse($categories as $category)
                                    <tr>
                                        <td class="px-4 py-3 fw-bold text-dark text-start">{{ $category->name }}</td>
                                        <td class="px-4 py-3 text-muted fw-bold text-center">{{ $category->description ?? '-' }}</td>
                                        <td class="px-4 py-3 text-end">
                                            <div class="d-flex justify-content-end gap-1">
                                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning text-dark fw-bold rounded-pill px-3">
                                                    Edit
                                                </a>
                                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')" class="d-inline mb-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger fw-bold rounded-pill px-3">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-5 text-center text-dark fw-bold fst-italic">
                                            Belum ada data kategori.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if(method_exists($categories, 'hasPages') && $categories->hasPages())
                    <div class="card-footer bg-white py-3 border-0">
                        {{ $categories->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>