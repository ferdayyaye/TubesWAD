<?php
// app/Http/Controllers/PemesananController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Exception;

class PemesananController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input - remove 'user' from required since we'll get it from auth
        $data = $request->validate([
            'waktu'    => 'required|date_format:Y-m-d\TH:i',
            'durasi'   => 'required|integer|min:1',
            'tujuan'   => 'required|string|max:255',
            'status'   => 'required|string|in:pending,approved,rejected',
            'ruang'    => 'required|string|max:255',
            'ruang_id' => 'required|integer|exists:ruang,id',
        ]);

        try {
            // Parse waktu ke Carbon
            $waktu = Carbon::parse($data['waktu']);
            $durasi = (int) $data['durasi'];
            $selesai = $waktu->copy()->addHours($durasi);

            // Add user information from authenticated user
            $data['waktu'] = $waktu;
            $data['selesai'] = $selesai;
            $data['user'] = Auth::user()->name; // Keep the name for display
            $data['user_id'] = Auth::id(); // Add user ID for relationships

            $pemesanan = Pemesanan::create($data);

            return response()->json([
                'message'   => 'Pemesanan berhasil disimpan!',
                'pemesanan' => $pemesanan,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan pemesanan.',
            ], 500);
        }
    }


}
