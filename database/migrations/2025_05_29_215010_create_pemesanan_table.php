<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananTable extends Migration
{
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id(); // Kolom id (auto increment)
            $table->dateTime('waktu'); // Kolom waktu untuk menyimpan waktu pemesanan
            $table->integer('durasi'); // Kolom durasi untuk menyimpan durasi pemesanan dalam jam atau menit
            $table->string('tujuan'); // Kolom tujuan untuk menyimpan tujuan pemesanan
            $table->string('status'); // Kolom status untuk menyimpan status pemesanan (misalnya: pending, approved)
            $table->string('ruang'); // Kolom ruang untuk menyimpan nama ruang yang dipesan
            $table->string('user'); // Kolom user untuk menyimpan nama atau ID pengguna yang melakukan pemesanan
            $table->timestamps(); // Kolom created_at dan updated_at secara otomatis dihasilkan
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemesanan'); // Menghapus tabel pemesanan jika rollback migration dilakukan
    }
}
