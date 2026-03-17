@extends('layouts.admin')
@section('title', 'Pengaturan Umum')

@section('content')

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
@csrf @method('PUT')

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">

    <!-- Identitas Rumah Sakit -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h2>🏥 Identitas Rumah Sakit</h2>
        </div>
        <div class="admin-form-group">
            <label>Nama Rumah Sakit</label>
            <input type="text" name="hospital_name" value="{{ old('hospital_name', $settings['hospital_name'] ?? '') }}" required>
        </div>
        <div class="admin-form-group">
            <label>Tagline</label>
            <input type="text" name="tagline" value="{{ old('tagline', $settings['tagline'] ?? '') }}" placeholder="Kesehatan Anda, Prioritas Kami">
        </div>
        <div class="admin-form-group">
            <label>Logo</label>
            @if(!empty($settings['logo']))
                <div style="margin-bottom:.75rem">
                    <img src="{{ asset('storage/'.$settings['logo']) }}" class="img-preview" alt="Logo">
                </div>
            @endif
            <input type="file" name="logo" accept="image/*">
            <div class="form-hint">PNG/SVG transparan direkomendasikan. Maks 2MB.</div>
        </div>
        <div class="admin-form-group">
            <label>Deskripsi Footer</label>
            <textarea name="footer_desc">{{ old('footer_desc', $settings['footer_desc'] ?? '') }}</textarea>
        </div>
    </div>

    <!-- Kontak -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h2>📞 Kontak & Lokasi</h2>
        </div>
        <div class="admin-form-group">
            <label>Nomor Telepon Utama</label>
            <input type="text" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}" placeholder="(021) 1234-5678">
        </div>
        <div class="admin-form-group">
            <label>Nomor UGD / Darurat</label>
            <input type="text" name="emergency_phone" value="{{ old('emergency_phone', $settings['emergency_phone'] ?? '') }}" placeholder="119">
        </div>
        <div class="admin-form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $settings['email'] ?? '') }}">
        </div>
        <div class="admin-form-group">
            <label>Alamat Lengkap</label>
            <textarea name="address" rows="3">{{ old('address', $settings['address'] ?? '') }}</textarea>
        </div>
        <div class="admin-form-group">
            <label>Jam Operasional</label>
            <textarea name="hours" rows="4" placeholder="Senin – Jumat: 08.00 – 20.00&#10;Sabtu – Minggu: 08.00 – 17.00&#10;UGD: 24 Jam">{{ old('hours', $settings['hours'] ?? '') }}</textarea>
        </div>
    </div>

    <!-- Statistik Hero -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h2>📊 Statistik (Hero)</h2>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="admin-form-group">
                <label>Jumlah Dokter</label>
                <input type="text" name="stat_doctors" value="{{ old('stat_doctors', $settings['stat_doctors'] ?? '150+') }}">
            </div>
            <div class="admin-form-group">
                <label>Pasien / Tahun</label>
                <input type="text" name="stat_patients" value="{{ old('stat_patients', $settings['stat_patients'] ?? '50K+') }}">
            </div>
            <div class="admin-form-group">
                <label>Tahun Pengalaman</label>
                <input type="text" name="stat_years" value="{{ old('stat_years', $settings['stat_years'] ?? '25+') }}">
            </div>
            <div class="admin-form-group">
                <label>Kepuasan Pasien</label>
                <input type="text" name="stat_satisfaction" value="{{ old('stat_satisfaction', $settings['stat_satisfaction'] ?? '98%') }}">
            </div>
        </div>
    </div>

    <!-- Media Sosial -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h2>📱 Media Sosial</h2>
        </div>
        <div class="admin-form-group">
            <label>Facebook URL</label>
            <input type="url" name="facebook" value="{{ old('facebook', $settings['facebook'] ?? '') }}" placeholder="https://facebook.com/...">
        </div>
        <div class="admin-form-group">
            <label>Instagram URL</label>
            <input type="url" name="instagram" value="{{ old('instagram', $settings['instagram'] ?? '') }}" placeholder="https://instagram.com/...">
        </div>
        <div class="admin-form-group">
            <label>YouTube URL</label>
            <input type="url" name="youtube" value="{{ old('youtube', $settings['youtube'] ?? '') }}" placeholder="https://youtube.com/...">
        </div>
        <div class="admin-form-group">
            <label>Link Buat Janji</label>
            <input type="text" name="appointment_link" value="{{ old('appointment_link', $settings['appointment_link'] ?? '#appointment') }}">
            <div class="form-hint">Bisa berupa URL eksternal atau anchor (#appointment)</div>
        </div>
    </div>

    <!-- Hero & About -->
    <div class="admin-card" style="grid-column:1/-1">
        <div class="admin-card-header">
            <h2>🖼️ Hero & Tentang Kami</h2>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
            <div>
                <div class="admin-form-group">
                    <label>Judul Hero (HTML diizinkan)</label>
                    <textarea name="hero_title" rows="3">{{ old('hero_title', $settings['hero_title'] ?? 'Layanan Kesehatan<br><em>Terpercaya & Terdepan</em>') }}</textarea>
                    <div class="form-hint">Gunakan &lt;em&gt; untuk teks berwarna emas. &lt;br&gt; untuk baris baru.</div>
                </div>
                <div class="admin-form-group">
                    <label>Subjudul Hero</label>
                    <textarea name="hero_subtitle" rows="3">{{ old('hero_subtitle', $settings['hero_subtitle'] ?? '') }}</textarea>
                </div>
                <div class="admin-form-group">
                    <label>Gambar Latar Hero</label>
                    @if(!empty($settings['hero_image']))
                        <div style="margin-bottom:.75rem">
                            <img src="{{ asset('storage/'.$settings['hero_image']) }}" class="img-preview" style="width:100%;height:100px;object-fit:cover" alt="Hero">
                        </div>
                    @endif
                    <input type="file" name="hero_image" accept="image/*">
                    <div class="form-hint">Ukuran optimal 1920×1080px. Maks 5MB.</div>
                </div>
            </div>
            <div>
                <div class="admin-form-group">
                    <label>Judul Tentang Kami</label>
                    <input type="text" name="about_title" value="{{ old('about_title', $settings['about_title'] ?? '') }}">
                </div>
                <div class="admin-form-group">
                    <label>Teks Tentang Kami (paragraf 1)</label>
                    <textarea name="about_text_1" rows="4">{{ old('about_text_1', $settings['about_text_1'] ?? '') }}</textarea>
                </div>
                <div class="admin-form-group">
                    <label>Teks Tentang Kami (paragraf 2)</label>
                    <textarea name="about_text_2" rows="4">{{ old('about_text_2', $settings['about_text_2'] ?? '') }}</textarea>
                </div>
                <div class="admin-form-group">
                    <label>Foto Tentang Kami</label>
                    @if(!empty($settings['about_image']))
                        <img src="{{ asset('storage/'.$settings['about_image']) }}" class="img-preview" alt="About">
                    @endif
                    <input type="file" name="about_image" accept="image/*">
                </div>
            </div>
        </div>

        <!-- CTA Banner -->
        <div style="border-top:1px solid var(--gray-100);margin-top:1.25rem;padding-top:1.25rem">
            <h3 style="font-size:1rem;color:var(--navy);margin-bottom:1rem">Banner CTA (Call to Action)</h3>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
                <div class="admin-form-group">
                    <label>Judul CTA</label>
                    <input type="text" name="cta_title" value="{{ old('cta_title', $settings['cta_title'] ?? 'Jaga Kesehatan Anda Sekarang') }}">
                </div>
                <div class="admin-form-group">
                    <label>Deskripsi CTA</label>
                    <input type="text" name="cta_desc" value="{{ old('cta_desc', $settings['cta_desc'] ?? '') }}">
                </div>
            </div>
        </div>

        <div style="text-align:right;margin-top:1rem">
            <button type="submit" class="btn btn-primary" style="font-size:1rem;padding:.875rem 2.5rem">
                💾 Simpan Semua Pengaturan
            </button>
        </div>
    </div>

</div>
</form>
@endsection
