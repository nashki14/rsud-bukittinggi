@extends('layouts.admin')
@section('title', 'Pesan Masuk')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h2>Pesan & Permintaan Janji Temu</h2>
        <span class="badge badge-gold">{{ $contacts->total() }} Total</span>
    </div>
    <table class="admin-table">
        <thead>
            <tr><th>Nama</th><th>Kontak</th><th>Layanan</th><th>Pesan</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        @forelse($contacts as $contact)
        <tr>
            <td><strong style="color:var(--navy)">{{ $contact->name }}</strong></td>
            <td>
                <div style="font-size:.8125rem">{{ $contact->email }}</div>
                <div style="font-size:.8rem;color:var(--gray-400)">{{ $contact->phone }}</div>
            </td>
            <td style="font-size:.875rem">{{ $contact->service ?? '—' }}</td>
            <td style="max-width:250px;font-size:.8125rem;color:var(--gray-600)">{{ Str::limit($contact->message, 80) }}</td>
            <td style="font-size:.8125rem;color:var(--gray-400)">{{ $contact->created_at->format('d M Y H:i') }}</td>
            <td>
                <span class="badge {{ $contact->status === 'read' ? 'badge-green' : 'badge-gold' }}">
                    {{ $contact->status === 'read' ? 'Dibaca' : 'Baru' }}
                </span>
            </td>
            <td>
                <div style="display:flex;gap:.375rem">
                    @if($contact->status !== 'read')
                    <form method="POST" action="{{ route('admin.contacts.read', $contact) }}">
                        @csrf @method('PATCH')
                        <button class="btn badge-green btn" style="padding:.375rem .75rem;font-size:.75rem;background:var(--green-soft);color:var(--green);border:none;border-radius:4px;cursor:pointer">✓ Tandai Dibaca</button>
                    </form>
                    @endif
                    <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" onsubmit="return confirm('Hapus pesan ini?')">
                        @csrf @method('DELETE')
                        <button class="btn" style="background:var(--red-soft);color:var(--red);padding:.375rem .75rem;font-size:.75rem">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center;color:var(--gray-400);padding:2rem">Belum ada pesan masuk.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div style="padding:1rem">{{ $contacts->links() }}</div>
</div>
@endsection
