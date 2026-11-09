<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Item;
use App\Models\Mutation;
use App\Models\ActivityLog;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Role Spatie[cite: 15]
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $adminRole      = Role::firstOrCreate(['name' => 'Admin']);
        $kasirRole      = Role::firstOrCreate(['name' => 'Kasir']);

        // 2. Buat Akun User Default[cite: 15]
        $superAdmin = User::create([
            'name'     => 'Admin Tes',
            'email'    => 'admin@tes.com',
            'password' => Hash::make('password123'),
        ]);
        $superAdmin->assignRole($superAdminRole);

        $admin = User::create([
            'name'     => 'Siti Admin',
            'email'    => 'siti@tes.com',
            'password' => Hash::make('password123'),
        ]);
        $admin->assignRole($adminRole);

        $kasir = User::create([
            'name'     => 'Budi Kasir',
            'email'    => 'kasir@tes.com',
            'password' => Hash::make('password123'),
        ]);
        $kasir->assignRole($kasirRole);

        // 3. Kategori Peralatan Sekolah
        $cat1 = Category::create(['name' => 'Alat Tulis']);
        $cat2 = Category::create(['name' => 'Buku & Kertas']);
        $cat3 = Category::create(['name' => 'Perlengkapan Gambar']);
        $cat4 = Category::create(['name' => 'Aksesoris & Lainnya']);

        // 4. 20 Dummy Peralatan Sekolah (Stok Hitungan Jari, Harga Murah)
        $item1 = Item::create(['sku' => 'ATK-001', 'category_id' => $cat1->id, 'name' => 'Pensil 2B Faber-Castell', 'price' => 2500, 'stock' => 5]);
        $item2 = Item::create(['sku' => 'ATK-002', 'category_id' => $cat1->id, 'name' => 'Pulpen Hitam Snowman', 'price' => 3000, 'stock' => 8]);
        $item3 = Item::create(['sku' => 'ATK-003', 'category_id' => $cat1->id, 'name' => 'Penghapus Joyko Kecil', 'price' => 1000, 'stock' => 4]);
        $item4 = Item::create(['sku' => 'ATK-004', 'category_id' => $cat1->id, 'name' => 'Rautan Pensil Bulat', 'price' => 1500, 'stock' => 6]);
        $item5 = Item::create(['sku' => 'ATK-005', 'category_id' => $cat1->id, 'name' => 'Penggaris Besi 15cm', 'price' => 2000, 'stock' => 3]);
        
        $item6 = Item::create(['sku' => 'ATK-006', 'category_id' => $cat2->id, 'name' => 'Buku Tulis SiDu 38 Lembar', 'price' => 3500, 'stock' => 9]);
        $item7 = Item::create(['sku' => 'ATK-007', 'category_id' => $cat2->id, 'name' => 'Buku Gambar A4', 'price' => 4500, 'stock' => 5]);
        $item8 = Item::create(['sku' => 'ATK-008', 'category_id' => $cat2->id, 'name' => 'Sampul Buku Coklat', 'price' => 1000, 'stock' => 7]);
        $item9 = Item::create(['sku' => 'ATK-009', 'category_id' => $cat2->id, 'name' => 'Sampul Plastik Bening', 'price' => 1000, 'stock' => 8]);
        $item10 = Item::create(['sku' => 'ATK-010', 'category_id' => $cat2->id, 'name' => 'Kertas Lipat Origami', 'price' => 3000, 'stock' => 4]);

        $item11 = Item::create(['sku' => 'ATK-011', 'category_id' => $cat1->id, 'name' => 'Correction Tape (Tipe-X)', 'price' => 5000, 'stock' => 3]);
        $item12 = Item::create(['sku' => 'ATK-012', 'category_id' => $cat1->id, 'name' => 'Spidol Hitam Boardmarker', 'price' => 6500, 'stock' => 5]);
        $item13 = Item::create(['sku' => 'ATK-013', 'category_id' => $cat4->id, 'name' => 'Lem Kertas Stick', 'price' => 3500, 'stock' => 2]);
        $item14 = Item::create(['sku' => 'ATK-014', 'category_id' => $cat4->id, 'name' => 'Gunting Kertas Mini', 'price' => 4500, 'stock' => 4]);
        $item15 = Item::create(['sku' => 'ATK-015', 'category_id' => $cat4->id, 'name' => 'Map Plastik L', 'price' => 1500, 'stock' => 9]);

        $item16 = Item::create(['sku' => 'ATK-016', 'category_id' => $cat3->id, 'name' => 'Pensil Warna 12 Kayu', 'price' => 12500, 'stock' => 2]);
        $item17 = Item::create(['sku' => 'ATK-017', 'category_id' => $cat3->id, 'name' => 'Krayon Hexagonal 12 Warna', 'price' => 14000, 'stock' => 3]);
        $item18 = Item::create(['sku' => 'ATK-018', 'category_id' => $cat3->id, 'name' => 'Busur Derajat Plastik', 'price' => 2500, 'stock' => 6]);
        $item19 = Item::create(['sku' => 'ATK-019', 'category_id' => $cat3->id, 'name' => 'Jangka Matematika', 'price' => 8500, 'stock' => 4]);
        $item20 = Item::create(['sku' => 'ATK-020', 'category_id' => $cat1->id, 'name' => 'Stabilo Kuning', 'price' => 4000, 'stock' => 5]);

        // 5. Dummy Data Mutasi Stok[cite: 15]
        Mutation::create([
            'user_id'  => $admin->id,
            'item_id'  => $item1->id,
            'type'     => 'in',
            'quantity' => 5,
            'notes'    => 'Stok awal Pensil',
        ]);

        Mutation::create([
            'user_id'  => $admin->id,
            'item_id'  => $item3->id,
            'type'     => 'out',
            'quantity' => 1,
            'notes'    => 'Barang hilang/rusak',
        ]);

        // 6. Dummy Log Aktivitas[cite: 15]
        ActivityLog::create([
            'user_id'          => $superAdmin->id,
            'reference_no'     => 'SYS-INIT',
            'action_type'      => 'Buat',
            'transaction_type' => 'Kategori Barang',
            'action'           => 'Inisialisasi Master Data',
            'description'      => 'Membuat kategori peralatan sekolah',
            'ip_address'       => '127.0.0.1',
        ]);
    }
}