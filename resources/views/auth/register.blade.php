<x-guest-layout>
    <!-- Header Form -->
    <div class="mb-4 text-center">
        <h3 class="fw-bold text-dark mb-1">Daftar Akun Baru</h3>
        <p class="small text-muted">Smart Inventory & Stock Mutation System</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label fw-bold text-dark small">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap" class="form-control rounded-3 py-2 border-secondary-subtle shadow-none @error('name') is-invalid @enderror">
            @error('name')
                <div class="invalid-feedback fw-bold">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label fw-bold text-dark small">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Masukkan email Anda" class="form-control rounded-3 py-2 border-secondary-subtle shadow-none @error('email') is-invalid @enderror">
            @error('email')
                <div class="invalid-feedback fw-bold">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label fw-bold text-dark small">Kata Sandi</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Buat kata sandi" class="form-control rounded-3 py-2 border-secondary-subtle shadow-none @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback fw-bold">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label fw-bold text-dark small">Konfirmasi Kata Sandi</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi" class="form-control rounded-3 py-2 border-secondary-subtle shadow-none @error('password_confirmation') is-invalid @enderror">
            @error('password_confirmation')
                <div class="invalid-feedback fw-bold">{{ $message }}</div>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <a class="text-decoration-none small fw-bold text-dark" href="{{ route('login') }}">
                Sudah punya akun?
            </a>

            <button type="submit" class="btn btn-dark fw-bold rounded-pill px-4 py-2" style="letter-spacing: 0.5px;">
                DAFTAR
            </button>
        </div>
    </form>
</x-guest-layout>