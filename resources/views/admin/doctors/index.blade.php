{{-- resources/views/admin/doctors/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Manajemen Dokter')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h2>Daftar Dokter</h2>
        <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary">+ Tambah Dokter</a>
    </div>
    <table class="admin-table">
        <thead>
            <tr><th>Foto</th><th>Nama</th><th>Spesialisasi</th><th>Jadwal</th><th>Status</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @forelse($doctors as $doctor)
            <tr>
                <td>
                    @if($doctor->photo)
                        <img src="{{ asset('storage/'.$doctor->photo) }}" style="width:44px;height:44px;border-radius:50%;object-fit:cover" alt="">
                    @else
                        <div style="width:44px;height:44px;border-radius:50%;background:var(--navy);color:var(--gold);display:flex;align-items:center;justify-content:center;font-weight:700">{{ substr($doctor->name,0,1) }}</div>
                    @endif
                </td>
                <td><strong style="color:var(--navy)">{{ $doctor->name }}</strong></td>
                <td>{{ $doctor->specialty }}</td>
                <td style="font-size:.875rem">{{ $doctor->schedule }}</td>
                <td><span class="badge {{ $doctor->is_active ? 'badge-green' : 'badge-gray' }}">{{ $doctor->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                <td>
                    <div style="display:flex;gap:.5rem">
                        <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn btn-navy" style="padding:.375rem .875rem;font-size:.8rem">Edit</a>
                        <form method="POST" action="{{ route('admin.doctors.destroy', $doctor) }}" onsubmit="return confirm('Hapus dokter ini?')">
                            @csrf @method('DELETE')
                            <button class="btn" style="background:var(--red-soft);color:var(--red);padding:.375rem .875rem;font-size:.8rem">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:var(--gray-400);padding:2rem">Belum ada dokter.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
