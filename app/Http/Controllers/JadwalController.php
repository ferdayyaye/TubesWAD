<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use App\Notifications\PemesananStatusUpdated; 
class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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

        return view('jadwal.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ruang = Ruang::findOrFail($id);
        $pemesanans = Pemesanan::where('ruang_id', $id)->orderBy('waktu')->get()->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->waktu)->format('Y-m-d');
        });
        // dd($pemesanans);

        return view('jadwal.show', compact('pemesanans', 'ruang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jadwal = Pemesanan::findOrFail($id);

        return view('jadwal.edit', compact('jadwal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request);
        $jadwal = Pemesanan::findOrFail($id);

        $jadwal->update([
            'status' => $request->status,
        ]);

        return redirect()->route('jadwal.show', $jadwal->ruang_id)->with('success', 'Jadwal berhasil diperbarui.');
    }

    // In your Admin controller (e.g., AdminPemesananController.php)
    public function updateStatus(Request $request, $id)
    {
        $pemesanan = Pemesanan::with('user')->findOrFail($id); // Eager load user

        // Validate the incoming status
        $validated = $request->validate([
            'status' => 'required|in:Diterima,Ditolak', // Enforce correct values
        ]);

        // Update the status
        $pemesanan->status = $validated['status'];
        $pemesanan->save();

        // --- Send Notification to the User ---
        $pemesanan->user->notify(new PemesananStatusUpdated($pemesanan));
        // -------------------------------------

        return redirect()->back()->with('success', 'Status pemesanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = Pemesanan::findOrFail($id);
        $ruangId = $jadwal->ruang_id;

        // Hapus pemesanan
        $jadwal->delete();

        return redirect()->route('jadwal.show', $ruangId)->with('success', 'Jadwal berhasil dihapus.');
    }
}
