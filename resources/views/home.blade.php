@extends('layouts.landing')

@section('content')
        <!-- Overlay gelap transparan -->
        <div style="background-color: rgba(0, 0, 0, 0.5); position: absolute; top: 0; left: 0; right: 0; bottom: 0;"></div>
        
        <!-- Konten utama -->
        <div class="container position-relative z-index-1">
            <h1 class="display-4 fw-bold">TEL-U Room Reservation System</h1>
            <p class="lead">Sistem reservasi ruangan Telkom University yang mudah, efisien, dan cepat.</p>
            <a href="{{ route('register') }}" class="btn btn-light me-2">Daftar Sekarang</a>
            <a href="{{ route('login') }}" class="btn btn-outline-light">Masuk</a>
        </div>
    </section>
@endsection