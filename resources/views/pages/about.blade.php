@extends('layouts.app')
@section('title', 'Tentang Kami')

@section('content')

<!-- Page Header -->
<div style="background:var(--navy);padding:9rem 0 4rem;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background-image:radial-gradient(circle at 70% 50%,rgba(201,168,76,0.07) 0%,transparent 60%)"></div>
    <div class="container" style="position:relative">
        <div class="section-label">Tentang Kami</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2rem,4vw,3.5rem);color:var(--white);margin-bottom:.75rem">
            {{ $settings['about_title'] ?? 'Tentang Rumah Sakit Kami' }}
        </h1>
        <p style="color:rgba(255,255,255,0.65);max-width:560px;line-height:1.8">
            {{ $settings['tagline'] ?? 'Kesehatan Anda, Prioritas Kami' }}
        </p>
    </div>
</div>

<!-- Tentang Section -->
<section style="padding:6rem 0">
    <div class="container">
        <div class="about-grid">
            <div class="about-image-wrap animate-up">
                @if(!empty($settings['about_image']))
                    <img src="{{ asset('storage/'.$settings['about_image']) }}" alt="Tentang Kami" class="about-img-main">
                @else
                    <div class="about-img-main" style="background:linear-gradient(135deg,#0a1628,#1d3461);display:flex;align-items:center;justify-content:center;font-size:6rem;color:rgba(201,168,76,0.4)">🏥</div>
                @endif
                <div class="about-badge-float">
                    🏆<br>Akreditasi<br>Paripurna<br>{{ date('Y') }}
                </div>
            </div>
            <div class="animate-up">
                <div class="section-label">Sejarah & Visi</div>
                <h2 class="section-title">{{ $settings['about_title'] ?? 'Mengutamakan Kesehatan Anda Sejak 1999' }}</h2>
                <p style="color:var(--gray-600);line-height:1.8;margin-bottom:1.25rem">
                    {{ $settings['about_text_1'] ?? 'Sejak berdiri, kami telah melayani masyarakat dengan dedikasi penuh. Kami percaya bahwa setiap pasien berhak mendapatkan pelayanan terbaik dengan teknologi mutakhir.' }}
                </p>
                <p style="color:var(--gray-600);line-height:1.8;margin-bottom:2rem">
                    {{ $settings['about_text_2'] ?? 'Didukung oleh lebih dari 150 dokter spesialis dan tenaga medis terlatih, kami siap memberikan diagnosa yang akurat dan penanganan yang efektif.' }}
                </p>
                <div class="about-features">
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <div><h4>Dokter Berpengalaman</h4><p>Lebih dari 150 spesialis</p></div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <div><h4>Teknologi Modern</h4><p>Peralatan medis terkini</p></div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <div><h4>Layanan 24 Jam</h4><p>UGD selalu siap melayani</p></div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <div><h4>BPJS Kesehatan</h4><p>Menerima semua jenis BPJS</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visi & Misi -->
<section style="padding:5rem 0;background:var(--off-white)">
    <div class="container">
        <div style="text-align:center;margin-bottom:3rem">
            <div class="section-label">Nilai Kami</div>
            <h2 class="section-title">Visi & Misi</h2>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem">
            <div style="background:var(--white);border-radius:var(--radius-lg);padding:2.5rem;border-top:4px solid var(--gold)">
                <div style="font-size:2.5rem;margin-bottom:1rem">🎯</div>
                <h3 style="font-family:var(--font-display);color:var(--navy);font-size:1.5rem;margin-bottom:1rem">Visi</h3>
                <p style="color:var(--gray-600);line-height:1.8">
                    {{ $settings['vision'] ?? 'Menjadi rumah sakit rujukan terpercaya yang memberikan pelayanan kesehatan berkualitas internasional dengan mengutamakan keselamatan pasien dan kepuasan masyarakat.' }}
                </p>
            </div>
            <div style="background:var(--white);border-radius:var(--radius-lg);padding:2.5rem;border-top:4px solid var(--navy)">
                <div style="font-size:2.5rem;margin-bottom:1rem">🚀</div>
                <h3 style="font-family:var(--font-display);color:var(--navy);font-size:1.5rem;margin-bottom:1rem">Misi</h3>
                <ul style="color:var(--gray-600);line-height:2;list-style:none">
                    <li>✦ Memberikan pelayanan medis yang berkualitas dan terjangkau</li>
                    <li>✦ Mengembangkan SDM tenaga kesehatan yang profesional</li>
                    <li>✦ Menerapkan teknologi kesehatan terkini</li>
                    <li>✦ Membangun kemitraan yang kuat dengan masyarakat</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section style="padding:5rem 0;background:var(--navy)">
    <div class="container">
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1px;background:rgba(255,255,255,0.08);border-radius:var(--radius-lg);overflow:hidden">
            @foreach([
                ['num' => $settings['stat_doctors'] ?? '150+', 'label' => 'Dokter Spesialis', 'icon' => '👨‍⚕️'],
                ['num' => $settings['stat_patients'] ?? '50K+', 'label' => 'Pasien Per Tahun', 'icon' => '❤️'],
                ['num' => $settings['stat_years'] ?? '25+',    'label' => 'Tahun Pengalaman', 'icon' => '🏆'],
                ['num' => $settings['stat_satisfaction'] ?? '98%', 'label' => 'Kepuasan Pasien', 'icon' => '⭐'],
            ] as $stat)
            <div style="background:rgba(10,22,40,0.6);padding:2.5rem;text-align:center">
                <div style="font-size:2rem;margin-bottom:.5rem">{{ $stat['icon'] }}</div>
                <div style="font-family:var(--font-display);font-size:2.5rem;font-weight:700;color:var(--gold);line-height:1">{{ $stat['num'] }}</div>
                <div style="font-size:.875rem;color:rgba(255,255,255,0.6);margin-top:.5rem">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Tim Manajemen (opsional) -->
<section style="padding:6rem 0">
    <div class="container" style="text-align:center">
        <div class="section-label">Tim Kami</div>
        <h2 class="section-title">Manajemen & Kepemimpinan</h2>
        <p class="section-subtitle" style="margin:0 auto 3rem">Dipimpin oleh para profesional berpengalaman di bidang kesehatan dan manajemen rumah sakit.</p>
        <a href="{{ route('doctors') }}" class="btn btn-navy">Lihat Semua Dokter Kami →</a>
    </div>
</section>

<!-- CTA -->
<section style="padding:5rem 0;background:var(--gold);text-align:center">
    <div class="container">
        <h2 style="font-family:var(--font-display);font-size:2.25rem;color:var(--navy);margin-bottom:1rem">
            {{ $settings['cta_title'] ?? 'Siap Melayani Kesehatan Anda' }}
        </h2>
        <p style="color:rgba(10,22,40,0.7);margin-bottom:2rem;font-size:1.0625rem">
            {{ $settings['cta_desc'] ?? 'Hubungi kami atau buat janji temu sekarang.' }}
        </p>
        <a href="{{ route('contact') }}" class="btn btn-navy">Buat Janji Temu →</a>
    </div>
</section>

@endsection

@push('scripts')
<script>
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.12 });
document.querySelectorAll('.animate-up').forEach(el => observer.observe(el));
</script>
@endpush
