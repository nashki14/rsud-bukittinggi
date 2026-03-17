{{-- resources/views/admin/news/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Manajemen Berita')
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h2>Berita & Artikel</h2>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">+ Tulis Artikel</a>
    </div>
    <table class="admin-table">
        <thead><tr><th>Gambar</th><th>Judul</th><th>Kategori</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($news as $article)
        <tr>
            <td>
                @if($article->image)
                    <img src="{{ asset('storage/'.$article->image) }}" style="width:60px;height:40px;border-radius:4px;object-fit:cover" alt="">
                @else
                    <div style="width:60px;height:40px;background:var(--off-white);border-radius:4px;display:flex;align-items:center;justify-content:center;font-size:1.25rem">📰</div>
                @endif
            </td>
            <td><strong style="color:var(--navy);font-size:.875rem">{{ Str::limit($article->title, 50) }}</strong></td>
            <td>{{ $article->category ?? '—' }}</td>
            <td style="font-size:.8125rem;color:var(--gray-400)">{{ $article->created_at->format('d M Y') }}</td>
            <td><span class="badge {{ $article->is_published ? 'badge-green' : 'badge-gold' }}">{{ $article->is_published ? 'Dipublikasikan' : 'Draft' }}</span></td>
            <td>
                <div style="display:flex;gap:.5rem">
                    <a href="{{ route('admin.news.edit', $article) }}" class="btn btn-navy" style="padding:.375rem .875rem;font-size:.8rem">Edit</a>
                    <form method="POST" action="{{ route('admin.news.destroy', $article) }}" onsubmit="return confirm('Hapus artikel ini?')">
                        @csrf @method('DELETE')
                        <button class="btn" style="background:var(--red-soft);color:var(--red);padding:.375rem .875rem;font-size:.8rem">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;color:var(--gray-400);padding:2rem">Belum ada artikel.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div style="padding:1rem">{{ $news->links() }}</div>
</div>
@endsection

{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
{{-- resources/views/admin/news/form.blade.php --}}
@extends('layouts.admin')
@section('title', isset($news) ? 'Edit Artikel' : 'Tulis Artikel')
@section('content')
<div style="max-width:900px">
<div class="admin-card">
    <div class="admin-card-header">
        <h2>{{ isset($news) ? 'Edit Artikel' : 'Tulis Artikel Baru' }}</h2>
        <a href="{{ route('admin.news.index') }}" class="btn btn-navy" style="padding:.5rem 1rem;font-size:.8125rem">← Kembali</a>
    </div>
    <form method="POST" action="{{ isset($news) ? route('admin.news.update', $news) : route('admin.news.store') }}" enctype="multipart/form-data">
        @csrf @if(isset($news)) @method('PUT') @endif

        <div style="display:grid;grid-template-columns:2fr 1fr;gap:1rem">
            <div class="admin-form-group">
                <label>Judul Artikel *</label>
                <input type="text" name="title" value="{{ old('title', $news->title ?? '') }}" required>
            </div>
            <div class="admin-form-group">
                <label>Kategori</label>
                <select name="category">
                    <option value="">— Pilih Kategori —</option>
                    @foreach(['Kesehatan','Tips Medis','Berita RS','Teknologi','Promosi'] as $cat)
                        <option value="{{ $cat }}" {{ (old('category', $news->category ?? '') === $cat) ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="admin-form-group">
            <label>Ringkasan (Excerpt)</label>
            <textarea name="excerpt" rows="2">{{ old('excerpt', $news->excerpt ?? '') }}</textarea>
        </div>

        <div class="admin-form-group">
            <label>Konten Artikel</label>
            <textarea name="content" rows="14" id="articleContent">{{ old('content', $news->content ?? '') }}</textarea>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="admin-form-group">
                <label>Gambar Featured</label>
                @if(!empty($news->image ?? null))
                    <img src="{{ asset('storage/'.$news->image) }}" style="width:100%;height:100px;object-fit:cover;border-radius:var(--radius-sm);margin-bottom:.5rem" alt="">
                @endif
                <input type="file" name="image" accept="image/*">
                <div class="form-hint">Ukuran optimal 1200×630px.</div>
            </div>
            <div class="admin-form-group">
                <label>Status Publikasi</label>
                <select name="is_published" style="height:46px">
                    <option value="1" {{ (old('is_published', $news->is_published ?? 0)) == 1 ? 'selected' : '' }}>✅ Publikasikan Sekarang</option>
                    <option value="0" {{ (old('is_published', $news->is_published ?? 0)) == 0 ? 'selected' : '' }}>📝 Simpan sebagai Draft</option>
                </select>
            </div>
        </div>

        <div style="display:flex;gap:1rem;justify-content:flex-end">
            <a href="{{ route('admin.news.index') }}" class="btn" style="background:var(--gray-100);color:var(--gray-800)">Batal</a>
            <button type="submit" class="btn btn-primary">💾 {{ isset($news) ? 'Perbarui' : 'Simpan' }} Artikel</button>
        </div>
    </form>
</div>
</div>
@endsection

{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
{{-- resources/views/admin/testimonials/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Manajemen Testimoni')
@section('content')
<div style="display:flex;justify-content:flex-end;margin-bottom:1rem">
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">+ Tambah Testimoni</a>
</div>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1.25rem">
    @forelse($testimonials as $t)
    <div class="admin-card" style="border-left:4px solid var(--gold)">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:1rem">
            <div>
                <div style="font-weight:700;color:var(--navy)">{{ $t->name }}</div>
                <div style="font-size:.8125rem;color:var(--gray-400);margin:.125rem 0">{{ $t->role }}</div>
                <div style="color:var(--gold);font-size:.875rem">{{ str_repeat('★', $t->rating ?? 5) }}</div>
            </div>
            <span class="badge {{ $t->is_active ? 'badge-green' : 'badge-gray' }}">{{ $t->is_active ? 'Aktif' : 'Nonaktif' }}</span>
        </div>
        <p style="font-size:.875rem;color:var(--gray-600);font-style:italic;margin:1rem 0">"{{ Str::limit($t->content, 120) }}"</p>
        <div style="display:flex;gap:.5rem">
            <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-navy" style="padding:.375rem .875rem;font-size:.8rem">Edit</a>
            <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" onsubmit="return confirm('Hapus testimoni?')">
                @csrf @method('DELETE')
                <button class="btn" style="background:var(--red-soft);color:var(--red);padding:.375rem .875rem;font-size:.8rem">Hapus</button>
            </form>
        </div>
    </div>
    @empty
    <div class="admin-card"><p style="color:var(--gray-400)">Belum ada testimoni.</p></div>
    @endforelse
</div>
@endsection

{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
{{-- resources/views/admin/testimonials/form.blade.php --}}
@extends('layouts.admin')
@section('title', isset($testimonial) ? 'Edit Testimoni' : 'Tambah Testimoni')
@section('content')
<div style="max-width:600px">
<div class="admin-card">
    <div class="admin-card-header">
        <h2>{{ isset($testimonial) ? 'Edit Testimoni' : 'Tambah Testimoni' }}</h2>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-navy" style="padding:.5rem 1rem;font-size:.8125rem">← Kembali</a>
    </div>
    <form method="POST" action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}">
        @csrf @if(isset($testimonial)) @method('PUT') @endif

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="admin-form-group">
                <label>Nama Pasien *</label>
                <input type="text" name="name" value="{{ old('name', $testimonial->name ?? '') }}" required>
            </div>
            <div class="admin-form-group">
                <label>Keterangan (Peran/Poli)</label>
                <input type="text" name="role" value="{{ old('role', $testimonial->role ?? '') }}" placeholder="Pasien Poli Jantung">
            </div>
        </div>

        <div class="admin-form-group">
            <label>Isi Testimoni *</label>
            <textarea name="content" rows="5" required>{{ old('content', $testimonial->content ?? '') }}</textarea>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="admin-form-group">
                <label>Rating</label>
                <select name="rating">
                    @for($i=5;$i>=1;$i--)
                        <option value="{{ $i }}" {{ (old('rating', $testimonial->rating ?? 5) == $i) ? 'selected' : '' }}>{{ str_repeat('★',$i) }} ({{ $i }})</option>
                    @endfor
                </select>
            </div>
            <div class="admin-form-group">
                <label>Status</label>
                <select name="is_active">
                    <option value="1" {{ (old('is_active', $testimonial->is_active ?? 1)) == 1 ? 'selected' : '' }}>Aktif (Ditampilkan)</option>
                    <option value="0" {{ (old('is_active', $testimonial->is_active ?? 1)) == 0 ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
        </div>

        <div style="display:flex;gap:1rem;justify-content:flex-end">
            <a href="{{ route('admin.testimonials.index') }}" class="btn" style="background:var(--gray-100);color:var(--gray-800)">Batal</a>
            <button type="submit" class="btn btn-primary">💾 Simpan Testimoni</button>
        </div>
    </form>
</div>
</div>
@endsection
