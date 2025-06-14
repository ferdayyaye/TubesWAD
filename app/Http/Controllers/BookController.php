<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pemesanan;
class BookController extends Controller
{
    public function index()
    {
        // Get booking history for the authenticated user
        $bookings = Pemesanan::with(['ruang'])
            ->where('status', 'Diterima')
            ->orderBy('waktu', 'desc')
            ->paginate(10);

        return view('book.index', compact('bookings'));
    }
}