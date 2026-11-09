<section>
    <div class="border-bottom pb-3 mb-4" style="border-color: #f8d7da !important;">
        <h5 class="fw-bold text-danger mb-1">Hapus Akun</h5>
        <p class="small text-muted mb-0">Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.</p>
    </div>

    <!-- Tombol Modal Hapus -->
    <button type="button" class="btn btn-outline-danger fw-bold rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        Hapus Akun Saya
    </button>

    <!-- Modal Konfirmasi Bootstrap -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold text-dark" id="confirmUserDeletionModalLabel">Konfirmasi Hapus Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body py-3">
                        <p class="small text-muted mb-3">Apakah Anda yakin ingin menghapus akun? Silakan masukkan kata sandi Anda untuk mengonfirmasi.</p>
                        
                        <div class="mb-2">
                            <input type="password" name="password" class="form-control rounded-3 fw-bold text-dark" placeholder="Masukkan Kata Sandi Anda" required>
                            @if($errors->userDeletion->has('password'))
                                <div class="text-danger small mt-1 fw-bold">{{ $errors->userDeletion->first('password') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer border-0 pt-0 gap-2">
                        <button type="button" class="btn btn-secondary fw-bold rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger fw-bold rounded-pill px-4">Hapus Akun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>