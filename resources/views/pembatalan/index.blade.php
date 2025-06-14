@extends('components.navbar')

@section('title', 'Pembatalan Pemesanan')

@section('content')
<div class="container pt-5 mt-4"> <!-- Tambahkan padding-top agar tidak nempel dengan navbar -->
    <div class="row">
        <div class="col-12">
            {{-- Notifikasi Sukses / Error --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow mb-5">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-times-circle me-2"></i>Pembatalan Pemesanan Ruang
                    </h4>
                </div>
                <div class="card-body">
                    @if($pemesananPending->count() > 0)
                        <div class="alert alert-warning mb-4">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Perhatian:</strong> Hanya pemesanan dengan status "Pending" yang dapat dibatalkan.
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th><i class="fas fa-door-open me-1"></i>Ruang</th>
                                        <th><i class="fas fa-clock me-1"></i>Durasi</th>
                                        <th><i class="fas fa-bullseye me-1"></i>Tujuan</th>
                                        <th><i class="fas fa-calendar-plus me-1"></i>Waktu Mulai</th>
                                        <th><i class="fas fa-calendar-check me-1"></i>Waktu Selesai</th>
                                        <th><i class="fas fa-info-circle me-1"></i>Status</th>
                                        <th><i class="fas fa-cogs me-1"></i>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pemesananPending as $pemesanan)
                                        <tr>
                                            <td>
                                                <strong>{{ $pemesanan->ruang }}</strong><br>
                                                <small class="text-muted">{{ $pemesanan->ruang_relation->lokasi ?? '' }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $pemesanan->durasi }} jam</span>
                                            </td>
                                            <td>
                                                <div class="text-truncate" style="max-width: 200px;" title="{{ $pemesanan->tujuan }}">
                                                    {{ $pemesanan->tujuan }}
                                                </div>
                                            </td>
                                            <td>
                                                <i class="fas fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($pemesanan->waktu)->format('d/m/Y') }}<br>
                                                <i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($pemesanan->waktu)->format('H:i') }}
                                            </td>
                                            <td>
                                                <i class="fas fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($pemesanan->selesai)->format('d/m/Y') }}<br>
                                                <i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($pemesanan->selesai)->format('H:i') }}
                                            </td>
                                            <td>
                                                <span class="badge status-badge status-pending">
                                                    <i class="fas fa-clock me-1"></i>Pending
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" 
                                                        onclick="confirmDelete({{ $pemesanan->id }}, '{{ $pemesanan->ruang }}')">
                                                    <i class="fas fa-trash me-1"></i>Batalkan
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $pemesananPending->links() }}
                        </div>

                        <div class="alert alert-info mt-4">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Total Pemesanan Pending:</strong> {{ $pemesananPending->total() }}
                            <span class="ms-3">
                                <strong>Menampilkan:</strong> {{ $pemesananPending->firstItem() ?? 0 }} - {{ $pemesananPending->lastItem() ?? 0 }}
                            </span>
                        </div>
                    @else
                        <div class="empty-state text-center p-5 text-muted">
                            <i class="fas fa-check-circle display-4 mb-3"></i>
                            <h5>Tidak Ada Pemesanan Pending</h5>
                            <p>Anda tidak memiliki pemesanan dengan status pending yang dapat dibatalkan.</p>
                            <div class="mt-3">
                                <a href="{{ route('dashboard') }}" class="btn btn-primary me-2">
                                    <i class="fas fa-plus me-1"></i>Buat Pemesanan Baru
                                </a>
                                <a href="{{ route('riwayat.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-history me-1"></i>Lihat Riwayat
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>Konfirmasi Pembatalan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin membatalkan pemesanan untuk ruang <strong id="roomName"></strong>?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-info-circle me-2"></i>
                    <small>Pemesanan yang sudah dibatalkan tidak dapat dikembalikan.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Ya, Batalkan Pemesanan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

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
    .card-header {
        background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);
        color: white;
    }
    .empty-state i {
        opacity: 0.5;
    }

    /* Navbar Adjustments */
    nav.navbar {
        padding-top: 0.5rem !important;
        padding-bottom: 0.5rem !important;
    }

    .card-body {
        padding: 1.5rem;
    }

    .table td, .table th {
        vertical-align: middle !important;
    }
</style>
@endpush

@push('scripts')
<script>
    function confirmDelete(id, roomName) {
        document.getElementById('roomName').textContent = roomName;
        document.getElementById('deleteForm').action = `/pembatalan/${id}`;
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }
</script>
@endpush
