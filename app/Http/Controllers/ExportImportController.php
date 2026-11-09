<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ExportImportController extends Controller
{
    // Export Data Barang ke CSV (5 Kolom Standard: SKU, Nama Barang, Kategori, Harga, Stok)
    public function exportItems()
    {
        $fileName = 'data_barang_' . date('Y-m-d_H-i-s') . '.csv';
        $items = Item::with('category')->get();

        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function () use ($items) {
            $file = fopen('php://output', 'w');
            fputs($file, "\xEF\xBB\xBF"); // UTF-8 BOM
            
            // Header 5 kolom
            fputcsv($file, ['SKU', 'Nama Barang', 'Kategori', 'Harga', 'Stok']);

            foreach ($items as $item) {
                fputcsv($file, [
                    $item->sku,
                    $item->name,
                    $item->category ? $item->category->name : '-',
                    $item->price ?? 0,
                    $item->stock ?? 0,
                ]);
            }
            fclose($file);
        };

        if (method_exists(ActivityLog::class, 'log')) {
            ActivityLog::log('Buat', 'Daftar Barang', 'Mengekspor data barang ke file CSV', 'EXP-ITEM');
        }

        return response()->stream($callback, 200, $headers);
    }

    // Import Data Barang dari CSV (Pencocokan Header Otomatis)
    public function importItems(Request $request)
    {
        $fileKey = $request->hasFile('csv_file') ? 'csv_file' : 'file';

        $request->validate([
            $fileKey => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $uploadedFile = $request->file($fileKey);
        $handle = fopen($uploadedFile->getRealPath(), 'r');

        // Lewati BOM UTF-8 jika ada
        $bom = fread($handle, 3);
        if ($bom !== "\xEF\xBB\xBF") {
            rewind($handle);
        }

        // Deteksi Delimiter (, atau ;)
        $header = fgetcsv($handle, 1000, ',');
        $delimiter = ',';
        if (count($header) === 1 && str_contains($header[0], ';')) {
            rewind($handle);
            if (fread($handle, 3) !== "\xEF\xBB\xBF") {
                rewind($handle);
            }
            $header = fgetcsv($handle, 1000, ';');
            $delimiter = ';';
        }

        // Mapping Kolom Berdasarkan Judul Header CSV
        $headerLower = array_map(function($h) {
            return strtolower(trim($h));
        }, $header);

        $skuIdx   = array_search('sku', $headerLower);
        $nameIdx  = array_search('nama barang', $headerLower);
        if ($nameIdx === false) $nameIdx = array_search('nama', $headerLower);
        if ($nameIdx === false) $nameIdx = array_search('name', $headerLower);

        $catIdx   = array_search('kategori', $headerLower);
        if ($catIdx === false) $catIdx = array_search('category', $headerLower);

        $priceIdx = array_search('harga', $headerLower);
        if ($priceIdx === false) $priceIdx = array_search('price', $headerLower);

        $stockIdx = array_search('stok', $headerLower);
        if ($stockIdx === false) $stockIdx = array_search('stock', $headerLower);

        // Index default jika header tidak sesuai
        if ($skuIdx === false) $skuIdx = 0;
        if ($nameIdx === false) $nameIdx = 1;
        if ($catIdx === false) $catIdx = 2;

        $imported = 0;
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
            if (empty($row) || count($row) < 2) {
                continue;
            }

            $sku     = isset($row[$skuIdx]) ? trim($row[$skuIdx]) : '';
            $name    = isset($row[$nameIdx]) ? trim($row[$nameIdx]) : '';
            $catName = isset($row[$catIdx]) ? trim($row[$catIdx]) : 'Umum';

            if (empty($name)) {
                continue;
            }

            $category = Category::firstOrCreate(['name' => $catName]);

            // Cari Barang berdasarkan SKU atau Nama
            $item = null;
            if (!empty($sku)) {
                $item = Item::where('sku', $sku)->first();
            }
            if (!$item) {
                $item = Item::where('name', $name)->first();
            }

            // Cek ketersediaan nilai Harga & Stok pada CSV
            $hasPrice = ($priceIdx !== false && isset($row[$priceIdx]) && trim($row[$priceIdx]) !== '');
            $priceVal = $hasPrice ? (float) trim($row[$priceIdx]) : null;

            $hasStock = ($stockIdx !== false && isset($row[$stockIdx]) && trim($row[$stockIdx]) !== '');
            $stockVal = $hasStock ? (int) trim($row[$stockIdx]) : null;

            if ($item) {
                // JIKA BARANG SUDAH ADA
                $item->category_id = $category->id;
                $item->name = $name;
                if (!empty($sku)) {
                    $item->sku = $sku;
                }

                // Ubah HARGA jika kolom Harga ada di CSV
                if ($hasPrice) {
                    $item->price = $priceVal;
                }

                // Akumulasi STOK jika kolom Stok ada di CSV
                if ($hasStock) {
                    $item->stock = (int) $item->stock + $stockVal;
                }

                $item->save();
            } else {
                // JIKA BARANG BELUM ADA
                Item::create([
                    'sku'         => $sku ?: 'SKU-' . strtoupper(uniqid()),
                    'category_id' => $category->id,
                    'name'        => $name,
                    'price'       => $priceVal ?? 0,
                    'stock'       => $stockVal ?? 0,
                ]);
            }

            $imported++;
        }
        fclose($handle);

        if (method_exists(ActivityLog::class, 'log')) {
            ActivityLog::log('Buat', 'Daftar Barang', "Mengimpor {$imported} barang dari CSV", 'IMP-ITEM');
        }

        return back()->with('success', "Berhasil memproses {$imported} data barang");
    }
}