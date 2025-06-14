<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ketersediaan Ruangan</title>
    <!-- Memasukkan Bootstrap CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

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


        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            font-size: 1rem;
            padding: 10px;
            border-radius: 5px;
        }

        .aa {
            background-color: #e71e29;
            border-color: #e71e29;
            padding: 12px;
            /* margin: 15px; */
            font-size: 1rem;
            width: 100%;
        }

        .aa:hover {
            background-color: #bf1b25;
            border-color: #bf1b25;
        }

        /* Kalender styling */
        #calendar {
            max-width: 700px;
            margin: 0 auto;
        }

        .datepicker {
            width: 100%;
        }

        .ui-datepicker-calendar td {
            padding: 10px;
            font-size: 16px;
        }

        .ui-datepicker-calendar .ui-state-disabled {
            background-color: #ffdddd;
        }

        .calendar-event {
            background-color: #28a745;
            color: white;
            padding: 5px;
            font-size: 14px;
        }

        .calendar-event.unavailable {
            background-color: #dc3545;
        }
        
        .border-button {
            border-radius: 5px;
        }


        /* Custom Navbar */
        /* .navbar-custom {
            background-color: #e71e29;
        }
        .navbar-custom .navbar-brand, .navbar-custom .navbar-nav .nav-link {
            color: white;
        }
        .navbar-custom .navbar-nav .nav-link:hover {
            color: #f8f9fa;
        } */
    </style>
</head>

<body>
    <!-- Navbar -->
    @extends('components.navbar')
    @section('navbar')
        <div class="containers">

            <div class="main" style="margin-top: 6rem;">
                <h1>Cek Ketersediaan: {{ $room->name }}</h1>

                <!-- Form Pemesanan -->
                <div class="mt-4">
                    <h3>Pemesanan Ruang</h3>
                    <form id="pesanForm" method="POST" action="{{ route('pemesanan.store') }}">
                        @csrf

                        <!-- Nama/User -->
                        <div class="form-group">
                            <label for="user">Nama Pemesan</label>
                            <input type="text" id="user" name="user" class="form-control" required>
                        </div>

                        <!-- Waktu (tanggal & jam pemesanan) -->
                        <div class="form-group">
                            <label for="waktu">Waktu Pemesanan</label>
                            <input type="datetime-local" id="waktu" name="waktu" class="form-control" required>
                        </div>

                        <!-- Durasi -->
                        <div class="form-group">
                            <label for="durasi">Durasi (dalam jam)</label>
                            <input type="number" id="durasi" name="durasi" class="form-control" min="1"
                                max="12" required>
                        </div>

                        <!-- Tujuan -->
                        <div class="form-group">
                            <label for="tujuan">Tujuan Pemesanan</label>
                            <input type="text" id="tujuan" name="tujuan" class="form-control" required>
                        </div>

                        <!-- Status (diset otomatis 'pending') -->
                        <input type="hidden" id="status" name="status" value="pending">

                        <!-- Nama ruang -->
                        <div class="form-group">
                            <label for="ruang">Nama Ruang</label>
                            <input type="text" id="ruang" name="ruang" class="form-control"
                                value="{{ $room->name }}" readonly>
                        </div>
                        
                        <!-- ID ruang -->
                        <input type="hidden" id="ruang_id" name="ruang_id" value="{{ $room->id }}">
                        <div class="form-group">
                            <button type="submit" class=" aa border-button" style="color : white">Pesan Ruang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Pop-up -->
        <div id="myModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pemesanan Diproses</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Pemesanan Anda sedang diproses. Harap tunggu...</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close"
                            id="closeModal2">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        {{-- @dd($room ) --}}
        <script>
            $(document).ready(function() {
                // Inisialisasi modal
                $('#myModal').modal({
                    show: false
                });

                // Tutup modal saat tombol close diklik
                $('#closeModal').click(function() {
                    $('#myModal').modal('hide');
                });
                $('#closeModal2').click(function() {
                    $('#myModal').modal('hide');
                });

            });
        </script>
        <script>
            $(document).ready(function() {
                // Data tanggal yang sudah dipesan (harus disesuaikan dengan data dari backend)
                var bookedDates = [
                    @foreach ($room->availability ?? [] as $availability)
                        '{{ $availability->start_date->format('Y-m-d') }}',
                    @endforeach
                ];

                // Inisialisasi kalender
                $("#calendar").fullCalendar({
                    events: [
                        @foreach ($room->availability ?? [] as $availability)
                            {
                                title: 'Tersedia',
                                start: '{{ $availability->start_date }}',
                                end: '{{ $availability->end_date }}',
                                color: 'green',
                                description: 'Tersedia'
                            },
                        @endforeach {
                            title: 'Tidak Tersedia',
                            start: '2025-05-31',
                            end: '2025-05-31',
                            color: 'red',
                            description: 'Tidak Tersedia'
                        }
                    ],
                    dayClick: function(date, jsEvent, view) {
                        var selectedDate = date.format();
                        $('#tanggal').val(selectedDate); // Menampilkan tanggal yang dipilih di form
                    },
                    eventRender: function(event, element) {
                        if (event.color == 'red') {
                            element.addClass('unavailable'); // Menandai tanggal yang tidak tersedia
                        }
                    }
                });

                // Tangani submit form tanpa reload halaman
                $("#pesanForm").submit(function(event) {
                    event.preventDefault(); // Mencegah reload halaman

                    var formData = {
                        _token: $('input[name="_token"]').val(),
                        user: $('#user').val(),
                        waktu: $('#waktu').val(),
                        durasi: $('#durasi').val(),
                        tujuan: $('#tujuan').val(),
                        status: $('#status').val(),
                        ruang: $('#ruang').val(),
                        ruang_id: $('#ruang_id').val()
                    };

                    $.ajax({
                        url: "{{ route('pemesanan.store') }}",
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            $('#myModal').modal('show'); // Tampilkan modal konfirmasi
                            console.log(response.message);
                            // Optional: reset form
                            $('#pesanForm')[0].reset();
                        },
                        error: function(xhr) {
                            alert("Terjadi kesalahan. Coba periksa kembali input Anda.");
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
        </script>
    </body>

    </html>