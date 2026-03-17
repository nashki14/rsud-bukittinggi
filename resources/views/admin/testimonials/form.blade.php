@extends('layouts.admin')
@section('title', isset($testimonial) ? 'Edit Testimoni' : 'Tambah Testimoni')

@section('content')
<div style="max-width:600px">
<div class="admin-card">
    <div class="admin-card-header">
        <h2>{{ isset($testimonial) ? 'Edit Testimoni' : 'Tambah Testimoni Baru' }}</h2>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-navy" style="padding:.5rem 1rem;font-size:.8125rem">← Kembali</a>
    </div>

    <form method="POST" action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}">
        @csrf
        @if(isset($testimonial)) @method('PUT') @endif

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="admin-form-group">
                <label>Nama Pasien *</label>
                <input type="text" name="name" value="{{ old('name', $testimonial->name ?? '') }}" required placeholder="Nama lengkap pasien">
                @error('name')<span style="color:var(--red);font-size:.8rem">{{ $message }}</span>@enderror
            </div>
            <div class="admin-form-group">
                <label>Keterangan</label>
                <input type="text" name="role" value="{{ old('role', $testimonial->role ?? '') }}" placeholder="Pasien Poli Jantung">
                <div class="form-hint">Contoh: Pasien Poli Anak, Ibu dari Pasien</div>
            </div>
        </div>

        <div class="admin-form-group">
            <label>Isi Testimoni *</label>
            <textarea name="content" rows="5" required placeholder="Cerita pengalaman pasien...">{{ old('content', $testimonial->content ?? '') }}</textarea>
            <div class="form-hint">Maksimal 500 karakter. Saat ini: <span id="charCount">{{ strlen($testimonial->content ?? '') }}</span>/500</div>
            @error('content')<span style="color:var(--red);font-size:.8rem">{{ $message }}</span>@enderror
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="admin-form-group">
                <label>Rating</label>
                <div style="display:flex;gap:.5rem;margin-top:.375rem" id="starRating">
                    @for($i=1; $i<=5; $i++)
                    <label style="cursor:pointer;font-size:1.5rem;color:{{ ($testimonial->rating ?? 5) >= $i ? '#c9a84c' : '#e2e1e4' }}" data-star="{{ $i }}">
                        ★
                        <input type="radio" name="rating" value="{{ $i }}" style="display:none"
                               {{ old('rating', $testimonial->rating ?? 5) == $i ? 'checked' : '' }}>
                    </label>
                    @endfor
                </div>
            </div>
            <div class="admin-form-group">
                <label>Status Tampil</label>
                <select name="is_active">
                    <option value="1" {{ (old('is_active', $testimonial->is_active ?? 1)) == 1 ? 'selected' : '' }}>✅ Aktif (Ditampilkan)</option>
                    <option value="0" {{ (old('is_active', $testimonial->is_active ?? 1)) == 0 ? 'selected' : '' }}>🚫 Nonaktif (Disembunyikan)</option>
                </select>
            </div>
        </div>

        <div style="display:flex;gap:1rem;justify-content:flex-end;margin-top:.5rem">
            <a href="{{ route('admin.testimonials.index') }}" class="btn" style="background:var(--gray-100);color:var(--gray-800)">Batal</a>
            <button type="submit" class="btn btn-primary">
                💾 {{ isset($testimonial) ? 'Perbarui' : 'Simpan' }} Testimoni
            </button>
        </div>
    </form>
</div>
</div>

@push('scripts')
<script>
// Character counter
const textarea = document.querySelector('textarea[name="content"]');
const charCount = document.getElementById('charCount');
textarea.addEventListener('input', () => {
    charCount.textContent = textarea.value.length;
    charCount.style.color = textarea.value.length > 450 ? 'var(--red)' : 'inherit';
});

// Star rating
const stars = document.querySelectorAll('#starRating label');
stars.forEach((star, idx) => {
    star.addEventListener('click', () => {
        star.querySelector('input').checked = true;
        stars.forEach((s, i) => {
            s.style.color = i <= idx ? '#c9a84c' : '#e2e1e4';
        });
    });
    star.addEventListener('mouseover', () => {
        stars.forEach((s, i) => {
            s.style.color = i <= idx ? '#c9a84c' : '#e2e1e4';
        });
    });
});
document.getElementById('starRating').addEventListener('mouseleave', () => {
    const checked = document.querySelector('#starRating input:checked');
    const checkedIdx = checked ? parseInt(checked.value) - 1 : 4;
    stars.forEach((s, i) => {
        s.style.color = i <= checkedIdx ? '#c9a84c' : '#e2e1e4';
    });
});
</script>
@endpush
@endsection
