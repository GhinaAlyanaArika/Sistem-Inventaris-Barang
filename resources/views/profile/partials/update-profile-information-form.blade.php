<section>
    <div class="border-bottom pb-3 mb-4" style="border-color: #adb5bd !important;">
        <h5 class="fw-bold text-dark mb-1">Informasi Profil</h5>
        <p class="small text-muted mb-0">Perbarui informasi identitas dan alamat email yang tertaut pada akun Anda.</p>
    </div>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label small fw-bold text-dark">Nama Lengkap</label>
            <input id="name" name="name" type="text" class="form-control rounded-3 fw-bold text-dark" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @if($errors->has('name'))
                <div class="text-danger small mt-1 fw-bold">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <div class="mb-4">
            <label for="email" class="form-label small fw-bold text-dark">Alamat Email</label>
            <input id="email" name="email" type="email" class="form-control rounded-3 fw-bold text-dark" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @if($errors->has('email'))
                <div class="text-danger small mt-1 fw-bold">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-dark fw-bold rounded-pill px-4">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <span class="badge bg-success rounded-pill px-3 py-2 fw-bold">Tersimpan!</span>
            @endif
        </div>
    </form>
</section>