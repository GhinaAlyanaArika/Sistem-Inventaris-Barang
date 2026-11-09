<?php

namespace App\Http\Controllers;

use App\Models\Mutation;
use App\Models\Item;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MutationController extends Controller
{
    /**
     * Menampilkan daftar riwayat mutasi stok terpaginasi (10 per halaman)
     */
    public function index(Request $request)
    {
        $query = Mutation::with(['item', 'user'])->latest();

        // Fitur Pencarian berdasarkan nama barang
        if ($request->filled('search')) {
            $query->whereHas('item', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }
        
        // Fitur Filter Jenis Mutasi (Masuk/Keluar)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Fitur Filter Tanggal
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $mutations = $query->paginate(10)->withQueryString();
        return view('mutations.index', compact('mutations'));
    }

    /**
     * Form tambah mutasi stok baru
     */
    public function create(Request $request)
    {
        $items = Item::all();
        // Tangkap parameter item_id dari URL notifikasi/peringatan stok
        $selectedItemId = $request->query('item_id');

        return view('mutations.create', compact('items', 'selectedItemId'));
    }

    /**
     * Menyimpan data mutasi stok baru & memperbarui stok barang
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_id'  => 'required|exists:items,id',
            'type'     => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'notes'    => 'nullable|string',
        ]);

        try {
            return DB::transaction(function () use ($request) {
                $item = Item::lockForUpdate()->findOrFail($request->item_id);

                // Cek ketersediaan stok jika mutasi berupa barang keluar
                if ($request->type === 'out' && $item->stock < $request->quantity) {
                    return back()->with('error', 'Stok tidak mencukupi untuk pengurangan! Sisa stok: ' . $item->stock);
                }

                // Simpan Data Mutasi Stok
                $mutation = Mutation::create([
                    'user_id'  => auth()->id(),
                    'item_id'  => $request->item_id,
                    'type'     => $request->type,
                    'quantity' => $request->quantity,
                    'notes'    => $request->notes,
                ]);

                // Update Stok Barang
                if ($request->type === 'in') {
                    $item->increment('stock', $request->quantity);
                    $actionType = 'Buat';
                    $logDesc = "Barang Masuk: Refill stok {$item->name} sejumlah +{$request->quantity}";
                } else {
                    $item->decrement('stock', $request->quantity);
                    $actionType = 'Hapus';
                    $logDesc = "Barang Keluar: Pengurangan stok {$item->name} sejumlah -{$request->quantity}";
                }

                // Catat Log Aktivitas
                if (class_exists('App\Models\ActivityLog') && method_exists('App\Models\ActivityLog', 'log')) {
                    ActivityLog::log(
                        $actionType,
                        'Mutasi Stok',
                        $logDesc,
                        'MUT-' . $mutation->id
                    );
                }

                return redirect()->route('mutations.index')->with('success', 'Mutasi stok berhasil dicatat!');
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mencatat mutasi stok: ' . $e->getMessage());
        }
    }
}