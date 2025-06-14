<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\Availability; // Import Availability Model
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    public function search(Request $request)
    {
        // Ambil parameter dari request
        $capacity = $request->get('capacity');
        $fasilitas = $request->get('fasilitas');

        // Query data ruang berdasarkan filter kapasitas dan fasilitas
        $rooms = Ruang::when($capacity, function ($query, $capacity) {
                return $query->where('capacity', $capacity);
            })
            ->when($fasilitas, function ($query, $fasilitas) {
                return $query->where('fasilitas', 'like', "%{$fasilitas}%");
            })
            ->get();

        // Kirim data ruang ke view
        return view('ruang.search', compact('rooms'));
    }

    // Cek ketersediaan ruangan
    public function check($id)
    {
        $room = Ruang::find($id);

        if ($room) {
            // Ambil data tanggal yang sudah dipesan untuk ruangan ini
            $bookedDates = Pemesanan::where('ruang_id', $id)
                                    ->pluck('waktu') // ambil hanya tanggal pemesanan
                                    ->toArray();
            
            // Kirim data ruangan dan tanggal yang sudah dipesan ke view
            return view('ruang.check', compact('room', 'bookedDates'));
        } else {
            return redirect()->back()->with('error', 'Ruang tidak ditemukan');
        }
    }

    // Method untuk menampilkan halaman pemesanan
    public function pesan($id)
    {
        // Ambil data ruang beserta availability-nya
        $room = Ruang::with('availability')->findOrFail($id); // Pastikan untuk eager load relasi availability

        // Tampilkan form pemesanan
        return view('ruang.pesan', compact('room'));
    }
}
