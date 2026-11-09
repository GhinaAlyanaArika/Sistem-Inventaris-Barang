<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Aplikasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Notifikasi Sukses -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative shadow-xs">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative shadow-xs">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Form Pengaturan Informasi Toko -->
                <div class="md:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-bold text-gray-800 text-base mb-6 border-b pb-2">Informasi Toko & Operasional</h3>

                        <form action="{{ route('settings.update') }}" method="POST">
                            @csrf

                            <div class="mb-6">
                                <label for="app_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Toko / Aplikasi</label>
                                <input type="text" id="app_name" name="app_name" value="{{ old('app_name', $appName ?? '') }}" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                @error('app_name')
                                    <span class="text-xs text-red-600 mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat Toko</label>
                                <textarea id="address" name="address" rows="3" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('address', $address ?? '') }}</textarea>
                                @error('address')
                                    <span class="text-xs text-red-600 mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone', $phone ?? '') }}" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @error('phone')
                                    <span class="text-xs text-red-600 mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="operating_hours" class="block text-sm font-medium text-gray-700 mb-2">Jam Operasional</label>
                                <input type="text" id="operating_hours" name="operating_hours" value="{{ old('operating_hours', $operatingHours ?? '') }}" placeholder="Contoh: 08:00 - 22:00 WIB" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @error('operating_hours')
                                    <span class="text-xs text-red-600 mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex items-center gap-4 mt-8">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-lg text-sm transition-all shadow-xs">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Panel Backup Database SQL -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col justify-between border border-gray-100">
                    <div>
                        <h3 class="font-bold text-gray-800 text-base mb-2">Backup Database</h3>
                        <p class="text-xs text-gray-500 mb-6 leading-relaxed">
                            Amankan seluruh data transaksi, stok barang, user, dan riwayat mutasi aplikasi POS dengan mengunduh salinan berkas SQL secara berkala.
                        </p>
                    </div>

                    <div class="border-t border-gray-100 pt-6">
                        <a href="{{ route('backup.download') }}" class="w-full inline-flex justify-center items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white font-bold py-3 px-4 rounded-lg text-xs transition-all shadow-xs">
                            📥 Unduh Backup Database (.sql)
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>