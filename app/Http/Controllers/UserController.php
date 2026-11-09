<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Parameter sorting
        $sortColumn = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        // Whitelist kolom sorting untuk keamanan
        $allowedSorts = ['name', 'email', 'created_at'];
        if (!in_array($sortColumn, $allowedSorts)) {
            $sortColumn = 'created_at';
        }
        if (!in_array(strtolower($sortDirection), ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }

        $query = User::with('roles');

        // Fitur Pencarian Nama atau Email
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Fitur Filter berdasarkan Role / Hak Akses
        if ($request->filled('role')) {
            $query->whereHas('roles', function($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        $users = $query->orderBy($sortColumn, $sortDirection)
                       ->paginate(10)
                       ->withQueryString();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('users.index')->with('success', 'User baru berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|exists:roles,name',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $user->syncRoles([$request->role]);

        return redirect()->route('users.index')->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        // FIX: Cegah penghapusan user jika sudah terikat riwayat transaksi kasir
        if (DB::table('transactions')->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Gagal: User tidak dapat dihapus karena memiliki riwayat transaksi/penjualan.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
}