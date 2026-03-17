@extends('layouts.admin')
@section('title', isset($news) ? 'Edit Artikel' : 'Tulis Artikel Baru')

@section('content')
<div style="max-width:900px">
<div class="admin-card">
    <div class="admin-card-header">
        <h2>{{ isset($news) ? 'Edit Artikel' : 'Tulis Artikel Baru' }}</h2>
        <a href="{{ route('admin.news.index') }}" class="btn btn-navy" style="padding:.5rem 1rem;font-size:.8125rem">← Kembali</a>
    </div>

    <form method="POST"
          action="{{ isset($news) ? route('admin.news.update', $news) : route('admin.news.store') }}"
          enctype="multipart/form-data">
        @csrf
        @if(isset($news)) @method('PUT') @endif

        {{-- Judul & Kategori --}}
        <div style="display:grid;grid-template-columns:2fr 1fr;gap:1rem">
            <div class="admin-form-group">
                <label>Judul Artikel *</label>
                <input type="text" name="title" value="{{ old('title', $news->title ?? '') }}"
                       required placeholder="Tulis judul artikel yang menarik...">
                @error('title')<span style="color:var(--red);font-size:.8rem">{{ $message }}</span>@enderror
            </div>
            <div class="admin-form-group">
                <label>Kategori</label>
                <select name="category">
                    <option value="">— Pilih Kategori —</option>
                    @foreach(['Kesehatan', 'Tips Medis', 'Berita RS', 'Teknologi Medis', 'Promosi', 'Edukasi'] as $cat)
                        <option value="{{ $cat }}"
                            {{ old('category', $news->category ?? '') === $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Ringkasan --}}
        <div class="admin-form-group">
            <label>Ringkasan Artikel (Excerpt)</label>
            <textarea name="excerpt" rows="2"
                      placeholder="Ringkasan singkat yang tampil di daftar berita...">{{ old('excerpt', $news->excerpt ?? '') }}</textarea>
            <div class="form-hint">Maksimal 300 karakter. Tampil di card berita dan meta description.</div>
        </div>

        {{-- Konten --}}
        <div class="admin-form-group">
            <label>Konten Artikel *</label>
            <textarea name="content" rows="16" id="articleContent"
                      placeholder="Tulis konten artikel lengkap di sini... HTML diizinkan.">{{ old('content', $news->content ?? '') }}</textarea>
            <div class="form-hint">HTML dasar diizinkan: &lt;p&gt;, &lt;strong&gt;, &lt;em&gt;, &lt;ul&gt;, &lt;li&gt;, &lt;h3&gt;, &lt;h4&gt;</div>
        </div>

        {{-- Gambar & Status --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
            <div class="admin-form-group">
                <label>Gambar Featured</label>
                @if(!empty($news->image ?? null))
                    <div style="margin-bottom:.75rem">
                        <img src="{{ asset('storage/'.$news->image) }}"
                             style="width:100%;height:120px;object-fit:cover;border-radius:var(--radius-sm);border:2px solid var(--gray-200)"
                             alt="Current image" id="imgPreview">
                    </div>
                @else
                    <div id="imgPreviewWrap" style="width:100%;height:120px;background:var(--off-white);border-radius:var(--radius-sm);border:2px dashed var(--gray-200);display:flex;align-items:center;justify-content:center;margin-bottom:.75rem;color:var(--gray-400);font-size:.8125rem">
                        Preview gambar
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" id="imageInput">
                <div class="form-hint">JPG/PNG/WebP. Ukuran optimal 1200×630px. Maks 5MB.</div>
            </div>

            <div>
                <div class="admin-form-group">
                    <label>Status Publikasi</label>
                    <select name="is_published">
                        <option value="1" {{ old('is_published', $news->is_published ?? 0) == 1 ? 'selected' : '' }}>
                            ✅ Publikasikan Sekarang
                        </option>
                        <option value="0" {{ old('is_published', $news->is_published ?? 0) == 0 ? 'selected' : '' }}>
                            📝 Simpan sebagai Draft
                        </option>
                    </select>
                    <div class="form-hint">Draft tidak tampil di website publik.</div>
                </div>

                @if(isset($news))
                <div style="background:var(--off-white);border-radius:var(--radius-sm);padding:1rem;font-size:.8125rem;color:var(--gray-600)">
                    <div><strong>Slug:</strong> <code>{{ $news->slug }}</code></div>
                    <div style="margin-top:.375rem"><strong>Dibuat:</strong> {{ $news->created_at->format('d M Y H:i') }}</div>
                    <div style="margin-top:.375rem"><strong>Diperbarui:</strong> {{ $news->updated_at->format('d M Y H:i') }}</div>
                </div>
                @endif
            </div>
        </div>

        {{-- Actions --}}
        <div style="display:flex;gap:1rem;justify-content:flex-end;margin-top:.5rem;padding-top:1rem;border-top:1px solid var(--gray-100)">
            <a href="{{ route('admin.news.index') }}"
               class="btn" style="background:var(--gray-100);color:var(--gray-800)">Batal</a>
            <button type="submit" name="is_published" value="0"
                    class="btn btn-navy" style="font-size:.9rem">
                💾 Simpan Draft
            </button>
            <button type="submit"
                    class="btn btn-primary" style="font-size:.9rem">
                🚀 {{ isset($news) ? 'Perbarui' : 'Publikasikan' }} Artikel
            </button>
        </div>
    </form>
</div>
</div>

@push('scripts')
<script>
// Image preview
document.getElementById('imageInput')?.addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        const wrap = document.getElementById('imgPreviewWrap');
        if (wrap) {
            wrap.innerHTML = `<img src="${e.target.result}" style="width:100%;height:120px;object-fit:cover;border-radius:var(--radius-sm)">`;
        }
        const existing = document.getElementById('imgPreview');
        if (existing) existing.src = e.target.result;
    };
    reader.readAsDataURL(file);
});
</script>
@endpush
@endsection
