<?php
// app/Http/Controllers/RiwayatController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        // Get booking history for the authenticated user
        $riwayatPemesanan = Pemesanan::with(['ruang'])
            ->where('user_id', Auth::id())
            ->orderBy('waktu', 'desc')
            ->paginate(10);

        return view('riwayat.index', compact('riwayatPemesanan'));
    }
}