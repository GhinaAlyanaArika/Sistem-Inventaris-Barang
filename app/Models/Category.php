<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Mengizinkan kolom name dan description untuk diisi data
    protected $fillable = ['name', 'description'];

    // Relasi ke tabel Item (Satu kategori memiliki banyak barang)
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}