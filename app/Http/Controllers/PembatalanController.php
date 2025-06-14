<?php
// app/Http/Controllers/PembatalanController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;

class PembatalanController extends Controller
{
    public function index()
    {
        // Get only pending bookings for the authenticated user
        $pemesananPending = Pemesanan::with(['ruang'])
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->orderBy('waktu', 'desc')
            ->paginate(10);

        return view('pembatalan.index', compact('pemesananPending'));
    }

    public function destroy($id)
    {
        try {
            $pemesanan = Pemesanan::findOrFail($id);
            
            // Check if the booking belongs to the authenticated user
            if ($pemesanan->user_id !== Auth::id()) {
                return redirect()->route('pembatalan.index')
                    ->with('error', 'Anda tidak memiliki akses untuk membatalkan pemesanan ini.');
            }
            
            // Check if status is pending
            if ($pemesanan->status !== 'pending') {
                return redirect()->route('pembatalan.index')
                    ->with('error', 'Hanya pemesanan dengan status pending yang dapat dibatalkan.');
            }
            
            // Delete the booking
            $pemesanan->delete();
            
            return redirect()->route('pembatalan.index')
                ->with('success', 'Pemesanan berhasil dibatalkan.');
                
        } catch (\Exception $e) {
            return redirect()->route('pembatalan.index')
                ->with('error', 'Terjadi kesalahan saat membatalkan pemesanan.');
        }
    }
}