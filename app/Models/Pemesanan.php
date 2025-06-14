<?php
// app/Models/Pemesanan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';

    // Add user_id to fillable
    protected $fillable = [
        'waktu',
        'durasi',
        'tujuan',
        'selesai',
        'status',
        'ruang',
        'user',
        'user_id', // Add this
        'ruang_id',
    ];

    protected $casts = [
        'waktu' => 'datetime',
        'selesai' => 'datetime', // Add this for selesai field
    ];

    // Relasi ke Ruang
    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'ruang_id');
    }

    // Add relationship to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}