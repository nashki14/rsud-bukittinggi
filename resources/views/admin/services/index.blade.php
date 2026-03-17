{{-- resources/views/admin/services/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Manajemen Layanan')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h2>Daftar Layanan</h2>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">+ Tambah Layanan</a>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Ikon</th><th>Nama</th><th>Slug</th><th>Status</th><th>Urutan</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
            <tr>
                <td style="font-size:1.5rem">{{ $service->icon ?? '🏥' }}</td>
                <td><strong style="color:var(--navy)">{{ $service->name }}</strong></td>
                <td><code style="font-size:.8rem;color:var(--gray-400)">{{ $service->slug }}</code></td>
                <td>
                    <span class="badge {{ $service->is_active ? 'badge-green' : 'badge-gray' }}">
                        {{ $service->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td>{{ $service->order ?? 0 }}</td>
                <td>
                    <div style="display:flex;gap:.5rem">
                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-navy" style="padding:.375rem .875rem;font-size:.8rem">Edit</a>
                        <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Hapus layanan ini?')">
                            @csrf @method('DELETE')
                            <button class="btn" style="background:var(--red-soft);color:var(--red);padding:.375rem .875rem;font-size:.8rem">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:var(--gray-400);padding:2rem">Belum ada layanan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
