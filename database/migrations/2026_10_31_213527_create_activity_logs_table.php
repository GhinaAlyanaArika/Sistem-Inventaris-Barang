<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('reference_no')->nullable();
            $table->string('action_type')->default('Buat'); // Buat, Ubah, Hapus, Login, dll
            $table->string('transaction_type')->default('Lainnya'); // Penjualan, Mutasi Stok, Kategori, Item, dll
            $table->string('action');
            $table->text('description')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};