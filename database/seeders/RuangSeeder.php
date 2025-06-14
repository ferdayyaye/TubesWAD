<?php

namespace Database\Seeders;

use App\Models\Ruang;
use Illuminate\Database\Seeder;

class RuangSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Ruang::create([
            'name' => 'Ruang kecil 1605',
            'capacity' => 4,
            'fasilitas' => 'Kursi, Meja',
            'building' => 'TULT',
            'image_url' => 'ruang_kecil_1605.jpg',
            'status' => 'available',
        ]);

        Ruang::create([
            'name' => 'Area Makan TULT Lt.16',
            'capacity' => 50,
            'fasilitas' => 'Kursi, Meja',
            'building' => 'TULT',
            'image_url' => 'area_makan_tult.jpg',
            'status' => 'unavailable',
        ]);

        Ruang::create([
            'name' => 'Ruang Rapat TULT 1604',
            'capacity' => 20,
            'fasilitas' => 'Kursi, Meja, Monitor',
            'building' => 'TULT',
            'image_url' => 'ruang_rapat_tult_1604.jpg',
            'status' => 'available',
        ]);

        Ruang::create([
            'name' => 'Ruang Rapat TULT 1602',
            'capacity' => 20,
            'fasilitas' => 'Kursi, Meja, Monitor',
            'building' => 'TULT',
            'image_url' => 'ruang_rapat_tult_1602.jpg',
            'status' => 'available',
        ]);
    }
}