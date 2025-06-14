@extends('layouts.app')
@section('body-style', 'style="background-color: white;"')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Dashboard</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                {{-- Jadwal Ruangan --}}
            <x-dashboard-card title="Verifikasi Pemesanan" description="Kelola pemesanan"
                link="{{ route('jadwal.index') }}" icon="bi-clock-history" />
                {{-- Jadwal Ruangan --}}
            <x-dashboard-card title="Jadwal Ruang" description="Kelola jadwal ruang agar tidak bentrok."
                link="{{ route('book.index') }}" icon="bi-clock-history" />
        </div>
    </div>
@endsection
