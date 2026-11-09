<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">Edit Kategori</h2>
    </x-slot>

    <!-- Ditambahkan justify-content-center agar form posisinya di tengah -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white py-3 border-0" style="border-bottom: 2px solid #adb5bd !important;">
                    <h6 class="m-0 fw-bold text-warning">Form Edit Kategori</h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold text-dark">Nama Kategori</label>
                            <input type="text" class="form-control rounded-3" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold text-dark">Deskripsi (Opsional)</label>
                            <textarea class="form-control rounded-3" id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">Kembali</a>
                            <button type="submit" class="btn btn-warning rounded-pill px-4 fw-bold text-dark">Update Kategori</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>