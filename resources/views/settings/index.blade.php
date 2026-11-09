<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">Pengaturan Aplikasi</h2>
    </x-slot>

    <div class="container-fluid py-4">
        <!-- NOTIFIKASI -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 fw-bold mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3 fw-bold mb-4" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- GRID 2 KOLOM SIMETRIS -->
            <div class="row g-4 mb-4">
                
                <!-- KOLOM 1: PROFIL TOKO & SISTEM -->
                <div class="col-lg-6">
                    <div class="card bg-white shadow-sm border-0 rounded-4 h-100">
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <div class="border-bottom pb-3 mb-4" style="border-color: #adb5bd !important;">
                                    <h5 class="fw-bold text-dark mb-1">Profil Toko & Sistem</h5>
                                    <p class="small text-muted mb-0">Identitas utama toko yang muncul pada sistem dan nota cetak.</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-dark">Nama Toko / Sistem</label>
                                    <input type="text" name="app_name" value="{{ old('app_name', $appName) }}" class="form-control rounded-3 fw-bold text-dark" required>
                                    @error('app_name')
                                        <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-dark">Alamat Lengkap Toko</label>
                                    <textarea name="address" rows="3" class="form-control rounded-3 fw-bold text-dark">{{ old('address', $address) }}</textarea>
                                    @error('address')
                                        <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-dark">Nomor Telepon</label>
                                        <input type="text" name="phone" value="{{ old('phone', $phone) }}" class="form-control rounded-3 fw-bold text-dark">
                                        @error('phone')
                                            <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-dark">Jam Operasional</label>
                                        <input type="text" name="operating_hours" value="{{ old('operating_hours', $operatingHours) }}" class="form-control rounded-3 fw-bold text-dark" placeholder="Contoh: 08:00 - 22:00 WIB">
                                        @error('operating_hours')
                                            <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KOLOM 2: PENGATURAN KASIR & STRUK -->
                <div class="col-lg-6">
                    <div class="card bg-white shadow-sm border-0 rounded-4 h-100">
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <div class="border-bottom pb-3 mb-4" style="border-color: #adb5bd !important;">
                                    <h5 class="fw-bold text-dark mb-1">Pengaturan Kasir & Struk</h5>
                                    <p class="small text-muted mb-0">Konfigurasi format mata uang, tarif pajak, dan catatan kaki struk.</p>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-dark">Simbol Mata Uang</label>
                                        <input type="text" name="currency" value="{{ old('currency', $currency) }}" class="form-control rounded-3 fw-bold text-dark" placeholder="Rp / IDR">
                                        @error('currency')
                                            <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-dark">Pajak / PPN (%)</label>
                                        <input type="number" step="0.1" name="tax_percentage" value="{{ old('tax_percentage', $taxPercentage) }}" class="form-control rounded-3 fw-bold text-dark" placeholder="0">
                                        @error('tax_percentage')
                                            <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-dark">Catatan Bawah Struk (Footer)</label>
                                    <textarea name="receipt_footer" rows="3" class="form-control rounded-3 fw-bold text-dark" placeholder="Terima kasih telah berbelanja...">{{ old('receipt_footer', $receiptFooter) }}</textarea>
                                    <div class="form-text small text-muted mt-1">Teks ini akan dicetak di bagian paling bawah nota/struk pembeli.</div>
                                    @error('receipt_footer')
                                        <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="pt-3 border-top d-flex justify-content-end" style="border-color: #adb5bd !important;">
                                <button type="submit" class="btn btn-dark fw-bold rounded-pill px-4">
                                    Simpan Pengaturan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>

        <!-- CARD 3: BACKUP & KEAMANAN DATABASE -->
        <div class="card bg-white shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Backup & Keamanan Database Sistem</h5>
                        <p class="small text-muted mb-0">Unduh data SQL sistem secara periodik untuk mencegah kehilangan data akibat kendala server.</p>
                    </div>
                    <div>
                        <a href="{{ route('backup.download') }}" class="btn btn-outline-dark fw-bold rounded-pill px-4">
                            Download Backup SQL
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>