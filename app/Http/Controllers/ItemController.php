<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Ditambahkan untuk cek relasi

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with('category');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('sku', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('sort')) {
            if ($request->sort == 'terlama') {
                $query->oldest();
            } elseif ($request->sort == 'stok_terbanyak') {
                $query->orderBy('stock', 'desc');
            } elseif ($request->sort == 'stok_sedikit') {
                $query->orderBy('stock', 'asc');
            } else {
                $query->latest(); 
            }
        } else {
            $query->latest(); 
        }

        $items = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('items.index', compact('items', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // FIX: Tambahkan validasi SKU unik
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sku'         => 'nullable|string|unique:items,sku',
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
        ]);

        $data = $request->all();
        if (empty($data['sku'])) {
            $data['sku'] = 'SKU-' . strtoupper(uniqid());
        }

        $item = Item::create($data);

        if (class_exists('App\Models\ActivityLog') && method_exists('App\Models\ActivityLog', 'log')) {
            ActivityLog::log('Buat', 'Daftar Barang', "Menambahkan barang baru: {$item->name} dengan stok awal {$item->stock}", $item->sku);
        }

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function show($id)
    {
        $item = Item::with(['category', 'mutations' => function($query) {
            $query->latest();
        }])->findOrFail($id);
        
        return view('items.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        // FIX: Validasi SKU unik (kecuali milik diri sendiri)
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sku'         => 'nullable|string|unique:items,sku,' . $id,
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
        ]);

        $item->update($request->all());

        if (class_exists('App\Models\ActivityLog') && method_exists('App\Models\ActivityLog', 'log')) {
            ActivityLog::log('Ubah', 'Daftar Barang', "Mengubah detail data barang: {$item->name}", $item->sku);
        }

        return redirect()->route('items.index')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        
        // FIX: Cek keterikatan data agar riwayat penjualan/mutasi tidak hilang secara cascade
        if ($item->mutations()->exists() || DB::table('transaction_details')->where('item_id', $id)->exists()) {
            return redirect()->route('items.index')->with('error', 'Gagal: Barang tidak bisa dihapus karena memiliki riwayat penjualan atau mutasi stok.');
        }

        $itemName = $item->name;
        $itemSku = $item->sku;

        $item->delete();

        if (class_exists('App\Models\ActivityLog') && method_exists('App\Models\ActivityLog', 'log')) {
            ActivityLog::log('Hapus', 'Daftar Barang', "Menghapus barang dari sistem: {$itemName}", $itemSku);
        }

        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus!');
    }
}