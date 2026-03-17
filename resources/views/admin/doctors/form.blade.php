@extends('layouts.admin')
@section('title', isset($doctor) ? 'Edit Dokter' : 'Tambah Dokter')

@section('content')
<div style="max-width:700px">
<div class="admin-card">
    <div class="admin-card-header">
        <h2>{{ isset($doctor) ? 'Edit Profil Dokter' : 'Tambah Dokter Baru' }}</h2>
        <a href="{{ route('admin.doctors.index') }}" class="btn btn-navy" style="padding:.5rem 1rem;font-size:.8125rem">← Kembali</a>
    </div>
    <form method="POST" action="{{ isset($doctor) ? route('admin.doctors.update', $doctor) : route('admin.doctors.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($doctor)) @method('PUT') @endif

        <div style="display:flex;gap:1.5rem;align-items:flex-start;margin-bottom:1.5rem">
            <div id="photoPreviewWrap">
                @if(!empty($doctor->photo ?? null))
                    <img id="photoPreview" src="{{ asset('storage/'.$doctor->photo) }}" style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:3px solid var(--gold)">
                @else
                    <div id="photoPreview" style="width:100px;height:100px;border-radius:50%;background:var(--navy);display:flex;align-items:center;justify-content:center;font-size:2.5rem;color:rgba(201,168,76,.5)">👨‍⚕️</div>
                @endif
            </div>
            <div style="flex:1">
                <div class="admin-form-group" style="margin-bottom:0">
                    <label>Foto Dokter</label>
                    <input type="file" name="photo" accept="image/*" id="photoInput">
                    <div class="form-hint">JPG/PNG, maks 2MB. Ukuran persegi direkomendasikan.</div>
                </div>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="admin-form-group">
                <label>Nama Lengkap + Gelar *</label>
                <input type="text" name="name" value="{{ old('name', $doctor->name ?? '') }}" placeholder="dr. Budi Santoso, Sp.PD" required>
            </div>
            <div class="admin-form-group">
                <label>Spesialisasi *</label>
                <input type="text" name="specialty" value="{{ old('specialty', $doctor->specialty ?? '') }}" placeholder="Spesialis Penyakit Dalam" required>
            </div>
            <div class="admin-form-group">
                <label>Jadwal Praktik</label>
                <input type="text" name="schedule" value="{{ old('schedule', $doctor->schedule ?? '') }}" placeholder="Senin – Jumat, 09.00 – 14.00">
            </div>
            <div class="admin-form-group">
                <label>Pendidikan / Institusi</label>
                <input type="text" name="education" value="{{ old('education', $doctor->education ?? '') }}" placeholder="FKUI, Universitas Indonesia">
            </div>
            <div class="admin-form-group">
                <label>Nomor SIP</label>
                <input type="text" name="sip" value="{{ old('sip', $doctor->sip ?? '') }}">
            </div>
            <div class="admin-form-group">
                <label>Status</label>
                <select name="is_active">
                    <option value="1" {{ (old('is_active', $doctor->is_active ?? 1)) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ (old('is_active', $doctor->is_active ?? 1)) == 0 ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
        </div>

        <div class="admin-form-group">
            <label>Biografi Singkat</label>
            <textarea name="bio" rows="4">{{ old('bio', $doctor->bio ?? '') }}</textarea>
        </div>

        <div style="display:flex;gap:1rem;justify-content:flex-end">
            <a href="{{ route('admin.doctors.index') }}" class="btn" style="background:var(--gray-100);color:var(--gray-800)">Batal</a>
            <button type="submit" class="btn btn-primary">💾 {{ isset($doctor) ? 'Perbarui' : 'Simpan' }} Dokter</button>
        </div>
    </form>
</div>
</div>
@push('scripts')
<script>
document.getElementById('photoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = ev => {
            const wrap = document.getElementById('photoPreviewWrap');
            wrap.innerHTML = `<img src="${ev.target.result}" style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:3px solid var(--gold)">`;
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection
