<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">Catat Mutasi Stok</h2>
    </x-slot>

    <div class="py-4">
        <div class="container-fluid max-w-7xl mx-auto">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card bg-white shadow-sm border-0 rounded-4 overflow-hidden">
                        
                        <!-- CARD HEADER EDGE-TO-EDGE -->
                        <div class="card-header bg-white py-3 border-0" style="border-bottom: 2px solid #adb5bd !important;">
                            <h5 class="m-0 fw-bold text-dark">Form Mutasi Stok</h5>
                        </div>

                        <div class="card-body p-4">
                            
                            <!-- ALERT NOTIFIKASI ERROR -->
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show rounded-3 fw-bold mb-4" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('mutations.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Tanggal Transaksi</label>
                                    <input type="text" value="{{ date('d/m/Y') }}" readonly class="form-control rounded-3 bg-light text-dark fw-bold">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Pilih Barang</label>
                                    <select name="item_id" class="form-select rounded-3 fw-bold text-dark" required>
                                        <option value="">-- Pilih Barang --</option>
                                        @foreach($items as $item)
                                            <option value="{{ $item->id }}" {{ ((isset($selectedItemId) && $selectedItemId == $item->id) || request('item_id') == $item->id) ? 'selected' : '' }}>
                                                {{ $item->name }} (Sisa Stok: {{ $item->stock }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-dark">Jenis Mutasi</label>
                                        <select name="type" class="form-select rounded-3 fw-bold text-dark" required>
                                            <option value="in" selected>Barang Masuk (Tambah Stok)</option>
                                            <option value="out">Barang Keluar (Pengurangan Stok)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mt-3 mt-md-0">
                                        <label class="form-label fw-bold text-dark">Jumlah Barang</label>
                                        <input type="number" name="quantity" min="1" required placeholder="Masukkan jumlah stok (contoh: 10)" class="form-control rounded-3 fw-bold text-dark">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold text-dark">Keterangan / Catatan (Opsional)</label>
                                    <textarea name="notes" rows="3" placeholder="Restock barang dari supplier..." class="form-control rounded-3 fw-bold text-dark"></textarea>
                                </div>

                                <!-- ACTION BUTTONS -->
                                <div class="d-flex justify-content-between align-items-center pt-3" style="border-top: 2px solid #adb5bd !important;">
                                    <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('mutations.index') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">
                                        Kembali
                                    </a>
                                    <button type="submit" class="btn btn-dark rounded-pill px-4 fw-bold">
                                        Simpan Mutasi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>