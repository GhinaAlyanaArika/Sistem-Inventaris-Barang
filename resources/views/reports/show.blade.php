<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">Struk Transaksi #{{ $transaction->invoice_number }}</h2>
    </x-slot>

    <!-- Container Utama: Untuk menengahkan konten -->
    <div class="container-fluid py-5 d-flex flex-column align-items-center justify-content-center" style="min-height: 70vh; background-color: #f8f9fa;">
        
        <!-- KOTAK STRUK (Dikunci lebarnya 350px agar tidak raksasa) -->
        <div id="receipt-card" class="bg-white p-4 shadow-sm" style="width: 350px; font-family: 'Courier New', Courier, monospace; color: #000; border: 1px solid #dee2e6;">
            
            <!-- HEADER STRUK -->
            <div class="text-center mb-3 pb-2" style="border-bottom: 2px dashed #adb5bd;">
                <h4 class="fw-bold mb-1 text-uppercase">{{ $appName ?? 'SMART INVENTORY' }}</h4>
                <small class="text-muted">Struk Pembayaran Resmi</small>
            </div>

            <!-- INFO TRANSAKSI -->
            <div class="mb-3" style="font-size: 0.85rem;">
                <div class="d-flex justify-content-between">
                    <span class="fw-bold">No:</span> 
                    <span>{{ $transaction->invoice_number }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="fw-bold">Tanggal:</span> 
                    <span>{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="fw-bold">Kasir:</span> 
                    <span>{{ $transaction->user->name ?? 'Kasir' }}</span>
                </div>
            </div>

            <div class="mb-2" style="border-bottom: 2px dashed #adb5bd;"></div>

            <!-- DAFTAR ITEM -->
            <div class="mb-3" style="font-size: 0.85rem;">
                @foreach($transaction->details as $detail)
                    <div class="mb-2">
                        <div class="fw-bold">{{ $detail->item->name }}</div>
                        <div class="d-flex justify-content-between">
                            <span>{{ $detail->quantity }} x {{ $currency ?? 'Rp' }} {{ number_format($detail->price, 0, ',', '.') }}</span>
                            <span>{{ $currency ?? 'Rp' }} {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mb-2" style="border-bottom: 2px dashed #adb5bd;"></div>

            <!-- TOTAL & PEMBAYARAN -->
            @php
                $subtotalStruk = $transaction->details->sum('subtotal');
                $pajakStruk = $transaction->total_amount - $subtotalStruk;
            @endphp
            <div class="mb-3" style="font-size: 0.85rem;">
                <div class="d-flex justify-content-between mb-1">
                    <span>Subtotal:</span>
                    <span>{{ $currency ?? 'Rp' }} {{ number_format($subtotalStruk, 0, ',', '.') }}</span>
                </div>
                
                @if($pajakStruk > 0)
                <div class="d-flex justify-content-between mb-1">
                    <span>PPN:</span>
                    <span>{{ $currency ?? 'Rp' }} {{ number_format($pajakStruk, 0, ',', '.') }}</span>
                </div>
                @endif
                
                <!-- Total -->
                <div class="d-flex justify-content-between fw-bold mt-2 pt-2" style="border-top: 2px dashed #adb5bd; font-size: 0.95rem;">
                    <span>Total:</span>
                    <span>{{ $currency ?? 'Rp' }} {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                </div>
                
                <!-- Pembayaran -->
                <div class="d-flex justify-content-between mt-2">
                    <span>Bayar:</span>
                    <span>{{ $currency ?? 'Rp' }} {{ number_format($transaction->pay_amount ?? $transaction->paid_amount ?? $transaction->total_amount, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Kembali:</span>
                    <span>{{ $currency ?? 'Rp' }} {{ number_format($transaction->change_amount ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="mb-3" style="border-bottom: 2px dashed #adb5bd;"></div>

            <!-- FOOTER STRUK -->
            <div class="text-center fst-italic" style="font-size: 0.8rem; color: #6c757d;">
                "{{ $receiptFooter ?? 'Terima kasih atas kunjungan Anda!' }}"
            </div>
        </div>

        <!-- TOMBOL AKSI (Lebarnya disamakan dengan struk = 350px) -->
        <div class="d-flex gap-2 mt-4" style="width: 350px;">
            <!-- Tombol Unduh -->
            <button onclick="downloadReceiptPNG()" class="btn btn-primary flex-fill fw-bold shadow-sm">
                Unduh Struk
            </button>
            <!-- Tombol Kembali -->
            <a href="{{ route('reports.index') }}" class="btn btn-secondary flex-fill fw-bold shadow-sm">
                Kembali
            </a>
        </div>

    </div>

    <!-- Script HTML2Canvas untuk Export PNG yang akurat -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        function downloadReceiptPNG() {
            const receiptElement = document.getElementById('receipt-card');
            
            // Simpan border lama
            const originalBorder = receiptElement.style.border;
            // Hapus border dan shadow sementara agar file PNG bersih
            receiptElement.style.border = 'none'; 
            receiptElement.classList.remove('shadow-sm');

            html2canvas(receiptElement, {
                scale: 3, // Kualitas HD agar teks tidak pecah
                backgroundColor: "#ffffff",
                useCORS: true
            }).then(canvas => {
                // Kembalikan style seperti semula
                receiptElement.style.border = originalBorder;
                receiptElement.classList.add('shadow-sm');

                const link = document.createElement('a');
                link.download = 'Struk-{{ $transaction->invoice_number }}.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        }
    </script>
</x-app-layout>