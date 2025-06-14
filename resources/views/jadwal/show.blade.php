<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian dan Pemesanan Ruang</title>

    <!-- Bootstrap CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .main-container {
            min-height: 100vh;
            padding: 50px 15px;
            /* background-color: #f2f2f2; */
        }

        .main-card {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease-in-out;
        }

        .btn-danger {
            background-color: #e71e29;
            border-color: #e71e29;
        }

        .btn-danger:hover {
            background-color: #bf1b25;
            border-color: #bf1b25;
        }

        h1 {
            font-weight: bold;
            color: #333;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .action-btn svg {
            transition: transform 0.2s ease;
        }

        .action-btn:hover svg {
            transform: scale(1.2);
        }

        /* Custom Navbar */
        .navbar-custom {
            background-color: #e71e29;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .navbar-nav .nav-link {
            color: white;
        }

        .navbar-custom .navbar-nav .nav-link:hover {
            color: #f8f9fa;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    @extends('components.navbar')
    @section('navbar')

        <div class="container main-container">
            <div class="main-card" style="margin-top: 2rem;">
                <h1 class="text-center mb-4">Pencarian dan Pemesanan <span class="font-weight-bold">{{ $ruang->name }}</span>
                </h1>

                @php \Carbon\Carbon::setLocale('id'); @endphp

                @foreach ($pemesanans as $tanggal => $pemesananPerTanggal)
                    <h5 class="font-weight-bold mt-4">{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mt-2">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Tujuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemesananPerTanggal as $p)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($p->waktu)->format('H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($p->selesai)->format('H:i') }}</td>
                                        <td>{{ $p->tujuan }}</td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $p->status == 'Diterima' ? 'success' : ($p->status == 'Ditolak' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($p->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('jadwal.edit', $p->id) }}"
                                                class="btn btn-outline-primary btn-sm action-btn" title="Edit">
                                                <svg width="20" height="20" viewBox="0 0 72 72"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M38.406 22.234l11.36 11.36L28.784 54.576l-12.876 4.307c-1.725.577-3.367-1.065-2.791-2.79l4.307-12.876L38.406 22.234zM41.234 19.406l5.234-5.234c1.562-1.562 4.095-1.562 5.657 0l5.703 5.703c1.562 1.562 1.562 4.095 0 5.657l-5.234 5.234L41.234 19.406z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('jadwal.destroy', $p->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm action-btn"
                                                    title="Hapus">
                                                    <svg width="20" height="20" viewBox="0 0 30 30"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M13 3A1 1 0 0011.99 4H6a1 1 0 000 2h18a1 1 0 000-2h-6.01A1 1 0 0017 3h-4zM6 8v16a2 2 0 002 2h14a2 2 0 002-2V8H6z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- JS Scripts -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
