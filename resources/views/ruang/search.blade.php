<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian dan Pemesanan Ruang</title>
    <!-- Memasukkan Bootstrap CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .containers {
            width: 100vw height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }


        .main {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            max-width: 1000px;
        }

        .card {
            border: 1px solid #f0f0f0;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card-body {
            background-color: #f9f9f9;
        }

        .aa {
            background-color: #e71e29;
            border-color: #e71e29;
            padding: 10px 20px;
            display: flex;
            justify-content: center text-align: center;
            /* color: #fff; */
            border-radius: 5px;
        }

        .aa:hover {
            background-color: #bf1b25;
            border-color: #bf1b25;
        }

        h1 {
            color: #333;
            font-size: 2rem;
            font-weight: bold;
        }

        .filter-form {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .filter-form label {
            font-weight: bold;
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

        <div class="containers">

            <div class="main" style="margin-top: 6rem;" <!-- Form Filter Pencarian -->
                <div class="filter-form">
                    <form method="GET" action="{{ route('ruang.search') }}">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="capacity">Kapasitas</label>
                                <select name="capacity" id="capacity" class="form-control">
                                    <option value="">Pilih Kapasitas</option>
                                    <option value="4">4 orang</option>
                                    <option value="20">20 orang</option>
                                    <option value="50">50 orang</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="fasilitas">Fasilitas</label>
                                <select name="fasilitas" id="fasilitas" class="form-control">
                                    <option value="">Pilih Fasilitas</option>
                                    <option value="Kursi">Kursi</option>
                                    <option value="Meja">Meja</option>
                                    <option value="Monitor">Monitor</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn-block">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>

                <h1 class="text-center mb-4">Data Ruangan</h1>
                <div class="row">
                    @foreach ($rooms as $room)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="{{ asset('images/' . $room->image_url) }}" class="card-img-top"
                                    alt="{{ $room->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $room->name }}</h5>
                                    <p class="card-text">Kapasitas: {{ $room->capacity }} orang</p>
                                    <p class="card-text">Fasilitas: {{ $room->fasilitas }}</p>
                                    <p class="card-text">Gedung: {{ $room->building }}</p>
                                    <a href="{{ route('ruang.check', $room->id) }}" class="aa"
                                        style="text-decoration: none; color: white;">Cek Ketersediaan</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.6/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>