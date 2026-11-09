<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['user', 'details.item'])->latest();

        // Filter Tanggal Mulai
        if ($request->filled('start_date')) {
            $query->where('created_at', '>=', $request->start_date . ' 00:00:00');
        }

        // Filter Tanggal Akhir
        if ($request->filled('end_date')) {
            $query->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }

        // Filter No Invoice
        if ($request->filled('invoice')) {
            $query->where('invoice_number', 'like', '%' . $request->invoice . '%');
        }

        // Filter Nama Kasir
        if ($request->filled('kasir')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->kasir . '%');
            });
        }

        $totalPendapatan = (clone $query)->sum('total_amount');
        $totalTransaksi = (clone $query)->count();
        $transactions = $query->paginate(10)->withQueryString();

        return view('reports.index', compact('transactions', 'totalPendapatan', 'totalTransaksi'));
    }

    public function show($id)
    {
        $transaction = Transaction::with(['user', 'details.item'])->findOrFail($id);
        $details = $transaction->details;
        
        return view('reports.show', compact('transaction', 'details'));
    }

    // Fungsi mengambil SEMUA data terfilter tanpa pagination untuk cetak PDF
    public function print(Request $request)
    {
        $query = Transaction::with(['user', 'details.item'])->latest();

        if ($request->filled('start_date')) {
            $query->where('created_at', '>=', $request->start_date . ' 00:00:00');
        }
        if ($request->filled('end_date')) {
            $query->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }
        if ($request->filled('invoice')) {
            $query->where('invoice_number', 'like', '%' . $request->invoice . '%');
        }
        if ($request->filled('kasir')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->kasir . '%');
            });
        }

        $transactions = $query->get();
        $totalPendapatan = $transactions->sum('total_amount');
        $totalTransaksi = $transactions->count();

        return view('reports.print', compact('transactions', 'totalPendapatan', 'totalTransaksi'));
    }

    public function export(Request $request)
    {
        $query = Transaction::with(['user', 'details.item'])->latest();

        if ($request->filled('start_date')) {
            $query->where('created_at', '>=', $request->start_date . ' 00:00:00');
        }

        if ($request->filled('end_date')) {
            $query->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }

        if ($request->filled('invoice')) {
            $query->where('invoice_number', 'like', '%' . $request->invoice . '%');
        }

        if ($request->filled('kasir')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->kasir . '%');
            });
        }

        $transactions = $query->get();
        $filename = 'Laporan_Penjualan_' . date('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($transactions) {
            $file = fopen('php://output', 'w');
            fputs($file, "\xEF\xBB\xBF");

            fputcsv($file, ['No', 'Tanggal', 'No. Invoice', 'Nama Kasir', 'Total Item', 'Total Harga (Rp)', 'Dibayar (Rp)', 'Kembalian (Rp)']);

            $totalHargaAll = 0;
            $totalItemAll = 0;

            foreach ($transactions as $index => $t) {
                $totalItem = $t->details ? $t->details->sum('quantity') : 0;
                $totalHargaAll += $t->total_amount;
                $totalItemAll += $totalItem;

                fputcsv($file, [
                    $index + 1,
                    $t->created_at->format('d/m/Y H:i'),
                    $t->invoice_number,
                    $t->user->name ?? 'Kasir Dihapus',
                    $totalItem,
                    $t->total_amount,
                    $t->pay_amount ?? $t->paid_amount ?? $t->total_amount,
                    $t->change_amount ?? 0
                ]);
            }

            fputcsv($file, []);
            fputcsv($file, ['TOTAL RANGKUMAN', '', '', '', $totalItemAll, $totalHargaAll, '', '']);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}