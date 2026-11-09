<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MutationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ExportImportController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Kasir & Transaksi
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions/add-to-cart/{id}', [TransactionController::class, 'addToCart'])->name('transactions.add_to_cart');
    Route::post('/transactions/remove-from-cart/{id}', [TransactionController::class, 'removeFromCart'])->name('transactions.remove_from_cart');
    Route::post('/transactions/checkout', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');

    // Lihat Daftar Barang & Detail Barang
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    // FIX: Tambahkan whereNumber agar tidak bentrok dengan /items/create atau /items/export
    Route::get('/items/{id}', [ItemController::class, 'show'])->name('items.show')->whereNumber('id');

    // Route Khusus Super Admin & Admin
    Route::middleware(['role:Super Admin|Admin'])->group(function () {
        // FIX: Batasi resource yang tidak memiliki method show
        Route::resource('categories', CategoryController::class)->except(['show']);
        
        // Export & Import Barang CSV
        Route::get('/items/export', [ExportImportController::class, 'exportItems'])->name('items.export');
        Route::post('/items/import', [ExportImportController::class, 'importItems'])->name('items.import');
        
        // Aksi CRUD Barang
        Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
        Route::post('/items', [ItemController::class, 'store'])->name('items.store');
        Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
        Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
        Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

        // FIX: Batasi route resource mutation agar tidak panggil edit/show/destroy yang belum ada
        Route::resource('mutations', MutationController::class)->only(['index', 'create', 'store']);

        // Route Laporan Transaksi
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/print', [ReportController::class, 'print'])->name('reports.print');
        Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
        Route::get('/reports/{id}', [ReportController::class, 'show'])->name('reports.show');
    });

    // Route Khusus Super Admin
    Route::middleware(['role:Super Admin'])->group(function () {
        Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
        Route::get('/activity-logs/print', [ActivityLogController::class, 'print'])->name('activity-logs.print');
        Route::get('/activity-logs/export', [ActivityLogController::class, 'export'])->name('activity-logs.export');

        Route::get('/backup/download', [BackupController::class, 'download'])->name('backup.download');
        
        // FIX: Batasi user resource
        Route::resource('users', UserController::class)->except(['show']);
        
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    });
});

require __DIR__.'/auth.php';