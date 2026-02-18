@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Tambah Sensor Baru</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('sensors.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="sensor_name" class="form-label">Nama Sensor</label>
                <input type="text" class="form-control @error('sensor_name') is-invalid @enderror" 
                       id="sensor_name" name="sensor_name" value="{{ old('sensor_name') }}" required>
                @error('sensor_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="sensor_type" class="form-label">Tipe Sensor</label>
                <input type="text" class="form-control @error('sensor_type') is-invalid @enderror" 
                       id="sensor_type" name="sensor_type" value="{{ old('sensor_type') }}" required>
                @error('sensor_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="value" class="form-label">Nilai</label>
                <input type="number" step="0.01" class="form-control @error('value') is-invalid @enderror" 
                       id="value" name="value" value="{{ old('value') }}" required>
                @error('value')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="unit" class="form-label">Unit</label>
                <input type="text" class="form-control @error('unit') is-invalid @enderror" 
                       id="unit" name="unit" value="{{ old('unit') }}" required>
                @error('unit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Lokasi (Opsional)</label>
                <input type="text" class="form-control @error('location') is-invalid @enderror" 
                       id="location" name="location" value="{{ old('location') }}">
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="status" name="status" value="1" checked>
                <label class="form-check-label" for="status">Status Aktif</label>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('sensors.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection