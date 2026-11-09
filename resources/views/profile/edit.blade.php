<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">Pengaturan Profil</h2>
    </x-slot>

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <!-- Informasi Profil -->
                <div class="card bg-white shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-body p-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Ubah Kata Sandi -->
                <div class="card bg-white shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-body p-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Hapus Akun -->
                <div class="card bg-white shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>