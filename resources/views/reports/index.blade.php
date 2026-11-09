<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">Laporan Penjualan</h2>
    </x-slot>

    <!-- SUMMARY CARDS -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card bg-white shadow-sm border-0 h-100 rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center p-4">
                    <div>
                        <div class="small fw-bold text-uppercase text-muted">Total Transaksi Terfilter</div>
                        <h3 class="fw-black text-dark mb-0 mt-2">{{ $totalTransaksi }} Transaksi</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-white shadow-sm border-0 h-100 rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center p-4">
                    <div>
                        <div class="small fw-bold text-uppercase text-muted">Total Pendapatan Terfilter</div>
                        <h3 class="fw-black text-success mb-0 mt-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FILTER SECTION -->
    <div class="card bg-white shadow-sm border-0 mb-4 rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('reports.index') }}" method="GET" class="border-bottom pb-4 mb-4" style="border-color: #adb5bd !important; border-width: 2px !important;">
                <div class="row g-3 align-items-end">
                    <div class="col-md-2">
                        <label class="form-label small fw-bold text-dark mb-1">Tanggal Mulai</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control rounded-3 fw-bold text-dark">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold text-dark mb-1">Tanggal Akhir</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control rounded-3 fw-bold text-dark">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-dark mb-1">No. Invoice</label>
                        <input type="text" name="invoice" value="{{ request('invoice') }}" placeholder="Cari invoice..." class="form-control rounded-3 fw-bold text-dark">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-dark mb-1">Nama Kasir</label>
                        <input type="text" name="kasir" value="{{ request('kasir') }}" placeholder="Cari kasir..." class="form-control rounded-3 fw-bold text-dark">
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-dark fw-bold rounded-3 w-100">
                            Filter
                        </button>
                        
                        <!-- Cek apakah ada filter yang aktif -->
                        @if(request()->anyFilled(['start_date', 'end_date', 'invoice', 'kasir']))
                            <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary fw-bold rounded-3 w-100 d-flex align-items-center justify-content-center text-decoration-none">
                                Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>

            <!-- EXPORT BUTTONS -->
            <div class="d-flex justify-content-end gap-2">
                <!-- Export CSV (Mengunduh SEMUA data terfilter) -->
                <form action="{{ route('reports.export') }}" method="GET" class="m-0">
                    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                    <input type="hidden" name="invoice" value="{{ request('invoice') }}">
                    <input type="hidden" name="kasir" value="{{ request('kasir') }}">
                    <button type="submit" class="btn btn-success fw-bold rounded-pill px-4">
                        Export CSV
                    </button>
                </form>

                <!-- Save PDF (Mencetak SEMUA data terfilter di tab baru) -->
                <form action="{{ route('reports.print') }}" method="GET" target="_blank" class="m-0">
                    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                    <input type="hidden" name="invoice" value="{{ request('invoice') }}">
                    <input type="hidden" name="kasir" value="{{ request('kasir') }}">
                    <button type="submit" class="btn btn-primary fw-bold rounded-pill px-4">
                        Save PDF
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- TABLE DATA PENJUALAN -->
    <div class="card bg-white shadow-sm border-0 rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 w-100">
                    <thead class="bg-light text-dark small text-uppercase" style="border-bottom: 2px solid #adb5bd;">
                        <tr>
                            <th class="px-4 py-3 border-0 fw-bold text-start">Tanggal</th>
                            <th class="px-4 py-3 border-0 fw-bold text-start">No. Invoice</th>
                            <th class="px-4 py-3 border-0 fw-bold">Total Item</th>
                            <th class="px-4 py-3 border-0 fw-bold">Total Harga</th>
                            <th class="px-4 py-3 border-0 fw-bold">Dibayar</th>
                            <th class="px-4 py-3 border-0 fw-bold">Kembalian</th>
                            <th class="px-4 py-3 border-0 fw-bold text-start">Kasir</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @php 
                            $pageTotalItem = 0;
                            $pageTotalAmount = 0;
                            $pageTotalPay = 0;
                            $pageTotalChange = 0;
                        @endphp
                        
                        @forelse($transactions as $t)
                            @php
                                $itemCount = $t->details ? $t->details->sum('quantity') : 0;
                                $payAmount = $t->pay_amount ?? $t->paid_amount ?? $t->total_amount;
                                $changeAmount = $t->change_amount ?? 0;

                                $pageTotalItem += $itemCount;
                                $pageTotalAmount += $t->total_amount;
                                $pageTotalPay += $payAmount;
                                $pageTotalChange += $changeAmount;
                            @endphp
                            <tr>
                                <td class="px-4 py-3 text-muted fw-bold text-start">{{ $t->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3 text-start">
                                    <a href="{{ route('reports.show', $t->id) }}" class="text-decoration-none fw-bold text-primary">{{ $t->invoice_number }}</a>
                                </td>
                                <td class="px-4 py-3 text-muted fw-bold">{{ $itemCount }} Item</td>
                                <td class="px-4 py-3 fw-bold text-dark">Rp {{ number_format($t->total_amount, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-success fw-bold">Rp {{ number_format($payAmount, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 fw-bold {{ ($changeAmount > 0) ? 'text-danger' : 'text-muted' }}">
                                    Rp {{ number_format($changeAmount, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-muted fw-bold text-start">{{ $t->user->name ?? 'Kasir' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-5 text-center text-dark fw-bold">Data penjualan tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    
                    @if(count($transactions) > 0)
                    <tfoot class="bg-light" style="border-top: 2px solid #adb5bd; border-bottom: 2px solid #adb5bd;">
                        <tr>
                            <td colspan="2" class="px-4 py-3 text-end small fw-bold text-dark text-uppercase">Total Halaman Ini:</td>
                            <td class="px-4 py-3 fw-bold text-dark">{{ $pageTotalItem }} Item</td>
                            <td class="px-4 py-3 fw-bold text-dark">Rp {{ number_format($pageTotalAmount, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 fw-bold text-success">Rp {{ number_format($pageTotalPay, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 fw-bold text-danger">Rp {{ number_format($pageTotalChange, 0, ',', '.') }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
            
            @if($transactions->hasPages())
                <div class="px-4 py-3 border-0">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>