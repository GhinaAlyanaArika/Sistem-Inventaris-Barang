<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\Mutation;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total Jenis Barang
        $totalItems = Item::count();

        // 2. Stok Menipis (stok <= 5)
        $lowStockItems = Item::with('category')->where('stock', '<=', 5)->get();
        $totalLowStock = $lowStockItems->count();

        // 3. Total Transaksi
        $totalTransactions = Transaction::count();

        // 4. Total User / Pengguna Sistem
        $totalUsers = User::count();

        // 5. Transaksi Terbaru (5 data terakhir)
        $recentTransactions = Transaction::with('user')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalItems',
            'totalLowStock',
            'lowStockItems',
            'totalTransactions',
            'totalUsers',
            'recentTransactions'
        ));
    }
}