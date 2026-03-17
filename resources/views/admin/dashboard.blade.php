@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

<div class="stats-grid">
    <div class="stat-widget">
        <div class="stat-widget-icon navy">👨‍⚕️</div>
        <div>
            <div class="stat-widget-num">{{ $doctorCount }}</div>
            <div class="stat-widget-label">Total Dokter</div>
        </div>
    </div>
    <div class="stat-widget">
        <div class="stat-widget-icon gold">🏥</div>
        <div>
            <div class="stat-widget-num">{{ $serviceCount }}</div>
            <div class="stat-widget-label">Layanan Aktif</div>
        </div>
    </div>
    <div class="stat-widget">
        <div class="stat-widget-icon green">📰</div>
        <div>
            <div class="stat-widget-num">{{ $newsCount }}</div>
            <div class="stat-widget-label">Total Artikel</div>
        </div>
    </div>
    <div class="stat-widget">
        <div class="stat-widget-icon red">📨</div>
        <div>
            <div class="stat-widget-num">{{ $contactCount }}</div>
            <div class="stat-widget-label">Pesan Masuk</div>
        </div>
    </div>
</div>

<div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem">

    <!-- Recent Contacts -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h2>Pesan Terbaru</h2>
            <a href="{{ route('admin.contacts') }}" class="btn btn-navy" style="padding:.5rem 1rem;font-size:.8125rem">Lihat Semua</a>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Layanan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentContacts as $contact)
                <tr>
                    <td>
                        <strong style="color:var(--navy);font-size:.875rem">{{ $contact->name }}</strong><br>
                        <span style="font-size:.8rem;color:var(--gray-400)">{{ $contact->email }}</span>
                    </td>
                    <td>{{ $contact->service ?? '—' }}</td>
                    <td>{{ $contact->created_at->format('d M Y') }}</td>
                    <td><span class="badge {{ $contact->status === 'read' ? 'badge-green' : 'badge-gold' }}">{{ $contact->status === 'read' ? 'Dibaca' : 'Baru' }}</span></td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center;color:var(--gray-400);padding:2rem">Belum ada pesan masuk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Quick Links -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h2>Aksi Cepat</h2>
        </div>
        <div style="display:flex;flex-direction:column;gap:.75rem">
            <a href="{{ route('admin.services.create') }}" class="btn btn-navy" style="justify-content:center">+ Tambah Layanan</a>
            <a href="{{ route('admin.doctors.create') }}" class="btn btn-navy" style="justify-content:center">+ Tambah Dokter</a>
            <a href="{{ route('admin.news.create') }}" class="btn btn-navy" style="justify-content:center">+ Tulis Artikel</a>
            <a href="{{ route('admin.settings') }}" class="btn btn-primary" style="justify-content:center">⚙ Pengaturan Website</a>
            <a href="{{ route('home') }}" target="_blank" class="btn" style="background:var(--off-white);color:var(--navy);justify-content:center">🌐 Lihat Website</a>
        </div>
    </div>

</div>
@endsection
