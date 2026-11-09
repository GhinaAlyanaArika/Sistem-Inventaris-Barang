<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">Log Aktivitas Sistem</h2>
    </x-slot>

    <!-- 4 SUMMARY CARDS (BERSIH TANPA IKON SVG) -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card bg-white shadow-sm border-0 h-100 rounded-4">
                <div class="card-body p-4">
                    <div class="small fw-bold text-uppercase text-muted">Total Aktivitas</div>
                    <h3 class="fw-black text-dark mb-0 mt-2">{{ number_format($totalLogs ?? 0) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-white shadow-sm border-0 h-100 rounded-4">
                <div class="card-body p-4">
                    <div class="small fw-bold text-uppercase text-muted">Data Dibuat</div>
                    <h3 class="fw-black text-success mb-0 mt-2">{{ number_format($totalCreate ?? 0) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-white shadow-sm border-0 h-100 rounded-4">
                <div class="card-body p-4">
                    <div class="small fw-bold text-uppercase text-muted">Data Diperbarui</div>
                    <h3 class="fw-black text-primary mb-0 mt-2">{{ number_format($totalUpdate ?? 0) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-white shadow-sm border-0 h-100 rounded-4">
                <div class="card-body p-4">
                    <div class="small fw-bold text-uppercase text-muted">Data Dihapus</div>
                    <h3 class="fw-black text-danger mb-0 mt-2">{{ number_format($totalDelete ?? 0) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- FILTER & EXPORT SECTION -->
    <div class="card bg-white shadow-sm border-0 mb-4 rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('activity-logs.index') }}" method="GET" class="border-bottom pb-4 mb-4" style="border-color: #adb5bd !important; border-width: 2px !important;">
                <div class="row g-3 align-items-end">
                    <div class="col-md-2">
                        <label class="form-label small fw-bold text-dark mb-1">Tanggal Mulai</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control rounded-3 fw-bold text-dark">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold text-dark mb-1">Tanggal Akhir</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control rounded-3 fw-bold text-dark">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold text-dark mb-1">Tipe Aksi</label>
                        <select name="action_type" class="form-select rounded-3 fw-bold text-dark">
                            <option value="">Semua Aksi</option>
                            <option value="buat" {{ request('action_type') == 'buat' ? 'selected' : '' }}>Buat / Tambah</option>
                            <option value="update" {{ request('action_type') == 'update' ? 'selected' : '' }}>Ubah / Edit</option>
                            <option value="hapus" {{ request('action_type') == 'hapus' ? 'selected' : '' }}>Hapus</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold text-dark mb-1">Pengguna</label>
                        <select name="user_id" class="form-select rounded-3 fw-bold text-dark">
                            <option value="">Semua User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold text-dark mb-1">Kata Kunci Search</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari deskripsi..." class="form-control rounded-3 fw-bold text-dark">
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-dark fw-bold rounded-3 flex-fill">
                                Filter
                            </button>
                            @if(request()->hasAny(['start_date', 'end_date', 'action_type', 'user_id', 'search']))
                                <a href="{{ route('activity-logs.index') }}" class="btn btn-outline-secondary fw-bold rounded-3 flex-fill text-center d-flex align-items-center justify-content-center">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>

            <!-- EXPORT BUTTONS -->
            <div class="d-flex justify-content-end gap-2">
                <form action="{{ route('activity-logs.export') }}" method="GET" class="m-0">
                    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                    <input type="hidden" name="action_type" value="{{ request('action_type') }}">
                    <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-success fw-bold rounded-pill px-4">
                        Export CSV
                    </button>
                </form>

                <form action="{{ route('activity-logs.print') }}" method="GET" target="_blank" class="m-0">
                    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                    <input type="hidden" name="action_type" value="{{ request('action_type') }}">
                    <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary fw-bold rounded-pill px-4">
                        Save PDF
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- TABEL LOG AKTIVITAS -->
    <div class="card bg-white shadow-sm border-0 rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 w-100">
                    <thead class="bg-light text-dark small text-uppercase" style="border-bottom: 2px solid #adb5bd;">
                        <tr>
                            <th class="px-4 py-3 border-0 fw-bold">Waktu</th>
                            <th class="px-4 py-3 border-0 fw-bold">Pengguna</th>
                            <th class="px-4 py-3 border-0 fw-bold">Modul</th>
                            <th class="px-4 py-3 border-0 fw-bold">Aksi</th>
                            <th class="px-4 py-3 border-0 fw-bold">Deskripsi Aktivitas</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($logs as $log)
                            @php
                                $actionText = $log->action ?? '-';
                                $actionLower = strtolower($actionText);
                                $badgeClass = 'bg-secondary';

                                if (str_contains($actionLower, 'buat') || str_contains($actionLower, 'tambah')) {
                                    $badgeClass = 'bg-success';
                                } elseif (str_contains($actionLower, 'update') || str_contains($actionLower, 'edit') || str_contains($actionLower, 'ubah')) {
                                    $badgeClass = 'bg-primary';
                                } elseif (str_contains($actionLower, 'hapus')) {
                                    $badgeClass = 'bg-danger';
                                }

                                $moduleName = $log->module ?? 'Sistem';
                                if ($moduleName === 'Sistem' && isset($log->description)) {
                                    $descLower = strtolower($log->description);
                                    if (str_contains($descLower, 'transaksi') || str_contains($descLower, 'faktur') || str_contains($descLower, 'inv-')) {
                                        $moduleName = 'Kasir & Transaksi';
                                    } elseif (str_contains($descLower, 'kategori')) {
                                        $moduleName = 'Kategori';
                                    } elseif (str_contains($descLower, 'barang') || str_contains($descLower, 'stok')) {
                                        $moduleName = 'Daftar Barang';
                                    } elseif (str_contains($descLower, 'user')) {
                                        $moduleName = 'Manajemen User';
                                    }
                                }
                            @endphp
                            <tr>
                                <td class="px-4 py-3 text-muted fw-bold" style="white-space: nowrap;">
                                    {{ isset($log->created_at) ? $log->created_at->format('d/m/Y H:i:s') : '-' }}
                                </td>
                                <td class="px-4 py-3 fw-bold text-dark">
                                    {{ $log->user->name ?? 'Sistem' }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-light text-dark border rounded-pill px-3 py-2 fw-bold">
                                        {{ $moduleName }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge {{ $badgeClass }} rounded-pill px-3 py-2 fw-bold">
                                        {{ $actionText }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-dark fw-bold">
                                    {{ $log->description ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-5 text-center text-dark fw-bold fst-italic">
                                    Belum ada log aktivitas tercatat yang sesuai filter.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($logs->hasPages())
                <div class="px-4 py-3 border-0">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>