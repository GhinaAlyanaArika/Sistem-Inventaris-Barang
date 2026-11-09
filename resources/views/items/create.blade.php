<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">Tambah Barang Baru</h2>
    </x-slot>

    <div class="py-4">
        <div class="container-fluid max-w-7xl mx-auto">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card bg-white shadow-sm border-0 rounded-4 overflow-hidden">
                        
                        <!-- CARD HEADER EDGE-TO-EDGE -->
                        <div class="card-header bg-white py-3 border-0" style="border-bottom: 2px solid #adb5bd !important;">
                            <h5 class="m-0 fw-bold text-dark">Form Tambah Barang</h5>
                        </div>

                        <div class="card-body p-4">
                            
                            <!-- ALERT VALIDASI ERROR FORM -->
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show rounded-3 fw-bold mb-4" role="alert">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('items.store') }}" method="POST">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="sku" class="form-label fw-bold text-dark">Kode SKU Barang <span class="text-muted fw-normal small">(Opsional - Otomatis jika dikosongkan)</span></label>
                                    <input type="text" class="form-control rounded-3 fw-bold text-dark" id="sku" name="sku" placeholder="Contoh: ELK-001" value="{{ old('sku') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold text-dark">Nama Barang</label>
                                    <input type="text" class="form-control rounded-3 fw-bold text-dark" id="name" name="name" placeholder="Contoh: Laptop Asus" value="{{ old('name') }}" required>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="price" class="form-label fw-bold text-dark">Harga Barang (Rp)</label>
                                        <input type="number" min="0" class="form-control rounded-3 fw-bold text-dark" id="price" name="price" placeholder="Contoh: 10000000" value="{{ old('price', 0) }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="category_id" class="form-label fw-bold text-dark">Kategori Barang</label>
                                        <select class="form-select rounded-3 fw-bold text-dark" id="category_id" name="category_id" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="stock" class="form-label fw-bold text-dark">Stok Awal</label>
                                    <input type="number" min="0" class="form-control rounded-3 fw-bold text-dark" id="stock" name="stock" value="{{ old('stock', 0) }}" required>
                                </div>

                                <!-- ACTION BUTTONS -->
                                <div class="d-flex justify-content-between align-items-center pt-3" style="border-top: 2px solid #adb5bd !important;">
                                    <a href="{{ route('items.index') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">
                                        Batal
                                    </a>
                                    <button type="submit" class="btn btn-dark rounded-pill px-4 fw-bold">
                                        Simpan Barang
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