<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // Tangkap parameter sort dan direction dari URL
        $sortColumn = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        // Batasi kolom yang boleh di-sort agar aman dari SQL Injection
        $allowedSorts = ['name', 'created_at'];
        if (!in_array($sortColumn, $allowedSorts)) {
            $sortColumn = 'created_at';
        }
        if (!in_array(strtolower($sortDirection), ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }

        $query = Category::query();
        
        // Logika pencarian
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Terapkan sorting dan paginasi (lengkap dengan parameter query di URL)
        $categories = $query->orderBy($sortColumn, $sortDirection)
                            ->paginate(10)
                            ->withQueryString();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ]);
        
        $category = Category::create($request->all());

        ActivityLog::log('Buat', 'Kategori Barang', "Menambahkan kategori baru: {$category->name}", "CAT-{$category->id}");

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string'
        ]);

        $oldName = $category->name;
        $category->update($request->all());

        ActivityLog::log('Edit', 'Kategori Barang', "Mengubah kategori: {$oldName} menjadi {$category->name}", "CAT-{$category->id}");

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        if ($category->items()->count() > 0) {
            return redirect()->route('categories.index')->with('error', 'Gagal: Kategori tidak dapat dihapus karena masih menampung barang.');
        }

        $name = $category->name;
        $id = $category->id;
        $category->delete();

        ActivityLog::log('Hapus', 'Kategori Barang', "Menghapus kategori: {$name}", "CAT-{$id}");

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}