@extends('components.navbar')

@section('title', 'Riwayat Pemesanan')

@section('content')
<div class="container my-5 pt-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    @if($riwayatPemesanan->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-door-open me-1"></i>Ruang</th>
                                        <th><i class="fas fa-clock me-1"></i>Durasi</th>
                                        <th><i class="fas fa-bullseye me-1"></i>Tujuan</th>
                                        <th><i class="fas fa-calendar-plus me-1"></i>Waktu Mulai</th>
                                        <th><i class="fas fa-calendar-check me-1"></i>Waktu Selesai</th>
                                        <th><i class="fas fa-info-circle me-1"></i>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($riwayatPemesanan as $pemesanan)
                                        <tr>
                                            <td>
                                                <strong>{{ $pemesanan->ruang }}</strong>
                                                @if($pemesanan->ruang_relation)
                                                    <br><small class="text-muted">{{ $pemesanan->ruang_relation->lokasi ?? '' }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ $pemesanan->durasi }} jam
                                                </span>
                                            </td>
                                            <td>
                                                <div class="text-truncate" style="max-width: 200px;" title="{{ $pemesanan->tujuan }}">
                                                    {{ $pemesanan->tujuan }}
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <i class="fas fa-calendar me-1"></i>
                                                    {{ \Carbon\Carbon::parse($pemesanan->waktu)->format('d/m/Y') }}
                                                </div>
                                                <div>
                                                    <i class="fas fa-clock me-1"></i>
                                                    {{ \Carbon\Carbon::parse($pemesanan->waktu)->format('H:i') }}
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <i class="fas fa-calendar me-1"></i>
                                                    {{ \Carbon\Carbon::parse($pemesanan->selesai)->format('d/m/Y') }}
                                                </div>
                                                <div>
                                                    <i class="fas fa-clock me-1"></i>
                                                    {{ \Carbon\Carbon::parse($pemesanan->selesai)->format('H:i') }}
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $statusClass = '';
                                                    $statusIcon = '';
                                                    switch(strtolower($pemesanan->status)) {
                                                        case 'pending':
                                                            $statusClass = 'status-pending';
                                                            $statusIcon = 'fas fa-clock';
                                                            break;
                                                        case 'diterima':
                                                        case 'approved':
                                                            $statusClass = 'status-diterima';
                                                            $statusIcon = 'fas fa-check-circle';
                                                            break;
                                                        case 'ditolak':
                                                        case 'rejected':
                                                            $statusClass = 'status-ditolak';
                                                            $statusIcon = 'fas fa-times-circle';
                                                            break;
                                                    }
                                                @endphp
                                                <span class="badge status-badge {{ $statusClass }}">
                                                    <i class="{{ $statusIcon }} me-1"></i>
                                                    {{ ucfirst($pemesanan->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $riwayatPemesanan->links() }}
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Total Pemesanan:</strong> {{ $riwayatPemesanan->total() }}
                                    <span class="ms-3">
                                        <strong>Menampilkan:</strong> {{ $riwayatPemesanan->firstItem() ?? 0 }} - {{ $riwayatPemesanan->lastItem() ?? 0 }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-calendar-times"></i>
                            <h5>Belum Ada Riwayat Pemesanan</h5>
                            <p class="text-muted">Anda belum pernah melakukan pemesanan ruang.</p>
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Buat Pemesanan Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .status-badge {
        font-size: 0.8rem;
        padding: 0.25rem 0.5rem;
    }
    .status-pending {
        background-color: #ffc107;
        color: #000;
    }
    .status-diterima {
        background-color: #28a745;
        color: #fff;
    }
    .status-ditolak {
        background-color: #dc3545;
        color: #fff;
    }
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    .empty-state {
        text-align: center;
        padding: 3rem 0;
        color: #6c757d;
    }
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
</style>
@endpush

@push('scripts')
<script>
    document.querySelectorAll('tbody tr').forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f8f9fa';
        });
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });
</script>
@endpush