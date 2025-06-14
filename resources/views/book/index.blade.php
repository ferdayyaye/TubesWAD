@extends('components.navbar')

@section('title', 'Jadwal Ruangan')

@section('content')
<div class="container-fluid px-4" style="margin-top: 80px;">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-clock-history me-2"></i>
                        Jadwal dan Ruangan terBooking
                    </h4>
                </div>
                <div class="card-body">
                    @if($bookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Ruang</th>
                                        <th>Tujuan</th>
                                        <th>Durasi</th>
                                        <th>Waktu</th>
                                        <th>Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->ruang }}</td>
                                        <td>{{ $booking->tujuan }}</td>
                                        <td>{{ $booking->durasi }} jam</td>
                                        <td>{{ \Carbon\Carbon::parse($booking->waktu)->format('Y-m-d H:i:s') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($booking->selesai)->format('Y-m-d H:i:s') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $bookings->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-calendar-x display-1 text-muted"></i>
                            <h4 class="text-muted mt-3">Tidak ada jadwal yang diterima</h4>
                            <p class="text-muted">Belum ada pemesanan ruang yang disetujui saat ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.table th {
    white-space: nowrap;
    background-color: #343a40;
    color: white;
}
.table td {
    vertical-align: middle;
}
.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.1);
}

/* Additional spacing for navbar */
body {
    padding-top: 60px; /* Adjust this value based on your navbar height */
}

.container-fluid {
    margin-top: 20px; /* Additional spacing */
}
</style>
@endsection