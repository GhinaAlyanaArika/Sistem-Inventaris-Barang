<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">Edit Data User</h2>
    </x-slot>

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card bg-white shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        
                        <!-- Subtitle Form -->
                        <h6 class="fw-bold text-warning mb-3">Form Edit User</h6>
                        <hr class="mb-4" style="color: #adb5bd;">

                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-dark">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control rounded-3" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-dark">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control rounded-3" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-dark">
                                    Password Baru 
                                    <span class="text-muted fw-normal">(Kosongkan jika tidak ingin mengubah)</span>
                                </label>
                                <input type="password" name="password" class="form-control rounded-3" minlength="8">
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-dark">Role / Hak Akses</label>
                                <select name="role" class="form-select rounded-3" required>
                                    <option value="">-- Pilih Role --</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tombol Aksi Kiri (Kembali) & Kanan (Update) -->
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top" style="border-color: #adb5bd !important;">
                                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-warning text-dark rounded-pill px-4 fw-bold">
                                    Update User
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>