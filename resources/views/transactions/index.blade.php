<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">Kasir & Transaksi</h2>
    </x-slot>

    <!-- CDN Alpine.js & SweetAlert2 -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="py-4" x-data="posSystem()">
        <div class="container-fluid max-w-7xl mx-auto">
            <div class="row g-4 justify-content-center align-items-stretch">
                
                <!-- KIRI: Grid Pilihan Barang -->
                <div class="col-lg-7">
                    <div class="card shadow-sm border-0 rounded-4 h-100 d-flex flex-column bg-white">
                        <div class="card-header bg-white py-3 border-0" style="border-bottom: 2px solid #adb5bd !important;">
                            <h5 class="m-0 fw-bold text-dark">Pilih Barang</h5>
                        </div>
                        <div class="card-body d-flex flex-column p-4">
                            <!-- Grid Barang -->
                            <div class="row g-3 flex-grow-1">
                                @forelse($items as $item)
                                    <div class="col-md-6">
                                        <div class="card h-100 border rounded-4 shadow-sm">
                                            <div class="card-body d-flex flex-column justify-content-between p-4">
                                                <div class="mb-3">
                                                    <h6 class="fw-bold text-dark mb-1">{{ $item->name }}</h6>
                                                    <p class="text-success fw-bolder mb-1 fs-5">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                                    <p class="small text-muted mb-0">Stok tersedia: <span class="fw-bold text-dark">{{ $item->stock }}</span></p>
                                                </div>
                                                <button @click="addToCart({{ $item->id }}, '{{ addslashes($item->name) }}', {{ $item->price }}, {{ $item->stock }})" 
                                                        class="btn btn-dark w-100 fw-bold rounded-pill py-2">
                                                    Tambah
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center text-dark fw-bold py-5">
                                        Tidak ada barang tersedia.
                                    </div>
                                @endforelse
                            </div>

                            <div class="mt-4 pt-3" style="border-top: 2px solid #adb5bd;">
                                {{ $items->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KANAN: Panel Keranjang Belanja -->
                <div class="col-lg-5">
                    <div class="card shadow-sm border-0 rounded-4 h-100 d-flex flex-column bg-white">
                        <div class="card-header bg-white py-3 border-0" style="border-bottom: 2px solid #adb5bd !important;">
                            <h5 class="m-0 fw-bold text-dark">Keranjang Belanja</h5>
                        </div>
                        <div class="card-body d-flex flex-column p-4">
                            
                            <!-- Area List Barang Keranjang -->
                            <div class="overflow-auto pe-2 mb-4 flex-grow-1 border-bottom border-2 pb-2" style="min-height: 250px; max-height: 320px; border-color: #adb5bd !important;">
                                <template x-if="cart.length === 0">
                                    <div class="h-100 d-flex align-items-center justify-content-center">
                                        <p class="text-dark fw-bold text-center mb-0">Keranjang masih kosong.</p>
                                    </div>
                                </template>

                                <div class="list-group list-group-flush">
                                    <template x-for="(item, index) in cart" :key="item.id">
                                        <div class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center bg-transparent" style="border-bottom: 1px dashed #ced4da;">
                                            <div>
                                                <h6 class="mb-1 fw-bold text-dark" x-text="item.name"></h6>
                                                <p class="mb-0 text-success fw-bold small" x-text="'Rp ' + formatRupiah(item.price) + ' x ' + item.quantity"></p>
                                            </div>
                                            <div class="d-flex align-items-center gap-3">
                                                <span class="fw-bold text-dark" x-text="'Rp ' + formatRupiah(item.price * item.quantity)"></span>
                                                <button @click="removeFromCart(index, item.id)" class="btn btn-sm text-danger p-1 d-flex align-items-center justify-content-center border-0 bg-transparent fw-bold fs-5" title="Hapus">
                                                    &times;
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Panel Rincian Pembayaran -->
                            <div class="mt-auto pt-2">
                                <div class="bg-light p-3 rounded-4 mb-4 border" style="border-width: 2px !important; border-color: #adb5bd !important;">
                                    <div class="d-flex justify-content-between text-dark mb-2">
                                        <span class="fw-bold">Subtotal Barang:</span>
                                        <span class="fw-bold" x-text="'Rp ' + formatRupiah(subtotalAmount)"></span>
                                    </div>
                                    
                                    <template x-if="taxPercentage > 0">
                                        <div class="d-flex justify-content-between text-dark fw-bold mb-2">
                                            <span x-text="'PPN (' + taxPercentage + '%):'"></span>
                                            <span x-text="'Rp ' + formatRupiah(taxAmount)"></span>
                                        </div>
                                    </template>

                                    <div class="d-flex justify-content-between align-items-center pt-2 mt-2" style="border-top: 2px solid #adb5bd;">
                                        <span class="fw-bold text-dark">Total Tagihan:</span>
                                        <span class="fs-4 fw-black text-danger" x-text="'Rp ' + formatRupiah(totalAmount)"></span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold text-dark">Jumlah Uang Dibayar</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white text-dark fw-bold" style="border: 1px solid #adb5bd;">Rp</span>
                                        <input type="number" x-model.number="payAmount" placeholder="0" class="form-control rounded-end fw-bold text-dark" style="border: 1px solid #adb5bd;">
                                    </div>
                                </div>

                                <button @click="processPayment()" :disabled="cart.length === 0 || payAmount < totalAmount" 
                                        class="btn btn-dark w-100 fw-bold py-3 shadow-sm rounded-pill fs-6">
                                    Proses Pembayaran
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Script POS System Alpine.js -->
    <script>
        function posSystem() {
            return {
                cart: JSON.parse(localStorage.getItem('pos_cart') || '[]'),
                payAmount: 0,
                taxPercentage: {{ $taxPercentage ?? 0 }},
                
                init() {
                    this.$watch('cart', (val) => {
                        localStorage.setItem('pos_cart', JSON.stringify(val));
                    });
                },

                get subtotalAmount() {
                    return this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                },

                get taxAmount() {
                    return (this.subtotalAmount * this.taxPercentage) / 100;
                },

                get totalAmount() {
                    return this.subtotalAmount + this.taxAmount;
                },

                addToCart(id, name, price, stock) {
                    let exist = this.cart.find(i => i.id === id);
                    if (exist) {
                        if (exist.quantity < stock) {
                            exist.quantity++;
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Stok Habis!',
                                text: 'Stok barang tidak mencukupi.',
                                confirmButtonColor: '#212529',
                                width: '450px',
                                customClass: { popup: 'rounded-4 shadow border-0 p-4' }
                            });
                            return;
                        }
                    } else {
                        this.cart.push({ id, name, price, quantity: 1, stock });
                    }
                    localStorage.setItem('pos_cart', JSON.stringify(this.cart));

                    fetch("{{ url('/transactions/add-to-cart') }}/" + id, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json"
                        }
                    }).catch(e => console.log('Sync session cart notice', e));
                },

                removeFromCart(index, id) {
                    this.cart.splice(index, 1);
                    localStorage.setItem('pos_cart', JSON.stringify(this.cart));

                    if (id) {
                        fetch("{{ url('/transactions/remove-from-cart') }}/" + id, {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Accept": "application/json"
                            }
                        }).catch(e => console.log('Sync remove session notice', e));
                    }
                },

                formatRupiah(num) {
                    return new Intl.NumberFormat('id-ID').format(num || 0);
                },

                processPayment() {
                    if (this.cart.length === 0) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Keranjang Kosong',
                            text: 'Keranjang belanja masih kosong!',
                            confirmButtonColor: '#212529',
                            width: '450px',
                            customClass: { popup: 'rounded-4 shadow border-0 p-4' }
                        });
                        return;
                    }

                    if (!this.payAmount || this.payAmount < this.totalAmount) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Uang Kurang',
                            text: 'Jumlah uang dibayar kurang dari total tagihan!',
                            confirmButtonColor: '#dc3545',
                            width: '450px',
                            customClass: { popup: 'rounded-4 shadow border-0 p-4' }
                        });
                        return;
                    }

                    fetch("{{ route('transactions.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            cart: this.cart,
                            pay_amount: this.payAmount,
                            paid_amount: this.payAmount
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            const invNum = data.invoice || data.invoice_number || 'INV-BERHASIL';
                            const changeVal = data.change !== undefined ? data.change : (data.change_amount !== undefined ? data.change_amount : (this.payAmount - this.totalAmount));
                            const changeFormatted = this.formatRupiah(changeVal);
                            const transactionId = data.transaction_id || '';

                            localStorage.removeItem('pos_cart');
                            this.cart = [];

                            Swal.fire({
                                icon: 'success',
                                title: 'Transaksi Berhasil!',
                                html: `
                                    <div class="text-center py-2 px-1">
                                        <p class="mb-2 text-dark fs-6">No Invoice: <strong>${invNum}</strong></p>
                                        <h4 class="text-success fw-bold my-3">Kembalian: Rp ${changeFormatted}</h4>
                                        
                                        <!-- BARIS TOMBOL SEJAJAR & SERAGAM -->
                                        <div class="d-flex justify-content-center gap-3 pt-3 mt-3" style="border-top: 2px solid #adb5bd !important;">
                                            <a href="{{ url('/transactions') }}/${transactionId}" class="btn btn-outline-dark rounded-pill fw-bold py-2 px-4 w-50">
                                                Lihat Struk
                                            </a>
                                            <button onclick="Swal.close(); window.location.reload();" class="btn btn-dark rounded-pill fw-bold py-2 px-4 w-50">
                                                Selesai
                                            </button>
                                        </div>
                                    </div>
                                `,
                                showConfirmButton: false,
                                width: '480px',
                                customClass: {
                                    popup: 'rounded-4 shadow border-0 p-4'
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Transaksi Gagal',
                                text: data.message || 'Terjadi kesalahan pada transaksi.',
                                confirmButtonColor: '#dc3545',
                                width: '450px',
                                customClass: { popup: 'rounded-4 shadow border-0 p-4' }
                            });
                        }
                    })
                    .catch(err => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan Sistem',
                            text: 'Gagal memproses transaksi. Periksa jaringan atau server.',
                            confirmButtonColor: '#dc3545',
                            width: '450px',
                            customClass: { popup: 'rounded-4 shadow border-0 p-4' }
                        });
                    });
                }
            }
        }
    </script>
</x-app-layout>