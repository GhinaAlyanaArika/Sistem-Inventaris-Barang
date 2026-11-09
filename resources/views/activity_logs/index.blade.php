<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Log Aktivitas Sistem') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter Bar (Gaya Accurate Enterprise) -->
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 mb-6">
                <!-- Ubah grid menjadi lg:grid-cols-6 agar memiliki ruang yang cukup dan sejajar di layar besar -->
                <form action="{{ route('activity-logs.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-3 items-end">
                    
                    <!-- Pertahankan pencarian kata kunci jika ada -->
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif

                    <!-- Filter Tanggal -->
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Dari Tanggal</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full border-gray-300 rounded-lg text-xs focus:ring-slate-500 focus:border-slate-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Sampai Tanggal</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full border-gray-300 rounded-lg text-xs focus:ring-slate-500 focus:border-slate-500">
                    </div>

                    <!-- Filter Tipe Transaksi -->
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Tipe Transaksi</label>
                        <select name="transaction_type" class="w-full border-gray-300 rounded-lg text-xs focus:ring-slate-500 focus:border-slate-500">
                            <option value="">Semua Transaksi</option>
                            <option value="Faktur Penjualan" {{ request('transaction_type') == 'Faktur Penjualan' ? 'selected' : '' }}>Faktur Penjualan</option>
                            <option value="Mutasi Stok" {{ request('transaction_type') == 'Mutasi Stok' ? 'selected' : '' }}>Mutasi Stok</option>
                            <option value="Kategori Barang" {{ request('transaction_type') == 'Kategori Barang' ? 'selected' : '' }}>Kategori Barang</option>
                            <option value="Daftar Barang" {{ request('transaction_type') == 'Daftar Barang' ? 'selected' : '' }}>Daftar Barang</option>
                            <option value="User Profile" {{ request('transaction_type') == 'User Profile' ? 'selected' : '' }}>User Profile</option>
                        </select>
                    </div>

                    <!-- Filter Pengguna -->
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Pengguna</label>
                        <select name="user_id" class="w-full border-gray-300 rounded-lg text-xs focus:ring-slate-500 focus:border-slate-500">
                            <option value="">Semua User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter Tipe Tindakan -->
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Tipe Tindakan</label>
                        <select name="action_type" class="w-full border-gray-300 rounded-lg text-xs focus:ring-slate-500 focus:border-slate-500">
                            <option value="">Semua Tindakan</option>
                            <option value="Buat" {{ request('action_type') == 'Buat' ? 'selected' : '' }}>Buat</option>
                            <option value="Ubah" {{ request('action_type') == 'Ubah' ? 'selected' : '' }}>Ubah</option>
                            <option value="Hapus" {{ request('action_type') == 'Hapus' ? 'selected' : '' }}>Hapus</option>
                        </select>
                    </div>

                    <!-- Tombol Filter & Reset -->
                    <div class="flex gap-2 w-full">
                        <button type="submit" class="flex-1 bg-slate-900 text-white font-bold py-2 px-3 rounded-lg text-xs hover:bg-slate-800 transition flex items-center justify-center">
                            Filter
                        </button>
                        <a href="{{ route('activity-logs.index') }}" class="flex-1 bg-gray-200 text-gray-700 font-bold py-2 px-3 rounded-lg text-xs hover:bg-gray-300 transition flex items-center justify-center text-center">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Tabel Data Log Aktivitas -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
                    <h3 class="font-bold text-base text-gray-800">Riwayat Audit Sistem</h3>
                    
                    <!-- Form Cari Referensi Terpadu dengan Tombol Submit -->
                    <form action="{{ route('activity-logs.index') }}" method="GET" class="flex items-center gap-2 w-full sm:w-auto">
                        <!-- Pertahankan filter aktif saat melakukan pencarian kata kunci -->
                        @if(request('start_date')) <input type="hidden" name="start_date" value="{{ request('start_date') }}"> @endif
                        @if(request('end_date')) <input type="hidden" name="end_date" value="{{ request('end_date') }}"> @endif
                        @if(request('transaction_type')) <input type="hidden" name="transaction_type" value="{{ request('transaction_type') }}"> @endif
                        @if(request('user_id')) <input type="hidden" name="user_id" value="{{ request('user_id') }}"> @endif
                        @if(request('action_type')) <input type="hidden" name="action_type" value="{{ request('action_type') }}"> @endif

                        <div class="relative w-full sm:w-64">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Ref / Deskripsi..." class="w-full border-gray-300 rounded-lg text-xs pr-8 focus:ring-slate-500 focus:border-slate-500">
                            <button type="submit" title="Cari Data" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-slate-800 transition">
                                🔍
                            </button>
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-xs">
                        <thead class="bg-slate-800 text-white font-bold uppercase tracking-wider">
                            <tr>
                                <th class="px-4 py-3 text-left">Waktu</th>
                                <th class="px-4 py-3 text-left">No. Referensi</th>
                                <th class="px-4 py-3 text-center">Tipe Tindakan</th>
                                <th class="px-4 py-3 text-left">Tipe Transaksi</th>
                                <th class="px-4 py-3 text-left">Pengguna</th>
                                <th class="px-4 py-3 text-left">Alamat IP</th>
                                <th class="px-4 py-3 text-left">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($logs as $log)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-500 font-mono">
                                        {{ $log->created_at->format('d/m/Y H:i:s') }}
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap font-bold text-blue-600">
                                        {{ $log->reference_no ?? ($log->reference ?? '-') }}
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-center">
                                        @if($log->action_type == 'Buat' || $log->action == 'Buat')
                                            <span class="px-2 py-0.5 bg-emerald-100 text-emerald-800 rounded-full font-bold text-[10px]">Buat</span>
                                        @elseif($log->action_type == 'Ubah' || $log->action == 'Ubah')
                                            <span class="px-2 py-0.5 bg-amber-100 text-amber-800 rounded-full font-bold text-[10px]">Ubah</span>
                                        @elseif($log->action_type == 'Hapus' || $log->action == 'Hapus')
                                            <span class="px-2 py-0.5 bg-rose-100 text-rose-800 rounded-full font-bold text-[10px]">Hapus</span>
                                        @else
                                            <span class="px-2 py-0.5 bg-blue-100 text-blue-800 rounded-full font-bold text-[10px]">{{ $log->action_type ?? $log->action }}</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap font-semibold text-gray-700">
                                        {{ $log->transaction_type ?? $log->module }}
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="font-bold text-gray-800">{{ $log->user->name ?? 'System' }}</div>
                                        <div class="text-[10px] text-gray-400">{{ $log->user->email ?? '-' }}</div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap font-mono text-gray-500">
                                        {{ $log->ip_address ?? '127.0.0.1' }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 max-w-xs truncate" title="{{ $log->description }}">
                                        {{ $log->description }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-6 text-center text-gray-400 italic">Belum ada aktivitas tercatat yang sesuai filter.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>