<x-guest-layout>
    <!-- Header Form -->
    <div class="mb-4 text-center">
        <h3 class="fw-bold text-dark mb-1">Masuk ke Akun</h3>
        <p class="small text-muted">Smart Inventory & Stock Mutation System</p>
    </div>

    <!-- Session Status -->
    @if(session('status'))
        <div class="alert alert-success fw-bold rounded-3 small py-2 mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label fw-bold text-dark small">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Masukkan email anda" class="form-control rounded-3 py-2 border-secondary-subtle shadow-none @error('email') is-invalid @enderror">
            @error('email')
                <div class="invalid-feedback fw-bold">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label fw-bold text-dark small">Kata Sandi</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan kata sandi" class="form-control rounded-3 py-2 border-secondary-subtle shadow-none @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback fw-bold">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
            <div class="form-check">
                <input class="form-check-input shadow-none border-secondary-subtle" type="checkbox" name="remember" id="remember_me">
                <label class="form-check-label text-muted small fw-semibold" for="remember_me">
                    Ingat Saya
                </label>
            </div>
            
            @if (Route::has('password.request'))
                <a class="text-decoration-none small fw-bold text-dark" href="{{ route('password.request') }}">
                    Lupa kata sandi?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="d-grid">
            <button type="submit" class="btn btn-dark fw-bold rounded-pill py-2 text-uppercase" style="letter-spacing: 0.5px;">
                Masuk Sistem
            </button>
        </div>
    </form>
</x-guest-layout>