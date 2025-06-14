@extends('layouts.app')
@section('body-style', 'style="background-color: white;"')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Dashboard</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            {{-- Pencarian Ruang --}}
            <x-dashboard-card title="Pencarian dan Pemesanan Ruang" description="Cari ruang berdasarkan kapasitas, fasilitas, waktu dan lakukan pemesanan."
                link="{{ route('ruang.search') }}" icon="bi-search" />

            {{-- Jadwal Ruangan --}}
            <x-dashboard-card title="Jadwal Ruangan" description="Kelola jadwal ruang agar tidak bentrok."
                link="{{ route('book.index') }}" icon="bi-clock-history" />

            {{-- Riwayat Pemesanan --}}
            <x-dashboard-card title="Riwayat Pemesanan" description="Lihat riwayat pemesanan yang pernah dilakukan."
                link="{{ route('riwayat.index') }}" icon="bi-journal-text" />

            {{-- Pembatalan Pemesanan --}}
            <x-dashboard-card title="Pembatalan Pemesanan" description="Batalkan pemesanan sebelum waktu berakhir."
                link="{{ route('pembatalan.index') }}" icon="bi-x-circle" />

        </div>
    </div>
@endsection
