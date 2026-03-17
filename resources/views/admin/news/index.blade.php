@extends('layouts.admin')
@section('title', 'Manajemen Berita')

@section('content')

<div class="admin-card">
    <div class="admin-card-header">
        <h2>📰 Berita & Artikel</h2>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">+ Tulis Artikel</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($news as $article)
        <tr>
            <td>
                @if($article->image)
                    <img src="{{ asset('storage/'.$article->image) }}"
                         style="width:64px;height:44px;border-radius:6px;object-fit:cover" alt="">
                @else
                    <div style="width:64px;height:44px;background:var(--off-white);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:1.25rem">
                        📰
                    </div>
                @endif
            </td>
            <td>
                <strong style="color:var(--navy);font-size:.875rem;display:block">
                    {{ Str::limit($article->title, 55) }}
                </strong>
                @if($article->excerpt)
                <span style="font-size:.8rem;color:var(--gray-400)">{{ Str::limit($article->excerpt, 60) }}</span>
                @endif
            </td>
            <td>
                @if($article->category)
                    <span class="badge badge-gold">{{ $article->category }}</span>
                @else
                    <span style="color:var(--gray-400);font-size:.875rem">—</span>
                @endif
            </td>
            <td style="font-size:.8125rem;color:var(--gray-400);white-space:nowrap">
                {{ $article->created_at->format('d M Y') }}
            </td>
            <td>
                <span class="badge {{ $article->is_published ? 'badge-green' : 'badge-gray' }}">
                    {{ $article->is_published ? '✓ Dipublikasi' : '📝 Draft' }}
                </span>
            </td>
            <td>
                <div style="display:flex;gap:.5rem">
                    <a href="{{ route('news.show', $article->slug) }}" target="_blank"
                       class="btn" style="padding:.375rem .75rem;font-size:.75rem;background:var(--off-white);color:var(--gray-800)">
                        👁 Lihat
                    </a>
                    <a href="{{ route('admin.news.edit', $article) }}"
                       class="btn btn-navy" style="padding:.375rem .875rem;font-size:.8rem">
                        ✏ Edit
                    </a>
                    <form method="POST" action="{{ route('admin.news.destroy', $article) }}"
                          onsubmit="return confirm('Hapus artikel ini?')">
                        @csrf @method('DELETE')
                        <button class="btn" style="background:var(--red-soft);color:var(--red);padding:.375rem .875rem;font-size:.8rem;border:none;cursor:pointer">
                            ✕
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align:center;padding:3rem;color:var(--gray-400)">
                <div style="font-size:2.5rem;margin-bottom:.75rem">📰</div>
                Belum ada artikel. Mulai tulis artikel pertama Anda.
            </td>
        </tr>
        @endforelse
        </tbody>
    </table>

    @if($news->hasPages())
    <div style="padding:1rem;border-top:1px solid var(--gray-100)">
        {{ $news->links() }}
    </div>
    @endif
</div>

@endsection
