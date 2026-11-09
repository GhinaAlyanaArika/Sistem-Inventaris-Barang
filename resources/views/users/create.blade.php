<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">Tambah User Baru</h2>
    </x-slot>

    <div class="py-4">
        <div class="container-fluid max-w-7xl mx-auto">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card bg-white shadow-sm border-0 rounded-4 overflow-hidden">
                        
                        <!-- CARD HEADER EDGE-TO-EDGE (WARNA TEKS HITAM) -->
                        <div class="card-header bg-white py-3 border-0" style="border-bottom: 2px solid #adb5bd !important;">
                            <h5 class="m-0 fw-bold text-dark">Form Tambah User</h5>
                        </div>

                        <div class="card-body p-4">
                            
                            <!-- ALERT VALIDASI ERROR FORM -->
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show rounded-3 fw-bold mb-4" role="alert">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('users.store') }}" method="POST">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold text-dark">Nama Lengkap</label>
                                    <input type="text" class="form-control rounded-3 fw-bold text-dark" id="name" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold text-dark">Email</label>
                                    <input type="email" class="form-control rounded-3 fw-bold text-dark" id="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold text-dark">Password</label>
                                    <input type="password" class="form-control rounded-3 fw-bold text-dark" id="password" name="password" placeholder="Masukkan password" required>
                                </div>

                                <div class="mb-4">
                                    <label for="role" class="form-label fw-bold text-dark">Role / Hak Akses</label>
                                    <select class="form-select rounded-3 fw-bold text-dark" id="role" name="role" required>
                                        <option value="">-- Pilih Role --</option>
                                        @if(isset($roles))
                                            @foreach($roles as $role)
                                                <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="Super Admin" {{ old('role') == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                                            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="Kasir" {{ old('role') == 'Kasir' ? 'selected' : '' }}>Kasir</option>
                                        @endif
                                    </select>
                                </div>

                                <!-- ACTION BUTTONS (TOMBOL HITAM SOLID & BORDER SEPARATING LINE) -->
                                <div class="d-flex justify-content-between align-items-center pt-3" style="border-top: 2px solid #adb5bd !important;">
                                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">
                                        Batal
                                    </a>
                                    <button type="submit" class="btn btn-dark rounded-pill px-4 fw-bold">
                                        Simpan User
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>