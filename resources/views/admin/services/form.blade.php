@extends('layouts.admin')
@section('title', isset($service) ? 'Edit Layanan' : 'Tambah Layanan')

@section('content')
<div style="max-width:800px">
<div class="admin-card">
    <div class="admin-card-header">
        <h2>{{ isset($service) ? 'Edit Layanan' : 'Tambah Layanan Baru' }}</h2>
        <a href="{{ route('admin.services.index') }}" class="btn btn-navy" style="padding:.5rem 1rem;font-size:.8125rem">← Kembali</a>
    </div>

    <form method="POST" action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($service)) @method('PUT') @endif

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="admin-form-group">
                <label>Nama Layanan *</label>
                <input type="text" name="name" value="{{ old('name', $service->name ?? '') }}" required>
            </div>
            <div class="admin-form-group">
                <label>Ikon (emoji)</label>
                <input type="text" name="icon" value="{{ old('icon', $service->icon ?? '🏥') }}" placeholder="🏥">
                <div class="form-hint">Masukkan emoji atau teks singkat</div>
            </div>
        </div>

        <div class="admin-form-group">
            <label>Slug (URL) *</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $service->slug ?? '') }}" required>
            <div class="form-hint">Contoh: poli-jantung — Otomatis terisi dari nama</div>
        </div>

        <div class="admin-form-group">
            <label>Deskripsi Singkat</label>
            <textarea name="description" rows="3">{{ old('description', $service->description ?? '') }}</textarea>
        </div>

        <div class="admin-form-group">
            <label>Konten Lengkap (HTML diizinkan)</label>
            <textarea name="content" rows="10">{{ old('content', $service->content ?? '') }}</textarea>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:1rem">
            <div class="admin-form-group">
                <label>Gambar</label>
                @if(!empty($service->image ?? null))
                    <img src="{{ asset('storage/'.$service->image) }}" class="img-preview" alt="">
                @endif
                <input type="file" name="image" accept="image/*" style="margin-top:.5rem">
            </div>
            <div class="admin-form-group">
                <label>Urutan Tampil</label>
                <input type="number" name="order" value="{{ old('order', $service->order ?? 0) }}" min="0">
            </div>
            <div class="admin-form-group">
                <label>Status</label>
                <select name="is_active">
                    <option value="1" {{ (old('is_active', $service->is_active ?? 1)) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ (old('is_active', $service->is_active ?? 1)) == 0 ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
        </div>

        <div style="display:flex;gap:1rem;justify-content:flex-end;margin-top:1rem">
            <a href="{{ route('admin.services.index') }}" class="btn" style="background:var(--gray-100);color:var(--gray-800)">Batal</a>
            <button type="submit" class="btn btn-primary">💾 {{ isset($service) ? 'Perbarui' : 'Simpan' }} Layanan</button>
        </div>
    </form>
</div>
</div>

@push('scripts')
<script>
const nameInput = document.querySelector('input[name="name"]');
const slugInput = document.getElementById('slug');
nameInput.addEventListener('input', function() {
    if (!slugInput.dataset.manual) {
        slugInput.value = this.value
            .toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    }
});
slugInput.addEventListener('input', () => slugInput.dataset.manual = '1');
</script>
@endpush
@endsection
