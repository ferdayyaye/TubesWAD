<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = ['start_date', 'end_date', 'ruang_id'];

    // Relasi dengan Ruang
    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }
}
