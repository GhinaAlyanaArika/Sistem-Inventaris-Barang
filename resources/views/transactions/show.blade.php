<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">Detail Struk Transaksi</h2>
    </x-slot>

    <!-- HTML2Canvas Script untuk Unduh PNG -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        /* CSS KHUSUS PRINTER / PRINT PREVIEW */
        @media print {
            body * {
                visibility: hidden !important;
            }
            .sidebar, .topbar, navbar, header, .no-print, nav, .btn, #sidebar, .dropdown {
                display: none !important;
                visibility: hidden !important;
            }
            #receipt-card, #receipt-card * {
                visibility: visible !important;
            }
            #receipt-card {
                position: absolute !important;
                left: 50% !important;
                top: 0 !important;
                transform: translateX(-50%) !important;
                width: 100% !important;
                max-width: 380px !important;
                margin: 0 !important;
                padding: 15px !important;
                box-shadow: none !important;
                border: none !important;
                background: #ffffff !important;
            }
            @page {
                size: auto;
                margin: 0;
            }
        }
    </style>

    <div class="py-4">
        <div class="container-fluid max-w-7xl mx-auto">
            <div class="row justify-content-center">
                <div class="col-12 d-flex flex-column align-items-center">
                    
                    <!-- KARTU STRUK TRANSAKSI -->
                    <div id="receipt-card" class="card bg-white shadow-sm border rounded-4 p-4 mb-3" style="width: 100%; max-width: 380px; font-family: 'Courier New', Courier, monospace;">
                        
                        <!-- HEADER STRUK -->
                        <div class="text-center mb-3">
                            <h4 class="fw-bold text-dark text-uppercase mb-1">{{ $appName ?? 'SMART INVENTORY' }}</h4>
                            @if(!empty($address)) <p class="small text-muted mb-0" style="font-size: 11px;">{{ $address }}</p> @endif
                            @if(!empty($phone)) <p class="small text-muted mb-0" style="font-size: 11px;">Telp: {{ $phone }}</p> @endif
                            <p class="small text-dark fw-bold mt-1 mb-0" style="font-size: 12px;">Struk Pembayaran Resmi</p>
                            <hr class="my-2" style="border-top: 2px dashed #6c757d;">
                        </div>

                        <!-- METADATA STRUK -->
                        <div class="small text-dark mb-2" style="font-size: 12px;">
                            <div class="d-flex justify-content-between">
                                <span>No Invoice:</span>
                                <span class="fw-bold">{{ $transaction->invoice_number }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Tanggal:</span>
                                <span>{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Kasir:</span>
                                <span>{{ $transaction->user->name ?? 'Kasir' }}</span>
                            </div>
                        </div>

                        <hr class="my-2" style="border-top: 2px dashed #6c757d;">

                        <!-- RINCIAN BARANG -->
                        <table class="w-100 small text-dark mb-2" style="font-size: 12px;">
                            @foreach($transaction->details as $detail)
                                <tr>
                                    <td colspan="2" class="fw-bold py-1">{{ $detail->item->name ?? 'Barang' }}</td>
                                </tr>
                                <tr>
                                    <td class="pb-2 text-muted" style="font-size: 11px;">{{ $detail->quantity }} x {{ $currency ?? 'Rp' }} {{ number_format($detail->price, 0, ',', '.') }}</td>
                                    <td class="pb-2 text-end fw-bold text-dark">{{ $currency ?? 'Rp' }} {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </table>

                        <hr class="my-2" style="border-top: 2px dashed #6c757d;">

                        @php
                            $subtotalStruk = $transaction->details->sum('subtotal');
                            $pajakStruk = $transaction->total_amount - $subtotalStruk;
                        @endphp

                        <!-- TOTAL & PEMBAYARAN -->
                        <div class="small text-dark pt-1" style="font-size: 12px;">
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

                            <div class="d-flex justify-content-between fw-bold fs-6 pt-2 my-1 border-top border-dark text-dark">
                                <span>TOTAL:</span>
                                <span>{{ $currency ?? 'Rp' }} {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-1">
                                <span>DIBAYAR:</span>
                                <span>{{ $currency ?? 'Rp' }} {{ number_format($transaction->pay_amount ?? $transaction->paid_amount ?? $transaction->total_amount, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold">
                                <span>KEMBALI:</span>
                                <span>{{ $currency ?? 'Rp' }} {{ number_format($transaction->change_amount ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <hr class="my-3" style="border-top: 2px dashed #6c757d;">

                        <!-- FOOTER STRUK -->
                        <div class="text-center small text-muted fst-italic px-2" style="font-size: 11px;">
                            "{{ $receiptFooter ?? 'Terima kasih telah berbelanja di toko kami.' }}"
                        </div>
                    </div>

                    <!-- TOMBOL AKSI -->
                    <div class="d-flex flex-column gap-2 no-print" style="width: 100%; max-width: 380px;">
                        <div class="d-flex gap-2">
                            <button onclick="window.print()" class="btn btn-dark w-100 rounded-pill fw-bold py-2 shadow-sm">
                                Cetak Struk
                            </button>
                            <button onclick="downloadReceiptPNG()" class="btn btn-success text-white w-100 rounded-pill fw-bold py-2 shadow-sm">
                                Unduh PNG
                            </button>
                        </div>
                        <button onclick="goBackOrReturn()" class="btn btn-outline-secondary w-100 rounded-pill fw-bold py-2 text-center">
                            Kembali ke Kasir
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function downloadReceiptPNG() {
            const receiptElement = document.getElementById('receipt-card');

            html2canvas(receiptElement, {
                scale: 3,
                backgroundColor: "#ffffff"
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'Struk-{{ $transaction->invoice_number }}.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        }

        function goBackOrReturn() {
            // Jika halaman dibuka di tab baru tersendiri, tutup tabnya. Jika tidak, arahkan kembali ke kasir.
            if (window.opener && !window.opener.closed) {
                window.close();
            } else {
                window.location.href = "{{ route('transactions.index') }}";
            }
        }
    </script>
</x-app-layout>