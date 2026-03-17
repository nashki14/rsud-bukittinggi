@extends('layouts.admin')
@section('title', 'Manajemen Testimoni')

@section('content')

<div style="display:flex;justify-content:flex-end;margin-bottom:1rem">
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">+ Tambah Testimoni</a>
</div>

@if($testimonials->count())
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1.25rem">
    @foreach($testimonials as $t)
    <div class="admin-card" style="border-left:4px solid var(--gold)">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:1rem;margin-bottom:.75rem">
            <div>
                <div style="font-weight:700;color:var(--navy);font-size:.9375rem">{{ $t->name }}</div>
                <div style="font-size:.8125rem;color:var(--gray-400);margin-top:.125rem">{{ $t->role ?? '—' }}</div>
                <div style="color:var(--gold);font-size:.9rem;margin-top:.25rem;letter-spacing:.1em">
                    {{ str_repeat('★', $t->rating ?? 5) }}{{ str_repeat('☆', 5 - ($t->rating ?? 5)) }}
                </div>
            </div>
            <span class="badge {{ $t->is_active ? 'badge-green' : 'badge-gray' }}">
                {{ $t->is_active ? 'Aktif' : 'Nonaktif' }}
            </span>
        </div>

        <p style="font-size:.875rem;color:var(--gray-600);font-style:italic;line-height:1.7;margin-bottom:1rem;padding:.75rem;background:var(--off-white);border-radius:var(--radius-sm)">
            "{{ Str::limit($t->content, 150) }}"
        </p>

        <div style="display:flex;gap:.5rem">
            <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-navy" style="padding:.375rem .875rem;font-size:.8rem">✏ Edit</a>
            <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" onsubmit="return confirm('Hapus testimoni dari {{ $t->name }}?')">
                @csrf @method('DELETE')
                <button class="btn" style="background:var(--red-soft);color:var(--red);padding:.375rem .875rem;font-size:.8rem;border:none;cursor:pointer">✕ Hapus</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="admin-card" style="text-align:center;padding:3rem">
    <div style="font-size:3rem;margin-bottom:1rem">💬</div>
    <p style="color:var(--gray-400)">Belum ada testimoni. Tambahkan testimoni pasien pertama Anda.</p>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary" style="margin-top:1.25rem">+ Tambah Testimoni</a>
</div>
@endif

@endsection
