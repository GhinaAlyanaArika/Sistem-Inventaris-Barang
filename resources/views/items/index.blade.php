<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">Daftar Barang</h2>
    </x-slot>

    <div class="py-4">
        <div class="container-fluid max-w-7xl mx-auto">
            
            <!-- Form Filter & Pencarian -->
            <div class="card shadow-sm border-0 mb-4 rounded-4">
                <div class="card-body">
                    <form action="{{ route('items.index') }}" method="GET" class="row g-3">
                        <div class="col-md-3">
                            <input type="text" name="search" class="form-control rounded-3 fw-bold text-dark" placeholder="Cari nama atau SKU..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="category_id" class="form-select rounded-3 fw-bold text-dark">
                                <option value="">Semua Kategori</option>
                                @foreach(\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="sort" class="form-select rounded-3 fw-bold text-dark">
                                <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Urutkan: Data Terbaru</option>
                                <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Urutkan: Data Terlama</option>
                                <option value="stok_terbanyak" {{ request('sort') == 'stok_terbanyak' ? 'selected' : '' }}>Stok Terbanyak</option>
                                <option value="stok_sedikit" {{ request('sort') == 'stok_sedikit' ? 'selected' : '' }}>Stok Paling Sedikit</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-dark w-100 rounded-3 fw-bold">Terapkan</button>
                            
                            @if(request()->filled('search') || request()->filled('category_id') || request()->filled('sort'))
                                <a href="{{ route('items.index') }}" class="btn btn-outline-secondary w-100 rounded-3 fw-bold text-center">Reset</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabel Data Barang -->
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-0" style="border-bottom: 2px solid #adb5bd !important;">
                    <h5 class="m-0 fw-bold text-dark">Data Inventori</h5>
                    
                    <!-- TOMBOL AKSI KHUSUS SUPER ADMIN & ADMIN -->
                    @if(auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('items.export') }}" class="btn btn-success text-white fw-bold rounded-pill px-3 shadow-sm">
                                Export CSV
                            </a>
                            
                            <button type="button" class="btn btn-primary text-white fw-bold rounded-pill px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#importItemModal">
                                Import
                            </button>

                            <a href="{{ route('items.create') }}" class="btn btn-dark fw-bold rounded-pill px-4 shadow-sm">
                                Tambah Barang
                            </a>
                        </div>
                    @endif
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 w-100">
                            <thead class="bg-light text-dark fw-bold small text-uppercase" style="border-bottom: 2px solid #adb5bd;">
                                <tr>
                                    <th class="px-4 py-3 border-0 text-dark">SKU</th>
                                    <th class="px-4 py-3 border-0 text-dark">Nama Barang</th>
                                    <th class="px-4 py-3 border-0 text-dark">Kategori</th>
                                    <th class="px-4 py-3 border-0 text-dark">Harga</th>
                                    <th class="px-4 py-3 border-0 text-center text-dark">Stok</th>
                                    @if(auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))
                                        <th class="px-4 py-3 border-0 text-center text-dark">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                @forelse($items as $item)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <span class="badge bg-dark text-white rounded-pill px-3 fw-bold">{{ $item->sku }}</span>
                                        </td>
                                        <td class="px-4 py-3 fw-bold text-dark">{{ $item->name }}</td>
                                        <td class="px-4 py-3 text-dark fw-bold">{{ $item->category->name ?? '-' }}</td>
                                        <td class="px-4 py-3 fw-bold text-success">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="badge {{ $item->stock > 5 ? 'bg-success' : 'bg-danger' }} text-white fw-bold rounded-pill px-3 fs-6">
                                                {{ $item->stock }}
                                            </span>
                                        </td>
                                        @if(auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))
                                            <td class="px-4 py-3 text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-warning text-dark fw-bold rounded-pill px-3">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('items.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin hapus barang ini?');" class="d-inline mb-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger fw-bold rounded-pill px-3">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin')) ? 6 : 5 }}" class="text-center py-5 text-dark fw-bold fst-italic">Belum ada data barang.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                @if(method_exists($items, 'hasPages') && $items->hasPages())
                    <div class="card-footer bg-white py-3 border-0">
                        {{ $items->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- MODAL IMPORT DATA BARANG (KHUSUS SUPER ADMIN & ADMIN) -->
    @if(auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))
        <div class="modal fade" id="importItemModal" tabindex="-1" aria-labelledby="importItemModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold text-dark" id="importItemModalLabel">Import Data Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('items.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body py-4">
                            <div class="mb-3">
                                <label for="file" class="form-label fw-bold text-dark">Pilih File Excel / CSV</label>
                                <input type="file" class="form-control rounded-3" id="file" name="file" accept=".xlsx, .xls, .csv" required>
                            </div>
                            <p class="small text-muted mb-0">Format yang didukung: .xlsx, .xls, .csv</p>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-light rounded-pill fw-bold px-4" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-dark rounded-pill fw-bold px-4">Upload & Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>