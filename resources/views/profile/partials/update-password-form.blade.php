<section>
    <div class="border-bottom pb-3 mb-4" style="border-color: #adb5bd !important;">
        <h5 class="fw-bold text-dark mb-1">Perbarui Kata Sandi</h5>
        <p class="small text-muted mb-0">Pastikan akun Anda menggunakan kata sandi yang aman.</p>
    </div>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label small fw-bold text-dark">Kata Sandi Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control rounded-3 fw-bold text-dark" autocomplete="current-password">
            @if($errors->updatePassword->has('current_password'))
                <div class="text-danger small mt-1 fw-bold">{{ $errors->updatePassword->first('current_password') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label small fw-bold text-dark">Kata Sandi Baru</label>
            <input id="update_password_password" name="password" type="password" class="form-control rounded-3 fw-bold text-dark" autocomplete="new-password">
            @if($errors->updatePassword->has('password'))
                <div class="text-danger small mt-1 fw-bold">{{ $errors->updatePassword->first('password') }}</div>
            @endif
        </div>

        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label small fw-bold text-dark">Konfirmasi Kata Sandi Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control rounded-3 fw-bold text-dark" autocomplete="new-password">
            @if($errors->updatePassword->has('password_confirmation'))
                <div class="text-danger small mt-1 fw-bold">{{ $errors->updatePassword->first('password_confirmation') }}</div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-dark fw-bold rounded-pill px-4">
                Ubah Kata Sandi
            </button>

            @if (session('status') === 'password-updated')
                <span class="badge bg-success rounded-pill px-3 py-2 fw-bold">Sandi Diperbarui!</span>
            @endif
        </div>
    </form>
</section>