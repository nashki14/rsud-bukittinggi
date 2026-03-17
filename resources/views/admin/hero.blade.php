@extends('layouts.admin')
@section('title', 'Hero & Banner')

@section('content')

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
@csrf @method('PUT')

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">

    {{-- Hero Utama --}}
    <div class="admin-card" style="grid-column:1/-1">
        <div class="admin-card-header">
            <h2>🖼️ Hero Utama (Banner Beranda)</h2>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
            <div>
                <div class="admin-form-group">
                    <label>Judul Hero</label>
                    <textarea name="hero_title" rows="3">{{ old('hero_title', $settings['hero_title'] ?? 'Layanan Kesehatan<br><em>Terpercaya & Terdepan</em>') }}</textarea>
                    <div class="form-hint">Gunakan &lt;br&gt; untuk baris baru dan &lt;em&gt; untuk teks berwarna emas.</div>
                </div>
                <div class="admin-form-group">
                    <label>Subjudul / Deskripsi Hero</label>
                    <textarea name="hero_subtitle" rows="4">{{ old('hero_subtitle', $settings['hero_subtitle'] ?? '') }}</textarea>
                </div>
                <div class="admin-form-group">
                    <label>Teks Badge (atas judul)</label>
                    <input type="text" name="hero_badge" value="{{ old('hero_badge', $settings['hero_badge'] ?? 'Terakreditasi KARS Paripurna') }}">
                    <div class="form-hint">Contoh: Terakreditasi KARS Paripurna</div>
                </div>
            </div>
            <div>
                <div class="admin-form-group">
                    <label>Gambar Latar Hero</label>
                    @if(!empty($settings['hero_image']))
                        <div style="margin-bottom:.75rem">
                            <img src="{{ asset('storage/'.$settings['hero_image']) }}"
                                 style="width:100%;height:160px;object-fit:cover;border-radius:var(--radius-md);border:2px solid var(--gray-200)"
                                 alt="Hero Image">
                        </div>
                    @else
                        <div style="width:100%;height:160px;background:var(--off-white);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;margin-bottom:.75rem;color:var(--gray-400);font-size:.875rem;border:2px dashed var(--gray-200)">
                            Belum ada gambar hero
                        </div>
                    @endif
                    <input type="file" name="hero_image" accept="image/*">
                    <div class="form-hint">Ukuran optimal: 1920×1080px. Maks 5MB. Format JPG/PNG/WebP.</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <h2>📊 Statistik Hero</h2>
        </div>
        <p style="font-size:.875rem;color:var(--gray-400);margin-bottom:1.25rem">Angka-angka yang tampil di bagian bawah hero beranda.</p>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="admin-form-group">
                <label>Jumlah Dokter</label>
                <input type="text" name="stat_doctors" value="{{ old('stat_doctors', $settings['stat_doctors'] ?? '150+') }}" placeholder="150+">
            </div>
            <div class="admin-form-group">
                <label>Pasien per Tahun</label>
                <input type="text" name="stat_patients" value="{{ old('stat_patients', $settings['stat_patients'] ?? '50K+') }}" placeholder="50K+">
            </div>
            <div class="admin-form-group">
                <label>Tahun Pengalaman</label>
                <input type="text" name="stat_years" value="{{ old('stat_years', $settings['stat_years'] ?? '25+') }}" placeholder="25+">
            </div>
            <div class="admin-form-group">
                <label>Kepuasan Pasien</label>
                <input type="text" name="stat_satisfaction" value="{{ old('stat_satisfaction', $settings['stat_satisfaction'] ?? '98%') }}" placeholder="98%">
            </div>
        </div>
    </div>

    {{-- Emergency Bar --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <h2>🚨 Emergency Bar</h2>
        </div>
        <p style="font-size:.875rem;color:var(--gray-400);margin-bottom:1.25rem">Bar merah di bawah hero berisi nomor darurat UGD.</p>
        <div class="admin-form-group">
            <label>Nomor UGD / Darurat</label>
            <input type="text" name="emergency_phone" value="{{ old('emergency_phone', $settings['emergency_phone'] ?? '119') }}" placeholder="119">
            <div class="form-hint">Nomor ini tampil besar di emergency bar dan bisa diklik untuk menelepon.</div>
        </div>
        <div class="admin-form-group">
            <label>Teks Keterangan Emergency</label>
            <input type="text" name="emergency_text" value="{{ old('emergency_text', $settings['emergency_text'] ?? 'Hubungi kami kapan saja untuk keadaan darurat medis') }}" placeholder="Hubungi kami kapan saja...">
        </div>
    </div>

    {{-- CTA Banner --}}
    <div class="admin-card" style="grid-column:1/-1">
        <div class="admin-card-header">
            <h2>📣 Banner CTA (Call to Action)</h2>
        </div>
        <p style="font-size:.875rem;color:var(--gray-400);margin-bottom:1.25rem">Banner berwarna emas di bagian bawah halaman beranda.</p>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="admin-form-group">
                <label>Judul CTA</label>
                <input type="text" name="cta_title" value="{{ old('cta_title', $settings['cta_title'] ?? 'Jaga Kesehatan Anda Sekarang') }}">
            </div>
            <div class="admin-form-group">
                <label>Deskripsi CTA</label>
                <input type="text" name="cta_desc" value="{{ old('cta_desc', $settings['cta_desc'] ?? 'Konsultasikan kebutuhan medis Anda dengan dokter spesialis kami hari ini.') }}">
            </div>
        </div>

        <div style="text-align:right;margin-top:1rem;padding-top:1rem;border-top:1px solid var(--gray-100)">
            <button type="submit" class="btn btn-primary" style="font-size:1rem;padding:.875rem 2.5rem">
                💾 Simpan Pengaturan Hero
            </button>
        </div>
    </div>

</div>
</form>

{{-- Preview --}}
<div class="admin-card" style="margin-top:1.5rem">
    <div class="admin-card-header">
        <h2>👁️ Preview Hero</h2>
        <a href="{{ route('home') }}" target="_blank" class="btn btn-navy" style="padding:.5rem 1rem;font-size:.8125rem">
            🌐 Lihat di Website
        </a>
    </div>
    <div style="background:var(--navy);border-radius:var(--radius-md);padding:3rem 2rem;position:relative;overflow:hidden;min-height:200px">
        <div style="position:absolute;inset:0;background-image:radial-gradient(circle at 20% 50%,rgba(201,168,76,0.08) 0%,transparent 50%)"></div>
        <div style="position:relative;max-width:500px">
            <div style="display:inline-flex;align-items:center;gap:.5rem;padding:.4rem .875rem;background:rgba(201,168,76,0.15);border:1px solid rgba(201,168,76,0.3);border-radius:50px;font-size:.75rem;color:#e8c97a;letter-spacing:.08em;text-transform:uppercase;margin-bottom:1rem;font-weight:600">
                ● {{ $settings['hero_badge'] ?? 'Terakreditasi KARS Paripurna' }}
            </div>
            <h2 style="font-family:'Playfair Display',serif;color:#fff;font-size:2rem;line-height:1.15;margin-bottom:.75rem">
                {!! $settings['hero_title'] ?? 'Layanan Kesehatan<br><em style="color:#c9a84c;font-style:normal">Terpercaya & Terdepan</em>' !!}
            </h2>
            <p style="color:rgba(255,255,255,0.65);font-size:.9rem;line-height:1.7;margin-bottom:1.25rem">
                {{ Str::limit($settings['hero_subtitle'] ?? 'Kami berkomitmen memberikan pelayanan medis berkualitas tinggi.', 120) }}
            </p>
            <div style="display:flex;gap:.75rem">
                <span style="padding:.5rem 1.25rem;background:#c9a84c;color:#0a1628;border-radius:50px;font-weight:700;font-size:.8125rem">Buat Janji Temu →</span>
                <span style="padding:.5rem 1.25rem;border:1.5px solid rgba(255,255,255,0.3);color:rgba(255,255,255,0.8);border-radius:50px;font-size:.8125rem">Pelajari Lebih Lanjut</span>
            </div>
        </div>
    </div>
    <p style="font-size:.8rem;color:var(--gray-400);margin-top:.75rem;text-align:center">
        ℹ️ Preview di atas adalah simulasi. Klik "Lihat di Website" untuk melihat tampilan asli.
    </p>
</div>

@endsection
