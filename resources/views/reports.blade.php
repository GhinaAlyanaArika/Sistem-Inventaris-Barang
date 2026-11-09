<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Penjualan') }}
        </h2>
    </x-slot>

    <!-- Style Khusus Cetak/PDF -->
    <style>
        @media print {
            nav, header, .no-print, form {
                display: none !important;
            }
            body {
                background-color: #ffffff !important;
            }
            .print-only-header {
                display: block !important;
            }
            .shadow-sm, .rounded-lg {
                box-shadow: none !important;
                border-radius: 0 !important;
            }
        }
        .print-only-header {
            display: none;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Ringkasan Statistik Laporan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 no-print">
                <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Transaksi Terfilter</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($totalTransaksi ?? $transactions->total()) }} Transaksi</p>
                    </div>
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Pendapatan Terfilter</p>
                        <p class="text-2xl font-bold text-emerald-600 mt-1">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div class="p-3 bg-emerald-50 text-emerald-600 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Header Khusus Mode Cetak PDF -->
            <div class="print-only-header text-center mb-6">
                <h1 class="text-xl font-bold uppercase">{{ \App\Models\Setting::get('app_name', 'SMART INVENTORY SYSTEM') }}</h1>
                <h2 class="text-md font-semibold text-gray-700">Laporan Penjualan</h2>
                <p class="text-xs text-gray-500">Dicetak Pada: {{ date('d/m/Y H:i') }}</p>
                <hr class="my-3 border-gray-400">
            </div>

            <!-- Panel Filter Sejajar & Tombol Ekspor -->
            <form action="{{ route('reports.index') }}" method="GET" class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4 no-print border border-gray-200">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-3 items-end">
                    <div>
                        <label for="start_date" class="block text-xs font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-xs">
                    </div>
                    <div>
                        <label for="end_date" class="block text-xs font-medium text-gray-700 mb-1">Tanggal Akhir</label>
                        <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-xs">
                    </div>
                    <div>
                        <label for="invoice" class="block text-xs font-medium text-gray-700 mb-1">No. Invoice</label>
                        <input type="text" name="invoice" id="invoice" value="{{ request('invoice') }}" placeholder="Cari invoice..." class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-xs">
                    </div>
                    <div>
                        <label for="kasir" class="block text-xs font-medium text-gray-700 mb-1">Nama Kasir</label>
                        <input type="text" name="kasir" id="kasir" value="{{ request('kasir') }}" placeholder="Cari kasir..." class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-xs">
                    </div>
                    
                    <!-- Tombol Tampilkan Filter Sejajar di Kolom ke-5 -->
                    <div class="flex items-center gap-2">
                        <button type="submit" class="w-full bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-3 rounded text-xs transition-all flex items-center justify-center gap-1.5 shadow-sm h-[34px]">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Tampilkan Filter
                        </button>
                        @if(request()->hasAny(['start_date', 'end_date', 'invoice', 'kasir']))
                            <a href="{{ route('reports.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-3 rounded text-xs transition-all h-[34px] flex items-center justify-center">
                                Reset
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Action Bar Ekspor CSV & Save PDF -->
                <div class="flex items-center justify-end gap-2 pt-3 border-t border-gray-100">
                    <a href="{{ route('reports.export', request()->query()) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded text-xs transition-all flex items-center gap-1.5 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Export CSV
                    </a>
                    <button type="button" onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-xs transition-all flex items-center gap-1.5 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Save PDF
                    </button>
                </div>
            </form>

            <!-- Tabel Laporan Transaksi -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-0 overflow-x-auto text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200 text-xs">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-5 py-3 text-left font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-5 py-3 text-left font-semibold text-gray-500 uppercase tracking-wider">No. Invoice</th>
                                <th class="px-5 py-3 text-left font-semibold text-gray-500 uppercase tracking-wider">Total Item</th>
                                <th class="px-5 py-3 text-left font-semibold text-gray-500 uppercase tracking-wider">Total Harga</th>
                                <th class="px-5 py-3 text-left font-semibold text-gray-500 uppercase tracking-wider">Dibayar</th>
                                <th class="px-5 py-3 text-left font-semibold text-gray-500 uppercase tracking-wider">Kembalian</th>
                                <th class="px-5 py-3 text-left font-semibold text-gray-500 uppercase tracking-wider">Kasir</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($transactions as $transaction)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-5 py-3.5 whitespace-nowrap text-gray-500">
                                        {{ $transaction->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap font-bold text-blue-600">
                                        <a href="{{ route('reports.show', $transaction->id) }}" class="hover:underline">
                                            {{ $transaction->invoice_number }}
                                        </a>
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap text-gray-900">
                                        {{ $transaction->details->sum('quantity') }} Item
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap font-bold text-gray-900">
                                        Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap text-gray-700">
                                        Rp {{ number_format($transaction->pay_amount ?? $transaction->paid_amount ?? $transaction->total_amount, 0, ',', '.') }}
                                    </td>
                                    <!-- Kolom Kembalian Warna Merah (text-rose-600) -->
                                    <td class="px-5 py-3.5 whitespace-nowrap font-bold text-rose-600">
                                        Rp {{ number_format($transaction->change_amount ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap text-gray-900">
                                        {{ $transaction->user->name ?? 'Kasir Dihapus' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                        Belum ada data transaksi yang sesuai filter.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="bg-gray-100 font-bold text-gray-900 border-t-2 border-gray-300">
                            <tr>
                                <td colspan="3" class="px-5 py-3 text-right uppercase">Total Rangkuman:</td>
                                <td class="px-5 py-3 text-emerald-700">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                @if($transactions->hasPages())
                    <div class="p-4 border-t border-gray-200 bg-gray-50 no-print">
                        {{ $transactions->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>