@extends('layouts.auth')

@section('content')

        <!-- Konten -->
        <div class="container position-relative z-index-1">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-header text-white text-center rounded-top-4" style="background-color: #D71920;">
                            <h4 class="mb-0">Masuk ke Akun Anda</h4>
                        </div>
                        <div class="card-body p-4 bg-white rounded-bottom-4">

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" required autofocus>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Kata Sandi</label>
                                    <input type="password" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        Ingat Saya
                                    </label>
                                </div>

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-lg rounded-3"
                                        style="background-color: #D71920; border-color: #D71920; color: white;">
                                        Masuk
                                    </button>
                                </div>
                            </form>

                            <div class="text-center">
                                <p class="text-muted">Belum punya akun?
                                    <a href="{{ route('register') }}" class="text-danger fw-bold">Daftar sekarang</a>
                                </p>
                                @if (Route::has('password.request'))
                                    <p class="mt-2">
                                        <a class="text-decoration-none text-danger" href="{{ route('password.request') }}">
                                            Lupa kata sandi?
                                        </a>
                                    </p>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
