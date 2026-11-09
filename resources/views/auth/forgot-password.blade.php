<x-guest-layout>
    <!-- Header Form -->
    <div class="mb-4 text-center">
        <h3 class="fw-bold text-dark mb-1">Lupa Kata Sandi?</h3>
    </div>
    
    <div class="mb-4 small text-muted text-center" style="line-height: 1.6;">
        Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan tautan pengaturan ulang kata sandi melalui email yang memungkinkan Anda memilih kata sandi yang baru.
    </div>

    <!-- Session Status -->
    @if(session('status'))
        <div class="alert alert-success fw-bold rounded-3 small py-2 mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label fw-bold text-dark small">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email Anda" class="form-control rounded-3 py-2 border-secondary-subtle shadow-none @error('email') is-invalid @enderror">
            @error('email')
                <div class="invalid-feedback fw-bold">{{ $message }}</div>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <a class="text-decoration-none small fw-bold text-dark" href="{{ route('login') }}">
                &larr; Kembali
            </a>

            <button type="submit" class="btn btn-dark fw-bold rounded-pill px-4 py-2" style="letter-spacing: 0.5px;">
                Kirim Tautan Reset
            </button>
        </div>
    </form>
</x-guest-layout>