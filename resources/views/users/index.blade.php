<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">Manajemen User & Tim</h2>
    </x-slot>

    <div class="py-4">
        <div class="container-fluid max-w-7xl mx-auto">

            <!-- FORM PENCARIAN & FILTER USER -->
            <div class="card bg-white shadow-sm border-0 rounded-4 mb-4">
                <div class="card-body p-3">
                    <form method="GET" action="{{ route('users.index') }}" class="row g-2 align-items-center">
                        <div class="col-md-7">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted fw-bold">Cari</span>
                                <input type="text" name="search" class="form-control border-start-0 shadow-none fw-bold text-dark" placeholder="Nama atau Email..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="role" class="form-select shadow-none fw-bold text-dark">
                                <option value="">Semua Peran (Role)</option>
                                <option value="Super Admin" {{ request('role') == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                                <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Kasir" {{ request('role') == 'Kasir' ? 'selected' : '' }}>Kasir</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-dark w-100 fw-bold rounded-3">
                                Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TABEL DATA USER -->
            <div class="card bg-white shadow-sm border-0 rounded-4 overflow-hidden">
                
                <!-- CARD HEADER EDGE-TO-EDGE -->
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-0" style="border-bottom: 2px solid #adb5bd !important;">
                    <h5 class="m-0 fw-bold text-dark">Daftar Pengguna</h5>
                    <a href="{{ route('users.create') }}" class="btn btn-dark fw-bold rounded-pill px-4">
                        + Tambah User Baru
                    </a>
                </div>

                <div class="card-body p-0">
                    
                    @if (session('success'))
                        <div class="p-3 mb-0">
                            <div class="alert alert-success alert-dismissible fade show rounded-3 fw-bold mb-0" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="p-3 mb-0">
                            <div class="alert alert-danger alert-dismissible fade show rounded-3 fw-bold mb-0" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 w-100">
                            <thead class="bg-light text-dark fw-bold small text-uppercase" style="border-bottom: 2px solid #adb5bd;">
                                <tr>
                                    <th class="px-4 py-3 border-0 text-dark">Nama</th>
                                    <th class="px-4 py-3 border-0 text-dark">Email</th>
                                    <th class="px-4 py-3 border-0 text-center text-dark">Role / Hak Akses</th>
                                    <th class="px-4 py-3 border-0 text-center text-dark">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                @forelse($users as $user)
                                    <tr>
                                        <td class="px-4 py-3 fw-bold text-dark">{{ $user->name }}</td>
                                        <td class="px-4 py-3 text-dark">{{ $user->email }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="badge bg-secondary text-white rounded-pill px-3 py-2 fw-bold">
                                                {{ $user->roles->pluck('name')->first() ?? 'User' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            @if(auth()->id() !== $user->id)
                                                <div class="d-flex justify-content-center gap-1">
                                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning text-dark fw-bold rounded-pill px-3">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin hapus user ini?');" class="d-inline mb-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger fw-bold rounded-pill px-3">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="badge bg-light text-muted border rounded-pill px-3 py-2 fw-normal">Akun Anda</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-dark fw-bold fst-italic">Belum ada data user yang sesuai pencarian.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if(method_exists($users, 'hasPages') && $users->hasPages())
                    <div class="card-footer bg-white py-3 border-0">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>