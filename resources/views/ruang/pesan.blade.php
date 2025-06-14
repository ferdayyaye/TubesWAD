<!-- resources/views/ruang/pesan.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Ruang</title>
</head>
<body>
    <h1>Pemesanan Ruang: {{ $room->name }}</h1>
    <p>Gedung: {{ $room->building }}</p>
    <p>Kapasitas: {{ $room->capacity }} orang</p>
    <p>Fasilitas: {{ $room->fasilitas }}</p>

    <!-- Form untuk pemesanan -->
    <form action="{{ route('ruang.pesan', $room->id) }}" method="POST">
        @csrf
        <!-- Form input untuk pemesanan lainnya -->
        <button type="submit">Pesan Ruang</button>
    </form>
</body>
</html>
