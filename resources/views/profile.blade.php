@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-danger text-white rounded-top-4 d-flex align-items-center">
                    <i class="bi bi-person-fill fs-4 me-2"></i>
                    <h5 class="mb-0">User Profile</h5>
                </div>
                <div class="card-body d-flex flex-column flex-md-row align-items-center p-4 gap-4">
                    <!-- Foto Profil -->
                    <div class="text-center">
                        <img src="{{ asset('images/default-profile.png') }}" alt="Profile Picture" class="rounded-circle border border-3 border-danger shadow" width="130" height="130">
                    </div>

                    <!-- Info User -->
                    <div class="flex-grow-1 w-100">
                        <table class="table table-borderless mb-3">
                            <tr>
                                <th class="text-muted" style="width: 100px;">Name</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Role</th>
                                <td>{{ ucfirst($user->role) }}</td>
                            </tr>
                        </table>

                        <!-- Tombol Edit -->
                        <a href="{{ route('profile.edit') }}" class="btn btn-danger">
                            <i class="bi bi-pencil-square me-1"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection