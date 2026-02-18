@extends('layouts.app')
<div class="mb-3">
    <form action="{{ route('sensors.index') }}" method="GET">
        <div style="display: flex; gap: 10px;">
            <input type="text" name="search" class="form-control" 
                placeholder="Cari nama, tipe, atau lokasi sensor..." 
                value="{{ request('search') }}">

            <button type="submit" class="btn btn-primary">
                Cari
            </button>

            <a href="{{ route('sensors.index') }}" class="btn btn-secondary">
                Reset
            </a>
        </div>
    </form>
</div>

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Daftar Sensor</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Sensor</th>
                    <th>Tipe</th>
                    <th>Nilai</th>
                    <th>Unit</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sensors as $sensor)
                <tr>
                    <td>{{ $sensor->id }}</td>
                    <td>{{ $sensor->sensor_name }}</td>
                    <td>{{ $sensor->sensor_type }}</td>
                    <td>{{ $sensor->value }}</td>
                    <td>{{ $sensor->unit }}</td>
                    <td>{{ $sensor->location ?? '-' }}</td>
                    <td>
                        @if($sensor->status)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('sensors.show', $sensor->id) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('sensors.edit', $sensor->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('sensors.destroy', $sensor->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $sensors->links() }}
    </div>
</div>
@endsection