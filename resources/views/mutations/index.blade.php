<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">Riwayat Mutasi Stok</h2>
    </x-slot>

    <div class="py-4">
        <div class="container-fluid max-w-7xl mx-auto">

            <!-- FORM FILTER & PENCARIAN MUTASI -->
            <div class="card bg-white shadow-sm border-0 rounded-4 mb-4">
                <div class="card-body p-3">
                    <form method="GET" action="{{ route('mutations.index') }}" class="row g-2 align-items-end">
                        <div class="col-md-5">
                            <label class="form-label small fw-bold text-muted mb-1">Cari Barang</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted fw-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/></svg>
                                </span>
                                <input type="text" name="search" class="form-control border-start-0 shadow-none fw-bold text-dark" placeholder="Nama barang..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted mb-1">Jenis Mutasi</label>
                            <select name="type" class="form-select shadow-none fw-bold text-dark">
                                <option value="">Semua Jenis</option>
                                <option value="in" {{ request('type') == 'in' ? 'selected' : '' }}>Barang Masuk</option>
                                <option value="out" {{ request('type') == 'out' ? 'selected' : '' }}>Barang Keluar</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-bold text-muted mb-1">Tanggal</label>
                            <input type="date" name="date" class="form-control shadow-none fw-bold text-dark" value="{{ request('date') }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-dark w-100 fw-bold rounded-3">
                                Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TABEL DATA MUTASI STOK -->
            <div class="card bg-white shadow-sm border-0 rounded-4 overflow-hidden">
                
                <!-- CARD HEADER -->
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-0" style="border-bottom: 2px solid #adb5bd !important;">
                    <h5 class="m-0 fw-bold text-dark">Data Mutasi Stok</h5>
                    <a href="{{ route('mutations.create') }}" class="btn btn-dark fw-bold rounded-pill px-4">
                        Catat Mutasi Baru
                    </a>
                </div>

                <!-- CARD BODY -->
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
                                    <th class="px-4 py-3 border-0 fw-bold text-dark text-start" style="width: 20%;">Tanggal</th>
                                    <th class="px-4 py-3 border-0 fw-bold text-dark text-start" style="width: 30%;">Barang</th>
                                    <th class="px-4 py-3 border-0 fw-bold text-dark text-center" style="width: 20%;">Jenis Mutasi</th>
                                    <th class="px-4 py-3 border-0 fw-bold text-dark text-center" style="width: 15%;">Jumlah</th>
                                    <th class="px-4 py-3 border-0 fw-bold text-dark text-start" style="width: 15%;">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                @forelse($mutations as $mutation)
                                    <tr>
                                        <td class="px-4 py-3 text-start fw-bold text-dark">
                                            {{ \Carbon\Carbon::parse($mutation->created_at)->translatedFormat('d M Y') }}
                                        </td>
                                        <td class="px-4 py-3 text-start fw-bold text-dark">
                                            {{ $mutation->item->name ?? '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            @if($mutation->type == 'in' || $mutation->type == 'masuk' || $mutation->type == 'Barang Masuk')
                                                <span class="badge bg-success text-white rounded-pill px-3 py-2 fw-bold">Barang Masuk</span>
                                            @else
                                                <span class="badge bg-danger text-white rounded-pill px-3 py-2 fw-bold">Barang Keluar</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-center fw-bold text-dark">
                                            {{ $mutation->amount ?? $mutation->quantity ?? $mutation->jumlah ?? 0 }}
                                        </td>
                                        <td class="px-4 py-3 text-start text-muted fw-bold">
                                            {{ $mutation->notes ?? $mutation->description ?? $mutation->keterangan ?? '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-5 text-center text-dark fw-bold fst-italic">
                                            Belum ada data mutasi stok.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if(method_exists($mutations, 'hasPages') && $mutations->hasPages())
                    <div class="card-footer bg-white py-3 border-0">
                        {{ $mutations->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>