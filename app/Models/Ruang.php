<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika berbeda
    protected $table = 'ruang'; // Sesuaikan nama tabel yang benar

    // Kolom yang bisa diisi massal
    protected $fillable = ['name', 'capacity', 'building', 'image_url', 'status', 'fasilitas'];  // Menambahkan 'fasilitas' ke dalam fillable

    // Mendefinisikan relasi one-to-many dengan Availability
    public function availability()
    {
        return $this->hasMany(Availability::class, 'ruang_id'); // Menyesuaikan dengan relasi yang ada
    }
    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
