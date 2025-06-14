<!-- resources/views/profile-edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profil</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <hr>

    <form action="{{ route('profile.deactivate') }}" method="POST" onsubmit="return confirm('Yakin ingin menonaktifkan akun?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-3">Nonaktifkan Akun</button>
    </form>
</div>
@endsection