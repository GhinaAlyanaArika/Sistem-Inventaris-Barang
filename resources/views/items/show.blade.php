<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">Detail & Riwayat Stok: {{ $item->name }}</h2>
    </x-slot>

    <div class="py-4">
        <div class="container-fluid max-w-7xl mx-auto space-y-4">

            <!-- Informasi Singkat Data Barang -->
            <div class="card bg-white shadow-sm border-0 rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center border-bottom pb-3 mb-4 gap-3 border-2" style="border-color: #adb5bd !important;">
                        <div>
                            <h3 class="fw-bold text-dark mb-1 fs-5">{{ $item->name }}</h3>
                            <p class="small text-muted mb-0">Informasi detail dan ketersediaan stok barang</p>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-primary fw-bold rounded-pill px-4">
                                Edit Barang
                            </a>
                            <a href="{{ route('items.index') }}" class="btn btn-outline-dark fw-bold rounded-pill px-4">
                                &larr; Kembali
                            </a>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-2 col-sm-6">
                            <div class="bg-light p-3 rounded-4 border h-100">
                                <span class="small text-muted fw-bold text-uppercase d-block mb-1" style="font-size: 0.75rem;">Kode SKU</span>
                                <p class="mb-0 fw-bold text-dark text-break" style="font-family: monospace;">{{ $item->sku }}</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="bg-light p-3 rounded-4 border h-100">
                                <span class="small text-muted fw-bold text-uppercase d-block mb-1" style="font-size: 0.75rem;">Nama Barang</span>
                                <p class="mb-0 fw-bold text-dark text-truncate" title="{{ $item->name }}">{{ $item->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="bg-light p-3 rounded-4 border h-100">
                                <span class="small text-muted fw-bold text-uppercase d-block mb-1" style="font-size: 0.75rem;">Harga Satuan</span>
                                <p class="mb-0 fw-bolder text-success fs-5">Rp {{ number_format($item->price ?? 0, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <div class="bg-light p-3 rounded-4 border h-100">
                                <span class="small text-muted fw-bold text-uppercase d-block mb-1" style="font-size: 0.75rem;">Kategori</span>
                                <p class="mb-0 fw-bold text-dark">{{ $item->category->name ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <div class="bg-light p-3 rounded-4 border h-100 text-center">
                                <span class="small text-muted fw-bold text-uppercase d-block mb-1" style="font-size: 0.75rem;">Stok Saat Ini</span>
                                <p class="mb-0 fs-4 fw-black {{ ($item->stock ?? 0) <= 5 ? 'text-danger' : 'text-primary' }}">{{ number_format($item->stock ?? 0) }} Pcs</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Riwayat Mutasi Stok Barang -->
            <div class="card bg-white shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center" style="border-bottom: 2px solid #adb5bd !important;">
                    <h5 class="m-0 fw-bold text-dark">Riwayat Mutasi Stok Barang</h5>
                    <a href="{{ route('mutations.create', ['item_id' => $item->id]) }}" class="btn btn-dark fw-bold rounded-pill px-3 btn-sm">
                        + Tambah / Restock
                    </a>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 w-100">
                            <thead class="bg-light text-dark small text-uppercase" style="border-bottom: 2px solid #adb5bd;">
                                <tr>
                                    <th class="px-4 py-3 border-0 fw-bold text-dark text-start">Waktu Transaksi</th>
                                    <th class="px-4 py-3 border-0 fw-bold text-dark text-center">Jenis Mutasi</th>
                                    <th class="px-4 py-3 border-0 fw-bold text-dark text-center">Jumlah Stok</th>
                                    <th class="px-4 py-3 border-0 fw-bold text-dark text-start">Catatan / Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                @forelse($item->mutations ?? [] as $mutation)
                                    <tr>
                                        <td class="px-4 py-3 text-muted fw-bold text-start" style="font-family: monospace;">
                                            {{ \Carbon\Carbon::parse($mutation->mutation_date ?? $mutation->created_at)->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            @if(($mutation->type ?? '') === 'in' || ($mutation->type ?? '') === 'masuk')
                                                <span class="badge bg-success rounded-pill px-3 py-2">Barang Masuk (+)</span>
                                            @else
                                                <span class="badge bg-danger rounded-pill px-3 py-2">Barang Keluar (-)</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-center fw-bold text-dark">
                                            {{ $mutation->quantity }} Pcs
                                        </td>
                                        <td class="px-4 py-3 text-muted fw-bold">
                                            {{ $mutation->notes ?? $mutation->note ?? '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-5 text-center text-dark fw-bold fst-italic">
                                            Belum ada riwayat mutasi stok untuk barang ini.
                                        </td>
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