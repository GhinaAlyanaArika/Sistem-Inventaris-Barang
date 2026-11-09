<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">Dashboard</h2>
    </x-slot>

    <!-- 4 RINGKASAN CARDS (SERAGAM, SERTA BERSIH/POLOS METODE BG-WHITE) -->
    <div class="row g-4 mb-4">
        <!-- Card 1: Total Jenis Barang -->
        <div class="col-md-6 col-lg-3">
            <div class="card bg-white shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="small fw-bold text-uppercase text-muted">Total Jenis Barang</div>
                    <h3 class="fw-black text-dark mb-0 mt-2">{{ \App\Models\Item::count() }}</h3>
                    <div class="small fw-bold text-muted mt-2">Model Barang Terdaftar</div>
                </div>
            </div>
        </div>
        
        <!-- Card 2: Stok Menipis -->
        <div class="col-md-6 col-lg-3">
            <div class="card bg-white shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="small fw-bold text-uppercase text-muted">Stok Menipis</div>
                    <h3 class="fw-black text-danger mb-0 mt-2">{{ \App\Models\Item::where('stock', '<=', 5)->count() }}</h3>
                    <div class="small fw-bold text-muted mt-2">Perlu Restock Segera</div>
                </div>
            </div>
        </div>
        
        <!-- Card 3: Total Transaksi -->
        <div class="col-md-6 col-lg-3">
            <div class="card bg-white shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="small fw-bold text-uppercase text-muted">Total Transaksi</div>
                    <h3 class="fw-black text-primary mb-0 mt-2">{{ \App\Models\Transaction::count() }}</h3>
                    <div class="small fw-bold text-muted mt-2">Penjualan Terproses</div>
                </div>
            </div>
        </div>

        <!-- Card 4: Total User -->
        <div class="col-md-6 col-lg-3">
            <div class="card bg-white shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="small fw-bold text-uppercase text-muted">Pengguna Sistem</div>
                    <h3 class="fw-black text-dark mb-0 mt-2">{{ \App\Models\User::count() }}</h3>
                    <div class="small fw-bold text-muted mt-2">Admin & Staf Aktif</div>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL INFORMASI BAWAH -->
    <div class="row g-4">
        <!-- TABEL PERINGATAN STOK MENIPIS -->
        <div class="col-lg-7">
            @php
                $lowItems = \App\Models\Item::where('stock', '<=', 5)->paginate(5, ['*'], 'stok_page');
            @endphp
            <div class="card bg-white shadow-sm border-0 rounded-4 h-100 overflow-hidden">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-0" style="border-bottom: 2px solid #adb5bd !important;">
                    <h6 class="m-0 fw-bold text-danger">Peringatan Stok Menipis</h6>
                    <a href="{{ route('items.index') }}" class="btn btn-outline-secondary btn-sm fw-bold rounded-pill px-3">Lihat Semua &rarr;</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-dark small text-uppercase" style="border-bottom: 2px solid #adb5bd;">
                                <tr>
                                    <th class="px-4 py-3 fw-bold border-0">Nama Barang</th>
                                    <th class="px-4 py-3 fw-bold border-0">Kategori</th>
                                    <th class="px-4 py-3 fw-bold border-0 text-center">Sisa Stok</th>
                                    <th class="px-4 py-3 text-end fw-bold border-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                @forelse($lowItems as $lowItem)
                                    <tr>
                                        <td class="px-4 py-3 fw-bold text-dark">{{ $lowItem->name }}</td>
                                        <td class="px-4 py-3 text-muted fw-bold">{{ $lowItem->category->name ?? '-' }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="badge bg-light text-danger border border-danger rounded-pill px-3 py-1 fw-bold">{{ $lowItem->stock }} Pcs</span>
                                        </td>
                                        <td class="px-4 py-3 text-end">
                                            <a href="{{ route('mutations.create', ['item_id' => $lowItem->id]) }}" class="btn btn-sm btn-dark rounded-pill px-3 fw-bold">Restock</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted fw-bold fst-italic">Semua stok barang aman.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($lowItems->hasPages())
                    <div class="card-footer bg-white border-0 pt-3 pb-3">
                        {{ $lowItems->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- TABEL TRANSAKSI TERBARU -->
        <div class="col-lg-5">
            <div class="card bg-white shadow-sm border-0 rounded-4 h-100 overflow-hidden">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-0" style="border-bottom: 2px solid #adb5bd !important;">
                    <h6 class="m-0 fw-bold text-primary">Transaksi Terbaru</h6>
                    <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary btn-sm fw-bold rounded-pill px-3">Kasir &rarr;</a>
                </div>
                <div class="card-body p-0" style="max-height: 400px; overflow-y: auto;">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-dark small text-uppercase" style="border-bottom: 2px solid #adb5bd;">
                                <tr>
                                    <th class="px-4 py-3 fw-bold border-0">Faktur & Waktu</th>
                                    <th class="px-4 py-3 text-end fw-bold border-0">Total</th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                @forelse(\App\Models\Transaction::latest()->take(10)->get() as $trx)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <a href="{{ route('reports.show', $trx->id) }}" class="fw-bold text-primary text-decoration-none d-block">{{ $trx->invoice_number }}</a>
                                            <div class="text-muted small fw-bold mt-1">{{ $trx->created_at->format('d/m/Y H:i') }}</div>
                                        </td>
                                        <td class="px-4 py-3 text-end fw-bold text-dark">
                                            Rp {{ number_format($trx->total_amount, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center py-5 text-muted fw-bold fst-italic">Belum ada transaksi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>