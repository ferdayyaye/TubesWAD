@extends('layouts.app')

@section('content')
    @php
        \Carbon\Carbon::setLocale('id');
    @endphp
    <div class="container">
        <h1 class="text-center mt-5 mb-4 font-weight-bold">Edit Jadwal</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Waktu Mulai</label>
                        <div class="col-sm-9 pt-2">
                            {{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Waktu Selesai</label>
                        <div class="col-sm-9 pt-2">
                            {{ \Carbon\Carbon::parse($jadwal->selesai)->format('H:i') }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Tujuan</label>
                        <div class="col-sm-9 pt-2">
                            {{ $jadwal->tujuan }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label font-weight-bold">Status</label>
                        <div class="col-sm-9">
                            <select name="status" id="status" class="form-control">
                                <option value="Pending" {{ $jadwal->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Ditolak" {{ $jadwal->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                <option value="Diterima" {{ $jadwal->status === 'Diterima' ? 'selected' : '' }}>Diterima</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-danger">Update Jadwal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
