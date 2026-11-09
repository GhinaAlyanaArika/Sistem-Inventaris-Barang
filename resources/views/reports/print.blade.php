<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Cetak PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @page {
            size: landscape;
            margin: 10mm;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #000;
        }
        .table th, .table td {
            font-size: 11px;
            padding: 8px;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container-fluid py-3">
        <div class="text-center mb-4">
            <h3 class="fw-bold mb-1">LAPORAN PENJUALAN SMART INVENTORY</h3>
            <p class="text-muted small mb-0">Total Transaksi: {{ $totalTransaksi }} | Total Pendapatan: Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>

        <table class="table table-bordered align-middle w-100">
            <thead class="table-light text-uppercase small" style="border-bottom: 2px solid #adb5bd;">
                <tr>
                    <th class="py-2">No</th>
                    <th class="py-2">Tanggal</th>
                    <th class="py-2">No. Invoice</th>
                    <th class="py-2">Total Item</th>
                    <th class="py-2">Total Harga</th>
                    <th class="py-2">Dibayar</th>
                    <th class="py-2">Kembalian</th>
                    <th class="py-2">Kasir</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $grandTotalItem = 0;
                    $grandTotalAmount = 0;
                    $grandTotalPay = 0;
                    $grandTotalChange = 0;
                @endphp
                @forelse($transactions as $index => $t)
                    @php
                        $itemCount = $t->details ? $t->details->sum('quantity') : 0;
                        $payAmount = $t->pay_amount ?? $t->paid_amount ?? $t->total_amount;
                        $changeAmount = $t->change_amount ?? 0;

                        $grandTotalItem += $itemCount;
                        $grandTotalAmount += $t->total_amount;
                        $grandTotalPay += $payAmount;
                        $grandTotalChange += $changeAmount;
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $t->created_at->format('d/m/Y H:i') }}</td>
                        <td class="fw-bold">{{ $t->invoice_number }}</td>
                        <td>{{ $itemCount }} Item</td>
                        <td class="fw-bold">Rp {{ number_format($t->total_amount, 0, ',', '.') }}</td>
                        <td class="text-success fw-bold">Rp {{ number_format($payAmount, 0, ',', '.') }}</td>
                        <td class="text-danger fw-bold">Rp {{ number_format($changeAmount, 0, ',', '.') }}</td>
                        <td>{{ $t->user->name ?? 'Kasir' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">Tidak ada data transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
            @if(count($transactions) > 0)
            <tfoot class="table-light" style="border-top: 2px solid #adb5bd; border-bottom: 2px solid #adb5bd;">
                <tr class="fw-bold">
                    <td colspan="3" class="text-end text-uppercase">Total Keseluruhan Terfilter:</td>
                    <td>{{ $grandTotalItem }} Item</td>
                    <td>Rp {{ number_format($grandTotalAmount, 0, ',', '.') }}</td>
                    <td class="text-success">Rp {{ number_format($grandTotalPay, 0, ',', '.') }}</td>
                    <td class="text-danger">Rp {{ number_format($grandTotalChange, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</body>
</html>